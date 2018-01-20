
                    <?php
                      if(isset($_SESSION['msg'])){
                        
                        ?>
                          <div class="alert alert-success fade in alert-dismissable" style="margin-top:18px;">
                              <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                              <h3><strong>Success!</strong> <?=$_SESSION['msg'];?></h3>
                          </div>
                        <?php
                        unset($_SESSION['msg']);
                      }
                    ?>  