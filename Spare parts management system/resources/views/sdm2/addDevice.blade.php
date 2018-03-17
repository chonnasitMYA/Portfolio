@extends('layout3')
@section('button')
@extends('layout')

@section('content')
  <br>
  <br>
  <br>  
  <br>
  <br>
  <div class="ui grid  ">
    <div class="three wide column "><center></center>
    </div>
    <div class="ten wide column segment">
      <div class="box1 ">
    @if (session('status'))
        
      
              <center>
              <h4 style="color: red">{{ session('status') }}</h4>
            </center>
          
       @endif   

        <div class="ui grey inverted segment">
          <h3>เพิ่มรายการอุปกรณ์</h3>
        </div>
        <form class="ui form" action="{{ route('sdm2.store')}}" method="post" enctype="multipart/form-data">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          
          <div class="fields" >
            <label>ประเภทของอุปกรณ์</label>
            <div class="field " style="">
              <div class="ui radio checkbox " >
                <input type="radio" name="checked"  checked="checked" value='x-band'>
                <label>x-band &nbsp;</label> 
                <!-- &nbsp คือการเว้นวรรค -->
              </div>
              <div class="ui radio checkbox" >
                <input type="radio" name="checked" value='s-band'>
                <label>  s-band &nbsp; </label>
              </div>
              <div class="ui radio checkbox" >
                <input type="radio" name="checked" value='Mes-Device'>
                <label>  Mes-Device &nbsp;</label>
              </div>
            </div>
           
          </div>
          <div class="field required">
            <label>ชื่อุปปกรณ์</label>
            <input type="text" name="DeviceName"  value="{{ old('DeviceName') }}" placeholder="ex. Serial Card PCI 4 Port" required="" oninvalid="this.setCustomValidity('โปรดระบุชื่อปุปกรณ์')" oninput="setCustomValidity('')">
          </div>
          <div class="field">
            <label> Serial number</label>
            <input type="text" name="DeviceSN"  value="{{ old('DeviceSN') }}" placeholder="ex.  GS713-003-00-5504" >
          </div>
          <div class="field">
            <label> Pass number</label>
             <input type="text" name="DevicePart"   value="{{ old('DevicePart') }}" placeholder="ex.  GS713-003-00-5504">
          </div>
          <div class="field">
            <label> เลขครุภัณฑ์</label>
            <input type="text" name="DeviceNo"  value="{{ old('DeviceNo') }}" placeholder="ex.  GS713-003-00-5504">
          </div>
          <div class="field required">
            <label> จำนวน </label>
            <input type="number"  min="1" name="DeviceAll"  value="{{ old('DeviceAll') }}" placeholder="ex.  9" required="" oninvalid="this.setCustomValidity('โปรดระบุจำนวน')" oninput="setCustomValidity('')" >
          </div>
          <div class="field required">
            <label> หน่วยนับ </label>
            <select  name="TypePrice" value="{{ old('TypePrice') }}" required="" oninvalid="this.setCustomValidity('โปรดเลิอกหน่วยนับ')" oninput="setCustomValidity('')">
              <option value="">โปรดระบุข้อมูล</option>
              <option value="อัน">อัน</option>
              <option value="แท่ง">แท่ง</option>
              <option value="เครื่อง">เครื่อง</option>
              <option value="ชิ้น">ชิ้น</option>
            </select>
          </div>
          
          <div class="field required">
            <label> ราคาต่อหน่วย </label>
            <input type="number" step="0.01"  min="0" name="Price"  value="0" placeholder="ex.  45909">
          </div>
            <div class="field">
              <label> รูปภาพ </label>
                <input type="file" name="photo"  value="{{ old('photo') }}" accept="image/*" ><br>
              </div>
            <button class="ui button" type="submit">Submit</button>
          </form>
      </div>
    </div>
    <br>
  </div>
  <br>
    

@stop
