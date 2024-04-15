<?php

namespace App\Http\Controllers\Estadistica;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tables;

class TablesController extends Controller
{
    public function getNames()
    {
        $tables = (new Tables())->getTablesNamesExcept();
        
        if(count($tables) == 0) {
            return response()->json([
                'message' => 'No se encontraron tablas',
                'data' => []
            ], 404);
        }

        return response()->json([
            'message' => 'Tablas encontradas',
            'data' => $tables
        ], 200);
    }

    public function getFields($table)
    {
        $fields = (new Tables())->getTableFields($table);
        
        if(count($fields) == 0) {
            return response()->json([
                'message' => 'No se encontraron campos',
                'data' => []
            ], 404);
        }

        return response()->json([
            'message' => 'Campos encontrados',
            'data' => $fields
        ], 200);
    }

    public function getRelations($table)
    {
        $relations = (new Tables())->getTableRelations($table);
        
        if(count($relations) == 0) {
            return response()->json([
                'message' => 'No se encontraron relaciones',
                'data' => []
            ], 404);
        }

        return response()->json([
            'message' => 'Relaciones encontradas',
            'data' => $relations
        ], 200);
    }
}
