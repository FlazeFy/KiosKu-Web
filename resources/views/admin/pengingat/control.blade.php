<style>

</style>

<div class="container-fluid mb-4 p-0">
    <form method="POST" action="/pengingat/filterday" class="d-inline m-2">
        @csrf
        <input name="date" value="{{date('Y-M-d')}}" hidden>
        <button class="btn btn-primary mt-2" style="width:100px; height:50px !important;" type="submit">Hari ini</button>
    </form>
    <form method="POST" action="/pengingat/filterday" class="float-start m-2">
        @csrf
        <div class='form-floating' style="width:150px;"> 
            <input type='date' class='form-control' onchange="this.form.submit()" name='date' value='{{date("Y-m-d", strtotime(session()->get("filter_day_key")))}}'>
            <label for='floatingInput'>Tanggal</label>
        </div>
    </form>
    <form method="POST" action="/pengingat/view_pengingat" class="float-start m-2">
        @csrf
        <div class="form-check form-switch">
            <input class="form-check-input fs-5" type="checkbox" role="switch" name="toggle_view" onchange="this.form.submit()" <?php if(session()->get('view_pengingat') == "Detail"){ echo " checked "; } ?>>
            <label class="form-check-label" for="flexSwitchCheckDefault">Tampilan Detail</label>
        </div>
    </form>
</div>