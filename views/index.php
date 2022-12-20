<!DOCTYPE html>
<html lang="en">
<?php require_once('includes/header.php'); ?>
<body>
<?php require_once('includes/nav.php'); ?>

<div class="text-white text-center mt-5">
    <h1 class="lato-strong">International Inspiration Center</h1>
    <h4 class="lato-light">Internal Application for the International Inspiration Center Museum</h4>
</div>

<?php
if (isloggedIn()) {
    echo '<p class="text-center text-white">';
    echo 'You are logged in, ';
    echo  $vars["username"] ?? "";
    echo '</p>';
}
?>


<?php require_once('includes/footer.php'); ?>
</body>
</html>