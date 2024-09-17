<?php require_once("BO/header.php"); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">My Follow-ups</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Home</li>
              <li class="breadcrumb-item">Dashboard</li>
              <li class="breadcrumb-item active"><a href="#">My Follow-ups</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-success">
              <span class="info-box-icon"><i class="far fa-bookmark"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Todays Follow-ups</span>
                <span class="info-box-number"><?php echo getCountFF(1); ?></span>

                <!--<div class="progress">
                  <div class="progress-bar" style="width: 70%"></div>
                </div>-->
                <span class="progress-description">
                  
                </span>
                <a href="followupList.php?type=1" class="btn btn-xs bg-success">Manage <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-info">
              <span class="info-box-icon"><i class="far fa-bookmark"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Upcoming Follow-ups</span>
                <span class="info-box-number"><?php echo getCountFF(2); ?></span>
                <a href="followupList.php?type=2" class="btn btn-xs bg-info">Manage <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
          </div>

          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-danger">
              <span class="info-box-icon"><i class="far fa-bookmark"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Missed Follow-ups</span>
                <span class="info-box-number"><?php echo getCountFF(3); ?></span>
                <a href="followupList.php?type=3" class="btn btn-xs bg-danger">Manage <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php require_once("BO/footer.php"); ?>

  <script>
    menuActive("mnuFUP");
  </script>

  <?php
  function getCountFF($type)
  {
    require("BO/mysqli.php");
    $userid=$_SESSION["userid"];
    if($type==1)
      $sql="SELECT count(*) FROM followup_master WHERE userid=$userid and DATE(nextFUP)=DATE(NOW()) and `status`=0";
    else if($type==2)  
      $sql="SELECT count(*) FROM followup_master WHERE userid=$userid and DATE(nextFUP)>DATE(NOW()) and `status`=0";
    else
      $sql="SELECT count(*) FROM followup_master WHERE userid=$userid and DATE(nextFUP)<DATE(NOW()) and status=0"; 
    $countData=mysqli_query($con,$sql);
    if($count=mysqli_fetch_array($countData))
    {
      echo $count[0];
    }

  }
  ?>