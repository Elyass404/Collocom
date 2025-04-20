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
        Schema::create('offer_photos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("offer_id");
            $table->string('photo');
            $table->timestamps();

            //there another way to set up foreign key withtout writing two separate lines , it is the one commented under this comment
            // $table->foreignId("offer_id")->nullable()->constrained("categories")->onDelete("cascade");


            $table->foreign("offer_id")->references("id")->on("offers")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offers_photos');
    }
};
