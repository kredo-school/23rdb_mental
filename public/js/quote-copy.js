  // コピーボタン押下時の処理
  // $('#btn-copy-quote').click(function () {
    // コピー対象を取得
    // var copyTarget = $('#order-quote-copy');
    // コピー対象のテキストを選択
    // copyTarget.select();
    // 選択したテキストをクリップボードにコピー
    // document.execCommand("Copy");
    // コピー完了メッセージの表示
  //   alert("URLをコピーしました。");
  // })


  // function copyText () {
  //   const $target = document.querySelector('.copyTarget');
  //   if (!$target) {
  //     return false;
  //   }
  //   const range = document.createRange();
  //   range.selectNode($target);
  //   window.getSelection().removeAllRanges();
  //   window.getSelection().addRange(range);
  
  //   // document.execCommand('copy'); // ←非推奨に。
  //   navigator.clipboard.writeText($target.innerText);
  
  //   return false;
  // }
  // document.querySelector('.copyBtn').addEventListener('click', copyText, false);

  function copyButton(elementId) {
    // 指定したIDの要素のテキストを取得
    var element = document.getElementById(elementId);

    // テキストをクリップボードにコピー
    navigator.clipboard.writeText(element.textContent);

    alert('copied'); // コピー完了時にアラートで表示
}
  