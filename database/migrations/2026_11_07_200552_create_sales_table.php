
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();

            $table->foreignId('farm_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->string('product_type');
            $table->string('product_name');

            $table->decimal('quantity', 12, 2);
            $table->string('unit')->default('kg');

            $table->decimal('unit_price', 12, 2);
            $table->decimal('total_amount', 14, 2);

            $table->string('buyer_name')->nullable();
            $table->string('buyer_phone')->nullable();

            $table->date('sale_date');

            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
