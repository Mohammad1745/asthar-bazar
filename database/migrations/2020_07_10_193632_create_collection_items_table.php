<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollectionItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collection_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('collection_id');
            $table->foreignId('product_variation_id');
            $table->float('discount', 5, 2);
            $table->date('expires_at');
            $table->timestamps();
            $table->foreign('collection_id')->references('id')->on('collections')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('product_variation_id')->references('id')->on('product_variations')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('collection_items');
    }
}
