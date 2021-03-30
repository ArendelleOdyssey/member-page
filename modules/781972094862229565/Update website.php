<?php $title = "Updating Website"; 
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/module.init.php') ?>

<?php
    if (isset($_GET['update']) || !empty($_GET['update'])){
        $output = shell_exec('cd '.$_SERVER['DOCUMENT_ROOT'].' && git checkout . && git pull');
        echo "<pre>$output</pre>";
    } else {
        ?>
<form method="get">
    <p>
        Click on the button to execute <code>git checkout .</code> and <code>git pull</code> on the server to update the website
    </p>
    <input type="hidden" name="update" value="yes">
    <input type="submit" value="Update now!" style="color: black;">
</form>

<?php } ?>

<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/footer.php') ?>