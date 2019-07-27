<?php 
ob_start();
session_start();
if( isset( $_SESSION['id'] ) ){

//connection of data base
require_once("connection.php");

//fetch info of logged user
$sql =  $db->prepare(" SELECT * from houses WHERE id = " . $_SESSION['id'] );
$myResult = $sql->execute();
$foundUser = $sql->fetchAll() ;
$foundUser =  array_shift($foundUser);
$_SESSION['loggedUser'] = $foundUser['house_owner'];
 

//start if user click delete
if( isset( $_GET['action'] )  && $_GET['action'] == 'delete' && isset( $_GET['id'] ) ){
  $id = $_GET['id'];
  
  if( $id >= 0  ){

    $sql =$db->prepare(" DELETE FROM estehkakat WHERE id = :id ");
    $sql->execute( array( ":id" => $id ) );
    $_SESSION['messege']  = "تم الحذف بنجاح";
    header('Location:home.php?action=view&id=' . $_SESSION['id']);
    

  }
}
//end if user click delete



require_once("head.php");
?>
  <div class="page-header page-header-xs" data-parallax="true" style="background-image: url('assets/img/fabio-mangione.jpg');">
    <div class="filter"></div>
  </div>
  <div class="section profile-content" style="background:#fff ">
    <div class="container">
     
<?php
$sql =  $db->prepare(" SELECT * from estehkakat");
$myResult = $sql->execute();
$result = $sql->fetchAll() ;
?>





<br><br>
        <div class="row text-center reports">
          <div class="col-md-6">
            <p class="navbar-brand" href="#" rel="tooltip" title="Coded by Creative Tim" data-placement="bottom" >
          <?php
          //fetch all houses list
          $sql =  $db->prepare(" SELECT * from dofaat");
          $myResult = $sql->execute();

          $result = $sql->fetchAll() ;
          $sum = 0;
          foreach( $result as $record ){
            $sum = ( $sum + $record['amount'] ) ;
            
          }

          echo "<b>";
          echo " رصيد الدفعات ";
          echo "<br>";
          echo " $sum جنية ";
          echo "</b>";
          
          ?>
          

        </p>
          </div>
          <div class="col-md-6">
            <p class="navbar-brand" href="#" rel="tooltip" data-placement="bottom" >
          <?php
          //fetch all houses list
          $sql =  $db->prepare(" SELECT * from estehkakat");
          $myResult = $sql->execute();

          $result = $sql->fetchAll() ;
          $sum = 0;
          foreach( $result as $record ){
            $sum = ( $sum + $record['amount'] ) ;
            
          }
          echo "<b>";
          echo " رصيد الاستحقاقات " ;
          echo "<br>";
          echo " $sum جنية ";
          echo "</b>";
          
          
          ?>
          

        </p>
          </div>
          
        </div>
       <br>

        

       <?php
        $sql =  $db->prepare(" SELECT * from estehkakat");
        $myResult = $sql->execute();
        $estehkakatResult = $sql->fetchAll() ;
        
       ?>
<h3 class="text-center"> عرض جميع الاستحقاقات </h3>
<br>

<!--start table-->
<table class="table users_list">
  <thead>
    <tr>
      <th scope="col"> اسم الاستحقاق </th>
      <th scope="col"> نوع الاستحقاق </th>
      <th scope="col"> المبلغ  </th>
      <th scope="col"> تاريخ الاستحقاق </th>
      <th scope="col"> عمليات </th>
      
    </tr>
  </thead>
  <tbody>
     <?php 
     if( $result ){
    foreach( $estehkakatResult as $record ){ ?>
    <tr>
      <?php

       echo "<td>".$record['name']."</td>" ;
       echo "<td>".$record['type']."</td>" ;
       echo "<td>". ($record['amount']) ."</td>" ;
       echo "<td>".$record['date']."</td>" ;
       echo "<td><a href='add_estehkakat.php?action=view&id=".$record['id']."'>عرض&nbsp;&nbsp;</a>
       <a href='?action=delete&id=".$record['id']."' onclick=\"return confirm('Are you sure you want to delete this item?');\">مسح</a>
       </td>" ;
      ?>
    </tr>
  <?php }} ?>
   
  </tbody>
</table>
<!--end table-->
     

      
    </div>
  </div>
  <?php require_once("footer.php");

}else{
  header('Location:index.php ');
}
ob_end_flush();
?>
