<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_crud";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if(isset($_POST['submit'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if($name == "" || empty($name)){
        header('location:index.php?message=Fill up the name!');
    }
    else{
        $sql = "insert into users (id, name, email, password) value ('$id', '$name', '$email', '$password')";
        $result = $conn->query($sql);
        if(!$result){
            die("failed".mysqli_error($conn));
        }
        else{
            header('location:index.php?message=New user added!');
        }
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP CRUD Form</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            text-align: center;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        input, button {
            display: block;
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        button {
            background: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background: #0056b3;
        }

        .success {
            color: green;
            margin-top: 10px;
        }

        .error {
            color: red;
            margin-top: 10px;
        }

      
        .show-users-btn {
            background: #28a745;
            margin-top: 20px;
        }

        .show-users-btn:hover {
            background: #218838;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>CRUD Form</h2>
        <form method="POST">
            <input type="text" name="name" placeholder="Enter Name" required>
            <input type="email" name="email" placeholder="Enter Email" required>
            <input type="password" name="password" placeholder="Enter Password" required>
            <button type="submit" name="submit">Add</button>
        </form>

        
        <a href="table.php"><button class="show-users-btn">Show Users</button></a>
    </div>

</body>
</html>