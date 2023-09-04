<?php
session_start();
include 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <!-- Include Bootstrap CSS --><link href="bootstrap/bootstrap.min.css" rel="stylesheet">
    <!-- Include Bootstrap JS --><script defer src="bootstrap/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title text-center">Inventory Login</h2>

                        <!-- check if there is 'login_error' message, if yes then display -->
                        <?php
                            if (isset($_SESSION['login_error']) && $_SESSION['login_error']) {
                                echo '<div class="alert alert-danger">Invalid username or password</div>';//display the error message
                                unset($_SESSION['login_error']); //then delete the message
                            }
                        ?>

                        <form action="login.php" method="POST">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-success w-100 py-2" name="loginButton">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>


<?php


// user data without db
// $users = [
//     'admin' => ['password' => 'admin', 'role' => 'admin'],
//     'user1' => ['password' => 'user1', 'role' => 'staff'],
//     'user2' => ['password' => 'user2', 'role' => 'staff']
// ];



//Login button was pressed
if(isset($_POST['loginButton'])) {

    //get user input from the form using POST
    $inputUsername = $_POST['username'];
	$inputPassword = $_POST['password'];

    $query = "SELECT * FROM users WHERE username='$inputUsername' AND password='$inputPassword'";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);

    if ($result && mysqli_num_rows($result) == 1) {
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        header("Location: index.php");
    } else {
        $_SESSION['login_error'] = true;
        header("Location: login.php");
    }

    mysqli_free_result($result);
    mysqli_close($conn);

}

?>