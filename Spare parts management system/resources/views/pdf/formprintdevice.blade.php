<!Doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>รายงานวัสดุอุปกรณ์ภายในระบบ</title>
	      <meta name="viewport" content="width=device-width, initial-scale=1">
	      <link rel="stylesheet" type="text/css" href="semantic2/semantic.css">
 
	       <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
 <script src="https://cdn.jsdelivr.net/semantic-ui/2.2.10/semantic.min.js"></script>

	    <link rel="stylesheet" type="text/css" href="{{ asset('css/style2.css') }}"> 
	    <style type="text/css">
	    	@media print {
	    		.no-print{display: none !important;}
	    	}
	    </style>
	  
	</head>
	<body>
		<div class="A4">

			<center><h2>รายงานวัสดุอุปกรณ์ภายในระบบ</h2></center>
			
			<center><h3> ระบบบริหารจัดการอะไหล่สำรอง</h3></center>
			<center>ประเภทของอุปกรณ์ : {{$type}}</center>
			<br>
			<p>พิมพ์วันที่ :
			<?php $mydate=getdate(date("U"));
				echo "$mydate[mday], $mydate[month], $mydate[year]" 
				?>
				</p>
		
			<br>
			<hr>
			<h3>อุปกรณ์ที่ร้องขอ</h3>
			<table class="ui celled structured table" >
				<thead>
				<tr>
					<th><center><center>#</center></center></th>
					<th><center>ชื่ออุปกรณ์</center></th>
					<th><center>เลขครุภัณฑ์</center></th>
					<th><center>Serial number</center></th> 
					<th><center>Part number</center></th> 
					
					<th><center>ประเภท</center></th> 
					<th><center>จำนวน</center></th> 
				</tr>
				</thead>
				<tbody>
              	<?php $i_con = 1 ?>
              	@foreach($Datas as $Data)
              	<tr class="sizebox7">
	               	<td class="entertext7"><center> {{$i_con++}}</center></td>
	               	<td class="entertext1">{{$Data->DeviceName}}</td>
	               	<td class="entertext1">{{$Data->DeviceNo}}</td>
	              	<td class="entertext1">{{$Data->DeviceSN}}</td> 
	              	<td class="">{{$Data->DevicePart}}</td>
	                <td><center>{{$Data->Type}}</center></td>
	               	<td><center>{{$Data->DeviceAll}}</center></td>       
                </tr>
                @endforeach
              
       

               
            </tbody>

            <thead class="ui inverted grey table">

				<tr>
					<th colspan="5"><center>รวม  </center></th>
					<th><center></center></th>
					<th>
							<?php $count_device = 0 ?>
			              	@foreach($Datas as $Data)
			              	<?php
			              	 $count_device = $count_device + $Data->DeviceAll
			              	 ?>
			              	@endforeach
						<center>{{$count_device}}</center>
						
					</th> 
				
					
				</tr>
				 
			</thead>
			</table>
			<br>
			
		
			<center>
			<div class="huge ui invert black button pointing dropdown link item no-print">
	        <i class="print icon"></i>Export<i class="dropdown icon"></i>
	        <div class=" ui inverted grey menu">
		          <a class="item" onclick="window.print();" ><i class="file text icon"></i>PDF</a>
		           
		            <a class="item" onclick="document.forms['submit_excel'].submit();"><i class="file text icon"></i>Excel</a>
		           <form type="hidden" class=" item" action="{{ route('excel.exportDeviceAll')}}" method="post" name='submit_excel' style="display: none;">
		            <input type="hidden" name="_token" value="{{ csrf_token() }}">
		            <input type="hidden" name=select value="{{ $select }}">
		            </form>
		         
		    </div>
		    </div>	
			
			<button class="huge ui invert black button no-print" onclick="window.close();" id="blackhtml"><i class=" remove circle outline icon"></i> ปิด</button>
			
			</center>
<br>


		</div>
		<br>
			<script type="text/javascript">
	$('.ui.dropdown')
	  .dropdown()
	;
	</script>

	</body>
	
</html>