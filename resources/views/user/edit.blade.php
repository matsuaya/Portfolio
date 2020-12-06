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
        <form action="{{ action('Admin\UserController@edit') }}" method="post" enctype="multipart/form-data">
        <div class="form-group row">
            <label class="col-md-2" for="title">日付</label>
            <div class="col-md-10">
                <input type="text" class="input_form" name="day">
            </div>
            <label class="col-md-2" for="title">社員ID</label>
            <div class="col-md-10">
                <input type="text" class="input_form" name="employee_code">
            </div>
            <label class="col-md-2" for="title">開始時刻</label>
            <div class="col-md-10">
                <input type="text" class="input_form" name="start_time">
            </div>
            <label class="col-md-2" for="title">終了時刻</label>
            <div class="col-md-10">
                <input type="text" class="input_form" name="end_time">
            </div>
            <label class="col-md-2" for="title">休憩時間</label>
            <div class="col-md-10">
                <input type="text" class="input_form" name="break_time">
            </div>
            {{ csrf_field() }}
            <input type="submit" class="btn_edit" value="変更">
        </div>
        </form>
    </body>

</html>
