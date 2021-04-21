<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('counters', function (Blueprint $table) {
            $table->id();
            $table->biginteger('user_id')->index();
            $table->string('serial');
            $table->string('installation_date');
            $table->string('end_of_service_date')->index();
            $table->integer('number_in_social_garanty')->index();
            $table->string('verification_date')->index();
            $table->string('verification_period')->index();
            $table->string('affiliation')->index();
            $table->string('description')->index();
            $table->boolean('replacement_made')->index();
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
        Schema::dropIfExists('counters');
    }
}
