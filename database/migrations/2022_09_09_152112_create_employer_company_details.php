<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployerCompanyDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employer_company', function (Blueprint $table) {
            $table->id();
            $table->integer("user_id")->unsigned();
            $table->string("company_name",255);
            $table->string("company_display",255);
            $table->string("company_phone",255)->nullable();
            $table->string("company_address",255)->nullable();
            $table->text("company_description");
            $table->char("status" , 5)->default("A");
            $table->timestamps();


            $table->index(['user_id','status']);
            
          
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employer_company');
    }
}
