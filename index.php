<!DOCTYPE html>
<html>
<head>
    <title>eMall</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div id="loader"></div>

<?php include 'navbar.php'; ?>

<div class="container">
    <h1>Welcome to eMall 🏠</h1>
</div>

<?php include 'footer.php'; ?>

<script>
window.addEventListener("load", function(){
    let loader = document.getElementById("loader");
    if(loader) loader.style.display = "none";
});
</script>

</body>
</html>