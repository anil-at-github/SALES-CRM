<?php require_once("BO/header.php"); ?>

<style>
  .hide{
    display: none;
  }
  </style>
<link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid.min.css" />
  <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid-theme.min.css" />
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
      
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Brands</li>
              <li class="breadcrumb-item active"><a id="lnkPageName" href="#">Product Categories</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
          <div class="card card-secondary" id="divCats">
            <div class="card-header">
              <h2 class="card-title">Brands</h2>
            </div>
            <div class="card-body">
            <div class="table-responsive">  
              <div id="grid_table" style="display:none"></div>
            </div>  
            </div>
          </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
<?php require_once("BO/footer.php"); ?>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid.min.js"></script>
<script>
   
$(document).ready(function(){
    loadGrid();
    $("#grid_table").fadeIn();
});
menuActive("mnuMaster");
menuActive("mnuBrand");
</script>

<script>
  function loadGrid()
  {
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
    deleteConfirm: "Confirm Brand deletion?",
    noDataContent: "No Brands added!",

    controller: {
    loadData: function(filter){
      return $.ajax({
      url: "BO/common.php?do=getBrands",
      dataType:"JSON",
      data: filter
      });
    },
    insertItem: function(item){
      return $.ajax({
      type: "POST",
      url: "BO/common.php",
      data:{item, "do":"saveBrands","action": "insert"},
      });
    },
    updateItem: function(item){
      return $.ajax({
      type: "POST",
      url: "BO/common.php",
      data:{item, "do":"saveBrands", "action": "update"},
      });
    },
    deleteItem: function(item){
      return $.ajax({
      url: "BO/common.php",
      data: {item, "do":"deleteBrands"}
      });
    },
   
    },
    onItemInserting: function(args) {
      var gridData = $("#grid_table").jsGrid("option", "data");
                for (var i = 0; i < gridData.length; i++)
                {
                    if (args.item.brand_name.trim() == gridData[i].brand_name)
                    {
                        args.cancel = true;
                        swal("","Brand already added!","warning");
                        return false;
                    }
                }
    },
    onItemInserted: function(args) {
      var gridData = $("#grid_table").jsGrid("option", "data");
             $.ajax({
               url:"BO/common.php?do=getMaxID&max=max(ID)&table=brands&where=",
               cache:false,
               async:false,
               success:function(response)
               {
                gridData[gridData.length-1].ID=response;
               }
             });
             $.ajax({
               url:"BO/common.php?do=getCountID&table=brands&where=",
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

      {name:"ID",title: "ID",css: "hide" ,width:10},
      {name:"Sl",title: "Sl#" ,width:10},
        
    {name: "brand_name", title: "Brand Name",align:"left",type: "text", 
        insertTemplate: function () {
                    // Retrieve the DOM element
                    // Note: prototype.insertTemplate
                    var $insertControl = jsGrid.fields.text.prototype.insertTemplate.call(this);

                    // Attach onchange listener !
                    var grid=this._grid;
                    $insertControl.change(function () {
                        var brand_name = $(this).val().trim();
                        grid.option("fields")[2].insertControl.val(brand_name);   
                    });
                    return $insertControl;
                },
                editTemplate: function (value,item) {
                    // Retrieve the DOM element
                    // Note: prototype.insertTemplate
                    
                    var $editControl = jsGrid.fields.text.prototype.editTemplate.call(this);
                    
                    // Attach onchange listener !
                    var grid=this._grid;
                    grid.option("fields")[2].editControl.val(item.brand_name);
                    $editControl.change(function () {
                        var brand_name = $(this).val().trim();
                        var yes=0;
                        var gridData = $("#grid_table").jsGrid("option", "data");
                        for (var i = 0; i < gridData.length; i++)
                        {
                            if (brand_name == gridData[i].brand_name && item.ID !=gridData[i].ID)
                            {
                                yes=1;
                            }
                        }
                        if(yes==0)
                        {
                              grid.option("fields")[2].editControl.val(brand_name); 
                        } 
                        else
                        {
                          swal("","Brand already added!","warning");
                        }
                        
                    });

                    return $editControl;
                },
        validate: function(value)
        {
            if(value != '')
            {
            return true;
            }
        },
        validate: "required",

    },
    
    {type: "control"}
    ]

    });
  }
</script>