<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
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


        header {
            text-align: center;
            padding: 20px 0;
            background-color: #fff;
        }

        header h1 {
            color: #ff4d6d;
            font-size: 28px;
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
    <header>
        <h1>Wellcome !</h1>
    </header>
    <nav>
        <ul>
            <li><button onclick="location.href='student directory.php'">Student directory</button></li>
            <li><button onclick="location.href='Add students.php'">Add students</button></li>
            <li><button onclick="location.href='Edit student deletion.php'">Edit student deletion</button></li>
            <li><button onclick="location.href='index.html'">Exit</button></li>
        </ul>
    </nav>
    <footer>
        <p>fpt@edu.vn.</p>
    </footer>
</body>
</html>