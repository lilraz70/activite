<div>
    <div class="space-y-8">
        <div>
            <x-breadcrumb :page-title="'Détail  du risque'" :breadcrumb-items="[
                ['name' => 'Risque', 'url' => '', 'active' => true],
                ['name' => 'Détail', 'url' => '', 'active' => false],
            ]" />
        </div>
        <div class="flex md:space-x-5 app_height overflow-hidden relative rtl:space-x-reverse">
            <div class="email-overlay"></div>
            <div class="flex-1 md:w-[calc(100%-320px)]">
                <div class="h-full card">
                    <div class="p-0 h-full relative card-body">
                        
                        <!-- BEGIN: Single Email -->
                        <div class="left-0 top-0 w-full h-full bg-white dark:bg-slate-800 z-[55] rounded-md p-6 overflow-y-auto">
                            <div class="flex items-center border-b border-slate-100 dark:border-slate-700 -mx-6 pb-6 mb-6 px-6">
                                <div class="flex-1">
                                    {{ $risk->name }}
                                </div>
                            </div>
                            <div class="h-full">
                                @livewire('back.measures.index', ['risk' => $risk])
                            </div>
                        </div>
                        <!-- END: Single Email -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
