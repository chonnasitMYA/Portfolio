<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Stocks;
use App\Bills;
use App\Requestdevice;

use App\Users;
use Auth;
use User;
use Hash;
use Excel;
class ExcelController extends Controller
{
	

   public function exportHighRequest(Request $request)
	{


		Excel::create('exportHighRequest', function($excel) use($request){
			$excel->sheet('exportHighRequest', function($sheet) use($request){
	        $totalall = Requestdevice::whereYear('created_at',$request->year)
	                        ->groupBy('StockID')
	                        ->orderBy('sum','desc')
	                        ->selectRaw('sum(RequestItemQty) as sum, StockID')
	                        ->pluck('sum','StockID');
	        $ListItemAll = array();
	        foreach($totalall as $totals2=>$value2) {
	            $testt2 = array();
	            $item = Stocks::find($totals2);
	                array_push($testt2, $value2);
	                array_push($testt2, $item);
	                array_push($ListItemAll,$testt2);
	            }
	            
	            $find2= Stocks::get();
	           
	            
	            for( $i = 0 ; $i < sizeof($find2) ; $i++){
	            	
	            	 $check= -99;
	            	for($t = 0 ; $t < sizeof($ListItemAll) ; $t++){
	            		if($ListItemAll[$t][1]->StockID == $find2[$i]->StockID){
	            			$check =1;
	            		}
	            	}
	            	if($check==1){
	            		$testt3 = array();
	            		 array_push($testt3, 0);
		                array_push($testt3, $find2[$i]);
		                array_push($ListItemAll,$testt3);
	            	}


	            }
	          
					$sheet->mergeCells('A1:G1');
					$sheet->mergeCells('A2:G2');
					$sheet->mergeCells('A3:G3');
			 		$sheet->loadView('excel.exportHighRequest')->with('ListItemAll',$ListItemAll)->with('year',$request->year);
				});
			
		})->export('xls');
	}

	public function exportDeviceAll(Request $request)
	{
		

		Excel::create('ListDevice', function($excel) use($request){
			$excel->sheet('ListDevice', function($sheet) use($request){

	        if($request->select == 'all'){
		        $Items = Stocks::orderBy('Type','desc')->get();
		        $ListItem = array();
		        for($i = 0;$i<sizeof($Items);$i++)
		        {
		            $Array = array();
		            $item = Stocks::find($Items[$i]->StockID);
		         
		            array_push($Array,$item);
		         
		            array_push($ListItem,$Array);
		        }
		    }else{
		    		$typeSelect = Stocks::where('Type',$request->input('select'))->get();
		    		$ListItem = array();
		    		
		     		for($i = 0;$i<sizeof($typeSelect);$i++)
		          {
		              $Array = array();
		              $item = Stocks::find($typeSelect[$i]->StockID);
		           
		              array_push($Array,$item);
		            
		              array_push($ListItem,$Array);
		          }
		      }
	          
					$sheet->mergeCells('A1:G1');
					$sheet->mergeCells('A2:G2');
					$sheet->mergeCells('A3:G3');
			 		$sheet->loadView('excel.exportDeviceAll')->with('ListItem',$ListItem)->with('select',$request->input('select'));
				});
			
		})->export('xls');
	}

	
}
