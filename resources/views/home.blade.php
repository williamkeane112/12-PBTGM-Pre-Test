@extends('Ui.main')
@section('content')
    <div class="flex flex-wrap">
        <div class="w-[67%] gap-4">
            <div class="flex justify-between items-center text-lg ">
                <span class="font-semibold">Activity Today</span>
                <a href="/todo" class="text-blue-500 hover:text-blue-700 font-semibold hover:underline hover:to-blue-700 duration-500">Create Todo&#8594;</a>
            </div>
            <div class="bg-[#e6f0fa] w-full border border-blue-500 px-6 py-4 mt-4 rounded-md">
                {{-- tgl todo --}}
                <div class="mb-2">
                    <span >12-10-2024</span>
                </div>
                {{-- list todo --}}
                @foreach ($data as $item)
                <div class="flex justify-between bg-white/80 px-2 py-2 rounded-md mb-4 hover:scale-105 duration-500">
                    {{-- box checkmark --}}
                    @if ($item->status === 'done')
                    <form id="UpdateForm{{ $item->id }}" action="/updateStatus/{{ $item->id }}"  method="POST">
                        @csrf
                        @method('put')
                        <div class="flex items-center space-x-2 self-start mx-3">
                            <input type="hidden" name="id" value="{{ $item->id }}">
                            <input id="updateStatus"  onclick="document.getElementById('UpdateForm{{ $item->id }}').submit();" type="checkbox" name="status" value="undone" checked  class="w-5 h-5  text-blue-600 bg-gray-100 border-gray-300  focus:ring-blue-500">
                        </div>
                    </form>
                     <span class="text-sm leading-4 "><s>{{ $item->catatan }}</s></span>
                     @else
                     <form id="UpdateForm{{ $item->id }}" action="/updateStatus/{{ $item->id }}"  method="POST">
                        @csrf
                        @method('put')
                        <div class="flex items-center space-x-2 self-start mx-3">
                            <input type="hidden" name="id" value="{{ $item->id }}">
                            <input id="updateStatus"  onclick="document.getElementById('UpdateForm{{ $item->id }}').submit();" type="checkbox" name="status" value="done"  class="w-5 h-5  text-blue-600 bg-gray-100 border-gray-300  focus:ring-blue-500">
                        </div>
                    </form>
                     <span class="text-sm leading-4 ">{{ $item->catatan }}</span>
                    @endif

                   <div class="flex self-start justify-between">
                       {{-- edit --}}
                       <Button onclick="window.location.href = '/todo/{{ $item->id }}/edit'" class="bg-yellow-400 px-2 py-2 hover:bg-yellow-600 duration-500 rounded-full hover:scale-125">
                           <svg xmlns="http://www.w3.org/2000/svg" class="w-4 " viewBox="0 0 24 24" id="edit">
                           <path d="M3.5,24h15A3.51,3.51,0,0,0,22,20.487V12.95a1,1,0,0,0-2,0v7.537A1.508,1.508,0,0,1,18.5,22H3.5A1.508,1.508,0,0,1,2,20.487V5.513A1.508,1.508,0,0,1,3.5,4H11a1,1,0,0,0,0-2H3.5A3.51,3.51,0,0,0,0,5.513V20.487A3.51,3.51,0,0,0,3.5,24Z"></path>
                           {{-- create By william Keane --}}
                           <path d="M9.455,10.544l-.789,3.614a1,1,0,0,0,.271.921,1.038,1.038,0,0,0,.92.269l3.606-.791a1,1,0,0,0,.494-.271l9.114-9.114a3,3,0,0,0,0-4.243,3.07,3.07,0,0,0-4.242,0l-9.1,9.123A1,1,0,0,0,9.455,10.544Zm10.788-8.2a1.022,1.022,0,0,1,1.414,0,1.009,1.009,0,0,1,0,1.413l-.707.707L19.536,3.05Zm-8.9,8.914,6.774-6.791,1.4,1.407-6.777,6.793-1.795.394Z"></path>
                         </svg>
                       </Button>
                       {{-- hapus --}}
                       <form action="/todo/{{ $item->id }}" method="POST" onsubmit="return confirm('yakin?');">
                        @csrf
                        @method('DELETE')
                       <Button  class="bg-red-500 py-2 px-2 mx-2 hover:bg-red-700 duration-500 rounded-full hover:scale-125">
                           <svg xmlns="http://www.w3.org/2000/svg" class="w-4 " enable-background="new 0 0 60 60" viewBox="0 0 60 60" id="delete">
                           <path d="M18.3,56h23.6c2.7,0,4.8-2.2,4.8-4.8V18.7h2.1c0.6,0,1-0.4,1-1v-2.3c0-2.1-1.7-3.7-3.7-3.7h-8.5V9.1c0-1.7-1.4-3.1-3.1-3.1
                             h-8.9c-1.7,0-3.1,1.4-3.1,3.1v2.6H14c-2.1,0-3.7,1.7-3.7,3.7v2.3c0,0.6,0.4,1,1,1h2.1v32.5C13.4,53.8,15.6,56,18.3,56z M44.7,51.2
                             c0,1.6-1.3,2.8-2.8,2.8H18.3c-1.6,0-2.8-1.3-2.8-2.8V18.7h29.3V51.2z M24.5,9.1C24.5,8.5,25,8,25.6,8h8.9c0.6,0,1.1,0.5,1.1,1.1v2.6
                             h-11V9.1z M12.3,15.4c0-1,0.8-1.7,1.7-1.7h32c1,0,1.7,0.8,1.7,1.7v1.3H12.3V15.4z"></path>
                           <path d="M37.9 49.2c.6 0 1-.4 1-1V24.4c0-.6-.4-1-1-1s-1 .4-1 1v23.8C36.9 48.8 37.4 49.2 37.9 49.2zM30.1 49.2c.6 0 1-.4 1-1V24.4c0-.6-.4-1-1-1s-1 .4-1 1v23.8C29.1 48.8 29.5 49.2 30.1 49.2zM22.2 49.2c.6 0 1-.4 1-1V24.4c0-.6-.4-1-1-1s-1 .4-1 1v23.8C21.2 48.8 21.6 49.2 22.2 49.2z"></path>
                         </svg>
                       </Button>
                       </form>
                   </div>
               </div>
                @endforeach
              
                <div class="text-blue-500 hover:text-blue-700 font-semibold duration-500 flex justify-end text-sm">
                   {{ $data->links() }}
                </div>
            </div>
            {{-- section card --}}
            <div class="mt-10 grid grid-cols-2 gap-5 items-center text-lg">
                <div class="bg-white shadow-[1px_2px_20px_-4px_rgba(0,0,0,0.3)] hover:scale-110 duration-300 py-2 rounded-md px-3 cursor-not-allowed">
                    <div class="flex flex-col justify-start">
                        <span class="text-xl">{{ $CountdoneTodo }}</span>
                        <span class="mt-3">Todo Yang Telah DiSelesaikan</span>
                    </div>
                </div>
                <div class="bg-white shadow-[1px_2px_20px_-4px_rgba(0,0,0,0.3)] hover:scale-110 duration-300 px-3 py-2 rounded-md cursor-not-allowed">
                    <div class="flex flex-col justify-start">
                        <span class="text-xl">{{ $CountunDoneTodo }}</span>
                        <span class="mt-3">Todo Yang belum  DiSelesaikan</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-[33%] pl-10 self-start">
            <div class="flex justify-start items-center text-lg ">
                <span class="font-semibold">Activity Today</span>
            </div>
            <div class="bg-[#e6f0fa] w-full h-full border border-blue-500 px-5 py-4 mt-4 rounded-md">
                <button onclick="alert('comming Soon')" class="flex items-center bg-white/80 w-full py-1  px-3 rounded-md hover:shadow-[1px_2px_20px_-4px_rgba(0,0,0,0.3)] hover:scale-110 duration-300 mb-4 ">
                        <span class="text-lg">12-10-2024</span>
                </button>
                <button onclick="alert('comming Soon')" class="flex items-center bg-white/80 w-full py-1  px-3 rounded-md hover:shadow-[1px_2px_20px_-4px_rgba(0,0,0,0.3)] hover:scale-110 duration-300 mb-4 ">
                        <span class="text-lg">12-10-2024</span>
                </button>
                <button onclick="alert('comming Soon')" class="flex items-center bg-white/80 w-full py-1  px-3 rounded-md hover:shadow-[1px_2px_20px_-4px_rgba(0,0,0,0.3)] hover:scale-110 duration-300 mb-4 ">
                        <span class="text-lg">12-10-2024</span>
                </button>
                <button onclick="alert('comming Soon')" class="flex items-center bg-white/80 w-full py-1  px-3 rounded-md hover:shadow-[1px_2px_20px_-4px_rgba(0,0,0,0.3)] hover:scale-110 duration-300 mb-4 ">
                        <span class="text-lg">12-10-2024</span>
                </button>


                <div class="text-blue-500 hover:text-blue-700 font-semibold duration-500 text-4xl flex justify-end">
                   <button class="hover:underline mx-5">&#8592;</button>
                   <button class="hover:underline ">&#8594;</button>
                </div>
            </div>
        </div>
    </div>

@endsection