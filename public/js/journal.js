$(function () {
    let like = $('.button_plus'); //button_plusのついたiタグを取得し代入。
    like.on('click', function () {
    });

    // let like = $('.button_plus'); //button_plusのついたiタグを取得し代入。
    // let journal_id;
    // like.on('click', function () {
    //   alert("テスト");
    //   let $this = $(this); //this=イベントの発火した要素＝iタグを代入
    //   journal_id = $this.data('journal_id'); //iタグに仕込んだdata-review-idの値を取得
    //   //ajax処理スタート
    //   $.ajax({
    //     headers: {
    //       'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
    //     },
    //     url: '/journal/like_plus_one',
    //     method: 'POST',
    //     data: {
    //       'journal_id': journal_id //いいねされた投稿のidを送る
    //     },
    //   })
    //   //成功した時の処理
    //   .done(function (data) {
    //     // 返却されたカウント後のいいね数を表示
    //     $this.next('.like-counter').html(data.likes_count);
    //   })
    //   //失敗した時の処理
    //   .fail(function () {
    //     console.log('err');
    //   });
    // });
});
