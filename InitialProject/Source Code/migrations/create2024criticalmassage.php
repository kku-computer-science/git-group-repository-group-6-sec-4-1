<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCriticalMessagesTable extends Migration
{
    public function up()
    {
        Schema::create('critical_messages', function (Blueprint $table) {
            $table->id();
            $table->string('message'); // The critical message (e.g., "Failed Login Attempt by email: attacker@example.com")
            $table->string('ip')->nullable(); // Attacker IP
            $table->string('url')->nullable(); // Requested URL
            $table->string('email')->nullable(); // Email associated with login attempt
            $table->string('user_agent')->nullable(); // User agent of the attacker
            $table->string('severity')->default('medium'); // Severity level (high/medium)
            $table->timestamp('timestamp')->useCurrent(); // When the event occurred
            $table->string('time_ago')->nullable(); // Relative time (e.g., "58 min ago")
            $table->boolean('is_dismissed')->default(false); // Dismissed status
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('critical_messages');
    }
}
