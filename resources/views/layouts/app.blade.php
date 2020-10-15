<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

{{--    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">--}}
    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

</head>
<body>
    <div class="px-5 mb-5">
        <div class="d-flex align-items-center py-4 header">
            <svg class="logo" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30">
                <path class="fill-primary" d="M5.26176342 26.4094389C2.04147988 23.6582233 0 19.5675182 0 15c0-4.1421356 1.67893219-7.89213562 4.39339828-10.60660172C7.10786438 1.67893219 10.8578644 0 15 0c8.2842712 0 15 6.71572875 15 15 0 8.2842712-6.7157288 15-15 15-3.716753 0-7.11777662-1.3517984-9.73823658-3.5905611zM4.03811305 15.9222506C5.70084247 14.4569342 6.87195416 12.5 10 12.5c5 0 5 5 10 5 3.1280454 0 4.2991572-1.9569336 5.961887-3.4222502C25.4934253 8.43417206 20.7645408 4 15 4 8.92486775 4 4 8.92486775 4 15c0 .3105915.01287248.6181765.03811305.9222506z"/>
            </svg>

            <h4 class="mb-0 ml-2"><strong>{{ config('app.name', 'R-OFFERING') }}</strong></h4>

            <button class="btn btn-outline-primary ml-auto" title="Auto Load Entries">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="icon fill-primary">
                    <path d="M10 3v2a5 5 0 0 0-3.54 8.54l-1.41 1.41A7 7 0 0 1 10 3zm4.95 2.05A7 7 0 0 1 10 17v-2a5 5 0 0 0 3.54-8.54l1.41-1.41zM10 20l-4-4 4-4v8zm0-12V0l4 4-4 4z"></path>
                </svg>
            </button>
        </div>

        <div class="row mt-4">
            <div class="col-12 col-xl-2 col-md-4 col-sm-6 col-xs-6 sidebar mb-3 py-1">
                {!! \RServices\Facades\MenuFacade::render() !!}
            </div>
            <div class="col-12 col-xl-10 col-md-8 col-sm-6 col-xs-6 py-1">
                <div class="p-3" style="background-color: #23272A">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
    @if (count($errors) > 0)
        <script>
            rservices.notify.error('@foreach ($errors->all() as $error) {{ $error }} <br> @endforeach');
        </script>
    @endif
    @if ($success = session()->get('success'))
        <script>
            rservices.notify.success('{{ $success }}')
        </script>
    @endif
    @yield('scripts')
</body>
</html>
