<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>MEBEL GACOR</title>
        <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">LOGIN MEBEL GACOR</h3></div>
                                    <div class="card-body">
                                        <form action="{{ route('authenticate') }}" method="post">
                                            @csrf
                                            <div class="input-group mb-3"> <input type="email" class="form-control" name="email"
                                                    placeholder="Email" required>
                                                <div class="input-group-text"> <span class="bi bi-envelope"></span> </div>
                                            </div>
                                            @error('email')
                                                <small>{{ $message }}</small>
                                            @enderror
                                            <div class="input-group mb-3"> <input type="password" class="form-control" name="password"
                                                    placeholder="Password" required>
                                                <div class="input-group-text"> <span class="bi bi-lock-fill"></span> </div>
                                            </div> <!--begin::Row-->
                                            @error('password')
                                                <small>{{ $message }}</small>
                                            @enderror
                                            <div class="row">
                                                <div class="col-8">
                                                    <div class="form-check"> <input class="form-check-input" type="checkbox" value=""
                                                            id="flexCheckDefault"> <label class="form-check-label" for="flexCheckDefault">
                                                            Remember Me
                                                        </label> </div>
                                                </div> <!-- /.col -->
                                                <div class="col-4">
                                                    <div class="d-grid gap-2"> <button type="submit" class="btn btn-primary">Sign In</button>
                                                    </div>
                                                </div> <!-- /.col -->
                                            </div> <!--end::Row-->
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="register.html">Need an account? Sign up!</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2023</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{ asset('assets/js/scripts.js') }}"></script>
        @if ($message = Session::get('success'))
        <script>
            swal.fire('{{ $message }}');
        </script>
    @endif
    @if ($message = Session::get('failed'))
        <script>
            swal.fire('{{ $message }}');
        </script>
    @endif
    </body>
</html>
