<?php

class CategoriasController extends BaseController {
    private $vistas="categorias/";
    
    public function categorias(){
        $categorias=Categoria::all();
        return $categorias;
    }
    
    public function getCrear(){
        if(!Auth::check()){
            return Redirect::to('/');   
        }
            return View::make($this->vistas.'crear',array(
                "title" => "Crear categoría",
                "categorias"=>  $this->categorias(),
            ));
    }
    
     public function postCrear(){
       if(!Auth::check()){
            return Redirect::to('/');   
        }
        //Definimos reglas de validación para este formulario
        $reglas =  array(
        'titulo'  => array('required',"alpha_num_spaces"),
        'descripcion'  => array('required')
        );

        //Las comprobamos
        $validator = Validator::make(Input::all(), $reglas);
        
        //Comprobamos si es válido
        if($validator->fails()){
            return Redirect::to('/categoria/crear')
                    ->withErrors($validator)
                    ->withInput();
        }else{
            if(Input::has('submit')){
              //Creamos una nueva entrada
              $categoria=new Categoria();
              $categoria->titulo=Input::get('titulo');
              $categoria->descripcion=Input::get('descripcion');
              $categoria->save();
              Session::flash('mensaje', 'Categoría creada correctamente');
            }
            return Redirect::to('/');
        }
    }//end action
    
      public function getEntradas($id=null){
            if($id==null){ return Redirect::to("/"); }
            $categoria=new Categoria();

//            $getIdCat=$categoria->where("titulo","=","Categoria 1")->first()->get(array("id_categoria"));
//            $id=$getIdCat[0]->id_categoria;

            $getEntradas=$categoria->find($id)->entradas()->orderBy('id_entrada', 'DESC')->paginate(5);
            $categoria=$categoria->find($id)->titulo;
           //$getEntradas=$categoria->all()->get();
            
            return View::make('entradas/index',array(
                "title"     =>  "Categoría: ".$categoria,
                "categorias"=>  $this->categorias(),
                "entradas"  =>  $getEntradas
            ));
          }
          
    
}
