<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCinemaSchema extends Migration
{
    public function up()
    {
        // throw new \Exception('implement in coding task 4, you can ignore this exception if you are just running the initial migrations.');
        
        // Table for movies
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('movie_name');
            $table->text('movie_description')->nullable();
            $table->timestamps();
        });

         // Table for showrooms
         Schema::create('showrooms', function (Blueprint $table) {
            $table->id();
            $table->string('room_name');
            $table->timestamps();
        });

        // Table for showtimes
        Schema::create('showtimes', function (Blueprint $table) {
            $table->id();
            $table->dateTime('start_at');

            $table->unsignedBigInteger('movie_id');
            $table->foreign('movie_id')->references('id')->on('movies')->onDelete('cascade');
            
            $table->timestamps();
        });

        // Bridge table for showtimes and showrooms
        Schema::create('showtime_showroom', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('showtime_id');
            $table->foreign('showtime_id')->references('id')->on('showtimes')->onDelete('cascade');

            $table->unsignedBigInteger('showroom_id');
            $table->foreign('showroom_id')->references('id')->on('showrooms')->onDelete('cascade');
            
            $table->timestamps();
        });

        // seat types
        Schema::create('seat_types', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->decimal('seat_premium_percentage', 6, 2);

            $table->timestamps();
        });

        // Table for seats
        Schema::create('seats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('showtime_id');
            $table->foreign('showtime_id')->references('id')->on('showtimes')->onDelete('cascade');

            $table->unsignedBigInteger('seat_type_id');
            $table->foreign('seat_type_id')->references('id')->on('seat_types')->onDelete('cascade');

            $table->string('row_no');
            $table->string('seat_no');

            $table->timestamps();
        });
        
        // Table for bookings
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('showtime_id');
            $table->foreign('showtime_id')->references('id')->on('showtimes')->onDelete('cascade');

            $table->unsignedBigInteger('seat_id');
            $table->foreign('seat_id')->references('id')->on('seats')->onDelete('cascade');

            $table->string('customer_name');

            $table->timestamps();
        });

        // Table for prices
        Schema::create('prices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('showtime_id');
            $table->foreign('showtime_id')->references('id')->on('showtimes')->onDelete('cascade');

            $table->unsignedBigInteger('seat_type_id');
            $table->foreign('seat_type_id')->references('id')->on('seat_types')->onDelete('cascade');

            $table->decimal('price', 6, 2);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('movies');
        Schema::dropIfExists('showtimes');
        Schema::dropIfExists('showrooms');
        Schema::dropIfExists('showtime_showroom');
        Schema::dropIfExists('seat_types');
        Schema::dropIfExists('seats');
        Schema::dropIfExists('bookings');
        Schema::dropIfExists('prices');
    }
}
