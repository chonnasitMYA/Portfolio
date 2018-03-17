@extends('layout3')
@section('button')

@extends('layout')
@section('content')



  <br>  
  <br>  
  <br>  
  <br>
  <br>


  <div class="ui grid " style="max-width: 100%">
    <div class="two wide column"><center></center></div>
    <div class="twelve wide column box1" style="min-width: 500px">
      <div class="ui grey inverted segment">
        <h3>เบิกอุปกรณ์</h3>
      </div>
        <button class="ui inverted red button" id="button_all">ทุกประเภท</button>
        <button class="ui inverted orange button" id="button_xband">x-band</button>
        <button class="ui inverted yellow button" id="button_sband">s-band</button>
        <button class="ui inverted green button" id="button_Mes-Device">Mes-Device</button>
      <div id="segment_all" style="" >
        <div>
          <h3 style="color: red">ประเภทของอุปกรณ์ : ทุกประเภท
          </h3>
        </div>
        <br>
        <div class="ui stackable grid "  >
          @foreach($ListItem as $Item)
            
            <div class="ui segment"  style="margin: 10px ;width:300px;" >
              <center>
             
                <img src="{{ asset($Item[1][0]) }}" class="photoSize">
                <p id="NameDevice" name="NameDevice" value="{{ $Item[0]->DeviceName }}"> {{ $Item[0]->DeviceName }}</p>
                <p>จำนวนที่เหลือ  {{ $Item[0]->DeviceAll }}  {{$Item[0]->TypePrice}} </p>
                <button class="ui red button requestDevice" data-name="{{ $Item[0]->DeviceName }}"" data-stockid="{{ $Item[0]->StockID }}" data-deviceall="{{ $Item[0]->DeviceAll }}">เพิ่ม</button>
            
              </center>
            </div>
           
          @endforeach
        </div>
        <br> 
      </div>
  
    <div id="segment_xband" style="display: none;" >
      <div>
        <h3 style="color: red">ประเภทของอุปกรณ์ : x-band </h3>
      </div>
      <br>
        <div class="ui  stackable grid "  >
          @foreach($ListItem as $Item)
              @if($Item[0]->Type == 'x-band')
              <div class="ui segment" id='tooltip' style="margin: 10px ;width:300px;" >
                <center>
                  <img src="{{ asset($Item[1][0]) }}" class="photoSize">
                  <p id="NameDevice" name="NameDevice" value="{{ $Item[0]->DeviceName }}"> {{ $Item[0]->DeviceName }}</p>
                  <p>จำนวนที่เหลือ  {{ $Item[0]->DeviceAll }}  {{$Item[0]->TypePrice}} </p>
                  <button class="ui red button requestDevice" data-name="{{ $Item[0]->DeviceName }}"" data-stockid="{{ $Item[0]->StockID }}" data-deviceall="{{ $Item[0]->DeviceAll }}">เพิ่ม</button>
                </center>
              </div>
              @endif
          @endforeach
        </div>
        <br> 
    </div>

    <div id="segment_sband" style="display: none;" >
      <div>
          <h3 style="color: red">ประเภทของอุปกรณ์ : s-band </h3>
      </div>
      <br>
        <div class="ui  stackable grid "  >
          @foreach($ListItem as $Item)
              @if($Item[0]->Type == 's-band')
               <div class="ui segment" id='tooltip' style="margin: 10px ;width:300px;" >
                 <center>
                   <img src="{{ asset($Item[1][0]) }}" class="photoSize">
                    <p id="NameDevice" name="NameDevice" value="{{ $Item[0]->DeviceName }}"> {{ $Item[0]->DeviceName }}</p>
                    <p>จำนวนที่เหลือ  {{ $Item[0]->DeviceAll }}  {{$Item[0]->TypePrice}} </p>
                    <button class="ui red button requestDevice" data-name="{{ $Item[0]->DeviceName }}"" data-stockid="{{ $Item[0]->StockID }}" data-deviceall="{{ $Item[0]->DeviceAll }}">เพิ่ม</button>
                  </center>
                </div>
            @endif
          @endforeach
        </div>
        <br> 
    </div>

    <div id="segment_Mes-Device" style="display: none;" >
      <div>
          <h3 style="color: red">ประเภทของอุปกรณ์ : Mes-Device </h3>
      </div>
      <br>
        <div class="ui  stackable grid "  >
          @foreach($ListItem as $Item)
              @if($Item[0]->Type == 'Mes-Device')
              <div class="ui segment tooltip" id='tooltip' style="margin: 10px ;width:300px;" >
                <center>
                  <img src="{{ asset($Item[1][0]) }}" class="photoSize">
                  <p id="NameDevice" name="NameDevice" value="{{ $Item[0]->DeviceName }}"> {{ $Item[0]->DeviceName }}</p>
                  <p>จำนวนที่เหลือ  {{ $Item[0]->DeviceAll }}  {{$Item[0]->TypePrice}}</p>
                  <button class="ui red button requestDevice" data-name="{{ $Item[0]->DeviceName }}"" data-stockid="{{ $Item[0]->StockID }}" data-deviceall="{{ $Item[0]->DeviceAll }}">เพิ่ม</button>
                </center>
              </div>
              @endif
          @endforeach
        </div>
        <br> 
    </div>
    </div>
    <br>
    <br>
    <div class="two wide column">
      <div class="ui segment" style="position: fixed;">
        <center>
          <i class="big shopping basket icon inline" ></i>
        </center>
        <br>
        <span>จำนวนอุปกรณ์ที่ได้เลือก</span>
        <span id="result">  0 </span>
        <span >  อย่าง </span>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <label id="list_patition"></label>
        <button class="ui blue button test"> ยืนยันการเบิก</button>
      </div>
    </div>
  </div>

<div class="small ui modal" id="alertDevice">
  <i class="close icon"></i>
  <div class="ui icon header">
     <i class="huge green check circle icon"></i>
      คุณได้ทำการเพิ่มสินค้าลงตะกร้าแล้ว
  </div>
  
  
</div>
 
  


  <div class="ui modal" id="requestItem">
    <i class="close icon"></i>
    <div class="header" id="header">
      Profile Picture
    </div>

    <div class="content">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <input type="hidden" name="iduser" value="{{ Auth::user()->id }}">
      <div class="ui form">
        <div id="div_table">
            <table class="ui blue table">
              <thead>
                <tr>
                  <th>ชื่ออุปกรณ์</th>
                  <th>จำนวน</th>
                  <th>ลบ</th>
                </tr>
              </thead>
              <tbody id="tableshow">  
              </tbody>
             </table>
        </div>     
     <!--  <br> -->
        <div class="field">
          <label>ชื่อ-นามสกุล ผู้ขอ</label>
          <div class="ui disabled input">
              <input type="text" id="User" placeholder="{{ Auth::user()->name }}">
          </div>
        </div>

        <div class="field inline">
          <label>เบิกอุปกรณ์เพื่อทำอะไร</label>
          <textarea rows="2" id="detailbuy"  placeholder="โปรดระบุข้อมูล"  required="" onChange="editDetail(value)" value="" ></textarea>
        </div>
      </div>
      <br>
      <label id="list_patition_forever"></label>
      <div class="actions">
        <center>
          <button class="ui blue right labeled icon button ok" id="submitITEM" >  <i class="checkmark icon"></i> ยืนยัน</button>
        </center>
      </div>
    </div>
  </div>


<script>

  $("#button_all").click(function(){
      $("#segment_all").show(500);
      $("#segment_Mes-Device").hide(500);
      $("#segment_xband").hide(500);
      $("#segment_sband").hide(500);
    });
  $("#button_xband").click(function(){
      $("#segment_xband").show(500);
      $("#segment_all").hide(500);
      $("#segment_Mes-Device").hide(500);
      $("#segment_sband").hide(500);
    });
  $("#button_sband").click(function(){
      $("#segment_sband").show(500);
      $("#segment_all").hide(500);
      $("#segment_Mes-Device").hide(500);
      $("#segment_xband").hide(500);
    });
  $("#button_Mes-Device").click(function(){
      $("#segment_Mes-Device").show(500);
      $("#segment_all").hide(500);
      $("#segment_xband").hide(500);
      $("#segment_sband").hide(500);
    });


  var list = new Array();
  var listsubmititem = new Array();
  var detailbuy ="'";


 
  $(document).ready(function(){
 
    $(document).on('click', '.test', function() {
       setTimeout(function() {
        $('#requestItem').modal('refresh').modal('show');
      },1000);
      $('#header').text("จำนวนอุปกรณ์ที่เลือก");

      $('#requestItem').modal('show');

      $('#NumStockID').val($(this).data('stockid'));
      $('#NameDevice').val($(this).data('name'));
      
     
       $('#tableshow').remove();
        $('#div_table').html('<table class="ui blue table" id="tableshow">'+'<thead><tr><th>ลำดับ</th><th>ชื่ออุปกรณ์</th><th>จำนวนที่เหลืออยู๋ในระบบ</th><th>จำนวน</th><th>ลบ</th></tr> </thead><tbody id="table_body"></tbody>'+'</table>');
        for (i = 0; i < list.length; i++) { 
      
             $('#tableshow').append("<tr class='item" +(i)+" id=item"+(i)+" '> <td>"+(i+1)+"</td><td>"+list[i][1]+"</td><td>"+list[i][3]+"</td><td><input type='number' id="+(i)+" value='1' min='1' max='"+list[i][3]+"' name=value onChange='editAmount("+i+",value)'>  </td><td><div id='delete_tr' class='ui red ok inverted button delete delete_tr' data-item='item"+i+"'  data-index='"+i+"'><i class='checkmark icon'></i>ลบ</div></td> </tr>");
        }

     



     });

    $(document).on('click', '.requestDevice', function() {

      var stockid = $(this).data('stockid');
      var NameDevice = $(this).data('name');
      var deviceall = $(this).data('deviceall');
     
      if(('{{Auth::user()->type}}'==='admin') || ( '{{Auth::user()->type}}' === 'superadmin' ) ){
        console.log('admin');
      }else{
        console.log('user');
      }
      var check = -1;

      $('#alertDevice').modal('show');
      setTimeout(function() {
        $('#alertDevice').modal('hide');
      },2000);
      for (i = 0; i < list.length; i++){
        if(stockid==list[i][0]){
               check=1;
               
            }
        }
        if(check == -1){
              document.getElementById("result").innerHTML = (list.length+1);

              var qty=1;
              var temp=[stockid,NameDevice,qty,deviceall];
              list.push(temp);
            console.log(list);


        }
         
      
      
    });


    $(document).on('click', '#delete_tr', function() {
      var item = $(this).data('item');
     $(this).closest('tr').remove();
      var index = $(this).data('index');
      /*list.splice($(this).data('item'),index);*/
      list.splice(index,index+1);
     /* console.log(list);
*/
    });


    $("#submitITEM").click(function(){ 
    
         $.ajax({
            type: 'post',
              url: '/requestListItem',
              data:  {'_token': $('input[name=_token]').val(),
                      'listDevice':list,
                      'detailbuy':detailbuy,
                      'iduser': $('input[name=iduser]').val(),
                      'check': 'No'
                      },
            success: function(data) {
                alert('ยืนยันสำเร็จ กรุณารอผู้ดูแลระบบอนุมัติ');
                location.reload();
              console.log(data);
            }
            });
       
      
    });
    

  });


function editAmount(index,amount){

  list[index][2]=amount;

 
}
function editDetail(text){

  detailbuy=text;

}
</script>



@stop
