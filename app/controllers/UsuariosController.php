<?php
class UsuariosController extends BaseController {
        private $vistas="usuarios/";

        public function categorias(){
            $categorias=Categoria::all();
            return $categorias;
        }
        
	public function index(){
		return View::make($this->vistas.'index',array(
                    "title"         => "Registrate",
                    "categorias"    => $this->categorias()
                ));
	}
        
        public function registro(){
        $reglas =  array(
                'nombre'        => array('required','alpha_spaces'),
                'apellidos'     => array('required','alpha_spaces'),
                'email'         => array('required','email'),
                'password'      => array('required','min:3')
            );
 
            $validator = Validator::make(Input::all(), $reglas);
            if($validator->fails()){
                return Redirect::to('/registro')
                                    ->withErrors($validator)
                                    ->withInput();
            }else{
                if(Input::get('submit')){
                    $fecha=date("Y-m-d");
                    $hora=date("H:i:s");
                    $password=Hash::make(Input::get("password"));
                    
                    //Crear usuario
                    $usuario=new Usuario();
                    $usuario->nombre=Input::get("nombre");
                    $usuario->apellidos=Input::get("apellidos");
                    $usuario->password=$password;
                    $usuario->email=Input::get("email");
                    $usuario->fecha_alta=$fecha;
                    $usuario->hora_alta=$hora;
                    $usuario->activo=1;
                    $usuario->save();
                    Session::flash('mensaje', 'Te has registrado correctamente');
                    return Redirect::to('/');
               }
            }
        }

}
