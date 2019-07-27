<?php 
session_start();
if( isset($_SESSION['id']) ){
//connection of data base
require_once("connection.php");


//add user
if(  isset( $_POST['add_masrof'] )  ){

  
   $description = $_POST['description'];
   $amount = $_POST['amount'];
   $name = $_POST['name'];
   $date = $_POST['date'];

  $sql =  $db->prepare( " INSERT INTO masrofat ( description , amount  , name,date ) 
             VALUES (:description,:amount,:name,:date)" );
  $bindedParams = array( ":description" => $description , ":amount" => $amount ,":name" => $_SESSION['loggedUser'] ,  ":date" => $date  );

  if( $sql->execute( $bindedParams ) ){
    $_SESSION['messege']  = "تمت الاضافة بنجاح";
    header('Location:masrofat.php?action=view');
  }         
}
require_once("head.php");
?>
  <div class="page-header page-header-xs" data-parallax="true" style="background-image: url('assets/img/fabio-mangione.jpg');">
    <div class="filter"></div>
  </div>

  <?php

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
            <h2 class="text-center">  اضافة مصروف جديد </h2>

            <form class="contact-form" method="post" enctype="multipart/form-data">
              
              <label> وصف المصروف </label>
              <textarea class="form-control" name="description" rows="4"  required></textarea>              

              <label> المبلغ المصروف </label>
              <div class="input-group">
                <div class="input-group-prepend">
                  </span>
                </div>
                <input type="text" name="amount" class="form-control"  required>
              </div>


              <label> تاريخ الصرف </label>
              <div class="input-group">
                <div class="input-group-prepend">
                  </span>
                </div>
                <input type="date" name="date" class="form-control"  required>
              </div>
              

              <div class="row">
                <div class="ml-auto mr-auto">
                  <input type="submit" name="add_masrof" class="btn btn-danger btn-lg btn-fill" value="اضافة">
                  
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

<!--start view credit -->
  <?php if( isset( $_GET['action'] )  && $_GET['action'] == 'view' && isset( $_GET['id'] ) ){
    $id = $_GET['id'];
  $sql =  $db->prepare(" SELECT * from masrofat WHERE id = \"$id\"  ");
  $myResult = $sql->execute();
  $result = $sql->fetchAll() ;
  $result =  array_shift($result);
   ?>

  <div class="section profile-content"  style="background:#fff">
    <div class="container">
     
      
    </div>
  </div>
  <div class="main">
    <div class="section landing-section">
      <div class="container">
        <div class="row">
          <div class="col-md-8 ml-auto mr-auto">
            <h2 class="text-center">  عرض تفاصيل المصروف   </h2>

            <form class="contact-form" method="post" enctype="multipart/form-data">
              
              <label> وصف المصروف </label>
              <textarea disabled class="form-control" name="description" rows="4"  ><?php if( isset( $result['description'] ) ){ echo $result['description']; } ?></textarea>              

              <label> المبلغ المصروف </label>
              <div class="input-group">
                <div class="input-group-prepend">
                  </span>
                </div>
                <input disabled type="text" name="amount" class="form-control" value="<?php if( isset( $result['amount'] ) ){ echo $result['amount']; } ?>" >
              </div>

              <label> اسم الصارف  </label>
              <div class="input-group">
                <div class="input-group-prepend">
                  </span>
                </div>
                <input disabled type="text" name="name" class="form-control" value="<?php if( isset( $result['name'] ) ){ echo $result['name']; } ?>" >
              </div>


              <label> تاريخ الصرف </label>
              <div class="input-group">
                <div class="input-group-prepend">
                  </span>
                </div>
                <input disabled type="date" name="date" class="form-control" value="<?php if( isset( $result['date'] ) ){ echo $result['date']; } ?>" >
              </div>
              

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php } ?>
<!--end view credit -->

  <br><br>

<?php require_once("footer.php");
}else{
header('Location:index.php ');
}
