<div class="modal fade" id="pilih-fitur-{{$i}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pilih Fitur</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body fitur-holder" style="height:80vh;">
                <div class="row">
                    @foreach($fitur as $ft)
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <form method="POST" action="/kasir/tampilan/pilih_fitur/{{$tp->id}}">
                                @csrf
                                <input type="number" name="key" value="{{$i}}" hidden>
                                <input type="text" name="old" value="{{$tp->format_tampilan}}" hidden>
                                <input type="text" name="fitur" value="{{$ft->id}}" hidden>
                                <button class="fitur-box shadow" type="submit">
                                    <img class="img img-fluid d-block mx-auto" src="http://127.0.0.1:8000/assets/img/storyset/{{$ft->url_fitur}}" style="width:120px;">
                                    <h5>{{$ft->nama_fitur}}</h5>
                                    <p style="font-size:15px;">{{$ft->deskripsi_fitur}}</p>
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>