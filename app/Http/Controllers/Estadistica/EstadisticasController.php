<?php

namespace App\Http\Controllers\Estadistica;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\User;
use App\Models\Habilidad;
use App\Models\Profesion;
use App\Models\Proyecto;
use App\Models\Trabajo;
use App\Models\InfoLaboral;
use App\Models\Perfil;

class EstadisticasController extends Controller
{
    function getTopCategories($num = 5)
    {
        $categorias = Categoria::all();

        $data = [];
        foreach($categorias as $categoria)
        {
            $suma = 0;
            $suma += $categoria->habilidades->count();
            $suma += $categoria->profesiones->count();
            $suma += $categoria->proyectos->count();
            $suma += $categoria->trabajos->count();
            $suma += InfoLaboral::where('categoria_id', $categoria->id)->count();

            $data[] = [
                'nombre' => $categoria->nombre,
                'total' => $suma,
            ];
        }
        
        //seleccionar las 5 categorias que más se repiten
        usort($data, function ($a, $b) {
            return $b['total'] <=> $a['total'];
        });
        
        // Seleccionar solo los primeros 5 elementos
        $dataTop = array_slice($data, 0, $num);

        return $dataTop;
    }

    function getGenderCategoryCount()
    {
        $top3Categorias = $this->getTopCategories(5);

        $suma_total = [
            'M' => [
                $top3Categorias[0]['nombre'] => 0,
                $top3Categorias[1]['nombre'] => 0,
                $top3Categorias[2]['nombre'] => 0,
                $top3Categorias[3]['nombre'] => 0,
                $top3Categorias[4]['nombre'] => 0,
            ],
            'F' => [
                $top3Categorias[0]['nombre'] => 0,
                $top3Categorias[1]['nombre'] => 0,
                $top3Categorias[2]['nombre'] => 0,
                $top3Categorias[3]['nombre'] => 0,
                $top3Categorias[4]['nombre'] => 0,
            ],
        ];


        foreach($top3Categorias as $categoria){
            $habilidades_m = Habilidad::whereHas('categoria', function($query) use ($categoria){
                $query->where('nombre', $categoria['nombre']);
            })
            ->whereHas('user', function($query){
                $query->whereHas('perfil', function($query){
                    $query->where('sexo', 'M');
                });
            })->count();

            $profesiones_m = Profesion::whereHas('categoria', function($query) use ($categoria){
                $query->where('nombre', $categoria['nombre']);
            })
            ->whereHas('infoLaboral', function($query){
                $query->whereHas('user', function($query){
                    $query->whereHas('perfil', function($query){
                        $query->where('sexo', 'M');
                    });
                });
            })->count();

            $proyectos_m = Proyecto::whereHas('categoria', function($query) use ($categoria){
                $query->where('nombre', $categoria['nombre']);
            })
            ->whereHas('infoLaboral', function($query){
                $query->whereHas('user', function($query){
                    $query->whereHas('perfil', function($query){
                        $query->where('sexo', 'M');
                    });
                });
            })->count();

            $trabajos_m = Trabajo::whereHas('categoria', function($query) use ($categoria){
                $query->where('nombre', $categoria['nombre']);
            })
            ->whereHas('infoLaboral', function($query){
                $query->whereHas('user', function($query){
                    $query->whereHas('perfil', function($query){
                        $query->where('sexo', 'M');
                    });
                });
            })->count();

            $habilidades_f = Habilidad::whereHas('categoria', function($query) use ($categoria){
                $query->where('nombre', $categoria['nombre']);
            })
            ->whereHas('user', function($query){
                $query->whereHas('perfil', function($query){
                    $query->where('sexo', 'F');
                });
            })->count();

            $profesiones_f = Profesion::whereHas('categoria', function($query) use ($categoria){
                $query->where('nombre', $categoria['nombre']);
            })
            ->whereHas('infoLaboral', function($query){
                $query->whereHas('user', function($query){
                    $query->whereHas('perfil', function($query){
                        $query->where('sexo', 'F');
                    });
                });
            })->count();

            $proyectos_f = Proyecto::whereHas('categoria', function($query) use ($categoria){
                $query->where('nombre', $categoria['nombre']);
            })
            ->whereHas('infoLaboral', function($query){
                $query->whereHas('user', function($query){
                    $query->whereHas('perfil', function($query){
                        $query->where('sexo', 'F');
                    });
                });
            })->count();

            $trabajos_f = Trabajo::whereHas('categoria', function($query) use ($categoria){
                $query->where('nombre', $categoria['nombre']);
            })
            ->whereHas('infoLaboral', function($query){
                $query->whereHas('user', function($query){
                    $query->whereHas('perfil', function($query){
                        $query->where('sexo', 'F');
                    });
                });
            })->count();

            $suma_total['M'][$categoria['nombre']] +=  $habilidades_m + $profesiones_m + $proyectos_m + $trabajos_m;
            $suma_total['F'][$categoria['nombre']] +=  $habilidades_f + $profesiones_f + $proyectos_f + $trabajos_f;
        }

        return $suma_total;
    }

    function getSalaryProm()
    {
        $data = [
            '18-25' => [
                'M' => 0,
                'F' => 0,
            ],
            '26-35' => [
                'M' => 0,
                'F' => 0,
            ],
            '36-45' => [
                'M' => 0,
                'F' => 0,
            ],
            '46+' => [
                'M' => 0,
                'F' => 0,
            ],
        ];

        $perfils_25_M = Perfil::where('fecha_nacimiento', '>=', date('Y-m-d', strtotime('-25 years')))
        ->where('fecha_nacimiento', '<=', date('Y-m-d', strtotime('-18 years')))
        ->where('sexo', 'M')
        ->avg('expectativa_salarial');

        $perfils_25_F = Perfil::where('fecha_nacimiento', '>=', date('Y-m-d', strtotime('-25 years')))
        ->where('fecha_nacimiento', '<=', date('Y-m-d', strtotime('-18 years')))
        ->where('sexo', 'F')
        ->avg('expectativa_salarial');

        $perfils_35_M = Perfil::where('fecha_nacimiento', '>=', date('Y-m-d', strtotime('-35 years')))
        ->where('fecha_nacimiento', '<=', date('Y-m-d', strtotime('-26 years')))
        ->where('sexo', 'M')
        ->avg('expectativa_salarial');

        $perfils_35_F = Perfil::where('fecha_nacimiento', '>=', date('Y-m-d', strtotime('-35 years')))
        ->where('fecha_nacimiento', '<=', date('Y-m-d', strtotime('-26 years')))
        ->where('sexo', 'F')
        ->avg('expectativa_salarial');

        $perfils_45_M = Perfil::where('fecha_nacimiento', '>=', date('Y-m-d', strtotime('-45 years')))
        ->where('fecha_nacimiento', '<=', date('Y-m-d', strtotime('-36 years')))
        ->where('sexo', 'M')
        ->avg('expectativa_salarial');

        $perfils_45_F = Perfil::where('fecha_nacimiento', '>=', date('Y-m-d', strtotime('-45 years')))
        ->where('fecha_nacimiento', '<=', date('Y-m-d', strtotime('-36 years')))
        ->where('sexo', 'F')
        ->avg('expectativa_salarial');

        $perfils_46_M = Perfil::where('fecha_nacimiento', '<=', date('Y-m-d', strtotime('-46 years')))
        ->where('sexo', 'M')
        ->avg('expectativa_salarial');

        $perfils_46_F = Perfil::where('fecha_nacimiento', '<=', date('Y-m-d', strtotime('-46 years')))
        ->where('sexo', 'F')
        ->avg('expectativa_salarial');

        $data['18-25']['M'] = $perfils_25_M ?? 0;
        $data['18-25']['F'] = $perfils_25_F ?? 0;
        $data['26-35']['M'] = $perfils_35_M ?? 0;
        $data['26-35']['F'] = $perfils_35_F ?? 0;
        $data['36-45']['M'] = $perfils_45_M ?? 0;
        $data['36-45']['F'] = $perfils_45_F ?? 0;
        $data['46+']['M'] = $perfils_46_M ?? 0;
        $data['46+']['F'] = $perfils_46_F ?? 0;

        return $data;
    }

    public function index()
    {
        $suma_total = $this->getGenderCategoryCount();
        $dataTop5 = $this->getTopCategories(5);
        $promedio_salario = $this->getSalaryProm();

        return view('estadisticas.index', compact('dataTop5', 'suma_total', 'promedio_salario'));
    }
}
