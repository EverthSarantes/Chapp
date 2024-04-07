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
        $fields = (new Tables())->getTableFieldsExcept($table);
        
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
}
