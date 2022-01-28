<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header position-relative">
                                    <h3>Update your profile details.</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        @if(!empty($user->profile))
                                        <div class="row">
                                            <div class="col-12">
                                                <img class="avatar-img" width="200" src="{{ asset($user->profile) }}" alt="{{ $user->name }}">
                                            </div>
                                        </div>
                                        @else
                                        <div class="row">
                                            <img class="avatar-img" src="{{ asset('img/index.jpg') }}" alt="{{ $user->name }}">
                                        </div>
                                        @endif
                                    </div>
                                    <form action="{{ route('profile') }}" method="post" id="profile-form" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <x-auth-validation-errors class="text-center mb-6" :errors="$errors" />
                                        </div>

                                        <div class="row mt-3">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label class="small" for="profile-name">Name</label>
                                                    <input class="form-control" id="name" type="text" placeholder="Enter your name" name="name" value="{{ $user->name }}">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label class="small" for="profile-phone">Phone</label>
                                                    <input class="form-control" id="mobile" type="text" placeholder="Enter your number" name="mobile" value="{{ $user->phone }}">
                                                </div>
                                            </div>
                                        </div>
        
                                        <div class="row mt-3">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label class="small" for="profile-email">Email</label>
                                                    <input class="form-control" id="email" type="email" placeholder="Enter your email" name="email" value="{{ $user->email }}">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label class="small">Profile Image</label>
                                                    <input id="upload-user-photo" class="form-control" type="file" name="profile">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-3">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label class="small" for="profile-email">Gender</label>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="Male" {{ $user->gender == 'Male' ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="inlineRadio1">Male</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="Female" {{ $user->gender == 'Female' ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="inlineRadio2">Female</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label class="small" for="profile-email">Hobby</label>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="hobby[]" value="Cricket" {{ strpos($user->hobby, 'Cricket') !== false ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="inlineCheckbox1">Cricket</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox2" name="hobby[]" value="Chess" {{ strpos($user->hobby, 'Chess') !== false ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="inlineCheckbox2">Chess</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox3" name="hobby[]" value="Reading" {{ strpos($user->hobby, 'Reading') !== false ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="inlineCheckbox3">Reading</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-3">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label class="small" for="profile-about">Address</label>
                                                    <textarea class="form-control" id="address" rows="1" placeholder="Address" data-autosize="true" name="address"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label class="small" for="profile-about">Country</label>
                                                    <select class="form-select" aria-label="Default select example" id="country" name="country">
                                                        <option>Select Country</option>
                                                        <option value="India" {{ $user->country == 'India' ? 'selected' : '' }}>India</option>
                                                        <option value="USA" {{ $user->country == 'USA' ? 'selected' : '' }}>USA</option>
                                                        <option value="UK" {{ $user->country == 'UK' ? 'selected' : '' }}>UK</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group mt-3">
                                            <button class="btn btn-lg btn-primary btn-block" type="submit">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
