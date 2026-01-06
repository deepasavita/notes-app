   <?php
session_start();

$server = "localhost";
$username = "root";
$password = "";
$database = "notes";

$con = mysqli_connect($server, $username, $password, $database);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

/*  EDIT NOTE */
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['snoEdit'])) {
    $sno = $_POST['snoEdit'];
    $title = $_POST['title'];
    $description = $_POST['description'];

    $sql = "UPDATE notes SET title='$title', description='$description' WHERE sno='$sno'";
    mysqli_query($con, $sql);

    $_SESSION['success'] = "Note updated successfully!";
    header("Location: index.php");
    exit;
}

/*  DELETE NOTE */
if (isset($_GET['delete'])) {
    $sno = $_GET['delete'];
    $sql = "DELETE FROM notes WHERE sno = $sno";
    mysqli_query($con, $sql);

    $_SESSION['success'] = "Note deleted successfully!";
    header("Location: index.php");
    exit;
}

/*  INSERT NOTE */
if ($_SERVER['REQUEST_METHOD'] == "POST" && !isset($_POST['snoEdit'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
                                                                                                                                                                                                                                                                                                                        
    $sql = "INSERT INTO notes (title, description) VALUES ('$title', '$description')";
    mysqli_query($con, $sql);

    $_SESSION['success'] = "Note added successfully!";
    header("Location: index.php");
    exit;
}
?>

<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Notes App</title>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.6/css/dataTables.dataTables.min.css">

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/2.3.6/js/dataTables.min.js"></script>

<script>
$(document).ready(function () {
  $('#myTable').DataTable();
});
</script>

<style>
body { padding-top: 70px; }
</style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
  <div class="container">
    <a class="navbar-brand" href="#">Notes App</a>
  </div>
</nav>

<!--  SUCCESS ALERT -->
<div class="container mt-3">
<?php
if (isset($_SESSION['success'])) {
    echo '
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        ' . $_SESSION['success'] . '
        <button type="button" class="close" data-dismiss="alert">
            <span>&times;</span>
        </button>
    </div>';
    unset($_SESSION['success']);
}
?>
</div>

<!-- EDIT MODAL -->
<div class="modal fade" id="editModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="post">

        <div class="modal-header">
          <h5 class="modal-title">Edit Note</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <div class="modal-body">
          <input type="hidden" name="snoEdit" id="snoEdit">

          <div class="form-group">
            <label>Note Title</label>
            <input type="text" class="form-control" id="titleEdit" name="title">
          </div>

          <div class="form-group">
            <label>Note Description</label>
            <textarea class="form-control" id="descriptionEdit" name="description"></textarea>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>

      </form>
    </div>
  </div>
</div>

<!-- ADD NOTE -->
<div class="container mt-4">
<h2>Add a Note</h2>

<form method="post">
  <div class="form-group">
    <label>Note Title</label>
    <input type="text" name="title" class="form-control" required>
  </div>

  <div class="form-group">
    <label>Note Description</label>
    <textarea name="description" class="form-control" required></textarea>
  </div>

  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>

<!-- NOTES TABLE -->
<div class="container mt-5">
<h3>Saved Notes</h3>

<table class="table table-bordered" id="myTable">
<thead>
<tr>
<th>S.No</th>
<th>Title</th>
<th>Description</th>
<th>Action</th>
</tr>
</thead>

<tbody>
<?php
$sql = "SELECT * FROM notes";
$result = mysqli_query($con, $sql);
$sno = 0;

while ($row = mysqli_fetch_assoc($result)) {
  $sno++;
  echo "<tr>
        <th>$sno</th>
        <td>{$row['title']}</td>
        <td>{$row['description']}</td>
        <td>
          <button class='edit btn btn-sm btn-warning' id='{$row['sno']}' data-toggle='modal' data-target='#editModal'>Edit</button>
          <a href='?delete={$row['sno']}' class='delete btn btn-sm btn-danger'>Delete</a>
        </td>
      </tr>";
}
?>
</tbody>
</table>
</div>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>

<!-- EDIT SCRIPT -->
<script>
let edits = document.getElementsByClassName('edit');

Array.from(edits).forEach((element) => {
  element.addEventListener("click", (e) => {
    let tr = e.target.closest("tr");

    document.getElementById("titleEdit").value = tr.getElementsByTagName("td")[0].innerText;
    document.getElementById("descriptionEdit").value = tr.getElementsByTagName("td")[1].innerText;
    document.getElementById("snoEdit").value = e.target.id;
  });
});
</script>

<!-- DELETE CONFIRM -->
<script>
let deletes = document.getElementsByClassName('delete');

Array.from(deletes).forEach((element) => {
  element.addEventListener("click", (e) => {
    e.preventDefault();
    if (confirm("Are you sure you want to delete this note?")) {
      window.location = element.href;
    }
  });
});
</script>

</body>
</html>
