<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {

            $table->increments('id');

            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->string('measure_unit')->nullable();
            $table->double('quantity')->nullable();
            $table->double('price_unit')->nullable();
            $table->string('type_line')->nullable();
            $table->string('total_line')->nullable();

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
        Schema::dropIfExists('products');
    }
}
