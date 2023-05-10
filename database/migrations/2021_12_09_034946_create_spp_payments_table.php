<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSppPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spp_payments', function (Blueprint $table) {
            $table->id();
            $table->enum('status', ['lunas', 'belum lunas', 'belum bayar']);
            $table->integer('amount');
            $table->text('proof')->nullable();
            $table->foreignId('bank_id')->nullable();
            $table->foreignId('spp_id');
            $table->foreignId('student_id');
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
        Schema::dropIfExists('spp_payments');
    }
}
