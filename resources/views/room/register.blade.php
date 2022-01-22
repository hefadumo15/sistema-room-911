<x-guest-layout>
    <div class="w-full h-screen grid place-items-center font-semibold bg-gray-100">
        <div class="flex flex-col max-w-4xl md:h-56 bg-white rounded-lg shadow-lg overflow-hidden md:flex-row my-10">
            <div class="md:flex items-center justify-center md:w-1/2 md:bg-gray-700">
                <div class="py-6 px-8 md:py-0">
                    <h2 class="text-gray-700 text-2xl font-bold md:text-gray-100">Ingreso a Room 911</h2>
                    <p class="mt-2 text-gray-600 md:text-gray-400">Ingrese su numero de indentificacion para comprobar su
                        validacion en el ROOM 911</p>
                </div>
            </div>
            <div class="flex flex-col items-center justify-center pb-6 md:py-0 md:w-1/2 md:border-b-8 border-gray-700">

                @if (session('error'))
                    <div class="text-red-500 mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                @if ($name)
                    <div class="text-green-500 mb-4">
                        {{ $name }} <br>
                        {{ $message }}
                    </div>
                @endif

                <form action="{{ url('room/register') }}" method="POST">
                    @csrf
                    <div class="flex flex-col rounded-lg overflow-hidden sm:flex-row">
                        <input
                            class="py-3 px-4 bg-gray-200 text-gray-800 border-gray-300 border-2 outline-none placeholder-gray-500 focus:bg-gray-100"
                            type="text" name="number" placeholder="Enter your ID number">
                        <button class="py-3 px-4 bg-gray-700 text-gray-100 font-semibold uppercase hover:bg-gray-600"
                            type="submit">ENTER</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
