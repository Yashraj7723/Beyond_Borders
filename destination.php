<?php
// destination.php
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id > 0) {
    header("Location: index.php?id={$id}");
    exit;
}
header("Location: index.php");
exit;
