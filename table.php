<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_crud";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM users WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        header("Location: table.php"); 
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

$result = $conn->query("SELECT * FROM users");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP CRUD - Users List</title>
    <link rel="stylesheet" href="style.css">
    <style>
   
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            padding: 20px;
        }

 
        .container {
            width: 80%;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

   
        .title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 15px;
            color: #333;
            text-align: center;
        }

  
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            background: white;
            border-radius: 8px;
            overflow: hidden;
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }

        th {
            background: #007BFF;
            color: white;
        }

        tr:nth-child(even) {
            background: #f9f9f9;
        }

        tr:hover {
            background: #f1f1f1;
        }

        .btn {
            padding: 10px 16px;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
            border-radius: 5px;
            transition: background-color 0.3s ease, transform 0.3s ease;
            display: inline-block;
            text-align: center;
            margin-right: 10px;
        }

        .edit-btn {
            background: #28a745;
            color: white;
            border: none;
        }

        .edit-btn:hover {
            background: #218838;
            transform: translateY(-2px);
        }

        .delete-btn {
            background: #dc3545;
            color: white;
            border: none;
        }

        .delete-btn:hover {
            background: #c82333;
            transform: translateY(-2px); 
        }

       
        .back-btn {
            margin-bottom: 20px;
            padding: 12px 20px;
            background: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            position: absolute; 
            left: 20px;
            top: 20px; 
        }

        .back-btn:hover {
            background: #0056b3;
            transform: translateY(-2px); 
        }

    </style>
</head>
<body>

    <div class="container">
      
        <a href="index.php" class="back-btn">Back to Form</a>

        <h3 class="title">Users List</h3>

        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Password</th>
                <th>Action</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['password']; ?></td>
                    <td>
                        <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn edit-btn">Edit</a>
                        <a href="?delete=<?php echo $row['id']; ?>" class="btn delete-btn">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </table>

    </div>

</body>
</html>

<?php $conn->close(); ?>
