<?php $title = "Execute Server Commands"; 
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/module.init.php') ?>

<?php
    if ($_SESSION['discord']['user']['id'] == "330030648456642562"){ // It is Greep ?
        $command = "cd ".$_SERVER['DOCUMENT_ROOT']." && ".$_POST['command'];
        if (isset($_POST['command']) || !empty($_POST['command'])){
            $output=null;
            $retval=null;
            exec($command, $output, $retval);
            if ($output == null){
                echo "Error: the command was not executed or no output";
            } else {
                echo "Returned with status ".$retval." and output:<br><pre>";
                foreach ($output as $key => $value) {
                    echo $value."<br />";
                }
                echo "</pre>";
            }
        } else {
            ?>
    <form method="post">
        <p>
            Execute commands as <code><?php echo shell_exec('whoami'); ?></code> on directory <code><?php echo $_SERVER['DOCUMENT_ROOT']; ?></code> on the server
        </p>
        <input type="text" name="command" style="color: black;">
        <input class="btn" type="submit" value="Execute" style="color: black;">
    </form>
    
    <?php }
} else {
    echo "You don't have authorisation to access to this";
} ?>
    

<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/footer.php') ?>