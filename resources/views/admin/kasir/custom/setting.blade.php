<div class='modal fade' id='edit-container-{{$ct->id}}' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <form action='' method='POST'>
                @csrf
                <div class='modal-header'>
                    <h5 class='modal-title' id='exampleModalLabel'>Edit Container</h5>
                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                </div>
                <div class='modal-body'>
                    <div class='row'>
                        <div class='col-6'>
                            <div class='form-floating mb-2'> 
                                <input type='number' class='form-control' name='height' value='' required> 
                                <label for='floatingInput'>Tinggi Container</label> 
                            </div>
                        </div>
                        <div class='col-6'>
                            <div class='form-floating mb-2'> 
                                <input type='number' class='form-control' name='width' value='' required> 
                                <label for='floatingInput'>Lebar Container</label> 
                            </div>
                        </div>
                    </div>
                    <div class='form-floating mb-2'> 
                        <textarea type='number' class='form-control' name='info' value='' style='height:90px;'></textarea>
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