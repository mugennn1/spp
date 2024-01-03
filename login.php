<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Sistem informasi pembayaran (SIP)</title>

        <!-- Google Font: Source Sans Pro -->
        <link
            rel="stylesheet"
            href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="./plugins/fontawesome-free/css/all.min.css">
        <!-- icheck bootstrap -->
        <link
            rel="stylesheet"
            href="./plugins/icheck-bootstrap/icheck-bootstrap.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="./dist/css/adminlte.min.css">
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <!-- /.login-logo -->
            <div class="card card-outline card-secondary">
                <div class="card-header text-center">
                    <a href="" class="h1">
                        <b>Sistem Informasi</b> Pembayaran</a>
                </div>
                <div class="card-body">
                    <ul class="nav nav-pills">
                        <li class="nav-item md-6">
                            <a class="nav-link md-6" href="#siswa" data-toggle="tab"> <i class="fas fa-user"></i> Siswa</a>
                        </li>
                        <li class="nav-item md-6">
                            <a class="nav-link md-6" href="#manajemen" data-toggle="tab"> <i class="fas fa-user-shield"></i> Manajemen</a>
                        </li>
                    </ul>
                    
                    <div class="tab-content">
                        <div class="active tab-pane" id="siswa">
                        <p class="login-box-msg">Login Siswa (Menggunakan Nis & Email)</p>

                        <form action="aksi/siswa.php" method="post">
                            <input type="hidden"  name="aksi" value="login">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control"  name="nis" placeholder="Masukan NIS">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-user"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="password" class="form-control" placeholder="Password" name="email">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-lock"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-8">
                                        <div class="icheck-primary">
                                            <input type="checkbox" id="remember">
                                            <label for="remember">
                                                Remember Me
                                            </label>
                                        </div>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-4">
                                        <button type="submit" class="btn btn-secondary btn-block">Sign In</button>
                                    </div>
                                    <!-- /.col -->
                                </div>
                        </form>
                        <!--- Konten Siswa -->
                        </div>
                        <div class="tab-pane" id="manajemen">
                            <p class="login-box-msg">Login Manajemen</p>

                                <form action="aksi/user.php" method="post">
                                    <input type="hidden"  name="aksi" value="login">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control"  name="username" placeholder="username" required>
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-user"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <input type="password" class="form-control" placeholder="Password" name="password">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-lock"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="icheck-primary">
                                                    <input type="checkbox" id="remember">
                                                    <label for="remember">
                                                        Remember Me
                                                    </label>
                                                </div>
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-4">
                                                <button type="submit" class="btn btn-secondary btn-block">Sign In</button>
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                </form>
                        </div>
                    </div>
                    
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.login-box -->

        <!-- jQuery -->
        <script src="./plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="./plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="./dist/js/adminlte.min.js"></script>
    </body>
</html>