<?php
include('login.php');
if ($_SESSION['loggedin'] == true) {
    echo "Welcome to the member's area, " . $_SESSION['username'] . "!";
    echo "<script> function(); </script>";
} else {
    echo "Please log in first to see this page.";
}


$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "blog";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

if (isset($_POST['submit'])){
    $reporter=$_POST['username'];
    $password=$_POST['password'];

    echo $reporter;
    echo $password;
    $sql ="SELECT privilege FROM user WHERE  name='$reporter' AND password='$password'";
   
    
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "priviliggg: " . $row["privilege"]."<br>";
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $reporter;
        $_SESSION['privilege']=$row["privilege"];
      
        
    } else {
        echo "0 results";
    }
}

header("Refresh");
?>

    <!DOCTYPE html>
    <html>

    <head>
        <title>My Blog</title>
        <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" type="text/css" href="css/theme.css">
        <script language="javascript" type="text/javascript" src="script/control.js"></script>
    </head>

    <body>
        <div id="menu">
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="new.php">Create Entry</a></li>
                <li><a href="/">About</a></li>
                <li><a href="/loginn.php">Login</a></li>
            </ul>
        </div>

        <h1 class="header1">Login</h1>
        <br>
        <div id="login_div">
            HALOOj gkjafjhsjhfsjh f
            <div class="entry">
                <form class="form1" action="" method="post">
                    <table class="formtable">
                        <tr>
                            <td>Username</td>
                            <td>
                                <input id="username" name="username" placeholder="username" type="text">
                            </td>
                        </tr>
                        <tr>
                            <td>Password</td>
                            <td>
                                <input id="passwprd" name="password" placeholder="password" type="password">
                                <td>
                        </tr>

                        <tr>
                            <td></td>
                            <td>
                                <input id="submit" name="submit" type="submit" value="Login">

                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <div class="feedback">
                                    <?php echo @$error; ?>
                                </div>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>

        <div id="testid">
            BLA BLA SHOW ME
        </div>

    </body>

    </html>
    <script>
        var x = '<%= Session["loggedin"] %>';

        alert(x);
        SetDiv();
    </script>