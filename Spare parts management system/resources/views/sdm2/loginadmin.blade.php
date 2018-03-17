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
    <br>
    <br>

    <div class="ui two column centered grid ">
      <div class=" ui segment column ">
        <div class="ui form ">
         @if (session('status2'))
            <center>
              <h4 style="color: red">{{ session('status2') }}</h4>
            </center>
         @endif
          <div class="ui red inverted segment">
            <center>
            <h3> <i class="lock icon"></i> เข้าสู่ระบบ (เฉพาะเจ้าหน้าที่เท่านั้น!!)</h3>
            </center>
          </div>

        <form action="{{ route('sdm2.loginadmin') }}" method="post">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="field required">
            <label>Username</label>
            <div class="ui left icon input">
              <i class="user icon"></i>
              <input type="text" name="username" placeholder="username"  required="" oninvalid="this.setCustomValidity('โปรดใส่ Username')" oninput="setCustomValidity('')">
            </div>
          </div>

          <div class="field required">
            <label>Password</label>
            <div class="ui left icon input">
              <i class="lock icon"></i>
              <input type="password" name="password" placeholder="Password"  required="" oninvalid="this.setCustomValidity('โปรดใส่ Password')" oninput="setCustomValidity('')">
            </div>
          </div>

           @if (session('status'))

              <center>
                <h4 style="color: red">{{ session('status') }}</h4>
              </center>

            
         @endif

       <center>
        <button class="ui blue button buttonLogin" type="submit">เข้าสู่ระบบ</button>
        </form>
        <br>
        <br>
        <a href="{{ route('sdm2.requestadmin')}}" class="ui black button  ">สมัครสมาชิก</a>
        </center>

    </div>
    
    <br>
    </div>
    </div>
    </div>
  
    
</body>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

@extends('layout3')
@section('button')
@stop
</html>