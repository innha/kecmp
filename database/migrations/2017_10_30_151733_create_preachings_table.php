<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreachingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preachings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('visitor_names');            
            $table->string('topic');
            $table->date('date_preached');
            // $table->boolean('hasRepented');
            $table->integer('num_repented');
            $table->integer('user_id')->index()->unsigned()->nullable();
            $table->timestamps();

            // $table->foreign('registration_id')->references('id')->on('registrations')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('preachings');
    }
}
