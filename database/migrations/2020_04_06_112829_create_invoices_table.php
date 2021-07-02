<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->softDeletes();
            $table->unsignedBigInteger('buyer_id')->nullable();
            $table->foreign('buyer_id')->on('users')->references('id')->onDelete('SET NULL');

            $table->unsignedBigInteger('verified_by')->nullable();
            $table->foreign('verified_by')->on('users')->references('id')->onDelete('SET NULL');

            $table->dateTime('verified_at')->nullable();
            $table->text('verified_comment')->nullable();
            $table->enum('status', ['draft','new', 'completed', 'canceled', 'error'])->default('new');

            $table->double('discount')->default(0)->nullable();
            $table->double('grand_total')->default(0)->nullable();
            $table->string('code')->nullable();
            $table->enum('payment_method', ['paypal', 'bank_transfer', 'other'])->nullable();
            $table->string('paypal_payment_id')->nullable();
            $table->string('paypal_PayerID')->nullable();
            $table->string('paypal_token')->nullable();
            $table->string('paypal_payment_status')->nullable();
            $table->string('bank_transfer_path')->nullable();
            $table->unsignedBigInteger('file_bank_transfer_id')->nullable();
            $table->foreign('file_bank_transfer_id')->references('id')->on('file_uploads')->onDelete("SET NULL");

            $table->integer('amount')->default(0);
            $table->integer('month')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
