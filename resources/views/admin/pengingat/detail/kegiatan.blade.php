<style>
    .pengingat-holder .pengingat-item {
		padding: 0 0 20px 20px;
		margin-top: -2px;
		border-left: 3px solid #676afb;
		position: relative;
		margin-left:30px;
    }
    .pengingat-holder .pengingat-item ul {
      	padding-left: 20px;
    }
    .pengingat-holder .pengingat-item ul li {
      	padding-bottom: 10px;
    }
    .pengingat-holder .pengingat-item:last-child {
    	padding-bottom: 0;
    }
    .pengingat-holder .pengingat-item::before {
		content: "";
		position: absolute;
		width: 24px;
		height: 24px;
		border-radius: 50px;
		left: -13px;
		top: 25%;
		background: #e7e7ef;
		border: 3px solid #676afb;
    }
	.pengingat-holder .pengingat-item.inprogress::before {
		content: "";
		position: absolute;
		width: 24px;
		height: 24px;
		border-radius: 50px;
		left: -13px;
		top: 25%;
		background: #676afb;
		border: 3px solid #676afb;
    }
    .kegiatan-detail-box{
        border-radius:6px;
        padding: 14px;
        width:100%;
        background: white;
        border: 2px solid #676AFB;
        display:inline-block;
        text-align:left;
        margin-top: 10px;
    }
    .last-updated{
        color:#404040;
        font-style:italic;
        margin-right:5px;
        font-size:13px;
    }
</style>

<div class="pengingat-holder">
    @if(count($kegiatan) != 0)
        @php($date_before = "")
        @foreach($kegiatan as $kg)
            <!--Date diff-->
            @php($date_now = date('H', strtotime($kg->waktu_mulai)))
            @if(($date_before == "") || ($date_before != $date_now))
                @php($date_before = date('H', strtotime($kg->waktu_mulai)))
                <div class="container my-2 w-100 rounded p-3" style="background:#e7e7ff;">    
                    <h6 class="text-primary"><i class="fa-regular fa-clock"></i> {{date('H', strtotime($kg->waktu_mulai))}}:00-{{date('H', strtotime($kg->waktu_mulai))}}:59</h6> 
                </div>
            @endif
            <div class="pengingat-item">
                <div class="kegiatan-detail-box shadow">
                    <h6 class="text-success float-end">{{$kg->kegiatan_type}}</h6>
                    <h5>{{$kg->kegiatan_title}}</h5><hr>
                    <p class="text-secondary"><?php echo nl2br($kg->kegiatan_desc); ?></p>
                    <h6 class="text-primary">Waktu : <span class="text-secondary fw-normal">{{date("y/m/d H:i", strtotime($kg->waktu_mulai))}} <b>s/d</b> {{date("y/m/d H:i", strtotime($kg->waktu_selesai))}}</span></h6>
                    <h6 class="text-primary">Tempat :</h6>
                    <h6 class="text-primary">Keterangan :</h6>

                    <div class="file-holder">
                        <h6 for="formFile" class="text-primary">File Terlampir :</h6>
                        @if($kg->kegiatan_url != null)
                            @php($url = json_decode($kg->kegiatan_url, true))

                            @foreach($url as $u)
                                @if($u['type'] == "image")
                                    <img class="img img-fluid d-block mx-auto" src="{{url('storage/'.$u['url'])}}" style="max-width:600px;"/>
                                @endif
                            @endforeach
                        @endif
                    </div>

                    <hr><div class="kegiatan-manage-box">
                        <a class="last-updated">Terakhir diubah : {{date("Y-m-d H:i", strtotime($kg->updated_at))}}</a>
                        <button class="btn btn-warning float-end me-2 text-white" data-bs-target="#edit-kegiatan-{{$kg->id}}" data-bs-toggle="modal"><i class="fa-solid fa-edit"></i> Edit</button>
                        <button class="btn btn-primary float-end me-2"><i class="fa-solid fa-thumbtack"></i> Tandai</button>
                        <button type="submit" class="btn btn-success-secondary shadow-sm float-end me-2"><i class="fa-solid fa-check"></i> Selesaikan</button>
                    </div>
                </div>
            </div>

            <!--Modal-->
            @include('admin.pengingat.form.edit')
        @endforeach
    @else
        <div class="container text-center d-block mx-auto">
            <img class="mx-2" src="{{asset('assets/img/storyset/Empty_2.png')}}" alt='Empty.png' style="width:45%; min-width:280px !important;">
            <h5>Tidak ada aktivitas hari ini</h5>
        </div>
    @endif
</div>