<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
      <meta name="viewport" content="width=device-width, initial-scale=1">

	
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<title>exportHightRequest</title>
</head>
<body>
  <h2>รายงานการเบิกอุปกรณ์สูงสุด</h2>
  <h3> ระบบบริหารจัดการอะไหล่สำรอง ภายในปี {{ $year }}</h3>
  <table>
       <tr>
      	<th>#</th>
         <th>ชื่ออุปกรณ์</th>
         <th>เลขครุภัณฑ์</th>
         <th>ประเภท</th>
         <th>จำนวนทั้งหมด</th>
         <th>จำนวนที่ใช้ไป</th>
         <th>คงเหลือ</th>
       </tr>
    </thead>
    <tbody>
    <?php  $count = 1 ;  ?>
      @foreach($ListItemAll as $Data)
        <tr>
          <td>{{$count++}}</td>
          <td>{{$Data[1]->DeviceName}}</td>
          <td>{{$Data[1]->DeviceNo}}</td>
          <td>{{$Data[1]->Type}}</td>
          <td>{{$Data[1]->DeviceAll+$Data[0]}} </td>
          <td>{{$Data[0]}}</td>
          <td>{{$Data[1]->DeviceAll}}</td>
        </tr>
      @endforeach
     </tbody>
      <thead>
                
                <tr>
                    <th><center>รวม  </center></th>
                    <th><center></center></th>
                    <th></th> 
                    <th></th> 
                    <th>
                        <?php  $sum = 0 ;  ?>
                        @foreach($ListItemAll as $Data)
                        <?php $sum=$sum+$Data[1]->DeviceAll+$Data[0] ?>
                        @endforeach
                        <center>{{$sum}}</center>
                    </th>
                    <th>
                        <?php  $sum = 0 ;  ?>
                        @foreach($ListItemAll as $Data)
                        <?php $sum=$sum+$Data[0] ?>
                        @endforeach
                        <center>{{$sum}}</center>
                    </th>
                    <th>
                        <?php  $sum = 0 ;  ?>
                        @foreach($ListItemAll as $Data)
                        <?php $sum=$sum+$Data[1]->DeviceAll ?>
                        @endforeach
                        <center>{{$sum}}</center>
                    </th>
                </tr>
                 
            </thead>
   </table> 
   
</body>
</html>