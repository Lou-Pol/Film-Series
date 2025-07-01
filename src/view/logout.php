<?php
session_start();
session_destroy();
header("Location: router.php?page=home");
exit();
// plus du tout utilisée car gérée directement dans router.php