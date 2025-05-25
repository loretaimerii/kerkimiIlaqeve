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
        Schema::create('ilaqet', function (Blueprint $table) {
            $table->id();
            $table->string('ndc_code');
            $table->string('brand_name');
            $table->string('generic_name');
            $table->string('labeler_name');
            $table->string('product_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ilaqet');
    }
};
