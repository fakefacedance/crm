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
        Schema::create('deals', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->decimal('amount', 10, 2, true);
            $table->foreignId('client_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('employee_id')->constrained();
            $table->foreignId('funnel_id')->constrained();
            $table->tinyInteger('stage');
            $table->dateTime('created_at');
            $table->dateTime('closed_at')->nullable();   
            $table->boolean('success')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deals');
    }
};
