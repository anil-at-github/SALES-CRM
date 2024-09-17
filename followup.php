<?php require_once("BO/header.php"); ?>
<?php 
$ID="";
if(isset($_GET["ID"]))
{
    $ID=$_GET["ID"];
}
$doFUP=$_SESSION["doFUP"];
?>
<style>
.inValid
{
  border-color: red;
}
</style>
<div class="content-wrapper">
    <input type="hidden" id="txtHdnID" value="<?php echo $ID ?>" >
    <input type="hidden" id="hdnFID" >
    <input type="hidden" id="hdnEnqID" >
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
      
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Home</li>
              <li class="breadcrumb-item active"><a id="lnkPageName" href="#"></a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
      <?php if($doFUP==1){?>
        <div class="">
        
          <div class="card card-secondary">
            <div class="card-header">
              <h2 class="card-title">Follow-up : <span id='spnCName'></span></h2><span class="float-right"><a  id="lnkEnq" target="_blank" class="btn btn-sm btn-info">View Enquiry Details</a></span>
            </div>
            <div class="card-body">
              <form role="form" method="post"  id="frmFollowUp" style="display:none !important">
                <div class="row">
                  <div class="col-sm-6">
                    <!-- select -->
                    <div class="form-group">
                      <label>Follow-up Note on <?php echo date("d/m/Y");?></label>
                     <textarea id="txtPNotes" rows="5" autofocus class="form-control"></textarea>
                    </div>
                    </div>
                    <div class="col-sm-6">
                    <!-- select -->
                    <div class="form-group">
                      <label>Next Follow-up Date</label>
                      <input type="text" class="form-control bg-light" readonly autocomplete="off"  id="txtNextFUP" >
                    </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-12" >
                      <div class="float-right">
                        <button type="submit" class="btn btn-primary" id="btnSave">Done</button>
                      </div>
                      <div class="float-right">&nbsp;&nbsp;</div>
                      <div class="float-right" id="divBack">
                        <button type="button" onClick="goBack();" class="btn btn-warning btn-block" id="btnBack">Back</button>
                      </div>
                      </div>
                  </div>
              </form>
            </div>
            </div>
        </div>
        <?php } ?>
        <!-- /.row -->
        <div class="card card-secondary">
            <div class="card-header">
              <h2 class="card-title">Follow-up History : <span id='spnCName2'></span></span>
            </div>
            <div class="card-body">
              <div id="showTable">
              <img src="dist/img/loading.gif" class="loadingCenter" >
              </div>
        </div>
      </div>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
<?php require_once("BO/footer.php"); ?>

<script>
  function resetForm()
  {
    $('#frmFollowUp').find("input[type=text],input[type=password], textarea, select").val("");
  }


$("#btnReset").click(function() {
    resetForm();
});
$("#btnSave").click(function(e) {
    e.preventDefault();
     msg="";
    if($("#txtPNotes").val().trim()=="")
    {
        msg ="Personal Notes\n";
    }
    
    if(msg == "")
    {
      $("#btnSave").attr("disabled","disabled");  
      theData={
            "do" : "saveFUP",
            "ID" : $("#txtHdnID").val().trim(),
            "hdnFID":$("#hdnFID").val().trim(),
            "hdnEnqID":$("#hdnEnqID").val().trim(),
            "txtPNotes" : $("#txtPNotes").val().trim(), 
            "txtNextFUP" : $("#txtNextFUP").val().trim()  
        }
        $.ajax({
                type:"post",
                url: "BO/common.php",
                data: theData,
                cache:false,
                success: function (response) {
                  if(response=="OK"){
                      swal("Follow up Done","","success")
                      resetForm();
                      window.location.href="followups.php";
                  }
                },
                complete: function()
                {
                  $("#btnSave").removeAttr("disabled");  
                }
            });
    }
    else
    {
        swal("Please enter;",msg,"error").then(function() {
          $("#txtPNotes").focus();
        });
    }
});
$(document).ready(function(){
  $("#txtNextFUP").datepicker({ 
     dateFormat: 'dd/mm/yy',
     beforeShow: function()  {  
          $('#txtNextFUP').datepicker('option', 'minDate',new Date());   
        }
    });
  resetForm();
   var ID=$("#txtHdnID").val().trim();
   if(ID!="" && $.isNumeric(ID))
   {
    setFormData(ID);
    $("#lnkPageName").text("Follow-up");
    $("#btnSave").text("Done");
    $("#divBack").show();
   }
});


function setFormData(ID)
{
    $.ajax({
                url: "BO/common.php",
                data: {"do": "loadFUP" , "ID":ID},
                dataType:"JSON",
                cache:false,
                success: function (followup) {
                    if (followup.length) {
                        $("#hdnFID").val(followup[0].fupID);
                        $("#hdnEnqID").val(followup[0].enqID);
                        $("#txtPNotes").val(followup[0].notes);
                        $("#spnCName").text(followup[0].name);
                        $("#spnCName2").text(followup[0].name);
                        $("#lnkEnq").attr("href","enquiry.php?ID="+followup[0].enqID);
                        loadFUPHistory();
                    }
                
                },
                complete: function(){$('#frmFollowUp').fadeIn();$("#txtPNotes").focus();}
            });
}
function goBack()
{
  window.location.href="followups.php?type=1";
}

function loadFUPHistory()
  {
    $.ajax({
        url: "BO/common.php?do=loadFUPHistory&ID="+$("#hdnFID").val().trim(),
        cache:false,
        success: function (fupHistory) {
         
          $("#showTable").html(fupHistory); 
    }
  });
  }
  

menuActive("mnuFUP");
</script>