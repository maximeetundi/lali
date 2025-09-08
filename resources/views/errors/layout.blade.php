@php

    // https://github.com/fbollon/lara-custom-error-pages/blob/038bcdf698acf93a24eaa1d0b14480386e1af891/resources/views/errors/layout.blade.php#L1

        $isRefresh = $exception->getStatusCode() === 503;
@endphp

    <!DOCTYPE html>
<html lang="en">
<head>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

    <style>
        #full {
            background: url('{{ asset('images/errors/'.$exception->getStatusCode().'.jpg') }}') no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }
    </style>
</head>

<body>

<div id="full" class="d-flex align-items-center justify-content-center vh-100">
    <div class="text-center">
        <h1 class="display-1 fw-bold">{{ $exception->getStatusCode() }}</h1>
        <p class="display-4"><span class="text-danger">Opps!</span> @yield('title')</p>

        @if(($message = $exception->getMessage()) !== null)
            <h3>{{ $message }}</h3>
        @else
            <h3>@yield('message')</h3>
        @endif

        @yield('link')

        <div class="footer-copyright text-center py-3">
            <p class="text-center small mb-0">{{ trans('Application')   }} : {{ config('app.name', 'Laravel') }}</p>
            <p class="text-center small mb-0">{{ trans('Url') }} : {{ Request::url() }}</p>
            <p class="text-center small mb-0">{{ now() }} {{ now()->getTimezone() }}</p>
        </div>

        @if ($isRefresh)
            <h4>{{ trans('Auto refresh in ') }}<span class="badge bg-success" id="timer"></span></h4>
        @endif

    </div>
</div>

@if ($isRefresh)

    @php
        // Check if the application is in maintenance mode...
        if (file_exists($down = __DIR__.'/../../../storage/framework/down')) {
            // Decode the "down" file's JSON...
            $data = json_decode(file_get_contents($down), true);

            $refreshCount  = $data['refresh'] ?? 5;
        } else {
            $refreshCount = 5;
        }
    @endphp

    <script>
        function checklength(i) {
            'use strict';
            if (i < 10) {
                i = "0" + i;
            }
            return i;
        }

        var minutes, seconds, count, counter, timer;
        count = {{ $refreshCount }};
        counter = setInterval(timer, 1000);

        function timer() {
            'use strict';
            count = count - 1;
            minutes = checklength(Math.floor(count / 60));
            seconds = checklength(count - minutes * 60);
            if (count < 0) {
                clearInterval(counter);
                return;
            }
            document.getElementById("timer").innerHTML = minutes + ':' + seconds + ' ';
            if (count === 0) {
                location.reload();
            }
        }
    </script>
@endif

</body>
</html>
