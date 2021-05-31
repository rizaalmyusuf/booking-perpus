<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Booking Perpus | Student</title>
        <link href="<?php echo base_url(); ?>assets/css/styles.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>assets/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="<?php echo base_url(); ?>assets/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="<?php echo base_url(); ?>">College Student</a><button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto"></ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link active" href="<?php echo base_url(); ?>">
                              <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>Reservation List
                            </a>
                            <a class="nav-link" href="<?php echo base_url('mahasiswa#myReservation'); ?>">
                              <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>My Reservation
                            </a>
                            <a class="nav-link" href="<?php echo base_url('login/logout'); ?>">
                              <div class="sb-nav-link-icon"><i class="fas fa-sign-out-alt"></i></div>Logout
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        <?php echo $_SESSION['fn']; ?>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid" id="myReservation">
                        <h1 class="mt-4">
                          <i class="fas fa-list"></i> Reservation List
                        </h1>
                        <?php
                          if ($this->session->flashdata('err')) {
                            ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                              <strong>Gagal!</strong> <?php echo $this->session->flashdata('err')?>
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <?php
                          }
                          if ($this->session->flashdata('warn')) {
                            ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                              <strong>Perhatian!</strong> <?php echo $this->session->flashdata('warn')?>
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <?php
                          }
                          if ($this->session->flashdata('succ')) {
                            ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                              <strong>Berhasil!</strong> <?php echo $this->session->flashdata('succ')?>
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <?php
                          }
                        ?>
                        <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#modalCreateReservation"><i class="fas fa-asterisk"></i> Create a new reservation</button><br>
                        <div class="modal fade" id="modalCreateReservation" tabindex="-1" role="dialog" aria-labelledby="modalCreateReservationTitle" aria-hidden="true">
                          <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                              <form action="<?php echo base_url('mahasiswa/createReservationConfirm/').$_SESSION['id']; ?>" method="post">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="modalCreateReservationTitle"><i class="fas fa-asterisk"></i> Create a new reservation</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">
                                  <div class="form-group">
                                    <label class="mb-1" for="d"><i class="fas fa-calendar"></i> Check In</label>
                                    <input class="form-control py-4" id="d" type="date" name="date" min="<?php date_default_timezone_set("Asia/Jakarta"); echo date('Y-m-d'); ?>" max="<?php echo date('Y-m-d',strtotime("+1 week")); ?>" value="<?php echo date('Y-m-d'); ?>" required/>
                                  </div>
                                  <div class="form-group">
                                    <label class="mb-1" for="b"><i class="fas fa-book"></i> Book</label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text"><strong>1</strong></span>
                                      </div>
                                      <select class="form-control" id="b" name="book1" required>
                                        <option value="">- Required -</option>
                                        <?php
                                        foreach ($books as $row) {
                                          if (!$row->borrowed_by) {
                                            ?>
                                            <option value="<?php echo $row->id; ?>"><?php echo $row->barcode; ?> - <?php echo $row->title; ?></option>
                                            <?php
                                          }
                                        }
                                        ?>
                                      </select>
                                    </div>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text"><strong>2</strong></span>
                                      </div>
                                      <select class="form-control" id="b" name="book2">
                                        <option value="">- Optional -</option>
                                        <?php
                                        foreach ($books as $row) {
                                          if (!$row->borrowed_by) {
                                            ?>
                                            <option value="<?php echo $row->id; ?>"><?php echo $row->barcode; ?> - <?php echo $row->title; ?></option>
                                            <?php
                                          }
                                        }
                                        ?>
                                      </select>
                                    </div>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text"><strong>3</strong></span>
                                      </div>
                                      <select class="form-control" id="b" name="book3">
                                        <option value="">- Optional -</option>
                                        <?php
                                        foreach ($books as $row) {
                                          if (!$row->borrowed_by) {
                                            ?>
                                            <option value="<?php echo $row->id; ?>"><?php echo $row->barcode; ?> - <?php echo $row->title; ?></option>
                                            <?php
                                          }
                                        }
                                        ?>
                                      </select>
                                    </div>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-primary"><i class="fas fa-asterisk"></i> Create</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-6">
                            <div class="card bg-light mb-3">
                              <div class="card-header"><h4><center>Your Reservation Code</center></h4></div>
                              <div class="card-body py-3">
                                <h4><center><?php
                                  if ($reservation_info) {
                                    echo $reservation_info->reservation_code;
                                  }else{
                                    echo "No available yet.";
                                  }
                                ?></center></h4>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="card bg-light mb-3">
                              <div class="card-header"><h4><center>Name</center></h4></div>
                              <div class="card-body py-3"><h4><center><?php echo $_SESSION['fn']; ?></center></h4>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-12">
                            <div class="card bg-light mb-3">
                              <div class="card-header"><h4><center>Daftar Buku</center></h4></div>
                              <div class="card-body py-3">
                                <div class="table-responsive">
                                  <table class="table" width="100%">
                                    <tr>
                                      <td>Barcode</td>
                                      <td>Title</td>
                                      <td>Author</td>
                                      <td>Publisher</td>
                                      <td>Genre</td>
                                      <td>Released Year</td>
                                      <td>Check In</td>
                                    </tr>
                                    <?php
                                      if ($reserved_books) {
                                        foreach ($reserved_books as $row) {
                                          ?>
                                          <tr>
                                            <td><?php echo $row->barcode; ?></td>
                                            <td><?php echo $row->title; ?></td>
                                            <td><?php echo $row->author; ?></td>
                                            <td><?php echo $row->publisher; ?></td>
                                            <td><?php echo $row->genre; ?></td>
                                            <td><?php echo $row->year_released; ?></td>
                                            <td><?php echo $row->check_in; ?></td>
                                          </tr>
                                          <?php
                                        }
                                      } else {
                                        ?><td colspan="7">No available yet.</td><?php
                                      }
                                    ?>
                                  </table>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="table-responsive mt-2">
                          <table class="table" id="dataTable" width="100%" cellspacing="0">
                              <thead class="thead-dark">
                                  <tr>
                                    <th>Check In</th>
                                    <th>Reservation Code</th>
                                    <th>Fullname</th>
                                    <th>Status</th>
                                  </tr>
                              </thead>
                              <tfoot class="thead-dark">
                                  <tr>
                                    <th>Check In</th>
                                    <th>Reservation Code</th>
                                    <th>Fullname</th>
                                    <th>Status</th>
                                  </tr>
                              </tfoot>
                              <tbody>
                                <?php foreach ($reservation as $row ): ?>
                                  <tr>
                                    <td><?php echo $row->check_in; ?></td>
                                    <td><?php echo $row->reservation_code; ?></td>
                                    <td><?php echo $row->fullname; ?></td>
                                    <td><?php echo $row->status; ?></td>
                                  </tr>
                                <?php endforeach; ?>
                              </tbody>
                          </table>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Our Last Destiny's Project</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="<?php echo base_url(); ?>assets/js/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="<?php echo base_url(); ?>assets/js/scripts.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="<?php echo base_url(); ?>assets/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="<?php echo base_url(); ?>assets/js/datatables-demo.js"></script>
    </body>
</html>
