document.querySelector('.image-fields__add-button').addEventListener('click', function () {
    const field = document.createElement('div');
    field.classList.add('image-fields__form');
    field.innerHTML = `
        <img src="{{ asset('images/no-image.png') }}" alt="プレビュー" class="image-fields__preview">
        <label class="custom-file-label">
            ファイルを選択
            <input accept="image/*" type="file" name="banners[]" class="image-fields__input">
        </label>
        <button type="button" class="image-fields__remove-button">ー</button>
    `;
    this.parentElement.insertBefore(field, this);
});

document.addEventListener('click', function (e) {
    if (e.target.classList.contains('image-fields__remove-button')) {
        const bannerId = e.target.getAttribute('data-banner-id');
        if(!bannerId) {
            // 新規追加のフィールドの場合
            e.target.parentElement.remove();
            return;
        }

        // 確認なしで即削除APIへPOST
        fetch('/admin/banner/delete', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ id: bannerId })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                e.target.parentElement.remove();
                // ここで画面をリロードする
                location.reload();
            } else {
                alert('削除に失敗しました');
            }
        })
        .catch(() => {
            alert('エラーが発生しました');
        });

    }
});

document.addEventListener('change', function (e) {
  if (e.target.classList.contains('image-fields__input')) {
    const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                const preview = e.target.closest('.image-fields__form').querySelector('.image-fields__preview');
                preview.src = event.target.result;
            }
            reader.readAsDataURL(file);
        }
    }
});