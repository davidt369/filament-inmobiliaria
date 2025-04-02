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
        Schema::create('locations', function (Blueprint $table) {

            // CREATE TABLE Locations (
            //     id CHAR(36) PRIMARY KEY,
            //     address VARCHAR(255) NOT NULL,
            //     locationUrl VARCHAR(255) NOT NULL,
            //     zone VARCHAR(100) NOT NULL
            // );
            $table->id();
            $table->string('address');
            $table->string('locationUrl');
            $table->string('zone');
            $table->string('seller_location');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
