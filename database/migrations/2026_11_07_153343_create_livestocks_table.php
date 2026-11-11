<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('livestocks', function (Blueprint $table) {
            $table->id();

            $table->foreignId('farm_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->string('animal_type');
            $table->string('breed')->nullable();
            $table->unsignedInteger('quantity');

            $table->date('purchase_date')->nullable();
            $table->decimal('purchase_cost', 12, 2)->nullable();

            $table->string('health_status')->default('healthy');

            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('livestocks');
    }
};