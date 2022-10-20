<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription_history', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->length(11)->unsigned()->comment("user id of the buyer");
            $table->integer('pricing_id')->length(11)->unsigned()->comment("price");
            $table->timestamps();

            $table->index(['user_id']);
            $table->index(['user_id' ,'pricing_id']);
            $table->index(['pricing_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscription_history');
    }
}
