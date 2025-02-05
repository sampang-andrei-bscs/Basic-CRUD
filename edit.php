<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_crud";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$editData = null;
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $editResult = $conn->query("SELECT * FROM users WHERE id=$id");
    $editData = $editResult->fetch_assoc();
}


if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "UPDATE users SET name='$name', email='$email', password='$password' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        header("Location: table.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
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
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        h2 {
            margin-bottom: 15px;
            color: #333;
        }

        
        input {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 10px;
            background: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 10px;
        }

        button:hover {
            background: #0056b3;
        }

        .back-link {
            display: block;
            margin-top: 15px;
            text-decoration: none;
            font-size: 14px;
            color: #007BFF;
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Edit User</h2>
        <form method="POST">
            <input type="hidden" name="id" value="<?php echo $editData['id'] ?? ''; ?>">
            <input type="text" name="name" placeholder="Enter Name" value="<?php echo $editData['name'] ?? ''; ?>" required>
            <input type="email" name="email" placeholder="Enter Email" value="<?php echo $editData['email'] ?? ''; ?>" required>
            <input type="password" name="password" placeholder="Enter Password" value="<?php echo $editData['password'] ?? ''; ?>" required>
            <button type="submit" name="update">Update</button>
        </form>
        <a href="table.php" class="back-link">Back to List</a>
    </div>

</body>
</html>
