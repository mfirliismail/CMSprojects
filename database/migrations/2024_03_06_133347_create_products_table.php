<?php

use App\Models\ProductCategory;
use App\Models\Tag;
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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(ProductCategory::class)->constrained()->nullOnDelete();
            $table->foreignIdFor(Tag::class)->constrained()->nullOnDelete();
            $table->string('name');
            $table->string('code');
            $table->string('description');
            $table->unsignedInteger('type');
            $table->text('image');
            $table->longText('content');
            $table->boolean('is_active')->default(true); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
