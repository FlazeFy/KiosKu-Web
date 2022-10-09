<div class="modal fade" id="edit-harga-Modal-{{$brg->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/barang/gudang/edit_harga/{{$brg->id}}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Harga</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class='form-floating mb-2'> 
                                <input type='number' class='form-control' name='harga_stok' id="harga_stok_{{$brg->id}}" value="{{$brg->harga_stok}}" onblur="totalKeuntungan_<?php echo $brg->id; ?>()" required> 
                                <label for='floatingInput'>Harga Stok (Rp.)</label> 
                            </div> 
                            <div class='form-floating mb-2'> 
                                <input type='number' class='form-control' name='harga_jual' id="harga_jual_{{$brg->id}}" value="{{$brg->harga_jual}}" onblur="totalKeuntungan_<?php echo $brg->id; ?>()" required> 
                                <label for='floatingInput'>Harga Jual (Rp.)</label> 
                            </div>
                        </div> 
                        <div class="col-6">
                            <p class="text-secondary mt-3">Total Keuntungan :</p>
                            <h5 class="text-primary" id="keuntungan_{{$brg->id}}">Rp. {{$brg->harga_jual - $brg->harga_stok}}</h5>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>