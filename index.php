<?php
// variables declaration
$insert = false;
$update = false;
$delete = false;
$no = false;

// Connect to database
$conn = mysqli_connect("localhost", "root", "", "php_tasks");

if (!$conn) {
  die("Connection failed to database!!" . mysqli_connect_error());
}


// SQL query to delete a record
if (isset($_GET['delete'])) {
  $sno = $_GET['delete'];
  $sql = "DELETE FROM `tasks` WHERE `sno`=$sno";
  $result = mysqli_query($conn, $sql);
  if ($result) {
    $delete = true;
  } else {
    $no = true;
  }
}

// SQL query to update records
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['snoEdit'])) {
    $sno = $_POST['snoEdit'];
    $Task = $_POST['TaskEdit'];
    $Description = $_POST['DescriptionEdit'];

    $sql = "UPDATE `tasks` SET `Task`='$Task', `Description`='$Description' WHERE `sno`='$sno'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
      $update = true;
    } else {
      $sno = true;
    }

    // SQL query to insert record
  } else {
    $Task = $_POST['Task'];
    $Description = $_POST['Description'];

    $sql = "INSERT INTO `tasks` (`Task`, `Description`, `timestamp`) VALUES ('$Task', '$Description', current_timestamp())";
    $insert = mysqli_query($conn, $sql);

    if ($insert) {
      $insert = true;
    } else {
      $sno = true;
    }
  }
}
?>

<!-- Frontend html -->
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>To-Do List</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
  <style>
    h1{
      margin: 20px;
      padding: 10px;
      text-align: center;
      text-transform: capitalize;
      text-decoration: underline;
    }
  </style>
</head>

<body>
  <?php require "partials/_nav.php"?>

  <!-- alert for successful insertion -->
  <?php
  if ($insert) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> Your task has been inserted successfully!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
  }
  ?>

  
  <!-- main form with add button -->
  <div class="container mt-4">
    <form action="/CRUD/index.php" method="post">
      <h1>TASK_TODAY</h1>
      <div class="mb-5">
        <label for="Task" class="form-label"><strong>Task</strong></label>
        <input type="text" class="form-control" id="Task" name="Task" aria-describedby="emailHelp">
      </div>
      <div class="mb-2">
        <label for="Description" class="form-label"><strong>Description</strong></label>
        <textarea class="form-control" id="Description" name="Description" rows="5"></textarea>
      </div>
      <button type="submit" class="btn btn-info">Add Task</button><hr>
    </form>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  
</body>
</html>