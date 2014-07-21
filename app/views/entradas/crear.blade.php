@extends('layouts.master')

@section("title")
    <?php echo $title; ?>
@stop

@include('categorias.listar', array('categorias'=>$categorias))

@section("content")
<h2><?php echo $title; ?></h2>
<script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
<script>
        tinymce.init({selector:'textarea'});
</script>

<form action="" method="post">
   Titulo:
   @foreach($errors->get('titulo') as $error )
        {{ $error }}
   @endforeach
   <input type="text" name="titulo" class="form-control" value="<?php 
                        if(isset($entrada)){
                             echo $entrada->titulo;
                        }else{ echo Input::old("titulo"); } ?>"/>
   <input type="hidden" name="id" value="<?php  if(isset($id)){echo $id;} ?>"/>
   <br/>
   Categoria:
   <select name="categoria" class="form-control">
       <?php foreach($categorias as $categoria){ ?>
        <option value="<?php echo $categoria->id_categoria; ?>"
                <?php if(isset($entrada) && $entrada->categoria_id==$categoria->id_categoria){
                    echo "selected";
                } ?>><?php echo $categoria->titulo; ?></option>
       <?php } ?>
   </select>
   <br/>
   Contenido:
   @foreach($errors->get('contenido') as $error )
        {{ $error }}
   @endforeach
   <textarea class="form-control" name="contenido"><?php 
                        if(isset($entrada)){
                             echo $entrada->contenido;
                        }else{ echo Input::old("contenido"); } ?></textarea> 
   <br/>
   <input type="submit" name="submit" value="<?php echo $title; ?>" class="btn btn-success"/>
</form>
@stop
