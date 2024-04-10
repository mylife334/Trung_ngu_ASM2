<!DOCTYPE html>
<html>
<head>
    <title>Student information</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f9f6f7;
        }

        h2 {
            text-align: center;
            padding: 20px 0;
            color: #ff4d6d;
            font-size: 28px;
        }

        .search-container {
            text-align: center;
            margin-bottom: 20px;
        }

        input[type=text] {
            padding: 12px 24px;
            border-radius: 20px;
            border: 2px solid #ddd;
            font-size: 16px;
            margin-right: 5px;
            transition: all 0.3s ease;
        }

        input[type=text]:focus {
            border-color: #ff4d6d;
            box-shadow: 0 0 8px 0 rgba(255, 77, 109, 0.6);
        }

        button {
            padding: 12px 24px;
            border: none;
            border-radius: 20px;
            background-color: #ff4d6d;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        button:hover {
            background-color: #ff3355;
        }

        nav {
            background-color: #fff;
            padding: 10px 0;
            text-align: center;
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

        table {
            width: 80%;
            margin: 0 auto;
            border-collapse: collapse;
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

        footer {
            text-align: center;
            padding: 20px 0;
            background-color: #fff;
            color: #777;
        }

        footer p {
            font-size: 14px;
        }
    </style>
</head>
<body>
    <h2>Student information</h2>
    <div class="search-container">
        <input type="text" id="searchInput" placeholder="Nhập từ khóa...">
        <button onclick="search()">Search</button>
    </div>
    <nav>
        <ul>
             <li><button onclick="location.href='student directory.php'">back</button></li>
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

    // Truy vấn để lấy thông tin sinh viên
    $sql = "SELECT * FROM students";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Hiển thị thông tin sinh viên trong bảng
        echo "<table>";
        echo "<tr><th>Roll No</th><th>Name</th><th>Address</th><th>Email</th><th>Class</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["Rollno"] . "</td>";
            echo "<td>" . $row["Sname"] . "</td>";
            echo "<td>" . $row["Address"] . "</td>";
            echo "<td>" . $row["Email"] . "</td>";
            echo "<td>" . $row["Class"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "There are no students in the database.";
    }
    $conn->close();
    ?>
    <script>
        function search() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            table = document.querySelector("table");
            tr = table.getElementsByTagName("tr");
            for (i = 1; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1]; // Thay 1 bằng chỉ số cột bạn muốn tìm kiếm (1 là cột tên)
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>
</body>
</html>
