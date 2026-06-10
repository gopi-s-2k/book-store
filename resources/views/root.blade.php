<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        @isset($title)
            {{ $title }} |
            @endisset{{ config('app.name', 'Real Estate Listing') }}
        </title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    </head>

    <body>
        @yield('layout')
        <div class="toast-container position-fixed top-0 end-0 p-3">
            <div id="appToast" class="toast" role="alert">
                <div class="toast-body d-flex align-items-center justify-content-between">
                    <span id="toastMessage">Operation completed successfully.</span>

                    <button type="button" class="btn-close ms-3" data-bs-dismiss="toast" aria-label="Close">
                    </button>
                </div>
            </div>
        </div>
    </body>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script>
        function showToast(message) {
            $('#toastMessage').text(message);
            const toast = bootstrap.Toast.getOrCreateInstance(
                document.getElementById('appToast')
            );
            toast.show();
        }
    </script>
    @yield('script')

    </html>
