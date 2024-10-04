@extends('Ui.main')
@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
    <div class="w-[60%] mx-auto bg-[#e6f0fa] border border-blue-500 rounded-md">
        <div class="mt-10 px-7">
            <form action="/profil/{{ Auth::id() }}" method="POST">
            @csrf
            @method('PUT')
            @foreach ($data as $item) 
            <input type="hidden" value="{{ $item->id }}">
                <div class="mb-4">
                    <label for="name" class="block text-sm font-bold mb-2">Name:</label>
                    <input type="text" id="name" name="name" class="shadow-lg appearance-none  rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline border border-blue-500" value="{{ $item->name }}">
                </div>            
                <div class="mb-4">
                    <label for="email" class="block text-sm font-bold mb-2">Email:</label>
                    <input type="email" id="email" name="email" class="shadow-lg appearance-none  rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline border border-blue-500" value="{{ $item->email }}">
                </div>            
                <div class="mb-4">
                    <label for="old_password" class="block text-sm font-bold mb-2">Old Password:</label>
                    <input type="old_password" id="old_password" name="old_password" class="shadow-lg appearance-none  rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline border border-blue-500">
                </div>         
                <div class="mb-4">
                    <label for="new_password" class="block text-sm font-bold mb-2">New Password:</label>
                    <input type="new_password" id="new_password" name="new_password" class="shadow-lg appearance-none  rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline border border-blue-500">
                </div>         

                <div class="mb-4">
                    <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 rounded py-2 text-white">Submit</button>
                </div>    
            @endforeach

            </form>    
        </div>
    </div>
@endsection