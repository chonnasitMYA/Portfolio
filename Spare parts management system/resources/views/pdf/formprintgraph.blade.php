<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>รายงานการเบิกอุปกรณ์สูงสุด</title>
        <link rel="stylesheet" type="text/css" href="semantic2/semantic.css">
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/semantic-ui/2.2.10/semantic.min.js"></script>
        <script src="http://code.highcharts.com/highcharts.js"></script>
       <script src="http://code.highcharts.com/modules/exporting.js"></script> 
       <style type="text/css">

            @media print {
                .no-print{display: none !important;}
            }
        </style> 
        @if ($Status=='Y')
        <script>
            $(function () {
                  
                  
                Highcharts.chart('container', {
                chart: {
                    type: 'column'
                },
                credits: {
                    enabled: false
                },
                exporting: { enabled: false },

                plotOptions: {
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                          
                        }
                    }
                },

              



                title: {
                    text: 'จำนวนอุปกรณ์ที่ถูกยืมไปสูงสุด'
                },
                xAxis: {
                    categories: [
                       "{{$ListItem[0][1]->DeviceName}}",
                       "{{$ListItem[1][1]->DeviceName}}",
                       "{{$ListItem[2][1]->DeviceName}}",
                       "{{$ListItem[3][1]->DeviceName}}",
                       "{{$ListItem[4][1]->DeviceName}}"
                      
                  
                    ],
                    labels: {
                        rotation: 90
                    },  
                    crosshair: true

                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'จำนวน',
                    }
                },
                
                series: [{
                    name: 'จำนวนทั้งหมด',
                    data: [ 
                            {{$ListItem[0][1]->DeviceAll+$ListItem[0][0]}} ,
                            
                            {{$ListItem[1][1]->DeviceAll+$ListItem[1][0]}},
                            {{$ListItem[2][1]->DeviceAll+$ListItem[2][0]}},
                            {{$ListItem[3][1]->DeviceAll+$ListItem[3][0]}},
                            {{$ListItem[4][1]->DeviceAll+$ListItem[4][0]}}
                            ]

                }, {
                    name: 'จำนวนที่ถูกยืมไป',
                    data: [ {{$ListItem[0][0]}},{{$ListItem[1][0]}},{{$ListItem[2][0]}},{{$ListItem[3][0]}},{{$ListItem[4][0]}}]

                },]

            });
                });

</script>
@endif
    </head> 
    <body> 
    <center><h2>รายงานการเบิกอุปกรณ์สูงสุด</h2></center>
    <center><h3> ระบบบริหารจัดการอะไหล่สำรอง</h3></center>
    <center>ภายในปี {{ $year }}</center>
         
    @if($Status=='Y')
        <div id="container" style="width: 800px; height: 500px; margin: 0 auto"></div>  
        <br>
        <center><h3>รายชื่ออุปกรณ์ที่ถูกยืมไป</h3></center>
        <div  style="padding: 20px">
        <table class="ui celled structured table">
                <thead>
                <tr>
                    <th><center><center>#</center></center></th>
                    <th><center>ชื่ออุปกรณ์</center></th>
                    <th><center>เลขครุภัณฑ์</center></th>
                    <th><center>ประเภท</center></th> 
                    <th><center>จำนวนทั้งหมด</center></th> 
                    <th><center>จำนวนที่ใช้ไป</center></th> 
                    <th><center>คงเหลือ</center></th> 
                </tr>
                </thead>
                <tbody>
                  <?php  $count = 1 ;  ?>
                @foreach($ListItemAll as $Data)
                <tr class="sizebox6">

                    <td  class="entertext7"><center>{{$count++}}</center></td>
                    <td class="entertext8"><center>{{$Data[1]->DeviceName}}</center></td>
                    <td class="entertext8"><center>{{$Data[1]->DeviceNo}}</center></td>
                    <td class="entertext8"><center>{{$Data[1]->Type}}</center></td>
                    
                    <td>{{$Data[1]->DeviceAll+$Data[0]}} </td>
                    <td>{{$Data[0]}}</td>
                    <td>{{$Data[1]->DeviceAll}}</td>
                </tr>
                @endforeach
              
               
       

               
            </tbody>

            <thead class="ui inverted grey table">
                
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

            <center>
            <div class="huge ui invert black button pointing dropdown link item no-print">
            <i class="print icon"></i>Export<i class="dropdown icon"></i>
            <div class=" ui inverted grey menu">
                  <a class="item" onclick="window.print();" ><i class="file text icon"></i>PDF</a>

                 
                    <a  class="item"  onclick="document.forms['submit_excel2'].submit();"><i class="file text icon"></i>Excel</a>
                   <form class=" item" action="{{ route('excel.exportHighRequest')}}" method="post" name='submit_excel2' style="display: none;">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name=year value="{{ $year }}">
                    </form>
                   
                 
            </div>
            </div>  
            
            <button class="huge ui invert black button no-print" onclick="window.close();" id="blackhtml"><i class=" remove circle outline icon"></i> ปิด</button>
            
            </center>
    </div>
        <script type="text/javascript">
    $('.ui.dropdown')
      .dropdown()
    ;
    </script> 
    @else
    
      
        <br>
        <center><h3>รายชื่ออุปกรณ์ที่ถูกยืมไป</h3></center>
        <div  style="padding: 20px">
        <table class="ui celled structured table">
                <thead>
                <tr>
                    <th><center><center>#</center></center></th>
                    <th><center>ชื่ออุปกรณ์</center></th>
                    <th><center>เลขครุภัณฑ์</center></th>
                    <th><center>ประเภท</center></th> 
                    <th><center>จำนวนทั้งหมด</center></th> 
                    <th><center>จำนวนที่ใช้ไป</center></th> 
                    <th><center>คงเหลือ</center></th> 
                </tr>
                </thead>
                <tbody>
                  <?php  $count = 1 ;  ?>
                @foreach($ListItemAll as $Data)
                <tr class="sizebox6">

                    <td  class="entertext7"><center>{{$count++}}</center></td>
                    <td class="entertext8"><center>{{$Data[1]->DeviceName}}</center></td>
                    <td class="entertext8"><center>{{$Data[1]->DeviceNo}}</center></td>
                    <td class="entertext8"><center>{{$Data[1]->Type}}</center></td>
                    
                    <td>{{$Data[1]->DeviceAll+$Data[0]}} </td>
                    <td>{{$Data[0]}}</td>
                    <td>{{$Data[1]->DeviceAll}}</td>
                </tr>
                @endforeach
              
               
       

               
            </tbody>

            <thead class="ui inverted grey table">
                
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

            <center>
            <div class="huge ui invert black button pointing dropdown link item no-print">
            <i class="print icon"></i>Export<i class="dropdown icon"></i>
            <div class=" ui inverted grey menu">
                  <a class="item" onclick="window.print();" ><i class="file text icon"></i>PDF</a>

                 
                    <a  class="item"  onclick="document.forms['submit_excel2'].submit();"><i class="file text icon"></i>Excel</a>
                   <form class=" item" action="{{ route('excel.exportHighRequest')}}" method="post" name='submit_excel2' style="display: none;">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name=year value="{{ $year }}">
                    </form>
                   
                 
            </div>
            </div>  
            
            <button class="huge ui invert black button no-print" onclick="window.close();" id="blackhtml"><i class=" remove circle outline icon"></i> ปิด</button>
            
            </center>

    @endif  
    <script type="text/javascript">
    $('.ui.dropdown')
      .dropdown()
    ;
    </script>
    </body>
</html>