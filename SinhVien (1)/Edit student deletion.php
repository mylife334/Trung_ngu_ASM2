<!DOCTYPE html>
<html>
<head>
    <title>Student Management</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f9f6f7;
            padding: 20px;
        }

        h2 {
            text-align: center;
            padding: 20px 0;
            color: #ff4d6d;
            font-size: 28px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }

        nav {
            background-color: #fff;
            padding: 10px 0;
            text-align: center;
            border-radius: 20px;
            margin-bottom: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        nav ul {
            list-style-type: none;
            padding: 0;
        }

        nav ul li {
            display: inline;
            margin-right: 10px;
        }

        nav ul li button {
            padding: 12px 24px;
            background-color: #ff4d6d;
            border: none;
            color: white;
            text-decoration: none;
            cursor: pointer;
            border-radius: 20px;
            transition: background-color 0.3s ease;
            box-shadow: 0 2px 4px rgba(255, 77, 109, 0.2);
        }

        nav ul li button:hover {
            background-color: #ff3355;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #ff4d6d;
            color: white;
            border-radius: 20px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .edit-btn, .delete-btn {
            padding: 8px 16px;
            border-radius: 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            margin-right: 5px;
            box-shadow: 0 2px 4px rgba(76, 175, 80, 0.2);
        }

        .delete-btn {
            background-color: #ff4d6d;
        }

        .edit-btn:hover, .delete-btn:hover {
            background-color: #45a049;
        }

        .edit-btn:focus, .delete-btn:focus {
            outline: none;
        }

        .edit-btn:active, .delete-btn:active {
            transform: translateY(2px);
        }

        .update-form {
            margin-top: 20px;
        }

        .update-form input[type="text"] {
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ddd;
            margin-bottom: 5px;
            width: calc(100% - 16px);
        }

        .update-form input[type="submit"] {
            padding: 8px 16px;
            border: none;
            border-radius: 20px;
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease;
            box-shadow: 0 2px 4px rgba(76, 175, 80, 0.2);
        }

        .update-form input[type="submit"]:hover {
            background-color: #45a049;
        }

        .update-form input[type="submit"]:focus {
            outline: none;
        }
    </style>
</head>
<body>
    <h2>Student Management</h2>
    <nav>
        <ul>
             <li><button onclick="location.href='Edit student deletion.php'">back</button></li>
             <li><button onclick="location.href='home.php'">Home</button></li>
        </ul>
    </nav>

    <?php
    // Kết nối đến cơ sở dữ liệu
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "sinhvien";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Xử lý yêu cầu sửa sinh viên
    if(isset($_GET['edit_id'])) {
        $edit_id = $_GET['edit_id'];

        // Lấy thông tin sinh viên cần sửa từ cơ sở dữ liệu
        $sql = "SELECT * FROM students WHERE Rollno='$edit_id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            ?>
            <h3>Edit student information</h3>
            <form action="" method="post">
                <input type="hidden" name="rollno" value="<?php echo $row['Rollno']; ?>">
                Name: <input type="text" name="sname" value="<?php echo $row['Sname']; ?>"><br>
                Address: <input type="text" name="address" value="<?php echo $row['Address']; ?>"><br>
                Email: <input type="text" name="email" value="<?php echo $row['Email']; ?>"><br>
                Class: <input type="text" name="class" value="<?php echo $row['Class']; ?>"><br>
                <input type="submit" name="update" value="Update">
            </form>
            <?php
        }
    } elseif(isset($_GET['delete_id'])) { // Xử lý yêu cầu xóa sinh viên
        $delete_id = $_GET['delete_id'];

        // Xóa sinh viên khỏi cơ sở dữ liệu
        $sql = "DELETE FROM students WHERE Rollno='$delete_id'";
        if ($conn->query($sql) === TRUE) {
            echo "Successfully deleted student.";
        } else {
            echo "Lỗi: " . $conn->error;
        }
    } else { // Hiển thị thông tin sinh viên trong bảng
        $sql = "SELECT * FROM students";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Hiển thị thông tin sinh viên trong bảng
            echo "<table>";
            echo "<tr><th>Roll No</th><th>Name</th><th>Address</th><th>Email</th><th>Class</th><th>Actions</th></tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["Rollno"] . "</td>";
                echo "<td>" . $row["Sname"] . "</td>";
                echo "<td>" . $row["Address"] . "</td>";
                echo "<td>" . $row["Email"] . "</td>";
                echo "<td>" . $row["Class"] . "</td>";
                echo "<td><a href='?edit_id=" . $row["Rollno"] . "' class='edit-btn'>Sửa</a> <a href='?delete_id=" . $row["Rollno"] . "' class='delete-btn'>Xóa</a></td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "There are no students in the database.";
        }
    }

    // Xử lý yêu cầu cập nhật thông tin sinh viên
    if(isset($_POST['update'])) {
        $rollno = $_POST['rollno'];
        $sname = $_POST['sname'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        $class = $_POST['class'];

        // Cập nhật thông tin sinh viên trong cơ sở dữ liệu
        $sql = "UPDATE students SET Sname='$sname', Address='$address', Email='$email', Class='$class' WHERE Rollno='$rollno'";
        if ($conn->query($sql) === TRUE) {
            echo "Successfully updated student information.";
        } else {
            echo "Lỗi: " . $conn->error;
        }
    }

    $conn->close();
    ?>
</body>
</html>
2