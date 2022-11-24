@extends('layout')

@section('title', 'Main Page')

@section('content')
    <section class="text-gray-600 body-font">
        <div class="container px-5 py-24 mx-auto">
            <div class="flex flex-col text-center w-full mb-20">
                <h1 class="sm:text-4xl text-3xl font-medium title-font mb-2 text-gray-900">Users</h1>
            </div>
            <div class="lg:w-2/3 w-full mx-auto overflow-auto">
                <table class="table-auto w-full text-left whitespace-no-wrap">
                    <thead>
                    <tr>
                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">#</th>
                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">Email</th>
                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">Name</th>
                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">Gender</th>
                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td class="px-4 py-3">{{ $user->id }}</td>
                        <td class="px-4 py-3">{{ $user->email }}</td>
                        <td class="px-4 py-3">{{ $user->name }}</td>
                        <td class="px-4 py-3">{{ $user->gender }}</td>
                        <td class="w-10 text-center">{{ $user->status }}</td>
                        <td class="flex flex-row">
                            <a class="bg-gray-500 font-bold text-black py-2 px-4 rounded-full" href="{{ route('about.user', ['localUser' => $user->id]) }}">About</a>
                            <a href="{{ route('edit.form', ['localUser' => $user->id]) }}" class="bg-blue-500 font-bold text-black py-2 px-4 rounded-full">Edit</a>
                            <form action="{{ route('delete.user', ['localUser' => $user->id]) }}" method="post">
                                @csrf
                            <button type="submit" class="bg-red-500 text-black py-2 px-4 rounded-full">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
@endsection
