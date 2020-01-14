<?php 
include("header.php");
require("includes/pdo_start_admin.php"); 
function select($query,$table,$pdo)
{
    if($table=='reports'){
        return $query_result= $query ?  $pdo->query("SELECT * FROM $table WHERE id = '{$query}'"):  $pdo->query ("SELECT * FROM $table");
    }
    if($table=='reports_fields'){
       return $reports_fields= $pdo->query ("SELECT * FROM $table WHERE RecordNo ='{$query}' AND NOT FieldName = 'MANAGE' ORDER BY sort limit 1");
    } 
}
?>