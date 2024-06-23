<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;

class Tables
{
    protected $tables_except = 
    [
        'sqlite_sequence', 
        'migrations',
        'users',
        'password_reset_tokens',
        'sessions',
        'cache',
        'cache_locks',
        'jobs',
        'job_batches',
        'failed_jobs'
    ];

    protected $fiels_except = 
    [
        'id',
        'nombre',
        'telefono',
        'direccion',
        'user_id',
        'created_at',
        'updated_at',
    ];

    public function getTablesNames()
    {
        $tables = DB::select("SELECT name FROM sqlite_master WHERE type='table'");
        return $tables;
    }

    public function getTablesNamesExcept()
    {
        $tables = $this->getTablesNames();
        $tables = array_filter($tables, function($table){
            return !in_array($table->name, $this->tables_except);
        });

        return $tables;
    }

    public function getTableFields($table)
    {
        $fields = DB::select("PRAGMA table_info($table)");
        return $fields;
    }

    public function getTableFieldsExcept($table)
    {
        $fields = $this->getTableFields($table);
        $fields = array_filter($fields, function($field){
            return !in_array($field->name, $this->fiels_except);
        });

        return $fields;
    }

    public function getTableRelations($table_name)
    {
        // Obtener las relaciones de clave externa donde la tabla especificada es la tabla padre
        $tablas_padre = DB::select("
            SELECT * from pragma_foreign_key_list('$table_name');
        ");

        // Obtener las relaciones de clave externa donde la tabla especificada es la tabla hija
        $tablas_hija = DB::select("
            SELECT name
            FROM sqlite_master
            WHERE type='table'
            AND name != '$table_name'
            AND name IN (
                SELECT tbl_name
                FROM sqlite_master
                WHERE type='table' AND sql LIKE '%$table_name%'
            )
        ");
        
        return [
            'tablas_padre' => array_column($tablas_padre, 'table'),
            'tablas_hija' => array_column($tablas_hija, 'name')
        ];
    }
}
