<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimeclockEntriesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('timeclock_entries', function (Blueprint $table) {
      $table->id();
      $table->dateTime('time_in');
      $table->dateTime('time_out');
      $table->unsignedBigInteger('user_id');
      $table->timestamps();

      // Relations
      $table->foreign('user_id')->references('id')->on('users');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('timeclock_entries');
  }
}
