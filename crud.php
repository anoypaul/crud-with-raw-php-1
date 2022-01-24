<!-- php coding -->
<?php 
  //Connect to the database
  //INSERT INTO `crud1` (`crud1_id`, `crud1_name`, `crud1_email`, `crud1_tstamp`) VALUES (NULL, 'Robi', 'robi1@gmail.com', CURRENT_TIMESTAMP);
  $insert = false;
  $update = false;

  $servername = "localhost";
  $username = "root";
  $password = "";
  $database = "php_raw";

  //Create a connection
  $conn = mysqli_connect($servername, $username, $password, $database);

  //Die if connection was not successful
  if(!$conn){
    die("Sorry we failed to connect: ". mysqli_connect_error());
  }
  // else{
  //   echo "Connect was successful </br>";
  // }
  
  // data create into database
  if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $crud1_name = $_POST['name'];
    $crud1_email = $_POST['email'];
    $sql = "INSERT INTO `crud1` (`crud1_name`, `crud1_email`) VALUES ('$crud1_name','$crud1_email')";
    $result = mysqli_query($conn, $sql);
    if($result){
      $insert = true; 
    }else{
      echo "Record was not inserted successfully";
    }
  }

?>

<!-- delete data -->
<?php 
    if (isset($_GET['delete'])) {
       $stdid = $_GET['delete'];
       $query = "DELETE FROM crud1 WHERE crud1_id={$stdid}";
       $deletequery = mysqli_query($conn, $query);
       if($deletequery){
           echo "data remove successfully";
       } 
    }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jq-3.6.0/dt-1.11.3/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jq-3.6.0/dt-1.11.3/datatables.min.js"></script> -->
    <title>CRUD Application with RAW PHP</title>

</head>
<body>
    
    <!-- Create nav var -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">CRUD APP</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link " href="#">Contact Us</a>
            </li>
          </ul>
          <form class="d-flex">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
          </form>
        </div>
      </div>
    </nav>

    <!-- alert -->
    <?php 
      if($insert){
          echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
              <strong>successfully !</strong> You record inserted successfully.
              <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
          ";
      }
    ?>
    <?php 
      if($update){
          echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
              <strong>successfully !</strong> You Data Update successfully.
              <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
          ";
      }
    ?>

    <!-- Create Table or form  -->
    <div class="container">
      <div class="row mt-5">
        <div class="col-8">
          <!-- <h4 class="text-center">Show Data</h4> -->
          <table class="table table-striped" id="mytable">
            <thead>
              <tr>
                <th scope="col">SL</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">ActionE</th>
                <th scope="col">ActionD</th>
              </tr>
            </thead>
            <tbody>
              <?php 
                  $sql =  "SELECT * FROM `crud1`";
                  $readData = mysqli_query($conn, $sql);
                  if($readData->num_rows > 0){
                  while($rowData = mysqli_fetch_assoc($readData)){
                    $crud1_id = $rowData['crud1_id'];
                    $crud1_name = $rowData['crud1_name'];
                    $crud1_email = $rowData['crud1_email'];
              ?>
                <tr>
                    <td><?php echo $crud1_id ?></td>
                    <td><?php echo $crud1_name ?></td>
                    <td><?php echo $crud1_email ?></td>
                    <td>
                        <a href="crud.php?update=<?php echo $crud1_id ?>" class="btn btn-info">Update</a>
                    </td>
                    <td>
                        <a href="crud.php?delete=<?php echo $crud1_id ?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>

              <?php }} else{
                  echo "No Data to show";
              }?>
            </tbody>
          </table>
        </div>
        <!-- form design -->
        <div class="col-4">
          <h4 class="text-center">Data Add</h4>
          <div class="form" style="background-color: rgba(218, 209, 209, 0.877); padding: 10px; border-radius: 5px;">
            <form action="/crud-with-raw-php/crud.php" method="post">
              <div class="mb-3">
                <label for="Name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp">
              </div>
              <div class="mb-3">
                <label for="Email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email">
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>
        <!-- form design 2 -->
        <div class="col-4">
          <h4 class="text-center">Data Add</h4>
          <div class="form" style="background-color: rgba(218, 209, 209, 0.877); padding: 10px; border-radius: 5px;">
            <form action="" method="post">
              <?php 
                if(isset($_GET['update'])){
                  $stdid = $_GET['update'];
                  $query = "SELECT * FROM crud1 WHERE crud1_id = {$stdid}";
                  $getdata = mysqli_query($conn, $query); 
                  while($rx = mysqli_fetch_assoc($getdata)){
                    $crud1_id = $rx['crud1_id'];
                    $crud1_name = $rx['crud1_name'];
                    $crud1_email = $rx['crud1_email'];
                  
              ?>

              <div class="mb-3">
                <label for="Name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value = "<?php echo $crud1_name;  ?>">
              </div>
              <div class="mb-3">
                <label for="Email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value = "<?php echo $crud1_email;  ?>" >
              </div>
              <button type="submit" class="btn btn-primary" value="update" name = "update_d">Submit</button>
              <?php }} ?>

              <?php 
                if(isset($_POST['update_d'])){
                  $crud1_name = $_POST['name'];
                  $crud1_email = $_POST['email'];
                  $query = "UPDATE crud1 SET crud1_name = '$crud1_name', crud1_email = '$crud1_email' WHERE crud1_id = {$stdid}";
                  $updatequery = mysqli_query($conn, $query);
                  if($updatequery){
                    $update = true; 
                  }
                }
              ?>
            </form>
          </div>
        </div>

      </div>
  </div>

    <script>
      $(document).ready( function () {
        $('#myTable').DataTable();
      } );
    </script>

</body>
</html>