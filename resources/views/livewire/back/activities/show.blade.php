<div>
    <div class="space-y-8">
        <div>
            <x-breadcrumb :page-title="'Détail de l\'activité'" :breadcrumb-items="[
                ['name' => 'Activités', 'url' => '', 'active' => true],
                ['name' => 'Détail', 'url' => '', 'active' => true],
            ]" />
        </div>
        <div class="flex md:space-x-5 app_height overflow-hidden relative rtl:space-x-reverse">
            <div class="email-sidebar ">
                <div class="h-full card">
                    <div class="card-body py-6 h-full flex flex-col">
                        <div class="h-full px-6">
                            <ul class="email-categories list mt-6">
                                @livewire('back.task.index', ['activity' => $activity])
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="email-overlay"></div>
            @livewire('back.risk.index')
        </div>
    </div>

</div>
