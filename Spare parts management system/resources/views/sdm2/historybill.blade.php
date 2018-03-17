@extends('layout3')
@section('button')

@extends('layout')

@section('content')
    <br>
    <br> <br> <br>
    <br>

    
  
    <div class="ui centered grid" >
      <div class="ui fixed fourteen wide column box1  "  >
        <div class="ui grey inverted segment ">
        <h3>ประวัติการอนุญาติ เบิกวัสดุ ครุภัณฑ์</h3>
        </div>
        <div class="ui form">
        <div class="fields">
          <div class="six wide field">
            <form action="{{ route('sdm2.historybill')}}" method="post">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <label> ปีที่ต้องการดู </label>
              <select class="ui search dropdown" name="year" >
                  <option value="2017" {!! $year == '2017' ? 'selected' : '' !!}>2017</option>
                  <option value="2018" {!! $year == '2018' ? 'selected' : '' !!}>2018</option>
                  <option value="2019" {!! $year == '2019' ? 'selected' : '' !!}>2019</option>
                  <option value="2020" {!! $year == '2020' ? 'selected' : '' !!}>2020</option>
                  <option value="2021" {!! $year == '2021' ? 'selected' : '' !!}>2021</option>
                  <option value="2022" {!! $year == '2022' ? 'selected' : '' !!}>2022</option>
                  <option value="2023" {!! $year == '2023' ? 'selected' : '' !!}>2023</option>
                  <option value="2024" {!! $year == '2024' ? 'selected' : '' !!}>2024</option>
                  <option value="2025" {!! $year == '2025' ? 'selected' : '' !!}>2025</option>
              </select>
              &nbsp;&nbsp;
              <button class="ui inverted green button" type="submit" style="width:140px">Submit</button>
            </form> 
          </div>
          <div class="three wide field">
            <form target="_blank" action="{{ route('pdf.formprint')}}" method="post">

            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="year" value="{{ $year }}">
            <center>
            <button class="ui inverted yellow  button">รายงานงบการเบิกรายปี</button>
            </center>
            </form>
          </div>
          <div class="six wide field">
            <form target="_blank" action="{{ route('pdf.formprintgraph')}}" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name=year value="{{ $year }}">
            <button class="ui inverted red button">รายงานการเบิกอุปกรณ์สูงสุด 5 รายการ</button>
            </form>
          </div>
        </div>
        </div>

          <table class="ui celled table table2excel">
            <thead>
              <tr>
                <th>ผู้ร้องขอ</th>
                <th>วันที่ขอ   </th>
                <th>รายละเอียด</th>
                <th>ชื่ออุปกรณ์</th>
                <th>ประเภท/ราคา</th>
                <th>จำนวน</th>
                <th>ราคารวม</th>
                <th>ผู้อนุมัติ</th>
                <th>Print</th>
              </tr>
            </thead>
            <tbody>
          @foreach($Datas as $Data)
              <tr class="bill{{$Data[0]->BillID}}">
                
                <td><div class="entertext1">{{$Data[1]->name}}</div> </td>
                <td><div class="entertext2">{{$Data[0]->created_at->format('d/m/Y')}} </div></td>
                <td><div class="entertext3">{{$Data[0]->DetailBuy}} </div></td>
                <td>
                  @foreach($Data[2] as $device)
                  <div class="ui  entertext4 " > <li> {{ $device[1][0]->DeviceName}} </li></div>
                  @endforeach             
                </td>
                <td>   
                  <?php  $result = "" ; ?>
                  @foreach($Data[2] as $device)  
                    <?php  
                     if( ($device[1][0]->Price)>5000){
                      $result = "ครุภัณฑ์ / ";
                     }else{
                      $result = "วัสดุ / ";
                     } 
                    ?>   
                    <?php  $tobumber = number_format($device[1][0]->Price,2)  ?>
                    <div class="ui entertext7"><li> {{$result}}  {{$tobumber}}</li></div>
                  @endforeach
                </td> 
                <td>   
                  @foreach($Data[2] as $device)
                    <div class="ui entertext5" > <li> {{$device[0]}} </li></div>
                  @endforeach
                </td>
                
                <td>
                    <?php  $sum = 0 ; ?>
                  @foreach($Data[2] as $device)  
                    <?php          
                      $sum= $sum+ ( $device[1][0]->Price * $device[0] ) ;
                    ?>  
                  @endforeach
                    <?php  $tobumber = number_format($sum,2)  ?>{{$tobumber}}
                   
                </td>  
                <td class="entertext1"> {{$Data[3]->name}}</td>
                <td>
                  <form target="_blank" action="{{ route('pdf.formprintbill')}}" method="post">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <input type="hidden" name=bill value="{{$Data[0]->BillID}}">
                  <button class=" ui invert black button icon" ><i class="print icon"></i></button>
                  </form>
                </td>
              </tr>
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
              
              
    @endif
<br>
<br>


@stop