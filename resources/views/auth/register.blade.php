<!-- resources/views/auth/register.blade.php -->
@extends('layouts.app')

@section('content')
    <section class="bg-gray-900">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <div class="w-full rounded-lg shadow border md:mt-0 sm:max-w-md xl:p-0 bg-gray-800 border-gray-700">
                <!-- Display Errors -->
                @if ($errors->any())
                    <div class="mt-4 p-4 bg-red-100 text-red-700 rounded-lg">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight md:text-2xl text-white">
                        Create an account
                    </h1>
                    <form class="space-y-4 md:space-y-6" method="POST" action="{{ route('register') }}">
                        @csrf
                        <div>
                            <label for="fullname" class="block mb-2 text-sm font-medium text-white">Full
                                Name</label>
                            <input type="text" name="fullname" id="fullname"
                                class=" border   text-sm rounded-lg  block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"
                                placeholder="xxxxxxxxx" required autofocus>
                        </div>
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium  text-white">Email</label>
                            <input type="email" name="email" id="email"
                                class=" border  ext-sm rounded-lg  block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"
                                placeholder="name@xxx.com" required>
                        </div>
                        <div>
                            <label for="username" class="block mb-2 text-sm font-medium  text-white">Username</label>
                            <input type="text" name="username" id="username"
                                class=" border  text-sm rounded-lg  block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"
                                placeholder="xxxxxxx" required>
                        </div>
                        <div>
                            <label for="role" class="block mb-2 text-sm font-medium  text-white">Role</label>
                            <select id="role" name="role"
                                class=" border  text-sm rounded-lg  block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"
                                required>
                                <option selected disabled>Choose Role</option>
                                <option value="superadmin">superadmin</option>
                                <option value="admin">admin</option>
                            </select>
                        </div>
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium  text-white">Password</label>
                            <div class="relative">
                                <input id="password" type="password" name="password"
                                    class=" border  text-sm rounded-lg  block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"
                                    required>
                                <button type="button" id="togglePassword1"
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5">
                                    <i class="fas fa-eye text-white" id="eyeIcon1"></i>
                                </button>
                            </div>
                        </div>
                        <div>
                            <label for="password_confirmation" class="block mb-2 text-sm font-medium  text-white">Confirm
                                password</label>
                            <div class="relative">
                                <input id="password_confirmation" type="password" name="password_confirmation"
                                    class=" border  text-sm rounded-lg  block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"
                                    required>
                                <button type="button" id="togglePassword2"
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5">
                                    <i class="fas fa-eye text-white" id="eyeIcon2"></i>
                                </button>
                            </div>
                        </div>
                        <button type="submit"
                            class="w-full text-white  focus:ring-4 focus:outline-none  font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-primary-600 hover:bg-primary-700 focus:ring-primary-800">Create
                            an account</button>
                        <p class="text-sm font-light  text-gray-400">
                            Already have an account? <a
                                class="font-medium 
                                hover:underline text-primary-500"
                                href="{{ route('login') }}">Login here</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
