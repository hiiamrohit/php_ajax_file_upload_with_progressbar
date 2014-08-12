$(function() {
 $(".upload").click(function() {
 var fl= $("input[name='file']");
 if(fl.val()=="") {
   flashMsg("Please choose image to upload."); 
   return false;
 }
 $("#progBar").show();
 $(this).attr('disabled','disabled');
   var form = new FormData($("#myform")[0]);
   var count = $("table#tb tr").length;
   $.ajax({
      url: 'upload.php',
      type: 'POST',
      data: form,
      processData: false, 
      contentType: false,
      dataType: 'json',
      xhr: function() {
                    var myXhr = $.ajaxSettings.xhr();
                    if(myXhr.upload){
                        myXhr.upload.addEventListener('progress',progress, false);
                    }
                    return myXhr;
                },
      success: function(res) {
      if(res.type=='success') {
      var file = res.fileName;
        $("table#tb tr:first").before("<tr id='row"+count+"'><td><a href='upload/"+file+"' target='_blank'><img src='upload/"+file+"' width=200 height=200></a></td><td><a href='javascript:void(0);' id='delete' rmid='row"+count+"' filename='"+file+"'>Delete</td></tr>");
        } 
        fl.val('');
        flashMsg(res.msg); 
        $("#file").val();
        $(".upload").removeAttr('disabled');
        $("#progBar").hide();
        resetProgressBar();
      }    
   });  
 });
 
 // Proress bar
 function progress(e){
        if(e.lengthComputable){
            $('progress').attr({value:e.loaded,max:e.total});
            var percentage = (e.loaded / e.total) * 100;
            $('#prog').html(percentage+'%');
        }
    }
    
    function resetProgressBar() {
        $('#prog').html('0%');
        $('progress').attr({value:0,max:100});
    }
    
// Flash message 
 function flashMsg(msg) {
        $("#alertMsg").fadeIn(1000);
        $("#alertMsg").html(msg);
        $("#alertMsg").fadeOut(5000);
 }
 
 // Delete function
$(document).on('click','#delete',function() {
    $(this).attr('href','javascript:void(0)');
    var fileName = $(this).attr('fileName');
    var rmid = $(this).attr('rmid');
    $(this).html("deleting..");
    var file = $(this).attr("file");
    $.ajax({
        url:'upload.php?del=1&fileName='+fileName,
        type:'GET',
        data:{},
        success:function(res){
          $("table#tb tr#"+rmid).remove();
          flashMsg(res.msg);
        }
    });
});


});
