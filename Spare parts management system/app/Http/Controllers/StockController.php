<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Stocks;
use App\Photos;
use Auth;
use User;
use Hash;
use Intervention\Image\ImageManagerStatic as Image;

class StockController extends Controller
{
	public function index()
	{
		if( !(Auth::check() && ( (Auth::user()->type == 'admin')) || (Auth::user()->type == 'superadmin') ) )
        {
          	Auth::logout();
        	return redirect('/loginadmin');
        }

   		$Items = Stocks::orderBy('created_at', 'desc')->get();
   		

		$ListItem = array();
   		for($i = 0;$i<sizeof($Items);$i++)
        {
            $Array = array();
            $item = Stocks::find($Items[$i]->StockID);
            
            $photo = Photos::where('StockID',$Items[$i]->StockID)->first();
            array_push($Array,$item);
            $temp = array();
            if( is_null($photo)){
              $temp = array("photos/image.jpg");
              array_push($Array,$temp);
            }else{
              $temp = array($photo->PhotoPath);
              array_push($Array,$temp);
            }
           
            array_push($ListItem,$Array);
        }
		/*dd($ListItem);*/
		return view('sdm2.listItem')->with('ListItem',$ListItem)->with('select','all');
	}

	public function index2()
	{
		if(!(Auth::check()) )
         {
        
          Auth::logout();
        return redirect('/login');
            
        }
   		$Items = Stocks::orderBy('created_at', 'desc')->get();
		  $ListItem = array();
   		for($i = 0;$i<sizeof($Items);$i++)
        {
            
            if(($Items[$i]->DeviceAll) > 0){
            $Array = array();
            $item = Stocks::find($Items[$i]->StockID);
            
            $photo = Photos::where('StockID',$Items[$i]->StockID)->first();
            array_push($Array,$item);
            $temp = array();
            if( is_null($photo)){
              $temp = array("photos/image.jpg");
              array_push($Array,$temp);
            }else{
              $temp = array($photo->PhotoPath);
              array_push($Array,$temp);
            }
           
            array_push($ListItem,$Array);
        }
      }
   /*     dd($ListItem);*/
   $test='all';
        
		return view('sdm2.requestitem')->with('ListItem',$ListItem)->with('test',$test);
	}

  
 



	public function start(){
		if( !(Auth::check() && ( (Auth::user()->type == 'admin')) || (Auth::user()->type == 'superadmin') ) )
        {
            Auth::logout();
            return redirect('/loginadmin')->with('status', '**กรุณาตรวขสอบข้อมูลให้ถูกต้อง/รอผู้ดูแลระบบอนุมติ**');
        }

		return view('sdm2.addDevice');
	}

	public function show(Request $request)
	{
		if($request->select == 'all'){
        $Items = Stocks::orderBy('created_at', 'desc')->get();
        $ListItem = array();
        for($i = 0;$i<sizeof($Items);$i++)
        {
            $Array = array();
            $item = Stocks::find($Items[$i]->StockID);
            
            $photo = Photos::where('StockID',$Items[$i]->StockID)->first();
            array_push($Array,$item);
            $temp = array();
            if( is_null($photo)){
              $temp = array("photos/image.jpg");
              array_push($Array,$temp);
            }else{
              $temp = array($photo->PhotoPath);
              array_push($Array,$temp);
            }

            
            array_push($ListItem,$Array);
        }
    }else{
    		$typeSelect = Stocks::where('Type',$request->input('select'))->orderBy('created_at', 'desc')->get();
    		$ListItem = array();
    		
     		for($i = 0;$i<sizeof($typeSelect);$i++)
          {
              $Array = array();
              $item = Stocks::find($typeSelect[$i]->StockID);
             
            

              $photo = Photos::where('StockID',$typeSelect[$i]->StockID)->first();
              array_push($Array,$item);
              $temp = array();
              if( is_null($photo)){
                $temp = array("photos/image.jpg");
                array_push($Array,$temp);
              }else{
                $temp = array($photo->PhotoPath);
                array_push($Array,$temp);
              }


              array_push($ListItem,$Array);
          }
      }

		return view('sdm2.listItem')->with('ListItem',$ListItem)->with('select',$request->input('select'));
	}

	public function store(Request $request)
	{
		/*
		dd($request);*/
		if(is_null($request->DeviceName)){
         
            return redirect('/addDevice')->with('status', '** กรุณากรอกชื่ออุปกรณ์ **')->withInput();
        }
        if(is_null($request->DeviceAll)){
         
            return redirect('/addDevice')->with('status', '** กรุณากรอกจำนวนสินค้า **')->withInput();
        }
        if(is_null($request->Price)){
         
            return redirect('/addDevice')->with('status', '** กรุณากรอกราคาสินค้า **')->withInput();
        }
		$store = new Stocks;
		$store->DeviceName = $request->input('DeviceName');
		$store->DeviceSN =	$request->input('DeviceSN');
		$store->DevicePart = $request->input('DevicePart');
		$store->DeviceNo = $request->input('DeviceNo');
		$store->DeviceAll = $request->input('DeviceAll');
		$store->TypePrice = $request->input('TypePrice');
		$store->Type = $request->input('checked');
		$store->Price = $request->input('Price');
		$store->save();
    $free='Y';
		if(!$request->hasFile('photo')) { //!$request->hasFile('photo') >>!<<  == NULL
			$destination = 'photos/image.jpg';
      $free='N' ;
		}else{
			$photo = $request->file('photo');
      $destination = 'photos/'.$photo->getClientOriginalName();
      $intervention = Image::make($request->file('photo')->getRealPath());
			$intervention->resize(150,150);
			$intervention->save(public_path().'/'.$destination);

		}
		

		$photo = new Photos;
		$photo->PhotoPath = $destination;
    $photo->Status = $free;
		$photo->StockID = $store->StockID;
		$photo->save();

		return redirect('/addDevice')->with('status','**  เพิ่มวัสดุอุปกรณ์ลงระบบเรียบร้อย **');

	}
	public function editDevice(Request $request)
	{
		 
		 if( !(Auth::check() && ( (Auth::user()->type == 'admin')) || (Auth::user()->type == 'superadmin') ) )
        {
            Auth::logout();
            return redirect('/loginadmin')->with('status', '**กรุณาตรวขสอบข้อมูลให้ถูกต้อง/รอผู้ดูแลระบบอนุมติ**');
        }

   		$Items = Stocks::find($request->StockID);
   		/*$photo = Photos::find($request->StockID);*/
      $photo = Photos::where('StockID',$request->StockID)->first();
      /*dd($photo);*/
      $temp = array();
      array_push($temp,$Items);
      if( is_null($photo)){
          $aa = array("photos/image.jpg");
          array_push($temp,$aa); 
      }else{
          $aa = array($photo->PhotoPath);
          array_push($temp,$aa);
      }
   		/*
   		dd($temp);*/
   		/*dd($Items);*/
		return view('sdm2.editDevice')->with('temp',$temp);
	}
	public function updateDevice(Request $request)
	{
       /*
    dd($request);*/
     if( !(Auth::check() && ( (Auth::user()->type == 'admin')) || (Auth::user()->type == 'superadmin') ) )
        {
            Auth::logout();
            return redirect('/loginadmin')->with('status', '**กรุณาตรวขสอบข้อมูลให้ถูกต้อง/รอผู้ดูแลระบบอนุมติ**');
        }
   		$update = Stocks::find($request->StockID);
   		$update->DeviceName = $request->DeviceName;
   		$update->DeviceNo = $request->DeviceNo;
   		$update->DeviceSN = $request->DeviceSN;
   		$update->DevicePart = $request->DevicePart;
      $update->DeviceAll = $request->DeviceAll;
      $update->TypePrice = $request->TypePrice;
      $update->Type = $request->Type;
   		$update->Price = $request->Price;
   		$update->save();

      $photo = Photos::where('StockID',$request->StockID)->first();
     /* dd($photo);*/
      if( is_null($photo) ){
        /*dd('come');*/
        if( $request->hasFile('photo'))  {
        /*dd('wtf');*/
          $photo2 = new Photos;
          $photo = $request->file('photo');
          $destination2 = 'photos/'.$photo->getClientOriginalName();
          $intervention =  Image::make($request->file('photo')->getRealPath());
          $intervention->resize(150,150);
          $intervention->save(public_path().'/'.$destination2);
          $photo2->PhotoPath = $destination2;
          $photo2->StockID = $update->StockID;
          $free='Y';
          $photo2->Status = $free;
       
          $photo2->save();
          /*dd($photo2);*/
        }
      }else{

        if( $request->hasFile('photo'))  {
            
          $photo2 = Photos::where('StockID',$request->StockID)->first();
          $photo = $request->file('photo');
          $destination2 = 'photos/'.$photo->getClientOriginalName();
          $intervention =  Image::make($request->file('photo')->getRealPath());
          $intervention->resize(150,150);
          $intervention->save(public_path().'/'.$destination2);
          $photo2->PhotoPath = $destination2;
          $photo2->StockID = $update->StockID;
          $free='Y';
          $photo2->Status = $free;
       
          $photo2->save();
          

          

        }


       
      }

  

      
      

		return redirect()->route('sdm2.listItem');;
	}

}
