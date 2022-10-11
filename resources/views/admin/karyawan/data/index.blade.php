<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>
        <meta name="description" content="" />

        <title>Admin | Karyawan | Data</title>
        
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
        <script href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css"></script>

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

            .modal-title{
                color:whitesmoke;
            }
            .modal-header{
                background:#676AFB;
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

            /*Scrollbar*/
            .custom-scroll::-webkit-scrollbar-track
            {
                -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
                border-radius: 10px;
                background-color: #F5F5F5;
            }

            .custom-scroll::-webkit-scrollbar
            {
                width: 12px;
                background-color: #F5F5F5;
            }

            .custom-scroll::-webkit-scrollbar-thumb
            {
                border-radius: 10px;
                -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
                background-color: #696CFF;
            }

            .btn-primary{
                background: #676AFA;
                border: none;
            }
            .btn-primary:hover{
                background: #4144f0;
                border: none;
            }

            .btn-outlined, .btn-outlined:hover{
                color: #676AFA;
                border: 2px solid #676AFA;
            }

            .text-primary{
                color: #676AFB !important;
            }
        </style>
    </head>

    <body>
        <div class="layout-wrapper layout-content-navbar">
            <div class="layout-container">
                <!--Sidebar-->
                @include('admin.sidebar')

                <div class="layout-page">
                    <!-- Navbar -->
                    <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center"
                    id="layout-navbar">
                        <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                            <i class="bx bx-menu bx-sm"></i>
                            </a>
                        </div>          
                        <a class="fw-bold float-start">/Karyawan/Data</a>   
                        <!-- Search -->
                        @include('others.search')
                    </nav>

                    <!-- Content wrapper -->
                    <div class="content-wrapper p-3">
                        <div class="container-xxl flex-grow-1 container-p-y">
                            <div class="row">
                                <div class="col-md-12">
                                    <ul id="data-flters" class="nav nav-pills flex-column flex-md-row mb-3">
                                        <li class="nav-item">
                                            <button class="btn btn-success h-100 me-2" data-bs-toggle="modal" data-bs-target="#tambah-karyawan-Modal">
                                                <i class="fa-solid fa-plus"></i> Tambah Karyawan</button>
                                        </li>
                                        <li class="nav-item">
                                            <button class="btn btn-success h-100 me-2" data-bs-toggle="modal" data-bs-target="#tambah-jabatan-Modal">
                                                <i class="fa-solid fa-plus"></i> Tambah Jabatan</button>
                                        </li>
                                        <li class="nav-item">
                                            <button class="btn btn-primary h-100 me-2" data-bs-toggle="modal" data-bs-target="#tambah-karyawan-Modal">
                                                <i class="fa-solid fa-print"></i> Cetak Semua</button>
                                        </li>
                                        <li class="nav-item filter-active" data-filter="*">
                                            <button class="btn btn-outlined h-100 me-2"> Semua</button>
                                        </li>
                                        <li class="nav-item filter-active" data-filter=".filter-tandai">
                                            <button class="btn btn-outlined h-100 me-2"> Di Tandai</button>
                                        </li>
                                        @foreach($jabatan as $jb)
                                            <li class="nav-item"  data-filter=".filter-{{str_replace(' ', '', $jb->nama_jabatan)}}">
                                                <button class="btn btn-outlined h-100 me-2">{{$jb->nama_jabatan}}</button>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <ul id="myUL" class="p-0 data-container">
                                        @foreach($karyawan as $kr)
                                            @include('admin.karyawan.data.all')

                                            <!--Modal-->
                                            @include('admin.karyawan.data.form.hapus_karyawan')
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>

            <!-- Overlay -->
            <div class="layout-overlay layout-menu-toggle"></div>
        </div>
        <!-- / Layout wrapper -->

        <!--Modal-->
        @include('popup.success')
        @include('popup.failed')
        @include('admin.karyawan.data.form.tambah_karyawan')
        @include('admin.karyawan.data.form.tambah_jabatan')

        <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js'></script>   

        <script>
            //Image upload preview.
            <?php
                foreach($karyawan as $kr){
                    echo "
                    function previewEditAcc".$kr->id."() {
                        frame".$kr->id.".src = URL.createObjectURL(event.target.files[0]);
                    }
                    document.getElementById('formFileEditAcc".$kr->id."').onchange = function() {
                        document.getElementById('formImage".$kr->id."').submit();
                    };";
                }
            ?>
            
            //Isotope and data-filter
            (function() {
                "use strict";
                const select = (el, all = false) => {
                    el = el.trim()
                    if (all) {
                    return [...document.querySelectorAll(el)]
                    } else {
                    return document.querySelector(el)
                    }
                }

                const on = (type, el, listener, all = false) => {
                    let selectEl = select(el, all)
                    if (selectEl) {
                    if (all) {
                        selectEl.forEach(e => e.addEventListener(type, listener))
                    } else {
                        selectEl.addEventListener(type, listener)
                    }
                    }
                }
                
                window.addEventListener('load', () => {
                    let portfolioContainer = select('.data-container');
                    if (portfolioContainer) {
                    let portfolioIsotope = new Isotope(portfolioContainer, {
                        itemSelector: '.data-item'
                    });

                    let portfolioFilters = select('#data-flters li', true);

                    on('click', '#data-flters li', function(e) {
                        e.preventDefault();
                        portfolioFilters.forEach(function(el) {
                        el.classList.remove('filter-active');
                        });
                        this.classList.add('filter-active');

                        portfolioIsotope.arrange({
                        filter: this.getAttribute('data-filter')
                        });

                    }, true);
                    }

                });
            })()
        </script>

        <!-- Core JS -->
        <!-- build:js assets/vendor/js/core.js -->
        <script src="../assets/vendor/libs/popper/popper.js"></script>
        <script src="../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
        <script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>
        <script src="../assets/vendor/waypoints/noframework.waypoints.js"></script>
        <script src="../assets/vendor/js/bootstrap.js"></script>
        <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

        <script src="../assets/vendor/js/menu.js"></script>

        <!-- Vendors JS -->
        <script src="../assets/vendor/libs/apex-charts/apexcharts.js"></script>

        <!-- Main JS -->
        <script src="../assets/js/main.js"></script>

        <!-- Page JS -->
        <script src="../assets/js/dashboards-analytics.js"></script>
        <script type="text/javascript">
            
        </script>

        <!-- Place this tag in your head or just before your close body tag. -->
        <script async defer src="https://buttons.github.io/buttons.js"></script>
    </body>
</html>
