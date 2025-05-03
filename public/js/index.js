// HTMLが読み込まれてから実行 省略形
$(function () {
    //各学年のボタンが押下された時の通常処理を妨げる
    $("a[data-id]").click(function (e) {
        console.log("click");
    });
});
