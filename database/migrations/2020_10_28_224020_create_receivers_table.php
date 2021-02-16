<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceiversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receivers', function (Blueprint $table) {

            $table->increments('id');

            $table->string('document')->nullable();
            $table->string('bussiness_name')->nullable(); //razon social
            $table->string('bussiness')->nullable(); //giro
            $table->string('address')->nullable();
            $table->string('commune')->nullable();
            $table->string('city')->nullable();
            $table->string('ppassport')->nullable();            

            $table->integer('id_enterprises')->unsigned();
            $table->foreign('id_enterprises')->references('id')->on('enterprises')->onDelete('cascade');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('receivers');
    }
}
