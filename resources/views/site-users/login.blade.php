@extends('layout')

@section('title', 'Login')

@section('content')
    <form action="{{ route('login') }}" method="post">
        @csrf
        <div class="lg:w-2/6 md:w-1/2 rounded-lg p-8 flex flex-col mx-auto mt-10 md:mt-0">
            <h2 class="text-gray-900 text-lg font-medium title-font mb-5">Login</h2>
            <div class="relative mb-4">
                @include('flash-messages')
                <label for="login" class="leading-7 text-sm text-gray-600">{{ __('validation.attributes.login') }}</label>
                <input type="text" id="full-name" name="login" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out
                @error('login') border-2 border-red-500 @enderror">
                @error('login')
                <div class="rounded-lg text-center">{{ $message }}</div>
                @enderror
            </div>
            <div class="relative mb-4">
                <label for="password" class="leading-7 text-sm text-gray-600">{{ __('validation.attributes.password') }}</label>
                <input type="password" name="password" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out
                @error('password') border-2 border-red-500 @enderror">
                @error('password')
                <div class="text-center rounded-lg">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-green-500 rounded text-lg">Button</button>
        </div>
    </form>
@endsection
