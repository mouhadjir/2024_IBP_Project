<?php
include "connect.php"
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scalew>S=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>reservation</title>

</head>
<body>
    <div class ="reservation"> 
    <form method="POST">
        <nav>
            <img src="imgs/vecteezy_plane.jpg" alt="">
            <h4>reservation</h4>

            <label> name customer</label><br>
            <input type="text" name="NAME"><br>
            
            //<label> customer email</label><br>
            <input type="text" name="EMAIL"><br>

            <label> customer telephone</label><br>
            <input type="text" name="TELEPHONE"><br>

            <label>date</label><br>
            <input type="date" name="DATE"><br>

            <a href="./login.php" type="rest" name="rest">Login</a>
            <button type="submit" name="submit">submit</button>

            <div class="social">
            <a href="#"><img class="socialimgs" src="imgs/facebook.png" alt=""></a>
            <a href="#"><img class="socialimgs" src="imgs/tweet.png" alt=""></a>
            <a href="#"><img class="socialimgs" src="imgs/sharing.png" alt=""></a>
            </div>
        </nav>
        <!----end admin panel---->
        <!-----start info---->
    
    
        <div class= "info">
            <table>
                <tr>
                    <th>id</th>
                    <th> name customer</th>
                    <th>email</th>
                    <th>telephone</th>
                    <th>dates</th>
                </tr>
                <?php
                require_once("./connect.php");

                $customers = $database->prepare("SELECT * FROM customer");
                $customers->execute();

                foreach($customers as $data) {
                    echo '<tr>
                    <td>'.$data['id'].'</td>
                    <td>'.$data['NAME'].'</td>
                    <td>'.$data['EMAIL'].'</td>
                    <td>'.$data['TELEPHONE'].'</td>
                    <td>'.$data['DATE'].'</td>
                    </tr>';
                }
                ?>
            </table>
        </div>
        
    </form>

    <?php
    if(isset($_POST['submit'])){
        require_once "./connect.php";

        $name = $_POST['NAME'];
        $email =$_POST['EMAIL'];
        $telephone =$_POST['TELEPHONE'];
        $date =$_POST['DATE'];

        $add = $database->prepare("INSERT INTO customer(NAME, EMAIL, TELEPHONE, DATE) VALUES(:NAME,:EMAIL, :TELEPHONE, :DATE)");
        $add->bindParam("NAME", $name);
        $add->bindParam("EMAIL", $email);
        $add->bindParam("TELEPHONE", $telephone);
        $add->bindParam("DATE", $date);
        
        if($add->execute()) {
            header("location: http://localhost/amiprogramme/");
        }
    }
    ?>


 </div>

</body>

</html>