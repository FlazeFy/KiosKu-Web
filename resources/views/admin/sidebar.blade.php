<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="..." class="app-brand-link">
            <span class="app-brand-text demo menu-text fw-bolder ms-2">KiosKu</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
        <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>
    <ul class="menu-inner py-1">
        <li class="menu-item<?php if((session()->get('active_nav') == "profil")||(session()->get('active_nav') == "aktivitas")){ echo " active"; }?>">
            <a href="/profil" class="menu-link fw-bold">
                <img src="{{asset('assets/img/icons/default_avatar.png')}}" alt="default_avatar.png" class="d-block rounded me-2" height="30" width="30" id="uploadedAvatar"/>
                <div data-i18n="Analytics">{{session()->get('usernameKey')}}</div>
            </a>
        </li>
        <li class="menu-item<?php if(session()->get('active_nav') == "dashboard"){ echo " active"; }?>">
            <a href="/dashboard" class="menu-link">
                <i class="fa-solid fa-house mx-2"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Etalase</span>
        </li>
        <li class="menu-item<?php if(session()->get('active_nav') == "rak"){ echo " active"; }?>">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings">Rak</div>
            </a>
            <ul class="menu-sub">
                <!--General Shelf-->
                @foreach($rak as $rk)
                <li class="menu-item">
                    <a href="http://127.0.0.1:8000/rak/{{$rk->id}}" class="menu-link btn btn-transparent w-75 text-start">
                        <div data-i18n="Account">{{$rk->nama_rak}}</div>
                    </a>
                </li>
                @endforeach
            </ul>
        </li>
        
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link">
                <i class="fa-solid fa-chart-line me-3"></i>
                <div data-i18n="Authentications">Statistik</div>
            </a>
        </li>
        <li class="menu-item<?php if(session()->get('active_nav') == "riwayat"){ echo " active"; }?>">
            <a href="/riwayat" class="menu-link">
                <i class="fa-solid fa-clock-rotate-left me-3"></i>
                <div data-i18n="Authentications">Riwayat</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link">
                <i class="fa-regular fa-trash-can me-3"></i>
                <div data-i18n="Authentications">Sampah</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase"><span class="menu-header-text">Manajemen</span></li>
        <li class="menu-item<?php if(session()->get('active_nav') == "barang"){ echo " active"; }?>">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings">Barang</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="pages-account-settings-account.html" class="menu-link">
                        <div data-i18n="Account">Etalase</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/barang/gudang" class="menu-link">
                        <div data-i18n="Account">Gudang</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="pages-account-settings-account.html" class="menu-link">
                        <div data-i18n="Account">Distribusi</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item<?php if(session()->get('active_nav') == "karyawan"){ echo " active"; }?>">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="fa-regular fa-user me-3"></i>
                <div data-i18n="Account Settings">Karyawan</div>
            </a>
            <ul class="menu-sub">
                <!--General Shelf-->
                <li class="menu-item">
                    <a href="/karyawan/upah" class="menu-link">
                        <div data-i18n="Account">Upah</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="pages-account-settings-account.html" class="menu-link">
                        <div data-i18n="Account">Tugas</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/karyawan/data" class="menu-link">
                        <div data-i18n="Account">Data</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item<?php if(session()->get('active_nav') == "kasir"){ echo " active"; }?>">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="fa-solid fa-cash-register me-3"></i>
                <div data-i18n="Account Settings">Kasir</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="/kasir/penjualan" class="menu-link">
                        <div data-i18n="Account">Penjualan</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="pages-account-settings-account.html" class="menu-link">
                        <div data-i18n="Account">Statistik</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/kasir/tampilan" class="menu-link">
                        <div data-i18n="Account">Tampilan</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="fa-solid fa-rupiah-sign me-3"></i>
                <div data-i18n="Account Settings">Keuangan</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="pages-account-settings-account.html" class="menu-link">
                        <div data-i18n="Account">Rincian</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="pages-account-settings-account.html" class="menu-link">
                        <div data-i18n="Account">Statistik</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="fa-solid fa-diagram-project me-3"></i>
                <div data-i18n="Account Settings">Operasional</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="pages-account-settings-account.html" class="menu-link">
                        <div data-i18n="Account">Organisasi</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="pages-account-settings-account.html" class="menu-link">
                        <div data-i18n="Account">Sewa</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="pages-account-settings-account.html" class="menu-link">
                        <div data-i18n="Account">Transportasi</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="pages-account-settings-account.html" class="menu-link">
                        <div data-i18n="Account">Periklanan</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="pages-account-settings-account.html" class="menu-link">
                        <div data-i18n="Account">Pajak</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-header small text-uppercase"><span class="menu-header-text">Kegiatan</span></li>
        <li class="menu-item<?php if(session()->get('active_nav') == "kalender"){ echo " active"; }?>">
            <a href="/kalender" class="menu-link">
                <i class="fa-regular fa-calendar me-3"></i>
                <div data-i18n="Authentications">Kalender</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link">
                <i class="fa-solid fa-tags me-3"></i>
                <div data-i18n="Authentications">Promo</div>
            </a>
        </li>
        <li class="menu-item<?php if(session()->get('active_nav') == "pengingat"){ echo " active"; }?>">
            <a href="/pengingat" class="menu-link">
                <i class="fa-regular fa-bell me-3"></i>
                <div data-i18n="Authentications">Pengingat</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase"><span class="menu-header-text">Lainnya</span></li>
        <li class="menu-item<?php if(session()->get('active_nav') == "arsip"){ echo " active"; }?>">
            <a href="/arsip" class="menu-link">
                <i class="fa-regular fa-folder-open me-3"></i>
                <div data-i18n="Authentications">Arsip</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link">
                <i class="fa-solid fa-calculator me-3"></i>
                <div data-i18n="Authentications">Kalkulator</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link">
                <i class="fa-solid fa-book me-3"></i>
                <div data-i18n="Authentications">Catatan</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link">
                <i class="fa-solid fa-print me-3"></i>
                <div data-i18n="Authentications">Cetak</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase"><span class="menu-header-text">Bantuan</span></li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="fa-solid fa-info me-3"></i>
                <div data-i18n="Account Settings">Panduan</div>
            </a>
            <ul class="menu-sub">
                <!--General Shelf-->
                <li class="menu-item">
                    <a href="pages-account-settings-account.html" class="menu-link">
                        <div data-i18n="Account">Etalase</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="pages-account-settings-account.html" class="menu-link">
                        <div data-i18n="Account">Manajemen</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="pages-account-settings-account.html" class="menu-link">
                        <div data-i18n="Account">Kegiatan</div>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</aside>

<script type="text/javascript">
    const links = document.querySelectorAll('.menu-item');
    
    if (links.length) {
        links.forEach((link) => {
            link.addEventListener('click', (e) => {
            links.forEach((link) => {
                link.classList.remove('active');
            });
            link.classList.add('active');
            });
        });
    }
</script> 