<!-- php coding -->
<?php 
  //Connect to the database
  //INSERT INTO `crud1` (`crud1_id`, `crud1_name`, `crud1_email`, `crud1_tstamp`) VALUES (NULL, 'Robi', 'robi1@gmail.com', CURRENT_TIMESTAMP);

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

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

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

    <!-- Create Table or form  -->
    <div class="container">
        <div class="row mt-5">
            <div class="col-8">
                <h4 class="text-center">Show Data</h4>
                <table class="table table-hover " style="background-color: rgb(173, 190, 190);">
                    <thead>
                        <tr>
                          <th scope="col">SL</th>
                          <th scope="col">Name</th>
                          <th scope="col">Email</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>

                        <?php 
                            $sql =  "SELECT * FROM `crud1`";
                            $result = mysqli_query($conn, $sql);
                            while($row = mysqli_fetch_assoc($result)){
                              echo "
                              <tr>
                                <td>". $row['crud1_id']."</td>
                                <td>". $row['crud1_name']."</td>
                                <td>". $row['crud1_email']."</td>
                              </tr>";
                            }
                        ?>
                        
                      </tbody>
                </table>
            </div>
            <div class="col-4">
                <h4 class="text-center">Data Add</h4>
                <div class="form" style="background-color: rgba(218, 209, 209, 0.877); padding: 10px; border-radius: 5px;">
                    <form>
                        <div class="mb-3">
                          <label for="Email" class="form-label">Name</label>
                          <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                          <label for="Name" class="form-label">Email</label>
                          <input type="email" class="form-control" id="email" name="email">
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                      </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
       <?php 
          $sql = "SELECT * FROM `crud1`";
          $result = mysqli_query($conn, $sql);
          
          while($row = mysqli_fetch_assoc($result)){
            echo $row['crud1_name']. ". Hello ". $row['crud1_email'];
            echo "</br>";
          }
       ?>
    </div>

</body>
</html>