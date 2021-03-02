<?php  
require_once("../includes/init.php");

if(isset($_POST["add"])){
    $barcode  = $_POST['barcode'];
    $name1  = $_POST['name1'];
    $name2  = $_POST['name2'];
    $qty  = $_POST['qty'];
    $price  = $_POST['price'];
    $date  =$_POST['date'];

    $sql = "INSERT INTO products(p_name1,p_name2,qty,price,date,barcode) 
    VALUES('$name1','$name2','$qty','$price','$date','$barcode');";
    if ($db->query($sql) === TRUE){
        header("location:Drugs.php");
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
    
}
?>


<div class="container-fluid mt-3">  
        <div class="tile-2" style="--tile-color-border:black;--width-border:250px">
            <div class="line-head mb-3 row mr-0" style="--width-border:260px; --tile-color-border: #6c757d; color:#343a40">
                <div class="tile-title text-right">
                    <i class="fas fa-capsules"> زیادکردنی دەرمان </i>
                </div>
                <div class="mr-auto ml-4 mt-2">
                    <a href="index.php" class="btn btn-info">گەڕانەوە</a>
                </div>
            </div>
            <form method="POST">
            <div class="row">

                <div class="form-group mb-3 col-md-6 col-lg-4">
                    <label class="label-input">بارکۆد تۆماربکە</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-qrcode"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="بارکۆد تۆماربکە" name="barcode" required=""/>
                    </div>
                </div>
                <div class="form-group mb-3 col-md-6 col-lg-4">
                    <label class="label-input">ناوی دەرمان</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="ناوی دەرمان تۆماربکە" name="name1" id="name1" required=""/>
                    </div>
                </div>
                <div class="form-group mb-3 col-md-6 col-lg-4">
                    <label class="label-input">ناوی زانستی دەرمان </label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="ناوی زانستی دەرمان تۆماربکە" name="name2" id="name2" required=""/>
                    </div>
                </div>
                <div class="form-group mb-3 col-md-6 col-lg-4">
                    <label class="label-input">ژمارە</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-unlock"></i></span>
                        </div>
                        <input type="text" class="form-control qty" placeholder="ژمارەی کڕینی دەرمان تۆماربکە" name="qty" id="qty" required=""/>
                    </div>
                </div>
                <div class="form-group mb-3 col-md-6 col-lg-4">
                    <label class="label-input">نرخی تاک</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                        </div>
                        <input type="text" class="form-control eprice" placeholder="نرخی تاکی دەرمان تۆماربکە" name="price" id="price" required=""/>
                    </div>
                </div>

                <div class="form-group mb-3 col-md-6 col-lg-4">
                    <label class="label-input">بەسەرچوون</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                        </div>
                        <input type="date" class="form-control" name="date" id="date" required=""/>
                    </div>
                </div>
                <div class="col-md-3 mt-3">
                    <button type="submit" class="btn btn-success btn-block" name="add">
                        <i class="fas fa-plus"></i>
                        زیادکردن
                    </button>
                </div>
                
            </div>
          </form>
        </div>
    </div>
