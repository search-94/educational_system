<?php

	Validator::extend('alpha_num_spaces', function($attribute, $value)
	{
	    return preg_match('/^[\w\s]+$/u', $value);
	});

	Validator::extend('alpha_spaces', function($attribute, $value)
	{
	    return preg_match('/^([A-Za-zñáéíóúüÁÉÍÓÚ ]){2,30}$/', $value);
	});	

?>