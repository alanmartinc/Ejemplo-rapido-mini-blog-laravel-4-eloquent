<?php
class Entrada extends Eloquent{
    protected $table = 'entradas';
    protected $primaryKey = 'id_entrada';

    public $timestamps = false;
    
    public function usuario(){
        return $this->belongsTo('Usuario');
    }
    
    public function categoria(){
        return $this->belongsTo('Categoria');
    }
    
}
?>
