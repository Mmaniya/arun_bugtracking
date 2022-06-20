<?php if($_SESSION['login'])
{
?> 
<section class="menu-section">
        <div class="container">
            <div class="row ">
                <div class="col-md-2">
                <img src="assets/img/logo.jpg" height="70" weight="70" />
                </div>
                <div class="col-md-10">
                    <div class="navbar-collapse collapse ">
                        <ul id="menu-top" class="nav navbar-nav navbar-right">
                            <li><a href="dashboard.php" class="menu-top-active">DASHBOARD</a></li>                                                     
                                <li>
                                <a href="#" class="dropdown-toggle" id="ddlmenuItem" data-toggle="dropdown"> Account <i class="fa fa-angle-down"></i></a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="ddlmenuItem">
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="my-profile.php">My Profile</a></li>
                                     <li role="presentation"><a role="menuitem" tabindex="-1" href="change-password.php">Change Password</a></li>
                                </ul>
                            </li>
                            <!-- <li><a href="dashboard.php" class="menu-top-active">DASHBOARD</a></li>                                                     
                                <li>
                                <a href="#" class="dropdown-toggle" id="ddlmenuItem" data-toggle="dropdown"> Task <i class="fa fa-angle-down"></i></a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="ddlmenuItem">
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="my-profile.php">Task Manager</a></li>
                                     <li role="presentation"><a role="menuitem" tabindex="-1" href="change-password.php">Task History</a></li>
                                </ul>
                            </li> -->
                            <li><a href="task_list.php">Task</a></li> 
                            <?php if($_SESSION['login']) { ?> 
                            <li><a href="logout.php">LogOut</a></li> 
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php } else { ?>
        <section class="menu-section">
        <div class="container">
            <div class="row ">
                <div class="col-md-2">
                <img src="assets/img/logo.jpg" height="70" weight="70" />
                </div>
                <div class="col-md-10">
                    <div class="navbar-collapse collapse ">
                        <ul id="menu-top" class="nav navbar-nav navbar-right">                                                  
                            <li><a href="adminlogin.php">Admin Login</a></li>
                            <li><a href="testerlogin.php">Tester Login</a></li>
                            <li><a href="index.php">User Login</a></li>                        
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <?php } ?>