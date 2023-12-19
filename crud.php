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
</head>

<body>
  
  <!-- Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="editModalLabel">Edit Task</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
          <!-- modal form -->
        <form action="/CRUD/crud.php" method="post">    
          <div class="modal-body">
            <input type="hidden" name="snoEdit" id="snoEdit">
            

            <div class="mb-5">
              <label for="Task" class="form-label"><strong>Task</strong></label>
              <input type="text" class="form-control" id="TaskEdit" name="TaskEdit" aria-describedby="emailHelp">
            </div>

            <div class="mb-3">
              <label for="Description" class="form-label"><strong>Description</strong></label>
              <textarea class="form-control" id="DescriptionEdit" name="DescriptionEdit" rows="5"></textarea>
            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>

        </form>
      </div>
    </div>
  </div>

  <!-- NAVBAR -->

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand disabled" aria-disabled="true">
        <img src="https://www.nicepng.com/png/full/132-1328843_orange-transparent-checkmark-orange-check-box-png.png" width="40" height="40">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/CRUD/crud.php"><strong>Home</strong></a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="#">About</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Dropdown
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">To-Do today</a></li>
              <li><a class="dropdown-item" href="#">To-Do This Week</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="#">Completed Tasks</a></li>
            </ul>
          </li>
        </ul>
        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>

  <!-- alert for successful insertion -->
  <?php
  if ($insert) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> Your task has been inserted successfully!
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>';
  }
  ?>

  <!-- alert for successful updation -->
  <?php
  if ($update) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> Your task has been updated successfully!
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>';
  }
  ?>

  <!-- alert for successful deletion -->
  <?php
  if ($delete) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> Your task has been deleted successfully!
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>';
  }
  ?>

  <!-- alert for unsuccessful work -->
  <?php
  if ($no) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Error!</strong> We are facing some technical. We regret the inconvinience caused!
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>';
  }
  ?>
  <!-- main form with add button -->
  <div class="container mt-4">
    <form action="/CRUD/crud.php" method="post">
      <h2>TASKS</h2>
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
  <div class="container mt-4 my-3">
    <table class="table table-striped table-sm " id="myTable">
      <thead>
        <tr>
          <th scope="col">Sno</th>
          <th scope="col">Task</th>
          <th scope="col">Description</th>
          <th scope="col">Date</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        <!-- fetch all records from the database to the table -->
        <?php
        $sql = "SELECT * FROM `tasks`";
        $result = mysqli_query($conn, $sql);
        $sno = 0;
        while ($row = mysqli_fetch_assoc($result)) {
          $sno = $sno + 1;
          echo "<tr>
            <th scope='row'>" . $sno . "</th>
            <td>" . $row['Task'] . "</td>
            <td>" . $row['Description'] . "</td>
            <td>" . $row['timestamp'] . "</td>
            <td> 
              <button class=' edit btn btn-sm btn-success' id=" . $row['sno'] . " >Edit</button>
              <button class=' delete btn btn-sm btn-danger' id=d" . $row['sno'] . " >Delete</button> 
            </td>
          </tr>";
        }
        ?>
      </tbody>
    </table>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  
  <!-- Jquery for datatables -->
  <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>  
  <script>
    $(document).ready(function() {
      $('#myTable').DataTable();
    })
  </script>
  
  <!-- backend javascript -->
  <script>
    // event listener for edit button
    edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element) => {
      element.addEventListener('click', (e) => {
        console.log('edit', );
        tr = e.target.parentNode.parentNode;                                             //fetch single row
        title = tr.getElementsByTagName("td")[0].innerText;                              //fetch title from row
        description = tr.getElementsByTagName("td")[1].innerText;                        //fetch description from row
        console.log(title, description);                                                 //print title and description
        DescriptionEdit.value = description;                                             //set id=DescriptionEdit of modal form to fetched description.
        TaskEdit.value = title;                                                          //set id=TaskEdit of modal form to fetched task.
        snoEdit.value = e.target.id;                                                     //set the sno
        console.log(e.target.id);
        $('#editModal').modal('toggle');                                                 //trigger the modal form to open with jquery
      })
    })

    // event listener for delete button
    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener('click', (e) => {
        console.log('delete', );
        sno = e.target.id.substr(1, );
        if (confirm('Are you sure you want to delete this task?')) {                     //pop-up confirmation box
          window.location = `/CRUD/crud.php?delete=${sno}`;
          console.log('y');
        } else {
          console.log('n');
        }
      })
    })
  </script>
</body>
</html>