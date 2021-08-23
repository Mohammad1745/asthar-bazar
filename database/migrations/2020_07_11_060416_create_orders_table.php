<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->bigInteger('order_code');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone_code',5);
            $table->string('phone',25);
            $table->string('address',191);
            $table->string('zip_code',80);
            $table->string('city',80);
            $table->string('country',80);
            $table->integer('quantity');
            $table->float('subtotal', 11, 2);
            $table->float('total_weight', 5, 3);
            $table->float('charges', 11, 2);
            $table->float('total_price', 11, 2);
            $table->float('paid', 11, 2);
            $table->string('payment_method');
            $table->string('shipping_method');
            $table->enum('payment_status', [PAYMENT_PENDING_STATUS, PAYMENT_DONE_STATUS]);
            $table->enum('shipping_status', [DELIVERY_PENDING_STATUS, DELIVERY_PROCESSING_STATUS, DELIVERY_COMPLETED_STATUS, DELIVERY_CANCELLED_STATUS]);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
