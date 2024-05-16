<?php
include 'conn.php';

$uname = $pass = $confirm_pass = $is_admin = "";
$uname_err = $pass_err = $confirm_pass_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty(trim($_POST["uname"]))) {
        $uname_err = "Please enter a username.";
    } else {
        $uname = trim($_POST["uname"]);
    }

    if (empty(trim($_POST["pass"]))) {
        $pass_err = "Please enter a password.";
    } elseif (strlen(trim($_POST["pass"])) < 6) {
        $pass_err = "Password must have at least 6 characters.";
    } else {
        $pass = trim($_POST["pass"]);
    }

    if (empty(trim($_POST["confirm_pass"]))) {
        $confirm_pass_err = "Please confirm password.";
    } else {
        $confirm_pass = trim($_POST["confirm_pass"]);
        if ($pass != $confirm_pass) {
            $confirm_pass_err = "Password did not match.";
        }
    }

    $is_admin = isset($_POST["is_admin"]) ? 1 : 0;

    if (empty($uname_err) && empty($pass_err) && empty($confirm_pass_err)) {
      
        $sql1 = "SELECT id FROM admin WHERE username = ?";
        $sql2 = "SELECT id FROM users WHERE uname = ?";
        $sql = $is_admin ? $sql1 : $sql2;

        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("s", $uname);
            if ($stmt->execute()) {
                $stmt->store_result();
                if ($stmt->num_rows > 0) {
                    $uname_err = "This username is already taken.";
                } else {
                  
                    $hashed_password = password_hash($pass, PASSWORD_DEFAULT); 

                    $sql = $is_admin ? "INSERT INTO admin (username, password) VALUES (?, ?)" : "INSERT INTO users (uname, pass) VALUES (?, ?)";
                    if ($stmt = $conn->prepare($sql)) {
                        $stmt->bind_param("ss", $uname, $hashed_password); 
                        if ($stmt->execute()) {
                         
                            header("Location: admin_dashboard.php");
                            exit;
                        } else {
                            echo "Something went wrong. Please try again later.";
                        }
                        $stmt->close();
                    } else {
                        echo "Error: " . $conn->error;
                    }
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
            $stmt->close();
        } else {
            echo "Error: " . $conn->error;
        }
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Scheduling System</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .container {
            width: 50%;
            margin: 100px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease; 
        }

        .container:hover {
            transform: scale(1.05); 
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="password"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .error {
            color: #f44336;
            margin-top: 5px;
            margin-bottom: 15px;
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
    <div class="container">
        <h2>Sign Up</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="uname">Username:</label>
                <input type="text" id="uname" name="uname" class="form-control" placeholder="Enter your username" required>
                <span class="error"><?php echo $uname_err; ?></span>
            </div>
            <div class="form-group">
                <label for="pass">Password:</label>
                <input type="password" id="pass" name="pass" class="form-control" placeholder="Enter your password" required>
                <span class="error"><?php echo $pass_err; ?></span>
            </div>
            <div class="form-group">
                <label for="confirm_pass">Confirm Password:</label>
                <input type="password" id="confirm_pass" name="confirm_pass" class="form-control" placeholder="Confirm your password" required>
                <span class="error"><?php echo $confirm_pass_err; ?></span>
            </div>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="is_admin" name="is_admin">
                <label class="form-check-label" for="is_admin">Create as Admin</label>
            </div>
            <div class="form-group">
                <input type="submit" value="Sign Up" class="btn btn-primary">
            </div>
        </form>
    </div>

    <?php require 'footer.php'
   ?>
</body>

</html>
