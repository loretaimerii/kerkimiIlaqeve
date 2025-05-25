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
           <div class="my-40">
                <h1 class="font-bold text-4xl flex justify-center">Aplikacioni per Kerkimin e Ilaqeve</h1>
                <div class="mt-12">
                    <form action="/search" method="GET">
                        <input type="text" name="code" class="border-2 border-[#D5D5D6] p-2 px-5 rounded-lg w-[630px] mr-5 shadow-lg" placeholder="Shkruaj kodet te ndara me presje, 12345-6789, 11111-2222, 99999-0000" required/>
                        <button type="submit" id="kerko" name="kerko" class="bg-blue-600 p-3 px-6 rounded-lg text-white text-md font-bold">Kerko</button>
                     
                    </form>

                    {{-- table with the medications --}}
                    @if(isset($res) && count($res) > 0)

                    <table class="border-2 border-[#D5D5D6] rounded-lg w-[745px] mt-5">
                        <thead class="">
                            <tr class="">
                                <th class="p-1 rounded-lg border-2 border-[#D5D5D6]">Kodi</th>
                                <th class="p-1 rounded-lg border-2 border-[#D5D5D6]">Emri i produktit</th>
                                <th class="p-1 rounded-lg border-2 border-[#D5D5D6]">Prodhuesi</th>
                                <th class="p-1 rounded-lg border-2 border-[#D5D5D6]">Lloji i produktit</th>
                                <th class="p-1 rounded-lg border-2 border-[#D5D5D6]">Burimi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($res as $ilaq)
                                <tr>
                                 <td class="p-1 rounded-lg border-2 border-[#D5D5D6]">{{$ilaq['ilaqet']['ndc_code']}}</td>
                                 <td class="p-1 rounded-lg border-2 border-[#D5D5D6]">{{$ilaq['ilaqet']['brand_name']}}</td>
                                 <td class="p-1 rounded-lg border-2 border-[#D5D5D6]">{{$ilaq['ilaqet']['labeler_name']}}</td>
                                 <td class="p-1 rounded-lg border-2 border-[#D5D5D6]">{{$ilaq['ilaqet']['product_type']}}</td>
                                 <td class="p-1 rounded-lg border-2 border-[#D5D5D6]">{{$ilaq['burimi']}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="flex justify-end">
                    <a href="{{route('dowload.csv')}}" class="mt-10 shadow-2xl p-5">Download to CSV file</a>
                    </div>
                    @endif
                    
                </div>
            </div>
        </div>

        <div class="flex justify-center items-center p-7 border-t-2 border-[#1470af]">
            <a href="https://www.tenton.co/" target="_blank" class="mr-20">www.tenton.co</a>
            <a href="mailto:hello@tenton.co">hello@tenton.co</a>
        </div>
    </body>
</html>
