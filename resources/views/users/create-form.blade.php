@extends('layout')

@section('title', 'Create User')

@section('content')
    <form action="{{ route('create.user') }}" method="post" enctype="multipart/form-data">
        @csrf
    <div class="lg:w-2/6 md:w-1/2 bg-gray-100 rounded-lg p-8 flex flex-col mx-auto mt-10 md:mt-0">
        <h2 class="text-gray-900 text-lg font-medium title-font mb-5">Create User</h2>
        <div class="relative mb-4">
            <label for="name" class="leading-7 text-sm text-gray-600">{{ __('validation.attributes.name') }}</label>
            <input type="text" value="{{ old('name') }}" id="full-name" name="name" class="w-full text-center text-black bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none py-1 px-3 leading-8 transition-colors duration-200 ease-in-out
            @error('name') border-2 border-red-500 @enderror">
            @error('name')
            <div class="rounded-lg text-center">{{ $message }}</div>
            @enderror
        </div>
        <div class="relative mb-4">
            <label for="email" class="leading-7 text-sm text-gray-600">{{ __('validation.attributes.email') }}</label>
            <input type="email" id="email" value="{{ old('email') }}" name="email" class="w-full text-center text-black bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none py-1 px-3 leading-8 transition-colors duration-200 ease-in-out
            @error('email') border-2 border-red-500 @enderror">
            @error('email')
            <div class="text-center rounded-lg">{{ $message }}</div>
            @enderror
        </div>
        <label for="gender" class="leading-7 text-sm text-gray-600">{{ __('validation.attributes.gender') }}</label>
        <select name="gender" class="bg-white rounded border appearance-none border-gray-300 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 text-base text-center pl-3 pr-10 mb-4">
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select>
        @error('gender')
        <div class="bg-red-500 rounded-lg">{{ $message }}</div>
        @enderror
        <label for="status" class="leading-7 text-sm text-gray-600">{{ __('validation.attributes.status') }}</label>
        <select name="status" class="bg-white rounded border appearance-none border-gray-300 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 text-base text-center pl-3 pr-10 mb-4">
            <option value="Active">Active</option>
            <option value="Inactive">Inactive</option>
        </select>
        @error('status')
        <div class="bg-red-500 rounded-lg">{{ $message }}</div>
        @enderror
        <div class="mb-3">
            <label for="image" class="leading-7 text-sm text-gray-600">{{ __('validation.attributes.image_name') }}</label>
            <input type="file" name="image_name" class="block w-full text-sm text-slate-500
                file:mr-4 file:py-2 file:px-4
                file:rounded-full file:border-0
                file:text-sm file:font-semibold
                file:bg-violet-50 file:text-violet-700
                hover:file:bg-violet-100
            "/>
            @error('image_name')
            <div class="bg-red-500 rounded-lg">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">Button</button>
    </div>
    </form>
@endsection
