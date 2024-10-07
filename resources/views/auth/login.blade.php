@extends('Ui.main')
@section('content')
@if(session()->has('success'))
<div class="px-2 py-2 border border-blue-500">
    <p class="alert alert-info">{{ session('success') }}</p>
</div>
@endif

    <div class="w-[60%] mx-auto bg-[#e6f0fa] border border-blue-500 rounded-md">
        <div class="mt-10 px-7">
            <form action="/Tologin" method="post">
            @csrf      
                <div class="mb-4">
                    <label for="email" class="block text-sm font-bold mb-2">Email:</label>
                    <input type="email" id="email" name="email" class="shadow-lg appearance-none  rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline border border-blue-500">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>         
                <div class="mb-4">
                    <label for="password" class="block text-sm font-bold mb-2">Password:</label>
                    <input type="password" id="password" name="password" class="shadow-lg appearance-none  rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline border border-blue-500">
                </div>            
                <div class="mb-4">
                    <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 rounded py-2 text-white">Submit</button>
                </div>    
                <div class="mb-4 text-center">
                    <a href="/register"  class="w-full text-red-500 hover:text-red-700 hover:underline duration-300 rounded py-2">No Have Account?</a>
                </div>    
            </form>    
        </div>
    </div>
@endsection