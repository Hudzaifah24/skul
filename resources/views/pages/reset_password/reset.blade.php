<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Title --}}
    <title>Reset Password</title>

    {{-- Style --}}
    @include('includes.style')

    @stack('style')
  </head>

  <body class="nav-md">
    <div class="container body">
        <div class="main_container">
          <!-- page content -->
          <div class="col-md-12">
            <div class="col-middle">
              <div class="text-center text-center">
                <h2>Akses Ditolak!!</h2>
                <p>Password Anda Wajib Diganti Dahulu!</p>
                <div class="mid_center">
                  <form method="POST" action="{{route('password.update', Auth::user()->id)}}" class="my-login-validation">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="password">Ganti Password Anda</label>
                        <input id="password" type="password" class="form-control" name="password" required="" placeholder="password" data-eye>
                        <div class="invalid-feedback">
                            Password Wajib Diisi!
                        </div>
                        <div class="form-text text-muted">
                            Dengan mengklik "Ganti Password", Password akan teratur ulang
                        </div>
                    </div>

                    <div class="form-group m-0">
                        <button type="submit" class="btn btn-primary btn-block">
                            Ganti Password
                        </button>
                    </div>
                </form>
                </div>
              </div>
            </div>
          </div>
          <!-- /page content -->
        </div>
    </div>

    {{-- Script --}}
    @include('includes.script')

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
  </body>
</html>
