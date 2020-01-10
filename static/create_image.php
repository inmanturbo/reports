<?php
if (!$_POST) {

echo "

<html>

<head>
<title>Create image</title>
</head>

<body topmargin='10' leftmargin='10' rightmargin='0' bottommargin='0' marginwidth='0' marginheight='0'>
<table style='margin-left: 10px' border='1' CELLSPACING='5' CELLPADDING='5'>
<tr>
<td>
  <form method='POST' action='".$_SERVER['PHP_SELF']."'>
	<p style='margin-top: 0; margin-bottom: 0' align='center'><b><font size='6'>Create Image Button</font></b></p>
	<p style='margin-top: 0; margin-bottom: 0'>&nbsp;</p>
	<p style='margin-top: 0; margin-bottom: 0'><b>Open Page Image:</b></p>
	<p style='margin-top: 0; margin-bottom: 0'>
	<input type='text' name='get_image' size='30' value='static/default.gif'></p>
	<p style='margin-top: 0; margin-bottom: 0'>&nbsp;</p>
	<p style='margin-top: 0; margin-bottom: 0'>&nbsp;</p>
	<p style='margin-top: 0; margin-bottom: 0'><b>Text Color</b></p>
	<p style='margin-top: 0; margin-bottom: 0'>R:
	<input type='text' name='t_r' size='5' value='0'>&nbsp; G:
	<input type='text' name='t_g' size='5' value='66'>&nbsp; B:
	<input type='text' name='t_b' size='5' value='153'></p>
	<p style='margin-top: 0; margin-bottom: 0'>&nbsp;</p>
	<p style='margin-top: 0; margin-bottom: 0'><b>Text String&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<font face='Arial' size='1'>Pos1&nbsp;&nbsp; Pos2&nbsp;&nbsp; Font</font></b></p>
	<p style='margin-top: 0; margin-bottom: 0'>
	Line1
	<input type='text' name='string1' size='12' value=''>
	<input type='text' name='x1' size='3' value='3'>
	<input type='text' name='y1' size='3' value='3'>
	<select size='1' name='font1'>
	<option selected>2</option>
	<option>1</option>
	<option>2</option>
	<option>3</option>
        <option>4</option>
	</select></p>
	<p style='margin-top: 0; margin-bottom: 0'>
	Line2
	<input type='text' name='string2' size='12' value=''>
	<input type='text' name='x2' size='3' value='3'>
	<input type='text' name='y2' size='3' value='18'>
	<select size='1' name='font2'>
	<option selected>5</option>
	<option>1</option>
	<option>2</option>
        <option>3</option>
        <option>4</option>
        <option>5</option>
	</select></p>
	<p style='margin-top: 0; margin-bottom: 0'>&nbsp;</p>
	<p style='margin-top: 0; margin-bottom: 0'><b>Save To</b></p>
	<p style='margin-top: 0; margin-bottom: 0'>
	<input type='text' name='save_file' size='30' value='static/test-out.png'></p>
	<p style='margin-top: 0; margin-bottom: 0'>&nbsp;</p>
	<p style='margin-top: 0; margin-bottom: 0'>
	<input type='submit' value='Create Image' name='B1'>
	<input type='reset' value='Reset' name='B2'></p>
<img src='static/test-out.png' style='word-spacing: 5; line-height: 100%; border: 5px solid #D3D3D3; margin: 5'>
</form>
</td>
</tr>
<table>
</body>

</html> 

" ;

} else {

// Copy Image
//$MyImage = imagecreatefromgif('static/default.gif');
$MyImage = imagecreatefromgif($_POST['get_image']);

// allocate your colors
$text = imagecolorallocate($MyImage, $_POST['t_r'],$_POST['t_g'],$_POST['t_b']);

// insert text top left
imagestring( $MyImage, $_POST['font1'],$_POST['x1'],$_POST['y1'],$_POST['string1'], $text );
imagestring( $MyImage, $_POST['font2'],$_POST['x2'],$_POST['y2'],$_POST['string2'], $text );

// save to file
imagepng( $MyImage, "static/test-out.png" ); 

// output to browser 
header('Content-Type: image/png');
imagepng( $MyImage );

// clean up
imagedestroy($MyImage);
}
?> 



