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

  <h2>รายงานการเบิกอุปกรณ์สูงสุด ระบบบริหารจัดการอะไหล่สำรอง</h2>
  <h3> ประเภทอุปกรณ์ 
    <?php 
      if ($select == 'all') {
        $select='ทุกประเภท';
      }
    ?>
    {{$select}}
</h3>
  <table>
      <thead>
              <tr>
                <th>ประเภทของอุปกรณ์</th>
                <th>ชื่ออุปกรณ์</th>
                <th>เลขครุภัณฑ์</th>
                <th>Serial Number</th>
                <th>Part Number</th>
                <th>ราคาต่อ1หน่วย</th>
                <th>จำนวน (ที่เหลืออยู่ในระบบ)</th>

              </tr>
            </thead>
            <tbody>

              @foreach($ListItem as $Item)
                <tr>
                  <td>{{ $Item[0]->Type }}</td>
                  <td>{{ $Item[0]->DeviceName }}</td>
                  <td>{{ $Item[0]->DeviceNo }}</td>
                  <td>{{ $Item[0]->DeviceSN }}</td>
                  <td>{{ $Item[0]->DevicePart }}</td>
                  <td>{{ $Item[0]->Price }}</td>
                  <td>{{ $Item[0]->DeviceAll }} {{$Item[0]->TypePrice}}</td>

                </tr>
              @endforeach
            </tbody>
            <thead>

        <tr>
          <th ><center>รวม  </center></th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th><center></center></th>
          <th>
              <?php $count_device = 0 ?>
                      @foreach($ListItem as $Item)
                      <?php
                       $count_device = $count_device + $Item[0]->DeviceAll
                       ?>
                      @endforeach
            <center>{{$count_device}}</center>
            
          </th> 
        
          
        </tr>
         
      </thead>
   </table> 
   
</body>
</html>