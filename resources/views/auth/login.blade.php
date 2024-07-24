<!-- resources/views/auth/login.blade.php -->
@extends('layouts.app')

@section('content')
    <section class=" bg-gray-900">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <div class="w-full  rounded-lg shadow border md:mt-0 sm:max-w-md xl:p-0 bg-gray-800 border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight  md:text-2xl text-white">
                        Sign in to your account
                    </h1>
                    <form class="space-y-4 md:space-y-6" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium  text-white">Your
                                email</label>
                            <input type="email" name="email" id="email"
                                class=" border  rounded-lg  block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"
                                placeholder="name@company.com" required>
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

                        <button type="submit"
                            class="w-full text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-primary-600 hover:bg-primary-700 focus:ring-primary-800">Sign
                            in</button>
                        <p class="text-sm font-light  text-gray-400">
                            Don’t have an account yet? <a href="{{ route('register') }}"
                                class="font-medium  hover:underline text-primary-500">Sign up</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
