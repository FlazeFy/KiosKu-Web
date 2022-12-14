<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>
        <meta name="description" content="" />

        <title>Admin | Tampilan</title>
        
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

        <!-- Vendors CSS & JS -->
        <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
        <script src="../assets/vendor/js/helpers.js"></script>
        <script src="../assets/js/config.js"></script>

        <!-- Jquery -->
        <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>

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

            /* .hour-item-holder{
                display: flex;
                flex-direction: column;
                height: 575px;
                overflow-y: scroll;
            } */

            .btn-success-secondary{
                background:white;
                color: #198754 !important;
                border:2px solid #198754;
                border-radius:6px;
                height:36px;
            }

            .bg-primary{
                background: #696cFF !important; 
            }

            .fitur-box{
                width: 100%;
                height: 250px;
                margin-bottom: 20px;
                padding: 20px;
                text-align: center;
                border-radius: 20px;
                background: white;
                border: none;
                color: grey;
            }
            .fitur-box:hover, .fitur-box:hover h5{
                background: #E7E7FF;
            }
            .fitur-box p{
                overflow: hidden;
                text-overflow: ellipsis;
                display: -webkit-box;
                -webkit-line-clamp: 3;
                line-clamp: 3;
                -webkit-box-orient: vertical;
                white-space: normal;
            }
            .fitur-box h5{
                color: #696cFF; 
            }
            .fitur-holder{
                display: flex;
                flex-direction: column;
                height: 450px;
                overflow-y: scroll;
            }
        </style>
    </head>

    <body>
        <div class="layout-wrapper layout-content-navbar">
            <div class="layout-container p-3">
                @include('admin.kasir.custom.board')
                @include('admin.kasir.custom.control')
                @foreach($tampilan as $tp)
                    @include('admin.kasir.custom.form.tambah_container')
                @endforeach
            </div>

            <!-- Overlay -->
            <div class="layout-overlay layout-menu-toggle"></div>
        </div>
        <!-- / Layout wrapper -->

        <!--Modal-->
        @include('popup.success')
        @include('popup.failed')

        <script>
            //ISotope bug!!! automatically creates a new row even though there are still empty columns left

            // (function() {
            //     "use strict";

            //     /**
            //      * Easy selector helper function
            //      */
            //     const select = (el, all = false) => {
            //         el = el.trim()
            //         if (all) {
            //         return [...document.querySelectorAll(el)]
            //         } else {
            //         return document.querySelector(el)
            //         }
            //     }
            //     const on = (type, el, listener, all = false) => {
            //         let selectEl = select(el, all)
            //         if (selectEl) {
            //         if (all) {
            //             selectEl.forEach(e => e.addEventListener(type, listener))
            //         } else {
            //             selectEl.addEventListener(type, listener)
            //         }
            //         }
            //     }
            //          window.addEventListener('load', () => {
            //         let portfolioContainer = select('.layout-box');
            //         if (portfolioContainer) {
            //         let portfolioIsotope = new Isotope(portfolioContainer, {
            //             itemSelector: '.box'
            //         });
            //         }

            //     });
                
            // })()
        </script>

        <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js'></script>   

        <!-- Core JS -->
        <!-- build:js assets/vendor/js/core.js -->
        <script src="../assets/vendor/libs/popper/popper.js"></script>
        <script src="../assets/vendor/js/bootstrap.js"></script>
        <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
        <script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.js"></script>
        <script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>

        <script src="../assets/vendor/js/menu.js"></script>

        <!-- Main JS -->
        <script src="../assets/js/main.js"></script>

        <!-- Place this tag in your head or just before your close body tag. -->
        <script async defer src="https://buttons.github.io/buttons.js"></script>
    </body>
</html>
