@section("categorias")
<?php
foreach($categorias as $categoria){
?>
    <li><a href="<?php echo URL::to('/categoria/entradas/'.$categoria->id_categoria); ?>"><?php echo $categoria->titulo;?></a></li>
<?php 
}
?>
@stop
