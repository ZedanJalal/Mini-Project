<!DOCTYPE html>
<?php  
require_once("../includes/init.php");


if (isset($_POST['block'])) {

  $id  = $_POST['delete_id'];
  $date  = date('Y-m-d');

  $sql = "UPDATE products SET status='off' , block_date='$date' WHERE p_id='$id' ";
  $result = $db->query($sql);


}

?>
<html >
<body>


<div class="container-fluid mt-3">  
    <div class="tile-2 " style="--tile-color-border:black;--width-border:250px">
        <div class="line-head mb-3 row mr-0" style="--width-border:260px; --tile-color-border: #6c757d; color:#343a40">
            <div class="tile-title text-right">
                <i class="fas fa-capsules"></i> لیستی دەرمانە  بەسەرچووەکان</i>
            </div>
            <div class="mr-auto ml-4 mt-2">
                <a href="expire_list.php" class="btn btn-dark">لیستی بلۆککراوەکان</a>
                <a href="index.php" class="btn btn-info">گەڕانەوە</a>
            </div>
        </div>
            <div class="table-responsive-md">
              <table id="example" class="table table-striped table-bordered text-right">
                  <thead class= "thead bg-dark text-yellow">
                      <tr class="text-center">
                      <th> تیراژ </th>
                      <th>ناوی دەرمان </th>
                      <th>ناوی زانستی </th>
                      <th>نرخی تاک </th>
                      <th>بەرواری  بەسەرچوون</th>
                      <th>ماوە </th>
                      <th> بلۆککردن </th>        
                      </tr>
                  </thead>
                  <tbody class="tbody ">
                    <?php 
                    $sql = "SELECT * FROM products WHERE status='on' ORDER BY p_id DESC  ; ";
                    $result = $db->query($sql);
                    while($data = $result->fetch_assoc()) { 
                        $id = $data['p_id'];
                        $name1 = $data['p_name1'];
                        $name2 = $data['p_name2'];
                        $qty = $data['qty'];
                        $price = $data['price'];
                        $expire = $data['date'];
                        $date = date('Y-m-d');
                        $barcode = $data['barcode'];

                        $sdate = new DateTime($date);
                        $edate = new DateTime($expire);
                        $interval = $sdate->diff($edate);
                      ?>
                      <tr>
                        <td><?=$id?></td>
                        <td><?=$name1?></td>
                        <td><?=$name2?></td>
                        <td><?=$price?></td>
                        <td><?=$expire?></td>
                        <td> 
                            <button class="btn btn-danger mx-auto btn-block btn-sm"><i class="fa fa-warning"> </i> <?php echo $interval->y . " ساڵ, " . $interval->m." مانگ, ".$interval->d." رۆژ ";?> </button>
                        </td>
                          <td>
                            <button class="btn btn-dark  mx-auto btn-block btn-sm blockbtn">  <i class="fa fa-ban"> </i> بلۆککردن  </button>
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

</body>
</html >
         
<div class="modal fade" id="block" tabindex="-1" dir="rtl" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
  <div class="modal-content" style="background-color: #0a0327;border-radius: 15px;">
    <div class="modal-header">
      <p class="modal-title text-light" id="exampleModalLabel" dir="rtl"> بلۆککردنی دەرمانی بەسەرچوو   </p>
        <i class="fa fa-times-circle" style="width:200px;color: white;direction: ltr"  data-dismiss="modal"></i>
    </div>
      <form method="POST">
    <div class="modal-body" dir="rtl" style="text-align: right;">
        <input type="hidden" class="form-control mb-2" name="delete_id" id="delete_id">
    </div>
    <div class="modal-footer  mx-auto">
      <button type="button" class="btn btn-secondary ml-3" data-dismiss="modal">داخستن </button>
      <button type="submit" name="block" class="btn btn-dark"> بلۆککردن     </button>
    </div>
    </form>
  </div>
</div>
</div>
              





<script type="text/javascript">

$(document).ready(function (){

    $('#example').on('click','.blockbtn',function (){
      $('#block').modal('show');
$tr =$(this).closest('tr');
      var data = $tr.children("td").map(function (){
        return $(this).text();
      }).get();
      console.log(data);
      $('#delete_id').val(data[0]);
    });   

}); 

</script>





