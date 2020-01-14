<?php
include "includes/pdo_start_admin.php";
// You Are Now Connected - Session Started

$CreateFormId = date('ymdhis');
// echo $CreateFormId ;
?>

<div align='center'>
<form name='selectform' method='post'>
<div align='center' style='font-family: Arial; font-size: 12pt; color: #0066FF; font-weight: bold'>
   <input type='hidden' name='table_name' value='<?php echo $_GET['q']; ?>'       style='width: 95; height: 20; font-family: Arial; border: 1px solid #E0E0E0; padding: 2; background-color:#FFFFDF'>
   <input type='hidden' name='RecordNo'  value="<?php echo $CreateFormId; ?>" style='width: 95; height: 20; font-family: Arial; border: 1px solid #E0E0E0; padding: 2; background-color:#FFFFDF'>
   <input type='hidden' name="NoRows1" value="10" style="width: 30; height: 19; border: 1px solid #C0C0C0 ; font-size: 11px; font-family:Arial" >
   <input type='hidden' name="NoRows2" value="20" style="width: 30; height: 19; border: 1px solid #C0C0C0 ; font-size: 11px; font-family:Arial" >
   <input type='hidden' name="NoRows3"  value="30" style="width: 30; height: 19; border: 1px solid #C0C0C0 ; font-size: 11px; font-family:Arial" >
   <input type='hidden' name="NoRows4" value="-1" style="width: 30; height: 19; border: 1px solid #C0C0C0 ; font-size: 11px; font-family:Arial" >    
  
   REPORT NAME:&nbsp;
   <input type='text' name='ReportName'  value="" required='required' style='width: 150; height: 20; font-family: Arial; border: 1px solid #E0E0E0; padding: 2; background-color:#FFFFDF'>   
   <input type='submit' value='Create Report' name='Save' ></font> 
   <font face='Arial'>
   <input type='button' value='Start Over' onClick='javascript:location.reload()' name='refresh'>
  </font></b>
   <input type='button' value='Close' onclick="window.open('reports.php','_mainframe');" name='refresh'>
  </font></b>
<hr> 
<table width='100%' border='1' cellpadding='0' style='border-collapse: collapse' bordercolor='#000000'>
  <tr>
      <td bgcolor='#E0E0E0' style='font-size: 8pt; font-family: Arial'>
      <p align='center'>SELECT THE FIELD NAMES TO BE INCLUDED IN THE REPORT</td>
   </tr>
  </td>
</table>
</div> 

<table width='100%' border='1' cellspacing='1' cellpadding='1' align='center' style='border-collapse: collapse' >
    
<?php

//set 3 to 4 of you want 4 columns. Set it to 5 if you want 5, etc
$numcols = 1; // how many columns to display
$numcolsprinted = 0; // no of columns so far

// get the selected table from database 
$mytable = $_GET["q"];

$result = $pdo->query ("SELECT * FROM $mytable") ;
      if (!$result) {
      die('Query failed: ');
}

// get column metadata
$order = 0;
$i = 0;
$line=0;
while ($i < $result->columnCount()) 
      {
    $meta = $result->getColumnMeta($i);
 //get data - eg, reading fields 0 and 1
if ($numcolsprinted == $numcols) {
  ?>
 <tr><tr>
   <?php 
  $numcolsprinted = 0;
}

// Print Fieldnames
$RecordId = date('ymdhis');
?>
<td align='left'>
         <input type='checkbox' name='F1[]' value='<?php echo $line ?>'       style='width: 19; height: 15;' >
         <input type='hidden'   name='F2[]' value='<?php echo $_GET['q'] ?>'    size='26' style='width: 100; height: 15; font-size: 8pt; font-family: Tahoma; border: 0px solid #E0E0E0; padding: 1' >        
         <input type='text'     name='F3[]' value='<?php echo $meta['name']; ?>' size='26' style='width: 100; height: 15; font-size: 8pt; font-family: Tahoma; border: 0px solid #E0E0E0; padding: 1' >
         <input type='hidden'   name='F4[]' value='<?php echo $CreateFormId ?>'   size='26' style='width: 100; height: 15; font-size: 8pt; font-family: Tahoma; border: 0px solid #E0E0E0; padding: 1' >
               
  </td>
<?php
$order++;
$line++;
// bump up row counter
$numcolsprinted++;
$i++;
      
} 
// end while loop
?>
 <td align='left'>
         <input type='hidden' name='F1[]' value='unchecked'     style='width: 19; height: 15;' >
         <input type='hidden' name='F2[]' value='<?php echo $_GET['q']; ?>'      style='width: 100; height: 15; font-size: 8pt; font-family: Tahoma; border: 0px solid #E0E0E0; padding: 1' >        
         <input type='hidden' name='F3[]' value='MANAGE'        style='width: 100; height: 15; font-size: 8pt; font-family: Tahoma; border: 0px solid #E0E0E0; padding: 1' >
         <input type='hidden' name='F4[]' value='<?php echo $CreateFormId ?>' style='width: 100; height: 15; font-size: 8pt; font-family: Tahoma; border: 0px solid #E0E0E0; padding: 1' >
 </td>



<?php
$colstobalance = $numcols - $numcolsprinted;
for ($i=1; $i<=$colstobalance; $i++) {
}
?>
</tr></tr>
</table>
<!-- HEADER NOTES -->      
<div align='center'>
  <table width='100%' border='1' cellpadding='0' style='border-collapse: collapse' bordercolor='#808080'>
    <tr>
      <td bgcolor='#E0E0E0' style='font-size: 8pt; font-family: Arial'>
        <p align='center'>YOUR REPORT WILL BE CREATED FROM THE ABOVE SELECTED FIELD NAMES</td>
      </tr>
    </td>
  </table>
</div>
<table width='100%' border='1' cellspacing='1' cellpadding='1' align='center' style='border-collapse: collapse'>

</table>






