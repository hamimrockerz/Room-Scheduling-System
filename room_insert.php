<?php
include 'conn.php';

if (isset($_POST['submit'])) {
    $room_no = $_POST['room_no'];
    $building = $_POST['building'];
    $time = $_POST['time'];
    $day = $_POST['day'];
    $course_teacher = $_POST['course_teacher'];
    $intake = $_POST['intake'];
    $sec = $_POST['sec'];
    $department = $_POST['department'];

    $error_message = ''; 
   
    if (!is_numeric($building) || strlen($building) != 1) {
        $error_message = "Building should be a single numeric digit.";
    }

    elseif (!preg_match('/^\d{3}$/', $room_no)) {
        $error_message = "Room number should be numeric and consist of three digits.";
    }

    if (!empty($error_message)) {
        echo "<script>alert('$error_message');</script>";
    } else {
        $check_query = "SELECT COUNT(*) AS count FROM room_details WHERE room_no = ? AND building = ? AND time = ? AND day = ?";
        $check_stmt = $conn->prepare($check_query);
        $check_stmt->bind_param("ssss", $room_no, $building, $time, $day);
        $check_stmt->execute();
        $check_result = $check_stmt->get_result();
        $check_row = $check_result->fetch_assoc();
        $check_count = $check_row['count'];

        if ($check_count == 0) {
            $sql = "INSERT INTO room_details (room_no, building, time, day, course_teacher, intake, sec, department) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);

            $stmt->bind_param("ssssssss", $room_no, $building, $time, $day, $course_teacher, $intake, $sec, $department);

            if ($stmt->execute()) {
                if ($stmt->affected_rows > 0) {
                    echo "<script>alert('Data inserted successfully');</script>";
                } else {
                    echo "<script>alert('No data inserted.');</script>";
                }
            } else {
                echo "<script>alert('Error inserting data: " . $stmt->error . "');</script>";
            }

            $stmt->close();
        } else {
            echo "<script>alert('Room details already exist in the database.');</script>";
        }

        $check_stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Room Scheduling System</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
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

        .navbar-container {
            display: flex;
            justify-content: center;
            background-color: darkcyan; 
        }

        .navbar {
            width: 100%;
            max-width: 1000px; 
            margin-right: -110px;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            transition: color 0.3s ease;
            padding: 10px 20px;
            display: inline-block;
            white-space: nowrap; 
        }

        .navbar a:hover {
            color: lightblue;
            text-decoration: none;
            background-color: rgba(255,255,255,0.1); 
            border-radius: 5px; 
        }

        .container {
    width: 90%;
    max-width: 800px;
    background-color: #fff;
    padding: 20px;
    border-radius: 15px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    margin: 20px auto; 
}



        table {
            width: 100%;
            margin-bottom: 20px;
        }

        table th,
        table td {
            padding: 15px;
            text-align: left;
        }

        input[type="text"],
        input[type="submit"] {
            width: calc(100% - 30px);
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border-radius: 8px;
            border: 1px solid #ced4da;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
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

        select {
    width: 85%;
    padding: 10px;
    border: 1px solid #ced4da;
    border-radius: 5px;
    background-color: #fff;
    font-size: 16px;
    cursor: pointer;
}

select:focus {
    outline: none;
    border-color: #80bdff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

    </style>
</head>

<body>
    <header>
        <img src="BUBT.png" alt="">
        <h1 style="margin: 0; font-size: 24px;">Bangladesh University Of Business & Technology</h1>
    </header>
    <div class="navbar-container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link active" href="admin_dashboard.php">Home <span class="sr-only">(current)</span></a>
                    <a class="nav-item nav-link active" href="room_details_showlist.php">Room Details Showlist <span class="sr-only">(current)</span></a>
                    <a class="nav-item nav-link active" href="room_find.php">Room Find <span class="sr-only">(current)</span></a>
                    <a class="nav-item nav-link active" href="update_delete_room_details.php">Update Room Details <span class="sr-only">(current)</span></a>
                    <a class="nav-item nav-link active" href="sectionwise_routine.php">Student Routine <span class="sr-only">(current)</span></a>
                    <a class="nav-item nav-link active" href="routine_with_teacher.php">Teacher Routine <span class="sr-only">(current)</span></a>
                    <a class="nav-item nav-link active" href="index.php">Logout <span class="sr-only">(current)</span></a>
                </div>
            </div>
        </nav>
    </div>
    <div class="container">
        <h2 class="text-center mb-4">Room Insert Page</h2>
        <form action="" method="post">
            <table>
                <tr>
                <th>Building</th>
<td>
    <select name="building" required>
        <option value="">Select Building</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
    </select>
</td>                  <th>Time</th>
                    <td><input type="text" name="time" required list="timeSuggestions"></td>
                </tr>
                <tr>
                    <th>Room No</th>
                    <td><input type="text" name="room_no" required></td>
                    <th>Day</th>
<td>
    <select name="day" required>
        <option value="" disabled selected>Select a day</option>
        <option value="Monday">Monday</option>
        <option value="Tuesday">Tuesday</option>
        <option value="Wednesday">Wednesday</option>
        <option value="Thursday">Thursday</option>
        <option value="Friday">Friday</option>
        <option value="Saturday">Saturday</option>
        <option value="Sunday">Sunday</option>
    </select>
</td>

                </tr>
                <tr>
                    <th>Intake</th>
                    <td><input type="text" name="intake"></td>
                    <th>Course Teacher</th>
                    <td><input type="text" name="course_teacher" list="teacherSuggestions"></td>
                </tr>
                <tr>
                    <th>Section</th>
                    <td><input type="text" name="sec"></td>
                    <th>Department</th>
                    <td><input type="text" name="department" list="departmentSuggestions"></td>
                </tr>
            </table>
            <input type="submit" name="submit" value="Submit" class="btn btn-primary">
        </form>
    </div>

    <?php
    $time_query = "SELECT DISTINCT time FROM room_details";
    $time_result = $conn->query($time_query);

    $day_query = "SELECT DISTINCT day FROM room_details";
    $day_result = $conn->query($day_query);

    $teacher_query = "SELECT DISTINCT course_teacher FROM room_details";
    $teacher_result = $conn->query($teacher_query);

    $department_query = "SELECT DISTINCT department FROM room_details";
    $department_result = $conn->query($department_query);
    ?>

    <datalist id="timeSuggestions">
        <option value="08:00 AM - 09:15 AM">
        <option value="09:15 AM - 10:30 AM">
        <option value="10:30 AM - 11:45 AM">
        <option value="11:45 AM - 01:00 PM">
        <option value="01:30 PM - 02:45 PM">
        <option value="02:45 PM - 04:00 PM">
        <option value="04:00 PM - 05:15 PM">
        <option value="05:15 PM - 06:30 PM">
    </datalist>

 

    <datalist id="teacherSuggestions">
        <?php while ($row = $teacher_result->fetch_assoc()) : ?>
            <option value="<?= $row['course_teacher'] ?>">
        <?php endwhile; ?>
    </datalist>

    <datalist id="departmentSuggestions">
        <?php while ($row = $department_result->fetch_assoc()) : ?>
            <option value="<?= $row['department'] ?>">
        <?php endwhile; ?>
    </datalist>

    <?php require 'footer.php'
   ?>
</body>

</html>
