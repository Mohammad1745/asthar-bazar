<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductVariationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_variations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id');
            $table->foreignId('type_id');
            $table->string('title');
            $table->text('description');
            $table->string('image');
            $table->integer('quantity');
            $table->string('unit_of_quantity');
            $table->float('weight_per_unit', 8, 3);
            $table->float('manufacturing_cost', 11, 2);
            $table->float('regular_price', 11, 2);
            $table->float('unit_price', 11, 2);
            $table->tinyInteger('status');
            $table->date('available_at');
            $table->timestamps();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('type_id')->references('id')->on('types')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_variations');
    }
}
