<style>
    .sub-menu.active{
        color:whitesmoke !important;
        background:#676AFB;
    }
    .sub-menu{
        color:#676AFB !important;
        margin-right:10px;
        padding: 6px 12px;
    }
    .sub-menu:hover{
        color:whitesmoke !important;
    }
    .sub-menu-danger{
        color:#df4759 !important;
        font-weight:500;
    }
    .sub-menu-danger:hover{
        background:#df4759 !important;
        color:whitesmoke !important;
    }
</style>

<a class="btn btn-link sub-menu<?php if(session()->get('active_nav') == "profil"){ echo " active"; }?>" href="/profil"><i class="fa-regular fa-user"></i> Profil</a>
<a class="btn btn-link sub-menu" ><i class="fa-regular fa-bell"></i> Notifikasi</a>
<a class="btn btn-link sub-menu<?php if(session()->get('active_nav') == "aktivitas"){ echo " active"; }?>" href="/aktivitas"><i class="fa-solid fa-clock-rotate-left"></i> Aktivitas</a>
<a class="btn btn-link sub-menu"><i class="fa-solid fa-gear"></i> Pengaturan</a>
<a class="btn btn-link float-end sub-menu-danger" data-bs-toggle="modal" data-bs-target="#sign-out-Modal"><i class="fa-solid fa-arrow-right-from-bracket"></i> Sign-Out</a>

@include('popup.sign-out')