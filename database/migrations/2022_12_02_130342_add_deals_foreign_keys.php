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
        Schema::table('deals', function (Blueprint $table) {
            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('staff_id')->references('id')->on('staff');
            $table->foreign('funnel_id')->references('id')->on('funnels');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('deals', function (Blueprint $table) {
            $table->dropForeign('client_id');
            $table->dropForeign('staff_id');
            $table->dropForeign('funnel_id');
        });        
    }
};
