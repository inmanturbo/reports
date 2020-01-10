<?php
include "includes/pdo_connect.php";
// You Are Now Connected - Session Started
// Select Record To Be Deleted
      
if(isset($_GET['RecordNo'])) {  
 $formid  = $_GET['RecordNo'];

print <<< HERE
<div style='margin-top: 50px' align='center' >
  <form id='areyousure' method='POST' target='mainframe' action='$_SERVER[PHP_SELF]' >
     <div style='width: 300px; border: 1px solid #999999; background-color: Red; border-top-left-radius: 10px; border-top-right-radius: 10px;'>
       <table border='0' width='100%' style='border-collapse: collapse; color: rgb(0, 0, 153); font-size: 15px; letter-spacing: 1px; font-weight: bold; font-family: arial; font-style: normal; font-variant: normal'>
         <tr>
          <td align='left'  ><div style='height:25px; padding: 5px 3px 3px 15px; text-align: center'><font color='White'>CONFIRMATION NEEDED</font></div>
         </td>
     </table>
     </div>
<div allign='center' style='width: 300px; border: 1px solid #999999; margin: 0px; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px'>
HERE;

 $stmt = $pdo->query ("SELECT * FROM reports WHERE RecordNo ='{$formid}' ");
   $row = $stmt->fetch(PDO::FETCH_OBJ);

print <<< HERE
     <br>
		 <p align='center'>                    You are deleting a Report.... </p>
         <p align='center'><font color='Blue'> ReportName:  $row->ReportTable  </font> </p>	 
		 <p align='center'><strong>            Are You Sure ?    </strong></p>

         <input type='hidden' name='id'       value='$row->id' >
         <input type='hidden' name='RecordNo' value='$formid' >
               
         <!-- if user clicks yes - DELETE THE RECORD  if user clicks no - roll back to previous form-->
         <p align='center'> 
         <input type='submit' id='yes' value='YES' >
    	 <input type='button' id='no'  value='NO' onClick='javascript:window.history.go(-1)' >
    	 </p>
     </form>
</div>
HERE;
}
// If yes! delete record - If No! cancel request
else if(isset($_POST['id'])) {

   $id       = $_POST['id'];
   $RecordNo = $_POST['RecordNo'];

    $st2= $pdo->query ("DELETE FROM `reports` WHERE `RecordNo` = '$RecordNo' ");
    $st2= $pdo->query ("DELETE FROM `reports_fields` WHERE `RecordNo` = '$RecordNo' ");    

	header("Location: ./reports.php?RecordNo=$RecordNo");
 
}

?>


