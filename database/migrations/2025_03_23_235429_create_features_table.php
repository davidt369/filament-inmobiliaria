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
        Schema::create('features', function (Blueprint $table) {

            // floors INT NOT NULL,
            // surfaceArea DECIMAL(10,2) NOT NULL,
            // builtArea DECIMAL(10,2) NOT NULL,
            // front DECIMAL(10,2) NOT NULL,
            // details TEXT NOT NULL
            $table->id();
            $table->integer('floors');
            $table->decimal('surfaceArea', 10, 2);
            $table->decimal('builtArea', 10, 2);
            $table->decimal('front', 10, 2);
            $table->text('details');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('features');
    }
};
