<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReferralUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referral_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id');
            $table->foreignId('child_id');
            $table->timestamps();
            $table->foreign('parent_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('child_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('referral_users');
    }
}
