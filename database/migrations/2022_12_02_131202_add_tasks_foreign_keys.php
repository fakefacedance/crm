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
        Schema::table('tasks', function (Blueprint $table) {
            $table->foreign('assigner_id')->references('id')->on('employees');
            $table->foreign('executor_id')->references('id')->on('employees');
            $table->foreign('client_id')->references('id')->on('clients');
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
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropForeign('assigner_id');
            $table->dropForeign('executor_id');
            $table->dropForeign('client_id');
            $table->dropForeign('deal_id');
        });   
    }
};
