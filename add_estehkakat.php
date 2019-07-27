<?php 
session_start();
if( isset($_SESSION['id']) ){

//connection of data base
require_once("connection.php");


//add user
if(  isset( $_POST['Add-mostahak'] )  ){
  $name = $_POST['name'];
  $type = $_POST['type'];
  $description = $_POST['description'];
  $house_number = $_POST['house_number'];
  $amount = $_POST['amount'];
  $date = $_POST['date'];

  //if user select all houses
  if( $house_number == 'كل الشقق' ){
      

      //fetch all houses list
      $sql =  $db->prepare(" SELECT * from houses");
      $myResult = $sql->execute();
      //calculate number of rows
      $count = $sql->rowCount();

      //calculate avg of every house
      $avg = ( $amount / $count );

      $result = $sql->fetchAll() ;
      foreach( $result as $record ){
        $rec = $record['house_number'];

        //start insertion in data base
        $sql =  $db->prepare( " INSERT INTO estehkakat ( name , type , description , house_number, amount , date ) 
             VALUES (:name,:type,:description,:house_number,:amount,:date)" );
        $bindedParams = array( ":name" => $name , ":type" => $type ,":description" => $description ,":house_number" => $rec , ":amount" => $avg, ":date" => $date  );

        if( $sql->execute( $bindedParams ) ){
          $_SESSION['messege']  = "تمت الاضافة بنجاح";
          header('Location:home.php');
        }  
        //end insertion in data base
        
      }
      
  }
  //if user selected particular house
  else{
    $sql =  $db->prepare( " INSERT INTO estehkakat ( name , type , description , house_number, amount , date ) 
             VALUES (:name,:type,:description,:house_number,:amount,:date)" );
    $bindedParams = array( ":name" => $name , ":type" => $type ,":description" => $description ,":house_number" => $house_number , ":amount" => $amount, ":date" => $date  );

    if( $sql->execute( $bindedParams ) ){
      $_SESSION['messege']  = "تمت الاضافة بنجاح";
      header('Location:home.php');
    } 
  }



          
}
require_once("head.php");
?>
  <div class="page-header page-header-xs" data-parallax="true" style="background-image: url('assets/img/fabio-mangione.jpg');">
    <div class="filter"></div>
  </div>
<!--start add mostahak-->
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
                      </span>
                    </div>
                    <input type="text" name="name" class="form-control"  >
                  </div>
                </div>
                <div class="col-md-6">
                  <label> نوع الاستحقاق  </label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      </span>
                    </div>
                    <select  class="form-control" name="type" >
                      <option value="شهري"> شهري </option>
                      <option value="طارق" > طارق </option>
                    </select>
                    
                  </div>
                </div>
              </div>
              <label> وصف الاستحقاق  </label>
              <textarea class="form-control" name="description" rows="4"  ></textarea>


              <label> اختر الشقة</label>

              <div class="input-group">
                <div class="input-group-prepend">
                  </span>
                </div>
                <select name="house_number" class="form-control" >
                  <option value=""> اختر الشقة </option>
                  <option value="كل الشقق"> كل الشقفق </option>
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

              <label> المبلغ بالجنية </label>
              <div class="input-group">
                <div class="input-group-prepend">
                  </span>
                </div>
                <input type="text" name="amount" class="form-control"  >
              </div>

              <label> تاريخ الاستحقاق  </label>
              <div class="input-group">
                <div class="input-group-prepend">
                  </span>
                </div>
                <input type="date" name="date" class="form-control"  >
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
<!--end add mostahak-->

<!--start view mostahak-->
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
                    <input disabled type="text" name="name" class="form-control"   value="<?php  if( isset($result['name']) ){ echo $result['name']; } ?>">
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
              <textarea disabled class="form-control" name="description" rows="4"   ><?php  if( isset($result['description']) ){ echo $result['description']; } ?></textarea>

              <label> المبلغ </label>
              <div class="input-group">
                <div class="input-group-prepend">
                  </span>
                </div>
                <input disabled type="text" name="amount" class="form-control"   value="<?php  if( isset($result['amount']) ){ echo $result['amount']; } ?>">
              </div>

              <label> تاريخ الاستحقاق  </label>
              <div class="input-group">
                <div class="input-group-prepend">
                  </span>
                </div>
                <input disabled type="date" name="date" class="form-control"   value="<?php  if( isset($result['date']) ){ echo $result['date']; } ?>">
              </div>
              
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php } ?>
<!--end view mostahak-->

<!---->
 <?php if( isset( $_GET['action'] )  && $_GET['action'] == 'view_mostahak' ){?>
  <div class="container">
    <h3> اختر رقم الشقة لعرض المستحقات </h3><br>
    <form method="post" class="choose_form" name="choose_house">
      <select name="house_number" class="select_box form-control" required>
        <option value=""> اختر الشقة</option>
        <?php
        //fetch all houses list
        $sql =  $db->prepare(" SELECT * from houses");
        $all_houses = $sql->execute();
        $all_houses = $sql->fetchAll() ;
        foreach( $all_houses as $house ){
          $rec = $house['house_number'];
          echo "<option value=".$rec.">".$rec."</option>";
        }
        ?>

      </select>
      <br>
      <input type="submit" class="btn btn-primary" name="choose_house" value="ارسل">
      <br><br>
    </form>

    <?php if( isset( $_POST['choose_house'] ) ){
      $num = $_POST['house_number'];

    //get house owner
    $sql =  $db->prepare(" SELECT * from houses WHERE house_number = $num " );
    $myResult = $sql->execute();
    $foundUser = $sql->fetchAll() ;
    $foundUser =  array_shift($foundUser);
    echo "<p> رقم الشقة :  ".$foundUser['house_number']."</p>"; 
    echo "<p> اسم الساكن :  ".$foundUser['house_owner']."</p>";
  
    //get sum of amount of particular house
    $sql =  $db->prepare(" SELECT * from estehkakat WHERE house_number = $num ");
    $myResult = $sql->execute();
    $result = $sql->fetchAll() ;
    
    
    $sum = 0;
    foreach( $result as $record ){
      $sum = ( $sum + $record['amount'] ) ;
      
    }
  
    echo " <p> المبلغ المستحق :  " . $sum . " جنية </p> ";

    //get sum of dofaat of particular house
    $sql =  $db->prepare(" SELECT * from dofaat WHERE house_number = $num ");
    $myResult = $sql->execute();
    $result = $sql->fetchAll() ;
    
    
    $paidSum = 0;
    foreach( $result as $record ){
      $paidSum = ( $paidSum + $record['amount'] ) ;
      
    }
    echo "<p> مجموع الدفعات:  $paidSum جنية</p>"; 
    echo "<br>";

    //fetch data of house depending on select box value  
    $sql =  $db->prepare(" SELECT * from estehkakat WHERE house_number = $num ");
    $myResult = $sql->execute();
    $result = $sql->fetchAll() ;
    ?>
     <!--start table-->
<table class="table users_list">
  <thead>
    <tr>
      
      <th scope="col"> اسم الاستحقاق </th>
      <th scope="col"> نوع الاستحقاق </th>
      <th scope="col"> المبلغ  </th>
      <th scope="col"> تاريخ الاستحقاق </th>
      <th scope="col"> تم سدادها </th>
      <th scope="col"> عمليات </th>
      
    </tr>
  </thead>
  <tbody>
     <?php 
     if( $result ){
    foreach( $result as $record ){ ?>
    <tr>
      <?php

       
       echo "<td>".$record['name']."</td>" ;
       echo "<td>".$record['type']."</td>" ;
       echo "<td>". ($record['amount']) ."</td>" ;
       echo "<td>".$record['date']."</td>" ;
       if( $record['amount'] <= $paidSum ){
          $status = "نعم"; 
          $paidSum = ($paidSum - $record['amount']);
        }else{ $status = "لا";}
       echo "<td>$status</td>";
       echo "<td><a href='add_estehkakat.php?action=view&id=".$record['id']."'>عرض&nbsp;&nbsp;</a>
       <a href='?action=delete&id=".$record['id']."' onclick=\"return confirm('Are you sure you want to delete this item?');\">مسح</a>
       </td>" ;
      ?>
    </tr>
  <?php }} ?>
   
  </tbody>
</table>
<!--end table-->
    <?php

    } ?>
   
  </div>
 <?php } ?>
<!---->

<?php require_once("footer.php");
}else{
header('Location:index.php ');
}
