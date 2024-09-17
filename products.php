<?php require_once("BO/header.php"); ?>
<?php 
$ID="";
if(isset($_GET["ID"]))
{
    $ID=$_GET["ID"];
}
?>
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
              <h2 class="card-title">Product</h2><span class="float-right"><a href="showProducts.php" class="btn btn-sm btn-info">View Products</a></span>
            </div>
            <div class="card-body">
              <form role="form" method="post"  id="frmProduct" style="display:none !important" enctype="multipart/form-data">
                <div class="row">
                  <div class="col-sm-4">
                    <!-- select -->
                    <div class="form-group">
                      <label>Category</label>
                      <select id="ddlPCat" class="form-control" autofocus></select>
                    </div>
                    </div>
                    <div class="col-sm-4">
                    <!-- select -->
                    <div class="form-group">
                      <label>Product Name</label>
                      <input type="text" class="form-control gtext"  id="txtPName" autocomplete="off" required >
                    </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Image </label>&nbsp;&nbsp;<button type="button"  id="btnRMPhoto" class="btn btn-xs btn-warning">Remove</button>
                        <input type="file" class="form-control" required  id="fileImg" accept="image/x-png,image/gif,image/jpeg" onchange="loadFile(event,'imgMain')">
                      </div>
                    </div>
                    <div class="col-sm-1">
                    <div class="float-right">
                      <div class="form-group">
                          <label>&nbsp;</label>
                        <div id="divPrevImg"><img src="dist/img/noImage.png" id="imgMain" width="50px" height="50px"></div>
                      </div>
                    </div>
                    </div>
                  </div>
                <div class="row">
                <div class="col-sm-4">
                  <div class="form-group">
                      <label>Model</label>
                      <input type="text" class="form-control gtext"  id="txtModel"  required >
                  </div>
                  </div>
                  <div class="col-sm-4">
                  <div class="form-group">
                      <label>Brand</label>
                      <select id="ddlBrand" class="form-control" autofocus></select>
                  </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                    <label>Thumbnail Image </label>&nbsp;&nbsp;<button type="button"  id="btnRMThumb" class="btn btn-xs btn-warning">Remove</button>
                        <input type="file" class="form-control" required  id="fileThumb" accept="image/x-png,image/gif,image/jpeg" onchange="loadFile(event,'imgThumb')">
                    </div>
                    </div>
                    <div class="col-sm-1">
                    <div class="float-right">
                      <div class="form-group">
                          <label>&nbsp;</label>
                        <div id="divPrevThumb"><img src="dist/img/noImage.png" id="imgThumb" width="50px" height="50px"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                <div class="col-sm-3">
                  <div class="form-group">
                    <label>MRP</label>
                    <input  class="form-control" type="text"  id="txtPrice" required autocomplete="off">
                  </div>
                  </div>
                  <div class="col-sm-3">
                  <div class="form-group">
                    <label>Selling Price</label>
                    <input  class="form-control" type="text"  id="txtSPrice" required autocomplete="off">
                  </div>
                  </div>
                  <div class="col-sm-2">
                  <div class="form-group">
                    <label for="chkIGST" style="cursor:pointer !important;">Included GST</label><br>
                    <label >&nbsp;</label>
                    <input type="checkbox" class="form-control-lg"  id="chkIGST" style="cursor:pointer !important;">
                  </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label>Remarks</label>
                      <textarea rows="4"  class="form-control"  id="txtDescription" ></textarea>
                    </div>
                    </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label>Specifications</label>
                      <textarea rows="4"  class="form-control"  id="txtSpecs" ></textarea>
                    </div>
                    </div>
                </div>
                  <div class="row">
                    <div class="col-sm-12" >
                      <!-- select -->
                      <div class="float-right">
                        <button type="submit" class="btn btn-primary" id="btnSave">Save Product</button>
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
//loadDDL("product_categories","ID,category","","Select Category","ddlPCat");
//loadDDL("brands","ID,brand_name","","Select Brand","ddlBrand");

loadDDL("product_categories","ID,category","","Select Category","ddlPCat")
  .then(() => {
    loadDDL("brands","ID,brand_name","","Select Brand","ddlBrand")
  .then(() => {
    load();
  })
  .catch((error) => {
    console.log(error)
  })
  })
  .catch((error) => {
    console.log(error)
  });

    function resetForm()
    {
        $("#frmProduct").closest('form').find("input, textarea, select").val("");
        $("#frmProduct").closest('form').find("input[type=checkbox]").prop("checked",false);
        $("#txtPName").focus();
        $("#divPrevImg").html("<img src='dist/img/noImage.png' id='imgMain' width='50px' height='50px'>");
        $("#divPrevThumb").html("<img src='dist/img/noImage.png' id='imgThumb' width='50px' height='50px'>");
    }

$("#btnRMPhoto").click(function(){
  $("#fileImg").val("");
  $("#divPrevImg").html("<img src='dist/img/noImage.png' id='imgMain' width='50px' height='50px'>");
});
$("#btnRMThumb").click(function(){
$("#fileThumb").val("");
$("#divPrevThumb").html("<img src='dist/img/noImage.png' id='imgThumb' width='50px' height='50px'>");
});
  
$("#btnReset").click(function() {
    resetForm();
});
$("#btnSave").click(function(e) {
  var IDchk=$("#txtHdnID").val().trim();
    e.preventDefault();
     msg="";
    if($("#ddlPCat").val().trim()=="")
    {
        msg +="Category\n";
    }
    if($("#txtPName").val().trim()=="")
    {
        msg ="Product Name\n";
    }
    if($("#txtModel").val().trim()=="")
    {
        msg +="Model\n";
    }
    if($("#ddlBrand").val().trim()=="")
    {
        msg +="Brand\n";
    }
    if($("#txtPrice").val().trim()=="")
    {
        msg +="MRP\n";
    }
    else if($.isNumeric($("#txtPrice").val().trim())==false)
    {
        msg +="MRP in numbers only\n";
    }
    if($("#txtSPrice").val().trim()=="")
    {
        msg +="Selling Price\n";
    }
    else if($.isNumeric($("#txtSPrice").val().trim())==false)
    {
        msg +="Selling Price in numbers only\n";
    }
    

    if(msg == "")
    {
      $.ajax({
        url:"BO/common.php?do=hasProduct&pname="+$("#txtPName").val().trim()+"&model="+$("#txtModel").val().trim()+"&category="+$("#ddlPCat").val().trim()+"&brandID="+$("#ddlBrand").val().trim()+"&ID="+IDchk,
        cache:false,
        success: function(response)
        {
          if(response=="YES")
          {
            swal("","Product already exists!","warning").then(function() {
            $("#txtPName").focus();
            });
          }
          else if(response=="NO")
          {
            var includeGST=0;
            if($("#chkIGST").prop("checked"))
              includeGST=1;
            theData={
                    "do" : "saveProduct",
                    "ID" : $("#txtHdnID").val().trim(),
                    "ddlPCat" : $("#ddlPCat").val().trim(),
                    "txtPName" : $("#txtPName").val().trim(),
                    "txtModel" : $("#txtModel").val().trim(),
                    "ddlBrand" : $("#ddlBrand").val().trim(),
                    "txtPrice" : $("#txtPrice").val().trim(),
                    "includeGST":includeGST,
                    "txtSPrice" : $("#txtSPrice").val().trim(),
                    "txtDescription" : $("#txtDescription").val().trim(),
                    "txtSpecs" : $("#txtSpecs").val().trim()
                };
            $.ajax({
              type:"POST",
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
              }
            });
          }       
        }
      });         
    }
    else
    {
      swal("Please enter;",msg,"error").then(function() {
      $("#ddlPCat").focus();
      });
    }
});

function upload(ID,count)
{
  var IDchk=$("#txtHdnID").val().trim();
  var file_data = $('#fileImg').prop('files')[0];   
    var form_data = new FormData();                  
    form_data.append('image', file_data);    
    file_data = $('#fileThumb').prop('files')[0];  
    form_data.append('thumbnail', file_data);  
    form_data.append('ID', ID);
    form_data.append('do', "uploadProduct");                                 
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
            swal("Product Saved","","success");
            $("#countProd").text(count);
            resetForm();
          }
          else
          {
            swal("Product Updated","","success");
            goBack();
          }
        }
     });
    
}

//$(document).ready(function(){
function load()  
{
   var ID=$("#txtHdnID").val().trim();
   if(ID!="" && $.isNumeric(ID))
   {
    setFormData(ID);
    $("#lnkPageName").text("Edit Product");
    $("#btnSave").text("Update Product");
    $("#divBack").show();
    $("#divReset").hide();
   }
   else
   {
    $("#divBack").hide();
    $("#divReset").show();
    $("#lnkPageName").text("New Product");
    $("#btnSave").text("Save Product");
    $("#frmProduct").fadeIn();
   } 
}
//});

function setFormData(ID)
{
    $.ajax({
                url: "BO/common.php",
                data: {"do": "loadProduct" , "ID":ID},
                dataType:"JSON",
                cache:false,
                success: function (enquiry) {
                    if (enquiry.length) {
                      var path1=enquiry[0].imgMain;
                      if(path1==null)
                        path1="dist/img/noImage.png";
                      var path2=enquiry[0].imgThumb;
                      if(path2==null)
                        path2="dist/img/noImage.png"; 
                        $("#ddlPCat").val(enquiry[0].category);
                        $("#txtPName").val(enquiry[0].pname);
                        $("#txtModel").val(enquiry[0].model);
                        $("#ddlBrand").val(enquiry[0].brandID);
                        $("#txtPrice").val(enquiry[0].price);
                        $("#txtSPrice").val(enquiry[0].sprice);
                        $("#chkIGST").prop("checked",enquiry[0].includeGST==1)
                        $("#txtDescription").val(enquiry[0].description);
                        $("#txtSpecs").val(enquiry[0].specifications);
                        $("#divPrevImg").html("<img id='imgMain' src='" + path1 + "' height='50px' width='50px' alt='"+ enquiry[0].pname + " image Broken'>");
                        $("#divPrevThumb").html("<img id='imgThumb' src='" + path2 + "' height='50px' width='50px' alt='"+ enquiry[0].pname + " thumbnail Broken'>")
                    }
                
                },
                complete:function(){$("#frmProduct").fadeIn();}
            });
}
function goBack()
{
  window.location.href="showProducts.php";
}

var loadFile = function(event,which) {
    var output = document.getElementById(which);
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
  };
 
menuActive("mnuMaster");
menuActive("mnuProd");
</script>