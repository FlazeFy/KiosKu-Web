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

    .autocomplete {
        position: relative;
        display: inline-block;
    }

    .autocomplete-items {
        position: absolute;
        border: 1px solid #d4d4d4;
        border-bottom: none;
        border-top: none;
        z-index: 99;
        top: 100%;
        left: 0;
        right: 0;
    }

    .autocomplete-items div {
        padding: 10px;
        cursor: pointer;
        background-color: #fff; 
        border-bottom: 1px solid #d4d4d4; 
    }

    .autocomplete-items div:hover {
        background-color: #696cFF; 
    }

    .autocomplete-active {
        background-color: #696cFF !important; 
        color: #ffffff; 
    }
</style>

<div class="keranjang-table text-nowrap  table-responsive">
    <table class="table table-hover">
        <thead>
            <tr class="bg-primary text-white">
                <th scope="col" width="10">#</th>
                <th scope="col" width="40">ID</th>
                <th scope="col" width="160">Nama Barang</th>
                <th scope="col" width="60" style="min-width:60px;">Qty</th>
                <th scope="col" width="80">Harga</th>
                <th scope="col" width="80">Diskon</th>
                <th scope="col" width="100">Sub-Total</th>
                <th scope="col" width="10">Aksi</th>
            </tr>
        </thead>
        <tbody id="barang_holder">
            <tr>
                <th scope="row">1</th>
                <td>JA39F93ASJ</td>
                <td>
                    <div class="autocomplete">
                        <input class="form-control" id="nama_barang_1" type="text" name="nama_barang" placeholder="Garam">
                    </div><br>
                    <a style="font-size:13.5px;">Note : 500 gr</a>
                </td>
                <td><input class="form-control p-1" type="number" value="2" max="10" min="1"></td>
                <td>Rp. 3500</td>
                <td>Rp. 250</td>
                <td><h6>Rp. 6750</h6></td>
                <td><button class="btn btn-danger" title="Hapus"><i class="fa-solid fa-trash"></i></button></td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>JA39F93ISS</td>
                <td>
                    <div class="autocomplete">
                        <input class="form-control" id="nama_barang_2" type="text" name="nama_barang" placeholder="Mie Goreng">
                    </div><br>
                    <a style="font-size:13.5px;">Note : 500 gr</a>
                </td>
                <td><input class="form-control p-1" type="number" value="3" max="10" min="1"></td>
                <td>Rp. 3000</td>
                <td>-</td>
                <td><h6>Rp. 9000</h6></td>
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
                    "<th scope='row'>...</th> " +
                    "<td>-</td> " +
                    "<td> " +
                        "<div class='autocomplete'> " +
                            "<input class='form-control' id='nama_barang_3' type='text' name='nama_barang' placeholder='...'> " +
                        "</div><br> " +
                        "<a style='font-size:13.5px;'>Note : -</a> " +
                    "</td> " +
                    "<td><input class='form-control p-1' type='number' value='1' max='' min='1'></td> " +
                    "<td>Rp. -</td> " +
                    "<td>-</td> " +
                    "<td><h6>Rp. -</h6></td> " +
                    "<td>...</td> " +
                "</tr> " 
            );
        });
    });

  
    function autocomplete(inp, arr) {
        var currentFocus;
        inp.addEventListener("input", function(e) {
            var a, b, i, val = this.value;
            closeAllLists();
            if (!val) { return false;}
            currentFocus = -1;
            a = document.createElement("DIV");
            a.setAttribute("id", this.id + "autocomplete-list");
            a.setAttribute("class", "autocomplete-items");
            this.parentNode.appendChild(a);
            for (i = 0; i < arr.length; i++) {
                if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                b = document.createElement("DIV");
                b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                b.innerHTML += arr[i].substr(val.length);
                b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                b.addEventListener("click", function(e) {
                    inp.value = this.getElementsByTagName("input")[0].value;
                    closeAllLists();
                });
                a.appendChild(b);
                }
            }
        });
        inp.addEventListener("keydown", function(e) {
            var x = document.getElementById(this.id + "autocomplete-list");
            if (x) x = x.getElementsByTagName("div");
            if (e.keyCode == 40) {
                currentFocus++;
                addActive(x);
            } else if (e.keyCode == 38) { 
                currentFocus--;
                addActive(x);
            } else if (e.keyCode == 13) {
                e.preventDefault();
                if (currentFocus > -1) {
                if (x) x[currentFocus].click();
                }
            }
        });
        function addActive(x) {
            if (!x) return false;
            removeActive(x);
            if (currentFocus >= x.length) currentFocus = 0;
            if (currentFocus < 0) currentFocus = (x.length - 1);
            x[currentFocus].classList.add("autocomplete-active");
        }
        function removeActive(x) {
            for (var i = 0; i < x.length; i++) {
            x[i].classList.remove("autocomplete-active");
            }
        }
        function closeAllLists(elmnt) {
            var x = document.getElementsByClassName("autocomplete-items");
            for (var i = 0; i < x.length; i++) {
            if (elmnt != x[i] && elmnt != inp) {
                x[i].parentNode.removeChild(x[i]);
            }
            }
        }
        document.addEventListener("click", function (e) {
            closeAllLists(e.target);
        });
    }

    var barang = ["Mie Goreng","Gula Pasir","Garam","Minyak Goreng"];

    autocomplete(document.getElementById("nama_barang_1"), barang);
    autocomplete(document.getElementById("nama_barang_2"), barang);
    autocomplete(document.getElementById("nama_barang_3"), barang);

</script>
