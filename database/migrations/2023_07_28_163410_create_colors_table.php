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
            'name' => [
                'en' => 'blue',
                'ar' => 'أزرق'
            ], 'hex' => '#0000ff'
        ]);
//        Color::create([
//            'name' => 'blue',
//            'hex' => '#0000ff'
//        ]);
        Color::create([
            'name' => [
                'en' => 'red',
                'ar' => 'أحمر'
            ],
            'hex' => '#ff0000'
        ]);
        Color::create([
            'name' => [
                'en' => 'green',
                'ar' => 'أخضر'
            ],
            'hex' => '#00ff00'
        ]);
        Color::create([
            'name' => [
                'en' => 'yellow',
                'ar' => 'أصفر'
            ],
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
