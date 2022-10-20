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
            $table->string('firstname',255);
            $table->string('lastname',255);
            $table->char('gender', 5)->nullable();
            $table->date('date_of_birth')->nullable();
            $table->integer('height')->unsigned()->nullable();
            $table->char('country_code',3)->nullable();
            $table->char('type',3)->nullable();
            $table->string('region',200)->nullable();
            $table->string('twitter')->nullable();
            $table->string('facebook',255)->nullable();
            $table->string('instagram',255)->nullable();
            $table->string('snapchat',255)->nullable();
            $table->string('linkedin',255)->nullable();
            $table->string('tiktok',255)->nullable();
            $table->tinyInteger("user_status")->default(1);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->text('folder');
            $table->bigInteger('braintree_id')->nullable();
            $table->bigInteger('balance')->unsigned()->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->index(['user_status']);
            $table->index(['braintree_id']);
            $table->index(['type' ,'user_status']);
            $table->index(['country_code']);
            $table->index(['region']);
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
