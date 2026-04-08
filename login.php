<?php
include 'session_bootstrap.php';
include 'db.php';

$message = '';
$messageClass = '';

if (isset($_POST['login'])) {
    if (!$dbAvailable) {
        $message = $dbError;
        $messageClass = "alert-error";
    } else {
        $user = trim($_POST['username']);
        $pass = $_POST['password'];

        $stmt = $conn->prepare("SELECT username, password FROM users WHERE username = ?");
        $stmt->bind_param("s", $user);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            if (password_verify($pass, $row['password'])) {
                $_SESSION['user'] = $row['username'];
                header("Location: dashboard.php");
                exit();
            }

            $message = "Incorrect password. Please try again.";
            $messageClass = "alert-error";
        } else {
            $message = "No account found with that username.";
            $messageClass = "alert-error";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | eMall</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="site-shell">
<?php include 'navbar.php'; ?>

<?php if ($message): ?>
    <div class="alert <?php echo $messageClass; ?>"><?php echo htmlspecialchars($message); ?></div>
<?php endif; ?>

<section class="auth-wrapper">
    <div class="auth-side">
        <span class="eyebrow">Secure access</span>
        <h2>Sign in to manage listings and explore premium spaces.</h2>
        <p>Access your dashboard, review the marketplace, and continue your property workflow without losing momentum.</p>
        <ul class="list-clean">
            <li>Track your account through a focused dashboard.</li>
            <li>Move from browsing to listing properties in one session.</li>
            <li>Use the same clean interface across every page.</li>
        </ul>
    </div>

    <div class="auth-box">
        <h1>Welcome back</h1>
        <p class="muted-copy">Log in to continue your eMall experience.</p>

        <form method="POST">
            <div>
                <label for="username">Username</label>
                <input id="username" type="text" name="username" placeholder="Enter your username" required>
            </div>

            <div>
                <label for="password">Password</label>
                <input id="password" type="password" name="password" placeholder="Enter your password" required>
            </div>

            <button type="submit" name="login">Login</button>
        </form>
    </div>
</section>

<?php include 'footer.php'; ?>
</div>
</body>
</html>
