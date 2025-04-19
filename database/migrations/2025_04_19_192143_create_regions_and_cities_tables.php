<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;

use Illuminate\Database\Schema\Blueprint;
use function PHPUnit\Framework\fileExists;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $SqlRegions = database_path("sql/regions.sql");
        $SqlCities = database_path("sql/cities.sql");

        if(fileExists($SqlRegions)){
            DB::unprepared(File::get($SqlRegions));
        }

        if(fileExists($SqlCities)){
            DB::unprepared(File::get($SqlCities));
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("cities");
        Schema::dropIfExists("regions");
        
    }
};
