<div class="container-fluid p-3 rounded shadow h-100">
    <button class="btn btn-transparent p-0 float-end" type="button" id="cardOpt-kalender" data-bs-toggle="dropdown" aria-haspopup="true"
        aria-expanded="false">
        <i class="fa-solid fa-ellipsis-vertical more"></i>
    </button>
    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt-kalender">
        <a class="dropdown-item" href="">Segarkan</a>
        <a class="dropdown-item" href="">Detail</a>
        <a class="dropdown-item" href="">Cetak</a>
    </div>
    <button class="btn btn-transparent p-0 float-end mx-4" type="button" id="cardOpt-terjual-view" data-bs-toggle="dropdown" aria-haspopup="true"
        aria-expanded="false">
        <i class="fa-regular fa-calendar more"></i>
    </button>
    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt-terjual-view">
        <a class="dropdown-item" href="">Mingguan</a>
        <a class="dropdown-item" href="">Bulanan</a>
    </div>
    <a class="float-start title">Kasir</a><br>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="d-flex flex-column align-items-center gap-1">
        <h2 class="mb-2">2</h2>
        <span>Total Kasir</span>
        </div>
        <div id="kasirStatisticsChart"></div>
    </div>
    <ul class="p-0 m-0">
        <li class="d-flex mb-4 pb-1">
            <div class="avatar flex-shrink-0 me-3">
                <span class="avatar-initial rounded bg-label-primary"
                ><i class="bx bx-mobile-alt"></i
                ></span>
            </div>
            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                <div class="me-2">
                    <h6 class="mb-0">Kasir 1</h6>
                    <small class="text-muted">Ahmad</small>
                </div>
                <div class="user-progress">
                    <small class="fw-semibold">Rp. 260K</small>
                </div>
            </div>
        </li>
        <li class="d-flex mb-4 pb-1">
            <div class="avatar flex-shrink-0 me-3">
                <span class="avatar-initial rounded bg-label-primary"
                ><i class="bx bx-mobile-alt"></i
                ></span>
            </div>
            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                <div class="me-2">
                    <h6 class="mb-0">Kasir 2</h6>
                    <small class="text-muted">Budi</small>
                </div>
                <div class="user-progress">
                    <small class="fw-semibold">Rp. 430K</small>
                </div>
            </div>
        </li>
    </ul>                    
</div>