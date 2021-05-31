<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Booking Perpus | Officer</title>
        <link href="<?php echo base_url(); ?>assets/css/styles.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>assets/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="<?php echo base_url(); ?>assets/js/all.min.js" crossorigin="anonymous"></script>
        <style media="screen">
          body{
            background-image: url("<?php echo base_url('assets/img/bg-main.png'); ?>");
            background-size: cover;
            position: relative;
          }
        </style>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="<?php echo base_url(); ?>">Staff Perpustakaan</a><button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
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
                              <div class="sb-nav-link-icon"><i class="fas fa-clipboard-check"></i></div>Konfirmasi
                            </a>
                            <a class="nav-link" href="<?php echo base_url('petugas/books'); ?>">
                              <div class="sb-nav-link-icon"><i class="fas fa-book"></i></div>Daftar Buku
                            </a>
                            <a class="nav-link" href="<?php echo base_url('login/logout'); ?>">
                              <div class="sb-nav-link-icon"><i class="fas fa-sign-out-alt"></i></div>Keluar
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
                    <div class="container-fluid">
                        <h1 class="mt-4"><i class="fas fa-clipboard-check"></i> Konfirmasi</h1>
                        <?php
                          if ($this->session->flashdata('err')) {
                            ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                              <strong>Gagal!</strong> <?php echo $this->session->flashdata('err')?>
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <?php
                          }else if ($this->session->flashdata('warn')) {
                            ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                              <strong>Perhatian!</strong> <?php echo $this->session->flashdata('warn')?>
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <?php
                          }else if ($this->session->flashdata('succ')) {
                            ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                              <strong>Sukses!</strong> <?php echo $this->session->flashdata('succ')?>
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <?php
                          }
                        ?>
                        <div class="table-responsive mt-2">
                          <table class="table" id="dataTable" width="100%" cellspacing="0">
                              <thead class="thead-dark">
                                  <tr>
                                    <th>Check In</th>
                                    <th>Kode Reservasi</th>
                                    <th>Nama Penuh</th>
                                  </tr>
                              </thead>
                              <tfoot class="thead-dark">
                                  <tr>
                                    <th>Check In</th>
                                    <th>Kode Reservasi</th>
                                    <th>Nama Penuh</th>
                                  </tr>
                              </tfoot>
                              <tbody>
                                <?php foreach ($reservation as $row ): ?>
                                  <tr>
                                    <td><?php echo $row->check_in; ?></td>
                                    <td><?php echo $row->reservation_code; ?></td>
                                    <td>
                                      <?php echo $row->fullname;
                                        if ($row->status=='PENDING') {
                                          ?>
                                            <a class="btn btn-success float-right" href="<?php echo base_url('petugas/konfirmasi/'.$row->reservation_code.'/in') ?>" onclick="return confirm('Are you sure?')" title="Confirm" role="button"><i class="fas fa-sign-in-alt"></i> Check In</a>
                                          <?php
                                        }elseif ($row->status=='IN') {
                                          ?>
                                            <a class="btn btn-danger float-right" href="<?php echo base_url('petugas/konfirmasi/'.$row->reservation_code.'/out') ?>" onclick="return confirm('Are you sure?')" title="Confirm" role="button"><i class="fas fa-sign-out-alt"></i> Check Out</a>
                                          <?php
                                        }
                                      ?>
                                    </td>
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
                            <div class="text-muted">Copyright &copy; Our Last Destiny's 2021</div>
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
