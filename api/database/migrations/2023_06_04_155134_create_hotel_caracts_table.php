<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotel_caracts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('hotel_name');   
            $table->string('type');    
            $table->string('accommodation');  
            $table->integer('quantity')->unsigned();       
            $table->foreign('hotel_name')->references('name')->on('hotels'); 
            $table->foreign('type')->references('type')->on('types'); 
            $table->foreign('accommodation')->references('accommodation')->on('accommodations'); 
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['hotel_name','type','accommodation'], 'llave_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hotel_caracts', function (Blueprint $table) {
            $table->dropUnique('llave_unique');
        });
    }
};
