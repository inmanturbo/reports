<?php
include "includes/start_admin.php";
// You Are Now Connected - Session Started
?>
<form method='post'>
<p style="margin: 0 2px">
<select name="mytable" style="height: 19; border: 1px solid #C0C0C0 ; font-size: 11px; font-family:Arial; background-color:#F2F2F2;">
<option>===Select Table ===</option>
<?php 
$sql = "SHOW TABLES FROM $c_database";
  $result = mysql_query($sql);
    while ($nt = mysql_fetch_array($result)) {
      echo "<option value=$nt[0]>$nt[0]</option>";
}
?>
</select>
<input type="submit" value="Submit" name="mytable" style="width: 67; height: 20; font-size: 8pt; font-family: Arial; font-weight: bold">
<?php
if ($_POST){

$sql2 = ("ALTER TABLE categories ADD ( Serial_No VARCHAR(12) NULL, User_Name VARCHAR(20) NULL, User_Ip VARCHAR(60) NULL, Rec_Name VARCHAR(60) NULL, Rec_No VARCHAR(4) NULL, Rec_By VARCHAR(35) NULL, Rec_Date VARCHAR(8) NULL, Rec_Time VARCHAR(8) NULL, Rec_Age VARCHAR(8) NULL, Rev_By VARCHAR(35) NULL, Rev_Date VARCHAR(4)NULL, Rev_Time VARCHAR(8) NULL, Cur_Date VARCHAR(8) NULL, Cur_Time VARCHAR(6) NULL, Time_Diff VARCHAR(4) NULL, Time_Execute VARCHAR(15) NULL, Time_Modify VARCHAR(15) NULL)"); 

mysql_select_db('$c_database');

$retval = mysql_query( $sql2, $connection );
if(! $retval )
{
  die('Could not create field: ' . mysql_error());
}
echo "Field created successfully\n";
mysql_close($connection);
}
?>
</form>