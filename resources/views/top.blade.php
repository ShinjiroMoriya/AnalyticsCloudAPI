<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>CSV Uploader</h1>
    <h2>{{ $display_name }}</h2>
    <form action="/uploader" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div style="margin: 0 0 20px 0;">
            <select name="app_id">
                <option value="">選択してください</option>
                @foreach ($applications as $application)
                    <option value="{{ $application['Id'] }}">{{ $application['Name'] }}</option>
                @endforeach
            </select>
        </div>
        <div style="margin: 0 0 20px 0;">
            <input type="text" name="upload_name">
        </div>
        <div style="margin: 0 0 20px 0;">
            <input type="file" name="csv">
        </div>
        <div>
            <input type="submit">
        </div>
    </form>
</body>
</html>
