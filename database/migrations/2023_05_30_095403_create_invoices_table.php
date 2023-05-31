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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->text('transaction_details')->nullable();
            $table->string('purpose')->nullable();
            $table->double('amount',15,2)->default(0);
            $table->enum('type', ['Cr', 'Dr'])->default(null);
            $table->enum('entry_type', ['Invoice', 'Wallet','Transaction Statement view','Download'])->default(null);
            $table->datetime('date_time')->nullable();
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
        Schema::dropIfExists('invoices');
    }
};
