<?php  
if(isset($user_id)) { ?>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarColor02">
  <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
          <a class="btn btn-secondary" href="function/logout.php">登出</a>
      </li>
  </ul>
  </div>
<? } else { ?>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarColor02">
      <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
              <a class="btn btn-secondary" href="index.html">登入</a>
          </li>
      </ul>
  </div>
<? } ?>