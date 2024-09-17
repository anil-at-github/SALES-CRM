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
              <li class="breadcrumb-item active"><a href="#">View Customers</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <h3>Customers <a href="customer.php" class="btn btn-xs btn-danger">New Customer</a></h3>
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
  function loadCustomers()
  {
    $.ajax({
        url: "BO/common.php?do=loadCustomers",
        success: function (enquiries) {
          $("#showTable").html(enquiries);
          $('#tblCustomers').DataTable({
            "language": {
              "emptyTable": "No Customers added!"
              },
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            initComplete: function() {
              this.api().columns(".filter").every(function() {
                var column = this;
                var ddmenu = cbDropdown($(column.header()))
                  .on('change', ':checkbox', function() {
                    var active;
                    var vals = $(':checked', ddmenu).map(function(index, element) {
                      active = true;
                      return $.fn.dataTable.util.escapeRegex($(element).val());
                    }).toArray().join('|');

                    column
                      .search(vals.length > 0 ? '^(' + vals + ')$' : '', true, false)
                      .draw();

                    // Highlight the current item if selected.
                    if (this.checked) {
                      $(this).closest('li').addClass('active');
                    } else {
                      $(this).closest('li').removeClass('active');
                    }

                    // Highlight the current filter if selected.
                    var active2 = ddmenu.parent().is('.active');
                    if (active && !active2) {
                      ddmenu.parent().addClass('active');
                    } else if (!active && active2) {
                      ddmenu.parent().removeClass('active');
                    }
                  });

                column.data().unique().sort().each(function(d, j) {
                  var // wrapped
                    $label = $('<label>'),
                    $text = $('<span>', {
                      text: d
                    }),
                    $cb = $('<input>', {
                      type: 'checkbox',
                      value: d
                    });

                  $text.appendTo($label);
                  $cb.appendTo($label);

                  ddmenu.append($('<li>').append($label));
                });
              });
          }
    });
          
  }
});
  }
  $(document).ready(function(){
    loadCustomers();
});

menuActive("mnuCust");
</script>