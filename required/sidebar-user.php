    <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
              
              	  <p class="centered"><a href="index.php"><img src="<?=$_SESSION['user']['img_url']."?".rand(0,00)?>" class="img-circle" width="50%"></a></p>
              	  <h5 class="centered"><?= getLoggedInName() ?></h5>
              	   
                  <li class="sub-menu">
                      <a href="javascript:;" class="<?=activetabs('properties',$_SERVER['PHP_SELF'])?>" >
                          <i class="fa fa-book"></i>
                          <span>MY PROPERTIES</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="properties.php">VIEW PROPERTIES</a></li>
                          <!--<li><a  href="pay_properties.php">AMILYAR PAYMENT</a></li>!-->
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" class="<?=activetabs('payment',$_SERVER['PHP_SELF'])?>" >
                          <i class="fa fa-credit-card"></i>
                          <span>PAYMENT</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="my_payments.php">VIEW PAYMENTS</a></li>
                          <li><a  href="bills_payments.php">BILLS PAYMENT</a></li>
                          <li><a  href="my_payment_receipts.php">RECEIPTS</a></li>
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