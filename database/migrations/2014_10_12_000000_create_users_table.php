<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('username')->unique();
            $table->string('photo')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('email_verification_code')->nullable();
            $table->tinyInteger('verification_status')->default(0);
            $table->string('phone_code',5)->nullable();
            $table->string('phone',25)->nullable();
            $table->string('phone_verification_code')->nullable();
            $table->tinyInteger('is_phone_verified')->default(PENDING_STATUS);
            $table->string('address',191)->nullable();
            $table->string('zip_code',80)->nullable();
            $table->string('city',80)->nullable();
            $table->string('country',80)->nullable();
            $table->tinyInteger('role');
            $table->string('language', 10)->nullable();
            $table->boolean('is_social_login')->default(false);
            $table->string('social_network_id', 180)->nullable();
            $table->string('social_network_type', 20)->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
