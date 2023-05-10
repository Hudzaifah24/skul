<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuardiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guardians', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('relationship',['Ayah','Ibu','Paman','Bibi','Kakek','Nenek','Kakak']);
            $table->string('work')->nullable();
            $table->string('phone_number')->nullable();
            $table->enum('religion',['Islam','Kristen','Hindu','Budha','Prostestan','Konghocu','Katolik'])->nullable();
            $table->string('education')->nullable();
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
        Schema::dropIfExists('guardians');
    }
}
