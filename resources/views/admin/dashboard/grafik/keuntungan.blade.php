<div class="container-fluid p-3 rounded shadow h-100">
    <button class="btn btn-transparent p-0 float-end" type="button" id="cardOpt-grafik-keuntungan" data-bs-toggle="dropdown" aria-haspopup="true"
        aria-expanded="false">
        <i class="fa-solid fa-ellipsis-vertical more"></i>
    </button>
    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt--grafik-keuntungan">
        <a class="dropdown-item" href="">Segarkan</a>
        <a class="dropdown-item" href="">Detail</a>
        <a class="dropdown-item" href="">Cetak</a>
    </div>
    <button class="btn btn-transparent p-0 float-end mx-4" type="button" id="cardOpt-keuntungan-view" data-bs-toggle="dropdown" aria-haspopup="true"
        aria-expanded="false">
        <i class="fa-regular fa-calendar more"></i>
    </button>
    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt-keuntungan-view">
        <a class="dropdown-item" href="">Mingguan</a>
        <a class="dropdown-item" href="">Bulanan</a>
    </div>
    <a class="float-start title">Total Keuntungan</a><br>
    <div class="tab-content p-0">
        <div class="tab-pane fade show active" id="navs-tabs-line-card-income" role="tabpanel">
            <div class="d-flex p-4 pt-3">
                <div>
                    <!--Not finished-->
                    <small class="text-muted d-block">Total Keuntungan 6 bulan terakhir</small>
                    <div class="d-flex align-items-center">
                        <h6 class="mb-0 me-1">Rp. 14.035K</h6>
                        <small class="text-success fw-semibold">
                        <i class="bx bx-chevron-up"></i>
                        42.9%
                        </small>
                    </div>
                </div>
            </div>
            <div id="incomeChart"></div>
                <div class="d-flex justify-content-center pt-4 gap-2">
                    <div class="flex-shrink-0">
                    <div id="expensesOfWeek"></div>
                    </div>
                    <div>
                    <p class="mb-n1 mt-1">Pendapatan Bulan Ini</p>
                    <small class="text-muted">+ Rp.
                        <?php 
                            //Initial variable.
                            $count_before = 0;
                            $count_after = 0;
                            $now = new DateTime(date("Y/m/d"));

                            //Count profit this month and before-->
                            foreach($transaksi as $ts){
                                foreach($barang_transaksi as $btrs){
                                    $check = new DateTime(date($ts->created_at));
                                    if(($btrs->id_keranjang == $ts->id)&&($check->format('m') == $now->format('m')-1)){
                                        $count_before += $btrs->qty * ($btrs->harga_jual - $btrs->harga_stok);
                                    } else if(($btrs->id_keranjang == $ts->id)&&($check->format('m') ==  $now->format('m'))){
                                        $count_after += $btrs->qty * ($btrs->harga_jual - $btrs->harga_stok);
                                    }
                                }
                            }
                            echo $count_after - $count_before;
                        ?>    
                    dari sebelumnya</small>
                </div>
            </div>
        </div>
    </div>
</div>