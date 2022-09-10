<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>
        <meta name="description" content="" />

        <title>Admin | Karyawan | Upah</title>
        
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

        <!-- Vendors JS -->
        <script src="../assets/vendor/libs/apex-charts/apexcharts.js"></script>

        <!-- Jquery -->
        <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <!-- Jquery DataTables -->
        <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <!-- Bootstrap dataTables Javascript -->
        <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

        <script type="text/javascript" charset="utf-8">
            $(document).ready(function () {
                $('#karyawanTable').DataTable();
            });
        </script>


        <style>
            a{
                text-decoration:none;
            }
            .container .title, .container-fluid .title{
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
                        <a class="fw-bold float-start">/Karyawan/Upah</a>   
                        <!-- Search -->
                        @include('others.search')
                    </nav>

                    <!-- Content wrapper -->
                    <div class="content-wrapper p-4">
                        <div class="row">
                            <div class="col-lg-7 col-md-12 col-sm-12">
                                <div class="container-fluid p-3 rounded shadow h-100">
                                    <!--Data Upah-->
                                    @include('admin.karyawan.upah.all')
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-12 col-sm-12">
                                <div class="container-fluid p-3 position-relative rounded shadow" style="height:200px;">
                                    <!--Total Upah-->
                                    @include('admin.karyawan.upah.total')
                                </div>
                                <div class="container-fluid p-3 mt-3 position-relative rounded shadow" style="height:200px;">
                                    <!--Jabatan-->
                                    @include('admin.karyawan.upah.jabatan')
                                </div>
                                <div class="container-fluid p-3 mt-3 position-relative rounded shadow" style="height:200px;">
                                    <!--Perbandingan Upah-->
                                    @include('admin.karyawan.upah.perbandingan')
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

        <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js'></script>   

        <script>
            'use strict';

            (function () {
            let cardColor, headingColor, axisColor, shadeColor, borderColor;

            cardColor = config.colors.white;
            headingColor = config.colors.headingColor;
            axisColor = config.colors.axisColor;
            borderColor = config.colors.borderColor;

            const chartOrderStatistics = document.querySelector('#gajiStatisticsChart'),
                orderChartConfig = {
                chart: {
                    height: 260,
                    width: 260,
                    type: 'donut'
                },
                labels: [<?php 
                    foreach($jabatan as $jbt){
                        echo "'".$jbt->jabatan_karyawan."', ";
                    }
                    ?>],
                series: [<?php 
                    foreach($jabatan as $jbt){
                        echo $jbt->total.", ";
                    }
                    ?>],
                colors: [config.colors.primary, config.colors.secondary, config.colors.info, config.colors.success],
                stroke: {
                    width: 5,
                    colors: cardColor
                },
                dataLabels: {
                    enabled: false,
                    formatter: function (val, opt) {
                    return parseInt(val) + '%';
                    }
                },
                legend: {
                    show: false
                },
                grid: {
                    padding: {
                    top: 0,
                    bottom: 0,
                    right: 15
                    }
                },
                plotOptions: {
                    pie: {
                        startAngle: -90,
                        endAngle: 90,
                        offsetY: 10,
                        donut: {
                            size: '75%',
                            labels: {
                            show: true,
                            value: {
                                fontSize: '1.2rem',
                                fontFamily: 'Public Sans',
                                color: headingColor,
                                offsetY: -15,
                                formatter: function (val) {
                                    val = val / 
                                        <?php
                                            $total = 0;
                                            foreach($jabatan as $jbt){
                                                $total += $jbt->total;
                                            }
                                            echo $total;
                                        ?> * 100;
                                    var final = (Math.round(val * 100) / 100);
                                    return final + ' %';
                                }
                            },
                            name: {
                                offsetY: 20,
                                fontFamily: 'Public Sans'
                            },
                            total: {
                                show: true,
                                fontSize: '0.8125rem',
                                color: axisColor,
                                label: 'Bulanan',
                                    formatter: function (w) {
                                        return '%';
                                    }
                                }
                            }
                        }
                    }
                }
                };
            if (typeof chartOrderStatistics !== undefined && chartOrderStatistics !== null) {
                const statisticsChart = new ApexCharts(chartOrderStatistics, orderChartConfig);
                statisticsChart.render();
            }
            })();

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
