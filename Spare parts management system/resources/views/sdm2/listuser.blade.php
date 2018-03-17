@extends('layout3')
@section('button')
@extends('layout')

@section('content')
    <br>
    <br>
   <br>
    
    <br>
    <br>
      

    <div class="ui centered grid" >
      <div class="ui fifteen wide column box1   ">

        <div class="ui grey inverted segment ">
        <h3>คำร้องขอเข้าใช้บริการ</h3>
        </div>
        
          <table class="ui celled table  " >

            <thead>
              <tr>
             
              <th>#</th>
              <th>ชื่อ-นามสกุล</th>
            
              <th>Username</th>
              <th>E-mail</th>
              <th>รายละเอียด</th>
            </tr>
            </thead>
            <tbody>
            <?php $i=1 ?>
            @foreach($Users as $User)
            
              <tr>
                <td>{{$i++}}</td>
                <td>{{$User->name}} </td>
                <td>{{$User->username}} </td>

                <td>{{$User->email}}</td>
                
                 
                  <td>
                    <div class="ui buttons" style="font-size: 10px !important;">
                        <button class="ui green button yes-allow" data-id="{{$User->id}}" style="font-size: 12px !important;">อนุมัติ</button>
                        <div class="or"></div>
                        <button class="ui yellow button No-allow" data-id="{{$User->id}}" style="font-size: 12px !important;">ปฏิเสธ</button>
                    </div>
                  </td>
                  </tr>
                  @endforeach
               
            </tbody>
            
          </table>
          <br>
          <hr>
          <br>
           
        <div class="ui grey inverted segment ">
        <h3>บัญชี User ที่มีในระบบ</h3>
        </div>
        
          <table class="ui celled table  " >

            <thead>
              <tr>
             
              <th>#</th>
              <th>ชื่อ-นามสกุล</th>
            
              <th>Username</th>
              <th>E-mail</th>
              <th>รายละเอียด</th>
             
            </tr>
            </thead>
            <tbody>
            <?php $i=1 ?>
            @foreach($Users2 as $Users2)
            
              <tr>
                <td>{{$i++}}</td>
                <td>{{$Users2->name}} </td>
                <td>{{$Users2->username}} </td>

                <td>{{$Users2->email}}</td>
                 <td>
                    <div class="ui buttons" style="font-size: 10px !important;">
                        <button class="ui red button editpasswordUser" data-id="{{$Users2->id}}" data-name="{{$Users2->name}}" style="font-size: 12px !important;">แก้ไข Password</button>
                        <div class="or"></div>
                        <button class="ui olive button editProfileuser2" data-id="{{$Users2->id}}" data-name="{{$Users2->name}}"  data-email="{{$Users2->email}}" style="font-size: 12px !important;">แก้ไขข้อมูลส่วนตัว</button>
                    </div>
                  </td>
                  </tr>
                  @endforeach

               
            </tbody>
            
          </table>
          <br>
          <br>
        </div> 


    </div>


<div class="ui basic modal" id="yes-allow" >
  <i class="close icon"></i>
  <div class="ui icon header">
     <i class="check square icon"></i>
      <div class="match_temp"></div>
      ยืนยันการอนุมัติ 
    </div>
    <div class="content">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <center>
      <p>โปรดตรวจสอบข้อมูลให้ถูกต้องก่อนยืนยัน</p></center>
    </div>
    <div class="actions">
      <div class="ui red basic cancel inverted button">
        <i class="remove icon"></i>
        ยกเลิก
      </div>
      <div class="ui green ok inverted button yes-action">
        <i class="checkmark icon"></i>
        ยืนยันการอนุมัติ
      </div>
    </div>
</div>

<div class="ui basic modal" id="No-allow" >
  <i class="close icon"></i>
  <div class="ui icon header">
     <i class="minus square icon"></i>
      <div class="match_temp2"></div>
      ยืนยันการปฏิเสธ 
    </div>
    <div class="content">
    <center>
      <p>โปรดตรวจสอบข้อมูลให้ถูกต้องก่อนปฏิเสธ</p></center>
    </div>
    <div class="actions">
      <div class="ui red basic cancel inverted button">
        <i class="remove icon"></i>
        ยกเลิก
      </div>
      <div class="ui green ok inverted button no-action">
        <i class="checkmark icon"></i>
        ยืนยันการปฏิเสธ
      </div>
    </div>
</div>
    <br>
    <br>



<div class="ui modal" id="editProfileuser2">
      <i class="close icon"></i>
      <div class="header">
        แก้ไขข้อมูลส่วนตัว   <div class="nameUser"></div>
      </div>
      <div class="content">
        <div class="ui form" style="width: 420px;margin:0px auto;">
            <div class="inline fields container">
                  <input type="hidden" id="iduser3" value="" >
                  <div class="four wide field">
                    <label>ชื่อ-นามสกุล&nbsp;&nbsp;:</label>
                  </div>
                  <div class="eleven wide field">
                    <input type="text" name="name" id="nameuser3" required>
                  </div>
            </div>
           

            <div class="inline fields container">
                  <div class="four wide field">
                    <label>Email&nbsp;&nbsp;:</label>
              
                  </div>
                  <div class="eleven wide field">
              
                   <input type="email" name="email" id="email" required>
                  </div>
            </div>


          
        </div>
      </div>
      <div class="actions">
        <div class="ui black deny button" >
          ยกเลิก
        </div>
       
          <div class="ui positive right labeled icon button" id="editsubmit">
          บันทึก
          <i class="checkmark icon"></i>
        </div>
      </div>
  </div>

<div class="ui modal" id="editpasswordUser">
      <i class="close icon"></i>
      <div class="header">
        แก้ไขรหัสผ่าน   <div class="nameUser"></div>
      </div>
      <div class="content">
        <div class="ui form" style="width: 420px;margin:0px auto;">
            <div class="inline fields container">
                  <input type="hidden" id="iduser2"  value="">
                  <div class="four wide field">
                    <label>รหัสผ่าน&nbsp;&nbsp;:</label>
                  </div>
                  <div class="eleven wide field">
                    <input type="password" id="passwordedituser">
                  </div>
            </div>
           

            <div class="inline fields container">
                  <div class="four wide field">
                    <label>ยืนยันรหัสผ่าน&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
              
                  </div>
                  <div class="eleven wide field">
              
                    <input type="password"  id="passwordedituser2">
                  </div>
            </div>


          
        </div>
      </div>
      <div class="actions">
        <div class="ui black deny button" >
          ยกเลิก
        </div>
       
          <div class="ui positive right labeled icon button" id="confirmpassword2">
          บันทึก
          <i class="checkmark icon"></i>
        </div>
      </div>
  </div>

<div class="ui basic modal" id="message-prassuser-modal2" >
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


    </body>

<script type="text/javascript">
  
$(document).ready(function(){
   

 $(document).on('click', '.editpasswordUser', function() {
   
    $('.nameUser').text($(this).data('name'));
    $('#iduser2').val($(this).data('id'));
    $('#editpasswordUser').modal('show');
  });

  $('.actions').on('click', '#confirmpassword2', function() {

    if($('#passwordedituser').val()!=$('#passwordedituser2').val())
    {
      alert('รหัสผ่าน ไม่ถูกต้อง');


    }
    else
    {
          $.ajax({
            type: 'post',
            url: '/seting_pass',
            data: {
              '_token': $('input[name=_token]').val(),
              'id': $('#iduser2').val(),
              'password' : $('#passwordedituser').val()

            },
            success: function(data) {
              
              console.log(data)
              $('#message-prassuser-modal2').modal('show');
            }
          })
      }
  });

  $(document).on('click', '.editProfileuser2', function() {
   
    $('.nameUser').text($(this).data('name'));
    $('#iduser3').val($(this).data('id'));
    $('#nameuser3').val($(this).data('name'));
    $('#email').val($(this).data('email'));
    $('#editProfileuser2').modal('show');
  });

  $('.actions').on('click', '#editsubmit', function() {
     if ( $('#email').val() == '' ) {
        alert('email ไม่ถูกต้อง');
    }else{
          $.ajax({
            type: 'post',
            url: '/submitEditProfile',
            data: {
              '_token': $('input[name=_token]').val(),
              'id': $('#iduser3').val(),
              'name' : $('#nameuser3').val(),
              'email' : $('#email').val()

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
});

</script>

<script>
$(document).ready(function(){
   var $id;
  $(document).on('click', '.yes-allow', function() {

   $id = $(this).data('id');
  $('#yes-allow').modal('show');

  });

  $('.actions').on('click', '.yes-action', function() {

    $.ajax({
      type: 'post',
      url: '/yeslistuser',
      data: {
        '_token': $('input[name=_token]').val(),
        'id': $id
      },
      success: function(data) {
        console.log(data);
        alert('ยืนยันสำเร็จ');
        location.reload();
      }
    })
  });



  $(document).on('click', '.No-allow', function() {
  
   $id = $(this).data('id');
  $('#No-allow').modal('show');

  });

  $('.actions').on('click', '.no-action', function() {

    $.ajax({
      type: 'post',
      url: '/Nolistuser',
      data: {
        '_token': $('input[name=_token]').val(),
        'id': $id
      },
      success: function(data) {
        alert('ลบรายการสำเร็จ');
        location.reload();
      }
    })
  });

  

});


</script>

@stop
