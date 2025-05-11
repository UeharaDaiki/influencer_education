$('.delete-btn').click(function(event) {
    event.preventDefault();
    var productId = $(this).data('id');
    var row = $(this).closest('.article-item');

    if (!confirm('本当に削除しますか？')) {
        return;
    }

    // CSRFトークンを取得
    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    // AJAXリクエストを送信
    $.ajax({
        url: '/influencer_education/public/admin/article_delete/' + productId,
        method: 'POST',
        data: {
            _token: csrfToken,
        },
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        },
        success: function(response) {
            if (response.success) {
                row.fadeOut();
                console.log(response.redirect_url);
                window.location.href = response.redirect_url;
            } else {
                alert('削除に失敗しました: ' + response.message);
            }
        },
        error: function(xhr, status, error) {
            console.log('Request URL:', '/product/delete/' + productId);
            console.log('AJAX Error:', error);
            console.log('Status:', status);
            console.log('Response Text:', xhr.responseText);
            alert('削除中にエラーが発生しました: ' + error);
        }
    });
});