<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Invoice;
use App\Subscription;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        if(request('status'))
            $invoices = Invoice::where('status', request('status'))->latest()->paginate(20);
        else
            $invoices = Invoice::latest()->paginate(20);
        return view('admin.invoices.index', compact('invoices'));
    }

    public function detail(Invoice $invoice)
    {
        return view('admin.invoices.detail', compact('invoice'));
    }

    public function verify(Invoice $invoice)
    {
        if(auth()->user()->isAdmin()){
            $invoice->update([
                'verified_by' => auth()->id(),
                'verified_at' => Carbon::now(),
                'verified_comment' => request('verify_note')
            ]);

            if($invoice->payment_method != 'paypal')
                $this->afterSuccessPayment($invoice);
        }

        return back();
    }


    public function afterSuccessPayment( Invoice $invoice ) {
        $invoice->update(['status' => 'completed']);
        // check if current subscription exist
        $subscription = Subscription::where('user_id', $invoice->buyer->id)
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
                'user_id' => $invoice->buyer->id,
                'invoice_id' => $invoice->id,
                'total_month' => $invoice->month,
                'date_start' => Carbon::now(),
                'date_end' => Carbon::now()->addMonths($invoice->month),
                'is_expired' => 0
            ]);
        }

        $invoice->buyer->update(['is_funded_active' => 1]);
    }
}
