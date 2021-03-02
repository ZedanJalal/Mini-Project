<!DOCTYPE html>
<?php  
require_once("../includes/init.php");  

if (isset($_POST['addsale'])) {

  $name1  = $_POST['name1'];
  $name2  = $_POST['name2'];
  $qty  = $_POST['qty'];
  $price  = $_POST['price'];

  $sql = "SELECT * FROM products WHERE p_name1='$name1' AND p_name2='$name2' AND status='on' ;";
  $result = $db->query($sql);
  $result =   $result->fetch_assoc();

  $sqty = $result['qty'];
if ($qty > $sqty) {
  msg("ئاگاداری"," ئەوەندە بەردەست نیە  ");
}
else {
    $sql = "INSERT INTO tempsale(name1,name2,price,qty) VALUES('$name1','$name2','$price','$qty');";
    $result = $db->query($sql);
    header("location:sell.php");
}

}



if (isset($_POST['save'])) {
    $sql = "SELECT * FROM tempsale ";
    $products = $db->query($sql);

    while($product = $products->fetch_assoc()) {
        $name1=$product['name1'];
        $name2=$product['name2'];
        $qty=$product['qty'];
        $price=$product['price'];
        $date=date('Y-m-d');

        $sql = "SELECT * FROM products WHERE p_name1='$name1' AND p_name2='$name2' AND status='on' ";
        $result = $db->query($sql);
        $result =   $result->fetch_assoc();
        $pqty = $result['qty'];


        if ($qty > $pqty) {
        msg("ئاگاداری"," ئوەندە بەردەست نیە لەم موادە  : $name1 ");
        }
        else {

            $sql1 = "INSERT INTO sale(name1,name2,qty,price,date) VALUES('$name1','$name2','$qty','$price','$date') ";
            $products1 = $db->query($sql1);
            $sql2 = "UPDATE products SET qty=qty-'$qty' WHERE p_name1='$name1' AND p_name2='$name2' AND status='on' ";
            $products2 = $db->query($sql2);
            $sql3 = "TRUNCATE tempsale ";
            $products3 = $db->query($sql3);
            header("location:sell.php");

}


}


}

?>
<html >
<body>

  

<div class="container-fluid" style=" margin-top: 1%;" >

    <div class="row">
<div class="mx-auto col-md-6 mb-5">
    <h3 class="text-center  mt-5">فرۆشتنی دەرمان </h3>
    <hr> 
      <div class="table-responsive">
        <table id="example" class="table table-light table-striped table-bordered dt-responsive nowrap text-center" dir="rtl">
        <thead  style="background-color: #0a0327;color: white">
            <tr>
                <th> بارکۆد </th>
                <th>ناوی دەرمان </th>
                <th>ناوی زانستی </th>
                <th>IQD نرخی تاک </th>
                <th>ژمارە</th>
                <th> فرۆشتن     </th>
            </tr>
        </thead>
        <tbody>
           <?php 
            $sql = "SELECT * FROM products WHERE status='on'; ;";
            $result = $db->query($sql);
            while($data = $result->fetch_assoc()) {  ?>
            <tr>
                <td><?php echo $data['barcode'];?></td>              
                <td><?php echo $data['p_name1'];?></td>
                <td><?php echo $data['p_name2'];?></td>
                <td><?php echo $data['price'];?></td>
                <td><?php echo $data['qty'];?></td>
                <td> 
                    <button class="btn btn-success addbtn btn-sm"><i class="fa fa-plus"> </i>  </button>
                </td>
            </tr>
            <?php
            }
            ?>
        </tbody>

    </div>
    </table>
</div>
 </div>
 <div class="mx-auto col-md-6 mb-5">
    <h3 class="text-center  mt-5">فرۆشراو  </h3>
    <hr> 
      <div class="table-responsive">
        <table id="temp" class="table table-light table-striped">
            <thead style="background-color: #0a0327;color: white">
                <tr>
                <th scope="col">ناوی زانستی</th>
                <th scope="col">ناوی دەرمان</th>
                <th scope="col">دانە</th>
                <th scope="col">نرخ</th>
                <th scope="col">کۆ</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>

           <?php 
            $sql = "SELECT * FROM tempsale ; ";
            $datas = $db->query($sql);

            $alltotal = 0;
            while($data = $datas->fetch_assoc()) {
                $qty = $data['qty'];
                $price = $data['price'];
                $total = $price*$qty;
                $alltotal = $alltotal+$total;
            ?>
                <tr>            
                <td><?php echo $data['name1'];?></td>
                <td><?php echo $data['name2'];?></td>
                <td><?php echo $data['qty'];?></td>
                <td><?php echo $data['price'];?></td>
                <td><?php echo $data['price']*$data['qty'];?></td>
                <td >
                    <button class="btn btn-danger del-btn text-light btn-sm">X</button>
                    <button class="btn btn-warning minus-btn text-light btn-sm">-</button>
                    <button class="btn btn-success add-btn text-light btn-sm">+</button>
                </td>

                </tr>

            <?php
            }
            ?>   
    </tbody>
    </table>
    </div>
    <div class="container">
    <button class="btn btn-dark col-md-8 btn-lg mx-auto">کۆی گشتی فرۆشتن    | <span><?=$alltotal;?></span> </button>
        <button class="btn btn-info col-md-3 btn-lg" data-toggle="modal" data-target="#save"> زیادکردن  </button>
    </div>
 </div>
 </div>
 </div>
</body>
</html >














<div class="modal fade" id="change" tabindex="-1" dir="rtl" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content" style="background-color: #0a0327;border-radius: 15px;">
      <div div class="modal-header">
        <p class="modal-title text-light" id="exampleModalLabel" dir="rtl"> فرۆشتنی دەرمان   </p>
        <i class="fa fa-times-circle" style="width:200px;color: white"  data-dismiss="modal"></i>
      </div>

      <form method="POST" method="POST">
        <div class="modal-body" dir="rtl" style="text-align: right;">
        <input type="hidden" class="form-control mb-2" name="name1" id="name1" placeholder="  دەرمان   "  required="">
        <input type="hidden" class="form-control mb-2" name="name2" id="name2" placeholder="  دەرمان   "  required="">
        <input type="text" class="form-control mb-2" name="price" id="price" placeholder=" نرخی تاک "  required="">
        <input type="number" class="form-control mb-2" name="qty" id="qty" placeholder="  ژمارە    " required="">
        <input type="text" class="form-control mb-2" name="total" id="total" placeholder="  کۆی گشتی    " required="">
        </div>
        <div class="modal-footer  mx-auto">
        <button type="button" class="btn btn-secondary ml-3" data-dismiss="modal">داخستن </button>
        <button type="submit" name="addsale" class="btn btn-primary"> فرۆشتن    </button>
        </div>
    </form>
    </div>
  </div>
</div>




<div class="modal fade" id="save" tabindex="-1" dir="rtl" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content" style="background-color: #0a0327;border-radius: 15px;">
      <div class="modal-header">
        <p class="modal-title text-light" id="exampleModalLabel" dir="rtl"> 
        ئایا دەتەوێت خەزنی بکەیت ؟ 
        </p>
        <i class="fa fa-times-circle" style="width:200px;color: white;direction: ltr"  data-dismiss="modal"></i>
      </div>
      <form method="POST">
        <div class="modal-body" dir="rtl" style="text-align: right;">
        <p></p>
        </div>
        <div class="modal-footer  mx-auto">
        <button type="button" class="btn btn-secondary ml-3" data-dismiss="modal">نەخێر </button>
        <button type="submit" name="save" class="btn btn-success"> بەڵێ      </button>
        </div>
      </form>
    </div>
  </div>
</div>
  





<script type="text/javascript">
$(document).ready(function (){
  
    $('#qty').on('keyup',function (){

      var qty = $('#qty').val();
      var price = $('#price').val();
      var allprice = qty * price;
      $('#total').val(allprice);
    });  


    $('#price').on('keyup',function (){

      var qty = $('#qty').val();
      var price = $('#price').val();
      var allprice = qty * price;
      $('#total').val(allprice);
    });  


  
  });
</script>









<script type="text/javascript">
$(document).ready(function (){
  
    $('#example').on('click','.addbtn',function (){
      $('#change').modal('show');

      $tr =$(this).closest('tr');

      var data = $tr.children("td").map(function (){

        return $(this).text();
      }).get();
      console.log(data);

      $('#name1').val(data[1]);
      $('#name2').val(data[2]);
      $('#price').val(data[3]);



    });   
  
  });
</script>





<script type="text/javascript">
$(document).ready(function (){
  
    $('#temp').on('click','.del-btn',function (){

      $tr =$(this).closest('tr');

      var data = $tr.children("td").map(function (){

        return $(this).text();
      }).get();

     var name2 = data[0];
     var name1 = data[1];



      $.ajax({
    url: '../includes/fetch.php',
    type: 'POST',  
    data: {delname1 : name1,delname2:name2},
    success: function(data) {
        location.href='';
         },
         fail:function()
         {
        console.log('very bad');
         } 
 });




    });   
  
  });
</script>






<script type="text/javascript">
$(document).ready(function (){
  
    $('#temp').on('click','.add-btn',function (){

      $tr =$(this).closest('tr');

      var data = $tr.children("td").map(function (){

        return $(this).text();
      }).get();

     var name2 = data[0];
     var name1 = data[1];



      $.ajax({
    url: '../includes/fetch.php',
    type: 'POST',  
    data: {addname1 : name1,addname2:name2},
    success: function(data) {
        location.href='';
         },
         fail:function()
         {
        console.log('very bad');
         } 
 });




    });   
  
  });
</script>





<script type="text/javascript">
$(document).ready(function (){
  
    $('#temp').on('click','.minus-btn',function (){

      $tr =$(this).closest('tr');

      var data = $tr.children("td").map(function (){

        return $(this).text();
      }).get();

     var name2 = data[0];
     var name1 = data[1];



      $.ajax({
    url: '../includes/fetch.php',
    type: 'POST',  
    data: {minusname1 : name1,minusname2:name2},
    success: function(data) {
        location.href='';
         },
         fail:function()
         {
        console.log('very bad');
         } 
 });




    });   
  
  });
</script>







