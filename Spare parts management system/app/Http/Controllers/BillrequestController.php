<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Stocks;
use App\Bills;
use App\Requestdevice;
use App\Photos;
use App\Users;
use Auth;
use User;
use Hash;
class BillrequestController extends Controller
{
    
    public function index(){
    	if( !(Auth::check() && ( (Auth::user()->type == 'admin')) || (Auth::user()->type == 'superadmin') ) )
        {
            Auth::logout();
            return redirect('/loginadmin')->with('status', '**กรุณาตรวขสอบข้อมูลให้ถูกต้อง/รอผู้ดูแลระบบอนุมติ**');
        }


    	$Datas = array();
    	
    	$billrequest = Bills::where('Status','N')->orderBy('created_at', 'desc')->get();
    	/*$iduser=$billrequest[$i]->id;*/
       

       
    	for($i = 0; $i<sizeof($billrequest) ;$i++)
        {
        	
        	$tem = array();

            array_push($tem, $billrequest[$i]);

            $username = Users::where('id',$billrequest[$i]->id)->first(); 
            array_push($tem,$username);

            $detailRequest = Requestdevice::where('BillID',$billrequest[$i]->BillID)->get();          

        	$ArrStock = array();
        	for($j = 0; $j<sizeof($detailRequest) ;$j++)
	        {
                
                $temp3 = array();
                array_push($temp3, $detailRequest[$j]->RequestItemQty);

	        	$stock = Stocks::where('StockID',$detailRequest[$j]->StockID)->get();
                array_push($temp3, $stock);
                
                $photo = Photos::where('StockID',$detailRequest[$j]->StockID)->first();

               


                if( is_null($photo)){
                 $ttt = array("photos/image.jpg");
                  array_push($temp3,$ttt);
                }else{
                  $ttt = array($photo->PhotoPath);
                  array_push($temp3,$ttt);
                }
             

                array_push($ArrStock, $temp3);
            

	        }
        	array_push($tem,$ArrStock);

        	array_push($Datas,$tem);
  
           

        }
       /* array_push($Datas,Auth::user()->type);*/
        
      
    
    	return view('sdm2.billrequest')->with('Datas',$Datas);
    }
    public function yesBillRequest(Request $request){
        $BillID = Bills::find($request->id);
        $BillID->Status='Y';
        $BillID->AllowerID=Auth::user()->id;
        $BillID->save();
        $listdevice = Requestdevice::where('BillID',$request->id)->get();
        for($i=0 ; $i < sizeof($listdevice) ; $i++){
            $Device = Stocks::find($listdevice[$i]->StockID);
            $Device->DeviceAll = ($Device->DeviceAll)-($listdevice[$i]->RequestItemQty);
            $Device->save();
        }

        

      
     return response()->json($request);
    }

    public function NoBillRequest(Request $request){


        $BillID = Bills::find($request->id);
        $BillID->Status='S';
        $BillID->save();
       

      
     return response()->json($request);
    }

    public function checkbill(){
        if( !(Auth::check()) )
        {
            Auth::logout();
            return redirect('/loginadmin')->with('status', '**กรุณาตรวขสอบข้อมูลให้ถูกต้อง/รอผู้ดูแลระบบอนุมติ**');
        }
        
        $billrequest = Bills::where('id',Auth::user()->id)->orderBy('created_at', 'desc')->get();
        $Datas = array();
        for($i = 0; $i<sizeof($billrequest) ;$i++)
        {
            $tem = array();
            $username = Users::where('id',$billrequest[$i]->id)->first(); 
            array_push($tem, $billrequest[$i]);
            array_push($tem,$username);


            $detailRequest = Requestdevice::where('BillID',$billrequest[$i]->BillID)->get();
            $ArrStock = array();
            

            for($j = 0; $j<sizeof($detailRequest) ;$j++)
            {
                
                $temp3 = array();
                array_push($temp3, $detailRequest[$j]->RequestItemQty);

                $stock = Stocks::where('StockID',$detailRequest[$j]->StockID)->get();
                array_push($temp3, $stock);
                
              
                array_push($ArrStock, $temp3);
            }


            array_push($tem,$ArrStock);
            array_push($Datas,$tem);

        }
        /*dd($Datas);*/
       

        
      
    
        return view('sdm2.checkbill')->with('Datas',$Datas);
    }

    public function historybill(){

        if( !(Auth::check() && ( (Auth::user()->type == 'admin')) || (Auth::user()->type == 'superadmin') ) )
        {
            Auth::logout();
            return redirect('/loginadmin')->with('status', '**กรุณาตรวขสอบข้อมูลให้ถูกต้อง/รอผู้ดูแลระบบอนุมติ**');
        }

        $Datas = array();

        
        $billrequest = Bills::where('Status','Y')->orderBy('created_at', 'desc')->get();
       /* dd($billrequest);*/
        /*$iduser=$billrequest[$i]->id;*/
       
       
        for($i = 0; $i<sizeof($billrequest) ;$i++)
        {
            
            $tem = array();

            array_push($tem, $billrequest[$i]);

            $username = Users::where('id',$billrequest[$i]->id)->first(); 
            array_push($tem,$username);

            $detailRequest = Requestdevice::where('BillID',$billrequest[$i]->BillID)->get();          

            $ArrStock = array();
            for($j = 0; $j<sizeof($detailRequest) ;$j++)
            {
                
                $temp3 = array();
                array_push($temp3, $detailRequest[$j]->RequestItemQty);

                $stock = Stocks::where('StockID',$detailRequest[$j]->StockID)->get();
                array_push($temp3, $stock);
                
                $photo = Photos::where('StockID',$detailRequest[$j]->StockID)->get();

                array_push($temp3, $photo);
                array_push($ArrStock, $temp3);
            

            }
            array_push($tem,$ArrStock);

            $AllowerID = Users::find($billrequest[$i]->AllowerID); 
            array_push($tem,$AllowerID);
            array_push($Datas,$tem);
        }
         
           /* dd($Datas);*/
        return view('sdm2.historybill')->with('Datas',$Datas)->with('year','2017');
    }

    public function historybillyear(Request $request){
        /*dd($request);*/
        if( !(Auth::check() && ( (Auth::user()->type == 'admin')) || (Auth::user()->type == 'superadmin') ) )
        {
            Auth::logout();
            return redirect('/loginadmin')->with('status', '**กรุณาตรวขสอบข้อมูลให้ถูกต้อง/รอผู้ดูแลระบบอนุมติ**');
        }
        $Datas = array();

        
        $billrequest = Bills::where('Status','Y')->whereYear('created_at',$request->year)->orderBy('created_at', 'desc')->get();
       /* dd($billrequest);*/
        /*$iduser=$billrequest[$i]->id;*/
       
       
        for($i = 0; $i<sizeof($billrequest) ;$i++)
        {
            
            $tem = array();

            array_push($tem, $billrequest[$i]);

            $username = Users::where('id',$billrequest[$i]->id)->first(); 
            array_push($tem,$username);

            $detailRequest = Requestdevice::where('BillID',$billrequest[$i]->BillID)->get();          

            $ArrStock = array();
            for($j = 0; $j<sizeof($detailRequest) ;$j++)
            {
                
                $temp3 = array();
                array_push($temp3, $detailRequest[$j]->RequestItemQty);

                $stock = Stocks::where('StockID',$detailRequest[$j]->StockID)->get();
                array_push($temp3, $stock);
                
                $photo = Photos::where('StockID',$detailRequest[$j]->StockID)->get();

                array_push($temp3, $photo);
                array_push($ArrStock, $temp3);
            

            }
            array_push($tem,$ArrStock);

            $AllowerID = Users::find($billrequest[$i]->AllowerID); 
            array_push($tem,$AllowerID);
            array_push($Datas,$tem);
        }
         
         /*  dd($Datas);*/
        return view('sdm2.historybill')->with('Datas',$Datas)->with('year',$request->year);
    }
     
}
