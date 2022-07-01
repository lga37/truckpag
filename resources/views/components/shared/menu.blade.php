<aside class="w-64" aria-label="Sidebar">
    <div class="overflow-y-auto py-4 px-3 bg-gray-50 rounded dark:bg-gray-800">
       <ul class="space-y-2">
          <li>
             <a href="{{route('home')}}"
                class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                <svg
                   class="w-6 h-6 text-blue-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                   fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                   <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                   <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                </svg>
                <span class="ml-3">Home</span>
             </a>
          </li>

          @forelse($rotas as $rota=>$tot)

          <li>
            <a href="{{route(strtolower($rota))}}"
               class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
               <svg
                  class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                  fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                  <path
                     d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                  </path>
               </svg>
               <span class="flex-1 ml-3 whitespace-nowrap">{{$rota}}</span>
               
               @if ($rota=='Regiao')
               <span
                  class="inline-flex justify-center items-center px-2 ml-3 text-sm font-medium text-gray-800 bg-gray-200 rounded-full dark:bg-gray-700 dark:text-gray-300">Pro</span>
                  
               @endif

               <span
               class="inline-flex justify-center items-center p-3 ml-3 w-9 h-3 text-sm font-sm text-blue-600 bg-blue-200 rounded 
               dark:bg-blue-900 dark:text-blue-200">{{$tot}}</span>
               
            </a>
         </li>

          @empty 
            Lista Vazia
          @endforelse

          
       </ul>
       <div id="dropdown-cta" class="p-4 mt-6 bg-blue-50 rounded-lg dark:bg-blue-900" role="alert">
          <div class="flex items-center mb-3">
             <span
                class="bg-orange-100 text-orange-800 text-sm font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-orange-200 dark:text-orange-900">Beta</span>
             <button type="button"
                class="ml-auto -mx-1.5 -my-1.5 bg-blue-50 text-blue-900 rounded-lg focus:ring-2 focus:ring-blue-400 p-1 hover:bg-blue-200 inline-flex h-6 w-6 dark:bg-blue-900 dark:text-blue-400 dark:hover:bg-blue-800"
                data-collapse-toggle="dropdown-cta" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                   <path fill-rule="evenodd"
                      d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                      clip-rule="evenodd"></path>
                </svg>
             </button>
          </div>
          <p class="mb-3 text-sm text-blue-900 dark:text-blue-400">
             Vc tem acesso somentre a sua lista de enderecos e o admin tem acesso a de todos
          </p>
          <a class="text-sm text-blue-900 underline hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300"
             href="#">Acessar Admin</a>
       </div>
    </div>
 </aside>