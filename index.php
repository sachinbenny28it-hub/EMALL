<?php
include 'session_bootstrap.php';
include 'db.php';

function emall_count(mysqli $conn, string $query): int
{
    $result = $conn->query($query);
    if (!$result) {
        return 0;
    }

    $row = $result->fetch_row();
    return isset($row[0]) ? (int) $row[0] : 0;
}

$listingCount = $dbAvailable ? emall_count($conn, "SELECT COUNT(*) FROM property") : 0;
$availableCount = $dbAvailable ? emall_count($conn, "SELECT COUNT(*) FROM property WHERE LOWER(status) = 'available'") : 0;
$memberCount = $dbAvailable ? emall_count($conn, "SELECT COUNT(*) FROM users") : 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eMall</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="site-shell">
<?php include 'navbar.php'; ?>

<?php if (!$dbAvailable): ?>
    <div class="alert alert-error"><?php echo htmlspecialchars($dbError); ?></div>
<?php endif; ?>

<section class="hero hero-premium">
    <div class="hero-copy">
        <span class="eyebrow">Signature property marketplace</span>
        <h1>Present every listing like it belongs in a premium real-estate showroom.</h1>
        <p>
            eMall now leads with a stronger front door: live marketplace counts, a more editorial landing
            layout, and clearer paths into browsing, listing, and account management.
        </p>

        <div class="hero-actions">
            <a class="btn btn-primary" href="<?php echo APP_BASE; ?>/property/view_property.php">Explore Properties</a>
            <?php if (isset($_SESSION['user'])): ?>
                <a class="btn btn-secondary" href="<?php echo APP_BASE; ?>/dashboard.php">Open Dashboard</a>
            <?php else: ?>
                <a class="btn btn-secondary" href="<?php echo APP_BASE; ?>/signup.php">Create Account</a>
            <?php endif; ?>
        </div>

        <div class="hero-metrics">
            <div class="metric">
                <strong><?php echo $listingCount; ?></strong>
                <span>Total listings in the marketplace</span>
            </div>
            <div class="metric">
                <strong><?php echo $availableCount; ?></strong>
                <span>Homes currently marked available</span>
            </div>
            <div class="metric">
                <strong><?php echo $memberCount; ?></strong>
                <span>Registered members using eMall</span>
            </div>
        </div>
    </div>

    <div class="hero-panel hero-showcase">
        <div class="hero-image"></div>
        <div class="hero-note">
            <small>Featured experience</small>
            <h3>From class project to product-style presentation</h3>
            <p>
                The visual system now matches the stronger pages inside the app, so the first impression no
                longer feels flat or unfinished.
            </p>
        </div>
        <div class="showcase-strip">
            <div>
                <span>Curated</span>
                <strong>Gallery-led property cards</strong>
            </div>
            <div>
                <span>Connected</span>
                <strong>Smooth buyer and seller flow</strong>
            </div>
        </div>
    </div>
</section>

<section class="section section-tight">
    <div class="section-heading">
        <div>
            <h2>What the platform does better now</h2>
            <p class="muted-copy">The landing page, listings, and dashboard now feel like parts of the same polished product.</p>
        </div>
    </div>

    <div class="feature-grid">
        <article class="glass-card">
            <h3>Marketplace browsing</h3>
            <p class="muted-copy">View live properties with cleaner cards, stronger status labels, and safer image rendering.</p>
        </article>
        <article class="glass-card">
            <h3>Seller publishing</h3>
            <p class="muted-copy">Authenticated users can add new homes and keep the catalog fresh without losing the premium styling.</p>
        </article>
        <article class="glass-card">
            <h3>Account workflow</h3>
            <p class="muted-copy">Login, signup, dashboard, and navigation now sit inside a more consistent, finished visual system.</p>
        </article>
    </div>
</section>

<section class="section">
    <div class="spotlight-band">
        <div class="spotlight-copy">
            <span class="eyebrow">Why it feels advanced</span>
            <h2>A stronger homepage, resilient cards, and more complete page structure throughout.</h2>
        </div>
        <div class="spotlight-points">
            <div class="spotlight-item">Shared layout pieces now feel deliberate instead of placeholder-level.</div>
            <div class="spotlight-item">Missing property photos fall back gracefully instead of breaking the card.</div>
            <div class="spotlight-item">Core screens close properly and render as a cohesive app.</div>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>
</div>
</body>
</html>
