<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gp', function (Blueprint $table) {
            $table->date('datum')->primary(); // a nagydíj dátuma egyben az azonosítója
            $table->string('nev');
            $table->string('helyszin');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gp');
    }
};
