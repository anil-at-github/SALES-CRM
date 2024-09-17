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
              <li class="breadcrumb-item active"><a href="#">View Products</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <h3>Products <a href="products.php" class="btn btn-xs btn-danger">Add Product</a></h3>
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
  function loadEnquiries()
  {
    $.ajax({
        url: "BO/common.php?do=loadProducts",
        success: function (enquiries) {
          $("#showTable").html(enquiries);
          $('#tblProducts').DataTable({
            "language": {
              "emptyTable": "No Products found!"
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
                var select = $("<select style='width:100px !important' class='btn btn-xs badge bg-light'><option value=''>*not filtered</option></select>")
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
                  
                  if(d!=""){
                    if(d.indexOf("Update Product")>-1)
                    {
                     
                      start=d.indexOf('t">');
                      end=d.indexOf("</a>");
                      val=d.substring(start+3,end);
                      if($("option[value='"+val+"']").length == 0)
                      select.append( "<option value='"+val+"'>"+val+"</option>" );
                    }
                    else
                    select.append( '<option value="'+d+'">'+d+'</option>' );
                }
                } );
            } );
        }
    });
          
  }
});
  }
  $(document).ready(function(){
    loadEnquiries();
});
menuActive("mnuMaster");
menuActive("mnuProd");
</script>