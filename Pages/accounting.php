<!DOCTYPE html>
<?php  
require_once("../includes/init.php");

$date=date("Y-m-d");

$sql = "SELECT  sum(qty*price) as 'total' FROM sale WHERE date='$date'";
$getsale = $db->query($sql);
$TotalSale=$getsale->fetch_assoc();

$sql = "SELECT  sum(qty*price) as 'total' FROM products WHERE date='$date'";
$getbuy = $db->query($sql);
$TotalBuy=$getbuy->fetch_assoc();




?>


<div class="container-fluid col-md-12" style=" margin-top: 1%;background-color: white;" >
  <br>
 <h3 class="text-center text-danger">  حساباتی دەرمانخانە         </h3>
    <hr>
    <div class="row">
      <div class="col-md-4">
         <div class="container">
           <h5 class="text-center">فرۆشتنی ڕۆژانە  </h5>
           <br>
           <button class="btn btn-success col-md-12 btn-lg mx-auto">
            <?php if ($TotalSale['total'] ==0 ) 
            {
                echo "IQD 0.00 ";
            }
            else {
                echo "IQD".$TotalSale['total'];
            }
            ?> 
          </button>
         </div>
         <br>
         <hr>
         <br>
         <div class="container shadow">
      <h5 class="text-center">فرۆشتن بەپێی کات </h5>
          <form action="" method="POST" class="text-center m-2">
          <div class="input-group mb-3 text-center">
           <label class="col-sm-2 col-form-label"> سەرەتای بەروار   </label>
          <input type="date" name="date1" class="form-control col-md-9" style="text-align: right;" required="">
           </div>
            <div class="input-group mb-3 text-center">
           <label class="col-sm-2 col-form-label"> کۆتایی بەروار   </label>
          <input type="date" name="date2" class="form-control col-md-9" style="text-align: right;" required="">
           </div>
           <button class="btn btn-primary" type="submit" name="sale"><span class="fa fa-arrow-down"></span></button>
          </form>
       <button class="btn btn-success col-md-12 btn-lg mx-auto"> <?php sale();?> </button>
       <hr> 
        </div>
        <!-- end col-md-4 -->
      </div>


       <div class="col-md-4">
        <div class="container">
           <h5 class="text-center">کڕینی ڕۆژانە  </h5>
           <br>
           <button class="btn btn-info col-md-12 btn-lg mx-auto">
            <?php if ($TotalBuy['total']==0) 
            {
                echo "IQD 0.00 ";
            }
            else {
                echo "IQD ".$TotalBuy['total'];
            }
            ?> 
          </button>         </div>
         <br>
         <hr>
         <br>
         <div class="container shadow">
      <h5 class="text-center">کڕین بەپێی کات </h5>
          <form action="" method="POST" class="text-center m-2">
          <div class="input-group mb-3 text-center">
           <label class="col-sm-2 col-form-label"> سەرەتای بەروار   </label>
          <input type="date" name="date1" class="form-control col-md-9" style="text-align: right;" required="">
           </div>
            <div class="input-group mb-3 text-center">
           <label class="col-sm-2 col-form-label"> کۆتایی بەروار   </label>
          <input type="date" name="date2" class="form-control col-md-9" style="text-align: right;" required="">
           </div>
           <button class="btn btn-primary" type="submit" name="buy"><span class="fa fa-arrow-down"></span></button>
          </form>
       <button class="btn btn-info col-md-12 btn-lg mx-auto"> <?php buy();?> </button>
       <hr> 
        </div>
        <!-- end col-md-4 -->
       </div>
        <div class="col-md-4">
          <div class="container">
           <h5 class="text-center">قەرزی ڕۆژانە  </h5>
           <br>
           <button class="btn btn-warning col-md-12 btn-lg mx-auto"> 
            <?php 
                echo "IQD 0.00 ";
            ?> 
            </button>
         </div>
         <br>
         <hr>
         <br>
      <div class="container shadow">
      <h5 class="text-center">قەرز بەپێی کات </h5>
          <form action="" method="POST" class="text-center m-2">
          <div class="input-group mb-3 text-center">
           <label class="col-sm-2 col-form-label"> سەرەتای بەروار   </label>
          <input type="date" name="date1" class="form-control col-md-9" style="text-align: right;" required="">
           </div>
            <div class="input-group mb-3 text-center">
           <label class="col-sm-2 col-form-label"> کۆتایی بەروار   </label>
          <input type="date" name="date2" class="form-control col-md-9" style="text-align: right;" required="">
           </div>
           <button class="btn btn-primary" type="submit" name="debt"><span class="fa fa-arrow-down"></span></button>
          </form>
       <button class="btn btn-warning col-md-12 btn-lg mx-auto"> </button>
       <hr> 
        </div>
        <!-- end col-md-4 -->
        </div>
    </div>
     <br>
        <br>
 </div>
</body>
</html >





<?php

function sale() {
    global $db;
    if (isset($_POST['sale'])) {
    
    $date1 = $_POST['date1'];
    $date2 = $_POST['date2'];

    $sql = "SELECT  sum(qty*price)as 'total' FROM sale WHERE date>='$date1' AND date<='$date2' ";
    $sales = $db->query($sql);

    $sale = $sales->fetch_assoc();

    if ($sale['total'] ==0) {
        echo "IQD 0.00";

    }
    else {
        echo "IQD ".$sale['total'];

    }

}


}






function buy() {
global $db;
    if (isset($_POST['buy'])) {
    
    $date1 = $_POST['date1'];
    $date2 = $_POST['date2'];

    $sql = "SELECT  sum(qty*price)as 'total' FROM products WHERE date>='$date1' AND date<='$date2' ";
    $buys = $db->query($sql);
    $buy = $buys->fetch_assoc();

    if ($buy['total']==0) {
        echo "IQD 0.00";

    }
    else {
        echo "IQD ".$buy['total'];
    }
    }
}






