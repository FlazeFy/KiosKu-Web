<style>
    .modal-content{
        background-color: white;
        border:none;
    }
</style>

@if(Session::has('deactivate_message'))
    <div class="modal fade" id="error_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Sukses</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img src="{{asset('assets/img/storyset/deactivate.png')}}" alt='deactivate.png' style='width:260px;'><br>
                <h7 class="m-2">{{ Session::get('deactivate_message') }}</h7>
            </div>
        </div>
    </div>
    </div>
@endif

<script>
    //Modal setting.
    $(window).on('load', function() {
        $('#deactivate_modal').modal('show');
    });
</script>