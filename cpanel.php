<?php

session_start();

if(!isset($_SESSION['email'])) {
    header("Location: ./");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<nav class="navbar bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="./">Reservations</a>
    <form class="d-flex" role="search" method="post">
      <button type="submit" name="logout" class="btn btn-outline-danger">Logout</button>
    </form>
  </div>
</nav>

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Date</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
   

    <?php

require_once "./connect.php";

$customers = $database->prepare("SELECT * FROM customer");
$customers->execute();

foreach($customers as $c) {
    echo '
    <tr>
      <th scope="row">'.$c['id'].'</th>
      <td>'.$c['NAME'].'</td>
      <td>'.$c['EMAIL'].'</td>
      <td>'.$c['DATE'].'</td>
      <td>
        <form method="post" style="display:inline;">
          <button value='.$c['id'].' name="cancel" type="submit" class="btn btn-outline-danger">Cancel</button>
        </form>
      </td>
    </tr>
    ';
}

?>
</tbody>
</table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

<?php

if(isset($_POST['cancel'])) {
    $id = $_POST['cancel'];

    require_once "./connect.php";
    $delete = $database->prepare("DELETE FROM customer WHERE id = :id");
    $delete->bindParam("id", $id);
    if($delete->execute()) {
        header("Location: ./cpanel.php");
    }
}

if(isset($_POST['logout'])) {
    session_unset();
    session_destroy();

    header("Location: ./login.php");
}

?>