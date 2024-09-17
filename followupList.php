<?php require_once("BO/header2.php"); ?>
<!-- Content Wrapper. Contains page content -->
<?php
if(isset($_GET["type"]))
{
  $type=$_GET["type"];
  $text="";
  if($type==1)
  {
    $text="My Follow-ups Today ( ".date("d/m/Y")." )";
  }
  else if($type==2)
  {
    $text="My Follow-ups Upcoming";
  }
  else if($type==3)
  {
    $text="My Missed Follow-ups";
  }
}

?>
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
              <li class="breadcrumb-item active"><a href="#">My Follow-ups</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <input type="hidden" id="hdnType" value="<?php echo $type; ?>" ?>
      <div class="container-fluid">
        <h3><?php echo $text;?> <a href='followups.php' class='btn btn-xs btn-danger'>Back</a></h3>
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
  function loadFUPS()
  {
    var type=$("#hdnType").val().trim();
    $.ajax({
        url: "BO/common.php?do=loadFUPS&type="+type,
        success: function (fList) {
          $("#showTable").html(fList);
          $('#tblFUPS').DataTable({
            "language": {
              "emptyTable": "No Follow-ups!"
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
    loadFUPS();
});

menuActive("mnuFUP");
</script>