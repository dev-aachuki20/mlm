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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable()->default(null);
            $table->datetime('password_set_at')->nullable();
            $table->date('dob')->nullable();
            $table->date('date_of_join')->nullable();
            $table->string('my_referral_code',100)->nullable()->default(null);
            $table->string('referral_code',100)->nullable()->default(null);
            $table->string('referral_name')->nullable()->default(null);
            $table->bigInteger('referral_user_id')->nullable()->default(null);
            $table->rememberToken();
            $table->tinyInteger('is_active')->default(1)->comment('1=> active, 0=>deactive');
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
        Schema::dropIfExists('users');
    }
};
