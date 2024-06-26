<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    //Run the migrations.
    public function up(): void
    {
        Schema::create('artists', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });
    }

    // Reverse the migrations, si on annule cette migration, on suprime la table
    public function down(): void
    {
        Schema::dropIfExists('artists');
    }
};
