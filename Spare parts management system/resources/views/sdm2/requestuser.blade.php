<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
       
         <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1">
       <link rel="stylesheet" type="text/css" href="semantic2/semantic.css">

       <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <title> ระบบบริหารจัดการอะไหล่สำรอง</title>
</head>
<body>
  <div class="ui fixed  inverted large menu ">
      <a class="item" href="{{ route('sdm2.info')}}">
      <i class="big settings icon"></i>
        ระบบบริหารจัดการอะไหล่สำรอง
      </a>
      <div class="right menu">
        <a class="item" href="{{ route('sdm2.login')}}"><i class="database icon"></i>เบิกวัสดุ  </a>
        <a class="item" href="{{ route('sdm2.loginadmin')}}"><i class="sign in icon"></i>Administrator</a>
      </div>
    </div>

    <br>
    <br>
   <br>
    <div class="ui centered grid">
    
    <div class="nine wide column box1" style="margin: 30px">
    <div class="ui inverted segment" style="background-color:#607d8b">
      <center><h3>สมัครสมาชิก</h3></center>
    </div>
      @if (session('status'))
        
      
              <center>
              <h4 style="color: red">{{ session('status') }}</h4>
            </center>
          
       @endif
      
      <form  action="{{ route('sdm2.createuser') }}" method="post" class="ui form">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
       <div class="field required">
          <label>ชื่อ-นามสกุล</label>
          <input type="text" name="name" value="{{ old('name') }}" required>
          
        
        </div>
        <div class="field required">
          <label>Email</label>
          <input type="email" name="email" value="{{ old('email') }}" required>
          <span class="help-block"></span>
        </div>
        <input type="hidden" name="type" value="user"> 
        <div class="field required">
          <label>Username</label>
          <input type="text" name="username" value="{{ old('username') }}" required>
          
        </div>
        <div class="field required">
          <label>สร้างรหัสผ่าน</label>
          <input type="password" name="password" required>
          
        </div>
        <div class="field required">
          <label>ยืนยันรหัสผ่าน</label>
          <input type="password" name="password_confirmation" required>
          
        </div>
        <div class="ui negative message">
          <li>กรุณณาตรวจสอบข้อมูลให้ถูกต้อง</li>
          <li>กรุณาใส่ชื่อนามสกุลให้ครบถ้วน</li>
          <li>Username จะถูกใช้ในการเข้าสู่ระบบ</li>
          
        
          
        </div>  

        <p class="error text-center alert alert-danger hidden"></p>
        <center>
        <button class="ui green button" type="submit"add">ยืนยันการสมัคร</button>
        </center>
      </form>
    </div>
  
    </div>
    <br>
    <br>
    @extends('layout3')
@section('button')
@stop
</body>
</html>