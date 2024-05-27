<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('report_title');
            $table->string('category');
            // $table->string('location');
            $table->longText('coordinates');
            $table->string('fillColor');
            $table->date('date');
            $table->text('description');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE reports ADD image LONGBLOB");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
