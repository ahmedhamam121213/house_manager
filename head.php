<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    login
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <!-- CSS Files -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="assets/css/paper-kit.css?v=2.2.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="assets/demo/demo.css" rel="stylesheet" />
</head>

<body class="register-page sidebar-collapse">
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg fixed-top navbar-transparent " color-on-scroll="300">
    <div class="container">
      <div class="navbar-translate">
        <a class="navbar-brand" href="home.php?action=view&id=<?php echo $_SESSION['id']; ?>" rel="tooltip" title="Coded by Creative Tim" data-placement="bottom" >
          ادارة المنزل
        </a>

       
        


        <button class="navbar-toggler navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-bar bar1"></span>
          <span class="navbar-toggler-bar bar2"></span>
          <span class="navbar-toggler-bar bar3"></span>
        </button>
      </div>
      <div class="collapse navbar-collapse justify-content-end" id="navigation">
        <ul class="navbar-nav">

          <li class="nav-item">
            <a href="add_estehkakat.php?action=add" class="nav-link"> اضافة مستحق  </a>
          </li>

          <li class="nav-item">
            <a href="add_credit.php?action=add" class="nav-link"> اضافة دفعة </a>
          </li>

          <li class="nav-item">
            <a href="add_credit.php?action=view" class="nav-link"> عرض الدفعات المسبقة  </a>
          </li>

          <li class="nav-item">
            <a href="add_estehkakat.php?action=view_mostahak" class="nav-link"> عرض المستحقات  </a>
          </li>

          <li class="nav-item">
            <a href="masrofat.php?action=view" class="nav-link">تسجيل المصروفات  </a>
          </li>

          <li class="nav-item">
            <a href="masrofat_range.php" class="nav-link">تقرير المصروفات  </a>
          </li>  

          <li class="nav-item">
            <a href="logout.php" class="nav-link"> خروج</a>
          </li>          
         
        </ul>
      </div>
    </div>
  </nav>
  <!-- End Navbar -->
