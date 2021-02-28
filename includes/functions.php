
<?php 


 function upload($location,$name){
    

 $fileName = $_FILES[$name]['name'];
    $fileSize = $_FILES[$name]['size'];
    $fileTmpName =$_FILES[$name]['tmp_name'];
    $fileType = $_FILES[$name]['type'];

    $fileExt = explode('.',$fileName);
    $fileRealExt = strtolower(end($fileExt));

    $allowed = array('jpg','jpeg','png');

if ($fileName=="")
{

}       
else {
    if (in_array($fileRealExt,$allowed)) {
      
        if ($fileSize < 3000000) {

          $fileNewName = uniqid('',true).'.'.$fileRealExt;
          $uploadPath = $location.$fileNewName;
          $didupload =  move_uploaded_file($fileTmpName,$uploadPath);

        if ($didupload) {
          return $fileNewName;
        }
        else {
  msg("ئاگاداری"," وێنەکە زیاد نەبوو ");

        }

}
else {

  msg("ئاگاداری"," وێنەکە زۆر گەورەیە   ");

}




}
else {
 msg("ئاگاداری","   جۆری وێنەکە رێگە پێنەدراوە   ");

}
}


}

    
 






 function direct($page)
{
  ob_start();
  header('location:'.$page);
  exit;

}

 function msg($title,$msg){
?>



<div class="modal" id="myModal">
  <div class="modal-dialog modal-md">
    <div class="modal-content">

      <div class="modal-header ">
<h4 class="modal-title" style="text-align:center;color:black;">
        <span class="fa fa-bell"></span>     
      <?php echo $title ?>
</h4>
<button style="font-size:18px;" type="button" class="btn btn-danger btn-xs" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body text-center " style="font-size:20px;color:black;">
        <?php echo $msg; ?>
      </div>


    </div>
  </div>
</div>


<script type="text/javascript">
  $( document ).ready(function() {
  
  $('#myModal').modal('show');

});
</script>
<?php
  }
