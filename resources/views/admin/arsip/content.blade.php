<style>
    .arsip-content{
        height: 80vh;
    }
    .kegiatan-box-arsip{
        border:2px solid #676AFB;
        padding:12px;
        margin:2px;
    }
</style>

<div class="card p-3 arsip-content">
    @php($val = json_decode(session()->get('view_archieve'), true))
    <h6 class="text-primary">/Arsip/{{$val['nama_arsip']}}</h6>
    <div class="row" id="item_holder">
        
    </div>
</div>  

<script type="text/javascript">
    //Get data ajax
    $(document).ready(function() {
        clear();
    });
    
    function clear() {
        setTimeout(function() {
            update();
            clear();
        }, 1500); //Every 1500 milliseconds
    }
    
    function update() {
        $.ajax({
            url: '/getRelasiArsip',
            type: 'get',
            dataType: 'json',
            success: function(response){
                var len = 0;
                $('#item_holder').empty(); 
                if(response != null){
                    len = response.length;
                }

                //Date converter.
                function convertDate(datetime){
                    if(datetime == null){
                        return "-";
                    } else {
                        const result = new Date(datetime);
                        return result.getFullYear() + "/" + (result.getMonth() + 1) + "/" + result.getDate() + " " + result.getHours() + ":" + result.getMinutes();
                    }
                }
                
                if(len > 0){
                    for(var i=0; i<len; i++){
                        //Attribute
                        var id = response[i].id;
                        var id_arsip = response[i].id_arsip;
                        var owner = response[i].id_owner;
                        var context = response[i].type_context;
                        var desc = response[i].desc_arsip;
                        var created_at = response[i].created_at;

                        //Pengingat
                        var k_title = response[i].kegiatan_title;
                        var k_desc = response[i].kegiatan_desc;
                        var k_type = response[i].kegiatan_type;
                        var k_url = response[i].kegiatan_url;
                        var k_waktu_mulai = response[i].waktu_mulai;
                        var k_waktu_selesai = response[i].waktu_selesai;

                        var tr_str = 
                            "<div class='col-lg-4 col-md-4 col-sm-6 mb-2'> " +
                                "<div class='kegiatan-box-arsip rounded shadow'> " +
                                    "<h6 class='text-success float-end'>" + k_type + "</h6> " +
                                    "<h6 class='text-secondary'>" + k_title + "</h6><hr> " +
                                    "<p class='text-secondary'>" + k_desc +  "</p> " +
                                    "<h6 class='text-primary'>Waktu : <span class='text-secondary fw-normal'>" + convertDate(k_waktu_mulai) + " <b>s/d</b> " + convertDate(k_waktu_selesai) + "</span></h6> " +
                                    "<h6 class='text-primary'>Tempat :</h6> " +
                                    "<h6 class='text-primary'>Keterangan :</h6> " +
                                "<div> " +
                            "</div>" ;

                        $("#item_holder").append(tr_str);
                    }
                }else{
                    var tr_str = 
                        "<div class='container text-center d-block mx-auto'> " +
                            "<img class='mx-2' src='{{asset('assets/img/storyset/Empty_1.png')}}' alt='Empty.png' style='width:35%; min-width:280px !important;'>" +
                            "<h5>Arsip kosong...</h5> " +
                        "</div> " ;

                    $("#item_holder").append(tr_str);
                }
            }
       });
    }
</script>