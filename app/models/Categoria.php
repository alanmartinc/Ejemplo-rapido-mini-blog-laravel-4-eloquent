<?php
class Categoria extends Eloquent{
    protected $table = 'categorias';
    protected $primaryKey = 'id_categoria';
    public $timestamps = false;
    
    public function entradas(){
        return $this->hasMany('Entrada');
    }

}
?>
