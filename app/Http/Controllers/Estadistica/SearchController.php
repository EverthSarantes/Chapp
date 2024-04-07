<?php

namespace App\Http\Controllers\Estadistica;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $request->validate([
            'conditions' => 'required',
            'table' => 'required',
            'fiels_amount' => 'required'
        ]);
        
        $query = DB::table($request->table)->take($request->fiels_amount);

        if($request->conditions == 1)
        {
            foreach ($request->condition_column as $key => $column) {
                $query->where($column, $request->condition_operator[$key], $request->condition_value[$key]);
            }
        }

        if($request->order == 'ASC')
        {
            $query->orderBy($request->order_column);
        }
        else if($request->order == 'DESC')
        {
            $query->orderByDesc($request->order_column);   
        }

        $columns = $request->except('_token', 'table', 'fiels_amount', 'order', 'order_column', 'conditions', 'condition_column', 'condition_operator', 'condition_value', 'operation', 'operation_column');
        if(count($columns) > 0)
        {
            $query->select(array_values($columns));
        }
        else
        {
            $query->select('*');
        }
        
        $operation = $request->operation;

        $result = [];

        switch ($operation) {
            case 'get':
                $result = $query->get();
                break;
            
            case 'first':
                $result = collect([$query->first()]);
                break;

            case 'last':
                $result = collect([$query->latest()->first()]);
                break;

            case 'count':
                $count = $query->count($request->operation_column);
                $result = collect([['Resultado' => $count]]);
                break;

            case 'sum':
                $sum = $query->sum($request->operation_column);
                $result = collect([['Resultado' => $sum]]);
                break;
            
            case 'avg':
                $avg = $query->avg($request->operation_column);
                $result = collect([['Resultado' => round($avg, 2)]]);
                break;
            
            case 'max':
                $max = $query->max($request->operation_column);
                $result = collect([['Resultado' => $max]]);
                break;
            
            case 'min':
                $min = $query->min($request->operation_column);
                $result = collect([['Resultado' => $min]]);
                break;
            case 'sql':
                $sql = $query->toSql();
                $result = collect([['Resultado' => $sql]]);
                break;
        }
        
        if($result->isEmpty()){
            return response()->json([
                'message' => 'No se encontraron registros',
                'data' => []
            ], 404);
        }

        return response()->json([
            'message' => 'Registros encontrados',
            'data' => $result
        ], 200);
    }
}
