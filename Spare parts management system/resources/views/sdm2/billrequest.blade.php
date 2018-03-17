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
        <h3>คำร้องขอเบิกอุปกรณ์  </h3>
      </div>
      <table class="ui celled table  " >
        <thead>
          <tr>
            <th>#</th>
            <th>ชื่อ-นามสกุล</th>
            <th>วันที่ขอ</th>
            <th>รายละเอียด</th>
            <th>ชื่ออุปกรณ์</th>
            <th>จำนวณ</th>
            <th>ประเภท/ราคา</th>
            <th>รูปภาพ</th>
            <th>ราคารวม</th>
            <th>จัดการคำร้อง</th>
          </tr>
        </thead>
        <tbody>
          <?php $i_con = 1 ?>
            @foreach($Datas as $Data)
              @if($Data[0]->Status=='N' )
                <tr class="bill{{$Data[0]->BillID}}">
                  <td>{{ $i_con++ }}</td>
                  <td><div class="entertext1">{{$Data[1]->name}}</div> </td>
                  <td><div class="entertext2">{{$Data[0]->created_at}}</div></td>
                  <td><div class="entertext3">{{$Data[0]->DetailBuy}}</div></td>
                  <td>
                    @foreach($Data[2] as $device)
                    <div class="ui v1 sizebox">{{ $device[1][0]->DeviceName}}</div><hr> 
                    @endforeach
                  </td>
                  <td>   
                    @foreach($Data[2] as $device)
                      <div class="ui v1 sizebox2 label entertext8" ><h4 style="text-align: center;"> {{ $device[0]}}</h4> </div> <hr>
                    @endforeach
                  </td>
                  <td>   
                    <?php  $result = "" ; ?>
                    @foreach($Data[2] as $device)  
                      <?php  
                        if( ($device[1][0]->Price)>5000){
                          $result = "ครุภัณฑ์";
                        }else{
                          $result = "วัสดุ";
                        } 
                      ?>   
                      <div class="ui v1 sizebox3 label"> <li>{{$result}}</li>
                          <li>
                              <?php  $test = number_format($device[1][0]->Price,2)  ?>
                            {{$test}}
                          </li> 
                      </div>
                      <hr>
                    @endforeach
                  </td> 
                  <td>
                      @foreach($Data[2] as $device)
                        <div class="big  ">  
                            <img src="{{ asset($device[2][0]) }}" class="photoSize"> 
                        </div> <hr>
                      @endforeach
                  </td>
                  <td>
                      <?php  
                        $sum = 0 ; 
                      ?>
                    @foreach($Data[2] as $device)  
                      <?php  
                        $sum= $sum+ ( $device[1][0]->Price * $device[0] ) 
                      ?>  
                    @endforeach
                      <?php  $tobumber = number_format($sum,2)  ?>
                      {{$tobumber}}
                  </td>  
                  <td>
                    <div class="ui buttons" style="font-size: 10px !important;">
                        <button class="ui green button yes-allow" data-id="{{$Data[0]->BillID}}" style="font-size: 12px !important;">อนุมัติ </button>
                          <div class="or"></div>
                          <button class="ui yellow button No-allow" data-id="{{$Data[0]->BillID}}" style="font-size: 12px !important;">ปฏิเสธ </button>
                    </div>
                  </td>
                </tr>
              @endif
            @endforeach 
        </tbody>  
      </table>
    </div> 
  </div>
    @if( sizeof($Datas) < 5  )
              <br>
              <br>
              <br>
              <br>
              <br> <br>
              <br>
              <br>
              <br><br>
              <br>
              <br>
              <br> <br>
              <br>
              <br>
              <br>
              <br>
    @endif
    
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
        <p>โปรดตรวจสอบข้อมูลให้ถูกต้องก่อนยืนยัน</p>
        </center>
      </div>
      <div class="actions">
        <div class="ui red basic cancel inverted button">
          <i class="remove icon"></i>
          ยกเลิก
        </div>
        <div class="ui green ok inverted button yes-action">
        <input type="hidden" name="AllowerID" value="{{ Auth::user()->id }}">
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
          <p>โปรดตรวจสอบข้อมูลให้ถูกต้องก่อนปฏิเสธ</p>
        </center>
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
    
<script>
 
$(document).ready(function(){
   var $BillID;
  $(document).on('click', '.yes-allow', function() {
   /* $('.match_BillID').val($(this).data('id'));*/
   $BillID = $(this).data('id');
  /* $temp= $('#AllowerID').val()
   console.log($temp);*/
  $('#yes-allow').modal('show');

  });

  $('.actions').on('click', '.yes-action', function() {

    $.ajax({
      type: 'post',
      url: '/yesBillRequest',
      data: {
        '_token': $('input[name=_token]').val(),
        'id': $BillID
      },
      success: function(data) {
        /*console.log(data);*/
        alert('ยืนยันสำเร็จ');
        location.reload();
      }
    })
  });

  $(document).on('click', '.No-allow', function() {
   /* $('.match_BillID').val($(this).data('id'));*/
   $BillID = $(this).data('id');
  $('#No-allow').modal('show');

  });

  $('.actions').on('click', '.no-action', function() {

    $.ajax({
      type: 'post',
      url: '/NoBillRequest',
      data: {
        '_token': $('input[name=_token]').val(),
        'id': $BillID
      },
      success: function(data) {
        console.log(data);
        alert('ปฏิเสธสำเร็จ');
        location.reload();
      }
    })
  });

});

</script>

@stop
