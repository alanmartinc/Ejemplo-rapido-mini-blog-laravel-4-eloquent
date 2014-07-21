@extends('layouts.master')

@section("title")
    <?php echo $title; ?>
@stop

@include('categorias.listar', array('categorias'=>$categorias))

@section("content")
<h2><?php echo $title; ?></h2>

<form action="" method="post">
   Nombre:
   @foreach($errors->get('titulo') as $error )
        {{ $error }}
   @endforeach
   <input type="text" name="titulo" class="form-control"/> 
   <br/>
   Descripción:
   @foreach($errors->get('descripcion') as $error )
        {{ $error }}
   @endforeach
   <textarea class="form-control" name="descripcion"></textarea> 
   <br/>
   <input type="submit" name="submit" value="Crear" class="btn btn-success"/>
</form>
@stop