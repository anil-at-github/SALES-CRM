<?php require_once("BO/header.php"); ?>
<?php 
$ID="";
if(isset($_GET["ID"]))
{
    $ID=$_GET["ID"];
}
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
<link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid.min.css" />
  <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid-theme.min.css" />

<style>
  .hide{
    display: none;
  }
  .bs-container.dropdown.bootstrap-select{width: 250px !important; min-width: 250px !important; }
  .dropdown-menu.show { width: 250px !important; min-width: 250px !important; } 

  .jsgrid-align-left {
    text-align: left !important;
  }
  </style>
<div class="content-wrapper">
    <input type="hidden" id="txtHdnID" value="<?php echo $ID ?>" >
    <input type="hidden" id="hdnRole" value="<?php echo $ROLE ?>" >
    <input type="hidden" id="hdnUID" value="<?php echo $USERID ?>" >
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
        <form role="form" method="post"  id="frmEnquiry" style="display:none">
          <div class="card card-secondary">
            <div class="card-header">
              <h2 class="card-title">Enquiry on</h2> <span class="col-sm-2"><input type="text" readonly class="bg-secondary" style="border:none !important;width:100px;cursor:pointer !important"  id="txtDate" ></span> <span class="float-right"><a id="btnNew" href="enquiry.php" class="btn btn-sm btn-info">New Enquiry</a>&nbsp;&nbsp;<a href="enquiries.php" class="btn btn-sm btn-info">View Enquiries</a></span>
            </div>
            <div class="card-body">
                <div class="row">
                  <div class="col-sm-6">
                    <!-- select -->
                    <div class="form-group">
                      <label>Customer Name</label>&nbsp;&nbsp;<button type="button"  id="btnChoose" class="btn btn-xs btn-secondary">Choose Customer</button>&nbsp;&nbsp;<button type="button" style="display:none"  id="btnViewCust" class="btn btn-xs btn-secondary">View/Edit Customer</button>
                      <input type="hidden" id="hdnCustomerID" value="0">
                      <input type="text" class="form-control gtext" autocomplete="off"  id="txtCName" required autofocus>
                      <select id="ddlCustomer" style="display:none" class="form-control"></select>
                    </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Address</label>
                        <textarea id="txtAddress" rows="4" class="form-control"></textarea>
                      </div>
                      </div>
                    </div>
                    <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Primary Contact #(Whatsapp) </label>
                        <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">+91</span>
                        </div>
                        <input type="search" list="listMobileNos" autocomplete="off" class="form-control" maxlength="10" required  id="txtPContact" >
                        <datalist id="listMobileNos">
                        </datalist>
                        <div class="input-group-append">
                          <span class="input-group-text" id="basic-addon2"><a title="Whatsapp" id="linkWA"><img  width="20px" height="20px" src="dist/img/whatsapp.png"></a></span>
                          <span class="input-group-text" id="basic-addon2"><a title="Call" id="linkDail"><img width="20px" height="20px" src="dist/img/dail.png"></a></span>
                        </div>
                      </div>
                      </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Contact Number #2</label>
                          <input type="text" maxlength="15" class="form-control"  id="txtContact2" >
                        </div>
                        </div>
                      
                  </div>
                  <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>E-mail</label>
                          <input type="text"  class="form-control"  id="txtEmail" >
                        </div>
                        </div>
                        <div class="col-sm-6">
                        <div class="form-group">
                          <label>GST No.</label>
                          <input type="text" maxlength="15" class="form-control"  id="txtGSTNo" >
                        </div>
                        </div>
                  </div>
                <div class="row">
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label>Assigned to</label>
                          <select id="ddlSE" class="form-control">
                            <option value="">Select SE</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-6">
                    <div class="form-group">
                          <label>Status</label>
                          <select class="custom-select" id="ddlStatus">
                            <option value="">Please select a status</option>
                            <option value="new_lead">New Lead</option>
                            <option value="open">Open</option>
                            <option value="cold">Cold</option>
                            <option value="prospect">Prospect</option>
                            <option value="hot">Hot</option>
                            <option value="demo_needed">Demo Needed</option>
                            <option value="demo_completed">Demo Completed</option>
                            <option value="quotation">Quotation</option>
                            <option value="po">PO</option>
                            <option value="delivery">Delivery</option>
                            <option value="payment">Payment</option>
                            <option value="won">WON</option>
                            <option value="closed">Closed</option>
                            <option value="cancel">Cancel</option>
                            <option value="missed">Missed</option>
                            <option value="drop">Drop</option>
                          </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                  <div class="col-sm-12">
                    <div class="progress" id="pgbStatus"></div>
                  </div>
                  </div>
                  <!-- Related Details -->
                  <!-- DEMO NEEDED-->
                  <div class="row" id="rowDemoNeeded">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label>Demo data / Remarks</label>
                        <textarea  class="form-control"  id="txtDemoData" ></textarea>
                      </div>
                      </div>
                     
                  </div>
                    <!-- DEMO NEEDED-->
                    <!-- PO-->
                  <div class="row" id="rowPO">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>PO Number</label>
                        <input type="text"  class="form-control"  id="txtPONum" >
                      </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Date</label>
                          <input type="text" readonly autocomplete="off" class="form-control bg-light"  id="txtPODate" >
                        </div>
                        </div>
                     
                  </div>
                    <!-- PO-->
                     <!-- Delivery-->
                  <div class="row" id="rowDelivery">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Date</label>
                        <input type="text" readonly autocomplete="off"  class="form-control bg-light"  id="txtDeliveryDate" >
                      </div>
                      </div>
                      <!--
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label>Stamping Quarter</label>
                          <select class="custom-select" id="ddlSQuarter">
                            <option value="">Please select stamping quarter</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option> 
                          </select>
                        </div>
                        </div>-->
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label>Stamping Area</label>
                            <select class="form-control" id="txtStampingArea">
                              <option value="">Please select stamping area</option>
                              <option value="TRIVANDRUM- SENIOR">TRIVANDRUM- SENIOR</option>
                              <option value="TRIVANDRUM- CIRCLE II">TRIVANDRUM- CIRCLE II</option>
                              <option value="Neyyattinkara- Circle I">Neyyattinkara- Circle I</option>
                              <option value="Neyyattinkara- Circle II">Neyyattinkara- Circle II</option>
                              <option value="Attingal">Attingal</option> 
                              <option value="Nedumangadu">Nedumangadu</option> 
                              <option value="Varkala">Varkala</option>  
                              <option value="Kattakada">Kattakada</option>   
                            </select>
                          </div>
                          </div>
                     
                  </div>
                    <!-- Delivery-->
                     <!-- Payment-->
                  <div class="row" id="rowPayment">
                    <div class="col-sm-6">
                      <!-- select -->
                      <div class="form-group">
                        <label>Payment Status</label>
                        <select class="custom-select" id="ddlPStatus">
                          <option value="">Please select payment status</option>
                          <option value="nil">Nil</option>
                          <option value="partial">Partial</option>
                          <option value="complete">Complete</option>
                        </select>
                      </div>
                      </div>
                      <div class="col-sm-3" id="colPType">
                        <div class="form-group">
                          <label>Payment Type</label>
                          <select class="custom-select" id="ddlPType">
                            <option value="">Please select payment type</option>
                            <option value="advance">Advance</option>
                            <option value="partial">Cash</option>
                            <option value="complete">CHK Dates</option>
                          </select>
                        </div> 
                      </div>
                        <div class="col-sm-3" id="colPInfo">
                          <div class="form-group">
                            <label>Payment Info.</label>
                            <input type="text"  class="form-control"  id="txtPInfo" >
                          </div> 
                          </div>
                  </div>
                    <!-- PO-->
                  <!-- End of Related Details -->
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- select -->
                      <div class="form-group">
                        <label>Next Follow up Date</label>
                        <input type="text" readonly class="form-control bg-light"  id="txtNextFUP" >
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <!-- select -->
                      <div class="form-group">
                        <label>Shared to <span class="badge">Max. 2 persons</span></label>
                        <select class="form-control" id="ddlShared" multiple data-live-search="true">
                          </select>
                      </div>
                    </div>
                   
                  </div>
                  <div class="row">
                  <div class="col-sm-12">
                      <!-- select -->
                      <div class="form-group">
                        <label>Notes</label>
                        <textarea type="text" class="form-control" rows="4"  id="txtNotes" ></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row"  id="divProductDetails">
                  <div class="col-sm-12">
                    <div class="table-responsive">  
                      <div id="grid_table"></div>
                      </div>  
                    </div>
                </div>
                  <div class="row" style="margin-top:10px">
                    <div class="col-sm-12" >
                    <input type="hidden" id="hdnQID" value="0">
                      <!-- select -->
                      <div class="float-right">
                        <button type="button" style="display:none !important" class="btn btn-danger" id="btnQuotation">Quotation Action</button>
                      </div>
                      <div class="float-right">&nbsp;&nbsp;</div>
                      <div class="float-right">
                        <button type="button"  class="btn btn-success" id="btnExport">Export Bill</button>
                      </div>
                      <div class="float-right">&nbsp;&nbsp;</div>
                      <div class="float-right">
                        <button type="submit" class="btn btn-primary" id="btnSave">Save Enquiry</button>
                      </div>
                      <div class="float-right">&nbsp;&nbsp;</div>
                      <div class="float-right" id="divReset">
                        <button type="button" class="btn btn-warning btn-block" id="btnReset">Reset</button>
                      </div>
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

        <!-- Payment Card -->
        <div class="card card-secondary" id="divPaymentDetails" style="display:none !important">
            <div class="card-header">
            <input type="hidden" id="hdnTotal"><input type="hidden" id="hdnBalance">
              <h2 class="card-title">Payment Details</h2><br>
              <div>
              <h3 id="spnTotal" class="float-left bg-info rounded"></h3></h3><h3 id="spnPaid" class="float-right bg-success rounded"><h3 class="float-right">&nbsp;&nbsp;</h3><h3 id="spnBalance" class="float-right bg-warning rounded"></div>
            </div>
            <div class="card-body">
              <div class="row"  >
                    <div class="col-sm-12">
                      <div class="table-responsive">  
                        <div id="grid_table2"></div>
                        </div>  
                      </div>
                  </div>
            </div>    
        </div>
        <!-- end of Payment Card -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
<?php require_once("BO/footer.php"); ?>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

<script>
var SFD=false;
if($("#hdnRole").val().trim()!="ADMIN")
{
  var whereString;
  if($("#txtHdnID").val().trim()!="")
   whereString="(belongsTo=<?php echo $USERID;?> OR belongsTo = ( select assignedTo FROM enquiry WHERE enqID = ( SELECT enqID FROM enquiry_shares WHERE subUserid=<?php echo $USERID;?> and enqID=<?php echo $ID?>)))";
  else
  whereString="(belongsTo=<?php echo $USERID;?> OR belongsTo = ( select assignedTo FROM enquiry WHERE enqID = ( SELECT enqID FROM enquiry_shares WHERE subUserid=<?php echo $USERID;?> and enqID=0)))";
   loadDDL("users","userid,fullname","role!='ADMIN'","Select Staff","ddlSE")
  .then(() => {
    loadDDL("users","userid,fullname","role!='ADMIN'","","ddlShared")
  
  .then(() => {
    loadDDL("customers","ID,name",whereString,"Select Customer","ddlCustomer")
  .then(() => {
    load();
  })
  .catch((error) => {
    console.log(error)
  })
  })
})
  .catch((error) => {
    console.log(error)
  });

}
else
{
  loadDDL("users","userid,fullname","role!='ADMIN'","Select Staff","ddlSE")
  .then(() => {
    loadDDL("users","userid,fullname","role!='ADMIN' and userid !=<?php echo $USERID;?>","","ddlShared")
  .then(() => {
    loadDDL("customers","ID,name","","Select Customer","ddlCustomer")
  .then(() => {
    load();
  })
  .catch((error) => {
    console.log(error)
  })
  })
})
  .catch((error) => {
    console.log(error)
  });

}
  function resetForm()
  {
    $("#rowDemoNeeded").hide();
    $("#rowPO").hide();
    $("#rowDelivery").hide();
    $("#rowPayment").hide();
    $("#colPType").hide();
    $("#colPInfo").hide();
    $("#btnViewCust").hide();

    if($("#hdnRole").val().trim()!="ADMIN")
    {
      $("#ddlSE").val($("#hdnUID").val().trim());
    }

    var today = new Date();
    var d = String(today.getDate()).padStart(2, '0');
    var m = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var y = today.getFullYear();
    today = d + '/' + m + '/' + y;
    $("#txtDate").val(today);
    $("#hdnCustomerID").val("0");
    $("#txtCName").focus();
  }

$( "#ddlStatus" ).change(function() {
  $("#rowDemoNeeded").hide();
  $("#rowPO").hide();
  $("#rowDelivery").hide();
  $("#rowPayment").hide();
    $("#colPType").hide();
    $("#colPInfo").hide();
  if($(this).val()=="demo_needed")
  {
    $("#rowDemoNeeded").show();
  }
  else if(($(this).val()=="po"))
  {
    $("#rowPO").show();
  }
  else if(($(this).val()=="delivery"))
  {
    $("#rowDelivery").show();
  }
 /* else if(($(this).val()=="payment"))
  {
    $("#rowPayment").show();
  }*/
});

/*$( "#ddlPStatus" ).change(function() {
  $("#colPType").hide();
  $("#colPInfo").hide();
  if($(this).val()=="partial")
  {
    $("#colPType").show();
    $("#colPInfo").show(); 
  }
});*/

$("#btnReset").click(function() {
    $(this).closest('form').find("input[type=text],input[type=hidden],input[type=text], textarea, select").val("");
    resetForm();
});
$("#btnSave").click(function(e) {
    e.preventDefault();
     msg="";
    if($("#txtCName").val().trim()=="" && $("#hdnCustomerID").val().trim()=="0")
    {
        msg ="Name\n";
    }
    if($("#txtPContact").val().trim()=="")
    {
        msg += "Primary Contact Number\n"; 
    }
    else 
    {
      var valid=is_mobile_validWA($("#txtPContact").val().trim());
      if(!valid)
        msg += "Invalid Primary Contact Number\n";
    }
    if($("#txtContact2").val().trim()!="") 
    {
      var valid=is_mobile_valid($("#txtContact2").val().trim());
      if(!valid)
        msg += "Invalid Contact Number 2\n";
    }
    if($("#txtEmail").val().trim()!="") 
    {
      var valid=is_email($("#txtEmail").val().trim());
      if(!valid)
        msg += "Invalid Email\n";
    }
    if($("#ddlStatus").val().trim()=="")
    {
        msg += "Status\n"; 
    }
    if($("#ddlStatus").val().trim()=="delivery" && $("#txtDeliveryDate").val().trim()=="")
    {
        msg += "Delivery Date\n"; 
    }
    if($("#ddlSE").val().trim()=="")
    {
        msg += "Assigned To\n"; 
    }
   
    if(msg == "")
    {
      $("#btnSave").attr("disabled","disabled");  
      theData={
            "do" : "saveEnquiry",
            "ID" : $("#txtHdnID").val().trim(),
            "hdncustomerID":$("#hdnCustomerID").val().trim(),
            "txtCName" : $("#txtCName").val().trim(),
            "txtAddress" : $('#txtAddress').val().trim(),
            "txtPContact" : $('#txtPContact').val().trim(),
            "txtContact2" : $("#txtContact2").val().trim(),
            "txtEmail" : $("#txtEmail").val().trim(),
            "txtGSTNo":$("#txtGSTNo").val().trim(),
            "txtEDate" : $('#txtDate').val().trim(),
            "ddlSE" : $('#ddlSE').val().trim(),
            "ddlStatus" : $('#ddlStatus').val().trim(),
            "txtDemoData" :$('#txtDemoData').val().trim() ,
            "txtPONum" : $('#txtPONum').val().trim() ,
            "txtPODate" : $('#txtPODate').val().trim() ,
            "txtDeliveryDate" : $('#txtDeliveryDate').val().trim() ,
          
            "txtStampingArea" : $('#txtStampingArea').val().trim(),
            "ddlPStatus" :$('#ddlPStatus').val().trim(),
            "ddlPType" :$('#ddlPType').val().trim(),
            "txtPInfo" :$('#txtPInfo').val().trim(),
            "txtNextFUP":$('#txtNextFUP').val().trim(),
            "ddlShared" : $("#ddlShared").val(),
            "txtNotes" :$('#txtNotes').val().trim()
        };
        $.ajax({
                type:"post",
                url: "BO/common.php",
                data: theData,
                cache:false,
                success: function (response) {
                  if(response.indexOf("SAVED")>-1)
                  {
                    var customerID=$("#hdnCustomerID").val().trim();
                    rArray=response.split("_");
                    $("#txtHdnID").val(rArray[1]);
                    if(customerID==0 || customerID=="0")
                    {
                      $("#hdnCustomerID").val(rArray[2]);
                      loadDDL("customers","ID,name","belongsTo="+$("#hdnUID").val().trim(),"Select Customer","ddlCustomer")
                        .then(() => {
                          $("#btnChoose").trigger("click");
                          $("#ddlCustomer").val(rArray[2]).trigger("change"); 
                          SFD=true;
                        })
                        .catch((error) => {
                          console.log(error)
                        })
                    }
                    $("#btnSave").text("Update Enquiry");
                    loadGrid(rArray[1]);
                    setpgbStatus(rArray[1]);
                    
                    $("#divProductDetails").fadeIn();
                    $("#btnQuotation").text("Create Quotation");
                    $("#btnQuotation").fadeIn();
                  }
                  if(response=="UPDATED")
                  {
                    if($('#ddlStatus').val().trim()=="payment" || $('#ddlStatus').val().trim()=="won")
                    { 
                      loadGrid2($("#txtHdnID").val().trim());
                      $("#divPaymentDetails").fadeIn();
                    }
                    else
                    {
                      $("#divPaymentDetails").hide();
                    }
                    setpgbStatus($("#txtHdnID").val().trim());
                    swal("","Enquiry Updated","success");
                  }
                  if($('#ddlStatus').val().trim()=="delivery" || $('#ddlStatus').val().trim()=="payment" || $('#ddlStatus').val().trim()=="won")
                  {
                    setQuarter(true);
                  }
                  else
                  {
                    setQuarter(false);
                  }
                },
                complete: function(){$("#btnSave").removeAttr("disabled");}
            });
    }
    else
    {
        var cArray=msg.split("\n");
        var ctrl="#txtCName";
        if(cArray[0]=="Name")ctrl="#txtCName";
        else if(cArray[0]=="Primary Contact (Whatsapp)")ctrl="#txtContact";
        swal("Please enter;",msg,"error").then(function() {
          $(ctrl).focus();
        });
    }
});

$("#btnQuotation").click(function() {

  var enqID=$("#txtHdnID").val().trim();
  if($(this).text()=="Create Quotation")
  {
    $("#btnQuotation").attr("disabled","disabled");  
    $.ajax({
        type:"post",
        url:"BO/common.php",
        data:{"do":"createQuotationFromEnq","ID":enqID},
        cache:false,
        success:function(ID)
        {
          if($.isNumeric(ID) && ID>0)
          {
            $("#btnQuotation").text("Show Quotation");
            $("#hdnQID").val(ID);
            $("#btnQuotation").removeAttr("disabled");  
            window.open(
              'quatation.php?ID='+ID,
              '_blank'
             );
          }
        }
      })
  }
  else if($(this).text()=="Show Quotation")
  {
      window.open(
        'quatation.php?ID='+$("#hdnQID").val().trim(),
        '_blank'
      );
  }

});

$("#btnExport").click(function() {

var enqID=$("#txtHdnID").val().trim();

window.open(
  'exportBill.php?enqID='+enqID,
  '_blank' 
);
});

//$(document).ready(function(){
function load()
{  
  jsGrid.ControlField.prototype.editButtonClass = "jsgrid-edit-button btn btn-lg"; 
    jsGrid.ControlField.prototype.deleteButtonClass = "jsgrid-delete-button btn btn-lg "; 
    jsGrid.ControlField.prototype.updateButtonClass= "jsgrid-update-button btn btn-lg";
    jsGrid.ControlField.prototype.cancelEditButtonClass= "jsgrid-cancel-edit-button btn btn-lg"; 
  var ID=$("#txtHdnID").val().trim();
   if(ID!="" && $.isNumeric(ID))
   {
    setFormData(ID);
    $("#lnkPageName").text("Update Enquiry");
    $("#btnSave").text("Update Enquiry");
    $("#divBack").show();
    $("#divReset").hide();
   }
   else
   {
    $("#frmEnquiry").fadeIn();
    $("#divBack").hide();
    $("#divReset").show();
    $("#lnkPageName").text("New Enquiry");
    $("#btnSave").text("Save Enquiry");
    resetForm();
    $("#ddlShared option[value='<?php echo $USERID;?>']").remove();
    loadMobileNos();
   }
   $("#txtDate").datepicker({ 
     dateFormat: 'dd/mm/yy'
    });
   $("#txtNextFUP").datepicker({ 
     dateFormat: 'dd/mm/yy',
     beforeShow: function()  {  
            if($("#txtDate").val().trim() != "")
            {
                $('#txtNextFUP').datepicker('option', 'minDate',new Date());  
            }
        }
    });
   $("#txtDeliveryDate").datepicker({ dateFormat: 'dd/mm/yy' });
   $("#txtPODate").datepicker({ dateFormat: 'dd/mm/yy' });
   $('#ddlShared').selectpicker({maxOptions:2,maxOptionsText:"Sharing possible only with 2 persons",noneSelectedText:"Not shared"});
   $('#ddlCustomer').selectpicker({liveSearch:true,container:"body"});
   $('#ddlCustomer').selectpicker("hide");
//});
}
function loadMobileNos()
{
  $.ajax({
    url:"BO/common.php",
    data:{"do":"loadMobileNos"},
    cache:false,
    success:function(list)
    {
      $("#listMobileNos").html(list);
    }
  })
}
$( "#txtPContact" ).change(function() {
    var options = $('#listMobileNos')[0].options;
    var val = $(this).val().trim();
    var found=0;
    if(SFD==false)
    {
      if(val!="" && val.length==10)
      {
        for (var i=0;i<options.length;i++){
          if (options[i].value === val) {
            found=1;
            $.ajax({
            url:"BO/common.php",
            data:{"do":"loadCustomerByMob","phone1":val},
            cache:false,
            dataType:"JSON",
            success:function(customer)
            {
              if (customer.length) {
                $("#btnChoose").text("Choose Customer");
                $("#btnChoose").trigger("click");
                $("#ddlCustomer").val(customer[0].ID).trigger("change"); 
                i=options.length;
              }
            }
          });
            break;  
          }
        }
        if(found==0)
        {
          if($("#btnChoose").text()=="New Customer")
          {
            $("#txtAddress").val("");
            //$("#txtPContact").val("");
            $("#txtContact2").val("");
            $("#txtEmail").val("");
            $("#txtGSTNo").val("");
            $('#ddlCustomer').val("");
            $('#ddlCustomer').selectpicker('hide');
            
              $("#txtCName").val("");
            $("#hdnCustomerID").val("0");
            $("#txtCName").show();
          }
        }
      }
      else
      {
        $("#txtAddress").val("");
        //$("#txtPContact").val("");
        $("#txtContact2").val("");
        $("#txtEmail").val("");
        $("#txtGSTNo").val("");
        $('#ddlCustomer').selectpicker('hide');
          $("#txtCName").val("");
          $("#hdnCustomerID").val("0");
          $("#txtCName").show();
      }
    }
});
$("#btnChoose").click(function(){
  var text=$(this).text().trim();
  if(text=="Choose Customer")
  {
    $("#txtCName").hide();
    //$("#ddlCustomer").show();
    $('#ddlCustomer').selectpicker('show');
    $(this).text("New Customer");
    $('#ddlCustomer').data('selectpicker').$button.focus();
    $('#ddlCustomer').selectpicker('toggle');
  }
  else if(text=="New Customer")
  {
    $("#txtCName").show();
    //$("#ddlCustomer").hide();
    $('#ddlCustomer').selectpicker('hide');
    $(this).text("Choose Customer");
    $("#txtCName").focus();
  }
  $("#txtContact").removeAttr("readonly");
  $("#txtContact").val("");
  $("#ddlCustomer").val("");
  $('#ddlCustomer').selectpicker('refresh');
  $("#hdnCustomerID").val("0");
  $("#btnViewCust").hide();

  $("#txtAddress").val("");
  $("#txtPContact").val("");
  $("#txtContact2").val("");
  $("#txtEmail").val("");
  $("#txtGSTNo").val("");
});
$("#btnViewCust").click(function(){
  window.open(
  'customer.php?ID='+$("#hdnCustomerID").val().trim(),
  '_blank'
  );
});
$("#ddlCustomer").change(function(){
 
    var val=$(this).val();
    if(val!="")
    {
      $("#hdnCustomerID").val(val);
      $("#btnSave").removeAttr("disabled");
      $("#btnViewCust").fadeIn();
      if(SFD==false)
      {
        $.ajax({
          url:"BO/common.php",
          data:{"do":"loadCustomer","ID":val},
          cache:false,
          dataType:"JSON",
          success:function(customer)
          {
            if (customer.length) {
              $("#txtAddress").val(customer[0].address);
              $("#txtPContact").val(customer[0].phone1);
              $("#txtContact2").val(customer[0].phone2);
              $("#txtEmail").val(customer[0].email);
              $("#txtGSTNo").val(customer[0].gstno);
            }
          }
        })
      }
    }
    else
    {
      $("#hdnCustomerID").val("0");
      $("#btnViewCust").hide();
    }
});
$("#txtCName").change(function(){
  var ID=$("#hdnCustomerID").val().trim();
  var name=$("#txtCName").val().trim();
  if(ID == "0")
  {
    $("#btnSave").attr("disabled","disabled");
    $.ajax({
      url:"BO/common.php",
      data:{"do":"checkCustomer","name":name},
      cache:false,
      success:function(response)
      {
       if(response.indexOf("YES")!= -1)
       {
        var rArray=response.split("_");
        swal({
          closeOnClickOutside: false,
          closeOnEsc: false,
          title: "Customer name already saved",
          text: "",
          icon: "warning",
          buttons: ["Save as new","Select saved",],
          dangerMode: true,
          }).then((response) => {
              if (response) {
                $("#btnChoose").trigger("click");
                $("#ddlCustomer").val(rArray[1]).trigger("change"); 
              }
              else
              {
                $("#hdnCustomerID").val("0");
                $("#txtCName").focus();
              }
              $("#txtAddress").focus();
        });
       }
      },
      complete: function()
      {
        $("#btnSave").removeAttr("disabled");
      }
    });
  }
});
function setpgbStatus(ID)
{
  $.ajax({
                url: "BO/common.php",
                data: {"do": "loadStatus" , "ID":ID},
                cache:false,
                success: function (pgbData) {
                  $("#pgbStatus").html(pgbData);
                }
              });
}
function setFormData(ID)
{
  $.ajax({
                url: "BO/common.php",
                data: {"do": "loadEnquiry" , "ID":ID},
                dataType:"JSON",
                cache:false,
                success: function (enquiry) {
                    if (enquiry.length) {
                      SFD=true; 
                      var code="";
                        $("#btnChoose").trigger("click");
                        $("#ddlCustomer").val(enquiry[0].customerID).trigger("change");
                        $("#txtAddress").val(enquiry[0].address);
                        $("#txtPContact").val(enquiry[0].primaryContact);
                        $("#txtContact2").val(enquiry[0].contact2);
                        $("#txtEmail").val(enquiry[0].email);
                        $("#txtGSTNo").val(enquiry[0].gstno);
                        $('#txtDate').val(enquiry[0].edateD);
                        $('#ddlSE').val(enquiry[0].assignedTo);
                       
                        $('#ddlStatus').val(enquiry[0].status).trigger('change');
                        if(enquiry[0].status=="payment" || enquiry[0].status=="won"){loadGrid2(ID);$("#divPaymentDetails").fadeIn()};
                        $('#txtDemoData').val(enquiry[0].demoRemarks);
                        $('#txtPONum').val(enquiry[0].poNumber);
                        $('#txtPODate').val(enquiry[0].poDate);
                        
                        $('#txtDeliveryDate').val(enquiry[0].deliveryDate);
                        $('#txtStampingArea').val(enquiry[0].area);
                        //$('#ddlPStatus').val(enquiry[0].payStatus).trigger("change");
                        $('#ddlPType').val(enquiry[0].payType);
                        $('#txtPInfo').val(enquiry[0].payInfo);
                        $('#txtNextFUP').val(enquiry[0].nextFUPD);
                        if(enquiry[0].sharedTo != null)
                        {
                          $('#ddlShared').selectpicker("val",enquiry[0].sharedTo.split(","));
                          if(enquiry[0].sharedTo.indexOf("<?php echo $USERID;?>")>-1)
                          {
                            $("#ddlCustomer").attr("disabled","disabled");
                            $('#ddlCustomer').selectpicker('refresh');
                            $("#btnChoose").hide();
                            $("#btnViewCust").hide();
                            $("#txtAddress").attr("disabled","disabled");
                            $("#txtPContact").attr("disabled","disabled");
                            $("#txtContact2").attr("disabled","disabled");
                            $("#txtEmail").attr("disabled","disabled");
                            $("#txtGSTNo").attr("disabled","disabled");
                            $('#ddlSE').attr("disabled","disabled");
                            $("#ddlShared").attr("disabled","disabled");
                            $('#ddlShared').selectpicker('refresh');
                          }
                          else
                          {
                            $("#ddlShared option[value='<?php echo $USERID;?>']").remove();
                            $('#ddlShared').selectpicker('refresh');
                          }
                        }
                        else
                        {
                          $("#ddlShared option[value='<?php echo $USERID;?>']").remove();
                          $('#ddlShared').selectpicker('refresh');
                        }
                        $('#txtNotes').val(enquiry[0].notes);
                        $("#frmEnquiry").fadeIn();
                        $("#linkWA").attr("href","https://api.whatsapp.com/send?phone=+91"+code+enquiry[0].primaryContact);
                        $("#linkDail").attr("href","tel:"+enquiry[0].primaryContact);
                        loadGrid(ID);
                        if($('#ddlStatus').val().trim()!="delivery" && $('#ddlStatus').val().trim()!="payment" && $('#ddlStatus').val().trim()!="won")
                          setQuarter(false);
                        else
                          setQuarter(true);
                        setpgbStatus(ID);
                        getQStatus();
                    }
                    else
                     window.location.href="enquiries.php?redirect=UAAE";
                
                }
            });
}
function getQStatus()
{
  var ID=$("#txtHdnID").val().trim();
  if(ID=="")ID=0;
  $.ajax({
    url:"BO/common.php",
    data:{"do":"getQuotEnq","ID":ID},
    cache:false,
    success:function(response)
    {
      if(response.indexOf("Show Quotation")!=-1)
      {
        var rArray=response.split("_");
        $("#btnQuotation").text(rArray[0]);
        $("#hdnQID").val(rArray[1]);
      }
      else
      {
        $("#btnQuotation").text(response);
      }
      $("#btnQuotation").fadeIn();
    }
  })
}
function goBack()
{
  window.location.href="enquiries.php";
}

menuActive("mnuEnq");
</script>
<script>
var MyDateField = function(config) {
    jsGrid.Field.call(this, config);
};
MyDateField.prototype = new jsGrid.Field({
 
 css: "date-field",            // redefine general property 'css'
 align: "left",              // redefine general property 'align'

 dateFormat: 'dd/mm/yy',

 sorter: function(date1, date2) {
     return new Date(date1) - new Date(date2);
 },

 itemTemplate: function(value) {
     return value;
 },

 insertTemplate: function(value) {
     return this._insertPicker = $("<input readonly>").datepicker({ defaultDate: new Date(),dateFormat: 'dd/mm/yy' }).datepicker("setDate", new Date());
 },

 editTemplate: function(value) {
   valArray=value.split("/");
   year=valArray[2];
   month=valArray[1];
   day=valArray[0];
   chDate=year+"-"+month+"-"+day;
     return this._editPicker = $("<input readonly>").datepicker({dateFormat: 'dd/mm/yy'}).datepicker("setDate", new Date(chDate));
 },

 insertValue: function() {
     return this._insertPicker.val();
 },

 editValue: function() {
     return this._editPicker.val();
 }
});

jsGrid.fields.date = MyDateField;

function MoneyField(config) {
    jsGrid.NumberField.call(this, config);
}

MoneyField.prototype = new jsGrid.NumberField({

    itemTemplate: function(value) {
        return  parseFloat(value).toFixed(2);
    },

    filterValue: function() {
        return parseFloat(this.filterControl.val() || 0);
    },

    insertValue: function() {
        return parseFloat(this.insertControl.val() || 0);
    },

    editValue: function() {
        return parseFloat(this.editControl.val() || 0);
    }

});

jsGrid.fields.money = MoneyField;
</script>
<script>
  function loadGrid(ID)
  {
    <?php echo setProducts(); ?>
      <?php echo setQuarter(); ?>
      $('#grid_table').jsGrid({

    width: "100%",
    height: "auto",

    filtering: false,
    inserting:true,
    editing: true,
    sorting: false,
    paging: true,
    autoload: true,
    pageSize: 10,
    pageButtonCount: 5,
    deleteConfirm: "Confirm product deletion from enquiry?",
    noDataContent: "No products added!",
    loadIndication:true,
    rowRenderer: function(item) {
    var $row = $('<tr>');            
    this._renderCells($row, item);
    $row.attr("id", "popover");
    $row.attr("data-content", item.productID);
    return $row;
        },

    controller: {
    loadData: function(filter){
      return $.ajax({
      url: "BO/common.php?do=getProductDetailsEnq&ID="+ID,
      dataType:"JSON",
      data: filter,
      cache:false
      });
    },
    insertItem: function(item){
      return $.ajax({
      type: "POST",
      url: "BO/common.php",
      data:{item, "do":"saveProductDetailsEnq", "ID" : ID,"action": "insert","qID":0},
      cache:false,
      success:function()
      {
        if($("#ddlStatus").val()=="payment")
        getTotal(ID);
      }
      });
    },
    updateItem: function(item){
      return $.ajax({
      type: "POST",
      url: "BO/common.php",
      data:{item, "do":"saveProductDetailsEnq", "ID" : ID,"action": "update","qID":0},
      cache:false,
      success:function()
      {
        if($("#ddlStatus").val()=="payment")
        getTotal(ID);
      }
      });
    },
    deleteItem: function(item){
      return $.ajax({
      url: "BO/common.php",
      data: {item, "do":"deleteProductDetailsEnq","qID":0},
      cache:false,
      success:function()
      {
        if($("#ddlStatus").val()=="payment")
        getTotal(ID);
      }
      });
    },
   
    },
    onItemInserting: function(args) {
      var gridData = $("#grid_table").jsGrid("option", "data");
                for (var i = 0; i < gridData.length; i++)
                {
                    if (args.item.productID == gridData[i].productID)
                    {
                        args.cancel = true;
                        swal("","Product already added!","warning");
                        return false;
                    }
                }
    },
    onItemInserted: function(args) {
        $("#grid_table").jsGrid("loadData");     
    },
    onItemDeleted: function(){
      $("#grid_table").jsGrid("loadData");
    },
    fields: [

      {name:"ID",title: "ID",css: "hide"},
      {name:"Sl",title: "Sl#" ,width:"8%"},
    
      { name: "productID", type: "select", title: "Product", 
          items: products, valueField: "productID", textField: "name",
          align:"left",width:"30%",
          insertTemplate: function () {
                    // Retrieve the DOM element
                    // Note: prototype.insertTemplate
                    var $insertControl = jsGrid.fields.select.prototype.insertTemplate.call(this);
                    $insertControl.addClass('selectpicker form-control');
                    $insertControl.attr("data-live-search", "true");
                    $insertControl.attr("data-container", "body");
                    
                    setTimeout(function() {
                      $insertControl.selectpicker({
                        liveSearch: true
                      });		             		
                      $insertControl.selectpicker('refresh');
                      $insertControl.selectpicker('render');
                    });

                    // Attach onchange listener !
                    var grid=this._grid;
                    $insertControl.change(function () {
                        var ID = $(this).val();
                        $.ajax({
                          url:"BO/common.php?do=getPrice&ID="+ID,
                          cache:false,
                          dataType:"JSON",
                          success:function(priceInfo)
                            {
                              if (priceInfo.length) {
                              grid.option("fields")[3].insertControl.val(priceInfo[0].price);
                              grid.option("fields")[4].insertControl.val(priceInfo[0].sprice);
                              grid.option("fields")[5].insertControl.val("1");
                              }
                              //grid.option("fields")[0].insertControl.val(0);
                            }
                        });
                        
                    });

                    return $insertControl;
                },
                editTemplate: function (value,item) {
                    // Retrieve the DOM element
                    // Note: prototype.insertTemplate
                    
                    var $editControl = jsGrid.fields.select.prototype.editTemplate.call(this);
                    $editControl.addClass('selectpicker form-control adjust');
                    $editControl.attr("data-live-search", "true");
                    $editControl.attr("data-container", "body");
                          
                    setTimeout(function() {
                      $editControl.selectpicker({
                        liveSearch: true
                      });		             		
                      $editControl.selectpicker('refresh');
                      $editControl.selectpicker('render');
                    });
                    
                    // Attach onchange listener !
                    var grid=this._grid;
                    grid.option("fields")[2].editControl.val(item.productID);
                    $editControl.change(function () {
                        var ID = $(this).val();
                        var yes=0;
                        var gridData = $("#grid_table").jsGrid("option", "data");
                        for (var i = 0; i < gridData.length; i++)
                        {
                            if (ID == gridData[i].productID && item.ID !=gridData[i].ID)
                            {
                                yes=1;
                            }
                        }
                        if(yes==0)
                        {
                          $.ajax({
                            url:"BO/common.php?do=getPrice&ID="+ID,
                            cache:false,
                            dataType:"JSON",
                            success:function(priceInfo)
                            {
                              if (priceInfo.length) {
                              grid.option("fields")[3].editControl.val(priceInfo[0].price);
                              grid.option("fields")[4].editControl.val(priceInfo[0].sprice);
                              }
                              //grid.option("fields")[0].insertControl.val(0);
                            }
                          });
                        } 
                        else
                        {
                          swal("","Product already added!","warning");
                          grid.option("fields")[2].editControl.val(item.productID).trigger("change");
                        }
                        
                    });

                    return $editControl;
                },
                validate: "required",
                validate: function(value)
                  {
                  if(value != '0')
                  {
                  return true;
                  }
                  }
        },

        {
      name: "price", 
      title: "MRP",
      align:"left",
    type: "number", 
    width: "20%", 
   readOnly:true,
    validate: "required"
    },
        
    {
      name: "sprice", 
      title: "Selling<br>Price/unit",
      align:"left",
    type: "number", 
    width: "20%", 
    validate: function(value)
    {
    if(value > 0)
    {
    return true;
    }
    },
    validate: "required"
    },
    {
      name: "qty", 
      title: "Qty",
      align:"left",
    type: "number", 
    width: "10%",
    validate: {
            validator: "min",
            message: function(value, item) {
                return "Minimum Qty should be 1";
            },
            param: [1]
        }
    },
    {
      name: "squarter",
      title: "Quarter",
      items: quarter, valueField: "quarter", textField: "name",
      align:"left",
      type: "select", 
      width: "20%", 
      insertTemplate: function () {
                    // Retrieve the DOM element
                    // Note: prototype.insertTemplate
                    var $insertControl = jsGrid.fields.select.prototype.insertTemplate.call(this);
                    $insertControl.addClass('selectpicker form-control');
                    $insertControl.attr("data-live-search", "true");
                    $insertControl.attr("data-container", "body");
                    
                    setTimeout(function() {
                      $insertControl.selectpicker({
                        liveSearch: true
                      });		             		
                      $insertControl.selectpicker('refresh');
                      $insertControl.selectpicker('render');
                    });
                    return $insertControl;
                  },
                  editTemplate: function (value,item) {
                    // Retrieve the DOM element
                    // Note: prototype.insertTemplate
                    
                    var $editControl = jsGrid.fields.select.prototype.editTemplate.call(this);
                    $editControl.addClass('selectpicker form-control adjust');
                    $editControl.attr("data-live-search", "true");
                    $editControl.attr("data-container", "body");
                          
                    setTimeout(function() {
                      $editControl.selectpicker({
                        liveSearch: true
                      });		             		
                      $editControl.selectpicker('refresh');
                      $editControl.selectpicker('render');
                    });
                    var grid=this._grid;
                    grid.option("fields")[6].editControl.val(item.squarter);
                    return $editControl;
                  }

    },
    
    {
      type: "control",
      width: "15%", 
      
    }
    ]

    });
  }
  
  function setQuarter(isHidden)
  {
    $("#grid_table").jsGrid("fieldOption", "squarter", "visible", isHidden);
  }
  $("tr[id=popover]").popover({placement:"top",trigger:"hover",width:"50%"});
</script>
<script>
var balance=0;
function getTotal(ID)
{
  $.ajax({
      url:"bo/common.php",
      data:{"do":"getTotalPay","enqID":ID},
      cache:false,
      success:function(amount)
      {
        $("#spnTotal").html("Total Rs "+amount);
        $("#hdnTotal").val(amount);
        getBalance(ID);
      }
  })
}
function getBalance(ID)
{
  var total=Number($("#hdnTotal").val());
  $.ajax({
      url:"bo/common.php",
      data:{"do":"getBalancePay","enqID":ID},
      cache:false,
      success:function(amount)
      {
        if(amount>0)
        {
        $("#spnBalance").html("Balance Rs "+amount);
        
        }
        else{
          $("#spnBalance").html("");
        }
        $("#hdnBalance").val(amount);
        balance=Number(amount);
        var paid=total-balance;
        $("#spnPaid").html("Paid Rs "+paid);

      }
  })
}
 function loadGrid2(ID)
  {
      const ptypes=[{ptypeVal:'',ptype:'Select Payment type'},
      {ptypeVal:'Advance : Cash',ptype:'Advance : Cash'},
      {ptypeVal:'Advance : Online',ptype:'Advance : Online'},
      {ptypeVal:'Advance : Cheque',ptype:'Advance : Cheque'},
      {ptypeVal:'Partial : Cash',ptype:'Partial : Cash'},
      {ptypeVal:'Partial : Online',ptype:'Partial : Online'},
      {ptypeVal:'Partial : Cheque',ptype:'Partial : Cheque (date)'},
      {ptypeVal:'Full : Cash',ptype:'Full : Cash'},
      {ptypeVal:'Full : Online',ptype:'Full : Online'},
      {ptypeVal:'Full : Cheque',ptype:'Full : Cheque (date)'}];

      const paidYN=[{paidVal:'1',paid:'Yes'},
      {paidVal:'0',paid:'No'}];
      getTotal(ID);
      $('#grid_table2').jsGrid({

    width: "100%",
    height: "auto",

    filtering: false,
    inserting:true,
    editing: true,
    sorting: false,
    paging: true,
    autoload: true,
    pageSize: 10,
    pageButtonCount: 5,
    deleteConfirm: "Confirm payment info. deletion?",
    noDataContent: "No payments added!",
    rowRenderer: function(item) {
    var $row = $('<tr>');            
    this._renderCells($row, item);
    $row.attr("id", "popover");
    $row.attr("data-content", item.productID);
    return $row;
        },

    controller: {
    loadData: function(filter){
      return $.ajax({
      url: "BO/common.php?do=getPaymentDetailsEnq&ID="+ID,
      dataType:"JSON",
      data: filter,
      cache:false
      });
    },
    insertItem: function(item){
      return $.ajax({
      type: "POST",
      url: "BO/common.php",
      data:{item, "do":"savePaymentDetailsEnq", "enqID" : ID,"action": "insert",},
      cache:false,
      success: function()
      {
        getBalance(ID);
      }
      });
    },
    updateItem: function(item){
      return $.ajax({
      type: "POST",
      url: "BO/common.php",
      data:{item, "do":"savePaymentDetailsEnq", "enqID" : ID,"action": "update"},
      cache:false,
      success: function()
      {
        getBalance(ID);
      }
      });
    },
    deleteItem: function(item){
      return $.ajax({
      url: "BO/common.php",
      data: {item, "do":"deletePaymentDetailsEnq"},
      cache:false,
      success: function()
      {
        getBalance(ID);
      }
      });
    },
    },
    onItemInserted: function(args) {
        $("#grid_table2").jsGrid("loadData");     
    },
    onItemDeleted: function(){
      $("#grid_table2").jsGrid("loadData");
    },
    fields: [

      {name:"ID",title: "ID",css: "hide"},
      {name:"Sl",title: "Sl#" ,width:"8%"},
    
      { name: "ptype", type: "select", title: "Payment<br>Type", 
          items: ptypes, valueField: "ptypeVal", textField: "ptype",
          align:"left",width:"25%",
          insertTemplate: function () {
                    // Retrieve the DOM element
                    // Note: prototype.insertTemplate
                    var $insertControl = jsGrid.fields.select.prototype.insertTemplate.call(this);
                    $insertControl.addClass('selectpicker form-control');
                    //$insertControl.attr("data-live-search", "true");
                    $insertControl.attr("data-container", "body");
                    
                    setTimeout(function() {
                      $insertControl.selectpicker({
                        //liveSearch: true
                      });		             		
                      $insertControl.selectpicker('refresh');
                      $insertControl.selectpicker('render');
                    });

                    var grid=this._grid;
                    $insertControl.change(function () {
                      var type=$(this).val();
                      if(type.indexOf("Full")!=-1)
                      {
                        grid.option("fields")[4].insertControl.val(balance);
                      }
                      else{
                      grid.option("fields")[4].insertControl.val("");
                      }
                      if(type.indexOf("Cheque")!=-1)
                      {
                        grid.option("fields")[6].insertControl.val("0");
                      }
                      else
                      {
                        grid.option("fields")[6].insertControl.val("1");
                      }
                    });
                    return $insertControl;
                },
                editTemplate: function (value,item) {
                    // Retrieve the DOM element
                    // Note: prototype.insertTemplate
                    
                    var $editControl = jsGrid.fields.select.prototype.editTemplate.call(this);
                    $editControl.addClass('selectpicker form-control adjust');
                    //$editControl.attr("data-live-search", "true");
                    $editControl.attr("data-container", "body");
                          
                    setTimeout(function() {
                      $editControl.selectpicker({
                        //liveSearch: true
                      });		             		
                      $editControl.selectpicker('refresh');
                      $editControl.selectpicker('render');
                    });
                    
                    // Attach onchange listener !
                    var grid=this._grid;
                    grid.option("fields")[2].editControl.val(item.ptype);
                    $editControl.attr("disabled","disabled");
                
                    return $editControl;
                },
                validate: "required",
                validate: function(value)
                  {
                  if(value != '')
                  {
                  return true;
                  }
                  }
        },

        {
      name: "pdate", 
      title: "Payment/Cheque<br>Date",
      align:"left",
    type: "date", 
    width: "25%", 
   readOnly:true,
    validate: "required"
    },
        
    {
      name: "amount", 
      title: "Amount",
      align:"left",
    type: "money", 
    width: "25%", 
    insertTemplate: function () {
                var $insertControl = jsGrid.fields.money.prototype.insertTemplate.call(this);
                  // Attach onchange listener !
                  var grid=this._grid;
                  $insertControl.change(function () {
                      var amount = $(this).val();
                      if(amount>balance)
                      {
                        swal("","Amount Exceeds payable balance","warning");
                        grid.option("fields")[4].insertControl.val("");
                      }
                      
                  });
                  return $insertControl;
                },
                editTemplate: function (value,item) {
                    // Retrieve the DOM element
                    // Note: prototype.insertTemplate
                    
                    var $editControl = jsGrid.fields.money.prototype.editTemplate.call(this);
                  
                    
                    // Attach onchange listener !
                    var grid=this._grid;
                    grid.option("fields")[4].editControl.val(item.amount);
                    $editControl.change(function () {
                        var amount = value-item.amount;
                        if(amount>balance)
                        {
                          swal("","Amount Exceeds payable balance Rs "+balance,"warning");
                          grid.option("fields")[4].editControl.val(item.amount);
                        }
                        
                    });

                    return $editControl;
                },
    validate: {
            validator: "min",
            message: function(value, item) {
                return "The minimum amount is Rs 1";
            },
            param: [1]
        }
          },
    {
      name: "remarks",
      title: "Remarks",
      align:"left",
      type: "textarea", 
      width: "20%", 
    },
    {
      name: "status",
      title: "Paid?",
      align:"left",
      width: "15%", 
      type:"select",
      items: paidYN, valueField: "paidVal", textField: "paid",
    },
    
    {
      type: "control",
      width: "10%", 
    }
    ]

    });
  }
</script>

<?php
function setProducts()
{
  include "BO/mysqli.php";
  $sql="SELECT ID,pname,model FROM products order by category";
  $result=mysqli_query($con,$sql);
  $product ="const products = [{productID: '0', name: 'Select'},";
  while($row=mysqli_fetch_array($result))
  {
    $product .= "{ productID: '$row[0]', name: '$row[1] ( $row[2] )' } ,";
  }
  $product .= "];";

  echo $product;
}

function setQuarter()
{
  $year=date("Y");
  $quarter ="const quarter = [{productID: '', name: 'Select'},";
  $i=3;
  while($i>=1)
  {
    $quarter .= "{ quarter: 'A-$year', name: 'A-$year' } ,{ quarter: 'B-$year', name: 'B-$year' },{ quarter: 'C-$year', name: 'C-$year' },{ quarter: 'D-$year', name: 'D-$year' },";
    $year--;
    $i--;
  }
  $quarter .= "];";

  echo $quarter;
}
?>