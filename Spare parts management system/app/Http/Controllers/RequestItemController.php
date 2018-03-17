<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Stocks;
use App\Bills;
use App\Requestdevice;
use Auth;
use User;
use Hash;
class RequestItemController extends Controller
{
   
	public function submitITEM(Request $request)
    {

    	$bill = new Bills;
        $bill->id=$request->iduser;
        $bill->DetailBuy=$request->detailbuy;
        $bill->AllowerID=$request->iduser;
        $bill->Status='N';
        if($bill->save()) {
            foreach($request->listDevice as $index=>$value) {
                $store = new Requestdevice;
                $store->StockID = $value[0];
                $store->RequestItemQty = $value[2];
                $store->BillID = $bill->BillID;
                $store->save();
            }
        }
      
      
     return response()->json($request);
    }
}
