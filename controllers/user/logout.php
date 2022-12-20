<?php
$controller = new \classes\server\Controller();
$controller->get(function() {
    unset($_SESSION['admin']);
    redirect("/");
});