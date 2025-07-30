@extends('layouts.app')
@section('content')
<div class="p-4 sm:ml-64">
    <div class="p-4 rounded-lg mt-14">
        <x-breadcrumb :links="[
            ['url' => '#', 'text' => 'User Setting'],
        ]" />

        <div class="max-w-full mt-4 mx-auto bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Edit Profile</h2>

            @if(session('success'))
            <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700">
                <p>{{ session('success') }}</p>
            </div>
            @endif

            @if(session('error'))
            <div class="mb-6 p-4 bg-red-100 border-l-4 border-red-500 text-red-700">
                <p>{{ session('error') }}</p>
            </div>
            @endif

            <!-- Form Section -->
            <form action="{{ route('users.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Name Field -->
                <div class="mb-6">
                    <label for="nama_lengkap" class="block mb-2 text-sm font-medium text-gray-900">Full Name</label>
                    <input type="text" id="nama_lengkap" name="nama_lengkap"
                        value="{{ old('nama_lengkap', auth()->user()->nama_lengkap) }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required>
                    @error('nama_lengkap')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email Field (readonly) -->
                <div class="mb-6">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                    <input type="email" id="email" name="email" value="{{ auth()->user()->email }}"
                        class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 cursor-not-allowed"
                        readonly>
                </div>

                <!-- Password Update Section -->
                <div class="mb-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Change Password</h3>

                    <!-- Current Password -->
                    <div class="mb-4">
                        <label for="current_password" class="block mb-2 text-sm font-medium text-gray-900">Current
                            Password</label>
                        <input type="password" id="current_password" name="current_password"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        @error('current_password')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- New Password -->
                    <div class="mb-4">
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900">New Password</label>
                        <input type="password" id="password" name="password"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        @error('password')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm New Password -->
                    <div class="mb-4">
                        <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900">Confirm
                            New Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        Update Profile
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- JavaScript for Image Preview -->
<script>
    document.getElementById('foto_profile').addEventListener('change', function(event) {
        const [file] = event.target.files;
        if (file) {
            // Validate file type
            const validTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
            if (!validTypes.includes(file.type)) {
                alert('Please select a valid image file (JPEG, PNG, JPG, GIF)');
                event.target.value = '';
                return;
            }

            // Validate file size (2MB)
            if (file.size > 2 * 1024 * 1024) {
                alert('File size must be less than 2MB');
                event.target.value = '';
                return;
            }

            // Preview image
            const preview = document.getElementById('preview_profile_photo');
            preview.src = URL.createObjectURL(file);

            // Revoke the object URL to avoid memory leaks
            preview.onload = function() {
                URL.revokeObjectURL(preview.src);
            }
        }
    });
</script>
@endsection
