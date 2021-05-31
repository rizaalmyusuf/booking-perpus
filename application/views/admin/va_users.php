<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Booking Perpus | Admin</title>
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
            <a class="navbar-brand" href="<?php echo base_url(); ?>">Administrator</a><button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
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
                              <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>Pengguna
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
                        <h1 class="mt-4"><i class="fas fa-users"></i> Manajemen Pengguna</h1>
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
                              <strong>Berhasil!</strong> <?php echo $this->session->flashdata('succ')?>
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <?php
                          }
                        ?>
                        <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#modalCreateTeacher"><i class="fas fa-asterisk"></i> Buat Akun Baru </button><br>
                        <div class="modal fade" id="modalCreateTeacher" tabindex="-1" role="dialog" aria-labelledby="modalCreateTeacherTitle" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <form action="<?php echo base_url('admin/createUserConfirm'); ?>" method="post">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="modalCreateTeacherTitle"><i class="fas fa-asterisk"></i> Create a new user</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">
                                  <div class="form-group">
                                    <label class="mb-1" for="unId"><i class="fas fa-user"></i> Username</label>
                                    <input class="form-control py-4" id="unId" type="text" name="un" placeholder="Masukan Username User.." required/>
                                  </div>
                                  <div class="form-group">
                                    <label class="mb-1" for="pwdId"><i class="fas fa-user-lock"></i> Password</label>
                                    <input class="form-control py-4" id="pwdId" type="password" name="pwd" placeholder="Masukan Password Pengguna disini.." required/>
                                  </div>
                                  <div class="form-group">
                                    <label class="mb-1" for="idnId"><i class="fas fa-user-lock"></i> Nomor Identifikasi</label>
                                    <input class="form-control py-4" id="idnId" type="number" min="1" name="idn" placeholder="Masukan nomor ID Pengguna disini" required/>
                                  </div>
                                  <div class="form-group">
                                    <label class="mb-1" for="fnId"><i class="fas fa-user"></i> Nama Penuh</label>
                                    <input class="form-control py-4" id="fnId" type="text" name="fn" placeholder="Masukan Nama Penuh Pengguna" required/>
                                  </div>
                                  <div class="form-group">
                                    <label class="mb-1" for="roleId"><i class="fas fa-flag"></i> Peran</label>
                                    <select class="form-control" name="role" required>
                                      <option value="">- Pilih Peran Pengguna.. -</option>
                                      <option value="lo">Staff Perpustakaan</option>
                                      <option value="cs">Mahasiswa</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-primary"><i class="fas fa-user-plus"></i> Create</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                        <ul class="nav nav-tabs" id="loTab" role="tablist">
                          <li class="nav-item">
                            <a class="nav-link active" id="lo-tab" data-toggle="tab" href="#lo" role="tab" aria-controls="lo" aria-selected="true"><i class="fas fa-user-tie"></i> Staff Perpustakaan</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" id="cs-tab" data-toggle="tab" href="#cs" role="tab" aria-controls="cs" aria-selected="false"><i class="fas fa-user-graduate"></i> Mahasiswa</a>
                          </li>
                        </ul>
                        <div class="tab-content" id="loTabContent">
                          <div class="tab-pane fade show active" id="lo" role="tabpanel" aria-labelledby="lo-tab">
                            <div class="table-responsive mt-2">
                              <table class="table" id="dataTable" width="100%" cellspacing="0">
                                  <thead class="thead-dark">
                                      <tr>
                                          <th>Username</th>
                                          <th>Nomor Identifikasi</th>
                                          <th>Nama Penuh</th>
                                      </tr>
                                  </thead>
                                  <tfoot class="thead-dark">
                                      <tr>
                                          <th>Username</th>
                                          <th>Nomor Identifikasi</th>
                                          <th>Nama Penuh</th>
                                      </tr>
                                  </tfoot>
                                  <tbody>
                                    <?php foreach ($dataUserLO as $row ): ?>
                                      <tr>
                                        <td><a href="#modalOfficerId<?php echo $row->id; ?>" data-toggle="modal" title="Click for details..."><?php echo $row->username; ?></a></td>
                                        <td><?php echo $row->id_number; ?></td>
                                        <td>
                                          <?php echo $row->fullname; ?>
                                          <a class="btn btn-danger btn-sm float-right" href="<?php echo base_url('admin/deleteUserConfirm/lo/').$row->id ?>" onclick="return confirm('Are you sure? This will be delete projects, student groups and phases in this account.')" title="Delete" role="button"><i class="fas fa-trash"></i></a>
                                        </td>
                                        <div class="modal fade" id="modalOfficerId<?php echo $row->id; ?>" tabindex="-1" role="dialog" aria-labelledby="modalOfficerId<?php echo $row->id; ?>Title" aria-hidden="true">
                                          <div class="modal-dialog" role="document">
                                            <form action="<?php echo base_url("admin/editUserConfirm/$row->id"); ?>" method="post">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <h5 class="modal-title" id="modalOfficerId<?php echo $row->id; ?>Title"><i class="fas fa-user-cog"></i> <?php echo $row->fullname; ?></h5>
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                </div>
                                                <div class="modal-body">
                                                  <input type="hidden" name="unOld" value="<?php echo $row->username; ?>" />
                                                  <div class="form-group">
                                                    <label class="mb-1" for="unId<?php echo $row->id ?>"><i class="fas fa-user"></i> Username</label>
                                                    <input class="form-control py-4" id="unId<?php echo $row->id ?>" type="text" name="un" value="<?php echo $row->username; ?>" required/>
                                                  </div>
                                                  <div class="form-group">
                                                    <label class="mb-1" for="pwdId<?php echo $row->id ?>"><i class="fas fa-user-lock"></i> Password</label>
                                                    <input type="hidden" name="oldPwd" value="<?php echo $row->password; ?>">
                                                    <input class="form-control py-4" id="pwdId<?php echo $row->id ?>" type="password" name="pwd" placeholder="Fill this input for renew password..."/>
                                                  </div>
                                                  <div class="form-group">
                                                    <label class="mb-1" for="idnId<?php echo $row->id ?>"><i class="fas fa-user"></i> Nomor Identifikasi</label>
                                                    <input class="form-control py-4" id="idnId<?php echo $row->id ?>" type="text" min="1" name="idn" value="<?php echo $row->id_number; ?>" required/>
                                                  </div>
                                                  <div class="form-group">
                                                    <label class="mb-1" for="fnId<?php echo $row->id ?>"><i class="fas fa-user"></i> Nama Penuh</label>
                                                    <input class="form-control py-4" id="fnId<?php echo $row->id ?>" type="text" name="fn" value="<?php echo $row->fullname; ?>" required/>
                                                  </div>
                                                </div>
                                                <div class="modal-footer">
                                                  <input type="text" name="role" value="lo" readonly hidden>
                                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                  <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
                                                </div>
                                              </div>
                                            </form>
                                          </div>
                                        </div>
                                      </tr>
                                    <?php endforeach; ?>
                                  </tbody>
                              </table>
                            </div>
                          </div>
                          <div class="tab-pane fade" id="cs" role="tabpanel" aria-labelledby="cs-tab">
                            <div class="table-responsive mt-2">
                              <table class="table" id="dataTableCS" width="100%" cellspacing="0">
                                  <thead class="thead-dark">
                                      <tr>
                                          <th>Username</th>
                                          <th>Nomor Identifikasi</th>
                                          <th>Nama Penuh</th>
                                      </tr>
                                  </thead>
                                  <tfoot class="thead-dark">
                                      <tr>
                                          <th>Username</th>
                                          <th>Nomor Identifikasi</th>
                                          <th>Nama Penuh</th>
                                      </tr>
                                  </tfoot>
                                  <tbody>
                                    <?php foreach ($dataUserCS as $row ): ?>
                                      <tr>
                                        <td><a href="#modalStudentId<?php echo $row->id; ?>" data-toggle="modal" title="Click for details..."><?php echo $row->username; ?></a></td>
                                        <td><?php echo $row->id_number; ?></td>
                                        <td>
                                          <?php echo $row->fullname; ?>
                                          <a class="btn btn-danger btn-sm float-right" href="<?php echo base_url('admin/deleteUserConfirm/cs/').$row->id ?>" onclick="return confirm('Are you sure? This will be delete projects, student groups and phases in this account.')" title="Delete" role="button"><i class="fas fa-trash"></i></a>
                                        </td>
                                        <div class="modal fade" id="modalStudentId<?php echo $row->id; ?>" tabindex="-1" role="dialog" aria-labelledby="modalStudentId<?php echo $row->id; ?>Title" aria-hidden="true">
                                          <div class="modal-dialog" role="document">
                                            <form action="<?php echo base_url("admin/editUserConfirm/$row->id"); ?>" method="post">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <h5 class="modal-title" id="modalStudentId<?php echo $row->id; ?>Title"><i class="fas fa-user-cog"></i> <?php echo $row->fullname; ?></h5>
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                </div>
                                                <div class="modal-body">
                                                  <input type="hidden" name="unOld" value="<?php echo $row->username; ?>" />
                                                  <div class="form-group">
                                                    <label class="mb-1" for="unId<?php echo $row->id ?>"><i class="fas fa-user"></i> Username</label>
                                                    <input class="form-control py-4" id="unId<?php echo $row->id ?>" type="text" name="un" value="<?php echo $row->username; ?>" required/>
                                                  </div>
                                                  <div class="form-group">
                                                    <label class="mb-1" for="pwdId<?php echo $row->id ?>"><i class="fas fa-user-lock"></i> Password</label>
                                                    <input type="hidden" name="oldPwd" value="<?php echo $row->password; ?>">
                                                    <input class="form-control py-4" id="pwdId<?php echo $row->id ?>" type="password" name="pwd" placeholder="Fill this input for renew password..."/>
                                                  </div>
                                                  <div class="form-group">
                                                    <label class="mb-1" for="idnId<?php echo $row->id ?>"><i class="fas fa-user"></i> Nomor Identifikasi</label>
                                                    <input class="form-control py-4" id="idnId<?php echo $row->id ?>" type="text" min="1" name="idn" value="<?php echo $row->id_number; ?>" required/>
                                                  </div>
                                                  <div class="form-group">
                                                    <label class="mb-1" for="fnId<?php echo $row->id ?>"><i class="fas fa-user"></i> Nama Penuh</label>
                                                    <input class="form-control py-4" id="fnId<?php echo $row->id ?>" type="text" name="fn" value="<?php echo $row->fullname; ?>" required/>
                                                  </div>
                                                </div>
                                                <div class="modal-footer">
                                                  <input type="text" name="role" value="cs" readonly hidden>
                                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                  <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
                                                </div>
                                              </div>
                                            </form>
                                          </div>
                                        </div>
                                      </tr>
                                    <?php endforeach; ?>
                                  </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Our Last Destiny's Corporation 2021</div>
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
