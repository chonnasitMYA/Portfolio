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
        <h3>อุปกรณ์ทั้งหมด</h3>
        </div>
        
        <div class="ui form ">
          <div class="fields">
            <div class="six wide field">
              <form action="{{ route('sdm2.show') }}" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <label>ประเภทของอุปกรณ์&nbsp;</label>
                  <select class="ui search dropdown" name="select" >
                    <option value="all" {!! $select == 'all' ? 'selected' : '' !!}>ทุกประเภท</option>
                    <option value="Mes-Device" {!! $select == 'Mes-Device' ? 'selected' : '' !!}>Mes-Device</option>
                    <option value="x-band" {!! $select == 'x-band' ? 'selected' : '' !!}>x-band</option>
                    <option value="s-band" {!! $select == 's-band' ? 'selected' : '' !!}>s-band</option>
                  </select>
                <button class="ui inverted green button" type="submit">ตรวจสอบ</button>
              </form>
            </div>
            <div class="seven wide field">
              <form target="_blank" action="{{ route('pdf.formprintdevice')}}" method="post">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type="hidden" name=select value="{{ $select }}">
              <button class="ui inverted red button">Export รายการอุปกรณ์</button>
              </form>
            </div>
            
          </div>
        </div>

          <table class="ui celled table" >
            <thead>
              <tr>
                <th>ประเภทของอุปกรณ์</th>
                <th>ชื่ออุปกรณ์</th>
                <th>เลขครุภัณฑ์</th>
                <th>Serial Number</th>
                <th>Part Number</th>
                <th>ราคาต่อ1หน่วย</th>
                <th>จำนวน (ที่เหลืออยู่ในระบบ)</th>
                <th>รูป</th>
                <th>จัดการรายละเอียด</th>
              </tr>
            </thead>
            <tbody>

              @foreach($ListItem as $Item)
                <tr>
                  <td>{{ $Item[0]->Type }}</td>
                  <td>{{ $Item[0]->DeviceName }}</td>
                  <td>{{ $Item[0]->DeviceNo }}</td>
                  <td>{{ $Item[0]->DeviceSN }}</td>
                  <td>
                    <?php  $tobumber = number_format($Item[0]->Price)  ?>
                  {{ $tobumber }}
                  </td>
                  <td>{{ $Item[0]->Price }}</td>
                  <td>{{ $Item[0]->DeviceAll }} {{$Item[0]->TypePrice}}</td>
                  <td>
                      <img src="{{ asset($Item[1][0]) }}" class="photoSize">
                  </td>
                  <td>
                    <form action="{{ route('sdm2.editDevice') }}" method="post">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <input type="hidden" name="StockID" value="{{$Item[0]->StockID}}">
                      <button class="ui grey button" type="submit">แก้ไขข้อมูล</button>
                    </form>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
      </div>   
    </div>
 <br> 
 <br> 



@stop