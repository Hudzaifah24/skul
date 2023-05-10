<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemorizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('memorizations', function (Blueprint $table) {
            $table->id();
            $table->string('surah');
            $table->integer('juz');
            $table->integer('ayat_from');
            $table->integer('ayat_to');
         
            
            $table->date('date');
            $table->foreignId('user_id');
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
        Schema::dropIfExists('memorizations');
    }
}
