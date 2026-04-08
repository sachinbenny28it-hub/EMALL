<?php
include 'session_bootstrap.php';
include 'db.php';

$message = '';
$messageClass = '';

if (isset($_POST['signup'])) {
    $user = trim($_POST['username']);
    $email = trim($_POST['email']);
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $checkStmt = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
    $checkStmt->bind_param("ss", $user, $email);
    $checkStmt->execute();
    $exists = $checkStmt->get_result();

    if ($exists->num_rows > 0) {
        $message = "Username or email already exists.";
        $messageClass = "alert-error";
    } else {
        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $user, $email, $pass);

        if ($stmt->execute()) {
            $message = "Account created successfully. You can log in now.";
            $messageClass = "alert-success";
        } else {
            $message = "Something went wrong while creating the account.";
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
    <title>Sign Up | eMall</title>
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
        <span class="eyebrow">Create your account</span>
        <h2>Start listing and managing properties with a better-looking portal.</h2>
        <p>Sign up once to access the dashboard, publish homes, and present your assignment like a more complete product.</p>
        <ul class="list-clean">
            <li>Fast account creation with secure password hashing.</li>
            <li>Cleaner marketplace flow from registration to purchase.</li>
            <li>Reusable styling across all pages for consistency.</li>
        </ul>
    </div>

    <div class="auth-box">
        <h1>Create account</h1>
        <p class="muted-copy">Join eMall and start building your property portfolio.</p>

        <form method="POST">
            <div>
                <label for="username">Username</label>
                <input id="username" type="text" name="username" placeholder="Choose a username" required>
            </div>

            <div>
                <label for="email">Email</label>
                <input id="email" type="email" name="email" placeholder="Enter your email" required>
            </div>

            <div>
                <label for="password">Password</label>
                <input id="password" type="password" name="password" placeholder="Create a password" required>
            </div>

            <button type="submit" name="signup">Sign Up</button>
        </form>
    </div>
</section>

<?php include 'footer.php'; ?>
