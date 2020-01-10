<style>
.toolbarContainer {
  // float: left !important;
  height: 28px ;
  width: 100%;
  border: 0px solid red;
  margin: 0px;
  padding-right: 5px;
  vertical-align: middle !important; 
  display: inline-block !important ;
}
.toolbarContent {
  height: 22px ;
  margin-right: 0px;
  margin-bottom 0px;
  font: normal 12px arial, sans-serif; color: black;
  vertical-align: middle !important; 
  display: inline-block !important ;
}
.reportTitle {
  border: 0px solid DarkGrey; 
  height: 16px !important; 
  /* padding-left: 2px; */
  margin-right: 10px !important;
  padding: 4px !important; 
  font-family: Arial !important; font-size: 14pt !important; 
  color: PowderBlue !important ; 
  font-weight: bold !important; 
}
.toolbarContent:hover {
	background-color: PowderBlue ;
}
</style> 
 
<!-- CUSTOM TOOLBAR ITMS LOADE IN THIS ORDER  -->

<!-- PAGE TITLE FIRST--> 
<div style="border: 1px solid DarkGrey; height: 16px !important; width: 75px; padding-left: 2px; padding-top: 4px; background-color: Blue ; opacity: .95; ">
   <i class="reportTitle" > GENERAL LEDGER</i>

   <?php if($report->date_range == 'yes'){ ?>
   
<!-- INPUT DATE RANGE  -->
   <i class="toolbarContent" style="border: 0px solid DarkGrey; height: 16px !important; width: 75px; padding-left: 2px; padding-top: 4px; background-color: Gainsboro ;" > DATE FROM:</i>
     <input class="toolbarContent" style="border: 1px solid DarkGrey; width: 130px;"  type="date" name="qw_date1" value="<?php print $set->qw_date1; ?>"  >
   <i class="toolbarContent" style="border: 1px solid DarkGrey; height: 16px !important; width: 60px; padding-left: 4px; padding-top: 4px; background-color: Gainsboro ;" > DATE TO:</i>   
     <input class="toolbarContent" style="border: 1px solid DarkGrey; width: 130px;"  type="date" name="qw_date2" value="<?php print $set->qw_date2; ?>"  > 
   <?php } ?>

<!-- SAVE GROUP IF CHECKED / UNCHECKED <span   class="toolbarContent" style="border: 1px solid DarkGrey ; width: 65px;"> </span> -->   
   <i class="toolbarContent" style="border: 1px solid DarkGrey; height: 14px !important; width: 65px; padding-left: 4px; padding-bottom: 6px;" > 
   Group <input style="border: 1px; transform: scale(1.20);  padding: 0px;" type="checkbox" name="qw_group" value="<?php echo $set->qw_group; ?>" <?php echo $set->qw_group; ?> ></i>
   <button class="toolbarContent" style="border: 1px solid DarkGrey;"  type="submit" name="Save" value="Save" ><i class="fas fa-save" style="font-size: 12pt; color: Blue; "></i>&nbsp; SAVE</button> 

<!-- DATABASE DROPDOWN SELECTION FROM DATABASE--> 
   <form method="post" style="display:inline-block !important ;" >
     <select class="toolbarContent" name="qw_year" onchange="this.form.submit()"  style="width: 150px !important;">
        <option><?php if ( $_GET['qw_year'] > 0 ) { echo "YEAR &nbsp;" . $_GET['qw_year']; } else { echo "SELECT YEAR"     ;} ?></option>
        <option value="2020">2020</option>
        <option value="2019">2019</option>
        <option value="2018">2018</option>
        <option value="2017">2017</option>
        <option value="2016">2016</option>
     </select><?php if ($_POST[qw_year] ){$year = $_POST[qw_year] ;header("Location: ./gl_detail.php?qw_year=$year");}?>
   </form>

<!-- LOAD JASON BUTTONS Bftrip HERE --> 
</div>

<!-- SEARCH BOX LOADS HERE -->   
