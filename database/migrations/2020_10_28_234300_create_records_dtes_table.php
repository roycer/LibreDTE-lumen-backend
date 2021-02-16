<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecordsDtesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('records_dtes', function (Blueprint $table) {

            $table->increments('id');

            $table->string('type_dte')->nullable();
            $table->string('number')->nullable();
            $table->string('total')->nullable();
            $table->string('pdf',40000)->nullable();
            $table->string('xml',40000)->nullable();
            $table->string('tracking')->nullable();
            $table->string('state_dte')->nullable();

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
        Schema::dropIfExists('records_dtes');
    }
}
