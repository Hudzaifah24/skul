@extends('layouts.auth')

@section('title')
    Login
@endsection

@push('style')
    <style>
        html,body {
            height: 100%;
        }

        body.my-login-page {
            background-color: #f7f9fb;
            font-size: 14px;
        }

        .my-login-page .brand {
            width: 90px;
            height: 90px;
            overflow: hidden;
            border-radius: 50%;
            margin: 40px auto;
            box-shadow: 0 4px 8px rgba(0,0,0,.05);
            position: relative;
            z-index: 1;
        }

        .my-login-page .brand img {
            width: 100%;
        }

        .my-login-page .card-wrapper {
            width: 400px;
        }

        .my-login-page .card {
            border-color: transparent;
            box-shadow: 0 4px 8px rgba(0,0,0,.05);
        }

        .my-login-page .card.fat {
            padding: 10px;
        }

        .my-login-page .card .card-title {
            margin-bottom: 30px;
        }

        .my-login-page .form-control {
            border-width: 2.3px;
        }

        .my-login-page .form-group label {
            width: 100%;
        }

        .my-login-page .btn.btn-block {
            padding: 12px 10px;
        }

        .my-login-page .footer {
            margin: 40px 0;
            color: #888;
            text-align: center;
        }
        @media screen and (max-width: 425px) {
            .my-login-page .card-wrapper {
                width: 90%;
                margin: 0 auto;
            }
        }

        @media screen and (max-width: 320px) {
            .my-login-page .card.fat {
                padding: 0;
            }

            .my-login-page .card.fat .card-body {
                padding: 15px;
            }
        }
    </style>
@endpush

@section('content')
    <section class="h-100">
        <div class="container h-100">
            <div class="row justify-content-md-center h-100">
                <div class="card-wrapper">
                    <div class="brand">
                        <img src="{{ asset('assets/production/images/logo.png') }}" alt="logo">
                    </div>
                    <div class="card fat">
                        <div class="card-body">
                            <h4 class="text-center card-title">Sekolah Al-Wahdah</h4>
                            <form action="{{route('postLogin')}}" method="POST"  class="my-login-validation">
                                @csrf
                                @method('POST')
                                <div class="form-group">
                                    <label for="email">E-Mail Address</label>
                                    <input id="email" type="email" class="form-control" name="email" value="{{old('email') ? 'admin@admin' : old('email')}}" required autofocus>
                                    <div class="invalid-feedback">
                                        Email is invalid
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="password">Password
                                        <a href="{{ route('forgotPasswprd.index') }}" class="float-right">
											Lupa Password?
										</a>
                                    </label>
                                    <input id="password" type="password" class="form-control" name="password" value="1234" required data-eye>
                                    <div class="invalid-feedback">
                                        Password is required
                                    </div>
                                </div>

                                <div class="custom-checkbox custom-control">
                                    <input type="checkbox" name="remember" id="remember" class="custom-control-input">
                                </div>

                                <div class="">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        Masuk
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="footer">
                        Copyright &copy; 2021 &mdash; Mahir Techno
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script>
        $(function() {

        // author badge :)
        var author = '';
        $("body").append(author);

        $("input[type='password'][data-eye]").each(function(i) {
            var $this = $(this),
                id = 'eye-password-' + i,
                el = $('#' + id);

            $this.wrap($("<div/>", {
                style: 'position:relative',
                id: id
            }));

            $this.css({
                paddingRight: 60
            });
            $this.after($("<div/>", {
                html: 'Lihat',
                class: 'btn btn-primary btn-sm',
                id: 'passeye-toggle-'+i,
            }).css({
                    position: 'absolute',
                    right: 10,
                    top: ($this.outerHeight() / 2) - 12,
                    padding: '2px 7px',
                    fontSize: 12,
                    cursor: 'pointer',
            }));

            $this.after($("<input/>", {
                type: 'hidden',
                id: 'passeye-' + i
            }));

            var invalid_feedback = $this.parent().parent().find('.invalid-feedback');

            if(invalid_feedback.length) {
                $this.after(invalid_feedback.clone());
            }

            $this.on("keyup paste", function() {
                $("#passeye-"+i).val($(this).val());
            });
            $("#passeye-toggle-"+i).on("click", function() {
                if($this.hasClass("show")) {
                    $this.attr('type', 'password');
                    $this.removeClass("show");
                    $(this).removeClass("btn-outline-primary");
                }else{
                    $this.attr('type', 'text');
                    $this.val($("#passeye-"+i).val());
                    $this.addClass("show");
                    $(this).addClass("btn-outline-primary");
                }
            });
        });

        $(".my-login-validation").submit(function() {
                var form = $(this);
                if (form[0].checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
                }
                form.addClass('was-validated');
            });
        });
    </script>
@endpush
