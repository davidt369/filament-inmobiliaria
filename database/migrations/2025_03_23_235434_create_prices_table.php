<?php

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
        Schema::create('prices', function (Blueprint $table) {

            $table->id();
            $table->string('description');
            $table->decimal('priceBs');
            $table->decimal('priceUSD');
            $table->decimal('pricePerSquareMeterBs');
            $table->decimal('priceOwnerBs');
            $table->decimal('priceOwnerUSD');
            $table->integer('exchangeRate');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prices');
    }
};
