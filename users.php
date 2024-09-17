<?php require_once("BO/header2.php"); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
      
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Home</li>
              <li class="breadcrumb-item active"><a href="#">View Users</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <h3>Users <a href="user.php" class="btn btn-xs btn-danger">Add User</a></h3>
        <div id="showTable">
        <img src="dist/img/loading.gif" class="loadingCenter" >
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php require_once("BO/footer2.php"); ?>
<script>
  function loadUsers()
  {
    $.ajax({
        url: "BO/common.php?do=loadUsers",
        success: function (enquiries) {
          $("#showTable").html(enquiries);
          $('#tblUsers').DataTable({
            "language": {
              "emptyTable": "No Users added!"
              },
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
    });
          
  }
});
  }
  $(document).ready(function(){
    loadUsers();
});
menuActive("mnuSettings");
menuActive("mnuUsers");
</script>