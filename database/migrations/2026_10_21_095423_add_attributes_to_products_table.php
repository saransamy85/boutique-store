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
        Schema::table('products', function (Blueprint $table) {
            if (!Schema::hasColumn('products', 'size')) {
                $table->string('size', 100)->nullable()->after('description');
            }
            if (!Schema::hasColumn('products', 'color')) {
                $table->string('color', 100)->nullable()->after('size');
            }
            if (!Schema::hasColumn('products', 'discount')) {
                $table->decimal('discount', 10, 2)->nullable()->after('price');
            }
            if (!Schema::hasColumn('products', 'state')) {
                $table->string('state', 50)->default('active')->after('status');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $columnsToDrop = [];
            if (Schema::hasColumn('products', 'size')) {
                $columnsToDrop[] = 'size';
            }
            if (Schema::hasColumn('products', 'color')) {
                $columnsToDrop[] = 'color';
            }
            if (Schema::hasColumn('products', 'discount')) {
                $columnsToDrop[] = 'discount';
            }
            if (Schema::hasColumn('products', 'state')) {
                $columnsToDrop[] = 'state';
            }
            if (!empty($columnsToDrop)) {
                $table->dropColumn($columnsToDrop);
            }
        });
    }
};
