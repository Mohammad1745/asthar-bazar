<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('department_id');
            $table->bigInteger('product_variation_id');
            $table->string('product_title');
            $table->string('product_variation_title');
            $table->string('type_title');
            $table->integer('quantity');
            $table->string('unit_of_quantity');
            $table->timestamps();
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sale_records');
    }
}
