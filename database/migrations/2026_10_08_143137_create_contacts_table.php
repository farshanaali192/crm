<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->enum('contactable_type',['account','lead'])->default('account');
            $table->bigInteger('contactable_id')->nullable(); //Source record ID
            $table->enum('status',['active','inactive'])->default('active');
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['email', 'contactable_type']);

            $table->index(['contactable_type', 'contactable_id']);
            $table->index('status');
            $table->index('created_at');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
