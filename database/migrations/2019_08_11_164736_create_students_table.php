<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->string('skn');
            $table->string('name');
            $table->string('surname');
            $table->string('cur_class');
            $table->string('gender');
            $table->date('birth');
            $table->string('group')->nullable();
            $table->integer('teacherId')->nullable();
            $table->boolean('active');
            $table->bigIncrements('id');
            $table->integer('tempValue')->nullable();
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
