<?php

namespace App\Http\Controllers;

use App\Models\CategoriaReceta;
use App\Models\Receta;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class InicioController extends Controller
{
    public function index()
    {

    	//Obteter las recetas mas nuevas
    	$nuevas = Receta::latest()->get();

    	//Obtener todas las categorias
    	$categorias = CategoriaReceta::all();

    	//Obtener recetas mas votadas
    	$votadas = Receta::withCount('likes')->orderBy('likes_count', 'DESC')->take(3)->get();

    	$recetas = [];
    	foreach($categorias as $categoria)
    	{
    		$recetas[Str::slug($categoria->nombre)][] = Receta::where('categoria_id', $categoria->id)->take(3)->get();
    	}
    	return view('inicio.index', compact('nuevas', 'recetas', 'votadas'));
    }
}
