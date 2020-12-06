<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>管理者画面</title>
    </head>
    <body>
      <h2>ユーザー登録</h2>
      <form action="{{ action('Admin\ManageController@update') }}" method="post" enctype="multipart/form-data">
      <div class="form-group row">
        <label class="col-md-2" for="title" style="display:inline">社員ID</label>
        <div class="col-md-10" style="display:inline">
            <input type="text" class="input_form" name="employee_code">
        </div>
        <label class="col-md-2" for="title" style="display:inline">名前</label>
        <div class="col-md-10" style="display:inline">
            <input type="text" class="input_form" name="name">
        </div>
        <label class="col-md-2" for="title" style="display:inline">パスワード</label>
        <div class="col-md-10" style="display:inline">
            <input type="text" class="input_form" name="password">
        </div>
        <label class="col-md-2" for="title" style="display:inline">メールアドレス</label>
        <div class="col-md-10" style="display:inline">
            <input type="text" class="input_form" name="email">
        </div>
        <label class="col-md-2" for="title" style="display:inline">権限</label>
        <div class="col-md-10" style="display:inline">
            <input type="text" class="input_form" name="role">
        </div>
        <label class="col-md-2" for="title" style="display:inline">有給（h）</label>
        <div class="col-md-10" style="display:inline">
            <input type="text" class="input_form" name="sum_rest_time">
        </div>
        {{ csrf_field() }}
        <input type="submit" class="btn_regist" value="登録">
      </div>
      </form>
      <h2>申請状況</h2>
      <table class="table table-bordered" bordere=5>
        <thead class="thead-dark">
          <tr>
            <th width="15%">日付</th>
            <th width="15%">社員ID</th>
            <th width="30%">名前</th>
            <th width="30%">予定取得時間</th>
          </tr>
        </thead>
        <tbody>
          @foreach($applications as $rest)
          <tr>
            <td>{{ $rest->day }}</td>
            <td>{{ $rest->employee_code }}</td>
            <td>{{ $rest->name }}</td>
            <td>{{ $rest->plan_rest_time }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
      
      <h2>ユーザー情報</h2>
      <table class="table table-bordered">
        <thead class="thead-dark">
          <tr>
            <th width="15%">社員ID</th>
            <th width="15%">名前</th>
            <th width="30%">有給（h）</th>
          </tr>
        </thead>
        <tbody>
          @foreach($masters as $user)
            <tr>
              <td>{{ $user->employee_code }}</td>
              <td>{{ $user->name }}</td>
              <td>{{ $user->sum_rest_time }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
  </body>
</html>
