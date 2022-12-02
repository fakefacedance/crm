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
        Schema::table('funnel_stages', function (Blueprint $table) {
            $table->foreign('funnel_id')->references('id')->on('funnels')->cascadeOnDelete();            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('funnel_stages', function (Blueprint $table) {
            $table->dropForeign(['funnel_id']);
        });
    }
};
