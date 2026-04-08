<?php
include 'session_bootstrap.php';
include 'db.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

function dashboard_count(mysqli $conn, string $query): int
{
    $result = $conn->query($query);
    if (!$result) {
        return 0;
    }

    $row = $result->fetch_row();
    return isset($row[0]) ? (int) $row[0] : 0;
}

$listingCount = $dbAvailable ? dashboard_count($conn, "SELECT COUNT(*) FROM property") : 0;
$availableCount = $dbAvailable ? dashboard_count($conn, "SELECT COUNT(*) FROM property WHERE LOWER(status) = 'available'") : 0;
$soldCount = $dbAvailable ? dashboard_count($conn, "SELECT COUNT(*) FROM property WHERE LOWER(status) = 'sold'") : 0;
$recentListings = $dbAvailable ? $conn->query("SELECT location, price, status FROM property ORDER BY property_id DESC LIMIT 3") : false;
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

<?php if (!$dbAvailable): ?>
    <div class="alert alert-error"><?php echo htmlspecialchars($dbError); ?></div>
<?php endif; ?>

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
            <span class="stat-label">Marketplace</span>
            <h3><?php echo $listingCount; ?> Listings</h3>
            <p class="muted-copy">Total properties currently visible across the platform.</p>
        </div>
        <div class="stat-card">
            <span class="stat-label">Available now</span>
            <h3><?php echo $availableCount; ?> Open</h3>
            <p class="muted-copy">Homes still open for buyers to explore and purchase.</p>
        </div>
        <div class="stat-card">
            <span class="stat-label">Closed deals</span>
            <h3><?php echo $soldCount; ?> Sold</h3>
            <p class="muted-copy">Listings that have already moved out of the active market.</p>
        </div>
    </div>

    <div class="dashboard-grid dashboard-grid-gap">
        <div class="dashboard-card">
            <h3>Quick Actions</h3>
            <ul class="list-clean">
                <li><a href="<?php echo APP_BASE; ?>/property/view_property.php">Explore current property inventory</a></li>
                <li><a href="<?php echo APP_BASE; ?>/property/add_property.php">Publish a new listing for sale</a></li>
                <li><a href="<?php echo APP_BASE; ?>/logout.php">Log out of your eMall account</a></li>
            </ul>
        </div>

        <div class="dashboard-card">
            <h3>Recent Listing Pulse</h3>
            <?php if ($recentListings && $recentListings->num_rows > 0): ?>
                <ul class="list-clean">
                    <?php while ($row = $recentListings->fetch_assoc()): ?>
                        <li>
                            <strong><?php echo htmlspecialchars($row['location']); ?></strong><br>
                            <span class="muted-copy">Rs. <?php echo number_format((float) $row['price']); ?> • <?php echo htmlspecialchars($row['status']); ?></span>
                        </li>
                    <?php endwhile; ?>
                </ul>
            <?php else: ?>
                <p class="muted-copy">No listings have been added yet. Use the quick action panel to publish the first one.</p>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>
</div>
</body>
</html>
