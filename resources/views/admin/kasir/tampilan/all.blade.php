<style>
    .layout-template{
        width: 100%;
        height: 240px;
        margin-bottom: 20px;
        padding: 20px;
        border-radius: 20px;
        background: white;
        border: none;
    }
</style>

<div class="row">
    <div class="col-lg-4 col-md-6 col-sm-6">
        <button class="container-fluid layout-template shadow text-center bg-primary">
            <img class="img img-fluid d-block mx-auto" src="{{asset('assets/img/storyset/Template.png')}}" alt='Template.png' style='height:150px;'>
            <h5 class="text-white">Buat Template</h5>
            <h6 class="text-white">Kreasikan tampilan menu kasir Anda</h6>
        </button>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6">
        <button class="container-fluid layout-template shadow" onclick="location.href='/tampilan/custom'">
            <h6 class="text-primary">Template Default</h6>
        </button>
    </div>
</div>