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
      <div class="ui fixed fourteen wide column box1"  >
        <div class="ui grey inverted segment ">
        <h3>รายการขออนุมัติ</h3>
        </div>
        
    

          <table class="ui celled table" >
            <thead>
              <tr>
                <th>#</center></th>
                <th>วันที่ขอ</center></th>
                <th>ชื่อผู้ขอ</center></th>
                <th>รายระเอียดการขอ</center></th>
                <th>อุปกรณ์</center></th>
                <th>จำนวน </center></th>
                <th>สถานะ</center></th>

              </tr>
            </thead>
            <tbody>

          
            <?php $i_con = 1 ?>
              @foreach($Datas as $Data)
                <tr>
                  <td>{{$i_con++}}</td>
                   <td><center><div class="entertext9">
                    {{$Data[0]->created_at->format('d/m/Y')}}
                    </div></center>
                  </td>
                  <td><div class="entertext1">{{$Data[1]->name}}</div></td>
                  <td><div class="entertext10">{{$Data[0]->DetailBuy}}</div></td>
                  <td>
                    @foreach($Data[2] as $device)
                    <li>{{ $device[1][0]->DeviceName}}</li>  
                    @endforeach
                  </td>
                  <td>
                    @foreach($Data[2] as $device)
                      <li> {{ $device[0]}}</li> 
                    @endforeach
                  </td>
                  <td>
                  <?php 
                  $status ='' ;
                  if ($Data[0]->Status=='N' ){

                    echo "<span style='color: blue'> รอการอนุมัติ </span>"; 
                  }elseif ($Data[0]->Status=='Y'){
                   
                    echo "<span style='color: green'> สำเร็จ </span> ";
                  }else{
                   
                  echo "<span style='color: red'> ไม่ผ่านการอนุมัติ กรุณาติดต่อผู้ดูแล </span> ";
                  }
                  
                  ?>
                
                  <?php if($status == 'N') ?>
                  {{$status}}
                </td>
                </tr>
              @endforeach
          
            </tbody>

          </table>
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

            @endif
      </div>   
    </div>
   
  
 <br> 
 <br> 



@stop