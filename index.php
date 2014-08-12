<?php
error_reporting(0);
?>
<div style="width:60%; margin:0 auto;">
<h2>Image upload with progress bar using Ajax+Php </h2>
<div style="border:1px solid; padding:10px 10px 10px 10px; float:left; width:800px;">
<form enctype="multipart/form-data" id="myform">  
   <b>Choose Image to upload.</b><br/>
    <input type="file"  name="file" id="image" />
    <br>
    <input type="button" value="Upload image" class="upload" />
</form>
<div id="progBar" style="display:none;">
  <progress value="0" max="100" style="width:750px;"></progress><span id="prog" style="font-weight:bold;">0%</span>
</div>
<div id="alertMsg" style="font-size:16px; color:blue; display:none;"></div>
<h3>List of uploaded files</h3>
<table border=1 width=100% id="tb" align="left">
<tr style="display:none;"><td colspan=2 ></td></tr>
<?php 
  $dir = "upload/";
  $i=0;
    foreach(glob($dir."{*.jpg,*.gif,*.png,*.jpeg}", GLOB_BRACE) as $file){ 
             echo "<tr id='row".$i."'><td><a href='".$file."' target='_blank'><img src='".$file."' width=200 height=200></a></td><td><a href='javascript:void(0);' id='delete' rmid='row".$i."' filename='".$file."'>Delete</td></tr>";
             $i++;    
}

?>

</table>
</div>
<div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="js/upload.js"></script>
