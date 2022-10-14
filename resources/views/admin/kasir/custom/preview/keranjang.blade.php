<style>
    .keranjang-table{
        overflow: auto; 
        height: 100%;
    }
    .keranjang-table table thead tr{
        position: sticky; 
        top: 0; 
        z-index: 1;
    }
    .add-btn-stick{
        position:sticky;
        bottom: 10px;
        z-index: 1;
        background:none !important;
    }
    .add-btn-stick:hover{
        background:none !important;
    }
</style>

<div class="keranjang-table text-nowrap  table-responsive">
    <table class="table table-hover">
        <thead>
            <tr class="bg-primary text-white">
                <th scope="col" width="10">#</th>
                <th scope="col" width="50">ID</th>
                <th scope="col" width="200">Nama Barang</th>
                <th scope="col" width="15">Qty</th>
                <th scope="col" width="80">Harga</th>
                <th scope="col" width="80">Diskon</th>
                <th scope="col" width="80">Sub-Total</th>
                <th scope="col" width="10">Aksi</th>
            </tr>
        </thead>
        <tbody id="barang_holder">
            <tr>
                <th scope="row">1</th>
                <td>JA39F93ASJ</td>
                <td>
                    <select class="form-select" name="id">
                        <option selected>Gula Pasir</option>
                        <option value="1">Mie Goreng</option>
                        <option value="2">Mentega</option>
                        <option value="3">Detergen</option>
                    </select>
                    <a style="font-size:13.5px;">Note : 500 gr</a>
                </td>
                <td><input class="form-control p-1" type="number" value="2" max="10" min="1"></td>
                <td>Rp. 3500</td>
                <td>Rp. 250</td>
                <td><h6>Rp. 6500</h6></td>
                <td><button class="btn btn-danger" title="Hapus"><i class="fa-solid fa-trash"></i></button></td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>JA39F93ISS</td>
                <td>
                    <select class="form-select" name="id">
                        <option selected>Mie Goreng</option>
                        <option value="1">Gula Pasir</option>
                        <option value="2">Mentega</option>
                        <option value="3">Detergen</option>
                    </select>
                    <a style="font-size:13.5px;">Note : 1 bungkus</a>
                </td>
                <td><input class="form-control p-1" type="number" value="3" max="10" min="1"></td>
                <td>Rp. 3000</td>
                <td>Rp. 250</td>
                <td><h6>Rp. 8750</h6></td>
                <td><button class="btn btn-danger" title="Hapus"><i class="fa-solid fa-trash"></i></button></td>
            </tr>
            <tr>
                <th></th><td></td>
                <td class="add-btn-stick"><button class="btn btn-success" title="Tambah" id="add_barang_btn"><i class="fa-solid fa-plus"></i> Tambah Barang</button></td>
                <td></td><td></td><td></td><td></td><td></td>
            </tr>
        </tbody>
    </table>
</div>

<script type="text/javascript">
    //Add barang form.
    $(document).ready(function(){
        var i = 0;
        $("#add_barang_btn").click(function(){
            $("#barang_holder").prepend(
                "<tr> " +
                    "<th scope='row'>3</th> " +
                    "<td>JA3AIS3ASJ</td> " +
                    "<td> " +
                        "<select class='form-select' name='id'> " +
                            "<option selected>...</option> " +
                            "<option value='1'>Gula Pasir</option> " +
                            "<option value='1'>Mie Goreng</option> " +
                            "<option value='2'>Mentega</option> " +
                            "<option value='3'>Detergen</option> " +
                        "</select> " +
                        "<a style='font-size:13.5px;'>Note : 1 bungkus</a> " +
                    "</td> " +
                    "<td><input class='form-control p-1' type='number' value='1' max='' min='1'></td> " +
                    "<td>Rp. 7500</td> " +
                    "<td>-</td> " +
                    "<td><h6>Rp. 7500</h6></td> " +
                    "<td><button class='btn btn-danger' title='Hapus'><i class='fa-solid fa-trash'></i></button></td> " +
                "</tr> " 
            );
        });
    });
</script>
