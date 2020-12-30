<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{ secure_asset('css/form.css') }}" rel="stylesheet">
        <link href="{{ secure_asset('css/calendar.css') }}" rel="stylesheet">
        <title>申請画面</title>
    </head>
    <body>
        <a class="calendar" href="{{ action('Admin\UserController@listView')}}">勤怠一覧画面へ戻る</a>
        <form action="{{ action('Admin\UserController@restApply') }}" method="post" enctype="multipart/form-data">
        <fieldset>
            <legend>有給申請</legend>
            <p>
            <label class="col-md-2" for="title">日付
                <input type="date" class="input_form" name="day">
            </label>
            </p>
            <p>
            <label class="col-md-2" for="title">社員ID
                <input type="text" class="input_form" name="employee_code">
            </label>
            </p>
            <p>
            <label class="col-md-2" for="title">名前
                <input type="text" class="input_form" name="name">
            </label>
            </p>
            <p>
            <label class="col-md-2" for="title">予定有給取得時間（h）
                <input type="text" class="input_form" name="plan_rest_time">
            </label>
            </p>
            <input type="hidden" name="rest_time" value="null">
            <input type="hidden" name="application_status" value="0">
            {{ csrf_field() }}
            <input type="submit" class="btn_apply" value="申請">
        </fieldset>
        </form>
        
        <CENTER>
        <h2>申請状況</h2>
        <table class="table table-bordered" bordere=5>
        <thead class="thead-dark">
            <tr>
                <th width="15%">日付</th>
                <th width="15%">社員ID</th>
                <th width="20%">名前</th>
                <th width="20%">予定取得時間</th>
                <th width="15%">申請状況</th>
            </tr>
        </thead>
        <tbody>
            @foreach($applications as $rest)
            <tr>
                <td>{{ $rest->day->format( 'Y-m-d' ) }}</td>
                <td>{{ $rest->employee_code }}</td>
                <td>{{ $rest->name }}</td>
                <td>{{ $rest->plan_rest_time }}</td>
                    @if($rest->application_status==1)
                        <td>承認</td>
                    @elseif($rest->application_status==2)
                        <td>否認</td>
                    @else
                        <td>未確認</td>
                    @endif
            </tr>
            @endforeach
        </tbody>
        </table>
        </CENTER>
    </body>
</html>