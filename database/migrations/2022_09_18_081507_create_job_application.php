<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobApplication extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_application', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->length(11)->unsigned()->comment("User id of applicant");
            $table->integer('job_id')->length(11)->unsigned();
            $table->char('is_hired',3)->default('N')->comment("employer can mark as hired or not"); 
            $table->tinyInteger('rating')->unsigned()->nullable()->comment("scale of 1 to 5");
            $table->string('rating_description', 255)->nullable();
            $table->tinyInteger('employer_notif')->unsigned()->nullable()->comment("1 IF SEEN , NULL IF UNSEEN");    
            $table->timestamps();

            $table->index(['job_id','user_id']);
            $table->index(['user_id','is_hired']);
            $table->index(['employer_notif']);
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_application');
    }
}
