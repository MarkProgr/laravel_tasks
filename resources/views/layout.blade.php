<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
</head>
<body>
<header class="text-gray-600 body-font">
    <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
        <nav class="flex lg:w-2/5 flex-wrap items-center text-base md:ml-auto">
            <a href="{{ route('main') }}" class="mr-5 hover:text-gray-900">Main</a>
            <a href="{{ route('create.form') }}" class="mr-5 hover:text-gray-900">Create User</a>
        </nav>
        <div class="lg:w-2/5 inline-flex lg:justify-end ml-5 lg:ml-0">
            @if(!auth()->check())
            <a href="{{ route('login.form') }}" class="inline-flex items-center bg-indigo-500 border-0 py-1 px-3 text-black focus:outline-none hover:bg-gray-200 rounded text-base mt-4 mr-1 md:mt-0">Login</a>
            <a href="{{ route('sign-up.form') }}" class="inline-flex items-center bg-indigo-500 border-0 py-1 px-3 text-black focus:outline-none hover:bg-gray-200 rounded text-base mt-4 md:mt-0">Sign Up</a>
            @endif
            @if(auth()->check())
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button type="submit" class="inline-flex items-center bg-red-500 text-black border-0 py-1 px-3 text-left focus:outline-none hover:bg-gray-200 rounded text-base mt-4 md:mt-0">Logout</button>
            </form>
            @endif
        </div>
    </div>
</header>
<div class="container mx-auto">
    @yield('content')
</div>
</body>
</html>
