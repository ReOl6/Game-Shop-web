<?php
require_once('components.php');
include('server.php');
session_start();
?>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.0/css/fontawesome.min.css"
    integrity="sha384-z4tVnCr80ZcL0iufVdGQSUzNvJsKjEtqYZjiQrrYKlpGow+btDHDfQWkFjoaz/Zr" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"
    integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT"
    crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
  <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"
    integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc"
    crossorigin="anonymous"></script>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <?php navhead(); ?>
  <?php
  if ($_SESSION['role'] == 'customer') {
    echo '<section class="home-wrapper-1 py-5">
<div class="container-xxl">
    <div class="row h-75 text-center">
    <div class="col-12">
<h1 class="text-danger">You do not have the permisson</h1>
    </div>
    </div>
</div>
      </section>';
  } else {
    echo '<section class="home-wrapper-1 py-5">
      <div class="container-xxl">
          <div class="row text-center mb-5">
          <div class="col-12">
          <h3 class="text-white">All member</h3>
          <table class="table bg-white">
          <tr>
            <th>id</th>
            <th>username</th>
            <th>email</th>
            <th>tier</th>
          </tr>';
    $query = "SELECT * FROM registersys WHERE role = 'customer'";
    $ret = $db->query($query);
    while ($row = $ret->fetchArray(SQLITE3_ASSOC)) {
      echo '<tr>
      <td>' . $row['id'] . '</td>
      <td>' . $row['username'] . '</td>
      <td>' . $row['email'] . '</td>
      <td>' . $row['tier'] . '</td>
    </tr>';
    }
    echo '</table>
    </div>
      </div>
      <div class="row">
      <div class="col-4">
      <form action="" method="POST">
      <div class="form-outline mb-4">
          <input type="text" name="removemem" required="ID is required" class="form-control">
          <label class="form-label text-white" for="removemem">Remove Member By ID</label>
          
      </div>
      <button type="submit" name="removemember" class="btn btn-danger btn-block">Remove</button>
      </form>
      </div>


      <div class="col-4">
      <form action="" method="POST">
      <div class="form-outline mb-4">
          <input type="text" name="memupdate" required="ID is required" class="form-control">
          <label class="form-label text-white" for="updaterole">Update Customer tier By ID</label>
          <select class="form-select form-select-lg my-5" aria-label=".form-select-lg example" name="selecttier">
  <option selected>Select Tier</option>
  <option value="standard">No Tier</option>
  <option value="silver">Silver Tier</option>
  <option value="gold">Gold Tier</option>
  <option value="platinum">Platinum Tier</option>
</select>
          
      </div>
      <button type="submit" name="updaterole" class="btn btn-danger btn-block">Update</button>
      </form>
      </div>
      </div>
  </div>
        </section>

        <section class="home-wrapper-1 py-5">
        <div class="container-xxl">
        <h1 class="text-white">Product Management</h1>
        <form action="" method="POST">
        <div class="row">
        
        
        <div class="col-4">
        
      <div class="form-outline mb-4">
          <input type="text" name="proid" required="ID is required" class="form-control" placeholder="ID of Product">
          
      </div>
      </div>

        <div class="col-4">
        
      <div class="form-outline mb-4">
          <input type="text" name="proquan" required="Number" class="form-control" placeholder="Quantity">
          
      </div>
      </div>
      

      <div class="col-4">
      <button type="submit" name="addpro" class="btn btn-danger btn-block">Add</button>
      </div>
      </form>
      
      
        <form action="" method="POST">
        <div class="row w-75 m-auto">
      
      <div class="col-6">
      <select class="form-select form-select-lg mb-5" aria-label=".form-select-lg example" name="selectcate">
      <option selected value="all">Select Category</option>
      <option value="Nintendo">Nintendo</option>
      <option value="PC">PC</option>
      <option value="PlayStation">PlayStation</option>
      <option value="Xbox">Xbox</option>
    </select>
    
      </div>
      
      <div class="col-4">
      <button type="submit" name="find" class="btn btn-danger btn-block">Find</button>
      </div>
      
      </div>
      </form>
      
        </div>
        </div>
        <div class="container-xxl">
        
        <div class="row">
        <table class="table bg-white">
          <tr>
            <th>id</th>
            <th>username</th>
            <th>email</th>
            <th>tier</th>
          </tr>';
    if (isset($_POST['find'])) {
      $catefind = $_POST['selectcate'];
      if ($catefind == 'Nintendo') {
        $query = "SELECT * FROM Products WHERE Prod_Category = 'Nintendo'";
      } elseif ($catefind == 'PC') {
        $query = "SELECT * FROM Products WHERE Prod_Category = 'PC'";
      } elseif ($catefind == 'PlayStation') {
        $query = "SELECT * FROM Products WHERE Prod_Category = 'PlayStation'";
      } elseif ($catefind == 'Xbox') {
        $query = "SELECT * FROM Products WHERE Prod_Category = 'Xbox'";
      }
      else {
        $query = "SELECT * FROM Products";
      }

    } else{
      $query = "SELECT * FROM Products";
    }
    $ret = $db->query($query);
    while ($row = $ret->fetchArray(SQLITE3_ASSOC)) {
      echo '<tr>
      <td>' . $row['ProdID'] . '</td>
      <td>' . $row['Prod_Name'] . '</td>
      <td>' . $row['Prod_Category'] . '</td>
      <td>' . $row['Prod_Quantity'] . '</td>
    </tr>';
    }
    echo '</table>
        </div>
        </div>
        </section>';
  }

  if (isset($_POST['addpro'])) {
    $idpro = $_POST['proid'];
    $quanpro = $_POST['proquan'];
    $quanpro = (int)$quanpro;
    $query = "UPDATE Products SET Prod_Quantity = Prod_Quantity+$quanpro WHERE ProdID = '$idpro'";
    $db->exec($query);
  }

  if (isset($_POST['removemember'])) {
    $idremove = $_POST['removemem'];
    $query = "DELETE FROM registersys WHERE id = '$idremove'";
    $db->exec($query);
  }
  if (isset($_POST['updaterole'])) {
    $idup = $_POST['memupdate'];
    $tierup = $_POST['selecttier'];
    $query = "UPDATE registersys SET tier = '$tierup' WHERE id = '$idup'";
    $db->exec($query);
  }
  ?>

  <?php
  footer();
  ?>

</body>

</html>