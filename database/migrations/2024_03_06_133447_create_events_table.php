<?php

use App\Models\Specialist;
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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('banner');
            $table->unsignedInteger('event_type');
            $table->unsignedInteger('geo_type');
            $table->unsignedInteger('status_type');
            $table->foreignIdFor(Specialist::class)->constrained()->nullOnDelete();
            $table->date('start_date');
            $table->date('end_date');
            $table->string('location');
            $table->text('contact');
            $table->string('email')->nullable();
            $table->string('web_url')->nullable();
            $table->boolean('is_publish')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
