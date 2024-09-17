<?php require_once("BO/header.php"); ?>
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
              <li class="breadcrumb-item active"><a id="lnkPageName" href="#">Import Enquiry</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="">
         
          <div class="card card-secondary">
            <div class="card-header">
              <h2 class="card-title">Import Enquiry</h2><span class="float-right"><a href="enquiries.php" class="btn btn-sm btn-info">View Enquiries</a></span>
            </div>
            <div class="card-body">
              <form role="form" method="post"  id="frmProduct" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-sm-10">
                      <div class="form-group">
                        <label>Import File (.xls/.xlsx) </label>
                        <input type="file" class="form-control" required  id="fileExcel" name="fileExcel" accept="application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" onchange="loadFile(event,'imgMain')">
                      </div>
                    </div>
                    <div class="col-sm-2" >
                        <br><button style="margin-top:8px !important" type="submit" class="btn btn-primary" id="btnSave">Select File</button>
                    </div>
                </div>
              </form>
            </div>
            </div>
            <?php
              if (isset($_FILES['fileExcel'])) {

                require_once 'BO/SimpleXLSX.php';
                $ext = pathinfo($_FILES['fileExcel']['name'], PATHINFO_EXTENSION);
                $filename="tempImport/Import_".date("d_m_Y").".".$ext;
                // deleting all files
                $files = glob('tempImport/*'); // get all file names
                foreach($files as $file){ // iterate files
                if(is_file($file)) {
                  unlink($file); // delete file
                }
                }	
                //
                move_uploaded_file($_FILES['fileExcel']['tmp_name'],$filename);
                if ( $xlsx = SimpleXLSX::parse( $filename ) ) {
                  echo '
                  <div class="card card-secondary" id="divImport">
                  <div class="card-header">
                  <input type="hidden" id="hdnFile" value="'.$filename.'">
                    <h2 class="card-title">Data on "'.$_FILES['fileExcel']['name'].'"</h2><a id="btnImport" class="float-right btn btn-sm btn-danger">Start Import</a><span class="float-right">&nbsp;&nbsp;</span><a href="importEnquiry.php" id="btnImport" class="float-right btn btn-sm btn-warning">Reset</a>
                  </div>
                  <div class="card-body">
                  <table class="table table-stripped table-responsive" cellpadding="3">';
              
                  $dim = $xlsx->dimension();
                  $cols = $dim[0];
              
                  foreach ( $xlsx->rows() as $k => $r ) {
                    	if ($k == 0) continue; // skip first row
                    echo '<tr>';
                    for ( $i = 0; $i < $cols; $i ++ ) {
                      echo '<td>' . ( isset( $r[ $i ] ) ? $r[ $i ] : '&nbsp;' ) . '</td>';
                    }
                    echo '</tr>';
                  }
                  echo '</table>
                  </div>
                  </div>';
                } else {
                  echo SimpleXLSX::parseError();
                }
              }
            ?>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
<?php require_once("BO/footer.php"); ?>

<script>
$("#btnSave").click(function(e) {
     msg="";
     if($('#fileExcel').val()=="")
    {
        swal("", "Please select file","error");  
        return false;
    }

    if(msg == "")
    {
      return true;
    }
});

$("#btnImport").click(function(e) {
    $("#btnImport").attr("disabled","disabled");
    fileName=$("#hdnFile").val().trim();

  $.ajax({
    type:"POST",
    url:"BO/common.php",
    data:{"do":"importEnquiry","fileName":fileName},
    cache:false,
    success:function(response)
    {
      if(response.indexOf("YES")!=-1)
      {
      $("#divImport").html("");
      var rArray=response.split("_");
      swal("",rArray[1]+" Imported  Successfully","success");
      }
      else if(response=="NO")
      {
          swal("","Oops, something went wrong!","error");
      }
      else
      {
        swal("",response,"warning");
      }
    },
    complete:function(){$("#btnImport").removeAttr("disabled");}
  });
     
});
 
menuActive("mnuEnq");
</script>
