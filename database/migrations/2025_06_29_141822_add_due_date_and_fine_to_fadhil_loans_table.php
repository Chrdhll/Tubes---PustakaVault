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
        Schema::table('fadhil_loans', function (Blueprint $table) {
            $table->date('due_date')->after('loan_date');
            $table->decimal('fine_amount', 10, 2)->default(0)->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fadhil_loans', function (Blueprint $table) {
            $table->dropColumn(['due_date', 'fine_amount']);
        }); 
    }
};
