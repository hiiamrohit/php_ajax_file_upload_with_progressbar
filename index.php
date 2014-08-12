<?php

?>
<div style="width:60%; margin:0 auto;">
<h1>Image upload in php with progress bar! </h1>
<div style="border:1px solid; padding:10px 10px 10px 10px; float:left; width:800px;">
<form enctype="multipart/form-data" id="myform">  
   <b>Choose Image to upload.</b><br/>
    <input type="file"  name="file" id="image" />
    <br>
    <input type="button" value="Upload image" class="upload" />
</form>
<div id="progBar" style="display:none;">
  <progress value="0" max="100" style="width:800px;"></progress><span id="prog">0%</span>
</div>
<div id="alertMsg" style="font-size:16px; color:blue; display:none;"></div>
<h3>List of uploaded files</h3>
<table border=1 width=100% id="tb">
<?php 
$dir = "upload";
if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
    $i=0;
        while (($file = readdir($dh)) !== false) {      
             echo "<tr id='row".$i."'><td><a href='upload/".$file."' target='_blank'><img src='upload/".$file."' width=200 height=200></a></td><td><a href='javascript:void(0);' id='delete' rmid='row".$i."' filename='".$file."'>Delete</td></tr>";
             $i++;
        }
        closedir($dh);
    }
}

?>

</table>
</div>
<div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="js/upload.js"></script>
