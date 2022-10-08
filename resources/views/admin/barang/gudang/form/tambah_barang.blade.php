<span id="control_holder">
    <a class="btn btn-primary text-white" id="add_barang_btn"><i class="fa-solid fa-plus"></i> Tambah Barang</a>
</span>

<script type="text/javascript">
    //Add barang form.
    $(document).ready(function(){
        var i = 0;
        $("#add_barang_btn").click(function(){
            i++;
            if(i == 1){
                $("#control_holder").append(
                "<button class='btn btn-success' type='submit'><i class='fa-solid fa-floppy-disk'></i> Simpan Semua Barang</button>");
            }
            $("#barang_holder").append(
            "<div class='col-lg-4 col-md-6 barang-item'> " +
                "<div class='container-fluid p-0 rounded shadow'> " +
                    "<div class='card-header w-100 p-4 position-relative' id='headerBox' style='background-image: linear-gradient(rgba(0, 0, 0, 0.6),rgba(0, 0, 0, 0.75)), url('http://127.0.0.1:8000/storage/default_image.png');'> " +
                        "<div class='image-upload' id='formFileEditAcc' onchange='previewEditAcc()'> " +
                            "<label class='btn btn-transparent position-absolute text-white' style='top:5px; right:15px;' title='Change Image' for='file-input'> " +
                                "<i class='fa-solid fa-camera fa-lg'></i></label> " +
                            "<input id='file-input' type='file' name='image_url[]'/> " +
                        "</div> " +
                    "</div> " +
                    "<div class='card-body barang-item'> " +
                        "<h6 class='text-primary'>Nama Barang</h6> " +
                        "<input class='form-control mb-1' type='text' name='nama_barang[]' required> " +
                        "<h6 class='text-primary'>Kategori Barang</h6> " +
                        "<select class='form-select mb-2' name='kategori_barang[]'> " +
                            "<option selected>.....</option> " +
                            <?php 
                                foreach($k_barang as $kb){
                                    echo '"'."<option value='".$kb->kategori_barang."'>".$kb->kategori_barang."</option> ".'" +';
                                }
                            ?>
                        "</select> " +
                        "<div class='row'> " +
                            "<div class='col-4'> " +
                                "<h6 class='text-primary'>Harga Stok</h6> " +
                                "<input class='form-control mb-1' type='number' name='harga_stok[]' placeholder='Rp.' required> " +
                                "<h6 class='text-primary'>Harga Jual</h6> " +
                                "<input class='form-control' type='number' name='harga_jual[]' placeholder='Rp.' required> " +
                            "</div> " +
                            "<div class='col-8'> " +
                                "<h6 class='text-primary'>Deskripsi</h6> " +
                                "<textarea class='form-control desc-edit' name='deskripsi_barang[]' style='height:110px;'>ex: 1 ltr</textarea> " +
                            "</div> " +
                        "</div> " +
                        "<div class='row my-2'> " +
                            "<div class='col-4'> " +
                                "<h6 class='text-primary'>Stok</h6> " +
                                "<input class='form-control' type='number' name='stok_barang[]' min='0' required> " +
                            "</div> " +
                            "<div class='col-8'> " +
                                "<h6 class='text-primary'>Tanggal Expired</h6> " +
                                "<input class='form-control' type='date' name='expired_at[]'> " +
                            "</div> " +
                        "</div> " +
                    "</div> " +
                "</div> " +
            "</div> ");
        });
    });
</script>