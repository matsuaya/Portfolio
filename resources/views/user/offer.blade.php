<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>申請画面</title>
    </head>
    <body>
        <h2>有給申請</h2>
        <form action="{{ action('Admin\UserController@restApply') }}" method="post" enctype="multipart/form-data">
        <div class="form-group row">
            <label class="col-md-2" for="title">日付</label>
            <div class="col-md-10">
                <input type="text" class="input_form" name="day">
            </div>
            <label class="col-md-2" for="title">社員ID</label>
            <div class="col-md-10">
                <input type="text" class="input_form" name="employee_code">
            </div>
            <label class="col-md-2" for="title">名前</label>
            <div class="col-md-10">
                <input type="text" class="input_form" name="name">
            </div>
            <label class="col-md-2" for="title">予定有給取得時間（h）</label>
            <div class="col-md-10">
                <input type="text" class="input_form" name="plan_rest_time">
            </div>
            {{ csrf_field() }}
            <input type="submit" class="btn_apply" value="申請">
        </div>
        </form>
    </body>
</html>