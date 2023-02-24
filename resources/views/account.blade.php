<x-layout>

    <body>
        <section class="py-5 my-5">
            <div class="container">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <p><strong>Opps Something went wrong</strong></p>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <div class="bg-white shadow rounded-lg d-block d-sm-flex">
                    <div class="profile-tab-nav border-right">
                        <div class="p-4">
                            <div class="img-circle text-center mb-3">
                                <img id="imagePreview" src="{{ $user->getFirstMediaUrl('images') }}" width="250"
                                    height="250" alt="Image" class="shadow" />
                            </div>
                            <h4 class="text-center">{{ $user->name }}</h4>
                        </div>

                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                            aria-orientation="vertical">
                            <a class="nav-link active" id="account-tab" data-toggle="pill" href="#account"
                                role="tab" aria-controls="account" aria-selected="true">
                                <i class="fa fa-home text-center mr-1"></i>
                                Account
                            </a>

                            <a class="nav-link" id="security-tab" data-toggle="pill" href="#security" role="tab"
                                aria-controls="security" aria-selected="false">
                                <i class="fa fa-user text-center mr-1"></i>
                                Security
                            </a>

                        </div>
                    </div>
                    <div class="tab-content p-4 p-md-5" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="account" role="tabpanel"
                            aria-labelledby="account-tab">
                            <h3 class="mb-4">Account Settings</h3>
                            <form method="POST" action="{{ route('account.update', $user->id) }}">
                                @csrf
                                @method('PATCH')
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input name="name" type="text" class="form-control"
                                                value="{{ $user->name }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input name="email" type="text" class="form-control"
                                                value="{{ $user->email }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </div>
                            </form>
                        </div>
                          <div class="mt-5">
                                        <input onchange="uploadImage(event)" name="image" type="file"
                                            id="image" class="form-control" />

                                    </div>

                    </div>
                    <div class="tab-pane fade" id="security" role="tabpanel" aria-labelledby="security-tab">
                        <h3 class="mb-4">Security Settings</h3>
                        <form method="POST" action="{{ route('account.resetPassword', $user->id) }}">
                            @csrf
                            @method('PATCH')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Old password</label>
                                        <input name="password" type="password" class="form-control">

                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>New password</label>
                                        <input name="newPassword" type="password" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div>

                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
            </div>
        </section>

        <script>
            function uploadImage(event) {
                var image = event.target.files[0];
                var formData = new FormData();
                formData.append('image', image);
                formData.append('_token', '{{ csrf_token() }}');

                $.ajax({
                    url: '{{ route('account.updateImage', $user->id) }}',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        var imageUrl = response.image_url;
                        var imagePreview = document.getElementById('imagePreview');
                        imagePreview.src = imageUrl;
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                });
            };
        </script>
</x-layout>
