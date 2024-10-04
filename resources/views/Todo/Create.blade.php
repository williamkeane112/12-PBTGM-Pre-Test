@extends('Ui.main')
@section('content')

    <div class="w-[60%] mx-auto bg-[#e6f0fa] border border-blue-500 rounded-md">
        <div class="mt-10 px-7">
            <form action="/todo" method="post">
            @csrf      
                <div class="mb-4">
                    <input type="hidden" value="{{ $id }}">
                    <label for="catatan" class="block text-sm font-bold mb-2">Catatan:</label>
                    <textarea type="catatan" id="catatan" name="catatan" class="shadow-lg appearance-none  rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline border border-blue-500"></textarea>

                </div>                   
                <div class="mb-4">
                    <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 rounded py-2 text-white">Submit</button>
                </div> 
            </form>    
        </div>
    </div>
@endsection