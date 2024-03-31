<?php

include '../config.php';

$admin = new Admin();

if (!isset($_SESSION['labour_id'])) { //$_SESSION is from admin loginback.php page
  header("location:login_front.php");
}

$s_variable = $_SESSION['labour_id']; //assigning session to variable
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Service update</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="assets/vendors/feather/feather.css">
  <link rel="stylesheet" href="assets/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="assets/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" type="text/css" href="assets/js/select.dataTables.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="assets/css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="assets/images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <!-- 1. container scroller starts -->

    <?php include 'header.php' ?>
    <!--  # navbar / header -->

    <div class="container-fluid page-body-wrapper">
      <!--2. body wrapper starts-->
      <?php include 'sidebar.php' ?>
      <!--  #  sidebar   # -->

      <div class="main-panel">
        <!--3. main panel starts-->
        <div class="content-wrapper">
          <!-- 4. content wrapper starts-->

          <!-------------🟦MAIN CONTENT STARTS------------>
          <?php
          $id = $_GET['update_service'];  //this is from update button href
          $query = $admin->ret("SELECT * FROM `service`  where `service_id`=" . $id);
          $row = $query->fetch(PDO::FETCH_ASSOC);
          ?>

          <!--table starts-->
          <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Update Service</h4>

                <form class="forms-sample" method="POST" action="controller\service_controller.php" autocomplete="off" enctype="multipart/form-data">

                  <input type="hidden" name="service_id" value="<?php echo $row['service_id'] ?>">

                  <div class="form-group row">
                    <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Service Name</label>
                    <div class="col-sm-9">
                      <input type="text" value="<?php echo $row['service_name'] ?>" name="service_name" class="form-control" id="exampleInputUsername2" placeholder="Service name">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Service price</label>
                    <div class="col-sm-9">
                      <input type="text" value="<?php echo $row['service_price'] ?>" name="service_price" class="form-control" id="exampleInputUsername2" placeholder="Service price">
                    </div>
                  </div>


                  <div class="form-group row">
                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">File upload</label>
                    <div class="col-sm-9">
                      <input type="file" name="image">
                    </div>
                  </div>

                  <!--sending old image as hidden-->
                  <input type="hidden" value="<?php echo $row['service_imagedb'] ?>" name="img">

                  <button type="submit" name="update_service" class="btn btn-primary mr-2">Submit</button>
                  <a class="btn btn-light" href="service_manage.php">Cancel</a>
                </form>
              </div>
            </div>
          </div>
          <!--table ends-->

          <!-----------🟦MAIN CONTENT ENDS------------------>

        </div>
        <!--content wrapper ends-->
        <?php include 'footer.php' ?>
        <!-- #   footer # -->

      </div>
      <!--main panel ends-->
    </div>
    <!--body wrapper ends-->
  </div>
  <!--container scroller ends-->

  <!-- javascript ------------------------------------------------------------->
  <!-- plugins:js -->
  <script src="assets/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="assets/vendors/chart.js/Chart.min.js"></script>
  <script src="assets/vendors/datatables.net/jquery.dataTables.js"></script>
  <script src="assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
  <script src="assets/js/dataTables.select.min.js"></script>

  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="assets/js/off-canvas.js"></script>
  <script src="assets/js/hoverable-collapse.js"></script>
  <script src="assets/js/template.js"></script>
  <script src="assets/js/settings.js"></script>
  <script src="assets/js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="assets/js/dashboard.js"></script>
  <script src="assets/js/Chart.roundedBarCharts.js"></script>
  <!-- End custom js for this page-->
</body>

</html>