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
        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            $table->string('name',255)->default(null)->nullable();
            $table->string('key',255)->default(null)->nullable();
            $table->integer('year_experience')->default(null)->nullable();
            $table->text('short_description')->nullable();
            $table->text('description')->nullable();
            $table->text('features')->nullable();
            $table->tinyInteger('status')->default(1)->comment('0=> deactive, 1=> active');
            $table->unsignedBigInteger('created_by');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sections');
    }
};
