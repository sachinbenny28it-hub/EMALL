<?php
include '../session_bootstrap.php';
include '../db.php';

$message = '';
$messageClass = '';

if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit();
}

if (isset($_POST['submit'])) {
    $owner = trim($_POST['owner']);
    $location = trim($_POST['location']);
    $price = (int) $_POST['price'];
    $status = trim($_POST['status']);
    $img = basename($_FILES['image']['name']);
    $targetPath = '../assets/images/' . $img;

    if ($img && move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
        $stmt = $conn->prepare("INSERT INTO property (owner_name, location, price, status, image) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssiss", $owner, $location, $price, $status, $img);

        if ($stmt->execute()) {
            $message = "Property added successfully.";
            $messageClass = "alert-success";
        } else {
            $message = "Property upload succeeded, but the listing could not be saved.";
            $messageClass = "alert-error";
        }
    } else {
        $message = "Please choose a valid image file.";
        $messageClass = "alert-error";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Property | eMall</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="site-shell">
<?php include '../navbar.php'; ?>

<?php if ($message): ?>
    <div class="alert <?php echo $messageClass; ?>"><?php echo htmlspecialchars($message); ?></div>
<?php endif; ?>

<section class="page-shell">
    <div class="page-title">
        <div>
            <h1>Add a new property</h1>
            <p>Publish a polished listing with owner name, location, pricing, status, and a strong cover image.</p>
        </div>
    </div>

    <div class="form-card">
        <form method="POST" enctype="multipart/form-data">
            <div class="form-grid">
                <div>
                    <label for="owner">Owner Name</label>
                    <input id="owner" type="text" name="owner" placeholder="Owner Name" required>
                </div>
                <div>
                    <label for="location">Location</label>
                    <input id="location" type="text" name="location" placeholder="City or area" required>
                </div>
            </div>

            <div class="form-grid">
                <div>
                    <label for="price">Price</label>
                    <input id="price" type="number" name="price" placeholder="Enter price" required>
                </div>
                <div>
                    <label for="status">Status</label>
                    <select id="status" name="status" required>
                        <option value="Available">Available</option>
                        <option value="Reserved">Reserved</option>
                        <option value="Sold">Sold</option>
                    </select>
                </div>
            </div>

            <div>
                <label for="image">Property Image</label>
                <input id="image" type="file" name="image" required>
            </div>

            <button type="submit" name="submit">Add Property</button>
        </form>
    </div>
</section>

<?php include '../footer.php'; ?>
