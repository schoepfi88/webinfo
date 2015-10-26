<?php
include('login.php');
include('db.php');

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

if ($_POST['action'] == 'login'){
    $reporter=$_POST['user'];
    $password=$_POST['password'];
    $sql ="SELECT privilege FROM user WHERE  name='$reporter' AND password='$password'";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo $row["privilege"];
    } else {
        $error = "login fail";
        echo 1;
    }
}
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
            <ul id="menubar">
                <li><a href="/">Home</a></li>
                <li><a href="new.php">Create Entry</a></li>
                <li><a href="/">About</a></li>
                <li><a href="/loginn.php">Login</a></li>
            </ul>
        </div>

        <h1 class="header1">Login</h1>
        <br>
        <div id="login_div">
            <div class="entry">
                <form class="form1">
                    <table class="formtable">
                        <tr>
                            <td style="text-align: center;">
                                <input id="username" name="username" placeholder="username" type="text" style="width: 20%">
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center;">
                                <input id="password" name="password" placeholder="password" type="password" style="width: 20%">
                            </td>
                        </tr>

                        <tr>
                            <td style="text-align: center;">
                                <button onclick="login()" type="button" style="width: 20%; padding-left: 0%; padding-right: 0%; float: none; margin-right: 0;">Login</button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="feedback">
                                    <?php echo $error; ?>
                                </div>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>

    </body>

    </html>