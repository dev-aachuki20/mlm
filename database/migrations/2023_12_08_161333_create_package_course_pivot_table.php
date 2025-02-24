<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package_course', function (Blueprint $table) {
            $table->unsignedBigInteger('package_id');
            $table->unsignedBigInteger('course_id');
            $table->timestamps();

            $table->primary(['package_id', 'course_id']);

            $table->foreign('package_id','package_id_fk_5458')->references('id')->on('package')->onDelete('cascade');
            $table->foreign('course_id','course_id_fk_6954')->references('id')->on('courses')->onDelete('cascade');

           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('package_course');
    }
};
