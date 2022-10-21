<style>
    .sub-menu.active{
        color:whitesmoke !important;
        background:#676AFB;
    }
    .sub-menu{
        color:#676AFB !important;
    }
    .sub-menu:hover{
        color:whitesmoke !important;
    }
    .sub-menu-danger{
        color:#df4759 !important;
        font-weight:500;
    }
</style>

<a class="btn btn-link me-2 px-3 py-2 sub-menu<?php if(session()->get('active_nav') == "profil"){ echo " active"; }?>" href="/profil"><i class="fa-regular fa-user"></i> Profil</a>
<a class="btn btn-link me-2 px-3 py-2 sub-menu" ><i class="fa-regular fa-bell"></i> Notifikasi</a>
<a class="btn btn-link me-2 px-3 py-2 sub-menu<?php if(session()->get('active_nav') == "aktivitas"){ echo " active"; }?>" href="/aktivitas"><i class="fa-solid fa-clock-rotate-left"></i> Aktivitas</a>
<a class="btn btn-link me-2 px-3 py-2 sub-menu"><i class="fa-solid fa-gear"></i> Pengaturan</a>
<a class="btn btn-link me-2 px-3 py-2 float-end sub-menu-danger"><i class="fa-solid fa-arrow-right-from-bracket"></i> Sign-Out</a>