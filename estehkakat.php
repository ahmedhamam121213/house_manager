<?php 
session_start();
if( isset($_SESSION['id']) ){

//connection of data base
require_once("connection.php");
//fetch info of logged user
$sql =  $db->prepare(" SELECT * from users WHERE id = " . $_SESSION['id'] );
$myResult = $sql->execute();
$foundUser = $sql->fetchAll() ;
$foundUser =  array_shift($foundUser);

//add user
if(  isset( $_POST['Add-mostahak'] )  ){
  $name = $_POST['name'];
  $type = $_POST['type'];
  $description = $_POST['description'];
  $amount = $_POST['amount'];
  $date = $_POST['date'];

  $sql =  $db->prepare( " INSERT INTO estehkakat ( name , type , description , amount , date ) 
             VALUES (:name,:type,:description,:amount,:date)" );
  $bindedParams = array( ":name" => $name , ":type" => $type ,":description" => $description , ":amount" => $amount, ":date" => $date  );

  if( $sql->execute( $bindedParams ) ){
    $_SESSION['messege']  = "تمت الاضافة بنجاح";
    header('Location:user.php');
  }         
}
require_once("head.php");
?>
  <div class="page-header page-header-xs" data-parallax="true" style="background-image: url('assets/img/fabio-mangione.jpg');">
    <div class="filter"></div>
  </div>
<!--start add user-->
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
            <h2 class="text-center"> اضافة استحقاق جديد </h2>

            <form class="contact-form" method="post" enctype="multipart/form-data">
              <div class="row">
                <div class="col-md-6">
                  <label>اسم الاستحقاق</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      
                        <!-- <i class="nc-icon nc-single-02"></i> -->
                      </span>
                    </div>
                    <input type="text" name="name" class="form-control"  required>
                  </div>
                </div>
                <div class="col-md-6">
                  <label> نوع الاستحقاق  </label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      </span>
                    </div>
                    <select required class="form-control" name="type" >
                      <option value="شهري"> شهري </option>
                      <option value="طارق" > طارق </option>
                    </select>
                    
                  </div>
                </div>
              </div>
              <label> وصف الاستحقاق  </label>
              <textarea class="form-control" name="description" rows="4"  required></textarea>

              <label> المبلغ بالجنية </label>
              <div class="input-group">
                <div class="input-group-prepend">
                  </span>
                </div>
                <input type="text" name="amount" class="form-control"  required>
              </div>

              <label> تاريخ الاستحقاق  </label>
              <div class="input-group">
                <div class="input-group-prepend">
                  </span>
                </div>
                <input type="date" name="date" class="form-control"  required>
              </div>
              

              <div class="row">
                <div class="ml-auto mr-auto">
                  <input type="submit" name="Add-mostahak" class="btn btn-danger btn-lg btn-fill" value="اضافة">
                  
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php } ?>
<!--end add user-->

<!--start add user-->
  <?php if( isset( $_GET['action'] )  && $_GET['action'] == 'view' && isset( $_GET['id'] ) ){
  $id = $_GET['id'];
  $sql =  $db->prepare(" SELECT * from estehkakat WHERE id = \"$id\"  ");
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
            <h2 class="text-center"> عرض الاستحقاق </h2>

            <form class="contact-form" method="post" enctype="multipart/form-data">
              <div class="row">
                <div class="col-md-6">
                  <label>اسم الاستحقاق</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      
                        <!-- <i class="nc-icon nc-single-02"></i> -->
                      </span>
                    </div>
                    <input disabled type="text" name="name" class="form-control"  required value="<?php  if( isset($result['name']) ){ echo $result['name']; } ?>">
                  </div>
                </div>
                <div class="col-md-6">
                  <label> نوع الاستحقاق  </label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      </span>
                    </div>
                    <select disabled class="form-control" name="type" value="<?php  if( isset($result['type']) ){ echo $result['type']; } ?>" >
                      <option value="شهري"> شهري </option>
                      <option value="طارق" > طارق </option>
                    </select>
                  </div>
                </div>
              </div>
              <label> وصف الاستحقاق  </label>
              <textarea disabled class="form-control" name="description" rows="4"  required ><?php  if( isset($result['description']) ){ echo $result['description']; } ?></textarea>

              <label> المبلغ </label>
              <div class="input-group">
                <div class="input-group-prepend">
                  </span>
                </div>
                <input disabled type="text" name="amount" class="form-control"  required value="<?php  if( isset($result['amount']) ){ echo $result['amount']; } ?>">
              </div>

              <label> تاريخ الاستحقاق  </label>
              <div class="input-group">
                <div class="input-group-prepend">
                  </span>
                </div>
                <input disabled type="date" name="date" class="form-control"  required value="<?php  if( isset($result['date']) ){ echo $result['date']; } ?>">
              </div>
              
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php } ?>
<!--end add user-->

<?php require_once("footer.php");
}else{
header('Location:index.php ');
}
