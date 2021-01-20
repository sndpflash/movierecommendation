<div class= "col-xs-6">
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-primary">
      <a class="navbar-brand" href="<?php echo URLROOT; ?>">Movie Recommendation</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">

        <?php if(isset($_SESSION['user_id'])){

         echo "<li class='nav-item active'>";
         echo "<a class='nav-link' href='";echo URLROOT;echo"/dashboard'>Home <span class='sr-only'>(current)</span></a></li>";

        }

        ?>
          
          <li class="nav-item active">
            <a class="nav-link" href="<?php echo URLROOT; ?>/movies">Browse Movies <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="#">Top 100 <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="#">Contact <span class="sr-only">(current)</span></a>
          </li>
          
        </ul>
        <ul class="navbar-nav ml-auto">
      <?php if(isset($_SESSION['user_id'])) : ?>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo URLROOT; ?>/users/logout"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
        </li>
      <?php else : ?>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo URLROOT; ?>/users/register">Register</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo URLROOT; ?>/users/login">Login</a>
        </li>
      <?php endif; ?>
      </ul>
        </li>
      </ul>
      </div>
    </nav>

    </div>