  // コピーボタン押下時の処理
  $('#btn-copy-quote').click(function () {
    // コピー対象を取得
    var copyTarget = $('#order-quote-copy');
    // コピー対象のテキストを選択
    copyTarget.select();
    // 選択したテキストをクリップボードにコピー
    document.execCommand("Copy");
    // コピー完了メッセージの表示
    alert("URLをコピーしました。");
  })