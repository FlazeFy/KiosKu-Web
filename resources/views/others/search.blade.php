<div class="navbar-nav align-items-center position-fixed" style="right:0px;">
    <div class="nav-item d-flex align-items-center"><i class="fa-solid fa-magnifying-glass fa-lg"></i>
        <input type="text" class="form-control border-0 shadow-none" id="searchInput" onkeyup="myFunction()" 
            placeholder="Cari ID / Nama..." aria-label="Cari ID..."/>
    </div>
</div>

<script>
    function myFunction() {
        var input, filter, ul, li, a, i, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        ul = document.getElementById("myUL");
        li = ul.getElementsByTagName("li");
        for (i = 0; i < li.length; i++) {
            a = li[i].getElementsByTagName("h6")[0];
            txtValue = a.textContent || a.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                li[i].style.display = "";
            } else {
                li[i].style.display = "none";
            }
        }
    }
</script>