<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>
        <meta name="description" content="" />

        <title>KiosKu | Login</title>
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet"/>

        <!-- Icons. Uncomment required icon fonts -->
        <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />
        <script src="https://kit.fontawesome.com/12801238e9.js" crossorigin="anonymous"></script>

        <!-- Core CSS -->
        <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
        <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
        <link rel="stylesheet" href="../assets/css/demo.css" />

        <!--Bootstrap-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link href='https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css' rel='stylesheet'>
        <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js'></script>  
        <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>

        <!-- Vendors CSS & JS -->
        <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
        <link rel="stylesheet" href="../assets/vendor/libs/apex-charts/apex-charts.css" />
        <script src="../assets/vendor/js/helpers.js"></script>
        <script src="../assets/js/config.js"></script>

        <style>
            a{
                text-decoration:none;
            }
            .container .title{
                color:#696Cff;
                font-weight:500;
            }

            .price{
                color:#697A8d;
                font-size:22px !important;
                font-weight:bold;
            }
            .percentage{
                font-weight:500;
            }
            .more{
                color:#697A8d; 
                cursor:pointer;
            }

            label{
                color:#566A7F !important;
            }

            .btn-primary{
                background:#676AFB;
            }

            .btn-primary:hover{
                background:#3d40f5;
            }

            button{
                border-radius:10px !important;
                padding: 10px 10px 10px !important;
            }

            .btn-link {
                color:#676AFB !important; 
                font-weight:500; 
                cursor:pointer;
                padding:6px 10px;
                margin-top:-5px;
                border-radius:6px;
            }
            .btn-link:hover{
                background:#676AFB;
                color:whitesmoke !important;
            }

            @media screen and (max-width: 1000px) {
                .landing-image{
                    display:none;
                }
            }
        </style>
    </head>

    <body>
        <div class="layout-wrapper layout-content-navbar">
            <div class="row p-0 m-0 w-100">
                <div class="col-lg-6 landing-image">
                    <img class="img img-fluid d-block mx-auto mt-5" src="{{asset('assets/img/storyset/Landing-1.png')}}" alt="Landing-1.png" style="height:80vh; width:85vh;">
                </div>
                <div class="col-lg-6">
                    <div class="layout-container login-box d-block mx-auto p-4 text-center mx-1 position-relative">
                        <h2 class="app-brand-text demo menu-text fw-bolder mt-4" style="color:#676AFB;">Selamat datang, di KiosKu</h2>
                        <p class="text-secondary mb-5" style="font-weight:500;">Silahkan masuk menggunakan email dan password untuk menggunakan aplikasi ini</p>
                        <form method="POST" action="login" class="d-block mx-auto text-start" style="max-width:360px;">
                            @csrf
                            <div class="form-floating mb-4">
                                <input type="username" class="form-control" id="floatingInput" name="username" required>
                                <label for="floatingInput">Username</label>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="password" class="form-control" id="floatingInput" name="password" required>
                                <label for="floatingInput">Password</label>
                            </div>
                            <h6>Role</h6>
                            <div class="row text-start mb-4">
                                <div class="col-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="role" id="role1" value="1">
                                        <label class="form-check-label" for="role1"> Kios</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="role" id="role2" value="2">
                                        <label class="form-check-label" for="role2"> Karyawan</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="role" id="role2" value="3">
                                        <label class="form-check-label" for="role2"> Pelanggan</label>
                                    </div>
                                </div>
                            </div>
                            <a class="btn-link float-end">Lupa Password?</a>
                            <div class="form-check float-start ms-1">
                                <input class="form-check-input" type="checkbox" value="1" style="font-size:18px;" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault" style="font-size:16px; font-weight:400;">Ingat Saya</label>
                            </div>
                            <button type="submit" class="btn btn-primary mt-5 mb-4 shadow w-100 fs-5 border-0"><i class="fa-solid fa-arrow-right-to-bracket"></i> Masuk</button>
                            <a class="text-muted mt-5" style="font-weight:500;">Pengguna baru? <a class="btn-link">Buat Akun</a></a>
                        </form>
                        <a class="btn-link float-start position-absolute" style="bottom:30px; left:30px;" title="Kembali ke pilih role"><i class="fa-solid fa-angles-left"></i> Ganti peran masuk</a>
                    </div>
                </div>
            </div>

            <!-- Overlay -->
            <div class="layout-overlay layout-menu-toggle"></div>
        </div>

        <!--Modal-->
        @include('popup.failed')

        <script>
            function getSubmitButton(){
                
            }
        </script>

        <!-- / Layout wrapper -->
        <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js'></script>   

        <!-- Core JS -->
        <!-- build:js assets/vendor/js/core.js -->
        <script src="../assets/vendor/libs/jquery/jquery.js"></script>
        <script src="../assets/vendor/libs/popper/popper.js"></script>
        <script src="../assets/vendor/js/bootstrap.js"></script>
        <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

        <script src="../assets/vendor/js/menu.js"></script>

        <!-- Vendors JS -->
        <script src="../assets/vendor/libs/apex-charts/apexcharts.js"></script>

        <!-- Main JS -->
        <script src="../assets/js/main.js"></script>

        <!-- Page JS -->
        <script src="../assets/js/dashboards-analytics.js"></script>

        <!-- Place this tag in your head or just before your close body tag. -->
        <script async defer src="https://buttons.github.io/buttons.js"></script>
    </body>
</html>
