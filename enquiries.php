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
              <li class="breadcrumb-item active"><a href="#">View Enquiries</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <input type="hidden" id="hdnSWY">
        <input type="hidden" id="hdnSBY">
        <input type="hidden" id="hdnFW">
        <input type="hidden" id="hdnRole" value="<?php echo $ROLE ?>">
        <h3>Live Enquiries <a href="enquiry.php" class="btn btn-xs btn-danger" ><i class="fas fa-plus"></i> New Enquiry</a> <?php if($ROLE=="ADMIN"){ ?><a href="importEnquiry.php" class="btn btn-xs btn-danger"><i class="fas fa-reply"></i> Import</a><?php } ?> <?php if($ROLE!="ADMIN"){ ?><a id="btnFilterSWY" class="btn btn-xs btn-danger" onClick="return viewSharedSWY(this.text)"><i class="fas fa-share" ></i> Enquiries Shared with you</a> <a id="btnFilterSBY" class="btn btn-xs btn-danger" onClick="return viewSharedSBY(this.text)"><i class="fas fa-share" ></i> Enquiries Shared by you</a><?php } ?> <a id="btnFW" onClick="return loadWon()" class="btn btn-xs btn-success" >Filter WON</a></h3>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script>
var isMobile = false; //initiate as false
// device detection
if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent) 
    || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) { 
    isMobile = true;
}
  function loadEnquiries(isWon)
  {
    $.ajax({
        url: "BO/common.php?do=loadEnquiries&isWon="+isWon,
        success: function (enquiries) {
          var count=$("#hdnFW").val().trim();
          var role=$("#hdnRole").val().trim();
          $("#showTable").html(enquiries); 
          if(isWon==1)
          {
            $("#btnFW").html("<i class='fas fa-eye'></i> View All Enquiries"); 
          }
          else
          {
            $("#btnFW").html("Filter WON <span class='badge bg-dark'>"+count+"</span>"); 
          }
          
          $('#tblEnqs').DataTable({
            "language": {
              "emptyTable": "No enquiries found!",
              },
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "columnDefs": [{ targets: 'no-sort', orderable: false }],
            buttons: [
                {
                    text: 'Shared Enquiries',
                    action: function ( e, dt, node, config ) {
                        dt.ajax.reload();
                    }
                }
            ],
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
                  if(d.trim()!=""){
                    select.append( '<option value="'+d+'">'+d+'</option>' );
                }
                } );
            } );
        },
        complete: function()
        {
          
        }
    }); 
      
  }
});
  }
  $(document).ready(function(){
    loadEnquiries(0);
    getSharedCounts();
});
function viewSharedSWY(text)
{
  var count=$("#hdnSWY").val().trim();
  var count2=$("#hdnSBY").val().trim();
  if(text.indexOf("Shared")>-1)
  {
    $("input[type='search']").val("* with you").trigger("keyup"); 
    if(isMobile==false) 
      $("input[type='search']").first().focus();
    $("#btnFilterSWY").html("<i class='fas fa-eye'></i> View All Enquiries"); 
    $("#btnFilterSBY").html("<i class='fas fa-share'></i> Enquiries Shared by you <span class='badge bg-dark'>"+count2+"</span>"); 
  }
  else
  {
    $("input[type='search']").val("").trigger("keyup");  
    $("#btnFilterSWY").html("<i class='fas fa-share'></i> Enquiries Shared with you <span class='badge bg-dark'>"+count+"</span>"); 
    
  }
}
function viewSharedSBY(text)
{
  var count=$("#hdnSBY").val().trim();
  var count2=$("#hdnSWY").val().trim();
  if(text.indexOf("Shared")>-1)
  {
    $("input[type='search']").val("you shared people").trigger("keyup");  
    if(isMobile==false) 
      $("input[type='search']").first().focus();
    $("#btnFilterSBY").html("<i class='fas fa-eye'></i> View All Enquiries"); 
    $("#btnFilterSWY").html("<i class='fas fa-share'></i> Enquiries Shared with you <span class='badge bg-dark'>"+count2+"</span>"); 
  }
  else
  {
    $("input[type='search']").val("").trigger("keyup");  
    $("#btnFilterSBY").html("<i class='fas fa-share'></i> Enquiries Shared by you <span class='badge bg-dark'>"+count+"</span>"); 
    
  }
}
function loadWon()
{
  var text=$("#btnFW").text()
  if(text.indexOf("Filter")>-1)
  {
  $("#btnFW").text("Filtering...");
   loadEnquiries(1);
  }
  else
  {
    $("#btnFW").text("Loading...");
    loadEnquiries(0);
  }
}
function delEnquiry(ID,name)
{
  $("#row"+ID).addClass("bg-warning");
  swal({
          closeOnClickOutside: true,
          closeOnEsc: true,
          title: "Confirm Enquiry Deletion : "+name,
          text: "This will delete Follow-ups, Payments & Quotation details associated with the same!",
          icon: "warning",
          buttons: ["Don't Delete","Yes, Proceed",],
          dangerMode: true,
          }).then((response) => {
              if (response) {
                $.ajax({
                  url:"BO/common.php",
                  data:{"do":"delEnquiry","enqID":ID},
                  cache:false,
                  success:function(response)
                  {
                    if(response=="YES")
                      $("#row"+ID).fadeOut();
                  }
                });
              }
              else
              {
                $("#row"+ID).removeClass("bg-warning");
              }
        });
  return false;
}

function getSharedCounts()
{
  $.ajax({
    url:"BO/common.php",
    data:{"do":"getSharedCounts"},
    cache:false,
    success:function (response)
    {
        rArray=response.split("_");
        $("#hdnSWY").val(rArray[1]);
        $("#hdnSBY").val(rArray[0]);
        $("#hdnFW").val(rArray[2]);

        var swyText=$("#btnFilterSWY").html();
        var sbyText=$("#btnFilterSBY").html();

        var fwText=$("#btnFW").text();


        swyText = swyText + " <span class='badge bg-dark'>"+rArray[1]+"</span>";
        sbyText = sbyText +" <span class='badge bg-dark'>"+rArray[0]+"</span>";

        fwText = fwText +" <span class='badge bg-dark'>"+rArray[2]+"</span>";


        $("#btnFilterSWY").html(swyText);
        $("#btnFilterSBY").html(sbyText);
        $("#btnFW").html(fwText);

    }
  })
}

menuActive("mnuEnq");
</script>