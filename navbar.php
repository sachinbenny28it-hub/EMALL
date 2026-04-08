<?php
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<div class="navbar-wrap">
    <nav class="navbar">
        <a class="brand" href="<?php echo APP_BASE; ?>/index.php">
            <span class="brand-mark">eMall</span>
            <span class="brand-tag">Property Marketplace</span>
        </a>

        <div class="nav-links">
            <a class="<?php echo $currentPage === 'index.php' ? 'active-link' : ''; ?>" href="<?php echo APP_BASE; ?>/index.php">Home</a>
            <a class="<?php echo $currentPage === 'view_property.php' ? 'active-link' : ''; ?>" href="<?php echo APP_BASE; ?>/property/view_property.php">Properties</a>
            <a class="<?php echo $currentPage === 'add_property.php' ? 'active-link' : ''; ?>" href="<?php echo APP_BASE; ?>/property/add_property.php">List Property</a>

            <?php if (isset($_SESSION['user'])): ?>
                <a class="<?php echo $currentPage === 'dashboard.php' ? 'active-link' : ''; ?>" href="<?php echo APP_BASE; ?>/dashboard.php">Dashboard</a>
                <a href="<?php echo APP_BASE; ?>/logout.php">Logout</a>
            <?php else: ?>
                <a class="<?php echo $currentPage === 'login.php' ? 'active-link' : ''; ?>" href="<?php echo APP_BASE; ?>/login.php">Login</a>
                <a class="<?php echo $currentPage === 'signup.php' ? 'active-link' : ''; ?>" href="<?php echo APP_BASE; ?>/signup.php">Sign Up</a>
            <?php endif; ?>
        </div>
    </nav>
</div>
