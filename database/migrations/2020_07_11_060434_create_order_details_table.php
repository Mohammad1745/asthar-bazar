<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id');
            $table->string('product_title');
            $table->bigInteger('product_variation_id')->unsigned();;
            $table->string('product_variation_title');
            $table->string('type_title');
            $table->string('department_title');
            $table->text('description');
            $table->float('unit_price', 11, 2);
            $table->float('weight_per_unit', 5, 3);
            $table->string('unit_of_quantity');
            $table->integer('quantity');
            $table->float('price', 11, 2);
            $table->float('weight', 5, 3);
            $table->timestamps();
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_details');
    }
}
