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
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->string("title",255);
            $table->string ("phone_number",20);
            $table->integer("duration");
            $table->string("region",40);
            $table->string("city",40);
            $table->string("thumbnail")->nullable();
            $table->string("category_id")->nullable();

            /*we can also use this way as i did in the user migration :
            $table->foreignId("category_id")->nullable()->constrained("categories")->onDelete("set null");*/

            $table->enum("status",["Active","Suspended","Review"])->default("Active");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};
