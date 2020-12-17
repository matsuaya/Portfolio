<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>編集画面</title>
    </head>
    
    <body>
        <h2>勤怠編集</h2>
        @if (count($errors) > 0)
            <ul>
                @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        @endif
        <form action="{{ action('Admin\UserController@update') }}" method="post" enctype="multipart/form-data">
        <div class="form-group row">
            <input type="hidden" name="id" value="{{ $histories_form->id }}">
            <label class="col-md-2" for="title">社員ID</label>
            <div class="col-md-10">
                <input type="text" class="input_form" name="employee_code" value="{{ $histories_form->employee_code }}">
            </div>
            <label class="col-md-2" for="title">開始時刻</label>
            <div class="col-md-10">
                <input type="datetime-local" class="input_form" name="start_time" value="{{ \Carbon\Carbon::parse($histories_form->start_time)->format('Y-m-d\TH:i') }}">
            </div>
            <label class="col-md-2" for="title">終了時刻</label>
            <div class="col-md-10">
                <input type="datetime-local" class="input_form" name="end_time" value="{{ \Carbon\Carbon::parse($histories_form->end_time)->format('Y-m-d\TH:i') }}">
            </div>
            <label class="col-md-2" for="title">休憩時間</label>
            <div class="col-md-10">
                <input type="text" class="input_form" name="break_time" value="{{ $histories_form->break_time }}">
            </div>
            {{ csrf_field() }}
            <input type="submit" class="btn_edit" value="変更">
        </div>
        </form>
    </body>

</html>
