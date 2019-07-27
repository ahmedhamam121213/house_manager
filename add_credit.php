<?php 
session_start();
if( isset($_SESSION['id']) ){

//connection of data base
require_once("connection.php");


//add user
if(  isset( $_POST['Add-credit'] )  ){
  
  $amount = $_POST['amount'];
  $description = $_POST['description'];
  $house_number = $_POST['house_number'];
  $date = $_POST['date'];

  $sql =  $db->prepare( " INSERT INTO dofaat ( amount , description , house_number,date ) 
             VALUES (:amount,:description,:house_number,:date)" );
  $bindedParams = array( ":amount" => $amount, ":description" => $description ,":house_number" => $house_number ,  ":date" => $date  );

  if( $sql->execute( $bindedParams ) ){
    $_SESSION['messege']  = "تمت الاضافة بنجاح";
    header('Location:add_credit.php?action=view');
  }         
}
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

    $sql =$db->prepare(" DELETE FROM dofaat WHERE id = :id ");
    $sql->execute( array( ":id" => $id ) );
    $_SESSION['messege']  = "تم الحذف بنجاح";
    header('Location:add_credit.php?action=view');
    

  }
}
//end if user click delete
  ?>
<!--start add credit-->
  <?php if( isset( $_GET['action'] )  && $_GET['action'] == 'add' ){ ?>

  <div class="section profile-content"  style="background:#fff">
    <div class="container">
     
      
    </div>
  </div>
  <div class="main">
    <div class="section landing-section">
      <div class="container">
        <div class="row">
          <div class="col-md-8 ml-auto mr-auto">
            <h2 class="text-center"> اضافة دفعة جديدة</h2>

            <form class="contact-form" method="post" enctype="multipart/form-data">
              <div class="row">
                <div class="col-md-12">
                  <label> المبلغ المدفوع </label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      </span>
                    </div>
                    <input type="text" name="amount" class="form-control"  required>
                  </div>
                </div>
               
              </div>
              <label> وصف الدفعة </label>
              <textarea class="form-control" name="description" rows="4"  required></textarea>


              <label> اختر الشقة</label>

              <div class="input-group">
                <div class="input-group-prepend">
                  </span>
                </div>
                <select name="house_number" class="form-control">
                  
                  <?php
                  //fetch all houses list
                  $sql =  $db->prepare(" SELECT * from houses");
                  $myResult = $sql->execute();
                  $result = $sql->fetchAll() ;
                  foreach( $result as $record ){
                    $rec = $record['house_number'];
                    echo "<option value=".$rec.">".$rec."</option>";
                  }
                  ?>
                
                </select>
              </div>


              <label> تاريخ الدفع </label>
              <div class="input-group">
                <div class="input-group-prepend">
                  </span>
                </div>
                <input type="date" name="date" class="form-control"  required>
              </div>
              

              <div class="row">
                <div class="ml-auto mr-auto">
                  <input type="submit" name="Add-credit" class="btn btn-danger btn-lg btn-fill" value="اضافة">
                  
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php } ?>
<!--end add credit-->

<?php if( isset( $_GET['action'] )  && $_GET['action'] == 'view' ){

  
  $sql =  $db->prepare(" SELECT * from dofaat");
  $myResult = $sql->execute();
  $result = $sql->fetchAll() ;
  ?>
<div class="container">
  <h2 class="text-center"> عرض الدفعات المسبقة </h2>
  <br>
  <!--start table-->
<table class="table users_list">
  <thead>
    <tr>
      
      <th scope="col"> المبلغ المدفوع</th>
      <th scope="col"> رقم الشقة</th>
      <th scope="col"> تاريخ الدفع</th>
      <th scope="col"> عمليات </th>
      
    </tr>
  </thead>
  <tbody>
     <?php 
    foreach( $result as $record ){ ?>
    <tr>
      <?php

       echo "<td>".$record['amount']."</td>" ;
       echo "<td>".$record['house_number']."</td>" ;
       echo "<td>".$record['date']."</td>" ;
       echo "<td><a href='view_credit.php?action=view&id=".$record['id']."'>عرض&nbsp;&nbsp;</a>
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
