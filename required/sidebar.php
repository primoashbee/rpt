    <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
              
              	  <p class="centered"><a href="index.php">
                    <img src="<?=$_SESSION['user']['img_url']."?".rand(0,00)?>" class="img img-circle" width="100px" height="100px" style="max-width:250px;max-height: 250px"></a></p>
              	  <h5 class="centered"><?= getLoggedInName() ?></h5>
              	  
                  <li class="mt" style="margin-top:-10px">
                      <a class="<?=activetabs('index',$_SERVER['PHP_SELF'])?>" href="index.php">
                          <i class="fa fa-dashboard"></i>
                          <span>Homepage</span>
                      </a>
                  </li>

                  <li class="sub-menu">
                      <a href="#" class="<?=activetabs('accounts',$_SERVER['PHP_SELF'])?>">
                          <i class="fa fa-users"></i>
                          <span>TAXPAYER ACCOUNTS</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="accounts.php">View Acounts</a></li>
                          <li><a  href="create_accounts.php">Create Accounts</a></li>
                      </ul>
                  </li>

                  <li class="sub-menu">
                      <a href="javascript:;" class="<?=activetabs('properties',$_SERVER['PHP_SELF'])?>" >
                          <i class="fa fa-book"></i>
                          <span>PROPERTIES</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="properties.php">VIEW PROPERTIES</a></li>
                          <li><a  href="create_properties.php">CREATE PROPERTIES</a></li>
                          <li><a  href="paid_properies.php">PAID AMILYAR</a></li>
                          <!--<li><a  href="pay_properties.php">AMILYAR PAYMENT</a></li>!-->
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" class="<?=activetabs('update_account',$_SERVER['PHP_SELF'])?>" >
                          <i class="fa fa-cogs"></i>
                          <span>SETTINGS</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="update_account.php">UPDATE ACCOUNT</a></li>
                          <li><a  href="logout.php">LOGOUT</a></li>
                      </ul>
                  </li>
               

              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>