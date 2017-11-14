<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChapellesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chapelles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parish_id')->index()->unsigned()->nullable();
            $table->string('name')->unique();            
            $table->timestamps();

            $table->foreign('parish_id')->references('id')->on('parishes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chapelles');
    }
}
