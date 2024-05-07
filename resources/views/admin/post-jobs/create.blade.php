@extends('front.layouts.app')

@section('main')
    <section class="section-5 bg-2">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Post Job</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    @include('admin.sidebar')
                </div>
                <div class="col-lg-9">
                    @include('front.message')
                    <div class="card border-0 shadow mb-4">
                        <form action="" name="saveJobForm" id="saveJobForm" method="post">
                            <div class="card-body card-form p-4">
                                <h3 class="fs-4 mb-1">Post Job</h3>
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="" class="mb-2">Title<span class="req">*</span></label>
                                        <input type="text" placeholder="Job Title" id="title" name="title"
                                            class="form-control">
                                        <p></p>
                                    </div>
                                    <div class="col-md-6  mb-4">
                                        <label for="" class="mb-2">Category<span class="req">*</span></label>
                                        <select name="category" id="category" class="form-control">
                                            <option value="">Select a Category</option>
                                            @if ($categories->isNotEmpty())
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <p></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="" class="mb-2">Job Nature<span class="req">*</span></label>
                                        <select class="form-select" name="jobType" id="jobType">
                                            <option value="">Select a Job Nature</option>
                                            @if ($jobTypes->isNotEmpty())
                                                @foreach ($jobTypes as $jobType)
                                                    <option value="{{ $jobType->id }}">{{ $jobType->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <p></p>
                                    </div>
                                    <div class="col-md-6  mb-4">
                                        <label for="" class="mb-2">Vacancy<span class="req">*</span></label>
                                        <input type="number" min="1" placeholder="Vacancy" id="vacancy"
                                            name="vacancy" class="form-control">
                                        <p></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="mb-4 col-md-6">
                                        <label for="" class="mb-2">Salary</label>
                                        <input type="text" placeholder="Salary" id="salary" name="salary"
                                            class="form-control">
                                    </div>

                                    <div class="mb-4 col-md-6">
                                        <label for="" class="mb-2">Location<span class="req">*</span></label>
                                        <input type="text" placeholder="location" id="location" name="location"
                                            class="form-control">
                                        <p></p>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="" class="mb-2">Description<span class="req">*</span></label>
                                    <textarea class="textarea" name="description" id="description" cols="5" rows="5"
                                        placeholder="Description"></textarea>
                                    <p></p>
                                </div>
                                <div class="mb-4">
                                    <label for="" class="mb-2">Benefits</label>
                                    <textarea class="textarea" name="benefits" id="benefits" cols="5" rows="5" placeholder="Benefits"></textarea>
                                </div>
                                <div class="mb-4">
                                    <label for="" class="mb-2">Responsibility</label>
                                    <textarea class="textarea" name="responsibility" id="responsibility" cols="5" rows="5"
                                        placeholder="Responsibility"></textarea>
                                </div>
                                <div class="mb-4">
                                    <label for="" class="mb-2">Qualifications</label>
                                    <textarea class="textarea" name="qualifications" id="qualifications" cols="5" rows="5"
                                        placeholder="Qualifications"></textarea>
                                </div>
                                <div class="mb-4">
                                    <label for="" class="mb-2">Experience</label>
                                    <select name="experience" id="experience">
                                        <option value="1">1 Year</option>
                                        <option value="2">2 Years</option>
                                        <option value="3">3 Years</option>
                                        <option value="4">4 Years</option>
                                        <option value="5">5 Years</option>
                                        <option value="6">6 Years</option>
                                        <option value="7">7 Years</option>
                                        <option value="8">8 Years</option>
                                        <option value="9">9 Years</option>
                                        <option value="10">10 Years</option>
                                        <option value="10_plus">10+ Years</option>
                                    </select>
                                    <p></p>
                                </div>



                                <div class="mb-4">
                                    <label for="" class="mb-2">Keywords<span class="req">*</span></label>
                                    <input type="text" placeholder="keywords" id="keywords" name="keywords"
                                        class="form-control">
                                </div>

                                <h3 class="fs-4 mb-1 mt-5 border-top pt-5">Company Details</h3>

                                <div class="row">
                                    <div class="mb-4 col-md-6">
                                        <label for="" class="mb-2">Name<span class="req">*</span></label>
                                        <input type="text" placeholder="Company Name" id="company_name"
                                            name="company_name" class="form-control">
                                        <p></p>
                                    </div>

                                    <div class="mb-4 col-md-6">
                                        <label for="" class="mb-2">Location</label>
                                        <input type="text" placeholder="Location" id="company_location"
                                            name="company_location" class="form-control">
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="" class="mb-2">Website</label>
                                    <input type="text" placeholder="Website" id="company_website"
                                        name="company_website" class="form-control">
                                </div>
                            </div>
                            <div class="card-footer  p-4">
                                <button type="submit" class="btn btn-primary">Save Job</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('customJs')
    <script type="text/javascript">
        $("#saveJobForm").submit(function(e) {
            e.preventDefault();
            $("button[type='submit']").prop('disabled', true);
            $.ajax({
                url: '{{ route('admin.saveJob') }}',
                type: "post",
                data: $(this).serializeArray(),
                dataType: "json",
                success: function(response) {
                    $("button[type='submit']").prop('disabled', false);
                    if (response.status == true) {
                        $("#title").siblings("p").removeClass("invalid-feedback").html('');
                        $("#title").removeClass('is-invalid');

                        $("#category").siblings("p").removeClass("invalid-feedback").html('');
                        $("#category").removeClass('is-invalid');

                        $("#jobType").siblings("p").removeClass("invalid-feedback").html('');
                        $("#jobType").removeClass('is-invalid');

                        $("#vacancy").siblings("p").removeClass("invalid-feedback").html('');
                        $("#vacancy").removeClass('is-invalid');

                        $("#location").siblings("p").removeClass("invalid-feedback").html('');
                        $("#location").removeClass('is-invalid');

                        $("#description").siblings("p").removeClass("invalid-feedback").html('');
                        $("#description").removeClass('is-invalid');

                        $("#experience").siblings("p").removeClass("invalid-feedback").html('');
                        $("#experience").removeClass('is-invalid');

                        $("#company_name").siblings("p").removeClass("invalid-feedback").html('');
                        $("#company_name").removeClass('is-invalid');


                        window.location.href = "{{ route('admin.jobs') }}";
                    } else {
                        var errors = response.errors;
                        if (errors.title) {
                            $("#title").siblings("p").addClass("invalid-feedback").html(errors.title);
                            $("#title").addClass('is-invalid');
                        } else {
                            $("#title").siblings("p").removeClass("invalid-feedback").html('');
                            $("#title").removeClass('is-invalid');
                        }

                        if (errors.category) {
                            $("#category").siblings("p").addClass("invalid-feedback").html(errors
                                .category);
                            $("#category").addClass('is-invalid');
                        } else {
                            $("#category").siblings("p").removeClass("invalid-feedback").html('');
                            $("#category").removeClass('is-invalid');
                        }

                        if (errors.jobType) {
                            $("#jobType").siblings("p").addClass("invalid-feedback").html(errors
                                .jobType);
                            $("#jobType").addClass('is-invalid');
                        } else {
                            $("#jobType").siblings("p").removeClass("invalid-feedback").html('');
                            $("#jobType").removeClass('is-invalid');
                        }

                        if (errors.vacancy) {
                            $("#vacancy").siblings("p").addClass("invalid-feedback").html(errors
                                .vacancy);
                            $("#vacancy").addClass('is-invalid');
                        } else {
                            $("#vacancy").siblings("p").removeClass("invalid-feedback").html('');
                            $("#vacancy").removeClass('is-invalid');
                        }

                        if (errors.location) {
                            $("#location").siblings("p").addClass("invalid-feedback").html(errors
                                .location);
                            $("#location").addClass('is-invalid');
                        } else {
                            $("#location").siblings("p").removeClass("invalid-feedback").html('');
                            $("#location").removeClass('is-invalid');
                        }

                        if (errors.description) {
                            $("#description").siblings("p").addClass("invalid-feedback").html(errors
                                .description);
                            $("#description").addClass('is-invalid');
                        } else {
                            $("#description").siblings("p").removeClass("invalid-feedback").html('');
                            $("#description").removeClass('is-invalid');
                        }

                        if (errors.experience) {
                            $("#experience").siblings("p").addClass("invalid-feedback").html(errors
                                .experience);
                            $("#experience").addClass('is-invalid');
                        } else {
                            $("#experience").siblings("p").removeClass("invalid-feedback").html('');
                            $("#experience").removeClass('is-invalid');
                        }

                        if (errors.company_name) {
                            $("#company_name").siblings("p").addClass("invalid-feedback").html(errors
                                .company_name);
                            $("#company_name").addClass('is-invalid');
                        } else {
                            $("#company_name").siblings("p").removeClass("invalid-feedback").html('');
                            $("#company_name").removeClass('is-invalid');
                        }
                    }
                },
                error: function(jqXHR, execption) {
                    console.log("something went wrong");
                }
            })
        })
    </script>
@endsection
