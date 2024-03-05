<x-app-layout>

    <!-- START:: Breadcrumbs -->
    <div class="flex justify-between flex-wrap items-center mb-6">
        <h4 class="font-medium lg:text-2xl text-xl capitalize text-slate-900 inline-block ltr:pr-4 rtl:pl-4 mb-4 sm:mb-0 flex space-x-3 rtl:space-x-reverse">Tableau de bord</h4>
        {{-- <div class="flex sm:space-x-4 space-x-2 sm:justify-end items-center rtl:space-x-reverse">
            <button class="btn leading-0 inline-flex justify-center bg-white text-slate-700 dark:bg-slate-800 dark:text-slate-300 !font-normal">
                <span class="flex items-center">
                    <iconify-icon class="text-xl ltr:mr-2 rtl:ml-2 font-light" icon="heroicons-outline:calendar"></iconify-icon>
                    <span>Weekly</span>
                </span>
            </button>
            <button class="btn leading-0 inline-flex justify-center bg-white text-slate-700 dark:bg-slate-800 dark:text-slate-300 !font-normal">
                <span class="flex items-center">
                    <iconify-icon class="text-xl ltr:mr-2 rtl:ml-2 font-light" icon="heroicons-outline:filter"></iconify-icon>
                    <span>Select Date</span>
                </span>
            </button>
        </div> --}}
    </div>
    <!-- END:: Breadcrumbs -->

    <div class="grid grid-cols-12 gap-5 mb-5">
        <div class="2xl:col-span-3 lg:col-span-4 col-span-12">
            <div class="bg-no-repeat bg-cover bg-center p-4 rounded-[6px] relative" style="background-image: url(images/all-img/widget-bg-1.png)">
                <div class="max-w-[180px]">
                    <div class="text-xl font-medium text-white  mb-2">
                       Statistique sur le nombre de données enregistrées
                    </div>
                    {{-- <p class="text-sm text-slate-800">
                       actuell
                    </p> --}}
                </div>
                <div class="absolute top-1/2 -translate-y-1/2 ltr:right-6 rtl:left-6 mt-2 h-12 w-12 bg-white rounded-full text-xs font-medium
                        flex flex-col items-center justify-center">
                    <span class="text-slate-900 dark:text-slate-300">+12%</span>
                </div>
            </div>
        </div>
        <div class="2xl:col-span-9 lg:col-span-8 col-span-12">
            <div class="p-4 card">
                <div class="grid md:grid-cols-3 col-span-1 gap-4">

                    <!-- Revenue -->
                    <div class="py-[18px] px-4 rounded-[6px] bg-[#E5F9FF] dark:bg-slate-900">
                        <div class="flex items-center space-x-6 rtl:space-x-reverse">
                            <div class="flex-none">
                                <div id="wline1"></div>
                            </div>
                            <div class="flex-1">
                                <div class="text-slate-800 dark:text-slate-300 text-sm mb-1 font-medium">
                                    Nombre d'activités
                                </div>
                                <div class="text-slate-900 dark:text-white text-lg font-medium">
                                    {{  $numberOfActivity }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Products sold -->
                    <div class="py-[18px] px-4 rounded-[6px] bg-[#FFEDE5] dark:bg-slate-900">
                        <div class="flex items-center space-x-6 rtl:space-x-reverse">
                            <div class="flex-none">
                                <div id="wline2"></div>
                            </div>
                            <div class="flex-1">
                                <div class="text-slate-800 dark:text-slate-300 text-sm mb-1 font-medium">
                                   Nombre de tâches
                                </div>
                                <div class="text-slate-900 dark:text-white text-lg font-medium">
                                    {{ $numberOfTask }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Growth -->
                    <div class="py-[18px] px-4 rounded-[6px] bg-[#EAE5FF] dark:bg-slate-900">
                        <div class="flex items-center space-x-6 rtl:space-x-reverse">
                            <div class="flex-none">
                                <div id="wline3"></div>
                            </div>
                            <div class="flex-1">
                                <div class="text-slate-800 dark:text-slate-300 text-sm mb-1 font-medium">
                                    Nombre de risques
                                </div>
                                <div class="text-slate-900 dark:text-white text-lg font-medium">
                                    {{ $numberOfRisk }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="py-[18px] px-4 rounded-[6px] bg-[#EAE5FF] dark:bg-slate-900">
                        <div class="flex items-center space-x-6 rtl:space-x-reverse">
                            <div class="flex-none">
                                <div id="wline3"></div>
                            </div>
                            <div class="flex-1">
                                <div class="text-slate-800 dark:text-slate-300 text-sm mb-1 font-medium">
                                    Nombre de mesures
                                </div>
                                <div class="text-slate-900 dark:text-white text-lg font-medium">
                                    {{ $numberOfMeasure }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="py-[18px] px-4 rounded-[6px] bg-[#EAE5FF] dark:bg-slate-900">
                        <div class="flex items-center space-x-6 rtl:space-x-reverse">
                            <div class="flex-none">
                                <div id="wline3"></div>
                            </div>
                            <div class="flex-1">
                                <div class="text-slate-800 dark:text-slate-300 text-sm mb-1 font-medium">
                                    Nombre de collaborateurs
                                </div>
                                <div class="text-slate-900 dark:text-white text-lg font-medium">
                                    {{ $numberOfCollaborator }}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
  <!-- START:: GROUP CHART 3 -->
  <div class="card p-6">
    <div class="grid xl:grid-cols-4 lg:grid-cols-2 md:grid-cols-2 grid-cols-1 gap-5 place-content-center">
        <div class="flex space-x-4 h-full items-center rtl:space-x-reverse">
            <div class="flex-none">
                <div class="h-20 w-20 rounded-full">
                    <img src="images/all-img/main-user.png" alt="" class="w-full h-full">
                </div>
            </div>
            <div class="flex-1">
                <h4 class="text-xl font-medium mb-2">
                    {{-- <span class="block font-light">Collaborateur</span> --}}
                    <span class="block">Collaborateurs</span>
                </h4>
                <p class="text-sm dark:text-slate-300">Statistique sur les  collaborateurs</p>
            </div>
        </div>
        <div class="bg-slate-50 dark:bg-slate-900 rounded p-4">
            <div class="text-slate-600 dark:text-slate-400 text-sm mb-1 font-medium">
                Nombre de collaborateurs
            </div>
            <div class="text-slate-900 dark:text-white text-lg font-medium">
                {{ $numberOfCollaborator }}
            </div>
            <div class="ml-auto max-w-[124px]">
                <div id="clmn_chart_1"></div>
            </div>
        </div>
        <div class="bg-slate-50 dark:bg-slate-900 rounded p-4">
            <div class="text-slate-600 dark:text-slate-400 text-sm mb-1 font-medium">
                Nombre de collaborateurs ayant validé leur test
            </div>
            <div class="text-slate-900 dark:text-white text-lg font-medium">
               0
            </div>
            <div class="ml-auto max-w-[124px]">
                <div id="clmn_chart_2"></div>
            </div>
        </div>
        <div class="bg-slate-50 dark:bg-slate-900 rounded p-4">
            <div class="text-slate-600 dark:text-slate-400 text-sm mb-1 font-medium">
                Nombre de collaborateurs ayant échoué
            </div>
            <div class="text-slate-900 dark:text-white text-lg font-medium">
               0
            </div>
            <div class="ml-auto max-w-[124px]">
                <div id="clmn_chart_3"></div>
            </div>
        </div>
    </div>
</div>
<!-- END:: GROUP CHART 3 -->
    @push('scripts')
    @vite(['resources/js/plugins/jquery-jvectormap-2.0.5.min.js'])
    @vite(['resources/js/plugins/jquery-jvectormap-world-mill-en.js'])
    @vite(['resources/js/custom/chart-active.js'])
    @endpush
</x-app-layout>
