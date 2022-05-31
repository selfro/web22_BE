<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('lva');
            $table->dateTime('date');
            $table->dateTime('start');
            $table->dateTime('end');
            $table->boolean('isBooked')->default(false);
            $table->text('comment')->nullable();
            $table->integer('bookedUser')->nullable();
            $table->string('bookedUserFirstname')->nullable();
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

        Schema::dropIfExists('offers');

    }
}
