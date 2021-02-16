<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDtesCafsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dtes_cafs', function (Blueprint $table) {

            $table->increments('id');

            $table->string('code')->nullable();
            $table->string('description')->nullable();


            $table->string('content')->nullable(); //caf

            $table->string('state')->nullable();

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
        Schema::dropIfExists('dtes_cafs');
    }
}
