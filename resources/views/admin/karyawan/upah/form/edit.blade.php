<div class="modal fade" id="edit-upah-Modal-{{$kr->id_karyawan}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="/karyawan/upah/edit_upah/{{$kr->id_karyawan}}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Upah</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-6">
                            <div class='form-floating mb-2'> 
                                <input type='number' class='form-control' name='gaji_karyawan' value="{{$kr->gaji_karyawan}}" min="1" required> 
                                <label for='floatingInput'>Gaji (Rp.)</label> 
                            </div> 
                            <div class='form-floating mb-2'> 
                                <select class="form-select" id="floatingSelectGrid" name="jabatan_karyawan" required>
                                    @foreach($total_jabatan as $jb)
                                        <option <?php if($jb->nama_jabatan == $kr->jabatan_karyawan){ echo " selected "; } ?> value="{{$jb->nama_jabatan}}">{{$jb->nama_jabatan}}</option>
                                    @endforeach
                                </select>
                                <label for="floatingSelect">Jabatan</label>
                            </div>
                        </div> 
                        <div class="col-6">
                            <p class="text-secondary mt-3">Perbandingan :</p>
                            
                        </div>
                    </div>
                    <p class="text-primary text-center">Ketikkan nama lengkap karyawan sebagai verifikasi</p>
                    <input type='text' class='form-control w-50 d-block mx-auto' name='nama_lengkap_karyawan' placeholder="{{$kr->nama_lengkap_karyawan}}" required> 

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>