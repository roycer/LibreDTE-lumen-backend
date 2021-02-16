<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnterprisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enterprises', function (Blueprint $table) {

            $table->increments('id');

            $table->string('rut')->nullable(); //rut
            $table->string('bussiness_name')->nullable(); //razon social
            $table->string('bussiness')->nullable(); //giro
            $table->string('bussiness_code')->nullable(); //acteco
            $table->string('address')->nullable();
            $table->string('commune')->nullable();
            $table->string('city')->nullable();

            $table->date('fr')->nullable();
            $table->integer('nr')->nullable();

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
        Schema::dropIfExists('enterprises');
    }
}
