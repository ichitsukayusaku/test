$(function() {
    $('.search__btn').on('click',function(e) {
        e.preventDefault();
        const form = $(this);
        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            url: '/home',
            method: 'GET',
            data: {
                keyword: $('#keyword').val(),
                company_id: $('#company_id').val(),
                max_price: $('#max_price').val(),
                min_price: $('#min_price').val(),
                max_stock: $('#max_stock').val(),
                min_stock: $('#min_stock').val()
            },
            dataType: 'html',
            })

            .done (function(data) {
                $('body').html(data);
            })
            .fail (function(jqXHR, textStatus, errorThrown) {
                console.log('エラーが発生しました。');
            });
          
    });
});


//非同期削除処理
$(function() {
    $('.btn__destroy').on('click', function(e) {
      e.preventDefault();
      const form = $(this);
      const id = form.data('delete_btn');
      const deleteTarget = form.parent().parent().parent();
        if (confirm('削除してもよろしいですか？')) {
        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            url: '/home/destroy/'+id,
            method: 'POST',
            data: {
                $id: id
            },
            dataType: 'json',
            })

            .done (function(data) {
                deleteTarget.remove();
            })
            .fail (function(jqXHR, textStatus, errorThrown) {
                console.log('Error: ' + errorThrown);
            });
        }   
    });
});