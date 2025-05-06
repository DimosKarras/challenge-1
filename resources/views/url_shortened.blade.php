<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>URL Shortener | Shortened URL</title>
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

<div class="main container">
    {{-- SHORTENED URL  --}}
    <div class="card mt-5 text-center">
        <h4 class="card-title">Shortened URL</h4>
        <div class="card-body">
            <p class="card-text">{{ url('/') . '/visit?id=' . $shortened_url->short_code }}</p>
            Original Site: <a href="{{ $shortened_url->original_url }}" class="card-link">{{ $shortened_url->original_url }}</a>
            <div id="qrCode" class="my-2">
                {!! $qrCode !!}
            </div>
        </div>
    </div>

    {{-- STATISTICS --}}
    <h2>Most accessed URLs.</h2>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Link</th>
            <th>Visited</th>
        </tr>
        </thead>
        <tbody>
        @foreach($most_visited_links as $link)
            @if($link->url_visited > 0)
            <tr>
                <td>{{ url('/') . '/visit?id=' . $link->short_code }}</td>
                <td>{{ $link->url_visited }}</td>
            </tr>
            @endif
        @endforeach
        </tbody>
    </table>

    <h2>Latest generated URLs</h2>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Link</th>
            <th>Generated at</th>
        </tr>
        </thead>
        <tbody>
        @foreach($last_generated_links as $link)
            <tr>
                <td>{{ url('/') . '/visit?id=' . $link->short_code }}</td>
                <td>{{ $link->created_at }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

</body>
</html>
