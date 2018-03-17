<!Doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>แบบฟอร์มการเบิกอุปกรณ์</title>
	      <meta name="viewport" content="width=device-width, initial-scale=1">
	      <link rel="stylesheet" type="text/css" href="semantic2/semantic.css">
 
	       <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


	    <link rel="stylesheet" type="text/css" href="{{ asset('css/style2.css') }}"> 
	    <style type="text/css">
	    	@media print {
	    		.no-print{display: none !important;}
	    	}
	    </style>
	</head>
	<body>
		<div class="A4">

			<center><h2>แบบฟอร์มการเบิกอุปกรณ์</h2></center>
			
			<center><h3> ระบบบริหารจัดการอะไหล่สำรอง</h3></center>
			
			<br>
			<p>พิมพ์วันที่ :
			<?php $mydate=getdate(date("U"));
				echo "$mydate[mday], $mydate[month], $mydate[year]" 
				?>
				</p>
			<p>วันที่ขอเบิก : &nbsp;{{$Datas[0]->created_at->format('d/m/Y')}} เวลา {{$Datas[0]->created_at->format('H:i:s')}} น. </p>
			<p>ชื่อผู้ขอเบิกอุปกรณ์ : &nbsp;{{$Datas[1]->name}} </p>
			<p>รายละเอียด : &nbsp;{{$Datas[0]->DetailBuy}}</p>
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
					<th><center>จำนวน</center></th> 
					<th><center>ประเภท/ราคา</center></th> 
					<th><center>จำนวนเงิน</center></th> 
				</tr>
				</thead>
				<tbody>
              	 <?php $i_con = 1 ?>
              	  @foreach($Datas[3] as $Data)
              	<tr class="sizebox6">
	               <td  class="entertext7"><center> {{$i_con++}}</center></td>
	               <td class="entertext8">{{$Data[1][0]->DeviceName}}</td>
	               <td class="entertext8">
 					<?php  
 					if($Data[1][0]->DeviceNo == Null){
	               		echo "-";
	               }else{
	               		echo $Data[1][0]->DeviceNo;
	               }
	                ?>
	               </td>
	                <td class="entertext8">
 					<?php  
 					if($Data[1][0]->DeviceSN == Null){
	               		echo "-";
	               }else{
	               		echo $Data[1][0]->DeviceSN;
	               }
	                ?>
	               </td> <td class="entertext8">
 					<?php  
 					if($Data[1][0]->DevicePart == Null){
	               		echo "-";
	               }else{
	               		echo $Data[1][0]->DevicePart;
	               }
	                ?>
	               </td>
	                <td class="entertext7"><center>{{$Data[0]}}</center></td>
	               <td class="entertext8">
	                <?php  
                      $result = "" ;

                     if( ($Data[1][0]->Price)>5000){
                      $result = "ครุภัณฑ์ / ";
                     }else{
                      $result = "วัสดุ / ";
                     } 
                    ?>   
                
                   <?php  $tobumber = number_format($Data[1][0]->Price,2)  ?>
                   
                     {{$result}}  {{$tobumber}}
                   
             
	               </td>
	               
	                  <td class="entertext7"><center>
	                  <?php  
                      	$sum =  ($Data[1][0]->Price)*$Data[0];
                      	 $tobumber = number_format($sum,2)
                   	  ?>   
	                  {{$tobumber}}</center></td>
                
                </tr>
                @endforeach
                <?php 
                	$temp = 10-sizeof($Datas[3]);
                	for ($x = 0; $x <= $temp; $x++) {
					    echo "<tr class='sizebox6'><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
					} 
                ?>
       

               
            </tbody>

            <thead class="ui inverted grey table">

				<tr>
					<th colspan="5"><center>รวม  </center></th>
					
					<th>
					<?php  $sum9 = 0 ;  ?>
				
		              	@foreach($Datas[3] as $device)  
			                <?php  
			                       
			                    $sum9= $sum9+$device[0];
			                ?>  
			              
			            @endforeach
		              		

					
					<center>{{$sum9}}</center>
					</th>
					<th>
						<center>รวมเงินทั้งสิ้น</center>
					</th> 
					<th>
						<?php  $sumtotal = 0 ;  ?>
			              	@foreach($Datas[3] as $device)  
				                <?php  
				                   $sumtotal= $sumtotal+ ( $device[1][0]->Price * $device[0]);
				                ?>  
				            @endforeach
						<?php  $tobumber = number_format($sumtotal,2)  ?>
						<center>{{$tobumber}}</center>
					</th>
					
				</tr>
				 
			</thead>
			</table>
			<br>
			<hr>
			<table id="print-table" style="font-size:16px;text-align:center;margin-top:50px;" width="100%">
					<tbody><tr>
						
							<td style="width:40%">ลงชื่อ ..........................................................</td>
					
							<td style="width:20%"></td>

							<td style="width:40%">ลงชื่อ ..........................................................</td>
					</tr>
					<tr>
						
							<td style="width:40%;padding-top:15px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(&nbsp;&nbsp; {{$Datas[1]->name}} &nbsp;&nbsp;)</td>
					
							<td style="width:20%;padding-top:15px"></td>

							<td style="width:40%;padding-top:15px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(&nbsp;&nbsp; {{$Datas[2 ]->name}} &nbsp;&nbsp;)</td>
					</tr>
					<tr>
						
							<td style="width:40%">ผู้ขอเบิกอุปกรณ์</td>
					
							<td style="width:20%"></td>

							<td style="width:40%">ผู้อนุมัติ</td>
					</tr>
					
				</tbody>
				</table>
			<center>

			<button class="huge ui invert black button no-print" id="print" onclick="window.print();"><i class="print icon" style="width: auto;"></i>ปริ้นรายงาน</button>
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