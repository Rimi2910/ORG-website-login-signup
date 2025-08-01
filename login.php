<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    $sql = "SELECT password FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();

    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION["username"] = $username;
            // 🔁 Redirect to dashboard (landing page)
            header("Location: dashboard.php");
            exit();
        } else {
            echo "<script>alert('Invalid username or password'); window.location.href='login.html';</script>";
        }
    } else {
        echo "<script>alert('Invalid username or password'); window.location.href='login.html';</script>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request.";
}
?>


