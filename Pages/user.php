<!DOCTYPE html>
<?php  
require_once("../includes/init.php");

if (isset($_POST['add'])) {

  $name  =  $_POST['name'];
  $user  =  $_POST['user'];
  $email  = $_POST['email'];
  $pass  =  $_POST['pass'];

  $sql = "INSERT INTO users(name,user,email,pass) 
          VALUES('$name','$user','$email','$pass');";
  $db->query($sql);
}

if (isset($_POST['edit'])) {

  $id  =  $_POST['update_id'];

  $name  =  $_POST['name'];
  $user  =  $_POST['user'];
  $email  = $_POST['email'];
  
  $sql = "UPDATE users SET name='$name' , user='$user' , email='$email' WHERE u_id='$id'";
  $db->query($sql);
 
}

if (isset($_POST['delete'])) {

  $id  = $_POST['delete_id'];
  $sql = "DELETE FROM users WHERE u_id='$id'";
  $db->query($sql);
 
}
?>
<html >
<body>

<div class="container-fluid mt-3">  
        <div class="tile-2 " style="--tile-color-border:black;--width-border:250px">
            <div class="line-head mb-3 row mr-0" style="--width-border:240px; --tile-color-border: #6c757d; color:#343a40">
                <div class="tile-title text-right">
                    <i class="fas fa-user"></i> لیستی هەژمارەکان</i>
                </div>
                <div class="mr-auto ml-4 mt-2">
                    <button class="btn btn-success" data-toggle="modal" data-target="#add"><i class="fa fa-plus"> </i>زیادکردنی هەژمار  </button>
                  </div>
            </div>
            <div class="table-responsive-md">
                <table id="example" class="table table-striped table-bordered text-right">
                    <thead class= "thead bg-dark text-yellow">
                        <tr class="text-center">
                          <th>تیراژ</th>
                          <th>ناوی   بەکارهێنەر </th>
                          <th> ناوی بەکارهێنەر بە ئینگلیزی</th>
                          <th>ئیمەیڵ </th>
                          <th> گۆڕانکاری</th>
                        </tr>
                    </thead>
                    <tbody class="tbody ">
                    <?php 
                    $count = 1;
                    $sql = "SELECT * FROM users ;";
                    $result = $db->query($sql);
                    while($data = $result->fetch_assoc()) { ?>
                        <tr>
                        <td><?php echo $data['u_id'];?></td>
                        <td><?php echo $data['name'];?></td>
                        <td><?php echo $data['user'];?></td>
                        <td><?php echo $data['email'];?></td>
                          <td>
                              <button class="btn bg-main-orange btnedit">گۆڕین</button>
                              <button class="btn btn-danger btndel">سڕینەوە</button>
                          </td>
                        </tr>
                        <?php
                          }
                          ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html >









<div class="modal fade" id="add" tabindex="-1" dir="rtl" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content" style="background-color: #0a0327;border-radius: 15px;">
        <div class="modal-header">
          <p class="modal-title text-light" id="exampleModalLabel" dir="rtl">  زیادکردنی هەژمار    </p>
            <i class="fa fa-times-circle" style="width:200px;color: white;direction: ltr"  data-dismiss="modal"></i>
        </div>
          <form action="" method="POST">
        <div class="modal-body" dir="rtl" style="text-align: right;">
      <div class="input-group mb-3 text-light text-center">
        <label class="col-sm-2 col-form-label text-white">  بەکارهێنەر  </label>
        <input type="text" name="user" class="form-control col-md-9" placeholder=" ناو  تۆمار بکە   " style="text-align: right;" required="">
    </div>
      <div class="input-group mb-3 text-light text-center">
        <label class="col-sm-2 col-form-label text-white"> بە ئینگلیزی </label>
        <input type="text" name="name" class="form-control col-md-9" placeholder="  ناو تۆمار بکە   " style="text-align: right;" required="">
    </div>
      <div class="input-group mb-3 text-light text-center">
        <label class="col-sm-2 col-form-label text-white"> ئیمەیڵ </label>
        <input type="email" name="email" class="form-control col-md-9" placeholder=" ئیمەیڵ  تۆمار بکە   " style="text-align: right;" required="">
    </div>
      <div class="input-group mb-3 text-light text-center">
        <label class="col-sm-2 col-form-label text-white"> تێپەڕە ووشە </label>
      <input type="text" name="pass" class="form-control col-md-9" placeholder="  *************  " style="text-align: right;" required="">
    </div>
        </div>
        <div class="modal-footer  mx-auto">
          <button type="button" class="btn btn-secondary ml-3" data-dismiss="modal">داخستن </button>
          <button type="submit" name="add" class="btn btn-success"> زیادکردن</button>
        </div>
        </form>
      </div>
    </div>
</div>




<div class="modal fade" id="change" tabindex="-1" dir="rtl" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content" style="background-color: #0a0327;border-radius: 15px;">
      <div class="modal-header">
        <p class="modal-title text-light" id="exampleModalLabel" dir="rtl">  نوێکردنەوەی هەژمار    </p>
          <i class="fa fa-times-circle" style="width:200px;color: white;direction: ltr"  data-dismiss="modal"></i>
      </div>
        <form action="" method="POST">
      <div class="modal-body" dir="rtl" style="text-align: right;">
        <input type="hidden" id="update_id" name="update_id">

    <div class="input-group mb-3 text-light text-center">
      <label class="col-sm-2 col-form-label text-white">  بەکارهێنەر </label>
      <input type="text" name="name" id="name" class="form-control col-md-9" placeholder="  ناو تۆمار بکە   " style="text-align: right;" required="">
  </div>

                        <div class="input-group mb-3 text-light text-center">
      <label class="col-sm-2 col-form-label text-white">  بە ئینگلیزی  </label>
      <input type="text" name="user" id="user" class="form-control col-md-9" placeholder=" ناو  تۆمار بکە   " style="text-align: right;" required="">
  </div>

    <div class="input-group mb-3 text-light text-center">
      <label class="col-sm-2 col-form-label text-white"> ئیمەیڵ </label>
      <input type="email" id="email" name="email" class="form-control col-md-9" placeholder=" ئیمەیڵ  تۆمار بکە   " style="text-align: right;" required="">
  </div>
      <div class="modal-footer  mx-auto">
        <button type="button" class="btn btn-secondary ml-3" data-dismiss="modal">داخستن </button>
        <button type="submit" name="edit" class="btn btn-warning"> نوێکردنەوە      </button>
      </div>
      </form>
    </div>
  </div>
</div>



<div class="modal fade" id="delete" tabindex="-1" dir="rtl" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content" style="background-color: #0a0327;border-radius: 15px;">
              <div class="modal-header">
                <p class="modal-title text-light" id="exampleModalLabel" dir="rtl"> سڕینەوەی  هەژمار    </p>
                  <i class="fa fa-times-circle" style="width:200px;color: white;direction: ltr"  data-dismiss="modal"></i>
              </div>
                <form method="POST">
              <div class="modal-body" dir="rtl" style="text-align: right;">
            <div class="input-group mb-3 text-light text-center">
            <input type="hidden" id="delete_id" name="delete_id">
          </div>
              </div>
              <div class="modal-footer  mx-auto">
                <button type="button" class="btn btn-secondary ml-3" data-dismiss="modal">داخستن </button>
                <button type="submit" name="delete" class="btn btn-danger"> سڕینەوە      </button>
              </div>
              </form>
            </div>
          </div>
  </div>
  



<script type="text/javascript">

$(document).ready(function (){


  
    $('#example').on('click','.btndel',function (){


      $('#delete').modal('show');

  
      $tr =$(this).closest('tr');

      var data = $tr.children("td").map(function (){

        return $(this).text();

      }).get();

      console.log(data);


      $('#delete_id').val(data[0]);


    });   
    



}); 

</script>





<script type="text/javascript">

$(document).ready(function (){

    
    $('#example').on('click','.btnedit',function (){


      $('#change').modal('show');

      $tr =$(this).closest('tr');

      var data = $tr.children("td").map(function (){

        return $(this).text();
      }).get();

      console.log(data);


      $('#update_id').val(data[0]);
      $('#name').val(data[1]);
      $('#user').val(data[2]);
      $('#email').val(data[3]);

    });   


    $('#example').on('click','.btndel',function (){


      $('#delete').modal('show');


      $tr =$(this).closest('tr');

      var data = $tr.children("td").map(function (){

        return $(this).text();

      }).get();



      console.log(data);


      $('#delete_id').val(data[0]);




});   
    


  });



</script>












