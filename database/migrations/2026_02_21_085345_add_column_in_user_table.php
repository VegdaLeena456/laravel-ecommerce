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
        Schema::table('users', function (Blueprint $table) {
            $table->string('profile_image')->nullable(); 
            $table->string('number'); 
            $table->string('address')->nullable(); 
            $table->string('country')->nullable(); 
            $table->enum('gender', ['male', 'female', 'other'])->nullable(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['number', 'address', 'country', 'gender']);
        });
    }
};