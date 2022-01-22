<x-guest-layout>
    <div class="w-full h-screen grid place-items-center font-semibold bg-gray-100">
        <div class="max-w-md py-4 px-8 bg-white shadow-lg rounded-lg my-20">
            <div class="flex justify-center md:justify-end -mt-16">
                <img class="w-20 h-20 object-cover rounded-full border-2 border-indigo-500"
                    src="https://images.unsplash.com/photo-1499714608240-22fc6ad53fb2?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=334&q=80">
            </div>
            <div>
                <h2 class="text-gray-800 text-3xl font-semibold">ROOM 911</h2>
                <p class="mt-2 text-gray-600">{{ $message }}</p>
            </div>
            <div class="flex justify-end mt-4">
                <a href="#" class="text-xl font-medium text-indigo-500">{{ $name }}</a>
            </div>
            <form class="flex justify-center mt-4" action="{{ url('room/exit') }}" method="POST">
                @csrf
                <input type="hidden" name="identification" value="{{$identification}}">
                <input type="hidden" name="name" value="{{$name}}">
                <button class="px-4 py-3 bg-indigo-500 text-white border border-transparent rounded-lg shadow-md transform transition-colors duration-200 hover:bg-white hover:text-indigo-500 hover:border-indigo-500">SALIR</button>
            </form>
    </div>
    </div>
</x-guest-layout>
