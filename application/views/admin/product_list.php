<!DOCTYPE html>
<html lang="en">

<head>
  
<?php $this->load->view('admin/inc/head');?>
  <link rel="stylesheet" href="<?=admin_custom_css();?>custome.css"/>
    <!-- <link rel="stylesheet" href="<?=admin();?>plugins/datatables-bs4/css/dataTables.bootstrap4.css"> -->
    <style>
    #cat_list td .btn
    {
      padding: .375rem .45rem;
    }
        .zoom:hover {
      -ms-transform: scale(4.5); /* IE 9 */
      -webkit-transform: scale(4.5); /* Safari 3-8 */
      transform: scale(3); 
    }
  </style>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
  <!-- Navbar -->
  
<?php $this->load->view('admin/inc/top_nav');?>

  <!-- Main Sidebar Container -->
<?php $this->load->view('admin/inc/sidebar');?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    
    <?php $this->load->view('admin/inc/breadcrumb');?>
    <!-- /.content-header -->

   

      <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
            <a href="add-product">
            <button type="button" class="btn-md cat-btn btn-primary pull-right" style="float: right"><i class="fa fa-plus-circle" aria-hidden="true"></i>
Add</button></a>
              <h3 class="card-title">Products
              
              </h3>
              
            </div>
            <!-- /.card-header -->
            <div class="card-body" id="menu_tbl_div">
              
            <?=form_open('',array("id"=>"aform"));?>
            <button type="submit" class="btn cat-btn btn-primary">Update</button>
            <table id="table_list" >  
       <thead>
        <tr>
        <th>No</th>
        <th>Image</th>
        <th>Category</th>
        <th>Title</th>
        <th>Sub Title</th>
        <th>Price</th>
        <th>Home Status</th>
        <th>Status</th>
        <th>Action</th> 
        </tr>
    </thead>
    <tbody>
        
   
        
         <?php if(!empty($records))
                  {
                    
                     $i=1;
                    foreach($records as $index=>$r)
                    {
                        $img = '';
                        $images = $r->p_image;
                         if(!empty($images))
                         {
                          
                           $pathinfo = pathinfo($images);
                           if(file_exists('assets/front/img/products/'.$pathinfo['dirname'].'/60_60_'.$pathinfo['basename']))
                           {
                             $pp = base_url('assets/front/img/products/'.$pathinfo['dirname'].'/60_60_'.$pathinfo['basename']);
                             $img = '<img src="'.$pp.'">';
                           }
                           else
                           {
                             $pp = base_url('assets/front/img/products/'.$images);
                             $img = '<img class="zoom" src="'.$pp.'" width="60" height="60">';
                           }
   
                         } 
                 
                      ?>
  <tr>
                      <td><?=$i++;?></td>
                      <td><?=$img;?></td>
                      <td><?=$r->c_category; ?></td>
                      <td><?=$r->p_title; ?></td>
                      <td><?=$r->p_subtitle; ?></td>
                      <td><?=$r->p_price; ?></td>
                      <td><input type="checkbox"  id="home_status"  name="home_status[<?=$r->p_id;?>]"  <?php  echo ($r->p_home_status=='1'?'checked':'');  ?> value="1"></td>
                      <td><?=($r->p_status=='1'?'active':'inactive');?></td>
                   
                        
                       
                        
                       
                        <td>  <a href="add-product/<?=$r->p_id;?>"  class="btn edit-cat btn-info" title="Edit"> <i class="fa fa-edit"></i></a>
                         
                     <a href="javascript:void(0)" id="<?=$r->p_id;?>" class="btn del-product btn-danger" title="Delete"> <i class="fa fa-trash"></i></a>
                
                     </td>
                           
                      
                        
                      </tr>
                      <?php
                     
                    }
                  }
                ?>
    </tbody>
</table> 

                </form>
          


   



          </div>
        </div>
      </div>
    </div>
  </section>

  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->


<?php $this->load->view('admin/inc/footer');?>
</div>



<?php $this->load->view('admin/inc/scripts');?>
<script src="<?=admin_custom_js();?>common.js"></script>
<script src="<?=admin_custom_js();?>product.js"></script>

 
 <!-- DataTables -->
<script src="<?=admin();?>plugins/datatables/jquery.dataTables.js"></script>
<script src="<?=admin();?>plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>


<script type="text/javascript">
$(document).ready(function() {
    $('#table_list').DataTable();
  
});
</script> 

</body>

</html>
