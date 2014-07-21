@extends('layouts.master')

@section('title')
       {{{$title}}}
@stop

@include('categorias.listar', array('categorias'=>$categorias))

@section("content")
@if (Session::has('mensaje'))
    <div class="alert alert-success">{{ Session::get('mensaje') }}</div>
@endif
<?php
if(sizeof($entradas)>=1){
    foreach($entradas as $entrada){
    if(isset($entrada->usuario->nombre)){
        echo "Autor: ".$entrada->usuario->nombre; 
        echo "<br/>";
        echo "Categoria: ".$entrada->categoria->titulo; 
        echo "<br/>";
        echo $entrada->titulo; 
    }else{
        echo "Autor: ".$entrada->nombre; 
        echo "<br/>";
        echo "Categoria: ".$entrada->titulo_categoria; 
        echo "<br/>";
        echo $entrada->titulo_entrada;
    }

?>
    <br/>
    <?php if(Auth::check() && ($entrada->id_usuario==Auth::user()->id || (isset($entrada->usuario->id) && $entrada->usuario->id==Auth::user()->id))){?>
        <a href="<?php echo URL::to('entrada/editar/'.$entrada->id_entrada); ?>">Editar</a>
        <a href="<?php echo URL::to('entrada/eliminar/'.$entrada->id_entrada); ?>">Eliminar</a>
    <?php } ?>
    <hr/>
<?php
    }
}else{
?>
    <h1>No hay entradas en esta categoría</h1>
<?php
}
?>
    
<?php 
if(isset($_GET["busqueda"])){
    echo $entradas->appends(array('busqueda' => $busqueda))->links();
}else{
    echo $entradas->links(); 
}
?>
@stop