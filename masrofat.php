<?php 
session_start();
if( isset($_SESSION['id']) ){

//connection of data base
require_once("connection.php");
require_once("head.php");
?>
  <div class="page-header page-header-xs" data-parallax="true" style="background-image: url('assets/img/fabio-mangione.jpg');">
    <div class="filter"></div>
  </div>

  <?php
//start if user click delete
if( isset( $_GET['action'] )  && $_GET['action'] == 'delete' && isset( $_GET['id'] ) ){
  $id = $_GET['id'];
  
  if( $id >= 0  ){

    $sql =$db->prepare(" DELETE FROM masrofat WHERE id = :id ");
    $sql->execute( array( ":id" => $id ) );
    $_SESSION['messege']  = "تم الحذف بنجاح";
    header('Location:masrofat.php?action=view');
    

  }
}
//end if user click delete
  ?>


<?php if( isset( $_GET['action'] )  && $_GET['action'] == 'view' ){

  
  $sql =  $db->prepare(" SELECT * from masrofat");
  $myResult = $sql->execute();
  $result = $sql->fetchAll() ;
  ?>
<div class="container">
  <a class="btn btn-primary" href="add_masrof.php?action=add"> اضافة مصروف  </a>
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
<?php } ?>
  <br><br>

<?php require_once("footer.php");
}else{
header('Location:index.php ');
}
