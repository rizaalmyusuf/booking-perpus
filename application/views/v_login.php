<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Booking Perpus | Login</title>
        <link href="<?php echo base_url('assets/css/styles.css'); ?>" rel="stylesheet" />
        <script src="<?php echo base_url('assets/js/all.min.js'); ?>"></script>
        <style media="screen">
          body{
            background-image: url("<?php echo base_url('assets/img/bg-login.jpg'); ?>");
            background-size: cover;
            position: relative;
          }
        </style>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-end">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                    <div class="card-body mt-3">
                                        <?php echo form_open('login/cek') ?>
                                      		<span class="text-danger"><?php echo $this->session->flashdata('err'); ?></span>
                                          <div class="form-group"><label class="mb-3" for="un">Username</label><input class="form-control py-4" id="un" type="text" name="username" placeholder="Your username..." autofocus required/></div>
                                          <div class="form-group">
                                            <label class="mb-3  " for="pwd">Password</label>
                                            <input class="form-control py-4" id="pwd" type="password" name="password" placeholder="Your security password..." required/>
                                            <a href="" class="float-right" data-toggle="tooltip" data-placement="right" title="Contact our administrator (rijalmy010600@gmail.com) or your library officer.">Forget password?</a>
                                          </div>
                                          <div class="form-group d-flex align-items-center mt-4 mb-5" style="float:right">
                                            <button type="submit" class="btn btn-primary"><span class="fas fa-sign-in-alt"></span> Login</button>&nbsp;
                                            <button type="reset" class="btn btn-danger"><span class="fas fa-redo-alt"></span> Reset</button>
                                          </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Our Last Destiny's Project</div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="<?php echo base_url('assets/js/jquery-3.4.1.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/bootstrap.bundle.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/scripts.js'); ?>"></script>
        <script>
          $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
          });
        </script>
    </body>
</html>
