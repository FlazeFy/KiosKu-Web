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
        @foreach($config as $ct)
            @php($text_color = "text-primary")
            @if(strtolower($ct->background) != "#ffffff")
                @php($text_color = "text-white")
            @endif
            <div class='col-lg-{{$ct->width}} col-md-{{$ct->width}} box'>
                <div class='container-fluid mb-4 p-3 rounded shadow box-1' style='height:{{$ct->height}}; background:{{$ct->background}};'>
                    <button class='btn btn-transparent p-0 float-end' type='button' data-bs-toggle='modal' data-bs-target='#edit-container-{{$ct->id}}'>
                        <i class='fa-solid fa-gear mt-1 float-end more {{$text_color}}'></i>
                    </button>
                    <h6 class='{{$text_color}}'>{{$ct->container_title}}</h6>
                </div>
            </div>
            @include('admin.kasir.custom.form.setting')
        @endforeach
    @endforeach
</div>

<script type="text/javascript">
    //Set hex code from color picker.
    <?php
        foreach($tampilan as $tp){
            $config = json_decode($tp->format_tampilan);
            foreach($config as $ct){
                echo "
                    function getHexCode_".$ct->id."(){
                        var hex = document.getElementById('colorPicker_".$ct->id."').value;

                        document.getElementById('colorHex_".$ct->id."').value = hex;
                    }
                ";
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