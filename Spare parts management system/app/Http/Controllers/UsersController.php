<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use User;
use Hash;
use App\Users;
class UsersController extends Controller
{
    public function login(){
          Auth::logout();
       return view('sdm2.login');
    }
    public function loginadmin(){
          Auth::logout();
       return view('sdm2.loginadmin');
    }
    public function getloginuser(Request $request)
    {
     /*   dd($request);*/
    	$data = [
    		'username' => $request->input('username'),
    		'password' => $request->input('password'),
            'status'=> 'Y'
    	];
        /*dd($data);*/
    	if(Auth::attempt($data)) {
          return redirect('/requestitem');
    		
    	} else {
             return redirect('/login')->with('status', '**กรุณาตรวขสอบข้อมูลให้ถูกต้อง/รอผู้ดูแลระบบอนุมติ**');
    	}
    }

    public function getloginaddmin(Request $request)
    {
     /*   dd($request);*/
        $data = [
            'username' => $request->input('username'),
            'password' => $request->input('password'),
            'status' => 'Y'
        ];
        
        if(Auth::attempt($data)) {
            /*dd($data);*/
          return redirect('/billrequest');
            
        } else {
            
             return redirect('/loginadmin')->with('status', '**กรุณาตรวขสอบข้อมูลให้ถูกต้อง/รอผู้ดูแลระบบอนุมติ**');
        }
    }
    public function logout()
    {
    	Auth::logout();
    	return redirect('/');
    }

    public function listuser()
    {
        if( !(Auth::check() && ( (Auth::user()->type == 'admin')) || (Auth::user()->type == 'superadmin') ) )
        {
            Auth::logout();
            return redirect('/loginadmin')->with('status', '**กรุณาตรวขสอบข้อมูลให้ถูกต้อง/รอผู้ดูแลระบบอนุมติ**');
        }
     
        $Users = Users::where('status','N')->where('type','user')->orderBy('created_at', 'desc')->get();
        $Users2 = Users::where('status','Y')->where('type','user')->get();
       /* dd($Users2);*/
       
       return view('sdm2.listuser')->with('Users',$Users)->with('Users2',$Users2);
    }

    public function requestuser()
    {
       
       return view('sdm2.requestuser');
    }
    public function createuser(Request $request)
    {
        $checkemail = Users::where('email',$request->email)->first();
        if (!(is_null($checkemail))){
            return redirect()->back()->with('status', '** มีemail แล้ว กรุณาใช้email อื่น **')->withInput();
        }

        $temp = Users::where('username',$request->username)->first();
        if(!(is_null($temp))){
            return redirect()->back()->with('status', '** มีUsername แล้ว กรุณาใช้Username อื่น **')->withInput();
        }
        if($request->input('password')==''){
             return redirect()->back()->with('status', '**กรุณากรอกpassword ให้ตรงกัน **')->withInput();
        }
        if($request->input('password')!= $request->input('password_confirmation')){
            return redirect('/requestuser')->with('status', '**กรุณากรอกpassword ให้ตรงกัน **')->withInput();
        }
        $store = new Users;
        $store->name = $request->input('name');
        $store->username = $request->input('username');
        $store->email = $request->input('email');
        $store->password = Hash::make($request->input('password'));
        $store->type = $request->input('type');
        $store->status = 'N';
        $store->save();
        return redirect('/login')->with('status2', '**สมัครสมาชิกสำเร็จ รอผู้ดูแลอนุมัติ**');
       
       
    }
    public function yeslistuser(Request $request){
        $users = Users::find($request->id);
        $users->status ='Y';
        $users->save();
      
     return response()->json($request->id);
    }

    public function Nolistuser(Request $request){
        $user = Users::find($request->id);
        $user->delete();
       

      
     return response()->json($user);
    }

    public function seting_pass(Request $request){
        $users = Users::find($request->id);
        $users->password = Hash::make($request->input('password'));
        $users->save();
      
     return response()->json($request);
    }
    public function submitEditProfile(Request $request){
        $users = Users::find($request->id);
        $users->name = $request->name;
        $users->email = $request->email;
        $users->save();
      
     return response()->json($request);
    }

    public function updateProfile(Request $request){
       /* dd($request);*/
        $User = Users::find($request->id);
        $User->name=$request->name;
        $User->email=$request->email;
        $User->save();

    return redirect()->back()->with('status', '**เปลี่ยนข้อมูลส่วนตัวเรียบร้อย**');
    }

   


    public function listadmin()
    {
         if( !(Auth::check() && ( (Auth::user()->type == 'admin')) || (Auth::user()->type == 'superadmin') ) )
        {
            Auth::logout();
            return redirect('/loginadmin')->with('status', '**กรุณาตรวขสอบข้อมูลให้ถูกต้อง/รอผู้ดูแลระบบอนุมติ**');
        }
     
       
        $Users = Users::where('status','N')->where('type','admin')->orderBy('created_at', 'desc')->get();
        $Users2 = Users::where('status','Y')->where('type','admin')->get();
        // dd($Users);
       
       return view('sdm2.listadmin')->with('Users',$Users)->with('Users2',$Users2);
    }

    public function requestadmin()
    {
       
       return view('sdm2.requestadmin');
    }

    public function createadmin(Request $request)
    {
        //dd($request);
    $checkemail = Users::where('email',$request->email)->first();
        
        if (!(is_null($checkemail))){
            return redirect()->back()->with('status', '** มีemail แล้ว กรุณาใช้email อื่น **')->withInput();
        }
          /*dd($request);*/
         $temp = Users::where('username',$request->username)->first();

        if(!(is_null($temp))){

            return redirect()->back()->with('status', '** มีUsername แล้ว กรุณาใช้Username อื่น **')->withInput();
        }
       
        if($request->input('password')==''){
             return redirect()->back()->with('status', '**กรุณากรอกpassword ให้ตรงกัน **')->withInput();
        }
        if($request->input('password')!= $request->input('password_confirmation')){
            return redirect('/requestadmin')->with('status', '**กรุณากรอกpassword ให้ตรงกัน **')->withInput();
        }
        $store = new Users;
        $store->name = $request->input('name');// หรือจะใช้ $request->'name ได้เหมือนกัน
        $store->username = $request->input('username');
        $store->email = $request->input('email');
        $store->password = Hash::make($request->input('password'));
        $store->type = $request->input('type');
        $store->status = 'N';
        $store->save();
        return redirect('/loginadmin')->with('status', '**สมัครสมาชิกสำเร็จ รอผู้ดูแลอนุมัติ**');
       
       
    }



}
