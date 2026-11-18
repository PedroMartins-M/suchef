
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('category_id')
                ->nullable()
                ->constrained('categories')
                ->nullOnDelete();

            $table->string('title', 150);
            $table->string('slug', 180)->unique();
            $table->text('description')->nullable();
            $table->string('image')->nullable();

            $table->unsignedInteger('preparation_time')->nullable();
            $table->unsignedInteger('cooking_time')->nullable();
            $table->unsignedSmallInteger('servings')->default(1);

            $table->enum('difficulty', ['easy', 'medium', 'hard'])
                ->default('easy');

            $table->enum('status', ['draft', 'published', 'archived'])
                ->default('draft');

            $table->enum('visibility', ['public', 'private'])
                ->default('public');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('recipes');
    }
};
