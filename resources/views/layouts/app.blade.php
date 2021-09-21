<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @endif
                        <button id="buttonLoginOTP" type="button" class="btn btn-info">Login OTP</button>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

</html>

<div id="modalOTP" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">One Time Password Login</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Email address</label>
                    <input autofocus type="email" class="form-control" id="inputEmail" placeholder="username@xxx.uad.ac.id" required>
                </div>
                <div id="formInputOTP" class="form-group" style="display:none;">
                    <label id="greetingForUser" for="exampleFormControlInput1"></label>
                    <input id="inputOTP" autofocus type="text" class="form-control" required>   
                </div>
            </div>
            <div id="alertModal"></div>
            <div class="modal-footer">
                <button id="buttonLogin" type="button" class="btn btn-primary" style="display:none;">Login</button>
                <div id="loadingProgress"></div>
                <button id="buttonRequestAnOTP" type="button" class="btn btn-primary">Request an OTP</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Showing modal -->
<script>
    $(document).ready(function() {
        $('#buttonLoginOTP').click(function() {
            $('#modalOTP').modal("show");
            $('#modalOTP').on('shown.bs.modal', function() {
                $('#inputEmail').focus();
            })
        });
    });
</script>

<!-- Validasi email -->
<script>
    $(document).ready(function() {
        $('#buttonRequestAnOTP').click(function() {
            var email = $("#inputEmail").val();
            var alertIsEmailNotExist = 'You are not a member!'
            var alertCheckEmail = 'Please check your email for an OTP'
            var alertEmailValidation = 'Enter your valid email'

            function isValidEmail(email) {
                var regex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

                var trimmedDomain = email.substr(email.length - 9, email.length);
                var uadDomain = 'uad.ac.id';

                if (regex.test(email) && trimmedDomain === uadDomain) {
                    return true
                }

                if ((regex.test(email) && trimmedDomain !== uadDomain) || !regex.test(email)) {
                    if (trimmedDomain !== uadDomain) {
                        return false
                    }
                }
            }

            if (!isValidEmail(email)) {
                $("#alertModal").html("<div class='alert alert-danger' role='alert'>" +
                    alertEmailValidation + "</div>");
            }

            if (isValidEmail(email)) {
                $.ajax({
                    url: "{{ url('/') }}/emailcheck/" + email,
                    method: "get",
                    dataType: 'JSON',
                    beforeSend: function() {
                        $("#loadingProgress").html("Wait...<div class='spinner-border text-info' role='status'><span class='sr-only'></span></div>");
                        $("#buttonRequestAnOTP").hide();
                    },
                    success: function(response) {

                        //TODO fixed loading progress when email valid uad.ac.id but not exist.
                        if (response.length === 0) {
                            $("#alertModal").html("<div class='alert alert-danger' role='alert'>" +
                                alertIsEmailNotExist + "</div>");
                            $("#loadingProgress").hide();
                            $("#buttonRequestAnOTP").show();
                        }

                        if (response.length > 0) {
                            $("#formInputOTP").show();
                            $("#buttonLogin").show();
                            $("#buttonRequestAnOTP").hide();
                            $("#greetingForUser").html("<label id='greetingForUser' for='exampleFormControlInput1'>" + "Hi <b>" + response[0].name + "</b>, enter your OTP</label>");
                            $("#alertModal").html("<div class='alert alert-success' role='alert'>" +
                                alertCheckEmail + "</div>");
                            $("#inputOTP").focus();
                            $("#inputEmail").prop('disabled', true);
                            $("#loadingProgress").hide();
                        }
                    }
                });
            }
        });
    });
</script>

<!-- Processing OTP -->
<script>
    $(document).ready(function() {
        $('#buttonLogin').click(function() {
            var alertOTPIsEmpty = 'Enter your OTP'
            var alertUnknownOTP = 'Enter your valid OTP'
            var otp = $('#inputOTP').val();
            var email = $("#inputEmail").val();
            var name = $("#greetingForUser").val();

            function isOTPEmpty(otp) {
                if (otp) {
                    return false;
                } else {
                    return true;
                }
            }

            if (isOTPEmpty(otp)) {
                $("#alertModal").show();
                $("#alertModal").html("<div class='alert alert-danger' role='alert'>" +
                    alertOTPIsEmpty + "</div>");
                $("#inputOTP").focus();
            }

            if (!isOTPEmpty(otp)) {
                $.ajax({
                    url: "{{ url('/') }}/otpcheck/" + email + '/' + otp,
                    method: "get",
                    dataType: 'JSON',
                    beforeSend: function() {
                        $("#loadingProgress").show();
                        $("#loadingProgress").html("Wait...<div class='spinner-border text-info' role='status'><span class='sr-only'></span></div>");
                        $("#buttonLogin").hide();
                    },
                    success: function(response) {
                        if (response.length === 0) {
                            $("#alertModal").html("<div class='alert alert-warning' role='alert'>" +
                                alertUnknownOTP + "</div>");
                            $("#loadingProgress").hide();
                            $("#buttonLogin").show();
                        }

                        if (response.length > 0 && (response[0].email === email)) {
                            alert('welcome ' + email);
                            location.href = "{{ url('/') }}"
                        }
                    }
                });
            }
        });
    });
</script>