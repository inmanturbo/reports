<?php
require("includes/pdo_start_admin.php");
// You Are Now Connected - Session Started
// SAVE THIS FOR STATIC HEADING IN A LOOP
// if($no == 0){ echo "Show this once"; $no=1 ; } ;
include("function.php");
include 'createFunction.php';
// get value for this record
$formid = $_GET["RecordNo"];
$table='reports_fields';
// select * from table order by col limit 1;
$stmt2=select($formid,$table,$pdo);
 while($col=$stmt2->fetch(PDO::FETCH_OBJ)){
    // Ajax db Key id
     $keyid = $col->FieldName; // saves to key value in reports
}

if (isset($_POST['Save'])) {
         if ($_POST['insert_id']) {
     $update=update($_POST,  $_POST['table_name'], $_POST['insert_id'],  $pdo );
    // print_r($update);die;

// UPDATE COLUMN FIELD VALUES
 if($_POST['Save']) {
  //  var_dump($_POST['F']);
  foreach($_POST['F'] As $id => $value ) {
    //print_r($value);
      // COLLECT INPUT VALUES
   $sort       = $value['sort'];
   $FieldName  = $value['FieldName'];
   $LabelHead  = $value['LabelHead'];
   $FieldAlign = $value['FieldAlign'];
   $FieldWidth = $value['FieldWidth'];
   $FieldValue = $value['FieldValue'];
   $FieldId    = $value['FieldId'];
   $Active     = $value['Active'] ?'checked' : 'unchecked' ;
   $RowSumCK   = $value['RowSumCK'] ?'checked' : 'unchecked' ;
   $RowPDF     = $value['RowPDF'] ?'checked': 'unchecked' ;
   $RowSumNO   = $value['RowSumNO'];
   $RowColor   = $value['RowColor'];   
   $opacity   = $value['opacity'];

// UPDATE FIELD COLUMN NAMES
     $pdo->query ("UPDATE reports_fields SET
       sort       = '$sort',
       FieldName  = '$FieldName',
       LabelHead  = '$LabelHead',
       FieldAlign = '$FieldAlign',
       FieldWidth = '$FieldWidth',
       FieldValue = '$FieldValue',
       FieldId    = '$FieldId',
       Active     = '$Active',
       RowSumCK   = '$RowSumCK',
       RowPDF     = '$RowPDF',
       RowSumNO   = '$RowSumNO',
       RowColor   = '$RowColor',
       opacity   = '$opacity'              
       WHERE id   = '$id'");
}
}
}

else {
      $insert_id =create($_POST,$_POST['table_name'],  $pdo );
}
   $returnid = $_POST['RecordNo'];
header("Location: ./reports_entry.php?RecordNo=$returnid");
}

?>
<head>
<title>REPORTS</title>
<script type="text/javascript">
var YesOrNo = (function() {
  if(document.Save.Active.checked) {
     document.Save.Active.value = 'checked';
  } 
});
  var YesOrNo = (function() {
  if(document.Save.RowSumCK.checked) {
     document.Save.RowSumCK.value = 'checked';
  } });
  var YesOrNo = (function() {
  if(document.Save.RowPDF.checked) {
     document.Save.RowPDF.value = 'checked';
  }

});
</script>

</head>
<div style='width: 100%;
    background-color: white;
    float: left;
    display: block;'>
<table border="0" width="350" style="border-collapse: collapse" cellpadding="0">
<tr>
<form name='Save' value='Save'  action="<?php print $_SERVER['PHP_SELF']?>" method="post" >
<!-- HIDDEN FIELDS -->
<?php
 $stmt= $pdo->query ("SELECT * FROM reports WHERE RecordNo = '{$formid}'");
   while($row=$stmt->fetch(PDO::FETCH_OBJ)){
 $report = $row;
 //print_r($report);
}
if ( $report->KeyValue == 'id' ) { 
  $thisValue = $report->id; 
}
 else {
   $thisValue = $report->RecordNo;
   }

?>

     <input type='hidden' name='table_name'  value='reports' >
     <input type='hidden' name='insert_id'   value='<?php print $report->id; ?>' >
     <input type='hidden' name='id'          value='<?php print $report->id; ?>' >
     <input type="hidden" name="RecordNo"    value="<?php if ($report->id > 0) { echo $report->RecordNo;} Else { echo ''.date('ymdHis');        } ?>" >
     <input type='hidden' name='RecordDate'  value="<?php if ($report->id > 0) { echo $report->RecordDate;         } Else { echo ''.date('y-m-d'); } ?>">
     <input type='hidden' name='RecordTime'  value="<?php if ($report->id > 0) { echo $report->RecordTime;         } Else { echo ''.date('H:i:s'); } ?>">
     <input type='hidden' name='CreatedBy'   value="<?php if ($report->id > 0) { echo $report->CreatedBy;          } Else { echo $username ;             } ?>">
     <input type='hidden' name='UpdatedDate' value="<?php if ($report->id > 0) { echo ''.date('y-m-d')."\n";     } Else { echo 'Original' ;      } ?>">
     <input type='hidden' name='UpdatedTime' value="<?php if ($report->id > 0) { echo ''.date('H:i:s')."\n";     } Else { echo 'Original' ;      } ?>">
     <input type='hidden' name='UpdatedBy'   value="<?php if ($report->id > 0) { echo 'Updated by ' . $username; } Else { echo 'Original' ;      } ?>">
     <input type='hidden' name='ReportTable' value='<?php print $report->ReportTable ?>'>

<table id="reports_entry" border="1" width="775" cellspacing="2" cellpadding="2" style="border-collapse: collapse; font-size: 8pt; font-family: Arial; font-weight: bold; margin: 0 auto;" >
<tr>
<td valign="top">
<table class="inner_reports_entry" border="1" width="775"  height='100px' cellpadding="2" style="font-size: 8pt; font-family: Arial; font-weight: bold" bordercolor="#DCDACD" >
  <tr>
    <td bgcolor="#FFFFFF" width="365">
      <table border="0" width="300" cellpadding="0" style="border-collapse: collapse">
		<tr style="height: 40px; text-align: center;">
			<td width="27">
			<p align="center" style="margin: 0 5px">
			<img border="0" src="themes/icon18/5006.jpg" width="16" height="16"></td>
			<td><b>&nbsp;REPORT SETUP</b></td>
		</tr>
		</table>
	</td>
      <td width="448" bgcolor="#FFFFFF">
      <p align="center">

<input type="button" value="Open Report" onClick=window.location='reports_ajax.php?RecordNo=<?php print $report->RecordNo ?>'>
<input type="submit" value="Save" name="Save" >&nbsp;
<input type="button" value="Close" onClick=window.location='reports.php'>
<input type="reset"  value="Reset" onClick='location.reload();' ></td>
  </tr>
	<tr>
    <td bgcolor="#FFFFFF" valign="top" width="365">
      <table border="1" width="365" height='10' style="font-size: 8pt; font-family: Arial; font-weight: bold; border-collapse: collapse" cellspacing="1" bordercolor="#DCDACD">
		<tr>
    <td bgcolor="#F0F0F0" colspan="2">
      <p style="margin: 0 5px"><font size="3" color="#800000">Report name and
		URL links to manage records</font></td>
      	</tr>
		<tr>
    <td style="width: 91px" bgcolor="#FFFFFF">
      <p style="margin:0 5px; ">
      <span style="font-size: 13px; font-weight:100;">Report Name</span></td>
      <td width="257" bgcolor="#FFFFFF">
      <p style="margin:10px 13px; ">
      <input name="ReportName" type="text" style="width: 240; height: 34; border: 1px solid #ccc ; font-size: 13px; font-family:Arial" value="<?php print $report->ReportName ?>"></td>
      	</tr>
		<tr>
    <td style="width: 91px" bgcolor="#FFFFFF">
      <p style="margin:0 5px; ">
      <span style="font-size: 13px; font-weight:100;">Report Title</span></td>
      <td width="257" bgcolor="#FFFFFF">
      <p style="margin:10px 13px; ">
      <input name="ReportTitle" type="text" style="width: 240; height: 34; border: 1px solid #ccc ; font-size: 13px; font-family:Arial"  value="<?php print $report->ReportTitle ?>"></td>
      	</tr>

		<tr>
    <td style="width: 91px" bgcolor="#FFFFFF">
      <p style="margin:0 5px; ">
      <span style="font-size: 13px; font-weight:100;">Search Field</span></td>
      <td width="257" bgcolor="#FFFFFF">
      <p style="margin:10px 13px; ">


<select type='text' name='where_column' style=' width: 240; height: 34; border: 1px solid #ccc ; font-size: 13px; font-family:Arial' >

<option value='<?php print $report->where_column ?>' ><?php print $report->where_column?></option>
<option></option>
<?php
 $stm2= $pdo->query ("SHOW COLUMNS FROM $report->ReportTable");
   while($select=$stm2->fetch(PDO::FETCH_ASSOC)){
     //print_r($select)
     ?>
      <option value="<?php echo $select['Field'] ?>" style='border-radius:15px; background-color:yellow; font-family: Arial; color: #0000FF; font-size: 15px; font-weight: bold'><?php echo $select['Field'] ?></option>
 <?php
    }
?>
</select>
      </td>
      	</tr>
		<tr>
    <td style="width: 91px" bgcolor="#FFFFFF">
      <p style="margin:0 5px; ">
      <span style="font-size: 13px; font-weight:100;">Operator</span></td>
      <td width="257" bgcolor="#FFFFFF">
      <p style="margin:10px 13px; ">
      <select type='text' name='operand' style=' width: 240; height: 34; border: 1px solid #ccc ; font-size: 11px; font-family:Arial' >

<option value='<?php print $report->operand ?>' ><?php print $report->operand ?></option>
<option></option>
<option value="=">= Equal to</option>
<option value="!=">!= Not Equal to</option>
<option value=">">> Greater than</option>
<option value="<">< Less than</option>
<option value="like">Like %value%</option>
<option value="<="> <= Less than or equal to</option>
<option value=">=">>= Greater than or equal to</option>
</select>
    </td>
      	</tr>
		<tr>
    <td style="width: 91px" bgcolor="#FFFFFF">
      <p style="margin:0 5px; ">
      <span style="font-size: 13px; font-weight:100;">Search For</span></td>
      <td width="257" bgcolor="#FFFFFF">
      <p style="margin:10px 13px; ">
      <input name="where_value" type="text" style="width: 240; height: 34; border: 1px solid #ccc ; font-size: 13px; font-family:Arial"  value="<?php print $report->where_value ?>"></td>
      	</tr>
		<tr>
    <td bgcolor="#FFFFFF" colspan="1" style="font-size: 13px">
    Search Active
  </td>
  <td width="257" bgcolor="#FFFFFF">
      <p style="margin:10px 13px; ">
      <select type='text' name='add_where' style=' width: 240; height: 34; border: 1px solid #ccc ; font-size: 13px; font-family:Arial' >
      <option value='<?php echo $report->add_where   ?>' style='border-radius:15px; background-color:yellow; font-family: Arial; color: #0000FF; font-size: 15px; font-weight: bold'><?php echo $report->add_where ?></option>
      <option value='yes' style='border-radius:15px; background-color:yellow; font-family: Arial; color: #0000FF; font-size: 15px; font-weight: bold'>yes</option>
      <option value='no' style='border-radius:15px; background-color:yellow; font-family: Arial; color: #0000FF; font-size: 15px; font-weight: bold'>no</option>
      </select>
    </td>
  
      	</tr>

		<tr>
    <td bgcolor="#FFFFFF" colspan="1">
    <span style="font-size: 13px; font-weight:100; margin:0 5px;">Date Range?</span>
  </td>
  <td width="257" bgcolor="#FFFFFF">
      <p style="margin:10px 13px; ">
      <select type='text' name='date_range' style=' width: 240; height: 34; border: 1px solid #ccc ; font-size: 13px; font-family:Arial' >
      <option value='<?php echo $report->date_range   ?>' style='border-radius:15px; background-color:yellow; font-family: Arial; color: #0000FF; font-size: 15px; font-weight: bold'><?php echo $report->date_range ?></option>
      <option value='yes' style='border-radius:15px; background-color:yellow; font-family: Arial; color: #0000FF; font-size: 15px; font-weight: bold'>yes</option>
      <option value='no' style='border-radius:15px; background-color:yellow; font-family: Arial; color: #0000FF; font-size: 15px; font-weight: bold'>no</option>
      </select>
    </td>
  
      	</tr>

		<tr>
    <td style="width: 91px" bgcolor="#FFFFFF">
      <p style="margin:0 5px; ">
      <span style="font-size: 13px; font-weight:100;">Date From</span></td>
      <td width="257" bgcolor="#FFFFFF">
      <p style="margin:10px 13px; ">
      <input name="date_from" type="date" style="width: 240; height: 34; border: 1px solid #ccc ; font-size: 13px; font-family:Arial"  value="<?php print $report->date_from ?>"></td>
      	</tr>
		<tr>
    <td style="width: 91px" bgcolor="#FFFFFF">
      <p style="margin:0 5px; ">
      <span style="font-size: 13px">Date To</span></td>
      <td width="257" bgcolor="#FFFFFF">
      <p style="margin:10px 13px; ">
      <input name="date_to" type="date" style="width: 240; height: 34; border: 1px solid #ccc ; font-size: 13px; font-family:Arial"  value="<?php print $report->date_to ?>"></td>
      	</tr>

		<tr>
    <td bgcolor="#FFFFFF" colspan="1">
    &nbsp;</td>
  <td width="257" bgcolor="#FFFFFF">
      &nbsp;</td>
  
      	</tr>

		<tr>
    <td bgcolor="#FFFFFF" colspan="2">
      &nbsp;</td>
      	</tr>

		<tr>
    <td bgcolor="#FFFFFF" colspan="2" style="height: 50px;">
      <p style="margin: 0 5px"><font size="3" color="#800000">Report Manager
		URL's</font></td>
      	</tr>
		<tr>
    <td style="width: 91px" bgcolor="#FFFFFF">
      &nbsp;<button name='hold' type='button' style="width: 90; height: 20; border: 1px solid #C0C0C0 ; font-size: 10px; font-family:Arial; background-color:#F2F2F2; vertical-align: middle; text-align: left; padding-left: 5px;">
      <img border='0' src='static/icon16/add.jpg' width='15' height='15' id="test" style="vertical-align: middle" >&nbsp; Add URL</button>
      </td>
      <td width="257" bgcolor="#FFFFFF">
      <p style="margin: 10px 13px">
      <input name="AddURL" type="text" style="width: 240; height: 34px; border: 1px solid #C0C0C0 ; font-size: 11px; font-family:Arial"  value="<?php print $report->AddURL ?>">
      </td>
      	</tr>
		<tr>
    <td style="width: 91px" bgcolor="#FFFFFF">
      &nbsp;<button name='hold' type='button' style="width: 90; height: 20; border: 1px solid #C0C0C0 ; font-size: 10px; font-family:Arial; background-color:#F2F2F2; vertical-align: middle; text-align: left; padding-left: 5px;">
      <img border='0' src='static/icon16/edit.jpg' width='15' height='15' id="test" style="vertical-align: middle" >&nbsp; Edit URL</button>
      </td>
      <td width="257" bgcolor="#FFFFFF">
      <p style="margin: 10px 13px">
      <input name="EditURL" type="text" style="width: 240; height: 34px; border: 1px solid #C0C0C0 ; font-size: 11px; font-family:Arial"  value="<?php print $report->EditURL ?>"></td>
      	</tr>

		<tr>
    <td style="width: 91px" bgcolor="#FFFFFF">
      &nbsp;<button name='hold' type='button' style="width: 90; height: 20; border: 1px solid #C0C0C0 ; font-size: 10px; font-family:Arial; background-color:#F2F2F2; vertical-align: middle; text-align: left; padding-left: 5px;">
      <img border='0' src='static/icon16/delete.jpg' width='15' height='15' id="test" style="vertical-align: middle" >&nbsp; Delete URL</button>
      </td>
      <td width="257" bgcolor="#FFFFFF">
      <p style="margin: 10px 13px">
      <input name="DeleteURL" type="text"  style="width: 240; height: 34px; border: 1px solid #C0C0C0 ; font-size: 11px; font-family:Arial"  value="<?php print $report->DeleteURL ?>"> </td>
      	</tr>
		</table>
</td>
      <td width="448" bgcolor="#FFFFFF" height="155" valign="top">
      <table id="server-setting" border="1" width="98%" cellspacing="1" style="font-size: 8pt; font-family: Arial; font-weight: bold; border-collapse: collapse" bordercolor="#C0C0C0">
		<tr style="height: 37px;">
      <td width="450" bgcolor="#F0F0F0" colspan="2">
      <font size="3" color="#800000">Server Side Settings: </font></td>
  		</tr>
		<tr>
      <td width="134" bgcolor="#FFFFFF">
      <p style="margin: 0 5px">DataTable&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
      <td width="273" bgcolor="#FFFFFF">
      <p style="margin: 10px 13px">
                           <input name="ReportTable" type="text" style="width: 240px; height: 34px; border: 1px solid #C0C0C0 ; font-size: 13px; font-family:Arial; background-color:#F2F2F2 "  readonly="true" value="<?php print $report->ReportTable ?>" size="20">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

</td>
  		</tr>
		<tr>
      <td width="110" bgcolor="#FFFFFF">
      <p style="margin: 0 5px">Union With&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
      <td width="319" bgcolor="#FFFFFF">
      <p style="margin: 10px 13px">
             <input name="union_tables"  type="text" style="width: 240px; height: 34px; border: 1px solid #C0C0C0 ; font-size: 13px; font-family:Arial"  value="<?php print $report->union_tables ?>"></td>
  		</tr>
		<tr>
      <td width="134" bgcolor="#FFFFFF">
      <p style="margin: 0 5px">Key Values</td>
      <td width="273" bgcolor="#FFFFFF">
      <p style="margin: 10px 13px">
      
      <input name="KeyValue" type="text" style="width: 75; height: 34px; text-align: center; border: 1px solid #C0C0C0 ; font-size: 13px; font-family:Arial; background-color:#F2F2F2" readonly="true" value="<?php print $keyid ?>">
      &nbsp;*&nbsp<input name="n/a1" type="text" style="width: 50; text-align: center; height:34px; border: 1px solid #C0C0C0 ; font-size: 13px; font-family:Arial; background-color:#F2F2F2" readonly="true" value="<?php print $report->id ?>" size="20">
      &nbsp;*&nbsp;<input name="n/a" type="text" style="width: 105px; text-align: center; height: 34px; border: 1px solid #C0C0C0 ; font-size: 13px; font-family:Arial; background-color:#F2F2F2" readonly="true" value="<?php print $report->RecordNo ?>">

</td>
  		</tr>
		<tr>
    <td style="width: 134px" bgcolor="#FFFFFF">
      <p style="margin:0 5px; ">Default URL</td>
      <td width="273" bgcolor="#FFFFFF">
      <p style="margin:10px 13px; ">
      <input name="ReportOpenURL" type="text" style="width: 267; height: 34px; border: 1px solid #C0C0C0 ; font-size: 13px; font-family:Arial; background-color:#F2F2F2"  readonly="true" value='<?php print "reports_ajax.php?RecordNo=". $report->RecordNo ;  ?>'>
    </td>
      	</tr>
		<tr>
    <td style="width: 134px" bgcolor="#FFFFFF">
      <p style="margin:0 5px; ">Custom URL</td>
      <td width="273" bgcolor="#FFFFFF">
      <p style="margin:10px 13px; ">
      <input name="ReportCustomURL" type="text" style="width: 240; height: 34px; border: 1px solid #C0C0C0 ; font-size: 13px; font-family:Arial; background-color:#F2F2F2"   value='<?php print $report->ReportCustomURL ?>'>
    </td>
      	</tr>

		<tr>
      <td width="134" bgcolor="#FFFFFF">
      <p style="margin: 0 5px">Report Color</td>
      <td width="273" bgcolor="#FFFFFF" style="margin: 0 5px; ">
      <p style="margin: 10px 13px; ">
                                                <input type="color" name="ReportColor" style="padding: 0px; width: 240; height: 34px; border: 1px solid #C0C0C0 ; font-size: 13px; font-family:Arial; background-color:White" value="<?php print $report->ReportColor ?>">
       
     FontSize&nbsp;<select name="FontSize" style="font-size: 13px; font-family: Arial; height: 34px;">
	<option value="<?php if ($report->id > 0) { echo $report->FontSize ;} Else { echo '9pt' ;} ?>"><?php if ($report->id > 0) { echo $report->FontSize ;} Else { echo '9pt' ;} ?></option>
	<option>6pt</option>
	<option>7pt</option>
	<option>8pt</option>
	<option>9pt</option>	
	<option>10pt</option>	
	<option>11pt</option>	
	<option>12pt</option>	
	</select>&nbsp;
       
       
       
            </p></td>
  		</tr>

		<tr>
      <td width="134" bgcolor="#FFFFFF">
      <p style="margin: 0 5px">Show No Rows</td>
      <td width="273" bgcolor="#FFFFFF">
      <p style="margin: 10px 13px">
      &nbsp;1:<input name="NoRows1" type="text" style="width: 30; text-align: center; height: 34px; border: 1px solid #C0C0C0 ; font-size: 13px; font-family:Arial" value="<?php print $report->NoRows1 ?>">
      &nbsp;2:<input name="NoRows2" type="text" style="width: 30; text-align: center; height: 34px; border: 1px solid #C0C0C0 ; font-size: 13px; font-family:Arial" value="<?php print $report->NoRows2 ?>">
      &nbsp;3:<input name="NoRows3" type="text" style="width: 30; text-align: center; height: 34px; border: 1px solid #C0C0C0 ; font-size: 13px; font-family:Arial" value="<?php print $report->NoRows3 ?>">
      &nbsp;4:<input name="NoRows4" type="text" style="width: 30; text-align: center; height: 34px; border: 1px solid #C0C0C0 ; font-size: 13px; font-family:Arial" value="<?php print $report->NoRows4 ?>">
      (&nbsp;-1 = All )</td>

  		</tr>

		<tr>
      <td width="134" bgcolor="#FFFFFF">
      <p style="margin: 0 5px">Print Settings</td>
      <td width="273" bgcolor="#FFFFFF" style="margin: 0 5px; ">
      <p style="margin: 10px 13px; ">

Orientation: &nbsp;<select name="PrintOrientation" style="font-size: 13px; font-family: Arial; height: 34px;
    width: 180px;">
	<option value="<?php if ($report->id > 0) { echo $report->PrintOrientation ;} Else { echo 'landscape' ;} ?>"><?php if ($report->id > 0) { echo $report->PrintOrientation ;} Else { echo 'landscape' ;} ?></option>
	<option>landscape</option>
	<option>portrait</option>
	</select>&nbsp;

Paper:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<select name="PrintPaper" style="font-size: 13px; font-family: Arial; height: 34px;
    width: 180px; 
    margin-top: 20px;">
	<option value="<?php if ($report->id > 0) { echo $report->PrintPaper ;} Else { echo 'landscape' ;} ?>"><?php if ($report->id > 0) { echo $report->PrintPaper ;} Else { echo 'landscape' ;} ?></option>
	<option>letter</option>
	<option>legal</option>
	<option>tabloid</option>
	</select>&nbsp;
      </p>

      </td>
  		</tr>

		<tr>
      <td width="134" bgcolor="#FFFFFF">
      &nbsp;</td>
      <td width="273" bgcolor="#FFFFFF">
      &nbsp;</td>
  		</tr>

		<tr>
      <td width="134" bgcolor="#FFFFFF">
      <p style="margin: 0 5px">&nbsp;</td>
      <td width="273" bgcolor="#FFFFFF">
      <p style="margin: 0 5px">

</td>
  		</tr>

		</table>
	</td>
  </tr>
	<tr style="height: 50px;">
    <td bgcolor="#FFFFFF" valign="top" width="723" colspan="2" style="padding: 7px;">
	<p style="margin-top: 0; margin-bottom: 0">
      <font size="3" color="#800000">Report Notes In Header </font></p>
	<p style="margin-top: 0; margin-bottom: 0">
	<textarea rows="1" name="ReportHeader" cols="100"><?php print $report->ReportHeader; ?></textarea></td>
  </tr>
  <tr>
    <td width="750" colspan="2" bgcolor="#FFFFFF">

<!-- ***** FIELD LIST ************************************************************ -->

<table id="reports_notes" border="1" bordercolor="Silver" cellpadding='0' style='width: 100%; margin-left: 5px; border-collapse: collapse; font-family: Arial; font-size:10pt; color:#FFF; font-weight: normal'>

<tr>
   <td style='font-family: Arial; font-size: 9pt; background-color: #343a40; text-align:center;'>Show</td>
   <td style='font-family: Arial; font-size: 9pt; background-color: #343a40; text-align:center;'>Sort</td>
   <td style='font-family: Arial; font-size: 9pt; background-color: #343a40; text-align:center;'>ColumnName</td>
   <td style='font-family: Arial; font-size: 9pt; background-color: #343a40; text-align:center;'>ColumnLabel</td>
   <td style='font-family: Arial; font-size: 9pt; background-color: #343a40; text-align:center;'>SUM</td>
   <td style='font-family: Arial; font-size: 9pt; background-color: #343a40; text-align:center;'>SEL</td>
   <td style='font-family: Arial; font-size: 9pt; background-color: #343a40; text-align:center;'>Align</td>
   <td style='font-family: Arial; font-size: 9pt; background-color: #343a40; text-align:center;'>Width</td>
   <td style='font-family: Arial; font-size: 9pt; background-color: #343a40; text-align:center;'>Value</td>
   <td style='font-family: Arial; font-size: 9pt; background-color: #343a40; text-align:center;'>Color</td>
   <td style='font-family: Arial; font-size: 9pt; background-color: #343a40; text-align:center;'>Opt</td>   
   <td style='font-family: Arial; font-size: 9pt; background-color: #343a40; text-align:center;'>MANAGE</td>
</tr>

<?php
$ck = 0;
$line=0;
// Define alternating row colors
$color1 = "#FFFFFF";
$color2 = "#F2F2F2";
$row_count = 0;
 $stmt3= $pdo->query ("SELECT * FROM `reports_fields` WHERE `RecordNo` = '{$formid}' ORDER BY sort");
   while($row2=$stmt3->fetch(PDO::FETCH_ASSOC)){
     //print_r($row2);
       $row_color = ($row_count % 2) ? $color1 : $color2;
       $style_default = "height:18px; padding-right: 3px; padding-left: 3px; border: 0px solid Silver; font-family: Arial; font-size: 9px; color: Black;";

     $CheckedRows = $row2['Active'] ;
     $SumRows     = $row2['RowSumCK'] ;

    if ( $CheckedRows == 'checked' ) {
     echo "<input type='hidden'  name='F[$row2[id]][RowSumNO]'  value='$ck'  style='$style_default width:10px;  text-align:left;  background-color:$row_color;'>";
     // echo $ck . " = " . $SumRows  ;

$ck++ ;
}

$stm2= $pdo->query ("SHOW COLUMNS FROM $report->ReportTable");

echo "<tr>\n
         <td style='background-color:$row_color;'><input type='checkbox' name='F[$row2[id]][Active]' value='$row2[Active]' $row2[Active]  onclick='YesOrNo();' style='padding-left: 5px; font-size: 12px; background-color:$row_color; '>    </td>\n
         <td><input type='text'     name='F[$row2[id]][sort]'   value='$row2[sort]'   required style='$style_default width:24px; text-align:left; background-color:$row_color;'></td>\n
        <td>

<select type='text' name='F[$row2[id]][FieldName]' value='$row2[FieldName]'  required style='width: 150; height: 19; border: 0px solid #C0C0C0 ; font-size: 11px; font-family:Arial; background-color:$row_color;' >
<option>$row2[FieldName]</option>";
 while($select=$stm2->fetch(PDO::FETCH_ASSOC)){
 echo "<option value='$select[Field]' style='border-radius:15px; background-color:yellow; font-family: Arial; color: #0000FF; font-size: 15px; font-weight: bold'>$select[Field] </option>" ;
 }
 echo "<option value='MANAGE' style='border-radius:15px; background-color:yellow; font-family: Arial; color: #0000FF; text-transform: uppercase; font-size: 15px; font-weight: bold'>MANAGE</option>" ;
 echo "</select>";

echo " </td>
        <td><input type='text'     name='F[$row2[id]][LabelHead]'  value='$row2[LabelHead]' style='$style_default width:150px; text-align:left;  background-color:$row_color;'></td>
        <td style='background-color:$row_color;'><input type='checkbox' name='F[$row2[id]][RowSumCK]'   value='$row2[RowSumCK]'  $row2[RowSumCK] onclick='YesOrNo();' style='padding-left: 5px; font-size: 12px; background-color:$row_color; '></td>
        <td style='background-color:$row_color;'><input type='checkbox' name='F[$row2[id]][RowPDF]'     value='$row2[RowPDF]'    $row2[RowPDF]   onclick='YesOrNo();' style='padding-left: 5px; font-size: 12px; background-color:$row_color; '></td>
        
        <td><select name='F[$row2[id]][FieldAlign]' style='width: 60; height: 19; border: 0px solid #C0C0C0 ; font-size: 11px; font-family:Arial; background-color:$row_color; '>
	    <option value='$row2[FieldAlign]'>$row2[FieldAlign]</option>
	    <option>left</option>
	    <option>right</option>
	    <option>center</option> </select></td>          
       
        <td><input type='text'   name='F[$row2[id]][FieldWidth]' value='$row2[FieldWidth]' style='$style_default width:75px;  text-align:left;  background-color:$row_color;'></td>
        <td><input type='text'   name='F[$row2[id]][FieldValue]' value='$row2[FieldValue]' style='$style_default width:75px;  text-align:left;  background-color:$row_color;'></td>
        <td><input type='color'  name='F[$row2[id]][RowColor]'   value='$row2[RowColor]'   style='$style_default width:35px; text-align:left;   background-color:$row_color;'></td>
        <td><input type='text'  name='F[$row2[id]][opacity]'    value='$row2[opacity]'    style='$style_default width:35px; text-align:left;   background-color:$row_color;'></td>
        <td  style='width: 100px; text-align:center; background-color:$row_color;'>
        <a href='reports_fields_add.php?RecordNo=$row2[RecordNo]'><img border='0' src='static/icon25/add.jpg'    width='14' height='14' style='margin:0 1px;'></a>
        <a href='reports_fields_delete.php?id=$row2[id]'>         <img border='0' src='static/icon25/delete.jpg' width='14' height='14' style='margin:0 1px;'></a>

        </td>
</tr>";

$select++;
$line++;
$row_count++;
}


?>
</table>


<!-- ***** END FIELDS ************************************************************ -->
      </td>
  </tr>
  </table>
</td>
</tr>
</table>
</td>
</tr>
</table>
</div>
