<?php  
require_once("../includes/init.php");

if (isset($_POST['edit'])) {

    $id  = $_POST['update_id'];
    $barcode  = $_POST['barcode'];
    $name1  =$_POST['name1'];
    $name2  = $_POST['name2'];
    $qty  = $_POST['qty'];
    $price  = $_POST['price'];
    $date  = $_POST['date'];
    $sql = " UPDATE products SET p_name1='$name1' , p_name2='$name2' , barcode='$barcode' , qty='$qty' , price='$price' , date='$date'
              WHERE p_id='$id'";
   $db->query($sql);
  
  }

  if (isset($_POST['delete'])) {

    $p_id  = $_POST['delete_id'];

    $sql = "DELETE FROM products WHERE p_id='$p_id' ";
    $db->query($sql);  
  }
?>



<div class="container-fluid mt-3">  
        <div class="tile-2 " style="--tile-color-border:black;--width-border:250px">
            <div class="line-head mb-3 row mr-0" style="--width-border:240px; --tile-color-border: #6c757d; color:#343a40">
                <div class="tile-title text-right">
                    <i class="fas fa-capsules"></i> لیستی دەرەمانەکان</i>
                </div>
                <div class="mr-auto ml-4 mt-2">
                    <a href="index.php" class="btn btn-info">گەڕانەوە</a>
                </div>
            </div>
            <div class="table-responsive-md">
                <table id="example" class="table table-striped table-bordered text-right">
                    <thead class= "thead bg-dark text-yellow">
                        <tr class="text-center">
                            <th >تیراژ</th>
                            <th >ناوی دەرمان</th>
                            <th >ناوی زانستی</th>
                            <th >ژمارە</th>
                            <th >نرخی تاک</th>
                            <th >نرخی کۆ</th>
                            <th >بەسەرچون</th>
                            <th>بارکۆد</th>      
                            <th>گۆڕانکاری</th>
                        </tr>
                    </thead>
                    <tbody class="tbody ">
                    <?php

                    $sql = "SELECT * FROM products WHERE status='on' ORDER BY p_id DESC  ;";
                    $result = $db->query($sql);
                    while($data = $result->fetch_assoc()) {?>          
                        <tr class="text-center">        
                            <td ><?php echo $data['p_id'] ?></td>                 
                            <td><?php echo $data['p_name1'];?></td>
                            <td><?php echo $data['p_name2'];?></td>
                            <td><?php echo $data['qty'];?></td>
                            <td><?php echo $data['price'];?></td>
                            <td><?php echo $data['price']*$data['qty'];?></td>
                            <td><?php echo $data['date'];?></td>
                            <td><?php echo $data['barcode'];?></td>
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




    


    <div class="modal fade" id="change" tabindex="-1" dir="rtl" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
<div class="modal-content" style="background-color: #0a0327;border-radius: 15px;">
  <div class="modal-header text-white">
    <p class="modal-title text-light " id="exampleModalLabel" dir="rtl"> باڕکۆد   </p>
      <i class="fa fa-times-circle" style="width:200px;color: white"  data-dismiss="modal"></i>
  </div>
    <form method="POST">
    <input type="hidden" id="update_id" name="update_id">
      <div class="modal-body" dir="rtl" style="text-align: right;">

          <div class="input-group mb-3 text-light text-center">
            <label class="col-sm-2 col-form-label text-white"> ناوی دەرمان  </label>
            <input type="text" class="form-control col-md-9" placeholder="  ناوی  دەرمان تۆماربکە   " style="text-align: right;" name="name1" id="name1" required="">
        </div>

          <div class="input-group mb-3 text-light text-center">
            <label class="col-sm-2 col-form-label text-white"> ناوی زانستی   </label>
            <input type="text" class="form-control col-md-9" placeholder="  ناوی زانستی دەرمان  تۆمار بکە   " style="text-align: right;" name="name2" id="name2" required="">
        </div>
          <div class="input-group mb-3 text-light text-center">
            <label class="col-sm-2 col-form-label text-white"> ژمارە </label>
            <input type="text" class="form-control col-md-9 eqty" placeholder="  ژمارەی کڕینی دەرمان  تۆمار بکە   " style="text-align: right;" name="qty" id="qty" required="">
        </div>

          <div class="input-group mb-3 text-light text-center">
            <label class="col-sm-2 col-form-label text-white"> نرخی تاک  </label>
            <input type="text" class="form-control col-md-9 eprice" placeholder="  نرخی تاکی دەرمان  تۆمار بکە   " style="text-align: right;" name="price" id="price" required="">
        </div>

          <div class="input-group mb-3 text-light text-center">
            <label class="col-sm-2 col-form-label text-white"> بەسەرچوون     </label>
            <input type="date" class="form-control col-md-9" style="text-align: right;" name="date" id="date" required="">
        </div>

          <div class="input-group mb-3 text-light text-center">
            <label class="col-sm-2 col-form-label text-white"> باڕکۆد     </label>
            <input type="text" class="form-control col-md-9" style="text-align: right;" name="barcode" id="barcode" required="">
        </div>

  </div>
  <div class="modal-footer  mx-auto">
    <button type="button" class="btn btn-secondary ml-3" data-dismiss="modal">داخستن </button>
    <button type="submit" name="edit" class="btn bg-main-orange"> گۆڕین     </button>
  </div>
  </form>
</div>
</div>
</div>

<div class="modal fade" id="delete" tabindex="-1" dir="rtl" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content" style="background-color: #0a0327;border-radius: 15px;">
      <div class="modal-header">
        <p class="modal-title text-light" id="exampleModalLabel" dir="rtl"> سڕینەوەی  دەرمان    </p>
          <i class="fa fa-times-circle" style="width:200px;color: white;direction: ltr"  data-dismiss="modal"></i>
      </div>
        <form method="POST">
      <div class="modal-body text-center" >
          <h1>دڵنیای لە سڕینەوەی دەرمان</h1>
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
      $('#name1').val(data[1]);
      $('#name2').val(data[2]);
      $('#qty').val(data[3]);
      $('#price').val(data[4]);
      $('#date').val(data[6]);
      $('#barcode').val(data[7]);

    });   
  
  });
</script>








