@if(session()->has('success'))
    <div class="relative text-center px-4 py-3 bg-green-500 rounded-lg">{{ session()->get('success') }}</div>
@endif

@if(session()->has('error'))
    <div class="relative text-center px-4 py-3 bg-red-500 rounded-lg">{{ session()->get('error') }}</div>
@endif
