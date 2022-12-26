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
        Schema::table('clients_custom_fields', function (Blueprint $table) {
            $table->foreign('client_id')->references('id')->on('clients');            
        });

        Schema::table('deals_custom_fields', function (Blueprint $table) {
            $table->foreign('deal_id')->references('id')->on('deals');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clients_custom_fields', function (Blueprint $table) {
            $table->dropForeign(['client_id']);
        });

        Schema::table('deals_custom_fields', function (Blueprint $table) {
            $table->dropForeign(['deal_id']);
        });
    }
};
