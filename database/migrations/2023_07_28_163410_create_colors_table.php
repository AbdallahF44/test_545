<?php

use App\Models\Color;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('colors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('hex');
            $table->timestamps();
        });
        Color::create([
            'name' => 'blue',
            'hex' => '#0000ff'
        ]);
        Color::create([
            'name' => 'red',
            'hex' => '#ff0000'
        ]);
        Color::create([
            'name' => 'green',
            'hex' => '#00ff00'
        ]);
        Color::create([
            'name' => 'yellow',
            'hex' => '#ffff00'
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('colors');
    }
};
