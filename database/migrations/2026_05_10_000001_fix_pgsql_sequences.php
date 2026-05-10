<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Fix PostgreSQL sequences for all tables with auto-increment id.
     * This is needed when migrating data from MySQL to PostgreSQL,
     * because MySQL auto_increment doesn't create PostgreSQL sequences.
     */
    public function up(): void
    {
        // Only run on PostgreSQL
        if (DB::connection()->getDriverName() !== 'pgsql') {
            return;
        }

        $tables = [
            'users',
            'categories',
            'products',
            'cart_items',
            'orders',
            'order_items',
            'jobs',
            'failed_jobs',
        ];

        foreach ($tables as $table) {
            // Check if the table exists
            if (!DB::getSchemaBuilder()->hasTable($table)) {
                continue;
            }

            $sequenceName = "{$table}_id_seq";

            // Create the sequence if it doesn't exist
            DB::statement("CREATE SEQUENCE IF NOT EXISTS {$sequenceName}");

            // Set the next value based on the current max id
            $maxId = DB::table($table)->max('id') ?? 0;
            DB::statement("SELECT setval('{$sequenceName}', " . ($maxId + 1) . ", false)");

            // Set the default value for the id column to use the sequence
            DB::statement("ALTER TABLE {$table} ALTER COLUMN id SET DEFAULT nextval('{$sequenceName}')");

            // Bind the sequence to the column
            DB::statement("ALTER SEQUENCE {$sequenceName} OWNED BY {$table}.id");
        }
    }

    public function down(): void
    {
        // Nothing to reverse - sequences are harmless
    }
};
