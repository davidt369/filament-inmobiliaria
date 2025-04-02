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
        Schema::create('owners', function (Blueprint $table) {
            // id CHAR(36) PRIMARY KEY,
            // fullName VARCHAR(255) NOT NULL,
            // phone VARCHAR(20) NOT NULL,
            // identityCard VARCHAR(20) NOT NULL UNIQUE,
            // address VARCHAR(255) NOT NULL,
            // relativePhone VARCHAR(20) NOT NULL,
            // relativeName VARCHAR(255) NOT NULL,
            // origin VARCHAR(255) NOT NULL,
            // consignor VARCHAR(255) NOT NULL
            $table->id();
            $table->string('fullName');
            $table->string('phone');
            $table->string('identityCard')->unique();
            $table->string('address');
            $table->string('relativePhone');
            $table->string('relativeName');
            $table->string('origin');
            $table->string('consignor');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('owners');
    }
};
