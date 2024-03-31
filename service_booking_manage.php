<?php

include '../config.php';

$admin = new Admin();

if (!isset($_SESSION['labour_id'])) {
  header("location:login_front.php");
  //$_SESSION is from admin loginback.php page
  //checks admin login d or not, otherwise it will redirect to login page
}

$s_variable = $_SESSION['labour_id']; //assigning session to variable

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Doctor token manage</title>
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

          <!-- 🟡doctor entering days token limit -->
          <!-- <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">tokens Limit</h4>

                <form class="forms-sample" method="POST" action="controller/booking_controller.php" enctype="multipart/form-data">

                  <div class="form-group row">
                    <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Todays total tokens</label>
                    <div class="col-sm-9">
                      <input type="number" name="number_limit" class="form-control" id="exampleInputUsername2" placeholder="Enter total number of tokens">
                    </div>
                  </div>

                  <button type="submit" name="token_limit" class="btn btn-primary mr-2">Submit</button>
                </form>

              </div>
            </div>
          </div> -->

          <!-- 🟡displaying booking details starts-->
          <div class="col-lg-12 grid-margin stretch-card" id="token_table_ajax">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Service Booking details</h4>
                <!-- <a href="controller/booking_controller.php?cancel_remaining_tokens" class="btn btn-danger mr-2">Cancel remaining tokens</a> -->

                <div class="table-responsive">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>Client Name</th>
                        <th>email</th>
                        <th>date</th>
                        <th>booking status</th>
                        <th>Action</th>
                        <th>delete</th>
                      </tr>
                    </thead>
                    <tbody>

                      <!--table data starts -->
                      <?php $query = $admin->ret("SELECT * FROM ((`booking` INNER JOIN `labour` ON booking.labour_idb = labour.labour_id)INNER JOIN `client` ON booking.client_idb = client.client_id) where `labour_idb`=$s_variable  ORDER BY `booking_date`;");
                      while ($row = $query->fetch(PDO::FETCH_ASSOC)) { ?>
                        <tr>
                          <td><?php echo $row['client_name'] ?></td>
                          <td><?php echo $row['email'] ?></td>
                          <td><?php echo $row['booking_date'] ?></td>
                          <td><?php echo $row['booking_status'] ?></td>

                          <?php if ($row['booking_status'] == 'booked') { ?>
                            <td><a type="button" href="controller/booking_controller.php?accept_request=<?php echo $row['booking_id'] ?>" class="btn btn-warning btn-rounded btn-fw">Accept request</a></td>
                            <td><a type="button" class="btn btn-danger btn-rounded btn-fw" href="controller\booking_controller.php?delete_booking_id=<?php echo $row['booking_id'] ?>" onclick="return confirm('Are you sure you want to delete?');">Delete</a></td>

                          <?php } elseif ($row['booking_status'] == 'request accepted') { ?>
                            <form action="controller/booking_controller.php" method="POST">
                              <div class="col-sm-9">
                                <td><input type="text" name="service_charge" class="form-control" id="exampleInputUsername2" placeholder="Enter service charge" style="color:black;" required></td>
                              </div>

                              <!-- sending booking id as hidden -->
                              <input type="hidden" name="booking_id" value="<?php echo $row['booking_id'] ?>">

                              <td><input type="submit" class="btn btn-primary btn-rounded btn-fw" name="service_completed" value="Mark as completed"></td>
                            </form>

                          <?php } elseif ($row['booking_status'] == 'service completed') { ?>
                            <td><a type="button" class="btn btn-success btn-rounded btn-fw" href="">Service completed</a></td>
                            <td><b>Service charge: </b><?php echo $row['service_charge'] ?> RS</td>

                            <!-- payment status if condition starts -->
                            <?php if ($row['payment_status'] == 'pending') { ?>
                              <td><b style="color:red">payment pending </b></td>
                            <?php } else { ?>
                              <td><b style="color:green">Paid </b></td>
                            <?php } ?>
                            <!-- payment status if condition ends -->


                          <?php } ?>
                          <!--if condition ends-->


                        </tr>
                      <?php } ?>
                      <!--while loop ends-->
                      <!--table data ends-->
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <!-- 🟡displaying booking details ends-->


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