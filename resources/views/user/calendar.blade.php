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
        <div>
        <a href="{{ action('Admin\UserController@applyIndex')}}">有給申請</a>
        <a href="{{ action('Admin\UserController@editIndex')}}">勤怠編集</a>
        @can('admin_auth')
        <a href="{{ action('Admin\ManageController@manage')}}">管理画面</a>
        @endcan
        </div>
        <table class="table table-bordered">
        <thead class="thead-dark">
          <tr>
            <th width="15%">日付</th>
            <th width="20%">始業時刻</th>
            <th width="20%">終業時刻</th>
            <th width="20%">休憩時間(h)</th>
          </tr>
        </thead>
        <tbody>
          @foreach($days as $history)
            <tr>
              <td>{{ $history->day }}</td>
              <td>{{ $history->start_time }}</td>
              <td>{{ $history->end_time }}</td>
              <td>{{ $history->break_time }}</td>
            </tr>
          @endforeach
        </tbody>
        </table>

    </body>
</html>
