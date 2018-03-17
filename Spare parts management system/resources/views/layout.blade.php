<!DOCTYPE html>
<html>
<head>
		  <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" type="text/css" href="{{ asset('semantic2/semantic.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}"> 
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="https://cdn.jsdelivr.net/semantic-ui/2.2.10/semantic.min.js"></script>
      <script src="//cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script>
    <title> ระบบบริหารจัดการอะไหล่สำรอง</title>
</head>
<body>
  @if((Auth::user()->type=='admin') || ( Auth::user()->type== 'superadmin' ) )
  <div class="ui fixed  inverted large menu ">
    <a class="item" href="{{ route('sdm2.info')}}">
      <i class="big settings icon"></i>
        ระบบบริหารจัดการอะไหล่สำรอง
    </a>
    <div class="right menu">
      <div class="ui pointing dropdown link item ">
        <i class="newspaper icon"></i>
          คำร้องขอเบิกอุปกรณ์
        <i class="dropdown icon"></i>
        <div class="menu">
          <a class="item" href="{{ route('sdm2.billrequest')}}">
            <i class="file text outline icon"></i>ตรวจสอบคำร้องขอเบิกอุปกรณ์  
          </a>
          <a class="item" href="{{ route('sdm2.requestitem')}}">
            <i class="file  icon"></i>เบิกอุปกรณ์  
          </a>
          <a class="item" href="{{ route('sdm2.historybill')}}">
            <i class="folder open outline icon"></i>ประวัติคำร้อง  
          </a>
        </div>
      </div>

      <div class="ui pointing dropdown link item ">
        <i class="cubes icon"></i>วัสดุอุปกรณ์
        <i class="dropdown icon"></i>
          <div class="menu">
            <a class="item" href="{{ route('sdm2.listItem')}}"><i class="list layout icon"></i>วัสดุอุปกรณ์ในระบบ  </a>
            <a class="item" href="{{ route('sdm2.index')}}"><i class="database icon"></i>เพิ่มวัสดุอุปกรณ์  </a>
          </div>
      </div>
      <div class="ui pointing dropdown link item ">
        <i class="users icon"></i>จัดการบัญชีในระบบ
        <i class="dropdown icon"></i>
          <div class="menu">
            <a class="item" href="{{ route('sdm2.listadmin')}}"><i class="spy icon"></i>จัดการ admin  </a>
            <a class="item" href="{{ route('sdm2.listuser')}}"><i class="user icon"></i>จัดการ Users  </a>
          </div>
      </div>

      <div class="ui pointing dropdown link item ">
        <i class="list icon"></i>{{ Auth::user()->name }}<i class="dropdown icon"></i>
        <div class="menu">
         
          <a class="item editProfilelogin" data-id="{{ Auth::user()->id }}" data-name="{{ Auth::user()->name }}"  data-email="{{ Auth::user()->email }}"><i class="edit icon"></i>แก้ไขข้อมูลส่วนตัว</a>
          <a class="item" id="editpassword"><i class="settings icon"></i>เปลี่ยนPassword</a>
          <a class="item" href="/admin/guideadmin.pdf" download='guideadmin.pdf'><i class="warning sign icon"></i>คู่มือแนะนำการใช้เว็ปไซต์</a>
          <a class="item" href="{{ route('sdm2.logout')}}"><i class="sign out icon"></i>ออกจากระบบ</a>
        </div>
      </div>
            
     </div>
  </div>
  @else
  <div class="ui fixed  inverted large menu ">
        <a class="item" href="{{ route('sdm2.info')}}">
        <i class="big settings icon"></i>
          ระบบบริหารจัดการอะไหล่สำรอง
        </a>
        <div class="right menu">
       
        <div class="ui pointing dropdown link item ">
          <i class="newspaper icon"></i>
            เบิกอุปกรณ์
          <i class="dropdown icon"></i>
          <div class="menu">
              <a class="item" href="{{ route('sdm2.requestitem')}}"><i class="list layout icon"></i>เบิกวัสดุอุปกรณ์  </a>
            
            <a class="item" href="{{ route('sdm2.checkbill')}}"><i class="book  icon"></i>เช็คคำร้อง</a>
          </div>
        </div>


       
        <div class="ui pointing dropdown link item ">
          <i class="list icon"></i>{{ Auth::user()->name }}<i class="dropdown icon"></i>
          <div class="menu">
           
             <a class="item editProfilelogin" data-id="{{ Auth::user()->id }}" data-name="{{ Auth::user()->name }}"  data-email="{{ Auth::user()->email }}"><i class="edit icon"></i>แก้ไขข้อมูลส่วนตัว</a>
             <a class="item" id="editpassword"><i class="settings icon"></i>เปลี่ยรหัสผ่าน</a>
             <a class="item" href="/user/guideuser.pdf" download="guide.pdf"><i class="warning sign icon"></i>คู่มือแนะนำการใช้เว็ปไซต์</a>
            <a class="item" href="{{ route('sdm2.logout')}}"><i class="sign out icon"></i>ออกจากระบบ</a>
          </div>
        </div>
              
        </div>
      </div>
  @endif




  @yield('content')
    <div class="ui modal" id="editmodal">
      <i class="close icon"></i>
      <div class="header">
        แก้ไขรหัสผ่าน
      </div>

      <div class="content">
        <div class="ui form" style="width: 420px;margin:0px auto;">
          <div class="inline fields container">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" id="iduser" value="{{ Auth::user()->id }}">
            <div class="four wide field">
              <label>รหัสผ่าน&nbsp;&nbsp;:</label>
            </div>
            <div class="eleven wide field">
              <input type="password" id="passwordedit">
            </div>
          </div>
           
          <div class="inline fields container">
            <div class="four wide field">
              <label>ยืนยันรหัสผ่าน&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
            </div>
            <div class="eleven wide field">
              <input type="password"  id="passwordedit2">
            </div>
          </div>
        </div>
      </div>

      <div class="actions">
        <div class="ui black deny button" >
          ยกเลิก
        </div>
        <div class="ui positive right labeled icon button" id="confirmpassword">
          บันทึก
          <i class="checkmark icon"></i>
        </div>
      </div>
    </div>

    <div class="ui basic modal" id="message-pass-modal" >
      <i class="close icon"></i>
      <div class="ui icon header">
        <i class="checkmark box icon"></i>
          เปลี่ยนรหัสผ่านสำเร็จ
      </div>
      <div class="content">
        <center>
          <p>โปรดเข้าสู่ระบบด้วยรหัสผ่านใหม่ในครั้งต่อไป</p>
        </center>
      </div>
    </div>

    <div class="ui modal" id="editProfilelogin">
      <i class="close icon"></i>
      <div class="header">
        แก้ไขข้อมูลส่วนตัว   
        <div class="nameUser"></div>
      </div>
      <div class="content">
        <div class="ui form" style="width: 420px;margin:0px auto;">
          <div class="inline fields container">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" id="iduserlogin" value="" >
            <div class="four wide field">
              <label>ชื่อ-นามสกุล&nbsp;&nbsp;:</label>
            </div>
            <div class="eleven wide field">
              <input type="text" name="name" id="nameuserlogin" required>
            </div>
          </div>
          <div class="inline fields container">
            <div class="four wide field">
              <label>Email&nbsp;&nbsp;:</label>
            </div>
            <div class="eleven wide field">
              <input type="email" name="emaillogin" id="emaillogin" required>
            </div>
          </div>
        </div>
      </div>

      <div class="actions">
        <div class="ui black deny button" >
          ยกเลิก
        </div>
        <div class="ui positive right labeled icon button" id="editsubmitlogin">
          บันทึก
          <i class="checkmark icon"></i>
        </div>
      </div>
    </div>

      
  </body>
  <script type="text/javascript">
    $(document).ready(function(){
      $('.ui.dropdown').dropdown();

      $(document).on('click', '.editProfilelogin', function() {
        $('.nameUser').text($(this).data('name'));
        $('#iduserlogin').val($(this).data('id'));
        $('#nameuserlogin').val($(this).data('name'));
        $('#emaillogin').val($(this).data('email'));
        $('#editProfilelogin').modal('show');
      });
      $('.actions').on('click', '#editsubmitlogin', function() {
        if ( $('#emaillogin').val() == '' ) {
            alert('email ไม่ถูกต้อง');
        }else{
            $.ajax({
              type: 'post',
              url: '/submitEditProfile',
              data: {
                    '_token': $('input[name=_token]').val(),
                    'id': $('#iduserlogin').val(),
                    'name' : $('#nameuserlogin').val(),
                    'email' : $('#emaillogin').val()
              },
                success: function(data) {
                    alert('ยืนยันสำเร็จ');
                     location.reload();
                  },
                error: function(){
                    alert('มีemailนี้ในระบบ แล้ว กรุณาใช้email อื่น');
                  }

                })
        }     
      });

      $(document).on('click', '#editpassword', function() {
        $('#editmodal').modal('show');
      });

      $('.actions').on('click', '#confirmpassword', function() {
        if($('#passwordedit').val()!=$('#passwordedit2').val()){
          alert('รหัสผ่านไม่ถูกต้อง');
        }else{
              $.ajax({
                type: 'post',
                url: '/seting_pass',
                data: {
                  '_token': $('input[name=_token]').val(),
                  'id': $('#iduser').val(),
                  'email' : $('#email').val(),
                  'password' : $('#passwordedit').val()

                },
                success: function(data) {
                  console.log(data)
                  $('#message-pass-modal').modal('show');
                }
              })
        }
      });

    });

  </script>
  
</html>

