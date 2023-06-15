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
        Schema::create('kyc', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unique();
            $table->foreign('user_id', 'user_id_fk_6778')->references('id')->on('users')->onDelete('cascade');

            $table->string('account_holder_name',191)->nullable();
            $table->string('account_number')->nullable();
            $table->text('bank_name')->nullable();
            $table->text('branch_name')->nullable();
            $table->string('ifsc_code')->nullable();
            $table->string('aadhar_card_name',191)->nullable();
            $table->string('aadhar_card_number')->nullable();
            $table->string('pan_card_name',191)->nullable();
            $table->string('pan_card_number',100)->nullable();
            $table->tinyInteger('status')->default(1)->comment('1=>Pending, 2=> Approve, 3=>Reject');

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
        Schema::dropIfExists('kyc');
    }
};
