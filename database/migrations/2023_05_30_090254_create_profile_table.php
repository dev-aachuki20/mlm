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
        Schema::create('profile', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unique();

            $table->foreign('user_id', 'user_id_fk_6798')->references('id')->on('users')->onDelete('cascade');

            $table->string('guardian_name',191)->nullable();
            $table->string('gender',50)->nullable();
            $table->string('profession',191)->nullable();
            $table->string('marital_status',50)->nullable();
            $table->text('address')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('pin_code',50)->nullable();
            $table->string('nominee_name',191)->nullable();
            $table->date('nominee_dob')->nullable();
            $table->string('nominee_relation',100)->nullable();
            $table->unsignedBigInteger('level_one_user_id')->nullable();
            $table->unsignedBigInteger('level_two_user_id')->nullable();
            $table->unsignedBigInteger('level_three_user_id')->nullable();
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
        Schema::dropIfExists('profile');
    }
};
