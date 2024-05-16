<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <title>Room Scheduling System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0; 
            padding-bottom: 70px; 
            transition: background-color 0.5s ease; 
            height: 100vh; 
        }

        body:hover {
            background-color: #e0e0e0;
        }

        .header img {
            width: 80px;
            height: auto;
            border-radius: 50%;
            margin-bottom: 5px;
            
        }

        .header h1 {
            font-weight: bold;
            font-size: 1.5rem;
            margin-top: 0;
            color: #007bff;
        }

        .container {
            max-width: 600px;
            margin: 35px auto;
            padding: 25px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .container:hover {
            transform: scale(1.02);
            transition: all 0.3s ease;
        }

        label {
            font-size: 1.2rem;
            color: #007bff;
            font-weight: bold;
        }
        .text-center {
            margin-top: 15px;
        }
        .text-center:hover {
            margin-top: 15px;
            color: skygreen;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header text-center">
            <img src="BUBT.png" alt="">
            <h1>BUBT</h1>
            <h2>BANGLADESH UNIVERSITY OF BUSINESS AND TECHNOLOGY</h2>
            <h3>Commitment to Academic Excellence</h3>
        </div>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="needs-validation" novalidate>
            <h2 class="text-center">Login</h2>
            <?php
            include 'conn.php';

            $username = $password = "";
            $username_err = $password_err = "";

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (empty(trim($_POST["username"]))) {
                    $username_err = "Please enter username.";
                } else {
                    $username = trim($_POST["username"]);
                }

                if (empty(trim($_POST["password"]))) {
                    $password_err = "Please enter your password.";
                } else {
                    $password = trim($_POST["password"]);
                }

                if (empty($username_err) && empty($password_err)) {
                    $user_sql = "SELECT id, uname, pass FROM users WHERE uname = ?";
                    $admin_sql = "SELECT id, username, password FROM admin WHERE username = ?";

                    $stmt = $conn->prepare($user_sql);
                    $stmt->bind_param("s", $param_username);
                    $param_username = $username;
                    $stmt->execute();
                    $stmt->store_result();

                    if ($stmt->num_rows == 1) {
                        $stmt->bind_result($id, $username, $hashed_password);
                        $stmt->fetch();

                        if (password_verify($password, $hashed_password)) {
                            session_start();

                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;

                            header("location: welcome.php");
                            exit;
                        } else {
                            $password_err = "The password you entered was not valid.";
                        }
                    } else {
                        $stmt = $conn->prepare($admin_sql);
                        $stmt->bind_param("s", $param_username);
                        $param_username = $username;
                        $stmt->execute();
                        $stmt->store_result();

                        if ($stmt->num_rows == 1) {
                            $stmt->bind_result($id, $username, $db_password);
                            $stmt->fetch();

                            if (password_verify($password, $db_password)) {
                                session_start();

                                $_SESSION["loggedin"] = true;
                                $_SESSION["id"] = $id;
                                $_SESSION["username"] = $username;

                                header("location: admin_dashboard.php");
                                exit;
                            } else {
                                $password_err = "The password you entered was not valid.";
                            }
                        } else {
                            $username_err = "No account found with that username.";
                        }
                    }
                }
                $stmt->close();
                $conn->close();
            }
            ?>

            <div class="form-group">
                <label for="username">Username :</label>
                <input type="text" id="username" name="username" class="form-control" placeholder="Please Enter Your Username" autocomplete="off" required>
                <div class="invalid-feedback">
                    <?php echo $username_err; ?>
                </div>
            </div>
            <div class="form-group">
                <label for="password">Password :</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Please Enter Your Password" autocomplete="new-password" required>
                <div class="invalid-feedback">
                    <?php echo $password_err; ?>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
        </form>
        <p class="text-center">Don't have an account? <a href="signup.php">Create an Account</a></p>
    </div>
</body>
</html>
