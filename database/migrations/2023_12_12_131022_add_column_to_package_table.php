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
        Schema::table('package', function (Blueprint $table) {
            $table->unsignedBigInteger('parent_id')->nullable()->after('uuid');
            $table->foreign('parent_id','parent_id_fk_5487')->references('id')->on('package');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('package', function (Blueprint $table) {
            $table->dropForeign('parent_id_fk_5458');
            $table->dropColumn('parent_id');
        });
    }
};
