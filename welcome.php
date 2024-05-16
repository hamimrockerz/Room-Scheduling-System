<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Room Scheduling System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        header {
    background-color: #343a40;
    color: white;
    padding: 10px 20px; 
    text-align: center;
    margin: 0;
}

header img {
    width: 80px; 
    height: auto;
    margin-right: 10px; 
    vertical-align: middle;
}

header h1 {
    margin: 0;
    font-size: 20px; 
    display: inline-block;
    vertical-align: middle;
}
        .nav-buttons {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin: 0 auto;
            width: 80%;
        }

        .nav-button {
            background-color: #3498db;
            color: white;
            text-align: center;
            margin: 10px;
            padding: 20px;
            border-radius: 10px;
            cursor: pointer;
            flex: 0 0 calc(33.33% - 20px);
            width: 200px;
            height: 100px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .nav-button:hover {
            transform: scale(1.05);
            background-color: #2980b9;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        footer {
            width: 100%;
            background-color: #34495e;
            color: white;
            padding: 20px;
            text-align: center;
            flex-shrink: 0;
            margin-top: auto;
            box-shadow: 0 -4px 8px rgba(0, 0, 0, 0.1);
        }

        .footer-link-1 {
            color: #ecf0f1;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-link-1:hover {
            color: lightblue;
            text-decoration: none;
        }

        .footer-link-2 {
            color: #ecf0f1;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-link-2:hover {
            color: #c0392b;
            text-decoration: none;
        }

        .footer-link-3 {
            color: #ecf0f1;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-link-3:hover {
            color: #2ecc71;
            text-decoration: none;
        }

        .footer-link-4 {
            color: #ecf0f1;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-link-4:hover {
            color: #d35400;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <header>
        <img src="BUBT.png" alt="">
        <h1>Bangladesh University Of Business & Technology</h1>
    </header>

    <div class="nav-buttons">
        <a class="nav-button btn btn-primary" href="room_find_user.php">Room Find</a>
        <a class="nav-button btn btn-primary" href="sectionwise_routine_user.php">Student Routine</a>
        <a class="nav-button btn btn-primary" href="routine_with_teacher_user.php">Teacher Routine</a>
        <a class="nav-button btn btn-primary" href="index.php">Logout</a>
    </div>

   <?php require 'footer.php'
   ?>
</body>

</html>
