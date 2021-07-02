<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->on('users')->references('id')->onDelete('SET NULL');
            $table->unsignedBigInteger('coupon_id')->nullable();
            $table->unsignedBigInteger('invoice_id')->nullable();
            $table->foreign('invoice_id')->on('invoices')->references('id')->onDelete('SET NULL');
            $table->integer('total_month')->default(0);
            $table->dateTime('date_start');
            $table->dateTime('date_end');
            $table->boolean('is_expired')->default(false);
            $table->softDeletes();
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
        Schema::dropIfExists('subscriptions');
    }
}
