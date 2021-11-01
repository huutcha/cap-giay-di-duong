<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('human_id');
            $table->unsignedBigInteger('organ_id');
            $table->string('reason');
            $table->string('reason_desc');
            $table->string('email');
            $table->date('duration');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('human_id')->references('id')->on('humans');
            $table->foreign('organ_id')->references('id')->on('organs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applications');
    }
}
