    @extends('layout3')
@section('button')
@extends('layout')

@section('content')
<br>
<br><br>
<br>
<div class="ui grid  ">
    <div class="three wide column "><center></center>
    </div>
    <div class="ten wide column segment">
      <div class="box1 ">   
        <div class="ui grey inverted segment">
          <h3>แก้ไขรายการอุปกรณ์</h3>
        </div>
        <form action="{{ route('sdm2.updateDevice') }}" method="post" enctype="multipart/form-data">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="StockID" value="{{ $temp[0]->StockID }}">
          <div class="ui form">

          <center><img src="{{ asset($temp[1][0]) }}" class="photoSize">
          </center>
            
            <div class="field required">
              <label> ชื่ออุปกรณ์</label>
              <input type="text" name="DeviceName" value="{{ $temp[0]->DeviceName }}" required="" oninvalid="this.setCustomValidity('โปรดระบุชื่อปุปกรณ์')" oninput="setCustomValidity('')">
            </div>
            <div class="field">
              <label> เลขครุภัณฑ์ </label>
              <input type="text" name="DeviceNo" value="{{ $temp[0]->DeviceNo }}">
            </div>
            <div class="field">
              <label> Serial Number</label>
              <input type="text" name="DeviceSN" value="{{ $temp[0]->DeviceSN }}">
            </div>
            <div class="field">
              <label> Part Number </label>
              <input type="text" name="DevicePart" value="{{ $temp[0]->DevicePart }}">
            </div>
            <div class="field required">
            <label> จำนวน </label>
            <input type="number"  min="1" name="DeviceAll"  value="{{$temp[0]->DeviceAll}}" placeholder="ex.  9" required="" oninvalid="this.setCustomValidity('โปรดระบุจำนวน')" oninput="setCustomValidity('')" >
          </div>
          <div class="field required" >
            <label>ประเภทของอุปกรณ์</label>
            <select  name="Type" value="{{$temp[0]->Type}}" required="" oninvalid="this.setCustomValidity('โปรดเลิอกหน่วยนับ')" oninput="setCustomValidity('')" >
             <option value="" {!! $temp[0]->Type == '' ? 'selected' : '' !!} >โปรดระบุข้อมูล</option>
              <option value="x-band" {!! $temp[0]->Type == 'x-band' ? 'selected' : '' !!} >x-band</option>
              <option value="s-band" {!! $temp[0]->Type == 's-band' ? 'selected' : '' !!} >s-band</option>
              <option value="Mes-Device " {!! $temp[0]->Type == 'Mes-Device' ? 'selected' : '' !!} >Mes-Device</option>
              
            </select>
          </div>

          
          <div class="field required">
            <label> หน่วยนับ </label>
            <select  name="TypePrice" value="{{$temp[0]->TypePrice}}" >
              <option value="" {!! $temp[0]->TypePrice == '' ? 'selected' : '' !!} >โปรดระบุข้อมูล</option>
              <option value="อัน" {!! $temp[0]->TypePrice == 'อัน' ? 'selected' : '' !!} >อัน</option>
              <option value="แท่ง" {!! $temp[0]->TypePrice == 'แท่ง' ? 'selected' : '' !!} >แท่ง</option>
              <option value="เครื่อง" {!! $temp[0]->TypePrice == 'เครื่อง' ? 'selected' : '' !!} >เครื่อง</option>
              <option value="ชิ้น" {!! $temp[0]->TypePrice == 'ชิ้น' ? 'selected' : '' !!} >ชิ้น</option>
            </select>
          </div>
            <div class="field required">
              <label> ราคาต่อ1หน่วย</label>
              <input type="number" step="0.01" min="0" name="Price" value="{{ $temp[0]->Price }}">
            </div>
            <div class="field">
              <label> รูปภาพ </label>
                <input type="file" name="photo"><br>
              </div>

        </div>
        <br>
         <center><button class="ui blue button" type="submit">Submit</button></center>
        </form>
        
      </div>
    </div>
    <br>
  </div>
   

@stop
