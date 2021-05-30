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
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="<?php echo base_url(); ?>">Library Officer</a><button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto"></ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="<?php echo base_url(); ?>">
                              <div class="sb-nav-link-icon"><i class="fas fa-clipboard-check"></i></div>Konfirmasi
                            </a>
                            <a class="nav-link active" href="<?php echo base_url('t/books'); ?>">
                              <div class="sb-nav-link-icon"><i class="fas fa-book"></i></div>Book List
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
                    <div class="container-fluid">
                        <h1 class="mt-4"><i class="fas fa-book"></i> Book List</h1>
                        <?php
                          if ($this->session->flashdata('err')) {
                            ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                              <strong>Failed!</strong> <?php echo $this->session->flashdata('err')?>
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <?php
                          }else if ($this->session->flashdata('warn')) {
                            ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                              <strong>Warning!</strong> <?php echo $this->session->flashdata('warn')?>
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <?php
                          }else if ($this->session->flashdata('succ')) {
                            ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                              <strong>Success!</strong> <?php echo $this->session->flashdata('succ')?>
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <?php
                          }
                        ?>
                        <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#modalAddBook"><i class="fas fa-asterisk"></i> Add new book</button><br>
                        <div class="table-responsive">
                            <table class="table" id="dataTable" width="100%" cellspacing="0">
                                <thead class="thead-dark">
                                    <tr>
                                      <th>Barcode</th>
                                      <th>Title</th>
                                      <th>Author</th>
                                      <th>Publisher</th>
                                      <th>Genre</th>
                                      <th>Year Released</th>
                                      <th>Borrowed By</th>
                                    </tr>
                                </thead>
                                <tfoot class="thead-dark">
                                    <tr>
                                      <th>Barcode</th>
                                      <th>Title</th>
                                      <th>Author</th>
                                      <th>Publisher</th>
                                      <th>Genre</th>
                                      <th>Year Released</th>
                                      <th>Borrowed By</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                  <?php foreach ($dataBooks as $row ): ?>
                                    <tr>
                                      <td><?php echo $row->barcode; ?></td>
                                      <td><a href="#modalBookId<?php echo $row->id; ?>" data-toggle="modal" title="Click for details..."><?php echo $row->title; ?></a></td>
                                      <div class="modal fade" id="modalBookId<?php echo $row->id; ?>" tabindex="-1" role="dialog" aria-labelledby="modalBookId<?php echo $row->id; ?>Title" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                          <form action="<?php echo base_url("t/editBookConfirm/$row->id"); ?>" method="post">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <h5 class="modal-title" id="modalBookId<?php echo $row->id; ?>Title"><i class="fas fa-book"></i> <?php echo $row->title; ?></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                              </div>
                                              <div class="modal-body">
                                                <input type="hidden" name="bcOld" value="<?php echo $row->barcode; ?>" />
                                                <div class="form-group">
                                                  <label class="mb-1" for="bc"><i class="fas fa-barcode"></i> Barcode</label>
                                                  <input class="form-control py-4" id="bc" type="text" name="barcode" value="<?php echo $row->barcode; ?>" placeholder="Type book barcode here..." required/>
                                                </div>
                                                <div class="form-group">
                                                  <label class="mb-1" for="title"><i class="fas fa-book"></i> Title</label>
                                                  <input class="form-control py-4" id="title" type="text" name="title" value="<?php echo $row->title; ?>" placeholder="Type book title here..." required/>
                                                </div>
                                                <div class="form-group">
                                                  <label class="mb-1" for="auth"><i class="fas fa-info-circle"></i> Author</label>
                                                  <input class="form-control py-4" id="auth" type="text" name="author" value="<?php echo $row->author; ?>" placeholder="Type book author here..." required/>
                                                </div>
                                                <div class="form-group">
                                                  <label class="mb-1" for="pub"><i class="fas fa-stopwatch"></i> Publisher</label>
                                                  <input class="form-control py-4" id="pub" type="text" name="publisher" value="<?php echo $row->publisher; ?>" placeholder="Type book publiser here..." required/>
                                                </div>
                                                <div class="form-group">
                                                  <label class="mb-1" for="gen"><i class="fas fa-stopwatch"></i> Genre</label>
                                                  <input class="form-control py-4" id="gen" type="text" name="genre" value="<?php echo $row->genre; ?>" placeholder="Type book genre here..." required/>
                                                </div>
                                                <div class="form-group">
                                                  <label class="mb-1" for="y"><i class="fas fa-date"></i> Year Released</label>
                                                  <select class="form-control" id="y" name="year" required>
                                                    <?php for ($i=1900;$i<=2040;$i++) {
                                                      if ($i==$row->year_released) {
                                                        ?><option value="<?php echo $i; ?>" selected><?php echo $i; ?></option> <?php
                                                      } else {
                                                        ?><option value="<?php echo $i; ?>"><?php echo $i; ?></option> <?php
                                                      }
                                                    } ?>
                                                  </select>
                                                </div>
                                              </div>
                                              <div class="modal-footer">
                                                <input type="text" name="role" value="lo" readonly hidden>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary"><i class="fas fa-user-edit"></i> Edit</button>
                                              </div>
                                            </div>
                                          </form>
                                        </div>
                                      </div>
                                      <td><?php echo $row->author; ?></td>
                                      <td><?php echo $row->publisher; ?></td>
                                      <td><?php echo $row->genre; ?></td>
                                      <td><?php echo $row->year_released; ?></td>
                                      <td>
                                        <?php echo $row->fullname; ?>
                                        <a class="btn btn-danger btn-sm float-right" href="<?php echo base_url('t/removeBookConfirm/').$row->id ?>" onclick="return confirm('Are you sure?')" title="Delete" role="button"><i class="fas fa-trash"></i></a>
                                      </td>
                                    </tr>
                                  <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal fade" id="modalAddBook" tabindex="-1" role="dialog" aria-labelledby="modalAddBookTitle" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="modalAddBookTitle"><i class="fas fa-asterisk"></i> Add new book</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              </div>
                              <div class="modal-body">
                                <?php echo form_open_multipart('t/addBookConfirm') ?>
                                  <div class="form-group">
                                    <label class="mb-1" for="bc"><i class="fas fa-barcode"></i> Barcode</label>
                                    <input class="form-control py-4" id="bc" type="text" name="barcode" placeholder="Type book barcode here..." required/>
                                  </div>
                                  <div class="form-group">
                                    <label class="mb-1" for="title"><i class="fas fa-book"></i> Title</label>
                                    <input class="form-control py-4" id="title" type="text" name="title" placeholder="Type book title here..." required/>
                                  </div>
                                  <div class="form-group">
                                    <label class="mb-1" for="auth"><i class="fas fa-info-circle"></i> Author</label>
                                    <input class="form-control py-4" id="auth" type="text" name="author" placeholder="Type book author here..." required/>
                                  </div>
                                  <div class="form-group">
                                    <label class="mb-1" for="pub"><i class="fas fa-stopwatch"></i> Publisher</label>
                                    <input class="form-control py-4" id="pub" type="text" name="publisher" placeholder="Type book publiser here..." required/>
                                  </div>
                                  <div class="form-group">
                                    <label class="mb-1" for="gen"><i class="fas fa-stopwatch"></i> Genre</label>
                                    <input class="form-control py-4" id="gen" type="text" name="genre" placeholder="Type book genre here..." required/>
                                  </div>
                                  <div class="form-group">
                                    <label class="mb-1" for="y"><i class="fas fa-date"></i> Year Released</label>
                                    <select class="form-control" id="y" name="year" required>
                                      <?php for ($i=1900;$i<=2040;$i++) {
                                        if ($i==date('Y')) {
                                          ?><option value="<?php echo $i; ?>" selected><?php echo $i; ?></option> <?php
                                        } else {
                                          ?><option value="<?php echo $i; ?>"><?php echo $i; ?></option> <?php
                                        }
                                      } ?>
                                    </select>
                                  </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary"><i class="fas fa-asterisk"></i> Create</button>
                              </div>
                            </div>
                          </div>
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
