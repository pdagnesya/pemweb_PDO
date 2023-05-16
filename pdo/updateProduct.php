<?php
  //memanggil file conn.php yang berisi koneski ke database
  //dengan include, semua kode dalam file conn.php dapat digunakan pada file index.php
  include ('conn.php');

  $status = '';
  $result = '';
  //melakukan pengecekan apakah ada variable GET yang dikirim
  if ($_SERVER['REQUEST_METHOD'] === 'GET') {
      if (isset($_GET['nrp'])) {
          //query SQL
          $productCode = $_GET['nrp'];
          $query = $conn->prepare("SELECT * FROM products WHERE productCode=:productCode");
          // $query = "SELECT * FROM products WHERE productCode='$productCode'";
          // $result = $conn->query($query);
          //binding data
           $query->bindParam(':productCode',$productCode);
          //eksekusi query
           $query->execute(); 
      }
  }

  //melakukan pengecekan apakah ada form yang dipost
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $productCode = $_POST['productCode'];
      $productName = $_POST['productName'];
      $productLine = $_POST['productLine'];
      $productScale = $_POST['productScale'];
      $productVendor = $_POST['productVendor'];
      $productDescription = $_POST['productDescription'];
      $quantityInStock = $_POST['quantityInStock'];
      $buyPrice = $_POST['buyPrice'];
      $MSRP = $_POST['MSRP'];


      //query 
      $query = $conn->prepare("UPDATE products SET productName=:productName, productLine=:productLine, productScale=:productScale, productVendor=:productVendor, productDescription=:productDescription, quantityInStock=:quantityInStock, buyPrice=:buyPrice, MSRP=:MSRP  WHERE productCode=:productCode");

      //binding data
      $query->bindParam(':productCode', $productCode);
      $query->bindParam(':productName', $productName);
      $query->bindParam(':productLine', $productLine);
      $query->bindParam(':productScale', $productScale);
      $query->bindParam(':productVendor', $productVendor);
      $query->bindParam(':productDescription', $productDescription);
      $query->bindParam(':quantityInStock', $quantityInStock);
      $query->bindParam(':buyPrice', $buyPrice);
      $query->bindParam(':MSRP', $MSRP);

      //eksekusi query
      if ($query->execute()) {
        $status = 'ok';
      }
      else{
        $status = 'err';
      }

      //redirect ke halaman lain
      header('Location: indexProduct.php?status='.$status);
  }


?>


<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>PDO</title>
  </head>


  <body>
  <a>Pemrograman Web</a> <br>
      <table class="nav-item" border="1">
        <tr style="color:brown" >
          Putri Dwi Agnesya (21081010142) <br> <br>
        </tr>
        <tr>
        <a class="nav-link active" href="<?php echo "index.php"; ?>">Data Customers</a>
        </tr>
        <tr>
        <a class="nav-link" href="form.php">Tambah Data Customers</a>
        </tr>
        <tr>
        <a class="nav-link" href="indexProduct.php">Data Product</a>
        </tr>
        <tr>
        <a class="nav-link " href="<?php echo "formProducts.php"; ?>">Tambah Data Product</a>
        </tr>
      </table>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">


          <h2 style="margin: 30px 0 30px 0;">Update Data Products</h2>
          <form action="updateProduct.php" method="POST">
            <?php while($data = $query->fetch(PDO::FETCH_ASSOC)): ?>
            <div class="form-group">
              <label>Product Code</label>
              <input type="text" class="form-control" placeholder="code" name="productCode" value="<?php echo $data['productCode'];?>" required="required" readonly>
            </div>
            <div class="form-group">
              <label>Product Name</label>
              <input type="text" class="form-control" placeholder="nama produk" name="productName" required="required">
            </div>
            <div class="form-group">
              <label>Product Line</label>
              <input class="form-control" placeholder="contact line"  name="productLine" required="required">
            </div>
            <div class="form-group">
              <label> Product Scale</label>
              <input type="text" class="form-control" placeholder="product scale" name="productScale" required="required">
            </div>
            <div class="form-group">
              <label>Product Vendor </label>
              <input type="text" class="form-control" placeholder="productVendor" name="productVendor" required="required">
            </div>
            <div class="form-group">
              <label>Product Description</label>
              <textarea class="form-control" placeholder="productDescription"  name="productDescription" required="required"></textarea>
            </div>
            <div class="form-group">
              <label>Quantity In Stock</label>
              <textarea type="text" class="form-control" placeholder="quantity" name="quantityInStock" required="required"></textarea>
            </div>
            <div class="form-group">
              <label>Buy Price</label>
              <input class="form-control" placeholder="buyPrice"  name="buyPrice" required="required">
            </div>
            <div class="form-group">
              <label> MSRP</label>
              <input type="text" class="form-control" placeholder="MSRP" name="MSRP" required="required">
            </div>

            <?php endwhile; ?>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </form>
        </main>
      </div>
    </div>

  </body>
</html>