<div class="sidebar">
    <a href="/" class="<?php if($_SERVER['SCRIPT_NAME'] == '/index.php'){echo "active";} ?>"><img src="<?php echo $_SESSION['discord']['guild']['iconURL']; ?>" alt="<?php echo $_SESSION['discord']['guild']['name']; ?>" width="30px" height="30px" style="border-radius: 50%;"> Home</a>
    <a data-toggle="collapse" href="#user-menu">
        <img src="<?php echo $_SESSION['discord']['user']['avatarURL']; ?>" alt="<?php echo $_SESSION['discord']['user']['tag'] ?>" width="30px" height="30px" style="border-radius: 50%;"> <?php echo $_SESSION['discord']['user']['api']['member']['displayName']; ?>
        <span class="caret"></span>
    </a>
    <div class="panel-collapse collapse" id="user-menu">
        <ul class="panel-body">
            <!-- <a href="#">Page 1-1</a> -->
            <!-- <a href="#">Page 1-2</a> -->
            <!-- <hr /> -->
            <a href="/logout.php">Logout</a>
        </ul>
    </div>

    <?php
    foreach ($_SESSION['discord']['user']['roles'] as $key => $value) {
        $id = $value['id'];
        $dir = $_SERVER['DOCUMENT_ROOT']."/modules/".$id;
        if (is_dir($dir)){
            $scandir = scandir($dir);
            if ($scandir != false){ 
                ?>
                    <a class="<?php if(str_starts_with($_SERVER['SCRIPT_NAME'], "/modules/".$id)){echo "active";} ?>" data-toggle="collapse" href="#<?php echo $id; ?>-menu">
                        <?php echo $value['name']; ?>
                        <span class="caret"></span>
                    </a>
                    <div class="panel-collapse collapse <?php if(str_starts_with($_SERVER['SCRIPT_NAME'], "/modules/".$id)){echo "in";} ?>" id="<?php echo $id; ?>-menu">
                        <ul class="panel-body">
                            <?php
                                
                                $scanned_directory = array_diff($scandir, array('..', '.'));
                                
                                foreach ($scanned_directory as $key => $value) {
                                    if (str_ends_with($value, ".php")){
                                        $class = "";
                                        if(str_ends_with($_SERVER['SCRIPT_NAME'],$value)){
                                            $class = "class='active'";
                                        }
                                        echo "<a ".$class." href='/modules/".$id."/".$value."'>".str_replace('.php', '', $value)."</a>";
                                    }
                                }
                            ?>
                        </ul>
                    </div>
                <?php
            }
        }
    }
    ?>
    
</div>

<style>
/* The side navigation menu */
.sidebar {
  margin: 0;
  padding: 0;
  width: 220px;
  background-color: #f1f1f1;
  position: fixed;
  height: 100%;
  text-overflow: ellipsis; 
  overflow: hidden;
  white-space: nowrap;
}

/* Sidebar links */
.sidebar a {
  display: block;
  color: black;
  padding: 16px;
  text-decoration: none;
}

/* Active/current link */
.sidebar a.active {
  background-color: #B683C0;
  color: white;
}

/* Links on mouse-over */
.sidebar a:hover:not(.active) {
  background-color: #555;
  color: white;
}

/* Page content. The value of the margin-left property should match the value of the sidebar's width property */
div.content {
  margin-left: 220px;
  padding: 1px 16px;
  height: 1000px;
}

/* On screens that are less than 700px wide, make the sidebar into a topbar */
@media screen and (max-width: 700px) {
  .sidebar {
    width: 100%;
    height: auto;
    position: relative;
  }
  .sidebar a {float: left;}
  div.content {margin-left: 0;}
}

/* On screens that are less than 400px, display the bar vertically, instead of horizontally */
@media screen and (max-width: 400px) {
  .sidebar a {
    text-align: center;
    float: none;
  }
}
</style>