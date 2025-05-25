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
                    <form method="POST" action="/logout" class="">
                        @csrf
                        <button type="submit" class="ml-20 hover:underline hover:underline-offset-8 hover:decoration-white rounded-2xl">Log out</button>
                    </form>
                @else
                    <a href="{{ route('register') }}" class="p-3 px-8 mr-3 font-bold hover:bg-blue-600 hover:rounded-lg hover:text-white text-md">Register</a>
                    <a href="{{ route('login') }}" class="bg-blue-600 p-3 px-8 rounded-lg text-white hover:bg-white hover:text-black text-md font-bold">Login</a>         
                @endauth
            </div>
        </nav>

        <div class="flex justify-center flex-grow">
            <div class="w-lg my-36 shadow-2xl rounded-xl p-10">
                <form action="/login" method="POST">
                    @csrf
                    <div class="mb-5">
                        <label class="text-xl mr-25">Email:</label>
                        <input type="email" id="email" name="email" class="bg-white p-2 rounded-sm border-2" required/>
                    </div>

                    <div class="mb-5">
                        <label class="text-xl mr-16">Password:</label>
                        <input type="password" id="password" name="password" class="bg-white p-2 rounded-sm border-2" required>
                    </div>

                    <div class="">
                        <button type="submit" name="submit" id="submit" class="p-4 rounded-lg text-xl hover:text-white hover:bg-blue-600">Login</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="flex justify-center items-center p-7 border-t-2 border-[#1470af]">
            <a href="https://www.tenton.co/" target="_blank" class="mr-20">www.tenton.co</a>
            <a href="mailto:hello@tenton.co">hello@tenton.co</a>
        </div>
    </body>
</html>
