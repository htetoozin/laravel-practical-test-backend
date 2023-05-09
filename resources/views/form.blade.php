<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/form.css') }}">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">{{ $form->title }}</h1>
        <form action="#" onSubmit="show_alert();">
            @csrf
            @foreach($form->fields as $field)
                <div class="form-group">
                    <label>{{ $field['title'] }}</label>
                    <input type="{{ $field['type'] }}" 
                        name="{{ $field['title']}}"
                        {{ $field['required'] ? 'required': '' }}
                        class="form-control">
                </div>
            @endforeach
            <input type="submit" name="send" value="Save" class="btn btn-dark btn-block">
        </form>
    </div>
</body>
<script type="text/javascript">
    function show_alert() {
        alert("Form Submited");
       location.reload();
    }
</script>
</html>