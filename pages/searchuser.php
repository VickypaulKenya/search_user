
<?php

include_once "../include/header.php";



error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once("../include/db_connect.inc.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Debugging statements
    file_put_contents('debug.log', print_r($_POST, true), FILE_APPEND);

    $user_search = $_POST["usersearch"];    
    if (empty($user_search) ) {
       echo"THis field cannot be epmty";
        exit();
    }

    //select user from a database
    $query="SELECT * FROM comments WHERE username=:usersearch";

    $stmt = $conn->prepare($query);;

    $stmt->bindParam(":usersearch",$user_search);

    $stmt->execute();

    $user_found=$stmt->fetchAll(PDO::FETCH_ASSOC);


    $conn = null;   
    $stmt=null;

} else {
    header("Location: ../include/error.php?error=invalidrequest");
    die("Invalid request method.");
}
?>
<section style="display: flex; flex-direction: column;gap:10px; align-items: center;justify-content: center">
  
    <h1 style="color:blue; margin:10px;">Search result</h1>
    <div style="width:600px; display:grid; grid-template-columns: 1fr 1fr; gap:10px">
    <?php
    if(empty($user_found)){
        echo "<p>No user found</p>";
    }else{
       foreach($user_found as $user){
       echo "<div style='border:1px solid black; display:flex; flex-direction: column; background-color: white; padding:10px; margin:10px;'>"; 
        echo "<h2 style='color:blue;margin-top:5px'>". htmlspecialchars("Usename: ".$user["username"])."</h2>";
        echo "<p style='margin-top:5px; color:black'>". htmlspecialchars("Message: ".$user["message"])."</p>";
        echo "<p p style='margin-top:5px; color:black'>". htmlspecialchars("Date: ".$user["created_at"])."</p>";
        echo "</div>";
       }
    }
    ?>
    </div>
<section>

</body>
</html>