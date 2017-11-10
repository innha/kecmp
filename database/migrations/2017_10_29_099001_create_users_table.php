<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('role_id')->index()->unsigned()->nullable();
            $table->integer('privilege_id')->index()->unsigned()->nullable();
            $table->integer('photo_id')->unsigned()->nullable();
            $table->integer('is_active')->default(1);
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->string('password');
            $table->integer('province_id')->index()->unsigned()->nullable();
            $table->integer('district_id')->index()->unsigned()->nullable();
            $table->integer('sector_id')->index()->unsigned()->nullable();
            $table->integer('cell_id')->index()->unsigned()->nullable();
            $table->integer('village_id')->index()->unsigned()->nullable();
            $table->integer('diocese_id')->index()->unsigned()->nullable();
            $table->integer('parish_id')->index()->unsigned()->nullable();
            $table->integer('chapelle_id')->index()->unsigned()->nullable();
            $table->integer('zone_id')->index()->unsigned()->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->foreign('privilege_id')->references('id')->on('privileges')->onDelete('cascade');
            $table->foreign('photo_id')->references('id')->on('photos')->onDelete('cascade');
            $table->foreign('province_id')->references('id')->on('provinces')->onDelete('cascade');
            $table->foreign('district_id')->references('id')->on('districts')->onDelete('cascade');
            $table->foreign('sector_id')->references('id')->on('sectors')->onDelete('cascade');
            $table->foreign('cell_id')->references('id')->on('cells')->onDelete('cascade');
            $table->foreign('village_id')->references('id')->on('villages')->onDelete('cascade');
            $table->foreign('diocese_id')->references('id')->on('dioceses')->onDelete('cascade');
            $table->foreign('parish_id')->references('id')->on('parishes')->onDelete('cascade');
            $table->foreign('chapelle_id')->references('id')->on('chapelles')->onDelete('cascade');
            $table->foreign('zone_id')->references('id')->on('zones')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
