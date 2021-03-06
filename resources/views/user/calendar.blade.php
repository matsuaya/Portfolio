
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{ secure_asset('css/calendar.css') }}" rel="stylesheet">
        <title>勤怠一覧画面</title>
        
    </head>
    
    <body>
        <CENTER>
        <h2>勤怠一覧</h2>
        {{-- ログアウトボタン追加　--}}
        @can('admin_auth')
        <a class="admin" href="{{ action('Admin\ManageController@manage')}}">管理画面</a>
        @endcan
        <a class="apply" href="{{ action('Admin\UserController@applyIndex')}}">有給申請</a>
        <a class="create" href="{{ action('Admin\UserController@createIndex')}}">勤怠登録</a>
        <a class="logout" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
        Logout
        </a>
        <form id='logout-form' action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
        </form>
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
            @for($i=1;$i<=$day;$i++)
            <tr>
              <td>{{ $year."-".$month."-".str_pad($i,2,0,STR_PAD_LEFT) }}</td>
                @if($count<count($histories)&&$histories[$count]->start_time->format('j') == $i)
                    <td>{{ $histories[$count]->start_time->format('H:i') }}</td>
                    <td>{{ $histories[$count]->end_time->format('H:i') }}</td>
                    <td>{{ $histories[$count]->break_time }}</td>
                    <td>
                      <div>
                        <a class="edit" href="{{ action('Admin\UserController@edit', ['id' => $histories[$count]->id]) }}">編集</a>
                      </div>
                    </td>
                  @php
                  $count++;
                  @endphp
                @else
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td></td>
                @endif
            </tr>
            @endfor
          </tbody>
          <input type="hidden" name="year" value="{{ $year }}">
          <input type="hidden" name="month" value="{{ $month }}">
        <button class="csv" type='submit'>CSV出力</button>
        </form>
        
        <form action="{{ action('Admin\UserController@listChange') }}" method="post" enctype="multipart/form-data">
        @csrf
        <p>
          <input type="month" name="change">
          <button class="change" type='submit'>表示</button>
        </p>
        </form>
        </thead>
        </table>
        
        </CENTER>
    </body>
</html>
