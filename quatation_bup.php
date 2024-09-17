<?php require_once("BO/header.php"); ?>
<?php 
$ID="";
if(isset($_GET["ID"]))
{
    $ID=$_GET["ID"];
}
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
<style>
  .hide{
    display: none;
  }
  .bs-container.dropdown.bootstrap-select{width: 250px !important; min-width: 250px !important; }
  .dropdown-menu.show { width: 250px !important; min-width: 250px !important; } 
  </style>
<link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid.min.css" />
  <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid-theme.min.css" />
  
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
          <div class="card card-secondary">
            <div class="card-header">
              <h2 class="card-title">Quotation</h2><span class="float-right"><a href="showQuatations.php" class="btn btn-sm btn-info">View Quotations</a></span>
            </div>
            <div class="card-body">
              <form role="form" method="post"  id="frmQuatation" style="display:none !important" enctype="multipart/form-data">
                <div class="row">
                  <div class="col-sm-6">
                    <!-- select -->
                    <div class="form-group">
                      <label>Quotation Date</label>
                      <input type="text" class="form-control gtext"  id="txtQDate" readonly autofocus>
                    </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Customer </label>
                        <select id="ddlCustomer" class="form-control"></select>
                      </div>
                    </div>
                  </div>
                
                <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Type of Quotation</label>
                    <input type="text" class="form-control gtext"  id="txtQType" autocomplete="off" required >
                  </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                        <label>Media </label>
                        <input type="text" class="form-control"  id="txtMedia" autocomplete="off" required >
                      </div>
                    </div>
                </div>
                <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Address</label>
                    <textarea  class="form-control"  id="txtAddress" autocomplete="off" required ></textarea>
                  </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                        <label>Ref. No </label>
                        <input type="text" class="form-control"  id="txtRefNo" autocomplete="off" required >
                      </div>
                    </div>
                </div>
                <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Validity</label>
                    <input type="text" class="form-control"  id="txtValidity" autocomplete="off" required >
                  </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                        <label>Prepared By</label>
                        <input type="text" class="form-control gtext"  id="txtPreparedBy" autocomplete="off" required >
                      </div>
                    </div>
                </div>
                <div class="row" style="display: none;" id="divProductDetails">
                  <div class="col-sm-12">
                    <div class="table-responsive">  
                      <div id="grid_table"></div>
                      </div>  
                    </div>
                </div>
                  <div class="row" style="margin-top:10px">
                    <div class="col-sm-12" >
                    <?php if($ROLE=="ADMIN"){?>

                      <div class="float-right" id="divApprove">
                        <button type="button" onClick="approve();" class="btn btn-success btn-block" id="btnApprove">Approve</button>
                      </div>
                      <div class="float-right">&nbsp;&nbsp;</div>
                      <?php } ?>
                      <div class="float-right" id="divPrint">
                        <button type="button" onClick="printQ();" class="btn btn-danger btn-block" id="btnDownload">Download Quotation</button>
                      </div>
                      <div class="float-right">&nbsp;&nbsp;</div>
                      <div class="float-right">
                        <button type="submit" class="btn btn-primary" id="btnSave">Save & Proceed</button>
                      </div>
                      <div class="float-right">&nbsp;&nbsp;</div>
                      <div class="float-right" id="divReset">
                        <button type="button" class="btn btn-warning btn-block" id="btnReset">Reset</button>
                      </div>
                      <div class="float-right">&nbsp;</div>
                      <div class="float-right" id="divBack">
                        <button type="button" onClick="goBack();" class="btn btn-warning btn-block" id="btnBack">Back</button>
                      </div>
                      </div>
                  </div>
              </form>
            </div>
          </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
<?php require_once("BO/footer.php"); ?>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
<script>
  //$("#ddlCustomer").load("BO/common.php?do=getCustomersDD");

  loadCustomers()
  .then(() => {
    load();
  })
  .catch((error) => {
    console.log(error)
  });
  function loadCustomers()
  {
    return new Promise((resolve, reject) => { 
    $.ajax({
         url:"BO/common.php",
         data:{"do" : "getCustomersDD"},
         cache:false,
         success: function (options)
         {
            $("#ddlCustomer").html(options);
            resolve();
         },
         error: function (error) {
            reject(error)
          }
     });
    });
  }
    function resetForm()
    {
        $("#frmQuatation").closest('form').find("input[type=text],input[type=hidden],input[type=file], textarea, select").val("");
        $("#btnSave").text("Save & Proceed");
        var today = new Date();
        var d = String(today.getDate()).padStart(2, '0');
        var m = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var y = today.getFullYear();
        today = d + '/' + m + '/' + y;
        $("#txtQDate").val(today);
        $("#ddlCustomer").focus();
        $("#divProductDetails").fadeOut();
    }
  
$("#btnReset").click(function() {
    resetForm();
});
$("#btnSave").click(function(e) {
  var IDchk=$("#txtHdnID").val().trim();
    e.preventDefault();
     msg="";
    if($("#ddlCustomer").val().trim()=="")
    {
        msg ="Customer\n";
    }
    if($("#txtQType").val().trim()=="")
    {
        msg +="Type of Quotation\n";
    }
    if($("#txtMedia").val().trim()=="")
    {
        msg +="Media\n";
    }
    if(msg == "")
    {
      
      theData={
        "do" : "saveQuatationMaster",
        "ID" : $("#txtHdnID").val().trim(),
        "txtQDate" : $("#txtQDate").val().trim(),
        "ddlCustomer" : $("#ddlCustomer").val().trim(),
        "txtQType" : $("#txtQType").val().trim(),
        "txtMedia" : $("#txtMedia").val().trim(),
        "txtAddress" : $("#txtAddress").val().trim(),
        "txtRefNo" : $("#txtRefNo").val().trim(),
        "txtValidity" : $("#txtValidity").val().trim(),
        "txtPreparedBy" : $("#txtPreparedBy").val().trim(),
      };
      $.ajax({
        type:"POST",
        url: "BO/common.php",
        data: theData,
        cache:false,
        success: function (response) {
          if(response.indexOf("SAVED")>-1)
          {
            rArray=response.split("_");
            $("#txtHdnID").val(rArray[1]);
            $("#btnSave").text("Update");
            loadGrid(rArray[1]);
            
            $("#divProductDetails").fadeIn();
            $("#divPrint").show();
          }
          if(response=="UPDATED")
          {
            swal("","Updated","success");
          }
        }
      });       
    }
    else
    {
      swal("Please enter;",msg,"error").then(function() {
      $("#txtPName").focus();
      });
    }
});

function load(){
   var ID=$("#txtHdnID").val().trim();
   if(ID!="" && $.isNumeric(ID))
   {
    setFormData(ID);
    $("#lnkPageName").text("Edit Quotation");
    $("#btnSave").text("Update");
    $("#divBack").show();
    $("#divReset").hide();
    $("#divPrint").show();
   }
   else
   {
    $("#divBack").hide();
    $("#divReset").show();
    $("#lnkPageName").text("New Quotation");
    $("#btnSave").text("Save & Proceed");
    $("#divPrint").hide();
    resetForm();
    $("#frmQuatation").fadeIn();
   }
   $("#txtQDate").datepicker({ dateFormat: 'dd/mm/yy' }); 
}

function setFormData(ID)
{
    $.ajax({
                url: "BO/common.php",
                data: {"do": "loadQuatation" , "ID":ID},
                dataType:"JSON",
                cache:false,
                success: function (quatation) {
                  if (quatation.length) {
                    $("#txtQDate").val(quatation[0].qdate);
                    $("#ddlCustomer").val(quatation[0].customer);
                    $("#txtQType").val(quatation[0].type);
                    $("#txtMedia").val(quatation[0].media);
                    $("#txtAddress").val(quatation[0].address);
                    $("#txtRefNo").val(quatation[0].refNo);
                    $("#txtValidity").val(quatation[0].validity);
                    $("#txtPreparedBy").val(quatation[0].preparedBy);
                    if(quatation[0].status==0)
                    {
                      $("#btnDownload").attr("disabled","disabled");
                      $("#btnDownload").html("Download Quotation<span class='badge'>*waiting approval");
                    }
                    else
                    {
                      <?php if($ROLE=="ADMIN"){?>
                      $("#btnApprove").text("Disapprove");
                      <?php } ?>
                    }
                   
                    loadGrid(ID);
                    $("#divProductDetails").show();
                    $("#frmQuatation").fadeIn();
                  }
                
                }
            });
}
function goBack()
{
  window.location.href="showQuatations.php";
}
function printQ()
{
  var ID=$("#txtHdnID").val().trim();
  window.open(
  'quotationPrint.php?ID='+ID,
  '_blank');
}
function approve()
{
  var qID=$("#txtHdnID").val().trim();
  var text=$("#btnApprove").text().trim();
  var status=0;
  if(text=="Approve"){
    text="Disapprove";
    status=1;
  }
  else if(text=="Disapprove"){
    text="Approve";
    status=0;
  }
  $("#btnApprove").attr("disabled","disabled");
  $.ajax({
    url:"bo/common.php",
    data:{do:"approveQuot","qID":qID,"status":status},
    cache:false,
    success:function(response)
    {
      $("#btnApprove").text(text);
    },
    complete:function(){
      $("#btnApprove").removeAttr("disabled");
      if(status==1)
      {
        $("#btnDownload").html("Download Quotation");
        $("#btnDownload").removeAttr("disabled");
      }
      else if(status==0)
      {
        $("#btnDownload").attr("disabled","disabled");
        $("#btnDownload").html("Download Quotation<span class='badge'>*waiting approval");
      }
    }
  });
}
menuActive("mnuQuat");
</script>

<script>
  function loadGrid(ID)
  {
      <?php echo setProducts(); ?>
      $('#grid_table').jsGrid({

    width: "100%",
    height: "auto",

    filtering: false,
    inserting:true,
    editing: true,
    sorting: true,
    paging: true,
    autoload: true,
    pageSize: 10,
    pageButtonCount: 5,
    deleteConfirm: "Confirm product deletion from quotation?",
    noDataContent: "No products added!",
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
      url: "BO/common.php?do=getProductDetails&ID="+ID,
      dataType:"JSON",
      data: filter
      });
    },
    insertItem: function(item){
      return $.ajax({
      type: "POST",
      url: "BO/common.php",
      data:{item, "do":"saveProductDetails", "ID" : ID,"action": "insert"},
      });
    },
    updateItem: function(item){
      return $.ajax({
      type: "POST",
      url: "BO/common.php",
      data:{item, "do":"saveProductDetails", "ID" : ID,"action": "update"},
      });
    },
    deleteItem: function(item){
      return $.ajax({
      url: "BO/common.php",
      data: {item, "do":"deleteProductDetails"}
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
      var gridData = $("#grid_table").jsGrid("option", "data");
             $.ajax({
               url:"BO/common.php?do=getMaxID&max=max(ID)&table=quatation_details&where=qid="+ID,
               cache:false,
               async:false,
               success:function(response)
               {
                gridData[gridData.length-1].ID=response;
               }
             });
             $.ajax({
               url:"BO/common.php?do=getCountID&table=quatation_details&where=qid="+ID,
               cache:false,
               async:false,
               success:function(response)
               {
                gridData[gridData.length-1].Sl=response;
               }
             });      
    },
    onItemDeleted: function(){
      $("#grid_table").jsGrid("loadData");
    },
    fields: [

      {name:"ID",title: "ID",css: "hide" ,width:5},
      {name:"Sl",title: "Sl#" ,width:10},
    
      { name: "productID", type: "select", title: "Product", 
          items: products, valueField: "productID", textField: "name",
          align:"left",
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
                    $editControl.addClass('selectpicker form-control');
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
    width: 50, 
   readOnly:true,
    validate: "required"
    },
        
    {
      name: "sprice", 
      title: "Selling Price",
      align:"left",
    type: "number", 
    width: 50, 
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
      type: "control"
    }
    ]

    });
  }
  $("tr[id=popover]").popover({placement:"top",trigger:"hover"});
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
?>