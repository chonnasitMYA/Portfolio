<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Photos;
use Khill\Lavacharts\Lavacharts;
use App\Stocks;
use App\Bills;
use App\Requestdevice;

use App\Users;
use Auth;
use User;
use Hash;
class Sdm2Controller extends Controller
{
    public function info()
	{
		
		$photo = Photos::where('Status','Y')->get();
	
		/*dd($photo);*/
		$temp = array();
		if( sizeof($photo) == 0 ){
              $temp = array("photos/image.jpg");
             
        }else{
        	for ($i=0; $i < sizeof($photo) ; $i++) { 
        		$test=$photo[$i]->PhotoPath;
        		array_push($temp, $test);
        	}    
        }
		return view('sdm2.index')->with('Datas',$temp);




	}   
	public function test()
	{
		$total=Requestdevice::groupBy('StockID')
						->limit(5)
   						->orderBy('sum','desc')
   						->selectRaw('sum(RequestItemQty) as sum, StockID')
   						->pluck('sum','StockID');
	/*	dd($total);  */   
		
		$ListItem = array();
		foreach($total as $totals=>$value) {
			$testt = array();
			$item = Stocks::find($totals);
                array_push($testt, $value);
                array_push($testt, $item);
                array_push($ListItem,$testt);
        }
		/*dd($ListItem);*/
      
		


/*
      dd($arrayName);*/
		return view('sdm2.test')->with('ListItem',$ListItem);
	}   

}
