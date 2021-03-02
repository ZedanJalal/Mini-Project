<!DOCTYPE html>
<?php  
require_once("../includes/init.php");
?>
<html >
<body>

<div class="container-fluid mt-3">  
    <div class="tile-2 " style="--tile-color-border:black;--width-border:250px">
        <div class="line-head mb-3 row mr-0" style="--width-border:260px; --tile-color-border: #6c757d; color:#343a40">
            <div class="tile-title text-right">
                <i class="fas fa-capsules"></i> لیستی دەرمانە  بەسەرچووە بلۆککراوەکان  </i>
            </div>
            <div class="mr-auto ml-4 mt-2">
                <a href="expire.php" class="btn btn-info">گەڕانەوە</a>
            </div>
        </div>
            <div class="table-responsive-md">
              <table id="example" class="table table-striped table-bordered text-right">
                  <thead class= "thead bg-dark text-yellow">
                      <tr class="text-center">
                      <th>ناوی دەرمان </th>
                      <th>ناوی زانستی </th>
                      <th>بەرواری  بەسەرچوون</th>
                      <th> بەرواری بلۆککردن</th>     
                      </tr>
                  </thead>
                  <tbody class="tbody ">
                    <?php
                    $sql = "SELECT * FROM products WHERE status='off'; ";
                    $result = $db->query($sql);
                    while($data = $result->fetch_assoc()) { 
                        $id = $data['p_id'];
                        $name1 = $data['p_name1'];
                        $name2 = $data['p_name2'];
                        $expire = $data['date'];
                        $block = $data['block_date'];
                      ?>
                    <tr>
                      <td><?=$name1?></td>
                      <td><?=$name2?></td>
                      <td><?=$expire?></td>
                      <td><?=$block?></td>
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