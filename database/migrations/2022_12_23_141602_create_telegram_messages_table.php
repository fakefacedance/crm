<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('telegram_messages', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('chat_id');
            $table->string('correspondent_name');
            $table->string('correspondent_type');
            $table->string('text', 4096);
            $table->dateTime('sent_at');
        });
    }

    public function down()
    {
        Schema::dropIfExists('telegram_messages');
    }
};
