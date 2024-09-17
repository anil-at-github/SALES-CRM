<?php require_once("BO/header2.php"); ?>
<!-- Content Wrapper. Contains page content -->
<?php
$type="normal";
if(isset($_GET["type"]))
{
  $type=$_GET["type"];
}
$heading="Quotations";
$msg="No Quotations!";
if($type=="notApproved"){
  $heading="Quotations to be Approved";
  $msg="No Quotations to Approve!";
}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <input type="hidden" id="txtHdnType" value="<?php echo $type; ?>">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
      
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Home</li>
              <li class="breadcrumb-item active"><a href="#"><?php echo $heading ?></a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <h3><?php echo $heading ?></h3>
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
  function loadQuatations()
  {
    $.ajax({
        url: "BO/common.php?do=loadQuatations&type="+$("#txtHdnType").val().trim(),
        success: function (enquiries) {
          $("#showTable").html(enquiries);
          $('#tblQuatations').DataTable({
            "language": {
              "emptyTable": "<?php echo $msg;?>"
              },
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "columnDefs": [{ targets: 'no-sort', orderable: false }],
            initComplete: function () {
            this.api().columns('.filter').every( function () {
                var column = this;
                var select = $("<select class='btn btn-xs badge bg-light'><option value=''>*not filtered</option></select>")
                    .appendTo( $(column.header()).append() )
                    .on( 'change', function (e) {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                            
                    } ); 
                column.data().unique().sort().each( function ( d, j ) {
                  if(d!="")
                    select.append( '<option value="'+d+'">'+d+'</option>' );
                } );
            } );
        }
    });
          
  }
});
  }
  $(document).ready(function(){
    loadQuatations();
});

menuActive("mnuQuat");
</script>