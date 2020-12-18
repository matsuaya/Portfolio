<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>勤怠一覧画面</title>
        
    </head>
    
    <body>
        <h2>勤怠一覧</h2>
        {{-- ログアウトボタン追加　--}}
        <a href={{ route('logout') }} onclick="event.preventDefault();document.getElementById('logout-form').submit();">
        Logout
        </a>
        <form id='logout-form' action={{ route('logout')}} method="POST" style="display: none;">
        @csrf
        </form>
        <div>
        <a href="{{ action('Admin\UserController@applyIndex')}}">有給申請</a>
        <a href="{{ action('Admin\UserController@createIndex')}}">勤怠登録</a>
        @can('admin_auth')
        <a href="{{ action('Admin\ManageController@manage')}}">管理画面</a>
        @endcan
        </div>
        <form action="{{ action('Admin\UserController@csvExport') }}" method='post'>
        @csrf
        <table class="left-table table-bordered">
        <thead class="thead-dark">
          <tr>
            <th width="15%">日付</th>
            <th width="20%">始業時刻</th>
            <th width="20%">終業時刻</th>
            <th width="20%">休憩時間(h)</th>
            <th width="15%">操作</th>
          </tr>
          <tbody>
            @php
            $count=0;
            @endphp
            @for($i=1;$i<=date('t');$i++)
            <tr>
              <td>{{ $i."日" }}</td>
                @if($count<count($histories)&&$histories[$count]->start_time->format('j') == $i)
                    <td>{{ $histories[$count]->start_time }}</td>
                    <td>{{ $histories[$count]->end_time }}</td>
                    <td>{{ $histories[$count]->break_time }}</td>
                    <td>
                      <div>
                        <a href="{{ action('Admin\UserController@edit', ['id' => $histories[$count]->id]) }}">編集</a>
                      </div>
                    </td>
                  @php
                  $count++;
                  @endphp
                @else
                    <td>未入力</td>
                    <td>未入力</td>
                    <td>未入力</td>
                    <td></td>
                @endif
            </tr>
            @endfor
        </tbody>
        <button type='submit'>CSV出力</button>
        </thead>
        </table>
        </form>
    </body>
</html>
