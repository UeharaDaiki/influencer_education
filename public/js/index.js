// HTMLが読み込まれてから実行 省略形
$(function () {
    //＋が押下された時の処理
    // 既に存在するものへのイベントの書き方
    $("#delivery_time").click(function (e) {
        const row = $("<div>", {
            class: "row",
        });

        const from = $("<div>", {
            class: "col-3 mb-3",
        }).append(
            $("<input>", {
                type: "datetime-local",
                class: "form-control",
                name: "delivery_from[]",
            })
        );

        const separator = $("<div>", {
            class: "col-1 text-center mb-3",
        }).text("〜");

        const to = $("<div>", {
            class: "col-3 mb-3",
        }).append(
            $("<input>", {
                type: "datetime-local",
                class: "form-control",
                name: "delivery_to[]",
            })
        );

        const del = $("<div>", {
            class: "col-1 text-center mb-3",
        }).append(
            $("<button>", {
                type: "button",
                class: "btn btn-danger remove-row",
            }).text("ー")
        );

        row.append(from, separator, to, del);
        $("#add_time").append(row);
    });

    // 削除処理
    // .onにすることでこれから追加されるものにもイベントが効かせれる
    $(document).on("click", ".remove-row", function (e) {
        // ボタンのデフォルト操作を無効化
        e.preventDefault();
        // $(クリックされたもの).一番近い(.rowを).削除する;
        $(this).closest(".row").remove();
    });
});
