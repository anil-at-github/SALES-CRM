<?php require_once("BO/header.php"); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Master</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Home</li>
              <li class="breadcrumb-item">Dashboard</li>
              <li class="breadcrumb-item active"><a href="#">Master</a></li>
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
          <div class="col-lg-2 col-5">
            <!-- small box -->
            <div class="small-box bg-gray-dark">
              <div class="inner">
                <h3><i class="fas fa-cubes"></i> <?php echo getCount('product_categories')?></h3>
                <p>Categories</p>
              </div>
              <div class="icon">
                <i class="fas fa-cubes"></i>
              </div>
              <a href="prodcategory.php" class="small-box-footer bg-danger">Manage <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-2 col-5">
            <!-- small box -->
            <div class="small-box bg-gray-dark">
              <div class="inner">
                <h3><i class="fas fa-tags"></i> <?php echo getCount('brands')?></h3>
                <p>Brands</p>
              </div>
              <div class="icon">
                <i class="fas fa-tags"></i>
              </div>
              <a href="brands.php" class="small-box-footer bg-danger">Manage <i class="fas fa-arrow-circle-right"></i></a>
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