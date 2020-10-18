<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="px-5 mb-5">
        <div class="d-flex align-items-center py-3 header">
            <svg class="logo" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 170.03 47">
                <path class="cls-1" d="M0,5.85H12.76V35H29.57L28.5,46H0Z"/>
                <path class="cls-1" d="M34.07,5.85H46.83V46H34.07Z"/>
                <path class="cls-2" d="M75.64,0l-8,32.44L65,21.69H52.09L59.41,46H75.49l14-46Z"/>
                <path class="cls-1"
                      d="M127.37,30.64A20.53,20.53,0,0,1,126,37.11a14.57,14.57,0,0,1-3.46,5.17,16.33,16.33,0,0,1-5.68,3.46,23.06,23.06,0,0,1-8,1.26A23.33,23.33,0,0,1,100,45.48,15.93,15.93,0,0,1,94,41.24a17.39,17.39,0,0,1-3.55-6.52,28.62,28.62,0,0,1-1.15-8.35,30,30,0,0,1,1.15-8.49A18.55,18.55,0,0,1,94,11.05a16.77,16.77,0,0,1,6.24-4.55,22.52,22.52,0,0,1,9.08-1.66q8,0,12.14,3.76c2.78,2.52,4.54,6.09,5.29,10.74L114,20.75a11.08,11.08,0,0,0-.59-2,5.35,5.35,0,0,0-1-1.57,3.79,3.79,0,0,0-1.49-1,5.72,5.72,0,0,0-2.2-.37,5,5,0,0,0-4.55,2.42q-1.52,2.41-1.52,7.59a20.51,20.51,0,0,0,.54,5.2,8.39,8.39,0,0,0,1.43,3.12,4.42,4.42,0,0,0,2.08,1.51,7.4,7.4,0,0,0,2.42.4,5.21,5.21,0,0,0,3.71-1.32,6.5,6.5,0,0,0,1.74-4.08Z"/>
                <path class="cls-1"
                      d="M147.83,30.13,144.62,34V46H131.86V5.85h12.76V19.17L155.19,5.85h13.38l-12.48,15L170,46H156.15Z"/>
            </svg>
            <div class="dropdown ml-auto">
                <span class="dropdown-toggle" type="button" id="dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="https://eu.ui-avatars.com/api/?background=00e091&color=fff&bold=true&name={{ user()->name }}" class="avatar-logo" alt>
                    {{ user()->name }}
                </span>
                <div class="dropdown-menu" aria-labelledby="dropdownMenu">
                    <a class="dropdown-item" href="{{ route('manage.profile.view') }}">Profile</a>
                    <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12 col-xl-3 col-md-4 col-sm-6 col-xs-6 sidebar mb-3 py-1">
                {!! \RServices\Facades\MenuFacade::render() !!}
            </div>
            <div class="col-12 col-xl-9 col-md-8 col-sm-6 col-xs-6 py-1">
                @yield('before_content')
                <div class="p-3" style="background-color: #23272A">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
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
