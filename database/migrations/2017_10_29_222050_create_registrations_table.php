<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->increments('id');            
            // $table->integer('type_id')->index()->unsigned()->nullable();
            $table->integer('task_id')->index()->unsigned()->nullable();
            $table->integer('degree_id')->index()->unsigned()->nullable();
            // $table->integer('duty_id')->index()->unsigned()->nullable();
            $table->integer('category_id')->index()->unsigned()->nullable();
            // $table->integer('service_id')->index()->unsigned()->nullable();
            $table->integer('commission_id')->index()->unsigned()->nullable();
            // $table->integer('duty_id')->index()->unsigned()->nullable();
            $table->integer('status_id')->index()->unsigned()->nullable();
            $table->string('regNumber', 23)->nullable()->unique();
            $table->string('lastName');
            $table->string('firstName')->nullable();
            $table->string('fLastName')->nullable();
            $table->string('fFirstName')->nullable();
            $table->string('mLastName')->nullable();
            $table->string('mFirstName')->nullable();
            $table->date('dob')->nullable();
            $table->string('birthPlace');
            $table->string('phoneOne')->nullable();
            $table->string('phoneTwo')->nullable();
            $table->string('gender');
            $table->string('idNumber')->nullable();
            $table->string('maritalStatus');
            $table->string('legallyMarried');
            $table->string('email')->nullable();
            $table->integer('village_id')->index()->unsigned()->nullable();
            $table->integer('cell_id')->index()->unsigned()->nullable();
            $table->integer('sector_id')->index()->unsigned()->nullable();
            $table->integer('district_id')->index()->unsigned()->nullable();
            $table->integer('province_id')->index()->unsigned()->nullable();
            $table->integer('zone_id')->index()->unsigned()->nullable();
            $table->integer('chapelle_id')->index()->unsigned()->nullable();
            $table->integer('parish_id')->index()->unsigned()->nullable();
            $table->integer('diocese_id')->index()->unsigned()->nullable();
            $table->boolean('ownsHouse')->nullable();
            $table->integer('job_id')->index()->unsigned()->nullable();
            // $table->string('employer')->nullable();
            // $table->string('jobLocation')->nullable();
            $table->date('baptismDate')->nullable();
            $table->string('baptismParish')->nullable();
            $table->integer('choir_id')->index()->unsigned()->nullable();
            $table->string('origin_cell')->nullable();
            $table->string('origin_parish')->nullable();
            $table->integer('user_id')->index()->unsigned()->nullable();
            $table->boolean('confirmed')->nullable()->default(true);
            $table->text('notes')->nullable();
            $table->timestamps();

            // $table->foreign('type_id')->references('id')->on('types')->onDelete('cascade');
            $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');
            $table->foreign('degree_id')->references('id')->on('degrees')->onDelete('cascade');
            // $table->foreign('duty_id')->references('id')->on('duties')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            // $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
            $table->foreign('commission_id')->references('id')->on('commissions')->onDelete('cascade');
            // $table->foreign('duty_id')->references('id')->on('duties')->onDelete('cascade');
            $table->foreign('status_id')->references('id')->on('statuses')->onDelete('cascade');
            $table->foreign('village_id')->references('id')->on('villages')->onDelete('cascade');
            $table->foreign('cell_id')->references('id')->on('cells')->onDelete('cascade');
            $table->foreign('sector_id')->references('id')->on('sectors')->onDelete('cascade');
            $table->foreign('district_id')->references('id')->on('districts')->onDelete('cascade');
            $table->foreign('province_id')->references('id')->on('provinces')->onDelete('cascade');
            $table->foreign('zone_id')->references('id')->on('zones')->onDelete('cascade');
            $table->foreign('chapelle_id')->references('id')->on('chapelles')->onDelete('cascade');
            $table->foreign('parish_id')->references('id')->on('parishes')->onDelete('cascade');
            $table->foreign('diocese_id')->references('id')->on('dioceses')->onDelete('cascade');
            $table->foreign('job_id')->references('id')->on('jobs')->onDelete('cascade');

            $table->foreign('choir_id')->references('id')->on('choirs')->onDelete('cascade');
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
        Schema::dropIfExists('registrations');
    }
}
