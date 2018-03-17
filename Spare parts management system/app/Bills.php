<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bills extends Model
{
   	protected $table = 'bills';
	protected $primaryKey = 'BillID';
	public $timestamps = true;

}
