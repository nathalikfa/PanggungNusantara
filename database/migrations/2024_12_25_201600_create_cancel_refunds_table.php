<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCancelRefundsTable extends Migration
{
    public function up()
    {
        Schema::create('cancel_refunds', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('user_id'); // Foreign key dari tabel user_login
            $table->unsignedBigInteger('concert_id'); // Foreign key dari tabel concerts
            $table->unsignedBigInteger('payment_id'); // Foreign key dari tabel payments
            $table->string('reason', 255); // Alasan refund
            $table->string('status')->default('waiting'); // Default status 'waiting'
            $table->timestamps();

            // Foreign keys
            $table->foreign('user_id')->references('id')->on('user_login')->onDelete('cascade');
            $table->foreign('concert_id')->references('id')->on('concerts')->onDelete('cascade');
            $table->foreign('payment_id')->references('id')->on('payments')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('cancel_refunds');
    }
}
