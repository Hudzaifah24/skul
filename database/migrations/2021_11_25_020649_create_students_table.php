<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('nisn');
            $table->string('nik');
            $table->string('name');
            $table->enum('gender',['Laki-Laki','Perempuan']);
            $table->date('born');
            $table->string('place_of_birth');
            $table->enum('religion',['Islam','Kristen','Hinddu','Buddha','Prostestan','Konghocu'])->nullable();
            $table->longText('address')->nullable();
            $table->integer('memorization_juz')->nullable();
            $table->integer('memorization_page')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamp('email_verified_at')->nullable();
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
        Schema::dropIfExists('students');
    }
}
