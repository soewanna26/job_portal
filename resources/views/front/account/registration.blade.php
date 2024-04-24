@extends('front.layouts.app')

@section('main')
    <section class="section-5">
        <div class="container my-5">
            <div class="py-lg-2">&nbsp;</div>
            <div class="row d-flex justify-content-center">
                <div class="col-md-5">
                    <div class="card shadow border-0 p-5">
                        <h1 class="h3">Register</h1>
                        <form action="" method="Post" name="registrationForm" id="registrationForm">
                            <div class="mb-3">
                                <label for="" class="mb-2">Name*</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    placeholder="Enter Name">
                                <p></p>
                            </div>
                            <div class="mb-3">
                                <label for="" class="mb-2">Email*</label>
                                <input type="text" name="email" id="email" class="form-control"
                                    placeholder="Enter Email">
                                <p></p>
                            </div>
                            <div class="mb-3">
                                <label for="" class="mb-2">Password*</label>
                                <input type="password" name="password" id="password" class="form-control"
                                    placeholder="Enter Password">
                                <p></p>
                            </div>
                            <div class="mb-3">
                                <label for="" class="mb-2">Confirm Password*</label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="form-control" placeholder="Enter Password">
                            </div>
                            <button class="btn btn-primary mt-2">Register</button>
                        </form>
                    </div>
                    <div class="mt-4 text-center">
                        <p>Have an account? <a href="{{ route('account.login') }}">Login</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('customJs')
    <script type="text/javascript">
        $("#registrationForm").submit(function(e) {
            e.preventDefault();
            $("button[type='submit']").prop('disabled', true);
            $.ajax({
                url: '{{ route('account.processRegister') }}',
                type: "Post",
                data: $(this).serializeArray(),
                dataType: "json",
                success: function(response) {
                    $("button[type='submit']").prop('disabled', false);
                    var errors = response.errors
                    if (response.status == false) {
                        if (errors.name) {
                            $("#name").siblings("p").addClass("invalid-feedback").html(errors.name);
                            $("#name").addClass('is-invalid');
                        } else {
                            $("#name").siblings("p").removeClass("invalid-feedback").html('');
                            $("#name").removeClass('is-invalid');
                        }

                        if (errors.email) {
                            $("#email").siblings("p").addClass("invalid-feedback").html(errors.email);
                            $("#email").addClass('is-invalid');
                        } else {
                            $("#email").siblings("p").removeClass("invalid-feedback").html('');
                            $("#email").removeClass('is-invalid');
                        }

                        if (errors.password) {
                            $("#password").siblings("p").addClass("invalid-feedback").html(errors
                                .password);
                            $("#password").addClass('is-invalid');
                        } else {
                            $("#password").siblings("p").removeClass("invalid-feedback").html('');
                            $("#password").removeClass('is-invalid');
                        }
                    } else {
                        $("#name").siblings("p").removeClass("invalid-feedback").html('');
                        $("#name").removeClass('is-invalid');

                        $("#email").siblings("p").removeClass("invalid-feedback").html('');
                        $("#email").removeClass('is-invalid');

                        $("#password").siblings("p").removeClass("invalid-feedback").html('');
                        $("#password").removeClass('is-invalid');

                        window.location.href = "{{ route('account.login') }}";
                    }
                },
                error: function(jqXHR, execption) {
                    console.log("something went wrong");
                }
            })
        })
    </script>
@endsection
