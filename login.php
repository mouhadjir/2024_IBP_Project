<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<nav class="navbar bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="./">Reservations</a>
  </div>
</nav>
<body>
<form method="post" class="container mt-5 d-flex flex-column justify-content-center ">
  <div class="mb-3 w-50">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" name="EMAIL" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div>
  <div class="mb-3 w-50">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input name="PASSWORD" type="password" class="form-control" id="exampleInputPassword1">
  </div>

  <button type="submit" name="submit" class="btn btn-primary w-50">Submit</button>
</form>
    <br>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>

<?php 

if(isset($_POST['submit'])) {
    require_once "./connect.php";

    $email = $_POST['EMAIL'];
    $password = sha1($_POST['PASSWORD']);

    $checkAdmin = $database->prepare("SELECT * FROM admins WHERE email = :email AND password = :password");
    $checkAdmin->bindParam("email", $email);
    $checkAdmin->bindParam("password", $password);
    $checkAdmin->execute();

    if($checkAdmin->rowCount() > 0) {
        session_start();
        $_SESSION['email'] = $email;

        header("Location: ./cpanel.php");
    } else {
        echo '<div class="alert alert-danger" role="alert">
        Inccorrect Credentials!
      </div>';
    }
}

?>