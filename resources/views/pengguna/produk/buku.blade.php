<style>
.pagination li {
  display:inline-block;
  padding:5px;
}
</style>
<script src="//cdnjs.cloudflare.com/ajax/libs/list.js/1.5.0/list.min.js"></script>
<div class="row">
    <div class="col-md-12 col-md-offset-0" style="margin-bottom:20px">
        <input type="text"  class="col-md-10 pull-right filterInput" id="pencarian" style="border-radius: 15px; height: 30px;" placeholder="Search Katalog. . . " > &nbsp &nbsp&nbsp
    </div>
</div>

    
@include('pengguna.produk.paging_buku')
<input type="hidden" id="hidden_page" value="1">
<input type="hidden" id="id_jenisproduk" value="1">


<script>
    $('.filterInput').on('change',function(){
        var page = $('#hidden_page').val();
        var pencarian = $('#pencarian').val();
        ambil_pagingbuku(1,pencarian);
    });

    $(document).on('click', '#pagingkatalog ul.pagination a', function(event){
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        $('#hidden_page').val(page);
        var pencarian = $('#pencarian').val();
        ambil_pagingbuku(page,pencarian);
    });

    function ambil_pagingbuku(page,pencarian)
    {
        $.ajax({
            type: 'GET',
            url: "{{ url('/tiketlayananproduk/fetch-data-katalog/filter') }}"+'?page='+page+'&pencarian='+pencarian,
            beforeSend: function() {
                $('#loaderForm').show();
            },
            success: function(data) {
                $('#loaderForm').hide();
               $('#contentBukuField').html(data);
            },
            error: function(xhr) { // if error occured
                $('#loaderForm').hide();
                console.log(xhr.statusText + xhr.responseText);
                
            },
            complete: function() {
                $('#loaderForm').hide();
            }
          });
    }
</script>
