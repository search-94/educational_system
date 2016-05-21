<?php

	Validator::extend('alpha_num_spaces', function($attribute, $value)
	{
	    return preg_match('/^[\w\s]+$/u', $value);
	});

?>