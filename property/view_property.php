<?php
include '../session_bootstrap.php';
include '../db.php';
$res = $conn->query("SELECT * FROM property ORDER BY property_id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Properties | eMall</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="site-shell">
<?php include '../navbar.php'; ?>

<section class="page-shell">
    <div class="page-title">
        <div>
            <h1>Available properties</h1>
            <p>Browse the current inventory with location, price, seller details, and real-time status.</p>
        </div>
        <a class="btn btn-secondary" href="<?php echo APP_BASE; ?>/property/add_property.php">Add a Listing</a>
    </div>

    <div class="card-container">
        <?php if ($res && $res->num_rows > 0): ?>
            <?php while ($row = $res->fetch_assoc()): ?>
                <?php $isSold = strtolower($row['status']) === 'sold'; ?>
                <article class="property-card">
                    <img src="../assets/images/<?php echo htmlspecialchars($row['image']); ?>" alt="Property image">
                    <div class="card-body">
                        <div class="property-meta">
                            <span>Owner: <?php echo htmlspecialchars($row['owner_name']); ?></span>
                            <span class="status-pill <?php echo $isSold ? 'status-sold' : 'status-open'; ?>">
                                <?php echo htmlspecialchars($row['status']); ?>
                            </span>
                        </div>

                        <h3><?php echo htmlspecialchars($row['location']); ?></h3>
                        <p class="price-tag">Rs. <?php echo number_format((float) $row['price']); ?></p>
                        <p class="muted-copy">Presented with a cleaner layout so the listing feels more like a modern product card.</p>

                        <div class="card-actions">
                            <?php if ($isSold): ?>
                                <span class="btn btn-secondary">Already Sold</span>
                            <?php else: ?>
                                <a href="buy_property.php?id=<?php echo (int) $row['property_id']; ?>" class="btn btn-primary">Buy Now</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </article>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="empty-state">No properties are available yet. Add your first listing to populate the marketplace.</div>
        <?php endif; ?>
    </div>
</section>

<?php include '../footer.php'; ?>
