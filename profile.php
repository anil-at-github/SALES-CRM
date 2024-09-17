<?php require_once("BO/header.php"); ?>
<?php 
$ID=$USERID;
$role=$ROLE;
$disabled="";
if($role=="SALES ENGINEER")
  $disabled="disabled";
?>

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
              <h2 class="card-title">My Profile</h2><span class="float-right"></span>
            </div>
            <div class="card-body">
              <form role="form" method="post"  id="frmUser" style="display:none">
                <div class="row">
                  <div class="col-sm-6">
                    <!-- select -->
                    <div class="form-group">
                      <label>Full Name</label>
                      <input type="text" class="form-control gtext" autocomplete="off"  id="txtFName" required autofocus>
                    </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Username <span id="error" class="badge" style="color:red"></span></label>
                        <input type="hidden" id="hdnIsValid" value="0" >
                        <input <?php echo $disabled;?> autocomplete="off" type="text" style="text-transform: lowercase;" class="form-control" maxlength="12" required  id="txtUName" >
                      </div>
                      </div>
                    </div>
                <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Type</label>
                    <input type="text" class="form-control"  id="ddlType" disabled>
                  </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Mobile Number</label>
                      <input type="text" class="form-control"  id="txtMobileNo">
                    </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Agent Code</label>
                        <input <?php echo $disabled;?> autocomplete="off" type="text" class="form-control"  id="txtAgentCode">
                      </div>
                      </div>
                      <div class="col-sm-6">
                      <div class="form-group" >
                          <label>Password</label>&nbsp;&nbsp;<button type="button" style="display:none" id="btnChangePassword" class="btn btn-xs btn-secondary">Change Password</button>
                          <input type="password" id="hdnPassword"  style="display:none">
                          <input type="password"  id="txtPassword"  autocomplete="new-password" class="form-control" >   
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12" >
                      <div class="float-right">
                        <button type="submit" class="btn btn-primary" id="btnSave">Update Profile</button>
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
  function resetForm()
  {
    $('#frmUser').find("input[type=text],input[type=password], textarea, select").val("");
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
    if($("#txtUName").val().trim()=="")
    {
      msg +="Username\n";
    }
    else
    {
      if($("#hdnIsValid").val().trim()=="0") 
        msg +="Available Username only\n";  
    }
    if($("#ddlType").val().trim()=="")
    {
        msg +="User Type\n";
    }
    if($("#txtMobileNo").val().trim()=="")
    {
        msg += "Mobile Number\n";
        
    }
    else 
    {
      var valid=is_mobile_valid($("#txtMobileNo").val().trim());
      if(!valid)
        msg += "Invalid Mobile Number\n";
    }
   
    if($("#txtPassword").val().trim()=="")
    {
        msg +="Password\n";
    }
    if(msg == "")
    {
      $("#btnSave").attr("disabled","disabled");  
      theData={
            "do" : "saveProfile",
            "ID" : $("#txtHdnID").val().trim(),
            "txtFName" : $("#txtFName").val().trim(),
            "txtUName" : $("#txtUName").val().trim(),
            "txtMobileNo" : $('#txtMobileNo').val().trim(),
            "txtAgentCode" : $('#txtAgentCode').val().trim(),
            "txtPassword" : $('#txtPassword').val().trim(),     
        }
        $.ajax({
                type:"post",
                url: "BO/common.php",
                data: theData,
                cache:false,
                success: function (response) {
                  if(response=="UPDATED")
                  {
                      swal("Profile Updated","","success");
                      $("#btnChangePassword").text("Change Password");
                      $("#txtPassword").attr("disabled","disabled");
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
        if(cArray[0]=="Full Name")ctrl="#txtFName";
        else if(cArray[0]=="Username")ctrl="#txtUName";
        else if(cArray[0]=="User Type")ctrl="#ddlType";
        else if(cArray[0]=="Mobile Number")ctrl="#txtMobileNo";
        else if(cArray[0]=="Password")ctrl="#txtPassword";
        swal("Please enter;",msg,"error").then(function() {
          $(ctrl).focus();
        });
    }
});
$(document).ready(function(){
   var ID=$("#txtHdnID").val().trim();
   if(ID!="" && $.isNumeric(ID))
   {
    setFormData(ID);
    $("#lnkPageName").text("My Profile");
    $("#btnSave").text("Update");
    $("#divBack").show();
   }
});

$("#txtUName").change(function(){
  var ID=$("#txtHdnID").val().trim();
  $("#btnSave").attr("disabled","disabled");
  $.ajax({
    url:"BO/common.php",
    data:{"do":"checkUserName","uname":$(this).val().trim(),"ID":ID},
    cache:false,
    success:function(isValid)
    {
      if(isValid=="1")
      {
        $("#hdnIsValid").val("1");
        $("#txtUName").css("color", "black");
        $("#txtUName").removeClass("inValid");
        $("#error").text("");
      }
      else
      {
        $("#hdnIsValid").val("0");
        $("#txtUName").addClass("inValid");
        $("#error").text("*Unavailable");
        $("#txtUName").focus();
      }
    },
    complete: function()
    {
      $("#btnSave").removeAttr("disabled");
    }
  });
});

$("#btnChangePassword").click(function(){
  var text=$(this).text().trim();
  if(text=="Change Password")
  {
    $("#txtPassword").removeAttr("disabled");
    $("#txtPassword").val("");
    $("#txtPassword").focus();
    $(this).text("Cancel Password Change");
  }
  else if(text=="Cancel Password Change")
  {
    $("#txtPassword").val($("#hdnPassword").val());
    $("#txtPassword").attr("disabled","disabled");
    $(this).text("Change Password");
  }
});
function setFormData(ID)
{
    $.ajax({
                url: "BO/common.php",
                data: {"do": "loadUser" , "ID":ID},
                dataType:"JSON",
                cache:false,
                success: function (user) {
                    if (user.length) {
                        $("#txtFName").val(user[0].fullname);
                        $("#txtUName").val(user[0].username);
                        $("#hdnIsValid").val("1");
                        $('#ddlType').val(user[0].role);
                        $('#txtMobileNo').val(user[0].mobileno);
                        $('#txtAgentCode').val(user[0].agentcode);
                        $("#txtPassword").val(user[0].password);
                        $("#hdnPassword").val(user[0].password);
                        $("#txtPassword").attr("disabled","disabled");
                        $("#btnChangePassword").show();
                    }
                
                },
                complete:function()
                {
                  $("#frmUser").fadeIn();
                }
            });
}
function goBack()
{
  window.location.href="dashboard.php";
}
menuActive("mnuSettings");
menuActive("mnuProfile");
</script>