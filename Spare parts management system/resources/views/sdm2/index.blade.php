<!DOCTYPE html>
<html>
<head>
		<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
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
 

    <div class="ui grid  ">
      <div class="two wide column"><center></center></div>
      <div class="twelve wide column box1">
        <center>
           <h1> <i class="cubes icon" style="width: auto;">  </i>ระบบบริหารจัดการอะไหล่สำรอง</h1>
           <h3>บันทึกข้อมูลการเบิกวัสดุอุปกรณ์ &nbsp;&nbsp;ทะเบียนวัดสุอุปกรณ์</h3>
            @foreach($Datas as $Data)
           <div class="w3-content w3-section" style="max-width: 320px; background: #f2f2f2;">
              <img class="mySlides w3-animate-fading" src="{{ asset($Data) }}"  style="width: 300px; height: 300px; padding: 20px">
            </div>
            @endforeach
        </center>
        <br>
        <div class="ui form box3">
          <div class="fields">
            <div class="eight wide field">
              <h3><i class="big list layout icon"></i>บันทึกข้อมูลการเบิกวัสดุอุปกรณ์</h3>
              <b>บันทึกข้อมูลการเบิกวัสดุอุปกรณ์</b>
              <p>บันทึกข้อมูลการเบิกวัสดุอุปกรณ์ แต่ละชนิดโดยแสดงตามวันที่ขอเบิก ข้อมูลการเบิกวัสดุอุปกรณ์ในอดีต</p>
            </div>
            <div class="eight wide field">
              <h3><i class="big file  icon"></i>ทะเบียนวัดสุอุปกรณ์</h3>
              <b>ทะเบียนวัดสุอุปกรณ์</b>
              <p>ระบบทะเบียนอุปกรณ์ จัดเก็บข้อมูล รายละเอียด สถานะอุปกรณ์แต่ละชนิด อุปกรณ์ประเภท  x-band s-band และ Mes Device</p>
            </div> 
          </div>
        </div>
      </div>

    </div>
    <br>
    <br>
 
     
  
   <script type="text/javascript">
       var myIndex = 0;
      carousel();
      function carousel() {
          var i;
          var x = document.getElementsByClassName("mySlides");
          for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";  
          }
          myIndex++;
          if (myIndex > x.length) {myIndex = 1}    
          x[myIndex-1].style.display = "block";  
          setTimeout(carousel, 10000);    
      }

   </script>
@extends('layout3')
@section('button')
@stop
</body>
</html>