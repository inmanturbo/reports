<style>

</style> 
 <?php 
 include("header.php");
 ?>
<!-- CUSTOM TOOLBAR ITMS LOADE IN THIS ORDER  -->

<!-- PAGE TITLE FIRST--> 
<div style="border: 1px solid DarkGrey; height: 43px !important; width: 100%; padding-left: 2px; padding-top: 4px; background-color: Blue ; opacity: .95; ">
   <i class="reportTitle" > GENERAL LEDGER</i>

   <?php if($report->date_range == 'yes'){ 
     // echo "yes";
      ?>
    
<!-- INPUT DATE RANGE  -->
   <i class="toolbarContent" style="border: 0px solid DarkGrey; height: 29px !important; width: 75px; padding-left: 2px; padding-top: 4px; background-color: Gainsboro ;" > DATE FROM:</i>
     <input class="toolbarContent" style="border: 1px solid DarkGrey; width: 130px;"  type="date" name="qw_date1" value="<?php print $set->qw_date1; ?>"  >
   <i class="toolbarContent" style="border: 1px solid DarkGrey; height: 24px !important; width: 60px; padding-left: 4px; padding-top: 4px; background-color: Gainsboro ;" > DATE TO:</i>   
     <input class="toolbarContent" style="border: 1px solid DarkGrey; width: 130px;"  type="date" name="qw_date2" value="<?php print $set->qw_date2; ?>"  > 
   <?php } ?>

<!-- SAVE GROUP IF CHECKED / UNCHECKED <span   class="toolbarContent" style="border: 1px solid DarkGrey ; width: 65px;"> </span> -->   
   <i class="toolbarContent" style="border: 1px solid DarkGrey; height: 24px !important; width: 73px;color:#fff; padding-left: 4px; padding-bottom: 6px;" > 
   Group <input style="border: 1px; transform: scale(1.20);  padding: 0px;" type="checkbox" name="qw_group" value=""></i>
   <button class="toolbarContent" style="border: 1px solid DarkGrey;"  type="submit" name="Save" value="Save" ><i class="fas fa-save" style="font-size: 12pt; color: Blue; "></i>&nbsp; SAVE</button> 

<!-- DATABASE DROPDOWN SELECTION FROM DATABASE--> 
   <form method="post" style="display:inline-block !important ;" >
     <select class="toolbarContent" name="qw_year" onchange="this.form.submit()"  style="width: 150px !important;">
        <option>
        <?php 
        if (isset($_GET['qw_year']) > 0 ) 
        { 
           echo "YEAR &nbsp;" . $_GET['qw_year']; }
            else { 
              echo "SELECT YEAR";
              } 
              ?>
        </option>
        <option value="2020">2020</option>
        <option value="2019">2019</option>
        <option value="2018">2018</option>
        <option value="2017">2017</option>
        <option value="2016">2016</option>
     </select>
     <?php if (isset($_POST['qw_year']) ){$year = $_POST['qw_year'] ;
      header("Location: ./gl_detail.php?qw_year=$year");}?>
   </form>

<!-- LOAD JASON BUTTONS Bftrip HERE --> 
</div>

<!-- SEARCH BOX LOADS HERE -->   
