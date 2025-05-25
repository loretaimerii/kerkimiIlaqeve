<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
        <title>Searching Medication</title>       
    </head>
    <body class="flex flex-col min-h-screen">
        <nav class="p-4 flex justify-between items-center border-b-2 border-[#1470af]">
            <a href="{{route('home')}}" class="font-bold text-3xl">TENTON</a>
            <div class="flex justify-end">
                @auth
                    <a href="{{route('home')}}" class="bg-blue-600 mr-3 p-3 px-8 rounded-lg text-white hover:bg-white hover:text-black text-md font-bold">Home</a>
                    <a href="{{route('allCodes')}}" class="bg-blue-600 mr-3 p-3 px-8 rounded-lg text-white hover:bg-white hover:text-black text-md font-bold">NDC Codes</a>
                    <form method="POST" action="/logout">
                        @csrf
                        <button type="submit" class="bg-blue-600 p-3 px-8 rounded-lg text-white hover:bg-white hover:text-black text-md font-bold">Log out</button>
                    </form>
                @else
                    <a href="{{ route('register') }}" class="p-3 px-8 mr-3 font-bold hover:bg-blue-600 hover:rounded-lg hover:text-white text-md">Register</a>
                    <a href="{{ route('login') }}" class="bg-blue-600 p-3 px-8 rounded-lg text-white hover:bg-white hover:text-black text-md font-bold">Login</a>         
                @endauth
            </div>
        </nav>

        <div class="flex justify-center flex-grow">
           <div class="my-10">
                <div class="mt-12">
                    {{-- table with the medications --}}
                    <table class="border-2 border-[#D5D5D6] rounded-lg w-[1100px] mt-5">
                        <thead class="">
                            <tr class="">
                                <th class="p-2 rounded-lg border-2 border-[#D5D5D6]">Kodi</th>
                                <th class="p-2 rounded-lg border-2 border-[#D5D5D6]">Emri i produktit</th>
                                <th class="p-2 rounded-lg border-2 border-[#D5D5D6]">Prodhuesi</th>
                                <th class="p-2 rounded-lg border-2 border-[#D5D5D6]">Lloji i produktit</th>
                                <th class="p-2 rounded-lg border-2 border-[#D5D5D6]">Fshije</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ilaqet as $ilaq)
                                <tr>
                                 <td class="p-1 rounded-lg border-2 border-[#D5D5D6]">{{$ilaq['ndc_code']}}</td>
                                 <td class="p-1 rounded-lg border-2 border-[#D5D5D6]">{{$ilaq['brand_name']}}</td>
                                 <td class="p-1 rounded-lg border-2 border-[#D5D5D6]">{{$ilaq['labeler_name']}}</td>
                                 <td class="p-1 rounded-lg border-2 border-[#D5D5D6]">{{$ilaq['product_type']}}</td>
                                 <form action="/deleteCode/{{$ilaq['id']}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <td class="p-3 rounded-lg border-2 border-[#D5D5D6]"><button><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg></button>
                                    </td>
                                 </form>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-6">
                        {{$ilaqet->links()}}
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-center items-center p-7 border-t-2 border-[#1470af]">
            <a href="https://www.tenton.co/" target="_blank" class="mr-20">www.tenton.co</a>
            <a href="mailto:hello@tenton.co">hello@tenton.co</a>
        </div>
        <script>
function showSpinner() {
    document.getElementById('spinner').classList.remove('hidden');
}
</script>
    </body>
</html>
