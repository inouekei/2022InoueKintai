<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBreaksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('breaks', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('attendance_id')->unsigned();
            $table->foreign('attendance_id')->references('id')->on('attendances')->onDelete('cascade');
            $table->datetime('start_time');
            $table->datetime('end_time')->nullable();
            $table->datetime('created_at')->useCurrent()->nullable();
            $table->datetime('updated_at')->useCurrent()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('breaks');
    }
}
