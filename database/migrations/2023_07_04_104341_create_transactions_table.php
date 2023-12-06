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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');

            // $table->foreign('user_id', 'user_id_fk_6758')->references('id')->on('users');

            $table->unsignedBigInteger('payment_id')->nullable();

            $table->enum('payment_type', ['debit', 'credit'])->nullable();

            $table->tinyInteger('type')->default(null)->nullable()->comment('1=>Level 1, 2=> Level 2, 3=>Level 3');

            $table->double('amount', 10, 2);

            $table->tinyInteger('gateway')->default(null)->comment('1=> Razorpay, 2=>COD');

            $table->unsignedBigInteger('referrer_id')->default(null)->nullable();

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
        Schema::dropIfExists('transactions');
    }
};
