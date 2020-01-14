<?php
include("header.php");
include("includes/pdo_start_admin.php"); 
// You Are Now Connected - Session Started
if(isset($_POST['F1']) || isset($_POST['F2']) || isset($_POST['F3']) || isset($_POST['F4']) || isset($_POST['table_name']) || isset($_POST['RecordNo']) || isset($_POST['ReportName']) || isset($_POST['NoRows1']) || isset($_POST['NoRows2']) || isset($_POST['NoRows3']) || isset($_POST['NoRows4']))
{
$chkbox    = $_POST['F1'];
$TableName = $_POST['F2'];
$FieldName = $_POST['F3'];
$RecordNo  = $_POST['F4'];
$Active    = 'checked';
$RowColor  = '#ffffff';
$ReportTable = $_POST['table_name'];
$SubId       = $_POST['RecordNo'];
$ReportName  = $_POST['ReportName'];
$NoRows1  = $_POST['NoRows1'];
$NoRows2  = $_POST['NoRows2'];
$NoRows3  = $_POST['NoRows3'];
$NoRows4  = $_POST['NoRows4'];
}
else{
  
}
// MySQL extras
include "includes/pdo_connect.php";
include 'createFunction.php';
if (isset($_POST['Save'])) { 
  if ($_POST['insert_id']) {
    update($_POST, $_POST['table_name'],$_POST['insert_id'], $pdo ); 
} 
else { 
   // $insert_id = mysql_insert( $_POST['table_name'], $_POST, $connection, $error_text );
   $pdo->query("INSERT INTO reports (ReportColor, ReportName, ReportTable, RecordNo, NoRows1, NoRows2, NoRows3, NoRows4, KeyValue ) VALUES ('$RowColor', '$ReportName','$ReportTable','$SubId','$NoRows1','$NoRows2','$NoRows3','$NoRows4', 'id' ) ");
   
$order = 100;  
  foreach($chkbox as $line_no ){ 
    $pdo->query("INSERT INTO reports_fields ( ReportTable, FieldName, RecordNo, LabelHead, LabelFoot, sort, Active, RowColor ) VALUES ('$TableName[$line_no]','$FieldName[$line_no]','$RecordNo[$line_no]','$FieldName[$line_no]','$FieldName[$line_no]','$order', '$Active','$RowColor' ) ");
    
  //$stmt= $pdo->prepare("INSERT INTO reports_fields ( ReportTable, FieldName ) VALUES ('$TableName[$line_no]','$FieldName[$line_no]'  ) ");
     $order++; 
  }     
     
}
header("Location: ./reports_entry.php?RecordNo=$SubId");   
}

?>
<html>
<head>
<title>Custom Reports</title>
<script src="js/script.js"></script>
</head>
<body>

<div align="center">
   <table border="1" width="850" cellspacing="0" cellpadding="2" align="left" style="border-collapse: collapse">
   <tr>
   <td bgcolor="#E0E0E0">
   <p align="center"><font color="#0000FF" face="Arial">CREATE NEW REPORT</font>
</td>
</tr>
<tr>
<td>
</div>
<div align="center">
<table width="100%" border="0" cellspacing="1" cellpadding="1" align="left" style="border-collapse: collapse"; >
<label>Select Table:   </label>  
<select type='submit' name="DataTable" onChange='showUser(this.value)' style=" width: 176; height: 19; border: 1px solid #C0C0C0 ; font-size: 11px; font-family:Arial" size="1" >
<option>==Select DataTable==</option>
<?php
// You Are Now Connected - Session Started
require("includes/pdo_connect.php");
$q = ($_GET["q"]);
 $stmt= $pdo->query ("SHOW TABLES FROM $c_database"); 
   while($row=$stmt->fetch(PDO::FETCH_NUM)){
     ?>
     <option value='<?php echo $row[0] ?>' style='border-radius:15px; background-color:yellow; font-family: Arial; color: #0000FF; font-size: 15px; font-weight: bold'><?php echo $row[0]; ?></option> ;
  <?php
    }
  ?>
  </select>
<br>


</table>
</div>
</td>
</tr>
<tr>
<td>
<p align="center">
<div id="txtHint">

<b>Column Fields Will Be Displayed Here On Select --->.</b>
</div>
</td>
</tr>
</table>
</body>
</html>

