@extends('layout')

@section('title', 'About user')

@section('content')
    <section class="text-gray-600 body-font">
        <div class="container mx-auto flex px-5 py-24 items-center justify-center flex-col">
            @if($localUser->image_name)
            <img class="lg:w-2/6 md:w-3/6 w-5/6 mb-10 object-cover object-center rounded" alt="User"
                 src="{{ asset('uploads/' . $localUser->image_name) }}">
            @endif
            <div class="text-center lg:w-2/3 w-full">
                <h1 class="title-font sm:text-4xl text-3xl mb-8 font-medium text-gray-900">User {{ $localUser->id }} - {{ $localUser->name }}</h1>
                <p class="mb-8 leading-relaxed"><strong>Email:</strong> {{ $localUser->email }}</p>
                <p class="mb-8 leading-relaxed"><strong>Gender:</strong> {{ $localUser->gender }}</p>
                <p class="mb-8 leading-relaxed"><strong>Status:</strong> {{ $localUser->status }}</p>
            </div>
        </div>
    </section>
@endsection
{{--{{ asset('public/uploads/' . $localUser->image_name) }}--}}
{{--/public/uploads/{{ $localUser->image_name }}--}}
