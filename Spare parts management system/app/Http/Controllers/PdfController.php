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

class PdfController extends Controller
{
    public function formprint(Request $request){
       /* dd($request);*/
       
        $Datas = array();

        $billrequest = Bills::where('Status','Y')->whereYear('created_at',$request->year)->get();
        /*dd($billrequest);*/

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
                array_push($ArrStock, $temp3);
            }
            array_push($tem,$ArrStock);      
            array_push($Datas,$tem);
        }
         /*
           dd($Datas);*/

      
     return view('pdf.formprint')->with('Datas',$Datas)->with('year',$request->year);
    }

       public function formprintbill(Request $request){
      
       /*dd($request);*/
        $Datas = array();

        $billrequest = Bills::find($request->bill);
    /*    dd($billrequest);*/
            $tem = array();
            array_push($Datas, $billrequest);
            $usernamerequest = Users::find($billrequest->id); 
            array_push($Datas,$usernamerequest);
            $usernameallow= Users::find($billrequest->AllowerID); 
            array_push($Datas,$usernameallow);

            $detailRequest = Requestdevice::where('BillID',$billrequest->BillID)->get();          
          /*  dd($detailRequest);*/
            $ArrStock = array();
            for($j = 0; $j<sizeof($detailRequest) ;$j++)
            {
                $temp3 = array();
                array_push($temp3, $detailRequest[$j]->RequestItemQty);

                $stock = Stocks::where('StockID',$detailRequest[$j]->StockID)->get();
                array_push($temp3, $stock);
                array_push($ArrStock, $temp3);
            }
  
            array_push($Datas,$ArrStock);
        
         
           /*dd($Datas);*/

      
     return view('pdf.formprintbill')->with('Datas',$Datas);
    }

    public function formprintdevice(Request $request){
      
    
    if($request->select == 'all'){
        $Items = Stocks::orderBy('Type', 'asc')->get();
        $ListItem = array();
        for($i = 0;$i<sizeof($Items);$i++)
        {
      
            $item = Stocks::find($Items[$i]->StockID);

            array_push($ListItem,$item);
        }
    }else{
            $typeSelect = Stocks::where('Type',$request->input('select'))->get();
            $ListItem = array();
            for($i = 0;$i<sizeof($typeSelect);$i++)
          {
           
              $item = Stocks::find($typeSelect[$i]->StockID);

              array_push($ListItem,$item);
          }
      }
     /* dd($ListItem);
*/
     if($request->select == 'all'){
        $type='ทุกประเภท';
     }else{
         $type = $request->select;
     }
      
     return view('pdf.formprintdevice')->with('Datas',$ListItem)->with('type',$type)->with('select',$request->input('select'));
    }

    public function formprintgraph(Request $request){
        
        $totalall=Requestdevice::whereYear('created_at',$request->year)
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
        /*dd($ListItemAll);
*/
       $total=Requestdevice::whereYear('created_at',$request->year)
                        ->groupBy('StockID')
                        ->limit(5)
                        ->orderBy('sum','desc')
                        ->selectRaw('sum(RequestItemQty) as sum, StockID')
                        ->pluck('sum','StockID');
    
       /* dd($total);   */
        $ListItem = array();
        foreach($total as $totals=>$value) {
            $testt = array();
            $item = Stocks::find($totals);
                array_push($testt, $value);
                array_push($testt, $item);
                array_push($ListItem,$testt);
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
         /*
           dd($Datas);*/
           /*dd(sizeof($ListItem));*/
           if (sizeof($ListItem)  < 5) {
            $Status='N';
           }else{
            $Status='Y';
           }
           /*dd($Status);*/
      
    return view('pdf.formprintgraph')->with('ListItem',$ListItem)->with('year',$request->year)
            ->with('ListItemAll',$ListItemAll)->with('Status',$Status);
    }
}
