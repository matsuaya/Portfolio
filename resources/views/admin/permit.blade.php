<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{ secure_asset('css/calendar.css') }}" rel="stylesheet">
        <link href="{{ secure_asset('css/form.css') }}" rel="stylesheet">
        <title>管理者画面</title>
    </head>
    <body>
      <a class="calendar" href="{{ action('Admin\UserController@listView')}}">勤怠一覧画面へ戻る</a>
      <CENTER>
      <h2>申請状況</h2>
      <table class="table table-bordered" bordere=5>
        <thead class="thead-dark">
          <tr>
            <th width="15%">日付</th>
            <th width="15%">社員ID</th>
            <th width="20%">名前</th>
            <th width="20%">予定取得時間</th>
            <th width="15%">操作</th>
          </tr>
        </thead>
        <tbody>
          @foreach($applications as $rest)
          <tr>
            <td>{{ $rest->day->format( 'Y-m-d' ) }}</td>
            <td>{{ $rest->employee_code }}</td>
            <td>{{ $rest->name }}</td>
            <td>{{ $rest->plan_rest_time }}</td>
            <td>
            <div>
              <a href="{{ action('Admin\ManageController@agree', ['id' => $rest->id]) }}">承認</a>
            </div>
            </td>
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
      
      <form  id="frm_left" action="{{ action('Admin\ManageController@update') }}" method="post" enctype="multipart/form-data">
        <fieldset>
          <legend>ユーザー登録</legend>
          <div class="form-group row">
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
            <label class="col-md-2" for="title">パスワード
              <input type="text" class="input_form" name="password">
            </label>
            </p>
            <p>
            <label class="col-md-2" for="title">メールアドレス
              <input type="text" class="input_form" name="email">
            </label>
            </p>
            <p>
            <label class="col-md-2" for="title">権限
              <input type="text" class="input_form" name="role">
            </label>
            </p>
            <p>
            <label class="col-md-2" for="title">有給（h）
              <input type="text" class="input_form" name="sum_rest_time">
            </label>
            </p>
            {{ csrf_field() }}
            <input type="submit" class="btn_regist" value="登録">
          </div>
        </fieldset>
      </form>
      </CENTER>
  </body>
</html>
