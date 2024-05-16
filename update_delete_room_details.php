<?php
include 'conn.php';

$room_no = $building = '';
$error = '';
$update_success = false;
$room_details = array();

function fetchRoomDetails($conn, $room_no, $building)
{
    $fetch_selected_query = "SELECT * FROM room_details WHERE room_no = ? AND building = ?";
    $fetch_selected_stmt = $conn->prepare($fetch_selected_query);
    $fetch_selected_stmt->bind_param("ss", $room_no, $building);
    $fetch_selected_stmt->execute();
    $result = $fetch_selected_stmt->get_result();

    if ($result->num_rows > 0) {
        $room_details = $result->fetch_all(MYSQLI_ASSOC);
        return $room_details;
    } else {
        return array();
    }
}

function isTeacherAvailable($conn, $course_teacher, $day, $time)
{
    $check_availability_query = "SELECT * FROM room_details WHERE course_teacher = ? AND day = ? AND time = ?";
    $check_availability_stmt = $conn->prepare($check_availability_query);
    $check_availability_stmt->bind_param("sss", $course_teacher, $day, $time);
    $check_availability_stmt->execute();
    $result = $check_availability_stmt->get_result();

    return $result->num_rows == 0; 
}

function updateRoomDetails($conn, $course_teacher, $intake, $sec, $department, $room_id, $day, $time)
{
   
    if (!isTeacherAvailable($conn, $course_teacher, $day, $time)) {
        return false; 
    }

    $update_query = "UPDATE room_details SET course_teacher = ?, intake = ?, sec = ?, department = ? WHERE id = ?";
    $update_stmt = $conn->prepare($update_query);
    $update_stmt->bind_param("ssssi", $course_teacher, $intake, $sec, $department, $room_id);

    if ($update_stmt->execute()) {
        return true; 
    } else {
        return false; 
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submit'])) {
        $room_no = $_POST['room_no'];
        $building = $_POST['building'];
        $room_details = fetchRoomDetails($conn, $room_no, $building);

        if (!$room_details) {
            $error = "No data found for the selected room.";
        }
    }

    if (isset($_POST['update'])) {
        $room_no = $_POST['room_no'];
        $building = $_POST['building'];
        $course_teacher = $_POST['course_teacher'];
        $intake = $_POST['intake'];
        $sec = $_POST['sec'];
        $department = $_POST['department'];
        $day = isset($_POST['day']) ? $_POST['day'] : ''; 
        $time = isset($_POST['time']) ? $_POST['time'] : ''; 

        if (isset($_POST['room_id']) && is_array($_POST['room_id']) && !empty($_POST['room_id'])) {
            foreach ($_POST['room_id'] as $room_id) {
                if (updateRoomDetails($conn, $course_teacher, $intake, $sec, $department, $room_id, $day, $time)) {
                    $update_success = true;
                } else {
                    $error = "Update is Not Possible. Teacher is not available at the specified day and time.";
                    break;
                }
            }
        } else {
            $error = "No room NO provided for updating.";
        }

        $room_details = fetchRoomDetails($conn, $room_no, $building);
    }
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <title>Room Scheduling System</title>

    <style>
           body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa; 
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

        .navbar-container {
            margin-bottom: 20px; 
        }

        .container {
            width: 95%;
            max-width: 1000px;
            background-color: #fff;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: auto;
            flex: 1;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th,
        table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ccc;
        }

        input[type="text"],
        input[type="submit"],
        .table-input {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: white;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .notification {
            padding: 10px;
            margin-bottom: 15px;
            background-color: #4caf50;
            color: white;
            border-radius: 8px;
            text-align: center;
            display: none;
        }

        .error {
            padding: 10px;
            margin-bottom: 15px;
            background-color: #f44336;
            color: white;
            border-radius: 8px;
            text-align: center;
        }

      
        .navbar-container {
            display: flex;
            justify-content: center;
            background-color: darkcyan; 
        }

        .navbar {
            width: 100%;
            max-width: 1000px; 
font-size: 16px; 
margin-right: -150px ;   
    }

        .navbar a {
            color: white;
            text-decoration: none;
            transition: color 0.3s ease;
            padding: 10px 20px;
            display: inline-block;
            white-space: nowrap; 
           font-size: 18px;
        }

        .navbar a:hover {
            color: lightblue;
            text-decoration: none;
            background-color: rgba(255,255,255,0.1); 
            border-radius: 5px; 
        }


        footer {
    width: 97.30%;
    max-width: 100%;
    background-color: #34495e;
    color: white;
    padding: 20px;
    text-align: center;
    flex-shrink: 0;
    margin-top: 15px;
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
    <h1 style="margin: 0; font-size: 24px;">Bangladesh University Of Business & Technology</h1>
</header>

<div class="navbar-container">
    <nav class="navbar navbar-expand-lg navbar-light d-flex justify-content-center">
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-item nav-link active" href="admin_dashboard.php">Home <span class="sr-only">(current)</span></a>
                <a class="nav-item nav-link active" href="room_find.php">Room Find <span class="sr-only">(current)</span></a>
                <a class="nav-item nav-link active" href="room_insert.php">Room Insert <span class="sr-only">(current)</span></a>
                <a class="nav-item nav-link active" href="sectionwise_routine.php">Student Routine <span class="sr-only">(current)</span></a>
                <a class="nav-item nav-link active" href="routine_with_teacher.php">Teacher Routine <span class="sr-only">(current)</span></a>
                <a class="nav-item nav-link active" href="index.php">Logout <span class="sr-only">(current)</span></a>
            </div>
        </div>
    </nav>
</div>
   

    <div class="container">
        <h2 style="text-align: center;">Update Details Page</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="text" name="room_no" id="room_no" placeholder="Enter the room Number" required>
            <input type="text" name="building" id="building" placeholder="Enter the Building Number" required>
            <input type="submit" name="submit" value="Submit">
        </form>

        <?php if (!empty($room_details)) : ?>
            <table>
                <tr>
                    <th>Time</th>
                    <th>Day</th>
                    <th>Course Teacher</th>
                    <th>Intake</th>
                    <th>Section</th>
                    <th>Department</th>
                    <th>Action</th>
                </tr>
                <?php foreach ($room_details as $room) : ?>
                    <tr>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <td><?php echo $room['time']; ?></td>
                            <td><?php echo $room['day']; ?></td>
                            <td><input type="text" class="table-input" name="course_teacher" value="<?php echo $room['course_teacher']; ?>"></td>
                            <td><input type="text" class="table-input" name="intake" value="<?php echo $room['intake']; ?>"></td>
                            <td><input type="text" class="table-input" name="sec" value="<?php echo $room['sec']; ?>"></td>
                            <td><input type="text" class="table-input" name="department" value="<?php echo $room['department']; ?>"></td>
                            <input type="hidden" name="room_no" value="<?php echo $room['room_no']; ?>">
                            <input type="hidden" name="building" value="<?php echo $room['building']; ?>">
                            <input type="hidden" name="room_id[]" value="<?php echo $room['id']; ?>">
                            <input type="hidden" name="day" value="<?php echo $room['day']; ?>">
                            <input type="hidden" name="time" value="<?php echo $room['time']; ?>">
                            <td><input type="submit" name="update" value="Update"></td>
                        </form>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>

        <div class="notification" id="notification"><?php if ($update_success) echo "Update successful!"; ?></div>

        <?php if ($error) : ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
    </div>



    <?php require 'footer.php'
   ?>

    <script>
        <?php if ($update_success) : ?>
            document.getElementById('notification').style.display = 'block';
            setTimeout(function() {
                document.getElementById('notification').style.display = 'none';
            }, 3000); 
        <?php endif; ?>
    </script>
</body>
</html>