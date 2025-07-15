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
        Schema::create('fadhil_book_category', function (Blueprint $table) {
            $table->foreignId('fadhil_books_id')->constrained()->onDelete('cascade');
            $table->foreignId('fadhil_category_id')->constrained()->onDelete('cascade');
            $table->primary(['fadhil_books_id', 'fadhil_category_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fadhil_book_category_pivot');
    }
};
