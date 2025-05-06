<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>URL Shortener | Home</title>
    @vite(['resources/js/app.js'])

    <style>
        @media screen and (min-width: 992px) {
            .main {
                width: 50%;
            }
        }
    </style>
</head>
<body>

<div class="main container mt-2">
    {{-- URL SHORTENER --}}
    <div class="card mt-5">
        <h4 class="card-title text-center mt-3">URL Shortener</h4>
        <div class="card-body">
            <form action="{{ route('fetch_url') }}" method="POST">
                @csrf
                <div class="mb-3 mt-3">
                    <label for="url">URL</label>
                    <input type="text" class="form-control" id="url" placeholder="Enter URL" name="url">
                    @error('url')
                    <div style="color: red;">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Generate URL</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>
