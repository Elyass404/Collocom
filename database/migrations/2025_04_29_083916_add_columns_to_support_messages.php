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
        Schema::table('support_messages', function (Blueprint $table) {
            $table->string("name",30);
            $table->string("email",255);
            $table->string("object",255);
            $table->string("phone_number",20);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('support_messages', function (Blueprint $table) {
            $table->dropColumn(["name","email","phone_number","object"]);
        });
    }
};
