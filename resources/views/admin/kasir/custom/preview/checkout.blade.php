<style>
    .checkout{
        display: flex;
        padding:10px;
        flex-direction: column;
        height: 100%;
        overflow-y: scroll;
        max-width: 100%;
        overflow-x: hidden;
    }
</style>

<div class="checkout" id="checkout">
    <div class="checkout-item-holder">
        <div class="row px-1">
            <div class="col-8">
                <h6 class="text-primary">Garam</h6>
                <a class="text-secondary">Rp. 3500</a>
            </div>
            <div class="col-4">
                <h6 class="text-primary">x 2</h6>
                <a class="text-secondary">Diskon Rp. 500</a><br>
                <a class="text-secondary">Rp. 6750</a>
            </div>
        </div><hr>
        <div class="row px-1">
            <div class="col-8">
                <h6 class="text-primary">Mie Goreng</h6>
                <a class="text-secondary">Rp. 3000</a>
            </div>
            <div class="col-4">
                <h6 class="text-primary">x 3</h6>
                <a class="text-secondary">Rp. 9000</a>
            </div>
        </div><hr>
    </div>
    <div class="px-2 text-end">
        <div class="row mb-3">
            <div class="col-8">
                <h6 class="text-secondary">Sub Total</h6>
                <h6 class="text-primary">Rp. 20000</h6>
            </div>
            <div class="col-4">
                <h6 class="text-secondary">Pajak 10%</h6>
                <h6 class="text-primary">Rp. 2000</h6>
            </div>
        </div>
        <h6 class="text-secondary">Total</h6>
        <h6 class="text-primary">Rp. 22000</h6>
    </div>
</div>

<script>
    var myDiv = document.getElementById("checkout");
	myDiv.scrollTop = myDiv.scrollHeight;
</script>