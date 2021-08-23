<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartmentTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('department_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('department_id');
            $table->float('revenue', 11, 2);
            $table->float('revenue_from_wallet', 11, 2);
            $table->float('manufacturing_cost', 11, 2);
            $table->float('profit', 11, 2);
            $table->float('customer_reward', 11, 4);
            $table->float('net_profit', 13, 4);
            $table->tinyInteger('status')->default(false);
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
        Schema::dropIfExists('department_transactions');
    }
}
