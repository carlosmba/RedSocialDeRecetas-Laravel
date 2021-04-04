<?php

namespace App\Http\Controllers;

use App\Models\CategoriaReceta;
use App\Models\Receta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class RecetaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show', 'search'] ]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuario = auth()->user();
        // $recetas = auth()->user()->recetas;

        $recetas = Receta::where('user_id', $usuario->id)->simplePaginate(2);

        return view('recetas.index')->with('recetas', $recetas)->with('usuario', $usuario);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Obtener categorias (sin modelo)
        // $categorias = DB::table('categoria_recetas')->get()->pluck('nombre', 'id');

        //Obtener categorias (con modelo)

        $categorias = CategoriaReceta::all(['id', 'nombre']);


        return view('recetas.create')->with('categorias', $categorias);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //Obterner la ruta de la imagen
        $path = $request['imagen']->store('upload-recetas', 'public');

        $data = request()->validate([
            'titulo' => 'required | min:6',
            'categoria' => 'required',
            'ingredientes' => 'required',
            'preparacion' => 'required',
            'imagen' => 'required | image',
        ]);

        //Redimensionar la imagen
        $img = Image::make(public_path("storage/$path"))->fit(1000,550);
        $img->save();

        //Insertar registro (sin modelo)
        // DB::table('recetas')->insert([
        //     'titulo' => $data['titulo'],
        //     'ingredientes' => $data['ingredientes'],
        //     'preparacion' => $data['preparacion'],
        //     'imagen' => $path,
        //     'user_id' => Auth::user()->id,
        //     'categoria_id' => $data['categoria'],
        // ]);

        //Insertar registro (con modelo)
        auth()->user()->recetas()->create([
            'titulo' => $data['titulo'],
            'ingredientes' => $data['ingredientes'],
            'preparacion' => $data['preparacion'],
            'imagen' => $path,
            'categoria_id' => $data['categoria'],
        ]);


        //Redireccionar
        return redirect()->action([RecetaController::class, 'index']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function show(Receta $receta)
    {
        // Obtener si el usuario actual le gusta la receta y esta autentificado
        $like = ( auth()->user() ) ? auth()->user()->iLike->contains($receta->id) : false;

        //Obtener la cantidad de likes que tiene una receta

        $likes = $receta->likes->count();

        return view('recetas.show', compact('receta', 'like', 'likes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function edit(Receta $receta)
    {
        $categorias = CategoriaReceta::all(['id', 'nombre']);
        return view('recetas.edit', compact('categorias', 'receta'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Receta $receta)
    {
        //Revisa el policy
        $this->authorize('update', $receta);

        $data = request()->validate([
            'titulo' => 'required | min:6',
            'categoria' => 'required',
            'ingredientes' => 'required',
            'preparacion' => 'required',
        ]);

        $receta->titulo = $data['titulo'];
        $receta->categoria_id = $data['categoria'];
        $receta->ingredientes = $data['ingredientes'];
        $receta->preparacion = $data['preparacion'];

        if(request('imagen')){
            $path = $request['imagen']->store('upload-recetas', 'public');

             //Redimensionar la imagen
            $img = Image::make(public_path("storage/$path"))->fit(1000,550);
            $img->save();
            $receta->imagen = $path;
        }

        $receta->save();

        return redirect()->action([RecetaController::class, 'index']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Receta $receta)
    {

        $this->authorize('delete', $receta);
        $receta->delete();

        return redirect()->action([RecetaController::class, 'index']);
    }

    public function search(Request $request)
    {
        $busqueda = $request['buscar'];
        $recetas = Receta::where('titulo', 'like', '%' . $busqueda . '%')->paginate(5);
        $recetas->appends(['buscar' => $busqueda]);

        return view('busqueda.show', compact('recetas', 'busqueda'));
    }
}
