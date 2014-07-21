<?php
class Usuario extends Eloquent{
    
    protected $table = 'usuarios';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function entradas(){
        return $this->hasMany('Entrada');
    }
    
}
?>
