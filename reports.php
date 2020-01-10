<?php
// DATABASE CONNECTION
require("includes/pdo_start_admin.php");

?>
<html>
<head>
 <meta name="viewport" content="width=device-width, initial-scale=1">
<!-- BACKUP COPY OF BOOTSTRAP TABLE SORTING SCRIPT -->
  
  <link rel="stylesheet" href="bootstrap/bootstrap-3-3-7.min.css">
  <link rel="stylesheet" href="bootstrap/bootstrap-1-10-13-dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
  
  <script src="bootstrap/code-1-12-4-jquery.js"></script>  
  <script src="bootstrap/jquery-1-10-13-dataTables.js"></script>
  <script src="bootstrap/bootstrap-1-10-13-dataTables.js"></script>
  <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    $('#example').DataTable( {
     lengthMenu: [[25,50,75,100,-1], [25,50,75,100,"All"]],
        initComplete: function () {
            this.api().columns([1,2]).every( function () { 
                var column = this;
                //var select = $('<select><option value=""></option></select>')                
                  var select = $('<select style="max-width: 175px; border-bottom-left-radius: 5px; border-bottom-right-radius:5px; height: 18px; font-size: 10px; font-family: arial; font-weight: normal; color: Blue; "><option value=""></option></select>')

                    .appendTo( $(column.header()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                  //select.append( '<option value="'+d+'">'+d+'</option>' )
                    select.append( '<option placeholder="Search" style="background-color: #F2F2F2; font-size: 12px; font-family: arial; font-weight: normal; color: Blue;" value="'+d+'">'+d+'</option>' )
                    
                } );
            } );
        }
    } );
} );
</script>
</head>
<body>
<!-- report setup -->
<div style='width: 900px; margin: 5px; background-color: white;'><!-- #BCD6A7 -->

<!-- BOOTSTRAP TABLE -->
<table id="example" class="display" cellspacing="0" style='width: 100%; height: 0px; border: 0px grey; margin: 0px;' >
 <thead>
<!-- INSERT DYNAMIC TABS -->  
<tr>
 <th style='height: 0px; background-color: white; padding: 0px;' colspan="10" >
  <ul class="nav nav-tabs" style='margin: 0px; ' >
   <li style='float: right;'><a href="estimates.php" 
     style='height: 25px; padding-left: 5px; padding-right: 5px;  padding-bottom: 20px; padding-top: 0px; font-size: 20px; font-family: arial; font-weight: normal; color: Maroon; letter-spacing: 4; '>REPORTS</a></li>

  <li><a onclick="window.open('qw_index.php','_parent');"
     style='height: 25px; padding: 5px; margin-right: 1px; border-top-left-radius: 5px; border-top-right-radius:5px;  font-size: 12px; font-family: arial; font-weight: normal; color: Black; border: 1px solid Silver; background-color: White;'>
     <img border='0' src='static/icon25/exit.jpg'   width='14' height='14' style='margin: 0px '>&nbsp; CLOSE</a></li>
     
  <li><a href="reports.php" 
     style='height: 25px; padding: 5px; margin-right: 1px; border-top-left-radius: 5px; border-top-right-radius:5px;  font-size: 12px; font-family: arial; font-weight: normal; color: Black; border: 1px solid Silver; background-color: White;'>
     <img border='0' src='static/icon25/reload.jpg'   width='14' height='14' style='margin: 0px '>&nbsp; RESET</a></li>

  <li><a href='reports_create.php'
    style='height: 25px; padding: 5px; margin-right: 1px; border-top-left-radius: 5px; border-top-right-radius:5px;  font-size: 12px; font-family: arial; font-weight: normal; color: Black; border: 1px solid Silver; background-color: White;'>
      <img border='0' src='static/icon25/add.jpg' width='14' height='14' style='margin:0 1px'>&nbsp; ADD NEW</a></li>     

     </ul>
    </th>  
  </tr>
<!-- END INSERT TABS -->   
  <tr>
    <th style='width: 100px;  height: 10px; padding: 0px; background-color: #999999 ; font-family: Arial; font-size: 10pt; color: Black; font-weight: bold; border-bottom: 0px none;'>RecordNo&nbsp;</th> 
    <th style='width: 200px;  height: 10px; padding: 0px; background-color: #999999 ; font-family: Arial; font-size: 10pt; color: Black; font-weight: bold; border-bottom: 0px none;'>REPORT TABLE </th>      
    <th style='width: 200px;  height: 10px; padding: 0px; background-color: #999999 ; font-family: Arial; font-size: 10pt; color: Black; font-weight: bold; border-bottom: 0px none;'>REPORT&nbsp;NAME&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>      
    <th style='width: 200px;  height: 10px; padding: 0px; background-color: #999999 ; font-family: Arial; font-size: 10pt; color: Black; font-weight: bold; border-bottom: 0px none;'>REPORT TITLE</th>    
    <th style='width: 200px;  height: 10px; padding: 0px; background-color: #999999 ; font-family: Arial; font-size: 10pt; color: Black; font-weight: bold; border-bottom: 0px none;'>ReportURL</th>  
    <th style='width: 100px;  height: 10px; padding: 0px; background-color: #999999 ; font-family: Arial; font-size: 10pt; color: Black; text-align:right; font-weight: bold; border-bottom: 0px none;'>&nbsp;&nbsp;&nbsp;ACTION&nbsp;&nbsp;&nbsp;&nbsp;</th>
  </tr>
  
  <tr>
    <th style='width: 50px;  height: 8px; padding: 0px; background-color: #E8E4DD; font-family: Arial; font-size: 8pt; color: Black; font-weight: bold; border: 0px;'></th> 
    <th style='width: 100px; height: 8px; padding: 0px; background-color: #E8E4DD; font-family: Arial; font-size: 8pt; color: Black; font-weight: bold; border: 0px;'></th>      
    <th style='width: 100px; height: 8px; padding: 0px; background-color: #E8E4DD; font-family: Arial; font-size: 8pt; color: Black; font-weight: bold; border: 0px;'></th> 
    <th style='width: 200px; height: 8px; padding: 0px; background-color: #E8E4DD; font-family: Arial; font-size: 8pt; color: Black; font-weight: bold; border: 0px;'></th>    
    <th style='width: 200px; height: 8px; padding: 0px; background-color: #E8E4DD; font-family: Arial; font-size: 8pt; color: Black; font-weight: bold; border: 0px;'></th> 
    <th style='width: 200px; height: 8px; padding: 0px; background-color: #E8E4DD; font-family: Arial; font-size: 8pt; color: Black; font-weight: bold; border: 0px;'></th>     
  </tr>
</thead>
<!-- COLUMN FOOTER / DO NOT DELETE -->
  <tfoot>
   <tr>
    <th style='height: 2px; background-color: WhiteSmoke ;'></th>   
    <th style='height: 2px; background-color: WhiteSmoke ;'></th>
    <th style='height: 2px; background-color: WhiteSmoke ;'></th>
    <th style='height: 2px; background-color: WhiteSmoke ;'></th>
    <th style='height: 2px; background-color: WhiteSmoke ;'></th>  
    <th style='height: 2px; background-color: WhiteSmoke ;'></th>      
    </tr>
  </tfoot>
 <!-- COLUMN FOOTER / DO NOT DELETE --> 
 <tbody>
<?php
// Define alternating row colors
$color1 = "#FFFFFF";  
$color2 = "#F2F2F2";  
$row_count = 0; 

$q = $_GET["q"]; if(!empty($q)) { 
       $stmt= $pdo->query ("SELECT * FROM reports WHERE id = '{$q}'"); $background = "background-color:"; } 
else { $stmt= $pdo->query ("SELECT * FROM reports "); $background = ""; }  
         while($row=$stmt->fetch(PDO::FETCH_OBJ)){
         
$RecordNo    = $row->RecordNo ;
$ReportName  = $row->ReportName ; 
$ReportTable = $row->ReportTable ; 
$ReportTitle = $row->ReportTitle ; 

echo"<tr>
   <td style='height: 10px; padding: 2px 0px 0px 2px; font-family: Arial; font-size: 9pt; $background $row_color;'>$RecordNo</td>
   <td style='height: 10px; padding: 2px 0px 0px 2px; font-family: Arial; font-size: 9pt; $background $row_color;'>$ReportTable</td>   
   <td style='height: 10px; padding: 2px 0px 0px 2px; font-family: Arial; font-size: 9pt; $background $row_color;'>$ReportName</td>    
   <td style='height: 10px; padding: 2px 0px 0px 2px; font-family: Arial; font-size: 9pt; $background $row_color;'>$ReportTitle</td>  
   <td style='height: 10px; padding: 2px 0px 0px 2px; font-family: Arial; font-size: 9pt; $background $row_color;'>$ReportURL</td>    
   <td style='height: 10px; padding: 2px 0px 0px 2px; font-family: Arial; font-size: 9pt; text-align:center; $background $row_color;'>
     <a href='reports_ajax.php?RecordNo=$RecordNo'>     <img border='0' src='static/icon25/print.jpg' width='16' height='16' style='margin:0 1px'></a>    
     <a href='reports_entry.php?RecordNo=$RecordNo'>     <img border='0' src='static/icon25/edit.jpg' width='16' height='16' style='margin:0 1px'></a>   
     <a href='reports_delete.php?RecordNo=$RecordNo'>  <img border='0' src='static/icon25/delete.jpg'  width='16' height='16' style='margin:0 1px'></a>     
  </td>
</tr>";
$row_count++; 
}
?>
</tbody>
</table>
</div>
</body>
</html>


