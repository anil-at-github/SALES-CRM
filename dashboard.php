<?php require_once("BO/header.php"); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard :<span class="badge"><?php echo strtoupper($FULLNAME);?></span></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Home</li>
              <li class="breadcrumb-item active"><a href="#">Dashboard</a></li>
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
        <?php if($se) { ?> 
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="inner">
                <h3><i class="fas fa-calendar"></i> <?php echo getCount('followup_master')?></h3>
                <p>My Follow ups</p>
              </div>
              <div class="icon">
                <i class="fas fa-calendar"></i>
              </div>
              <a href="followups.php" class="small-box-footer bg-danger">Manage <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <?php } ?>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="inner">
                <h3><i class="fas fa-eye"></i> <?php echo getCount('enquiry')?></h3>
                <p>Enquiries  <?php if($ROLE=="ADMIN"){ ?><a href="importEnquiry.php" class="btn btn-xs btn-danger badge float-right" title="Import Enquiry"><i class="fas fa-reply"></i></a><span class="float-right">&nbsp;</span><?php }?><a href="enquiry.php" class="btn btn-xs btn-danger badge float-right" title="New Enquiry"><i class="fas fa-plus"></i></a></p>
              </div>
              <div class="icon">
              </div>
              <a href="enquiries.php?type=live" class="small-box-footer bg-danger">Manage <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        <?php if($ad) { ?> 
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="inner">
                <h3><i class="fas fa-cube"></i> <?php echo getCount('products')?></h3>
                <p>Products </p>
              </div>
              <div class="icon">
                <i class="fas fa-cube"></i>
              </div>
              <a href="showProducts.php" class="small-box-footer bg-danger">Manage <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>  
        <?php } ?> 
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="inner">
                <h3><i class="fas fa-address-book"></i> <?php echo getCount('customers')?></h3>
                <p><?php if($se) echo "My";?> Customers</p>
              </div>
              <div class="icon">
                <i class="fas fa-address-book"></i>
              </div>
              <a href="customers.php" class="small-box-footer bg-danger">Manage <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="inner">
                <h3><i class="fas fa-sticky-note"></i> <?php echo getCount('quatation_mster')?><sup style="font-size: 20px"></sup></h3>
                <p><?php if($se) echo "My";?> Quotations</p>
              </div>
              <div class="icon">
                <i class="fas fa-sticky-note"></i>
              </div>
              <a href="showQuatations.php" class="small-box-footer bg-danger">Manage <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <?php if($ad) { ?> 
            <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="inner">
                <h3><i class="fas fa-edit"></i> <?php echo getCount('quatation_mster:approvals')?><sup style="font-size: 20px"></sup></h3>
                <p>Quotation Approvals</p>
              </div>
              <div class="icon">
                <i class="fas fa-sticky-note"></i>
              </div>
              <a href="showQuatations.php?type=notApproved" class="small-box-footer bg-danger">Manage <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="inner">
                <h3><i class="fas fa-cogs"></i></h3>
                <p>Master</p>
              </div>
              <div class="icon">
                <i class="fas fa-cogs"></i>
              </div>
              <a href="masters.php" class="small-box-footer bg-danger">Manage <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <?php } ?> 
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="inner">
                <h3><i class="fas fa-cog"></i></h3>
                <p>Settings</p>
              </div>
              <div class="icon">
                <i class="fas fa-cog"></i>
              </div>
              <a href="settings.php" class="small-box-footer bg-danger">Manage <i class="fas fa-arrow-circle-right"></i></a>
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