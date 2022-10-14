<!--Set heading by container height-->
@php($heading = "")
@if($ct->height < 25)
    @php($heading = "h2")
@else 
    @php($heading = "h1")
@endif

<div class="row p-2">
    <div class="col-4">
        <h5 class="text-success">Total</h5>
        <<?php echo $heading; ?> class="text-success">Rp. 15750</<?php echo $heading; ?>>
    </div>
    <div class="col-4">
        <h5 class="text-primary">Qty</h5>
        <<?php echo $heading; ?> class="text-primary">5</<?php echo $heading; ?>>
    </div>
    <div class="col-4">
        <h5 class="text-primary">Bayar</h5>
        <<?php echo $heading; ?> class="text-primary">Rp. 20000</<?php echo $heading; ?>>
    </div>
    <!-- <div class="col-4">
        <h5 class="text-primary">Kembalian</h5>
        <<?php //echo $heading; ?> class="text-primary">Rp. 4250</<?php //echo $heading; ?>>
    </div> -->
</div>