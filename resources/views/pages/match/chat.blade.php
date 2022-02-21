@extends('layouts.app')

@section('content')

    <div class="chat bg-light p-4" style="height:630px;">
      <div class="message d-flex flex-row align-items-start mb-4">
        <div class="message-icon rounded-circle bg-secondary text-white fs-3">
          <i class="fas fa-user"></i>
        </div><!-- .message-icon -->
        <p class="message-text p-2 ms-2 mb-0 bg-warning">
          サンプルテキスト。サンプルテキスト。サンプルテキスト。サンプルテキスト。サンプルテキスト。
        </p><!-- .message-text -->
      </div><!-- .message -->
      <div class="message d-flex flex-row-reverse align-items-start mb-4">
        <div class="message-icon rounded-circle bg-secondary text-white fs-3">
          <i class="fas fa-user"></i>
        </div><!-- .message-icon -->
        <p class="message-text p-2 me-2 mb-0 bg-info">
          サンプルテキスト。サンプルテキスト。サンプルテキスト。サンプルテキスト。
        </p><!-- .message-text -->
      </div>
      @foreach($authChats as $chat)
      <p>{{ $chat['chat'] }}</p>
@endforeach
      <!-- .message -->

         <form method="post" action="{{ route('chat') }}">
            @csrf
            <input id="to_user_id" name="to_user_id" type="hidden" value="{{ $user->id }}" />
            <input id="message" name="message" type="text" value="" />

            <input type="button" value="send" id="send">
        </form>




    </div><!-- .chat -->
<script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
<script>
    // $("#send").on("click", function () {
    //     alert('aaa');
    // });
$(function() {

    $("#send").on("click", function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'post',
            url: '/chat',
            dataType: 'json',
            data: {
                'to_user_id' : $("#to_user_id").val(),
                'message' : $("#message").val()
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

        }).done(function (data) {
            console.log('success');
            let html = '';

            $.each(data, function (index, value) { //dataの中身からvalueを取り出す

                let id = value.from_user_id;
                let chat = value.chat;
// １ユーザー情報のビューテンプレートを作成
                html = `
                            <div class="user-list">
                                <p>${id}</p>
                                <p>${chat}</p>
                            </div>
                                `
                            });
            $('.chat').append(html); //できあがったテンプレートをビューに追加

// 検索結果がなかったときの処理
            if (data.length === 0) {
                $('.user-index-wrapper').after('<p class="text-center mt-5 search-null">ユーザーが見つかりません</p>');
            }

        }).fail(function(msg) {
            console.log('Ajax Err');
        });
  });
});
  </script>

@endsection
