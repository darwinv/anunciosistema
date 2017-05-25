<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTableImages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',100);
            $table->string('extention',5);
            $table->string('route',60);
			$table->integer('publication_id')->unsigned();
			$table->integer('position');
            $table->enum('status',['Activo','Inactivo'])->default('Activo');
			$table->foreign('publication_id')->references('id')->on('publications')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('images');
    }
}
