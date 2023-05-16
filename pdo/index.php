<?php 
  //memanggil file conn.php yang berisi koneski ke database
  //dengan include, semua kode dalam file conn.php dapat digunakan pada file index.php
  include ('conn.php'); 
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
 
          

          <?php 
            //mengecek apakah proses update dan delete sukses/gagal
            if (@$_GET['status']!==NULL) {
              $status = $_GET['status'];
              if ($status=='ok') {
                echo '<br><br><div class="alert alert-success" role="alert">Data Customer berhasil di-update</div>';
              }
              elseif($status=='err'){
                echo '<br><br><div class="alert alert-danger" role="alert">Data Customer gagal di-update</div>';
              }
            }
           ?>
          <h2 style="margin: 30px 0 30px 0;">customers</h2>
          <div class="table-responsive">
            <table border="1" class="table table-striped table-sm" >
              <thead>
                <tr>
                  <th>customerNumber</th>
                  <th>customerName</th>
                  <th>contactLastName</th>
                  <th>contactFirstName</th>
                  <th>phone</th>
                  <th>addressLine1</th>
                  <th>addressLine2</th>
                  <th>city</th>
                  <th>state</th>
                  <th>postalCode</th>
                  <th>country</th>
                  <th>salesRepEmployeeNumber</th>
                  <th>creditLimit</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  //proses menampilkan data dari database:
                  //siapkan query SQL
                  $query = "SELECT * FROM customers";
                  $result = $conn->query($query);
                 ?>
                 <?php while($data = $result->fetch(PDO::FETCH_ASSOC)): ?>
                  <tr>
                    <td><?php echo $data['customerNumber'];  ?></td>
                    <td><?php echo $data['customerName'];  ?></td>
                    <td><?php echo $data['contactLastName'];  ?></td>
                    <td><?php echo $data['contactFirstName'];  ?></td>
                    <td><?php echo $data['phone'];  ?></td>
                    <td><?php echo $data['addressLine1'];  ?></td>
                    <td><?php echo $data['addressLine2'];  ?></td>
                    <td><?php echo $data['city'];  ?></td>
                    <td><?php echo $data['state'];  ?></td>
                    <td><?php echo $data['postalCode'];  ?></td>
                    <td><?php echo $data['country'];  ?></td>
                    <td><?php echo $data['salesRepEmployeeNumber'];  ?></td>
                    <td><?php echo $data['creditLimit'];  ?></td>
                    <td>
                      <a href="<?php echo "updateCust.php?nrp=".$data['customerNumber']; ?>" class="btn btn-outline-warning btn-sm"> Update</a>
                      &nbsp;&nbsp;
                      <a href="<?php echo "delCust.php?number=".$data['customerNumber']; ?>" class="btn btn-outline-danger btn-sm"> Delete</a>
                    </td>
                  </tr>
                 <?php endwhile ?>
              </tbody>
            </table>
          </div>
        </main>
      </div>
    </div>

  </body>
</html>
