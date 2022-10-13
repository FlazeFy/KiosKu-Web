<style>
    .container-body{
        width:100%;
        height:100%;
        border:2px solid grey;
    }
</style>

<div class="row layout-box w-100" id="layout-box">
    <?php
        //This will be adapted to karyawan role or admin kasir view mode..

        // function delete_all_between($beginning, $end, $string) {
        //     $beginningPos = strpos($string, $beginning);
        //     $endPos = strpos($string, $end);
        //     if ($beginningPos === false || $endPos === false) {
        //         return $string;
        //     }

        //     $textToDelete = substr($string, $beginningPos, ($endPos + strlen($end)) - $beginningPos);

        //     return delete_all_between($beginning, $end, str_replace($textToDelete, '', $string));
        // }
        //$out = delete_all_between('<!--setting-->', '<!--setting end-->', $tp->format_tampilan);
    ?>
    @foreach($tampilan as $tp)
        @php($config = json_decode($tp->format_tampilan))
        @php($i = 0)
        @foreach($config as $ct)
            @php($text_color = "text-primary")
            @if(strtolower($ct->background) != "#ffffff")
                @php($text_color = "text-white")
            @endif
            <div class='col-lg-{{$ct->width}} col-md-{{$ct->width}} box'>
                <div class='container-fluid mb-4 p-3 rounded shadow box-1 position-relative' style='height:{{$ct->height}}; background:{{$ct->background}};'>
                    <button class='btn btn-transparent p-0 position-absolute' type='button' data-bs-toggle='modal' data-bs-target='#edit-container-{{$i}}'
                        style='right:0px; top:0px;' title='Edit'><i class='fa-solid fa-gear mt-1 more {{$text_color}}'></i>
                    </button>
                    <button class='btn btn-transparent p-0 position-absolute' type='button' data-bs-toggle='modal' data-bs-target='#pilih-fitur-{{$i}}'
                        style='right:40px; top:0px;' title='Pilih Fitur'><i class="fa-solid fa-screwdriver-wrench mt-1 more {{$text_color}}"></i>
                    </button>
                    <h6 class='{{$text_color}}'>
                        @if($ct->container_title != null)
                            {{$ct->container_title}}
                        @else 
                            -
                        @endif
                    </h6>
                    <h5 class="text-center {{$text_color}}">Container Kosong</h5>
                </div>
            </div>
            @include('admin.kasir.custom.form.setting')
            @include('admin.kasir.custom.form.fitur')
            @php($i++)
        @endforeach
    @endforeach
</div>

<script type="text/javascript">
    //Set hex code from color picker.
    <?php
        foreach($tampilan as $tp){
            $config = json_decode($tp->format_tampilan);
            $i = 0;
            foreach($config as $ct){
                echo "
                    function getHexCode_".$i."(){
                        var hex = document.getElementById('colorPicker_".$i."').value;

                        document.getElementById('colorHex_".$i."').value = hex;
                    }
                ";
                $i++;
            }
        }
    ?>


    //Get data.
    // $(document).ready(function() {
    //     clear();
    // });
    
    // function clear() {
    //     setTimeout(function() {
    //         update();
    //         clear();
    //     }, 1500); //Every 1500 milliseconds
    // }
    
    // function update() {
    //     $.ajax({
    //         url: '/tampilan/getTampilan/1',
    //         type: 'get',
    //         dataType: 'json',
    //         success: function(response){
    //             var len = 0;
    //             $('#layout-box').empty(); 
    //             if(response != null){
    //                 len = response.length;
    //             }
                
    //             if(len > 0){
    //                 for(var i=0; i<len; i++){
    //                     //Attribute
    //                     var format = response[i].format_tampilan;

    //                     var tr_str = format;

    //                     $("#layout-box").append(tr_str);
    //                 }
    //             }
    //         }
    //    });
    // }
</script>