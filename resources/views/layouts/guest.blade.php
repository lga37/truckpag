<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    
       
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/flowbite@1.4.7/dist/flowbite.js" defer></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])    
    
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="container mx-auto">
        <x-shared.header />
        <x-shared.msgs />
        <div class="grid grid-cols-6 gap-2">
            <div class="pt-4">
                <x-shared.menu />
            </div>

            <div class="col-span-4">
                <x-shared.breadcrumbs />
                {{ $slot }}
            </div>

            <div class="pt-5">
                <a href="{{ route('lista.index') }}" 
                class="border-2 border-green-500 rounded-lg font-bold text-green-500 px-4 py-2
                transition duration-300 ease-in-out hover:bg-green-500 hover:text-white">
                Minhas Listas
                </a>   
                
                
            
                @forelse ($listas as $lista)
               
                <div class="mt-5 flex items-center">
                    <form class="inline" method="POST" action="{{ route('lista.del',$lista) }}">
                        @csrf
                        @method('DELETE')
                       
                        <button>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                clip-rule="evenodd" />
                        </svg>
                        </button>
                    </form>
    
                    <a class="" href="{{ route('lista.edit',$lista) }}">
                        <span class="inline w-5 text-green-800 font-bold py-1 px-1 rounded text-xs bg-green-200
                                hover:bg-green-500">{{ $lista->apelido }}</span>
                    </a>
                        
                    <a href="{{ route('lista.show',$lista) }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="inline h-6 w-6 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                    </a>
                </div>
            
                @empty
                    <br>Sem Registros
                @endforelse


            </div>
        </div>

    </div>
    <x-shared.footer />
</body>

</html>



<script>
    // On page load or when changing themes, best to add inline in `head` to avoid FOUC
    if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark')
    }
    //============================================================================
    var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
    var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

    // Change the icons inside the button based on previous settings
    if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        themeToggleLightIcon.classList.remove('hidden');
    } else {
        themeToggleDarkIcon.classList.remove('hidden');
    }

    var themeToggleBtn = document.getElementById('theme-toggle');

    themeToggleBtn.addEventListener('click', function () {

        // toggle icons inside button
        themeToggleDarkIcon.classList.toggle('hidden');
        themeToggleLightIcon.classList.toggle('hidden');

        // if set via local storage previously
        if (localStorage.getItem('color-theme')) {
            if (localStorage.getItem('color-theme') === 'light') {
                document.documentElement.classList.add('dark');
                localStorage.setItem('color-theme', 'dark');
            } else {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('color-theme', 'light');
            }

            // if NOT set via local storage previously
        } else {
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('color-theme', 'light');
            } else {
                document.documentElement.classList.add('dark');
                localStorage.setItem('color-theme', 'dark');
            }
        }

    });
</script>