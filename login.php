<!DOCTYPE html>
<html>
<head>
    <title>Multi level log in form</title>
</head>
<body>
    <form method="POST">
        <table>
            <tr>
                <td>
                    USER TYPE
                </td>
                <td>
                    <select name="type">
                        <option value="-1">
                            Select user type
                        </option>
                        <option value="Admin">
                            Admin
                        </option>
                        <option value="User">
                            User
                        </option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    Username
                </td>
                <td>
                    <input type="text" name="username" placeholder="username">

                </td>
            </tr>
            <tr>
                <td>
                    Password
                </td>
                <td>
                    <input type="password" name="password" placeholder="password">
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td><input type="submit" name="submit" value="Login"></td>
            </tr>
            
        </table>
    </form>
</body>

</html>

<?php

$db = new mysqli("localhost","root","","multilevel");


if($db->connect_errno){
    echo "Database not found".$db->connect_errno;
}

if(isset($_POST['submit'])){
    $type = $_POST['type'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "select * from login where type='$type' and username = '$username' and password = '$password' ";

    $result = mysqli_query($db,$query);
    while($row = mysqli_fetch_assoc($result)){
        if($row['username']==$username && $row['password']==$password && $row['type']=='Admin'){
            header("Location: admin.html");
        }
        elseif($row['username']==$username && $row['password']==$password && $row['type']=='User'){
            header("Location: user.html");
        }
    }
}

?>