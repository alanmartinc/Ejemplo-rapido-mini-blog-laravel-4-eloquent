<?php

class EntradasController extends BaseController {
    private $vistas="entradas/";

    public function categorias(){
        $categorias=Categoria::all();
        return $categorias;
    }
    
    public function getIndex(){
            
            $getEntradas=DB::table('entradas AS e')
                            ->join('categorias AS c', 'e.categoria_id', '=', 'c.id_categoria')
                            ->join('usuarios AS u', 'e.usuario_id', '=', 'u.id')
                            ->select("e.id_entrada",
                                     "e.titulo AS titulo_entrada", 
                                     "c.titulo as titulo_categoria",
                                     "u.nombre",
                                     "u.id as id_usuario")
                            ->orderBy("e.id_entrada", "DESC")
                            ->paginate(5);
            
        return View::make($this->vistas.'index',array(
            "title"     =>  "Mini blog con Laravel 4 Victor Robles",
            "categorias"=>  $this->categorias(),
            "entradas"  =>  $getEntradas
        ));
    }
    
    public function getCrear(){
        if(!Auth::check()){
            return Redirect::to('/');   
        }
        return View::make($this->vistas.'crear',array(
            "title"     =>  "Crear entrada",
            "categorias"=>  $this->categorias(),
        ));
    }
    
    public function postCrear(){
       if(!Auth::check()){
            return Redirect::to('/');   
        }
        //Definimos reglas de validación para este formulario
        $reglas =  array(
        'titulo'  => array('required','alpha_num_spaces'),
        'contenido'  => array('required')
        );

        //Las comprobamos
        $validator = Validator::make(Input::all(), $reglas);
        
        //Comprobamos si es válido
        if($validator->fails()){
            return Redirect::to('/entrada/crear')
                    ->withErrors($validator)
                    ->withInput();
        }else{
            if(Input::has('submit')){
              //Creamos una nueva entrada
              $entrada=new Entrada();
              $entrada->usuario_id=Auth::user()->id;
              $entrada->categoria_id=Input::get('categoria');
              $entrada->titulo=Input::get('titulo');
              $entrada->contenido=Input::get('contenido');
              $entrada->save();
              Session::flash('mensaje', 'Entrada creada correctamente');
            }
            return Redirect::to('/');
        }
    }//end action
    
    public function getEliminar($id){
        if(Auth::check()){ 
         $entrada=new Entrada();
         $entrada->find($id)->delete();
        }
        return Redirect::to('/');
    }
    
    public function getEditar($id){
        if(Auth::check()){
            $entrada=Entrada::find($id);
            return View::make($this->vistas.'crear',array(
                "title"     =>  "Editar entrada ".$id,
                "categorias"=>  $this->categorias(),
                "id"        =>  $id,
                "entrada"   =>  $entrada
            ));
        }else{
            return Redirect::to('/');   
        }
    }
    
    public function postEditar(){
        if(!Auth::check()){
            return Redirect::to('/');   
        }
        //Definimos reglas de validación para este formulario
        $reglas =  array(
        'titulo'  => array('required','alpha_num_spaces'),
        'contenido'  => array('required')
        );

        //Las comprobamos
        $validator = Validator::make(Input::all(), $reglas);
        
        //Comprobamos si es válido
        if($validator->fails()){
            return Redirect::to('/')
                    ->withErrors($validator)
                    ->withInput();
        }else{
            if(Input::has('submit')){
              //Creamos una nueva entrada
              $entrada=Entrada::find(Input::get('id'));
              $entrada->usuario_id=Auth::user()->id;
              $entrada->categoria_id=Input::get('categoria');
              $entrada->titulo=Input::get('titulo');
              $entrada->contenido=Input::get('contenido');
              $entrada->save();
            }
            return Redirect::to('/');
        }
    }
    
    public function getBuscar(){
        $busqueda=Input::get("busqueda");
        
        $categoria=new Categoria();
        $getEntradas=DB::table('entradas AS e')
                            ->join('categorias AS c', 'e.categoria_id', '=', 'c.id_categoria')
                            ->join('usuarios AS u', 'e.usuario_id', '=', 'u.id')
                            ->select("e.id_entrada",
                                     "e.titulo AS titulo_entrada", 
                                     "c.titulo as titulo_categoria",
                                     "u.nombre",
                                     "u.id as id_usuario")
                            ->where("e.titulo", "LIKE", "%".$busqueda."%")
                            ->orderBy("e.id_entrada", "DESC")
                            ->paginate(5);
    
        return View::make('entradas/index',array(
                "title"     =>  "Busqueda: ".$busqueda,
                "categorias"=>  $this->categorias(),
                "entradas"  =>  $getEntradas,
                "busqueda"  =>  $busqueda
            ));
    }

}
