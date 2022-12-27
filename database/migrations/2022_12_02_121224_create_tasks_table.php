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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description')->nullable();
            $table->foreignId('assigner_id')->constrained('employees', 'id');
            $table->foreignId('executor_id')->constrained('employees', 'id');
            $table->dateTime('deadline');
            $table->dateTime('remind_at')->nullable();
            $table->tinyInteger('priority');
            $table->foreignId('client_id')->nullable()->constrained();
            $table->foreignId('deal_id')->nullable()->constrained()->cascadeOnDelete();
            $table->boolean('is_completed')->default(false);
            $table->dateTime('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
};
