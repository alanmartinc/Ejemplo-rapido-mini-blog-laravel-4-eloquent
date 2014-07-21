<?php
Validator::extend('alpha_spaces', function($attribute, $value){
return preg_match('/^[\pL\s]+$/u', $value);
});

Validator::extend('alpha_num_spaces', function($attribute, $value){
	return preg_match('/^([-a-z0-9_-ñ\s])+$/i', $value);
});

Validator::extend('hora', function($attribute, $value){
return preg_match('/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/', $value);
});
?>
