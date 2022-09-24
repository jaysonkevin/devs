<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobAds extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_ads', function (Blueprint $table) {
            $table->id();
            $table->string("job_title",255);
            $table->text("job_description");
            $table->integer('job_type')->length(11)->unsigned();
            $table->integer('salary')->length(11)->nullable();
            $table->integer('created_by')->length(11)->unsigned();
            $table->char('status',3)->default('A');   
            $table->char('is_accepted',3)->default('N');   
            $table->date('accepted_date')->nullable();   
            $table->char('is_purchased',3)->default('N')->comment('[N] IF USER USES THE FREE TRIAL AND  [Y] if PURCHASED');;   
            $table->timestamps();

            $table->index(['created_by','status']);
            $table->index(['status','is_accepted']);
            $table->index(['status']);
            $table->index(['job_type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_ads');
    }
}
