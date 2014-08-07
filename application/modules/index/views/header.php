

<div class="navbar navbar-default">
        <div class="container">
           
          <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
            <?php
$userId = $this->session->userdata('u_id');
if(!empty($userId)) { ?>
  <li><a href="<?php echo BASE_URL; ?>dashboard">Dashboard</a></li>
  <li><a href="<?php echo BASE_URL; ?>logout">Logout</a></li>
<?php } else {?>
<li><a href="#login">Login</a></li>
<?php } ?>
             
               
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>