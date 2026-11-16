<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('eredmeny', function (Blueprint $table) {
            $table->id();
            $table->date('datum');
            $table->unsignedBigInteger('pilotaaz');
            $table->unsignedSmallInteger('helyezes')->nullable(); // üres: nem ért célba
            $table->string('hiba')->nullable();                   // üres: célba ért
            $table->string('csapat')->nullable();                 // üres: egyéni induló
            $table->string('tipus');
            $table->string('motor');

            $table->foreign('datum')->references('datum')->on('gp')->cascadeOnDelete();
            $table->foreign('pilotaaz')->references('az')->on('pilota')->cascadeOnDelete();
            $table->index(['datum', 'helyezes']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('eredmeny');
    }
};
