 <?php
                    include '../db/connection.php';
                    $getcurrent = $dbConn->query("SELECT * FROM settings");
                    $currentrow = $getcurrent->fetch(PDO::FETCH_ASSOC);

                    ?>

 <div class="col-md-4">
                <div class="number">
                  
                 <?php echo number_format($currentrow['rebate_rate'],2); ?>
                </div>
                <div class="text">
                  Rebate
                </div>
              </div>
              <div class="col-md-2">
                <div class="number">
                   <?php echo isset($currentrow['extend_days']) ? $currentrow['extend_days'] : '0'; ?>
                </div>
                <div class="text">
                  Extend Days
                </div>
              </div>
             
              <div class="col-md-2">
                <div class="number">
                   <?php echo $currentrow['penalty_rate'] * 100; ?><small>%</small>
                </div>
                <div class="text">
                  Penalty Rates
                </div>
              </div>
              <div class="col-md-2">
                <div class="number">
                   <?php echo $currentrow['lcp_rate'] * 100; ?><small>%</small>
                </div>
                <div class="text">
                  Less Cash Price
                </div>
              </div>
              <div class="col-md-2">
                <div class="number">
                  <?php echo $currentrow['monthly_rate'] * 100; ?><small>%</small>
                </div>
                <div class="text">
                  Monthly Interest
                </div>
              </div>