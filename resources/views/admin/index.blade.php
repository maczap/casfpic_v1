<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link href="{{ asset('css/admin.css') }}" rel="stylesheet" type="text/css">
    </head>
    <body>

    <div class="grid grid-cols-12 ">
        <div class="col-span-12">
            <nav class="relative flex flex-wrap items-center justify-between px-2 py-3 bg-white rounded">
                <div class="container px-4 mx-auto flex flex-wrap items-center justify-between">
                    <div class="w-full relative flex justify-between lg:w-auto px-4 lg:static lg:block lg:justify-start">
                    <a class="text-sm font-bold leading-relaxed inline-block mr-4 py-2 whitespace-nowrap uppercase text-gray-500" href="#pablo">
                        pink Menu
                    </a>
                    <button class="cursor-pointer text-xl leading-none px-3 py-1 border border-solid border-transparent rounded bg-transparent block lg:hidden outline-none focus:outline-none" type="button">
                        <span class="block relative w-6 h-px rounded-sm bg-white"></span>
                        <span class="block relative w-6 h-px rounded-sm bg-white mt-1"></span>
                        <span class="block relative w-6 h-px rounded-sm bg-white mt-1"></span>
                    </button>
                    </div>
                    <div class="flex lg:flex-grow items-center" id="example-navbar-info">
                    <ul class="flex flex-col lg:flex-row list-none ml-auto">
                        <li class="nav-item">
                        <a class="px-3 py-2 flex items-center text-xs uppercase font-bold leading-snug text-gray-500 hover:opacity-75" href="#pablo">
                            Discover
                        </a>
                        </li>
                        <li class="nav-item">
                        <a class="px-3 py-2 flex items-center text-xs uppercase font-bold leading-snug text-gray-500 hover:opacity-75" href="#pablo">
                            Profile
                        </a>
                        </li>
                        <li class="nav-item">
                        <a class="px-3 py-2 flex items-center text-xs uppercase font-bold leading-snug text-gray-500 hover:opacity-75" href="#pablo">
                            Settings
                        </a>
                        </li>
                    </ul>
                    </div>
                </div>
            </nav>                
        </div>
        <div class="col-span-2 p-4 bg-gray-800 row-span-10 h-screen text-white">
            <ul>
                <li>Menu</li>
                <li>Menu</li>
                <li>Menu</li>
                <li>Menu</li>
                <li>Menu</li>
                <li>Menu</li>
                <li>Menu</li>
                <li>Menu</li>
                <li>Menu</li>

            </ul>
        </div>
        <div class="col-span-10 bg-gray-100 row-span-10 p-4">
            <div class="flex container flex-wrap">
                <div class="flex-1 bg-white m-4 h-40 p-4 rounded-md ">1</div>
                <div class="flex-1 bg-white m-4 h-40 p-4 rounded-md">1</div>
                <div class="flex-1 bg-white m-4 h-40 p-4 rounded-md">1</div>
                <div class="flex-1 bg-white m-4 h-40 p-4 rounded-md">1</div>
            </div>

            <div class="flex container flex-wrap">
                <div class="flex-1 bg-white m-4 h-60 p-4 rounded-md">1</div>
                <div class="flex-1 bg-white m-4 h-60 p-4 rounded-md">1</div>
            </div>

            <div class="flex container flex-wrap">
                <div class="flex-1 bg-white m-4 h-60 p-4 rounded-md">1</div>
                <div class="flex-1 bg-white m-4 h-60 p-4 rounded-md">1</div>
            </div>

        </div>
    </div>

        <script src="{{ asset('js/admin.js') }}"></script>
    </body>
</html>