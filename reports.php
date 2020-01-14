<?php
// DATABASE CONNECTION
include("header.php");
include("function.php");
?>
<html>
<head>
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <script src="js/script.js"></script>
<!-- BACKUP COPY OF BOOTSTRAP TABLE SORTING SCRIPT -->
</head>
<body>
<!-- report setup -->
<div style='width: 100%;
    background-color: white;
    float: left;
    display: block;'><!-- #BCD6A7 -->

<!-- BOOTSTRAP TABLE -->
<table id="example" class="display" cellspacing="0" style='width: 100%; height: 0px; border: 0px grey; margin: 0px;' >
 <thead>
<!-- INSERT DYNAMIC TABS -->  
<tr>
 <th style='height: 60px; background-color: white; padding: 0px;' colspan="10" >
  <ul class="nav nav-tabs" style='margin: 0px; ' >
   <li style='float: right;'><a href="estimates.php" 
     style='height: 39px; padding-left: 10px; padding-right: 5px; padding-bottom: 23px; padding-top: 8px; font-size: 16px;
font-family: arial; font-weight: 600; color: #343a40; letter-spacing: 4; background: #ccc; border: 1px solid #ccc; border-radius: 6px; cursor: pointer; '>REPORTS</a></li>

  <li><a onclick="window.open('qw_index.php','_parent');"
     style='height: 40px; padding: 14px; margin-right: 5px; padding-top: 10px; font-size: 13px; font-family: arial; font-weight: normal;
 color: Black; border: 1px solid #fff; background-color: #f1ecec; margin-bottom: 5px; border-radius: 9px; cursor: pointer;'>
     <img border='0' src='static/icon25/exit.jpg'   width='14' height='14' style='margin: 0px '>&nbsp; CLOSE</a></li>
     
  <li><a href="reports.php" 
   style='height: 40px; padding: 14px; margin-right: 5px; padding-top: 10px; font-size: 13px; font-family: arial; font-weight: normal;
 color: Black; border: 1px solid #fff; background-color: #f1ecec; margin-bottom: 5px; border-radius: 9px; cursor: pointer;'>
     <img border='0' src='static/icon25/reload.jpg'   width='14' height='14' style='margin: 0px '>&nbsp; RESET</a></li>

  <li><a href='reports_create.php'
   style='height: 40px; padding: 14px; margin-right: 5px; padding-top: 10px; font-size: 13px; font-family: arial; font-weight: normal;
 color: Black; border: 1px solid #fff; background-color: #f1ecec; margin-bottom: 5px; border-radius: 9px; cursor: pointer'>
      <img border='0' src='static/icon25/add.jpg' width='14' height='14' style='margin:0 1px'>&nbsp; ADD NEW</a></li>     

     </ul>
    </th>  
  </tr>
<!-- END INSERT TABS -->   
  <tr style="background: #343a40;">
    <th style='width: 100px;  height: 50px; padding: 0px; background-color: #343a40 ; font-family: Arial; font-size: 10pt; color: #fff; font-weight: bold; border-bottom: 0px none;'>RecordNo&nbsp;</th> 
    <th style='width: 200px;  height: 50px; padding: 0px; background-color: #343a40 ; font-family: Arial; font-size: 10pt; color: #fff; font-weight: bold; border-bottom: 0px none;'>REPORT TABLE </th>      
    <th style='width: 200px;  height: 50px; padding: 0px; background-color: #343a40 ; font-family: Arial; font-size: 10pt; color: #fff; font-weight: bold; border-bottom: 0px none;'>REPORT&nbsp;NAME&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>      
    <th style='width: 200px;  height: 50px; padding: 0px; background-color: #343a40 ; font-family: Arial; font-size: 10pt; color: #fff; font-weight: bold; border-bottom: 0px none;'>REPORT TITLE</th>    
    <th style='width: 200px;  height: 50px; padding: 0px; background-color: #343a40 ; font-family: Arial; font-size: 10pt; color: #fff; font-weight: bold; border-bottom: 0px none;'>ReportURL</th>  
    <th style='width: 100px;  height: 50px; padding: 0px; background-color: #343a40 ; font-family: Arial; font-size: 10pt; color: #fff; text-align:right; font-weight: bold; border-bottom: 0px none;'>&nbsp;&nbsp;&nbsp;ACTION&nbsp;&nbsp;&nbsp;&nbsp;</th>
  </tr>
  
  <tr>
    <th style='width: 50px;  height: 50px; padding: 0px; background-color: #E8E4DD; font-family: Arial; font-size: 8pt; color: Black; font-weight: bold; border: 0px;'></th> 
    <th style='width: 100px; height: 50px; padding: 0px; background-color: #E8E4DD; font-family: Arial; font-size: 8pt; color: Black; font-weight: bold; border: 0px;'></th>      
    <th style='width: 100px; height: 50px; padding: 0px; background-color: #E8E4DD; font-family: Arial; font-size: 8pt; color: Black; font-weight: bold; border: 0px;'></th> 
    <th style='width: 200px; height: 50px; padding: 0px; background-color: #E8E4DD; font-family: Arial; font-size: 8pt; color: Black; font-weight: bold; border: 0px;'></th>    
    <th style='width: 200px; height: 50px; padding: 0px; background-color: #E8E4DD; font-family: Arial; font-size: 8pt; color: Black; font-weight: bold; border: 0px;'></th> 
    <th style='width: 200px; height: 50px; padding: 0px; background-color: #E8E4DD; font-family: Arial; font-size: 8pt; color: Black; font-weight: bold; border: 0px;'></th>     
  </tr>
</thead>
<!-- COLUMN FOOTER / DO NOT DELETE -->
  <tfoot>
   <tr>
    <th style='height: 50px; background-color: WhiteSmoke ;'></th>   
    <th style='height: 50px; background-color: WhiteSmoke ;'></th>
    <th style='height: 50px; background-color: WhiteSmoke ;'></th>
    <th style='height: 50px; background-color: WhiteSmoke ;'></th>
    <th style='height: 50px; background-color: WhiteSmoke ;'></th>  
    <th style='height: 50px; background-color: WhiteSmoke ;'></th>      
    </tr>
  </tfoot>
 <!-- COLUMN FOOTER / DO NOT DELETE --> 
 <tbody>
<?php
// Define alternating row colors
$color1 = "#FFFFFF";  
$color2 = "#F2F2F2";  
$row_count = 0; 
$row_color = $row_color??'';
$ReportURL = $ReportURL??'';

 if(isset( $_GET["q"])) { 
          $background = "background-color:";
          $q = $_GET["q"];
          $table_name='reports';
          $stmt=select($q,$table_name);
       } 
else { 
 
        $background = "";
        $table_name='reports';
        $stmt=select('',$table_name,$pdo);
     }  
         while($row=$stmt->fetch(PDO::FETCH_OBJ)){
          //print_r($row);
                   $RecordNo    = $row->RecordNo ;
                  $ReportName  = $row->ReportName ; 
                  $ReportTable = $row->ReportTable ; 
                  $ReportTitle = $row->ReportTitle ;
              ?> 

<tr>
   <td style='height: 50px; padding: 2px 0px 0px 2px; font-family: Arial; font-size: 12pt; $background $row_color;'><?php echo $RecordNo; ?></td>
   <td style='height: 50px; padding: 2px 0px 0px 2px; font-family: Arial; font-size: 12pt; $background $row_color;'><?php echo $ReportTable; ?></td>   
   <td style='height: 50px; padding: 2px 0px 0px 2px; font-family: Arial; font-size: 12pt; $background $row_color;'><?php echo $ReportName; ?></td>    
   <td style='height: 50px; padding: 2px 0px 0px 2px; font-family: Arial; font-size: 12pt; $background $row_color;'><?php echo $ReportTitle; ?></td>  
   <td style='height: 50px; padding: 2px 0px 0px 2px; font-family: Arial; font-size: 12pt; $background $row_color;'><?php echo $ReportURL; ?></td>    
   <td style='height: 50px; padding: 2px 0px 0px 2px; font-family: Arial; font-size: 12pt; text-align:center; $background $row_color;'>
     <a href='reports_ajax.php?RecordNo=<?php echo $RecordNo; ?>'>     <img border='0' src='static/icon25/print.jpg' width='16' height='16' style='margin:0 1px'></a>    
     <a href='reports_entry.php?RecordNo=<?php echo $RecordNo; ?>'>     <img border='0' src='static/icon25/edit.jpg' width='16' height='16' style='margin:0 1px'></a>   
     <a href='reports_delete.php?RecordNo=<?php echo $RecordNo; ?>'>  <img border='0' src='static/icon25/delete.jpg'  width='16' height='16' style='margin:0 1px'></a>     
  </td>
</tr>
<?php
$row_count++; 
}
?>
</tbody>
</table>
</div>
</body>
</html>


