<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{ secure_asset('css/form.css') }}" rel="stylesheet">
        <title>編集画面</title>
    </head>
    
    <body>
        @if (count($errors) > 0)
            <ul>
                @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        @endif
        <a class="calendar" href="{{ action('Admin\UserController@listView')}}">勤怠一覧画面へ戻る</a>
        <form action="{{ action('Admin\UserController@update') }}" method="post" enctype="multipart/form-data">
        <fieldset>
            <legend>勤怠編集</legend>
            <div class="form-group row">
                <input type="hidden" name="id" value="{{ $histories_form->id }}">
                <p>
                <label class="col-md-2" for="title">社員ID
                    <input type="text" class="input_form" name="employee_code" value="{{ $histories_form->employee_code }}">
                </label>
                </p>
                <p>
                <label class="col-md-2" for="title">開始時刻
                    <input type="datetime-local" class="input_form" name="start_time" value="{{ \Carbon\Carbon::parse($histories_form->start_time)->format('Y-m-d\TH:i') }}">
                </label>
                </p>
                <p>
                <label class="col-md-2" for="title">終了時刻
                    <input type="datetime-local" class="input_form" name="end_time" value="{{ \Carbon\Carbon::parse($histories_form->end_time)->format('Y-m-d\TH:i') }}">
                </label>
                </p>
                <p>
                <label class="col-md-2" for="title">休憩時間
                    <input type="text" class="input_form" name="break_time" value="{{ $histories_form->break_time }}">
                </label>
                </p>
                {{ csrf_field() }}
                <input id="btn" type="submit" class="btn_edit" value="変更">
            </div>
        </fieldset>
        </form>
    </body>

</html>
