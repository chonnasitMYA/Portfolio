<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stocks extends Model
{
    protected $table = 'stocks';
	protected $primaryKey = 'StockID';
	public $timestamps = true;
}
