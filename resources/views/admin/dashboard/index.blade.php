<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>
        <meta name="description" content="" />

        <title>Admin | Dashboard</title>
        
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
            .dash-content #dash-content-flters {
                list-style: none;
                margin-bottom: 20px;
            }
            .dash-content #dash-content-flters li {
                cursor: pointer;
                display: inline-block;
                margin: 0 10px 10px 10px;
                font-size: 15px;
                font-weight: 600;
                line-height: 1;
                padding: 7px 10px;
                text-transform: uppercase;
                color: #444444;
                transition: all 0.3s ease-in-out;
                border: 2px solid #fff;
            }
            .dash-content #dash-content-flters li:hover, .dash-content #dash-content-flters li.filter-active {
                color: #f3a200;
                border-color: #ffb727;
            }
            .dash-content .dash-content-item {
                margin-bottom: 30px;
            }
            .dash-content .dash-content-item .dash-content-img {
                overflow: hidden;
            }
            .dash-content .dash-content-item .dash-content-img img {
                transition: all 0.8s ease-in-out;
            }
            .dash-content .dash-content-item .dash-content-info {
                opacity: 0;
                position: absolute;
                left: 15px;
                bottom: 0;
                z-index: 3;
                right: 15px;
                transition: all ease-in-out 0.3s;
                background: rgba(0, 0, 0, 0.5);
                padding: 10px 15px;
            }
            .dash-content .dash-content-item .dash-content-info h4 {
                font-size: 18px;
                color: #fff;
                font-weight: 600;
                color: #fff;
                margin-bottom: 0px;
            }
            .dash-content .dash-content-item .dash-content-info p {
                color: rgba(255, 255, 255, 0.8);
                font-size: 14px;
                margin-bottom: 0;
            }
            .dash-content .dash-content-item .dash-content-info .preview-link, .dash-content .dash-content-item .dash-content-info .details-link {
                position: absolute;
                right: 40px;
                font-size: 24px;
                top: calc(50% - 18px);
                color: #fff;
                transition: 0.3s;
            }
            .dash-content .dash-content-item .dash-content-info .preview-link:hover, .dash-content .dash-content-item .dash-content-info .details-link:hover {
                color: #ffc041;
            }
            .dash-content .dash-content-item .dash-content-info .details-link {
                right: 10px;
            }
            .dash-content .dash-content-item:hover .dash-content-img img {
                transform: scale(1.2);
            }
            .dash-content .dash-content-item:hover .dash-content-info {
                opacity: 1;
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
        </style>
    </head>

    <body>
        <div class="layout-wrapper layout-content-navbar">
            <div class="layout-container">
                <!--Sidebar-->
                @include('admin.sidebar')

                <!-- Layout container -->
                <div class="layout-page">
                    <!-- Navbar -->
                    <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center"
                      id="layout-navbar">
                        <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                              <i class="bx bx-menu bx-sm"></i>
                            </a>
                        </div>          
                        <a class="fw-bold float-start">/Dashboard</a>   
                        <a class="fw-bold float-end">Flazefy</a>   
                    </nav>

                    <!-- Content wrapper -->
                    <div class="content-wrapper p-3">
                        <section id="dash-content" class="dash-content">
                            <div class="container">
                                <div class="row dash-content-container">
                                    <div class="col-lg-2 col-md-3 dash-content-item">
                                        @include('admin.dashboard.penjualan')
                                    </div>
                                    <div class="col-lg-2 col-md-3 dash-content-item">
                                        @include('admin.dashboard.keuntungan')
                                    </div>
                                    <div class="col-lg-2 col-md-3 dash-content-item">
                                        @include('admin.dashboard.pengunjung')
                                    </div>
                                    <div class="col-lg-2 col-md-3 dash-content-item">
                                        @include('admin.dashboard.skor')
                                    </div>
                                    <div class="col-lg-4 col-md-6 dash-content-item">
                                        @include('admin.dashboard.kalender')
                                    </div>
                                    <div class="col-lg-4 col-md-6 dash-content-item">
                                        @include('admin.dashboard.terjual')
                                    </div>
                                    <div class="col-lg-4 col-md-6 dash-content-item">
                                        @include('admin.dashboard.riwayat')
                                    </div>
                                    <div class="col-lg-4 col-md-6 dash-content-item">
                                        @include('admin.dashboard.grafik.keuntungan')
                                    </div>
                                    <div class="col-lg-4 col-md-6 dash-content-item">
                                        <div class="container-fluid p-3 rounded shadow h-100">

                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 dash-content-item">
                                        <div class="container-fluid p-3 rounded shadow h-100">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>

                </div>
            </div>

            <!-- Overlay -->
            <div class="layout-overlay layout-menu-toggle"></div>
        </div>
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
