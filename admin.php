<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./index.css">
    <title>administerator</title>
</head>

<body>
    <div class ="reservation"> 
    <form method="POST">
        <nav>
            <h4>administrator</h4>

            <label> name admin</label><br>
            <input type="text" name="NAME"><br>
            
            //<label>email</label><br>
            <input type="text" name="EMAIL"><br>
            <label>telephone</label><br>
            <input type="text" name="TELEPHONE"><br>

            <label>passeword</label><br>
            <input type="passeword" name="PASSEWORD"><br>

            <button type="rest" name="rest">rest</button>
            <button type="submit" name="submit">submit</button>
        </nav>
    </form>
    
</body>
</html>


<?php
if(isset($_POST['submit'])){
    require_once "./connect.php";

    $name = $_POST['NAME'];
    $email =$_POST['EMAIL'];
    $telephone =$_POST['TELEPHONE'];
    $password =sha1($_POST['PASSWORD']);

    $add = $database->prepare("INSERT INTO admins(NAME, EMAIL, TELEPHONE, PASSWORD) VALUES(:NAME,:EMAIL, :TELEPHONE, :PASSWORD)");
    $add->bindParam("NAME", $name);
    $add->bindParam("EMAIL", $email);
    $add->bindParam("TELEPHONE", $telephone);
    $add->bindParam("PASSWORD", $password);
    
    if($add->execute()) {
        header("location: http://localhost/amiprogramme/login.");
    }
}
?>