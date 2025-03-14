<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string("gender",25); //I specified the the name of the column and also the max length 
            $table->enum("gender",["Male","Female"]);
            $table->unsignedBigInteger("role_id")->nullable();
            /* We can also write like this (one line bellow) writing and then we wont have to write the line bellow where we specify the foreign key its done automatically by laravel witht the constrained method
            here is the other syntaxe: $table->foreignId('role_id')->constrained('roles')->onDelete('cascade'); */
            $table->string("profile_picture",255)->nullable();
            $table->date("birthdate");
            $table->text("bio")->nullable();
            $table->unsignedBigInteger("situation_id")->nullable();

            //Foreign keys 
            $table->foreign("situation_id")->references("id")->on("situations")->onDelete("set null");
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
