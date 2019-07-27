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


<!--start view credit-->
  <?php if( isset( $_GET['action'] )  && $_GET['action'] == 'view' && isset( $_GET['id'] ) ){
  $id = $_GET['id'];
  $sql =  $db->prepare(" SELECT * from dofaat WHERE id = \"$id\"  ");
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
            <h2 class="text-center"> عرض دفعة سابقة</h2>

            <form class="contact-form" method="post" enctype="multipart/form-data">
              <div class="row">
                <div class="col-md-12">
                  <label> المبلغ المدفوع </label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      </span>
                    </div>
                    <input type="text" name="amount" class="form-control"  disabled value="<?php if( isset($result['amount']) ){ echo $result['amount']; } ?>">
                  </div>
                </div>
               
              </div>
              <label> وصف الدفعة </label>
              <textarea class="form-control" name="description" rows="4"  disabled><?php if( isset($result['description']) ){ echo $result['description']; } ?></textarea>


              <label> رقم الشقة</label>

              <div class="input-group">
                <div class="input-group-prepend">
                  </span>
                </div>
                <input name="house_number" class="form-control" disabled value="<?php if( isset($result['house_number']) ){ echo $result['house_number']; } ?>">
                  
                 
                
                
              </div>


              <label> تاريخ الدفع </label>
              <div class="input-group">
                <div class="input-group-prepend">
                  </span>
                </div>
                <input type="date" name="date" class="form-control"  disabled value="<?php if( isset($result['date']) ){ echo $result['date']; } ?>">
              </div>
              

              <div class="row">
                <div class="ml-auto mr-auto">
                 
                  
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php } ?>
<!--end view credit-->

<?php require_once("footer.php");
}else{
header('Location:index.php ');
}
