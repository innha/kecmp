<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBridalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bridals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('m_bridal_id')->index()->unsigned()->nullable();
            $table->integer('f_bridal_id')->index()->unsigned()->nullable();
            $table->string('origin');
            $table->integer('user_id')->index()->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('m_bridal_id')->references('id')->on('registrations')->onDelete('cascade');
            $table->foreign('f_bridal_id')->references('id')->on('registrations')->onDelete('cascade');
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
        Schema::dropIfExists('bridals');
    }
}
