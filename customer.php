<?php require_once("BO/header.php"); ?>
<?php 
$ID="";
if(isset($_GET["ID"]))
{
    $ID=$_GET["ID"];
}
$display="style='display:none !important';";
if($ROLE=="ADMIN")
{
  $display="";
}
?>
<style>
.inValid
{
  border-color: red;
}
</style>
<div class="content-wrapper">
    <input type="hidden" id="txtHdnID" value="<?php echo $ID ?>" >
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
        <div class="">
         
          <div class="card card-secondary">
            <div class="card-header">
              <h2 class="card-title">Customer</h2><span class="float-right"><a href="customers.php" class="btn btn-sm btn-info">View Customers</a></span>
            </div>
            <div class="card-body">
              <form role="form" method="post"  id="frmCustomer" enctype="multipart/form-data" style="display:none !important;">
                <div class="row">
                  <input type="hidden" id="hdnRole" value="<?php echo $ROLE;?>">
                  <div class="col-sm-6">
                    <!-- select -->
                    <div class="form-group">
                      <label>Full Name</label>
                      <input type="text" class="form-control gtext" autocomplete="off"  id="txtFName" required autofocus>
                      <select id="ddlBelongsTo" class="form-control input-sm" <?php echo $display;?>></select>
                    </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Address</label>
                        <textarea autocomplete="off"  class="form-control" rows="4"  id="txtAddress" ></textarea>
                      </div>
                      </div>
                    </div>
                <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Phone #1</label>
                    <input type="text" class="form-control" autocomplete="off"  id="txtPhone1" required autofocus>
                  </div>
                  </div>
                  <div class="col-sm-6">
                  <div class="form-group">
                    <label>Phone #2</label>
                    <input type="text" class="form-control" autocomplete="off"  id="txtPhone2"  autofocus>
                  </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>E-mail</label>
                        <input autocomplete="off" type="email" class="form-control"  id="txtEmail">
                      </div>
                      </div>
                      <div class="col-sm-6">
                      <div class="form-group" >
                          <label>Location/Google Map Link</label>&nbsp;&nbsp;<button type="button"  id="btnViewLocation" class="btn btn-xs btn-secondary">View Location</button>
                          <input type="text"  id="txtLocation"  class="form-control" >   
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Web</label>
                        <input autocomplete="off" type="text" class="form-control"  id="txtWeb">
                      </div>
                      </div>
                      <div class="col-sm-4">
                      <div class="form-group" >
                          <label>Photo</label>
                          <input type="file"  id="filePhoto" accept="image/x-png,image/gif,image/jpeg"  class="form-control" onchange="loadFile(event,'imgPhoto')">   
                      </div>
                    </div>
                    <div class="col-sm-2">
                    <div class="float-right">
                      <div class="form-group">
                          <label>&nbsp;</label>
                        <div id="divPrevPhoto"><img src="dist/img/noImage.png" id="imgPhoto" width="75px" height="75px"></div>
                      </div>
                    </div>
                  </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Remarks</label>
                        <textarea autocomplete="off"  class="form-control" rows="4"  id="txtRemarks" ></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12" >
                      <div class="float-right">
                        <button type="submit" class="btn btn-primary" id="btnSave">Save Customer</button>
                      </div>
                      <div class="float-right">&nbsp;&nbsp;</div>
                      <div class="float-right" id="divReset">
                        <button type="button" class="btn btn-warning btn-block" id="btnReset">Reset</button>
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
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
<?php require_once("BO/footer.php"); ?>

<script>
  loadDDL("users","userid,fullname","role!='ADMIN'","Select SE Belongs To","ddlBelongsTo")
  .then(() => {
    load();
  })
  .catch((error) => {
    console.log(error)
  });
  function resetForm()
  {
    $('#frmCustomer').find("input[type=text],input[type=password], textarea").val("");
    $("#divPrevPhoto").html("<img src='dist/img/noImage.png' id='imgPhoto' width='75px' height='75px'>");
    $("#txtFName").focus();
  }


$("#btnReset").click(function() {
    resetForm();
});
$("#btnSave").click(function(e) {
    e.preventDefault();
     msg="";
    if($("#txtFName").val().trim()=="")
    {
        msg ="Full Name\n";
    }
    if($("#ddlBelongsTo").val().trim()=="" && $("#hdnRole").val().trim()=="ADMIN")
    {
        msg ="SE Belongs To\n";
    }
    if($("#txtPhone1").val().trim()=="")
    {
        msg += "Phone #1\n";  
    }
    else 
    {
      var valid=is_mobile_valid($("#txtPhone1").val().trim());
      if(!valid)
        msg += "Invalid Phone #1\n";
    }
    if($("#txtPhone2").val().trim()!="")
    {
      var valid=is_mobile_valid($("#txtPhone2").val().trim());
      if(!valid)
        msg += "Invalid Phone #2\n";
    }
    if(msg == "")
    {
      $("#btnSave").attr("disabled","disabled");  
      theData={
            "do" : "saveCustomer",
            "ID" : $("#txtHdnID").val().trim(),
            "txtFName" : $("#txtFName").val().trim(),
            "ddlBelongsTo" : $("#ddlBelongsTo").val().trim(),
            "txtAddress" : $("#txtAddress").val().trim(),
            "txtPhone1" : $('#txtPhone1').val().trim(),
            "txtPhone2" : $('#txtPhone2').val().trim(),
            "txtEmail" : $('#txtEmail').val().trim(),
            "txtLocation" : $('#txtLocation').val().trim(),
            "txtWeb" : $('#txtWeb').val().trim(),
            "txtRemarks" : $('#txtRemarks').val().trim(),
                
        }
        $.ajax({
                type:"post",
                url: "BO/common.php",
                data: theData,
                cache:false,
                success: function (response) {
                  if(response.indexOf("SAVED")>-1)
                  {
                    var rArray=response.split("_");
                    upload(rArray[1],rArray[2]);
                  }
                  else if(response.indexOf("UPDATED")>-1)
                  {
                    var rArray=response.split("_");
                    upload(rArray[1],null);
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
        var cArray=msg.split("\n");
        ctrl="#txtFName";
        if(cArray[0]=="Full Name")ctrl="#txtFName";
        else if(cArray[0]=="Phone #1")ctrl="#txtPhone1";
        swal("Please enter;",msg,"error").then(function() {
          $(ctrl).focus();
        });
    }
});
function load(){
   var ID=$("#txtHdnID").val().trim();
   if(ID!="" && $.isNumeric(ID))
   {
    setFormData(ID);
    $("#lnkPageName").text("Update Customer");
    $("#btnSave").text("Update Customer");
    $("#divBack").show();
    $("#divReset").hide();
   }
   else
   {
    $("#frmCustomer").fadeIn();
    $("#divBack").hide();
    $("#divReset").show();
    $("#lnkPageName").text("New Customer");
    $("#btnSave").text("Save Customer");
    resetForm();
   } 
}

$("#btnChangePassword").click(function(){
  
});

function upload(ID,count)
{
  var IDchk=$("#txtHdnID").val().trim();
  var file_data = $('#filePhoto').prop('files')[0];   
    var form_data = new FormData();                  
    form_data.append('photo', file_data);    
    form_data.append('ID', ID); 
    form_data.append('do', "uploadCustomer");                             
    $.ajax({
        url: 'BO/upload.php', // point to server-side PHP script 
        dataType: 'text',  // what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,                       
        type: 'post',
        success: function(response){
          if(IDchk=="")
          {
            swal("Customer info. Saved","","success");
            $("#countCust").text(count);
            resetForm();
          }
          else
          {
            swal("Customer info. Updated","","success");
            goBack();
          }
        }
     });
    
}
function setFormData(ID)
{
    $.ajax({
                url: "BO/common.php",
                data: {"do": "loadCustomer" , "ID":ID},
                dataType:"JSON",
                cache:false,
                success: function (customer) {
                    if (customer.length) {
                      var photo=customer[0].photo;
                      if(photo==null)
                      photo="dist/img/noImage.png";
                        $("#txtFName").val(customer[0].name);
                        $("#ddlBelongsTo").val(customer[0].belongsTo);
                        $("#txtAddress").val(customer[0].address);
                        $('#txtPhone1').val(customer[0].phone1);
                        $('#txtPhone2').val(customer[0].phone2);
                        $('#txtEmail').val(customer[0].email);
                        $('#txtLocation').val(customer[0].location);
                        $('#txtWeb').val(customer[0].web);
                        $('#txtRemarks').val(customer[0].remarks);
                        $("#divPrevPhoto").html("<img id='imgPhoto' src='" + photo + "' height='75px' width='75px' alt='Photo Broken'>");
                    }
                },
                complete: function(){$("#frmCustomer").fadeIn();}
            });
}
var loadFile = function(event,which) {
    var output = document.getElementById(which);
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
  };
function goBack()
{
  window.location.href="customers.php";
}

menuActive("mnuCust");
</script>