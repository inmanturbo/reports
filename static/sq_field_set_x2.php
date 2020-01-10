<?php
include "includes/start_admin.php";
// You Are Now Connected - Session Started
?>
<form method='post'>
<p style="margin: 0 2px">
<select name="TableName" style="height: 19; border: 1px solid #C0C0C0 ; font-size: 11px; font-family:Arial; background-color:#F2F2F2;">
<option>===Select Table ===</option>
<?php 
$sql = "SHOW TABLES FROM $c_database";
  $result = mysql_query($sql);
    while ($nt = mysql_fetch_array($result)) {
      echo "<option value=$nt[0]>$nt[0]</option>";
}
?>
</select>
<input type="submit" style="width: 67; height: 20; font-size: 8pt; font-family: Arial; font-weight: bold" name="Submit" value="Submit">
<input type='button' value='Close' onclick="window.open('sq_manager.php','_parent');" style='font-family: Verdana; font-size: 10px; font-weight: bold; list-style-type: disc; width: 75; height: 19;'>
<?php
if ($_POST[TableName]){
$sql2 = ("ALTER TABLE $_POST[TableName] ADD ( $_POST[AddFields])"); 

mysql_select_db('$c_database');
  $retval = mysql_query( $sql2, $connection );
    if(! $retval )
    {
    die('Could not create field set: ' . mysql_error());
    }
//echo "Fields created successfully\n";
header("Location: ./sq_table_list_fields.php?q=".$_POST[TableName]."") ;
mysql_close($connection);
}
?>

<p style="margin: 0 2px">
&nbsp;<p style="margin: 0 2px">
<font color="#800000" size="2"><b>The following fields will be added to the selected table</b></font><p style="margin: 0 2px">
<textarea rows="19" name="AddFields" cols="34">SerialNo VARCHAR(12) NULL, 
UserName VARCHAR(20) NULL, 
UserIp VARCHAR(60) NULL, 
RecordName VARCHAR(60) NULL, 
RecordNo VARCHAR(4) NULL, 
RecordBy VARCHAR(35) NULL, 
RecordDate VARCHAR(8) NULL, 
RecordTime VARCHAR(8) NULL, 
RecordAge VARCHAR(8) NULL, 
ReviseBy VARCHAR(35) NULL, 
ReviseDate VARCHAR(4)NULL, 
ReviseTime VARCHAR(8) NULL, 
CurrentDate VARCHAR(8) NULL, 
CurrentTime VARCHAR(6) NULL, 
TimeDiff VARCHAR(4) NULL, 
TimeExecute VARCHAR(15) NULL, 
TimeModify VARCHAR(15) NULL
</textarea><p style="margin: 0 2px">
<b><font size="2" color="#800000" face="Arial">NOTICE: </font></b>
<p style="margin: 0 2px">
<b><font face="Arial" size="2" color="#800000">*DO NOT Include Comma, after the last 
field-set..</font></b><p style="margin: 0 2px">
<b><font face="Arial" size="2" color="#800000">*Be sure these fields no not 
already exist in this table</font></b></form>