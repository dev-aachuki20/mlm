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
        Schema::create('package', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->double('amount',15,2)->default(0);
            $table->text('description')->nullable();
            $table->double('level_one_commission',15,2)->default(0);
            $table->double('level_two_commission',15,2)->default(0);
            $table->double('level_three_commission',15,2)->default(0);
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
        Schema::dropIfExists('package');
    }
};
