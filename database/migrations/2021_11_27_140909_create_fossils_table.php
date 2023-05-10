<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFossilsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fossils', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('income')->nullable();
            $table->string('work')->nullable();
            $table->string('phone_number')->nullable();
            $table->enum('religion',['Islam','Kristen','Hindu','Budha','Prostestan','Konghocu','Katolik'])->nullable();
            $table->string('education')->nullable();
            $table->enum('status',['Ayah','Ibu'])->nullable();
            $table->foreignId('student_id')->nullable();
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
        Schema::dropIfExists('fossils');
    }
}
