<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class TabelasEColunas extends Command
{
    protected $signature = 'tabelas:colunas';
    protected $description = 'Lista todas as tabelas e suas colunas do banco de dados';

    public function handle()
    {
        $tables = DB::select('SHOW TABLES');
        $dbName = env('DB_DATABASE');
        $key = 'Tables_in_' . $dbName;

        foreach ($tables as $table) {
            $tableName = $table->$key;
            $this->info("📦 Tabela: $tableName");

            $columns = DB::select("SHOW COLUMNS FROM `$tableName`");
            foreach ($columns as $col) {
                $this->line("   - {$col->Field} ({$col->Type})");
            }

            $this->line("");
        }
    }
}
