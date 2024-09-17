<?php require_once("BO/header.php"); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Settings</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Home</li>
              <li class="breadcrumb-item">Dashboard</li>
              <li class="breadcrumb-item active"><a href="#">Settings</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <?php if($ad){?>
          <div class="col-lg-2 col-5">
            <!-- small box -->
            <div class="small-box bg-gray-dark">
              <div class="inner">
                <h3><i class="fas fa-users"></i> <?php echo getCount('users')?></h3>
                <p>Users</p>
              </div>
              <div class="icon">
                <i class="fas fa-users"></i>
              </div>
              <a href="users.php" class="small-box-footer bg-danger">Manage <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <?php } ?>
          <div class="col-lg-2 col-5">
            <!-- small box -->
            <div class="small-box bg-gray-dark">
              <div class="inner">
                <h3><i class="fas fa-user"></i></h3>
                <p>My Profile</p>
              </div>
              <div class="icon">
                <i class="fas fa-user"></i>
              </div>
              <a href="profile.php" class="small-box-footer bg-danger">Manage <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
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
    menuActive("mnuDBoard");
  </script>