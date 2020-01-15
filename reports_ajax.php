<?php
// DATABASE CONNECTION
require("includes/pdo_start_admin.php");
include("header.php");
$formid = $_GET["RecordNo"];
$report_stmt = $pdo->query ("SELECT * FROM `reports` WHERE RecordNo ='{$formid}' "); 
 while($row = $report_stmt->fetch(PDO::FETCH_OBJ)){
    $report = $row;
    //print_r($report);
}
$str='';
$Show1='';
$Show2='';

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// GET SELECTED COLUMNS FOR THIS REPORT 
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$field_stmt = $pdo->query ("SELECT * FROM `reports_fields` WHERE RecordNo ='$formid' AND Active = 'checked' ORDER BY sort "); // AND NOT FieldName = 'MANAGE'
  while($field_row = $field_stmt->fetch(PDO::FETCH_OBJ)){
    $field = $field_row;
    //print_r($field);
    $columns[] = [
        'data' => $field->FieldName
    ];
       
}
// TEST REPORT SELECTION OUTPUTS 
// echo json_encode( $columns ) ;
// echo "SELECTION ->" . $c_database . $table1 . $formid ;

// TABLE EMPTY ERROR
   if(empty($report->ReportTable))  { 
   die( "<div style='margin: 0px; text-align: center; width: 100%; border: 1px solid #C0C0C0; height: 19; font: 12px arial; font-weight: bold; background-color: Yellow' > I N V A L I D   S E L E C T I O N " . $c_database . $report->ReportTable . $formid . " </div>");
    }
    
// SELECT DROPDOWN IN REPORT COLUMN
$xpdf = $pdo->query ("SELECT * FROM `reports_fields` WHERE RecordNo ='{$formid}' ORDER BY sort");
 while($pdf=$xpdf->fetch(PDO::FETCH_OBJ)){
   $RowSumNO = $pdf->RowSumNO ;
   
     if ( $pdf->RowPDF == 'checked' ) { 
         $str .= $RowSumNO . ",";  
        }
}    
  $pdfPRINT = rtrim($str,",");
     // echo $pdfPRINT ;

// CODE TO SHOW NUMBER OF ROWS 
if ( $report->NoRows1 == '-1' ) { $R1 = "'Show All',"; } else { $R1 = "'" . $report->NoRows1. " rows',"; } ;
if ( $report->NoRows2== '-1' ) { $R2 = "'Show All',"; } else { $R2 = "'" . $report->NoRows2. " rows',"; } ;
if ( $report->NoRows3 == '-1' ) { $R3 = "'Show All',"; } else { $R3 = "'" . $report->NoRows3 . " rows',"; } ;
if ( $report->NoRows4== '-1' ) { $R4 = "'Show All'";  } else { $R4 = "'" . $report->NoRows4. " rows'"; } ;

// NUMBER ROWS OUTPUT
$rowNo = $report->NoRows1. ',' . $report->NoRows2. ',' . $report->NoRows3 . ',' . $report->NoRows4;
$rowTx = $R1 . $R2 . $R3 . $R4 ;

// $rowTx = "'" . $report->NoRows1. "rows'," . "'" . $report->NoRows2. "rows'," . "'" . $report->NoRows3 . "rows'," . "' Show All'" ;
// echo $rowNo . "<br>" .  $rowTx;
// END NUMNER OF ROWS

// WHICH COLUMNS TO CALCULATE
$MC= $pdo->query ("SELECT * FROM reports_fields WHERE RecordNo = '{$formid}' AND FieldName = 'MANAGE'  limit 1");
 while($rowMC=$MC->fetch(PDO::FETCH_OBJ)){
  // echo $rowMC->RowSumNO ;
$ManageContent = $rowMC->Active ;
}

// ***** FIRST COLUMN CALCULATION
$x1 = 0;
$c1= $pdo->query ("SELECT * FROM reports_fields WHERE RecordNo = '{$formid}' AND RowSumCK = 'checked' ORDER BY sort ");
 while($row01=$c1->fetch(PDO::FETCH_OBJ)){

  if($x1 == 0 && $row01->RowSumCK == 'checked'){
      $Show1 .= $row01->RowSumNO; $x1=1 ; // show the first row
};
$x1++;
}

// ***** SECOND COLUMN CALCULATION
$x2 = 0;
$c2= $pdo->query ("SELECT * FROM reports_fields WHERE RecordNo = '{$formid}' AND RowSumCK = 'checked' ORDER BY sort ");
 while($row02=$c2->fetch(PDO::FETCH_OBJ)){

  if($x2 == 1 && $row02->RowSumCK == 'checked'){
      $Show2 .= $row02->RowSumNO; $x2=2 ; // show the first row
};
$x2++;
}
// END CALCULATION CODE
?>

<body style="margin: 0">
<html>
<head>
<!-- My link -->
  
<script>

$(document).ready(function() {


    $('#example').DataTable({
    
  processing: true,  // ALERT DATA IS PROCESSING
  // stateSave: true,   // WILL SAVE LAST POSITION
  
        ajax: {
            type: "POST",
            datatype: "json",
            
  
              
              url: "http://localhost:8888/api/reports/<?php echo $c_database;?>/<?php echo $report->id; ?>/<?php echo $report->ReportTable; ?>/<?php echo $report->union_tables??''; ?>"        

          
                         
            // "dataSrc": "",            
            // "url": "gl_detail_data.php"              
       },
      
        columns: <?php echo json_encode( $columns ) ; ?>,

// ORDER DATA see reference https://datatables.net/examples/basic_init/multi_col_sort.html SAMPLE: [[ 7, 'asc' ], [ 7, 'des' ]],
          order: [ 1, 'asc' ],  

// LOAD LENGTH FROM DATABASE       
      // lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "Todos"] ], 
      lengthMenu: [[ <?php echo $rowNo ?>  ], [ <?php echo $rowTx  ?> ]],

        //dom: 'Bfrtip',
        dom: '<"toolbar">Bfrtip',
    buttons: [ 
                // { className: 'qwMemo',     text: '<?php echo $report->ReportName ?>' },
                
                 { extend: 'pageLength', className: 'qwButton', text: '<i class="fas fa-list-ol" style="font-size: 12pt; color: Blue; padding: 0px !important; margin-bottom: 4px !important; "></i>' },
                 { extend: 'collection', className: 'qwButton', buttons: ['csv', 'excel'],  text: '<i class="fas fa-download"  style="font-size: 12pt; color: Blue; padding: 0px !important; margin-bottom: 4px !important; ">&nbsp;</i>' },    
                 { className: 'qwButton',   text: '<i class="fas fa-sync" style="font-size: 12pt; color: Blue; padding: 0px !important; margin-bottom: 4px !important; ">&nbsp;</i>', action: function ( ) {  window.open('reports_ajax.php?RecordNo=<?php echo $formid; ?>','_self');  }  }, 
                 // { className: 'qwButton',   text: '<i class="fas fa-plus-square" style="font-size: 10pt; color: ForestGreen; margin: 0px; " onclick="PopupCenterDual(\'gl_master_entry.php\',\'NIGRAPHIC\',\'750\',\'450\')">&nbsp;NEW</i>' },                      
                 //{ className: 'qwButton',   text: '<i class="fas fa-plus-square" style="font-size: 10pt; color: ForestGreen; margin: 0px; ">&nbsp;</i>NEW', action: function ( ) {  window.open('/qwoffice/gl_master_entry.php','_self'); }  }, 
                 //{ className: 'qwButton',   text: '<i class="fas fa-list"        style="font-size: 10pt; color: ForestGreen; margin: 0px; ">&nbsp;</i>SELECT ALL', action: function ( ) {  window.open('/qwoffice/gl_detail.php?all=all','_self');  }  },
                 { className: 'qwButton',   text: '<i class="fa fa-cog" style="font-size: 12pt; color: Blue; padding: 0px !important; margin-bottom: 4px !important; "></i> &nbsp;Setup',      action: function ( ) {  window.open('/qwoffice/reports_entry.php?RecordNo=<?php echo $formid ?>','_self');    }  },
                ], // end buttons
 

<?php if ( $ManageContent == 'unchecked' ) { echo "/*"; } ?>

                 "columnDefs": [ {
                 "targets": -1,
                 "data": null,
                 "defaultContent": "<a href='gl_master_entry.php'><img border='0' src='static/icon16/add.jpg' width='16' height='16' style='margin: 1px'></a><a><img border='0' src='static/icon16/edit.jpg' width='16' height='16' style='margin: 1px'></a>" } ],

<?php if ( $ManageContent == 'unchecked' ) { echo "*/"; } ?>

                 "footerCallback": function ( row, data, start, end, display ) {
                     var api = this.api(), data;

                     // Remove the formatting to get integer data for summation
                     var intVal = function ( i ) {
                         return typeof i === 'string' ?
                             i.replace(/[\$,]/g, '')*1 :
                             typeof i === 'number' ?
                                 i : 0;
                     };


<?php if (empty($Show1)) { echo "/*"; } ?>

                     // Total over all pages
                     total = api
                         .column( <?php echo $Show1 ?> )
                         .data()
                         .reduce( function (a, b) {
                             return intVal(a) + intVal(b);
                         }, 0 );

                     // Total over this page
                     pageTotal = api
                         .column( <?php echo $Show1 ?>, { page: 'current'} )
                         .data()
                         .reduce( function (a, b) {
                             return intVal(a) + intVal(b);
                         }, 0 );

                     // Update footer
                     $( api.column( <?php echo $Show1 ?> ).footer() ).html(
                         '$'+pageTotal.toFixed(2)
                     );

<?php if (empty($Show1)) { 
    echo "*/"; 
    //echo "fdddd";
    }
    else{
        //print_r($Show1);
    }
    ?>

// ***** END FIRST ROW CALCULATION CODE


// FIRST CALULACTION ========================================================

<?php if (empty($Show2)) { echo "/*"; } ?>

                     // Total over all pages
                     total = api
                         .column( <?php echo $Show2 ?> )
                         .data()
                         .reduce( function (a, b) {
                             return intVal(a) + intVal(b);
                         }, 0 );

                     // Total over this page
                     pageTotal = api
                         .column( <?php echo $Show2 ?>, { page: 'current'} )
                         .data()
                         .reduce( function (a, b) {
                             return intVal(a) + intVal(b);
                         }, 0 );

                     // Update footer
                     $( api.column( <?php echo $Show2 ?> ).footer() ).html(
                         '$'+pageTotal.toFixed(2)
                     );

<?php if (empty($Show2)) { echo "*/"; } ?>

// ========================================================

                 },
// END COLUMN CALCULATUON FUNCTION 

   
// COLUMN DROP DOWN SEARCH   
          initComplete: function () { <?php echo $pdfPRINT ?>
          
            // this.api().columns([1,2,3,4,5,6,7,8,9,10,11]).every( function () {           
            this.api().columns([<?php echo $pdfPRINT ?>]).every( function () { 
                var column = this;
                //var select = $('<select><option value=""></option></select>')                
                  var select = $('<select style="max-width: 175px; border-bottom-left-radius: 2px; border-bottom-right-radius:2px; height: 18px; font-size: 10px; font-family: arial; font-weight: normal; color: Blue;"><option value=""></option></select>')

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
    // END DROP DOWN SEARCH
        
        
    } );
    var toolbar = document.getElementById('toolbarDiv').innerHTML;
    //console.log(toolbar);
    //alert(toolbar);
    $("div.toolbar").html(toolbar);
} );//end document ready


</script>
<!-- My Css -->

<?php
// STYLE SELECTIONS FROM SETUP



// cell formatting
$table3= $pdo->query ("SELECT * FROM `reports_fields` WHERE RecordNo='{$formid}' AND Active = 'checked' ORDER BY sort");

?>


<style>
/* form actions buttons: save, refresh, close etc  */

td {  
padding: 0px !important; 
font-weight: normal;  
color: black; 
font-size: <?php echo $report->FontSize ?> ; 
height: 12px; 
white-space: nowrap; 
}
th { background-color: <?php echo $report->ReportColor ?> !important; padding: 2px !important; font-weight: bold; color: black; font-size: 8pt; height: 20px; white-space: nowrap; }

/* ORIGINAL STYLING

// CODED FROM SETUP*/
<?php

$rct = 1 ;

  while($tbody=$table3->fetch(PDO::FETCH_OBJ)){
    $opacity='';
    $MainColor='';
  // KEEP WHITE BLANK FOR ALTERNATE ROW COLORS - ALLOW SOLID COLUMN COLOR
  if ( $tbody->RowColor == '#ffffff' ) { $ColumnColor = ""; } else { $ColumnColor = $tbody->RowColor; }
   echo" tr td:nth-child( $rct ) { text-align:$tbody->FieldAlign ;  background-color: $ColumnColor !important; opacity: $opacity: }"; $rct++ ;
  
  } 
?>  
  
td {  
padding: 0px !important; 
font-weight: normal;  
color: black; 
font-size: <?php echo $report->FontSize?> ; 
height: 12px; 
white-space: nowrap; 
}

<?php echo "thead { background-color: $MainColor !important;}"; ?>
th { background-color: <?php echo $MainColor ?> !important; padding: 2px !important; font-weight: bold; color: black; font-size: 8pt; height: 20px; white-space: nowrap; }
/*


table.dataTable tfoot th:nth-child(6) { text-align: right !important; background-color: red;}
table.dataTable tfoot th:nth-child(7) { text-align: right !important;}

table.dataTable thead th:nth-child(6) {  width: 60px; }
table.dataTable thead th:nth-child(7) {  width: 60px; }
table.dataTable thead th:nth-child(8) {  width: 60px; }

table.dataTable tfoot th, table.dataTable tfoot td{font-size: 8pt !important; padding-left: 5px !important;}

.qw-search:last-child { display: none;}*/

.qw-search::after {
    /* Decrement "my-sec-counter" by 1 */
    counter-increment: my-sec-counter -1;
    content: counter(my-sec-counter);
}

// .qw-container{padding: 10px 3px;}

table.dataTable thead th {
  white-space: nowrap;
  text-align: left !important;
}

.test { text-align: right; }

.qw-top-btns{ position:relative;top:26;left:78%;z-index:999; }

</style>
</head>

<body>


<body>
<div class="qw-container">

 <table id="example" class="display" style="font-family: Arial; font-size: 9pt; padding: 0;">
   <thead>
<!-- COLUMN LABELS -->   
     <tr>
<?php
   $table1= $pdo->query ("SELECT * FROM `reports_fields` WHERE RecordNo='{$formid}' AND Active = 'checked' ORDER BY sort");
     while($thead = $table1->fetch(PDO::FETCH_OBJ)){ 
        //print_r($thead->LabelHead);
       //echo "hcvcvcekk";
         ?>
            
          <th style='width: <?php echo  $thead->FieldWidth ?> px !important; text-align: $thead->FieldAlign !important'> <?php echo $thead->LabelHead ?> </th>
          
 <?php } ?>

<!-- <th style='width: $tfoot->FieldWidth !important; text-align: $tfoot->FieldAlign !important'>MANAGE</th> -->
    </tr>
<!-- DROP DOWN SELECTION -->
     <tr>
<?php
   $table1= $pdo->query ("SELECT * FROM `reports_fields` WHERE RecordNo='{$formid}' AND Active = 'checked' ORDER BY sort");
     while($thead = $table1->fetch(PDO::FETCH_OBJ)){ 
         //print_r($thead->FieldAlign);
         ?>

        <th style="width: <?php echo $thead->FieldWidth ?> px !important; text-align:<?php echo  $thead->FieldAlign ?> !important"></th>

<?php } ?>

    </tr>
  </thead>

  <tfoot>
    <tr>
<?php
  $table2= $pdo->query ("SELECT * FROM `reports_fields` WHERE RecordNo='{$formid}' AND Active = 'checked' ORDER BY sort");
    while($tfoot=$table2->fetch(PDO::FETCH_OBJ)){ ?>

        <th style='width: <?php echo $tfoot->FieldWidth ?> !important; text-align: <?php echo $tfoot->FieldAlign ?> !important'></th>

 <?php } ?>
<!-- <th style='width: $tfoot->FieldWidth !important; text-align: $tfoot->FieldAlign !important'>MANAGE</th> -->
   </tr>
</tfoot>

</table>
<br>
<br>
<br>
</div>
<div style="display:none">
<div id="toolbarDiv" >


<?php include "reports_toolbar.php"; ?>



</div>
</div>
</body>
</html>

