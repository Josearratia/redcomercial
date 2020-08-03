<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Categoria;

class CategoriaController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /*determinar si es una peticion ajax para seguirdad*/
        if (!$request->ajax()) return redirect('/');

        $buscar =  $request->buscar;
        $criterio = $request->criterio;

        /*Si esta vacia la vriable busqueda que busque por categoria */
        if($buscar==''){
            $categorias = Categoria::orderBy('id', 'desc')->paginate(3);
        }
        else{
            $categorias = Categoria::where($criterio, 'like', '%'. $buscar .'%')->orderBy('id', 'desc')->paginate(3);
        }
        //$categorias = Categoria::paginate(2);

        return [
            'pagination' => [
                'total' => $categorias->total(),
                'current_page' => $categorias->currentPage(),
                'per_page' => $categorias->perPage(),
                'last_page' => $categorias->lastPage(),
                'from' => $categorias->firstItem(),
                'to' => $categorias->lastItem(),
            ],
            'categorias' => $categorias
        ];
    }

    /**MUESTRA TODAS LAS CATEGORIA QUE ESTAN ACTIVAS* */
    public function selectCategoria(Request $request){
        if (!$request->ajax()) return redirect('/');
        $categorias = Categoria::where('condicion', '=' ,'1')
        ->select('id','nombre_categoria')->orderBy('nombre_categoria', 'asc')->get();
        return ['categorias' => $categorias];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $categoria = new Categoria();
        $categoria->nombre_categoria = $request->nombre_categoria;
        $categoria->descripcion_categoria = $request->descripcion_categoria;
        $categoria->condicion = '1';
        $categoria->save();
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!$request->ajax()) return redirect('/');
        $categoria = Categoria::findOrFail($id);
        $categoria->nombre_categoria = $request->nombre_categoria;
        $categoria->descripcion_categoria = $request->descripcion_categoria;
        $categoria->condicion = '1';
        $categoria->save();
        /**/
    }

    public function desactivar(Request $request, $id)
    {
        if (!$request->ajax()) return redirect('/');
        $categoria = Categoria::findOrFail($id);
        $categoria->condicion = '0';
        $categoria->save();
    }

    public function activar(Request $request, $id)
    {
        if (!$request->ajax()) return redirect('/');
        $categoria = Categoria::findOrFail($id);
        $categoria->condicion = '1';
        $categoria->save();
    }

}
