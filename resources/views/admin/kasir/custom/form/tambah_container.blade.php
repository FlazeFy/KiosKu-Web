<div class='modal fade' id='tambah-container-Modal' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <form action='/kasir/tampilan/tambah_container/{{$tp->id}}' method='POST'>
                @csrf
                <input type='text' name='old' value='{{$tp->format_tampilan}}' hidden>
                <div class='modal-header'>
                    <h5 class='modal-title' id='exampleModalLabel'>Tambah Container</h5>
                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                </div>
                <div class='modal-body'>
                    <div class='row'>
                        <div class='col-6'>
                            <div class='form-floating mb-2'> 
                                <input type='number' class='form-control' name='height' value='30' max='100' min='10' required> 
                                <label for='floatingInput'>Tinggi Container <span style='font-size:14.5px; font-weight:500;'>Max : 100<span></label> 
                            </div>
                        </div>
                        <div class='col-6'>
                            <div class='form-floating mb-2'> 
                                <input type='number' class='form-control' name='width' value='6' max='12' min='1' required> 
                                <label for='floatingInput'>Lebar Container <span style='font-size:14.5px; font-weight:500;'>Max : 12<span></label> 
                            </div>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-6'>
                            <label for="exampleColorInput" class="form-label">Warna Latar</label>
                            <div class='row'>
                                <div class='col-4'>
                                    <input type="color" class="form-control form-control-color mb-2" id="colorPicker" onblur="getHexCode()" name='background' value="#ffffff" title="Choose your color">
                                </div>
                                <div class='col-8'>
                                    <input type='text' class='form-control' id='colorHex' value='#ffffff' required disabled> 
                                </div>
                            </div>
                        </div>
                        <div class='col-6'>
                            <div class='form-floating my-2'> 
                                <select class="form-select" id="floatingSelectGrid" name="visibility" required>
                                    <option value="Semua" title="Container ini dapat dilihat oleh semua karyawan dan admin kios">Semua</option>
                                    <option value="Admin" title="Container ini dapat dilihat oleh admin kios">Admin</option>
                                    <option value="Admin & Kasir" title='Container ini dapat dilihat oleh admin kios dan karyawan dengan jabatan "Kasir"'>Admin & Kasir</option>
                                </select>
                                <label for='floatingInput'>Visibilitas</label> 
                            </div>
                        </div>
                    </div>
                    <div class='form-floating mb-2'> 
                        <input type='text' class='form-control' name='container_title'>
                        <label for='floatingInput'>Nama Container</label> 
                    </div>
                    <div class='form-floating mb-2'> 
                        <textarea type='number' class='form-control' name='info' style='height:90px;'></textarea>
                        <label for='floatingInput'>Info Container</label> 
                    </div>
                </div>
                <div class='modal-footer'>
                    <button type='submit' class='btn btn-success'><i class='fa-solid fa-floppy-disk'></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function getHexCode(){
        var hex = document.getElementById('colorPicker').value;

        document.getElementById('colorHex').value = hex;
    }
</script>