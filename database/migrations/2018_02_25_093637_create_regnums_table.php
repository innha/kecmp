<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegnumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regnums', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('chapelle_id')->index()->unsigned()->nullable();
            $table->string('regnum');
            $table->timestamps();

            $table->foreign('chapelle_id')->references('id')->on('chapelles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('regnums');
    }
}
