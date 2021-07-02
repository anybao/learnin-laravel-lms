<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Notifications\NotifyAdminNewPayment;
use App\Subscription;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;

/** All Paypal Details class **/
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use Redirect;
use Session;
use URL;

class PaymentController extends Controller
{
    private $_api_context;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        /** PayPal api context **/
        $paypal_conf = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential(
                $paypal_conf['client_id'],
                $paypal_conf['secret'])
        );
        $this->_api_context->setConfig($paypal_conf['settings']);

    }

    public function payWithpaypal(Request $request)
    {
        $request->validate([
            'amount' => 'required|in:99,299,499',
            'month' => 'required|in:1,3,6'
        ]);

        // Create subscription object
        $invoice = Invoice::where('buyer_id', auth()->id())
                        ->where('payment_method', 'paypal')
                        ->where('status', 'draft')
                        ->where('grand_total', $request->amount*1000)
                        ->where('amount', $request->amount)
                        ->where('month', $request->month)
                        ->first();

        if(!$invoice){
            $invoice = Invoice::create([
                'buyer_id' => auth()->id(),
                'payment_method' => 'paypal',
                'status' => 'draft',
                'code' => $this->generateInvoiceCode(),
                'amount' => $request->amount,
                'month' => $request->month,
                'grand_total' => $request->amount*1000
            ]);
        }

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $item_1 = new Item();

        $item_1->setName('Daotao Vanphong') /** item name **/
        ->setCurrency('USD')
            ->setQuantity(1)
//               ->setPrice(200); /** unit price **/
            ->setPrice(floatval(round(($request->amount)*1000/env('USD_TO_VND_RATE', 23000), 1))); /** unit price **/

        $item_list = new ItemList();
        $item_list->setItems(array($item_1));

        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal(floatval(round(($request->amount)*1000/env('USD_TO_VND_RATE', 23000), 1)));

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Daotaovanphong');

        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::to('status/'.$invoice->code)) /** Specify return URL **/
        ->setCancelUrl(URL::to('status/'.$invoice->code));

        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
//         dd($payment->create($this->_api_context));exit;
        try {

            $payment->create($this->_api_context);

        } catch (\PayPal\Exception\PPConnectionException $ex) {
            $invoice->update(['status' => 'error']);
            if (\Config::get('app.debug')) {

                \Session::put('error', 'Connection timeout');
                return Redirect::to('subscribe?amount='.$request->amount.'&month'.$request->month);

            } else {

                \Session::put('error', 'Some error occur, sorry for inconvenient');
                return Redirect::to('subscribe?amount='.$request->amount.'&month'.$request->month);

            }

        }

        foreach ($payment->getLinks() as $link) {

            if ($link->getRel() == 'approval_url') {

                $redirect_url = $link->getHref();
                break;

            }

        }

        // Update Invoice Payment
        $invoice->update([
            'paypal_payment_id' => $payment->getId(),
        ]);

        /** add payment ID to session **/
        Session::put('paypal_payment_id', $payment->getId());

        if (isset($redirect_url)) {

            /** redirect to paypal **/
            return Redirect::away($redirect_url);

        }

        \Session::put('error', 'Unknown error occurred');
        $invoice->update(['status' => 'error']);

        return Redirect::to('subscribe?amount='.$request->amount.'&month'.$request->month);

    }

    public function getPaymentStatus(Invoice $invoice)
    {
        /** Get the payment ID before session clear **/
        $payment_id = Session::get('paypal_payment_id');

        /** clear the session payment ID **/
        Session::forget('paypal_payment_id');

        $payerId = request('PayerID') ? request('PayerID') : null;
        $token = request('token') ? request('token') : null;

        if(!$payment_id)
            $payment_id = request('paymentId') ? request('paymentId') : null;

        if (empty(request('PayerID')) || empty(request('token'))) {

            session('error', __('Payment failed! Please try again.'));
            $invoice->update(['status' => 'error']);
            $this->updatePaypalPayment($invoice, null, null, 'error - payerID and Token are null');
            return Redirect::to('/subscribe?amount='.$invoice->amount.'&month='.$invoice->month);

        }

        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId(request('PayerID'));

        /**Execute the payment **/
        $result = $payment->execute($execution, $this->_api_context);

        if ($result->getState() == 'approved') {

            session('success', 'Payment success');
            $this->updatePaypalPayment($invoice, $payerId, $token, 'success');
            $this->afterSuccessPayment($invoice);
            return redirect()->route('subscribe.success', $invoice)->with('message', 'Bạn đã thanh toán thành công! Bạn có thể học tất cả mọi khoá học ngay từ bây giờ!');
        }

        session('error', __('Payment failed! Please try again.'));
        $invoice->update(['status' => 'error']);
        $this->updatePaypalPayment($invoice, $payerId, $token, 'failed - unknown error');
        return Redirect::to('/subscribe?amount='.$invoice->amount.'&month='.$invoice->month);

    }

    public function updatePaypalPayment( Invoice $invoice, $payer_id = null, $token = null, $status = null ) {
        return $invoice->update([
            'paypal_PayerID' => $payer_id,
            'paypal_token' => $token,
            'paypal_payment_status' => $status
        ]);
    }

    public function generateInvoiceCode(  ) {
        return auth()->id().strtotime(Carbon::now());
    }

    public function afterSuccessPayment( Invoice $invoice ) {
        $invoice->update(['status' => 'completed']);
        // check if current subscription exist
        $subscription = Subscription::where('user_id', auth()->id())
                        ->where('is_expired', 0)
                        ->first();

        // if yes, extend the current subscription
        if($subscription && Carbon::make($subscription->date_end)->isFuture())
        {
            $subscription->update(['date_end' => Carbon::make($subscription->date_end)->addMonths($invoice->month)]);
        }

        // if no, create new subscription
        else {
            Subscription::create([
                'user_id' => auth()->id(),
                'invoice_id' => $invoice->id,
                'total_month' => $invoice->month,
                'date_start' => Carbon::now(),
                'date_end' => Carbon::now()->addMonths($invoice->month),
                'is_expired' => 0
            ]);
        }

        auth()->user()->update(['is_funded_active' => 1]);

        (new User)->forceFill([
            'name' => 'DTVP Website',
            'email' =>  env('MAIL_FROM_ADDRESS', 'tranquanghuy1093@gmail.com')
        ])->notify(new NotifyAdminNewPayment($invoice));
    }
}
