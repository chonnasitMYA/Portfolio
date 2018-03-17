<!Doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>รายงานการอนุมัติเบิกวัสดุอุปกรณ์</title>
	      <meta name="viewport" content="width=device-width, initial-scale=1">
	      <link rel="stylesheet" type="text/css" href="semantic2/semantic.css">
 
	       <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	        <script src="https://cdn.jsdelivr.net/semantic-ui/2.2.10/semantic.min.js"></script>
		<style type="text/css">
	    	@media print {
	    		.no-print{display: none !important;}
	    	}
	    </style>

	    <link rel="stylesheet" type="text/css" href="{{ asset('css/style2.css') }}"> 
	</head>
	<body>
		<div class="A4">
			<table class="ui celled structured table " id='table_wrapper'>
			<caption>
				<center><h2>รายงานการอนุมัติเบิกวัสดุอุปกรณ์</h2></center>
			
			<center><h3> ระบบบริหารจัดการอะไหล่สำรอง</h3></center>
			<center>ภายในปี {{ $year }}</center>
			<br>
			<p>พิมพ์วันที่ :
			<?php $mydate=getdate(date("U"));
				echo "$mydate[mday], $mydate[month], $mydate[year]" 
				?>
					
				</p>
			</caption>
				<thead>
				<tr>
					<th>วันที่ขอ</th>
					<th>ชื่อผู้ขอ</th>
					<th>ชื่ออุปกรณ์</th>
					<th>จำนวน</th> 
					<th>ราคาต่อหน่วย</th> 
					<th>จำนวนเงิน</th> 
				</tr>
				</thead>
				<tbody>
                @foreach($Datas as $Data)
              	<tr class="bill{{$Data[0]->BillID}}">
	                <td class="entertext2">{{$Data[0]->created_at->format('d/m/Y')}} </td>
	                <td  class="entertext1">{{$Data[1]->name}}</td>
	                <td class="entertext3"> 	
		                @foreach($Data[2] as $device)
	                  		<div class="entertext3" > <li>{{ $device[1][0]->DeviceName}}</li></div>
	                  	@endforeach
                  	</td>
	                <td>
	                	@foreach($Data[2] as $device)
                    		<li>{{$device[0]}}</li>
                  		@endforeach         
	                </td>
	                <td>
	                	@foreach($Data[2] as $device) 
	                	 
	                     <li>
	                     <?php  $tobumber = number_format($device[1][0]->Price,2)  ?>{{$tobumber}}
	                     </li>
	                    
                  		@endforeach
	              
	                </td>
	                <td>   
	                  @foreach($Data[2] as $device)  
	                    <?php  
	                      $sum = 0 ;      
	                      $sum= $device[1][0]->Price * $device[0];
	                    ?>  
	                    <li>
	                    <?php  $tobumber = number_format($sum,2)  ?>{{$tobumber}}</li>
	                  @endforeach
	              
	                </td> 

                </tr>
              <tr>
              <thead>
              <th>รวม</th>
              <th></th>
              <th><center>{{sizeof($Data[2])}}&nbsp;&nbsp;รายการ</center></th>
              <th>
                <?php  $sum1 = 0 ;  ?>
              	@foreach($Data[2] as $device)  
	                <?php  
	                       
	                    $sum1= $sum1+$device[0];
	                ?>  
	              
	            @endforeach
              		<center>{{$sum1}}</center>
              </th>
              <th><center>รวมเงิน</center></th>
              <th> <?php  
                      $sum3 = 0 ; 
                    ?>
                  @foreach($Data[2] as $device)  
                    <?php  
                              
                      $sum3= $sum3+ ( $device[1][0]->Price * $device[0] ) ;
                    ?>  
                  @endforeach
                  <?php  $tobumber = number_format($sum3,2)  ?>
                    <center>{{$tobumber}}</center>
               </th>
            </thead>
            </tr>


                @endforeach
            </tbody>
            <thead class="ui inverted grey table">

				<tr>
					<th colspan="2"><center>รวมการอนุมัติ</center></th>
					
					<th><center>{{sizeof($Datas)}}&nbsp;&nbsp;รายการ</center></th>
					<th> 
					<?php  $sum9 = 0 ;  ?>
					@foreach($Datas as $Data)

		              	@foreach($Data[2] as $device)  
			                <?php  
			                       
			                    $sum9= $sum9+$device[0];
			                ?>  
			              
			            @endforeach
		              		

					@endforeach
					<center>{{$sum9}}</center>
					</th> 
					<th><center>รวมเงินทั้งสิ้น</center></th> 
					<th>
						<?php  $sumtotal = 0 ;  ?>
						@foreach($Datas as $Data)

			              	@foreach($Data[2] as $device)  
				                <?php  
				                   $sumtotal= $sumtotal+ ( $device[1][0]->Price * $device[0]);
				                ?>  
				              
				            @endforeach
			              		

						@endforeach
						<?php  $tobumber = number_format($sumtotal,2)  ?>
						<center>{{$tobumber}}</center>
					</th> 
				</tr>
				 
			</thead>
			</table>

			<center>
			<div class="huge ui invert black button pointing dropdown link item no-print">
	        <i class="print icon"></i>Export<i class="dropdown icon"></i>
	        <div class=" ui inverted grey    menu">
		          <a class="item" onclick="window.print();" ><i class="file text icon"></i>PDF</a>
		            <a class="item btnExport" ><i class="file excel outline icon"></i>Excel</a>
		    </div>
		    </div>	
			
			<button class="huge ui invert black button no-print" onclick="window.close();" id="blackhtml"><i class=" remove circle outline icon"></i> ปิด</button>
			
			</center>
			
		<br>
		</div>
	</body>
	<script type="text/javascript">
	$('.ui.dropdown')
	  .dropdown()
	;
  $(document).ready(function(){
 
  $(document).on('click', '.btnExport', function(e) {
  	console.log('ttt');	
  

    e.preventDefault();

    //getting data from our table
    var data_type = 'data:application/vnd.ms-excel';
    var table_div = document.getElementById('table_wrapper');
    var table_html = table_div.outerHTML.replace(/ /g, '%20');

    var a = document.createElement('a');
    a.href = data_type + ', ' + table_html;
    a.download = 'exported_Budget_'+ '.xls';
    a.click();
  });
});


  



</script>
	
</html>