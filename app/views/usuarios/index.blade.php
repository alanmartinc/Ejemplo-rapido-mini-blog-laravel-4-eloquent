@extends('layouts.master')

@section("title")
    <?php echo $title; ?>
@stop

@include('categorias.listar', array('categorias'=>$categorias))

@section("content")
<h2><?php echo $title; ?></h2>
<form action="<?php echo URL::to("/registrarse")?>" method="post">
    Nombre:
    <input type="text" value="" name="nombre" class="form-control"/>
    Apellidos:
    <input type="text" value="" name="apellidos" class="form-control"/>
    Correo electrónico:
    <input type="email" value="" name="email" class="form-control"/>
    Contraseña:
    <input type="password" value="" name="password" class="form-control"/>
    <br/>
    <input type="submit" value="Registrate" name="submit" class="btn btn-success"/>
</form>
@stop
