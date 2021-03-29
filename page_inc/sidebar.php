<div class="sidebar">
    <a href="/" class="<?php if($_SERVER['SCRIPT_NAME'] == '/index.php'){echo "active";} ?>"><img src="<?php echo $_SESSION['discord']['guild']['iconURL']; ?>" alt="<?php echo $_SESSION['discord']['guild']['name']; ?>" width="30px" height="30px" style="border-radius: 50%;"> Home</a>
    <a data-toggle="collapse" href="#user-menu">
        <img src="<?php echo $_SESSION['discord']['user']['avatarURL']; ?>" alt="<?php echo $_SESSION['discord']['user']['tag'] ?>" width="30px" height="30px" style="border-radius: 50%;"> <?php echo $_SESSION['discord']['user']['api']['member']['displayName']; ?>
        <span class="caret"></span>
    </a>
    <div class="panel-collapse collapse" id="user-menu">
        <ul class="panel-body">
            <a href="#">Page 1-1</a>
            <a href="#">Page 1-2</a>
            <hr />
            <a href="/logout.php">Logout</a>
        </ul>
    </div>
    <!-- <a href="#home"><?php echo $website['name']?></a>

    <a href="#news">News</a>
    <a href="#contact">Contact</a>
    <a href="#about">About</a> -->
    
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