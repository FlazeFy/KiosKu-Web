<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>
        <meta name="description" content="" />

        <title>Admin | Rak</title>
        
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
        <!-- <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script> -->
        <script href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css"></script>

        <!-- Vendors CSS & JS -->
        <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
        <link rel="stylesheet" href="../assets/vendor/libs/apex-charts/apex-charts.css" />
        <script src="../assets/vendor/js/helpers.js"></script>
        <script src="../assets/js/config.js"></script>

        <!-- Jquery -->
        <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <!-- Jquery DataTables -->
        <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <!-- Bootstrap dataTables Javascript -->
        <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

        <script type="text/javascript" charset="utf-8">
            $(document).ready(function () {
                $('#barangTable').DataTable();
                $('#gudangTable').DataTable();
                $('#rakTable').DataTable();
            });
        </script>


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

            .modal-title{
                color:whitesmoke;
            }
            .modal-header{
                background:#676AFB;
            }

            .text-primary{
                color:#676AFB !important;
            }
        </style>
    </head>

    <body>
        <div class="layout-wrapper layout-content-navbar">
            <div class="layout-container">
                <!--Sidebar-->
                @include('admin.sidebar')

                <!-- Layout container -->
                @foreach($open_rak as $op)
                    <div class="layout-page">
                        <!-- Navbar -->
                        <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center"
                        id="layout-navbar">
                            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                                <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                                <i class="bx bx-menu bx-sm"></i>
                                </a>
                            </div>          
                            <a class="fw-bold float-start">/Rak/{{$op->nama_rak}}</a>   
                        </nav>

                        <!-- Content wrapper -->
                        <div class="content-wrapper p-3">
                            <section class="container-xxl flex-grow-1 container-p-y">
                                <div class="card rounded shadow p-0">
                                    <!--Semua barang di rak-->
                                    @include('admin.rak.all_barang')
                                </div>
                                <div class="container rounded shadow p-3 mt-4">
                                    <!--Semua barang di rak-->
                                    @include('admin.rak.all_gudang')
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-7">
                                        <div class="container rounded shadow p-3">
                                            @include('admin.rak.all_rak')
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="container rounded shadow p-3">
                                            
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Overlay -->
            <div class="layout-overlay layout-menu-toggle"></div>
        </div>
        <!-- / Layout wrapper -->

        <!--Modal-->
        @include('admin.rak.form.create')
        @include('popup.success')

        <script>
            //Image upload preview.
            function previewEdit() {
                frame.src = URL.createObjectURL(event.target.files[0]);
            }
            document.getElementById('formFileEdit').onchange = function() {
                document.getElementById('formImage').submit();
            }
        </script>

        <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js'></script>   

        <!-- Core JS -->
        <!-- build:js assets/vendor/js/core.js -->
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
        <script type="text/javascript">
            'use strict';
            (function () {
                let cardColor, headingColor, axisColor, shadeColor, borderColor;

                cardColor = config.colors.white;
                headingColor = config.colors.headingColor;
                axisColor = config.colors.axisColor;
                borderColor = config.colors.borderColor;

                //Keuntungan.
                const profileReportChartEl = document.querySelector('#keuntunganChart'),
                profileReportChartConfig = {
                chart: {
                    height: 100,
                    //width: 250,
                    type: 'line',
                    toolbar: {
                        show: false
                    },
                    dropShadow: {
                        enabled: true,
                        top: 10,
                        left: 5,
                        blur: 3,
                        color: config.colors.primary,
                        opacity: 0.15
                    },
                    sparkline: {
                        enabled: true
                    }
                },
                grid: {
                    show: false,
                    padding: {
                        right: 8
                    }
                },
                colors: [config.colors.primary],
                dataLabels: {
                    enabled: false,
                },
                stroke: {
                    width: 6.5,
                    curve: 'smooth'
                },
                series: [
                    {
                        name: "Total",
                        data:[
                        <?php 
                            //Inital variable.
                            $day1 = 62; //CHECK THIS AGAIN!!!!!!!!!!!!!!!
                            $day2 = 70;
                            $max = 10; //Show last 10 week value.

                            for($i = 1; $i <= $max; $i++){
                                $total = 0;
                                foreach($transaksi as $ts){
                                    foreach($barang_transaksi as $btrs){
                                        //CHECK THIS AGAIN!!!!!!!!!!!!!!!
                                        if(($btrs->id_keranjang == $ts->id)&&(strtotime($ts->created_at) > strtotime('-'.$day2.' day'))&&(strtotime($ts->created_at) <= strtotime('-'.$day1.' day'))){
                                            $total += $btrs->qty * ($btrs->harga_jual - $btrs->harga_stok);
                                        }
                                    }
            
                                }
                                echo $total.",";

                                //Iterate to next week.
                                $day1 = $day1 - 7;
                                $day2 = $day2 - 7;
                            }
                        ?>
                        ]
                    }
                ],
                xaxis: {
                    show: true,
                    categories: ["9 Minggu Lalu", "8 Minggu Lalu", "7 Minggu Lalu", "6 Minggu Lalu", "5 Minggu Lalu", "4 Minggu Lalu", "3 Minggu Lalu", "2 Minggu Lalu", "Seminggu Lalu", "Minggu Ini"]
                },
                yaxis: {
                    show: false
                }
                };
            if (typeof profileReportChartEl !== undefined && profileReportChartEl !== null) {
                const profileReportChart = new ApexCharts(profileReportChartEl, profileReportChartConfig);
                profileReportChart.render();
            }

            })();
        </script>

        <!-- Place this tag in your head or just before your close body tag. -->
        <script async defer src="https://buttons.github.io/buttons.js"></script>
    </body>
</html>
