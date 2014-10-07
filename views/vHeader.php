<?php 
require_once 'technics/Gui.php';
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<script type="text/javascript" src="<?php echo $GLOBALS["siteUrl"]?>js/jquery-2.0.3.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS["siteUrl"]?>js/jquery.validate.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS["siteUrl"]?>css/main.css">
<title>TriviaMMC</title>
    <div class="head">
    <?php
    echo "Connecté en tant que ".$_SESSION["joueur1"]->getPrenom();
    ?>
    </div>
</head>
<body>