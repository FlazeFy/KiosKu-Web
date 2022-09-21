<style>

</style>

<div class="container-fluid mb-4 p-0">
    <form method="POST" action="/pengingat/filterday" class="d-inline ms-3">
        @csrf
        <input name="date" value="{{date('Y-M-d')}}" hidden>
        <button class="btn btn-primary mt-2" style="width:100px;" type="submit">Hari ini</button>
    </form>
    <form method="POST" action="/pengingat/filterday" class="float-start">
        @csrf
        <div class='form-floating' style="width:150px;"> 
            <input type='date' class='form-control' onchange="this.form.submit()" name='date' value='{{date("Y-m-d", strtotime(session()->get("filter_day_key")))}}'>
            <label for='floatingInput'>Tanggal</label>
        </div>
    </form>
</div>