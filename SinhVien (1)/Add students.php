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
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #ff4d6d;
        }

        form label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }

        form input[type="text"],
        form input[type="email"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        form input[type="submit"] {
            width: auto;
            padding: 12px 24px;
            background-color: #ff4d6d;
            border: none;
            color: white;
            text-decoration: none;
            cursor: pointer;
            border-radius: 20px;
            transition: background-color 0.3s ease;
        }

        form input[type="submit"]:hover {
            background-color: #ff3355;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #ff4d6d;
            color: white;
        }

        nav {
            text-align: center;
            margin-top: 20px;
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
        }

        nav ul li button:hover {
            background-color: #ff3355;
        }

        footer {
            text-align: center;
            padding: 20px 0;
            background-color: #fff;
            color: #777;
            margin-top: 20px;
            border-top: 1px solid #ccc;
        }

        footer p {
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Add Student</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <label for="rollno">Roll No:</label>
            <input type="text" id="rollno" name="rollno" required>

            <label for="sname">Name:</label>
            <input type="text" id="sname" name="sname" required>

            <label for="address">Address:</label>
            <input type="text" id="address" name="address" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="class">Class:</label>
            <input type="text" id="class" name="class" required>

            <input type="submit" value="Add Student">
     <nav>
        <ul>
             <li><button onclick="location.href='Add students.php'">back</button></li>
             <li><button onclick="location.href='home.php'">Home</button></li>
        </ul>
    </nav>
        </form>

        <?php
        // Kiểm tra nếu có dữ liệu được gửi từ biểu mẫu
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Kết nối đến cơ sở dữ liệu
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "sinhvien";

            // Tạo kết nối
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Kiểm tra kết nối
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Lấy dữ liệu từ biểu mẫu
            $rollno = $_POST['rollno'];
            $sname = $_POST['sname'];
            $address = $_POST['address'];
            $email = $_POST['email'];
            $class = $_POST['class'];

            // Thêm sinh viên vào cơ sở dữ liệu
            $sql = "INSERT INTO students (Rollno, Sname, Address, Email, Class) VALUES ('$rollno', '$sname', '$address', '$email', '$class')";

            if ($conn->query($sql) === TRUE) {
                echo "<p>More student success!</p>";
            } else {
                echo "<p>Lỗi: " . $sql . "<br>" . $conn->error . "</p>";
            }

            // Đóng kết nối
            $conn->close();
        }
        ?>
    </div>

    <div class="container">
        <h2>Student List</h2>
        <table>
            <tr>
                <th>Roll No</th>
                <th>Name</th>
                <th>Address</th>
                <th>Email</th>
                <th>Class</th>
            </tr>
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

            // Truy vấn để lấy thông tin sinh viên
            $sql = "SELECT * FROM students";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Hiển thị thông tin sinh viên trong bảng
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["Rollno"] . "</td>";
                    echo "<td>" . $row["Sname"] . "</td>";
                    echo "<td>" . $row["Address"] . "</td>";
                    echo "<td>" . $row["Email"] . "</td>";
                    echo "<td>" . $row["Class"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>There are no students in the database.</td></tr>";
            }
            $conn->close();
            ?>
        </table>
    </div>
</body>
</html>
