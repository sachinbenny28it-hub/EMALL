<?php
include 'session_bootstrap.php';
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | eMall</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="site-shell">
<?php include 'navbar.php'; ?>

<section class="dashboard-shell">
    <div class="dashboard-intro">
        <div>
            <h1>Welcome, <?php echo htmlspecialchars($_SESSION['user']); ?></h1>
            <p>Your account is active and ready to manage listings, explore properties, and maintain a polished workflow.</p>
        </div>
        <a href="property/add_property.php" class="btn btn-primary">Add New Property</a>
    </div>

    <div class="stat-grid">
        <div class="stat-card">
            <h3>Marketplace Access</h3>
            <p class="muted-copy">View all available properties and review current listing status.</p>
        </div>
        <div class="stat-card">
            <h3>Seller Control</h3>
            <p class="muted-copy">Add new property details and upload listing images from one place.</p>
        </div>
        <div class="stat-card">
            <h3>Account Security</h3>
            <p class="muted-copy">Your session is protected, and logout is available whenever you need it.</p>
        </div>
    </div>

    <div class="dashboard-grid" style="margin-top: 20px;">
        <div class="dashboard-card">
            <h3>Quick Actions</h3>
            <ul class="list-clean">
                <li><a href="<?php echo APP_BASE; ?>/property/view_property.php">Explore current property inventory</a></li>
                <li><a href="<?php echo APP_BASE; ?>/property/add_property.php">Publish a new listing for sale</a></li>
                <li><a href="<?php echo APP_BASE; ?>/logout.php">Log out of your eMall account</a></li>
            </ul>
        </div>

        <div class="dashboard-card">
            <h3>Project Summary</h3>
            <p class="muted-copy">
                This dashboard now gives your assignment a more complete, product-style feel instead of only showing a simple login confirmation.
            </p>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>
