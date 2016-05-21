<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;
class Period extends Eloquent {
	use SoftDeletingTrait;
 	protected $dates = ['deleted_at'];
	protected $table = 'periods';

}



?>