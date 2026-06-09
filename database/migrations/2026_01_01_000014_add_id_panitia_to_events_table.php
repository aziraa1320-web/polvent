<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Add id_panitia column to events table.
     * This tracks which panitia owns the event (for ownership-based access control).
     */
    public function up(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->foreignId('id_panitia')
                ->nullable()
                ->after('created_by')
                ->constrained('users')
                ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropForeign(['id_panitia']);
            $table->dropColumn('id_panitia');
        });
    }
};
