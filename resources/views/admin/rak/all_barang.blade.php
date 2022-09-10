<style>
    #headerBox{
        background-position: center;
        background-repeat:no-repeat;
        position: relative;
        background-size: cover;
        background-color: black;
    }
    .image-upload>input {
        display: none;
    }
</style>

<div class="text-nowrap">
    <div class="card-header p-4" id="headerBox" style=" 
        <?php
            if($op->rak_image_url != "null"){
                echo "background-image: linear-gradient(rgba(0, 0, 0, 0.6),rgba(0, 0, 0, 0.75)), url('http://127.0.0.1:8000/storage/".$op->rak_image_url."');";
            } else {
                echo "background:#5c5c5c;";
            }
        ?>
        ">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12">
                <form method="POST" action="/rak/edit_foto/{{$op->id}}"  id="formImage" enctype="multipart/form-data">
                    @csrf
                    <h5 class="text-white">{{$op->nama_rak}}</h5>
                    <div style="height:60px; width:400px;">
                        <p class="text-white">{{$op->deskripsi_rak}}</p>
                    </div>
                    <a class="text-white">Dibuat pada : {{date('Y-m-d', strtotime($op->created_at))}}</a><br>
                    <div class="image-upload mt-1 me-1 float-start" id="formFileEdit" onchange="previewEdit()">
                        <label for="file-input">
                            <a class="btn btn-primary text-white shadow">Ganti Foto</a>
                        </label>
                        <input id="file-input" type="file" name="image_url"/>
                    </div>
                    <a class="btn btn-danger text-white m-1 shadow"><i class="bx bx-reset d-block d-sm-none"></i> Reset</a>
                    <p class="text-white mb-0">Format gambar <b>JPG, GIF</b> or <b>PNG</b>. Ukuran maksimal <b>10 mb</b></p>
                </form>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12 pe-3">
                <div class="d-flex justify-content-between mt-4">
                    <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between"> 
                        <h5 class="text-nowrap text-white"><i class="fa-solid fa-circle-info"></i> Total Keuntungan</h5>
                        <!-- <small class="text-white text-nowrap fw-semibold"><i class="bx bx-chevron-up"></i> 68.2%</small> -->
                        <h2 class="text-primary fw-bold"><i class="fa-solid fa-plus"></i> Rp. 
                            @php($total = 0)
                            @foreach($transaksi as $ts)
                                @foreach($barang_transaksi as $btrs)
                                    @if(($btrs->id_keranjang == $ts->id)&&(strtotime($ts->created_at) > strtotime('-70 day'))&&(strtotime($ts->created_at) <= strtotime('1 day')))
                                        @php($total += $btrs->qty * ($btrs->harga_jual - $btrs->harga_stok))
                                    @endif
                                @endforeach
                            @endforeach
                            {{$total}}
                        </h2>
                    </div>
                    <div id="keuntunganChart"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body p-3">
    @if(count($barang_rak) > 0)
        <table class="table table-paginate" id="barangTable" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>Kategori</th>
                <th>Nama</th>
                <th>Deskripsi</th>
                <th>Harga Jual</th>
                <th>Keuntungan</th>
                <th>Stok</th>
                <th>Expired</th>
                <th>Ubah</th>
                <th>Hapus</th>
            </tr>
            </thead>
            <tbody class="table-border-bottom-0" id="body_barangTable"></tbody>
        </table>
        <div id="modal_holder"></div>
        @else
            <div class="container text-center d-block mx-auto">
                <img class="mx-2" src="{{asset('assets/img/storyset/Empty_1.png')}}" alt='Empty.png' style="width:250px;">
                <h5>Rak masih kosong...</h5>
            </div>
        @endif
    </div>
</div>

<script type="text/javascript">
    //Get data ajax
    $(document).ready(function() {
        clear();
    });
    
    function clear() {
        setTimeout(function() {
            update();
            clear();
        }, 1500); //Every 1500 milliseconds
    }
    
    function update() {
        $.ajax({
            url: '/getBarangRak/{{$op->id}}',
            type: 'get',
            dataType: 'json',
            success: function(response){
                var len = 0;
                $('#body_barangTable').empty(); 
                if(response != null){
                    len = response.length;
                }

                //Date converter.
                function convertDate(datetime){
                    if(datetime == null){
                        return "-";
                    } else {
                        const result = new Date(datetime);
                        return result.getFullYear() + "-" + (result.getMonth() + 1) + "-" + result.getDate();
                    }
                }
                
                if(len > 0){
                    for(var i=0; i<len; i++){
                        //Attribute
                        var id = response[i].id;
                        var id_barang = response[i].id_barang;
                        var kategori_barang = response[i].kategori_barang;
                        var nama_barang = response[i].nama_barang;
                        var deskripsi_barang = response[i].deskripsi_barang;
                        var harga_jual = response[i].harga_jual;
                        var harga_stok = response[i].harga_stok;
                        var stok_barang = response[i].stok_barang;
                        var expired_at = response[i].expired_at;

                        var tr_str = 
                            "<tr>" +
                                "<td>" + kategori_barang + "</td>" +
                                "<td>" + nama_barang + "</td>" +
                                "<td>" + deskripsi_barang + "</td>" +
                                "<td>Rp. " + harga_jual + "</td>" +
                                "<td>Rp. " + (Number(harga_jual) - Number(harga_stok)) + "</td>" +
                                "<td>" + stok_barang + "</td>" +
                                "<td>" + convertDate(expired_at) + "</td>" +
                                "<td>" +
                                    "<button class='btn btn-warning text-white py-1' title='Ubah' data-bs-toggle='modal' data-bs-target='#edit-barang-Modal-" + id_barang + "'><i class='fa-solid fa-pen-to-square'></i></button>" +
                                "</td>" +
                                "<td>" +
                                    "<button class='btn btn-danger text-white py-1' title='Hapus' data-bs-toggle='modal' data-bs-target='#hapus-barang-Modal-" + id + "'><i class='fa-solid fa-trash'></i></button>" +
                                "</td>" +
                            "</tr>" ;
                            
                        var modal_str =
                            "<div class='modal fade' id='edit-barang-Modal-" + id_barang + "' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'> " +
                                "<div class='modal-dialog'> " +
                                    "<div class='modal-content'> " +
                                        "<form action='/rak/edit_barang/" + id_barang + "' method='POST'> " +
                                            '@csrf ' +
                                            "<div class='modal-header'> " +
                                                "<h5 class='modal-title' id='exampleModalLabel'>Edit Barang</h5> " +
                                                "<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button> " +
                                            "</div> " +
                                            "<div class='modal-body'> " +
                                                "<div class='row'> " +
                                                    "<div class='col-md'> " +
                                                        "<div class='form-floating mb-2'> " +
                                                            "<input type='number' class='form-control' name='harga_jual' value='" + harga_jual + "' required> " +
                                                            "<label for='floatingInput'>Harga Jual (Rp.)</label> " +
                                                        "</div> " +
                                                        "<div class='form-floating mb-2'> " +
                                                            "<input type='number' class='form-control' name='stok_barang' value='" + stok_barang + "' required> " +
                                                            "<label for='floatingInput'>Stok</label> " +
                                                        "</div> " +
                                                    "</div> " +
                                                    "<div class='col-md'> " +
                                                        "<div class='form-floating mb-2'> " +
                                                            "<input type='number' class='form-control' name='harga_stok' value='" + harga_stok + "' required> " +
                                                            "<label for='floatingInput'>Harga Stok (Rp.)</label> " +
                                                        "</div> " +
                                                        "<div class='form-floating mb-2'> " +
                                                            "<input type='date' class='form-control' name='expired_at' value='" + convertDate(expired_at) + "'> " +
                                                            "<label for='floatingInput'>Tanggal Expired</label> " +
                                                        "</div> " +
                                                    "</div> " +
                                                "</div> " +
                                                "<a class='text-secondary fst-italic'><i class='fa-solid fa-circle-info'></i> Untuk mengubah secara lengkap, buka menu 'Barang'</a> " +
                                            "</div> " +
                                            "<div class='modal-footer'> " +
                                                "<button type='submit' class='btn btn-success'><i class='fa-solid fa-floppy-disk'></i> Simpan</button> " +
                                            "</div> " +
                                        "</form> " +
                                    "</div> " +
                                "</div> " +
                            "</div> " +
                            "<div class='modal fade' id='hapus-barang-Modal-" + id + "' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'> " +
                                "<div class='modal-dialog'> " +
                                    "<div class='modal-content'> " +
                                        "<div class='modal-header'> " +
                                            "<h5 class='modal-title' id='exampleModalLabel'>Hapus Barang</h5> " +
                                            "<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button> " +
                                        "</div> " +
                                        "<div class='modal-body'>" +
                                            "<p>Apakah Anda yakin untuk menghapus " + nama_barang + " dari rak?</p> " +
                                        "</div>" +
                                        "<div class='modal-footer'>" +
                                            "<form action='/rak/delete_barang/" + id + "' method='POST'> " +
                                                '@csrf ' +
                                                "<button type='submit' class='btn btn-danger'><i class='fa-solid fa-trash'></i> Hapus</button> " +
                                            "</form> " +
                                        "</div> " +
                                    "</div> " +
                                "</div> " +
                            "</div> " ;

                        $("#modal_holder").append(modal_str);
                        $("#body_barangTable").append(tr_str);
                    }
                }else{
                    var tr_str = 
                        "<tr>" +
                            "<td align='center' colspan='4'>Data Kosong</td>" +
                        "</tr>";

                    $("#body_barangTable").append(tr_str);
                }
            }
       });
    }
</script>