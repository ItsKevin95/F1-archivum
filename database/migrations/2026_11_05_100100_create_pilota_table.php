<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pilota', function (Blueprint $table) {
            $table->id('az');
            $table->string('nev');
            $table->char('nem', 1);          // F = férfi, N = nő
            $table->date('szuldat')->nullable();
            $table->string('nemzet');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pilota');
    }
};
