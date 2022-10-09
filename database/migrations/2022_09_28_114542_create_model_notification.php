<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelNotification extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('model_notification', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->length(11)->unsigned()->comment("user id of the model");
            $table->integer('rated_by')->length(11)->unsigned()->comment("user id of the company who rated");
            $table->tinyInteger('rating')->unsigned()->nullable()->comment("scale of 1 to 5");
            $table->char('status',3)->default('A')->comment("[A]ctive , [I]nactive"); 
            $table->tinyInteger('is_seen')->default(0)->comment("1 seen 0 unseen"); 
            $table->string('rating_description', 255)->nullable();
            $table->timestamps();


            $table->index(['user_id','status']);
            $table->index(['user_id','status','is_seen']);
            $table->index(['rated_by']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('model_notification');
    }
}
