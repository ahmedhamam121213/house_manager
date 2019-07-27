<?php 
ob_start();
session_start();
if( isset( $_SESSION['id'] ) ){

//connection of data base
require_once("connection.php");
require_once("head.php");
?>
  <div class="page-header page-header-xs" data-parallax="true" style="background-image: url('assets/img/fabio-mangione.jpg');">
    <div class="filter"></div>
  </div>
  <div class="section profile-content" style="background:#fff ">
  <div class="container">
    <h3 class="text-center">التقايرير الخاصة بالمصروفات</h3><br>
    <form method="post" >
      <div class="row">
        <div class="col-md-6">
            <label>من</label>
            <input type="date" name="first_date" style="text-align: right;" class="form-control" required >
            <br>
        </div>
        <div class="col-md-6">
            <label>الي</label>
            <input type="date" name="second_date" style="text-align: right;" class="form-control" required >
            <br>
        </div>
        <div class="col-md-4">
          <input type="submit" class="btn btn-primary" name="range" value="ارسل">
        <br>
        </div>
      </div>
    </form>

    <?php
    if( isset( $_POST['range'] ) ){
      $firstDate = $_POST['first_date'];
      $secondDate =  $_POST['second_date'];
      $sql =  $db->prepare(" SELECT * from masrofat WHERE date BETWEEN \"$firstDate\" AND \"$secondDate\" ");
  $myResult = $sql->execute();
  $result = $sql->fetchAll() ;

  ?>

<div class="container">
  <br>
  <br>
  <!--start table-->
<table class="table users_list">
  <thead>
    <tr>
      
    
      <th scope="col"> وصف المصروف </th>
      <th scope="col"> المبلغ المصروف </th>
      <th scope="col"> اسم الصارف </th>
      <th scope="col"> تاريخ الصرف  </th>
      <th scope="col"> عمليات   </th>

      
      
    </tr>
  </thead>
  <tbody>
     <?php 
    foreach( $result as $record ){ ?>
    <tr>
      <?php
       $description = substr( $record['description'] , 0 , 40) . "...."; 
       echo "<td>".$description."</td>" ;
       echo "<td>".$record['amount']."</td>" ;
       echo "<td>".$record['name']."</td>" ;
       echo "<td>".$record['date']."</td>" ;
       echo "<td><a href='add_masrof.php?action=view&id=".$record['id']."'>عرض&nbsp;&nbsp;</a>
       <a href='?action=delete&id=".$record['id']."' onclick=\"return confirm('Are you sure you want to delete this item?');\">مسح</a>
       </td>" ;
      ?>
    </tr>
  <?php } ?>
   
  </tbody>
</table>
<!--end table-->
</div>
  <?php

    }
    ?>
    
     

     

     
    
  </div>

  </div>
  <?php require_once("footer.php");

}else{
  header('Location:index.php ');
}
ob_end_flush();
?>
