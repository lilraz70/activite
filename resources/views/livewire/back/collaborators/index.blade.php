<div>
    <div class="space-y-8">
        <div>
            <x-breadcrumb :page-title="'Listes des collaborateurs'" :breadcrumb-items="[
                ['name' => 'collaborateurs', 'url' => '', 'active' => true],
                ['name' => 'Lites', 'url' => '', 'active' => false],
            ]" />

        </div>
        <div class="md:flex justify-between items-center">
            <div>
                Collaborateurs
            </div>
            <div class="flex flex-wrap">
                <div class="input-area flex-grow">
                    <div class="relative">
                        <input wire:model.live='search' type="text" class="form-control !pr-9 w-full"
                            placeholder="Rechercher...">
                        <button
                            class="absolute right-0 top-1/2 -translate-y-1/2 w-9 h-full border-none flex items-center justify-center">
                            <iconify-icon icon="heroicons-solid:search"></iconify-icon>
                        </button>
                    </div>
                </div>
                <div class="input-area mr-5"></div>
                <div class="input-area mr-5">
                    <select id="select" class="form-control" wire:model.live='paginate'>
                        <option value="5" class="dark:bg-slate-700"> 5</option>
                        <option value="10" class="dark:bg-slate-700"> 10</option>
                        <option value="25" class="dark:bg-slate-700"> 25</option>
                        <option value="50" class="dark:bg-slate-700"> 50</option>
                        <option value="50" class="dark:bg-slate-700"> 100</option>
                    </select>
                </div>
            </div>

            <div class="flex flex-wrap ">
                <ul class="nav nav-pills flex items-center flex-wrap list-none pl-0 mr-4" id="pills-tabVertical"
                    role="tablist">
                    <li class="nav-item flex-grow text-center" role="presentation">
                        <button
                            class="btn inline-flex justify-center btn-white dark:bg-slate-700 dark:text-slate-300 m-1 active"
                            id="pills-grid-tab" data-bs-toggle="pill" data-bs-target="#pills-grid" role="tab"
                            aria-controls="pills-grid" aria-selected="true">
                            <span class="flex items-center">
                                <iconify-icon class="text-xl ltr:mr-2 rtl:ml-2"
                                    icon="heroicons-outline:view-grid"></iconify-icon>
                                <span>Vue en grille</span>
                            </span>
                        </button>
                        <button
                            class="btn inline-flex justify-center btn-white dark:bg-slate-700 dark:text-slate-300 m-1 "
                            id="pills-list-tab" data-bs-toggle="pill" data-bs-target="#pills-list" role="tab"
                            aria-controls="pills-list" aria-selected="false">
                            <span class="flex items-center">
                                <iconify-icon class="text-xl ltr:mr-2 rtl:ml-2"
                                    icon="heroicons-outline:clipboard-list"></iconify-icon>
                                <span>Vue en liste</span>
                            </span>
                        </button>

                    </li>
                </ul>

                <button wire:click="openModal" data-bs-toggle="modal" data-bs-target=".form-modal"
                    class="btn inline-flex justify-center btn-dark dark:bg-slate-700 dark:text-slate-300 m-1 ">
                    <span class="flex items-center">
                        <iconify-icon class="text-xl ltr:mr-2 rtl:ml-2" icon="ph:plus-bold"></iconify-icon>
                        <span>Nouveau</span>
                    </span>
                </button>
            </div>
        </div>

        <div class="tab-content mt-6" id="pills-tabContent">
            <div class="tab-pane fade" id="pills-list" role="tabpanel" aria-labelledby="pills-list-tab">
                <div class="tab-content">
                    <div class="card">
                        <div class="card-body px-6 rounded overflow-hidden">
                            <div class="overflow-x-auto -mx-6">
                                <div class="inline-block min-w-full align-middle">
                                    <div class="overflow-hidden ">
                                        <table
                                            class="min-w-full divide-y divide-slate-100 table-fixed dark:divide-slate-700 ">
                                            <thead class="bg-slate-200 dark:bg-slate-700">
                                                <tr>
                                                    <th scope="col" class="table-th ">
                                                        NOM
                                                    </th>
                                                    <th scope="col" class="table-th ">
                                                        Activité
                                                    <th scope="col" class="table-th ">
                                                        Téléphone
                                                    </th>
                                                    </th>
                                                    <th scope="col" class="table-th ">
                                                        ACTION
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody
                                                class="bg-white divide-y divide-slate-100 dark:bg-slate-800 dark:divide-slate-700">
                                                @forelse ($collaborators as $collaborator)
                                                    <tr class="even:bg-slate-50 dark:even:bg-slate-700">
                                                        <td class="table-td">
                                                            <div
                                                                class="flex space-x-3 items-center text-left rtl:space-x-reverse">
                                                                <div class="flex-none">
                                                                    <div
                                                                        class="h-10 w-10 rounded-full text-sm bg-[#E0EAFF] dark:bg-slate-700 flex flex-col items-center justify-center font-medium -tracking-[1px]">
                                                                        {{ $loop->iteration }}
                                                                    </div>
                                                                </div>
                                                                <div
                                                                    class="flex-1 font-medium text-sm leading-4 whitespace-nowrap">
                                                                    <a wire:click="show('{{ $collaborator->id }}')">
                                                                        {{ $collaborator->name }}
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="table-td">
                                                            <span
                                                                class="block date-text">{{ $collaborator->activity->name }}</span>
                                                        </td>
                                                        <td class="table-td">
                                                            <span
                                                                class="block date-text">{{ $collaborator->phone }}</span>
                                                        </td>
                                                        <td class="table-td">
                                                            <div class="dropstart relative">
                                                                <button class="inline-flex justify-center items-center"
                                                                    type="button" id="tableDropdownMenuButton"
                                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                                    <iconify-icon class="text-xl ltr:ml-2 rtl:mr-2"
                                                                        icon="heroicons-outline:dots-vertical"></iconify-icon>
                                                                </button>
                                                                <ul
                                                                    class="dropdown-menu min-w-max absolute text-sm text-slate-700 dark:text-white hidden bg-white dark:bg-slate-700 shadow z-[2] float-left overflow-hidden list-none text-left rounded-lg mt-1 m-0 bg-clip-padding border-none">
                                                                    <li>
                                                                        <button
                                                                            wire:click="show('{{ $collaborator->id }}')"
                                                                            class="hover:bg-slate-900 dark:hover:bg-slate-600 dark:hover:bg-opacity-70 hover:text-white w-full border-b border-b-gray-500 border-opacity-10 px-4 py-2 text-sm dark:text-slate-300  last:mb-0 cursor-pointer first:rounded-t last:rounded-b flex space-x-2 items-center capitalize  rtl:space-x-reverse">
                                                                            <iconify-icon
                                                                                icon="heroicons-outline:eye"></iconify-icon>
                                                                            <span>Voir</span></button>
                                                                    </li>
                                                                    <li>
                                                                        <button
                                                                            wire:click="openModal('{{ $collaborator->id }}')"
                                                                            href="#" data-bs-toggle="modal"
                                                                            data-bs-target=".form-modal"
                                                                            class="hover:bg-slate-900 dark:hover:bg-slate-600 dark:hover:bg-opacity-70 hover:text-white w-full border-b border-b-gray-500 border-opacity-10 px-4 py-2 text-sm dark:text-slate-300 last:mb-0 cursor-pointer first:rounded-t last:rounded-b flex space-x-2 items-center capitalize rtl:space-x-reverse">
                                                                            <iconify-icon
                                                                                icon="clarity:note-edit-line"></iconify-icon>
                                                                            <span>Modifier</span></button>
                                                                    </li>
                                                                    <li>
                                                                        <button
                                                                            wire:click="confirmDelete('{{ $collaborator->name }}', '{{ $collaborator->id }}')"
                                                                            class="hover:bg-slate-900 dark:hover:bg-slate-600 dark:hover:bg-opacity-70 hover:text-white w-full border-b border-b-gray-500 border-opacity-10 px-4 py-2 text-sm dark:text-slate-300 last:mb-0 cursor-pointer first:rounded-t last:rounded-b flex space-x-2 items-center capitalize rtl:space-x-reverse">
                                                                            <iconify-icon
                                                                                icon="fluent:delete-28-regular"></iconify-icon>
                                                                            <span>Supprimer</span></button>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                @empty
                                                    <div class="flex justify-center items-center h-full">
                                                        <span class="">Aucun collaborateur</span>
                                                    </div>
                                                @endforelse

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade show active " id="pills-grid" role="tabpanel"
                aria-labelledby="pills-grid-tab">
                <div class="grid xl:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-5 ">
                    @forelse ($collaborators as $key => $collaborator)
                        <div
                            class="card rounded-md bg-white dark:bg-slate-800 shadow-base custom-class card-body p-6 mecustom-card">
                            <header class="flex justify-between items-end">
                                <a wire:click="show('{{ $collaborator->id }}')">
                                    <div class="flex space-x-4 items-center rtl:space-x-reverse">
                                        <div class="flex-none">
                                            <div
                                                class="h-10 w-10 rounded-md text-lg bg-slate-100 text-slate-900 dark:bg-slate-600 dark:text-slate-200 flex flex-col items-center justify-center font-normal capitalize">
                                                {{ $loop->iteration }}
                                            </div>
                                        </div>
                                        <div class="font-medium text-base leading-6">
                                            <div class="dark:text-slate-200 text-slate-900 max-w-[160px] truncate">

                                                {{ $collaborator->name }}

                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <div>
                                    <div class="dropstart relative">
                                        <button class="inline-flex justify-center items-center" type="button"
                                            id="tableDropdownMenuButton3" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            <iconify-icon class="text-xl ltr:ml-2 rtl:mr-2"
                                                icon="heroicons-outline:dots-vertical"></iconify-icon>
                                        </button>
                                        <ul
                                            class="dropdown-menu min-w-max absolute text-sm text-slate-700 dark:text-white hidden bg-white dark:bg-slate-700 shadow z-[2] float-left overflow-hidden list-none text-left rounded-lg mt-1 m-0 bg-clip-padding border-none">
                                            <li>
                                                <button wire:click="show('{{ $collaborator->id }}')"
                                                    class="hover:bg-slate-900 dark:hover:bg-slate-600 dark:hover:bg-opacity-70 hover:text-white
                        w-full border-b border-b-gray-500 border-opacity-10 px-4 py-2 text-sm dark:text-slate-300  last:mb-0 cursor-pointer first:rounded-t last:rounded-b flex space-x-2 items-center capitalize  rtl:space-x-reverse">
                                                    <iconify-icon icon="heroicons-outline:eye"></iconify-icon>
                                                    <span>voir</span></button>
                                            </li>
                                            <li>
                                                <button wire:click="openModal('{{ $collaborator->id }}')"
                                                    data-bs-toggle="modal" data-bs-target=".form-modal"
                                                    class="hover:bg-slate-900 dark:hover:bg-slate-600 dark:hover:bg-opacity-70 hover:text-white w-full border-b border-b-gray-500 border-opacity-10 px-4 py-2 text-sm dark:text-slate-300 last:mb-0 cursor-pointer first:rounded-t last:rounded-b flex space-x-2 items-center capitalize rtl:space-x-reverse">
                                                    <iconify-icon icon="clarity:note-edit-line"></iconify-icon>
                                                    <span>Editer</span></button>
                                            </li>
                                            <li>
                                                <button
                                                    wire:click="confirmDelete('{{ $collaborator->name }}', '{{ $collaborator->id }}')"
                                                    class="hover:bg-slate-900 dark:hover:bg-slate-600 dark:hover:bg-opacity-70 hover:text-white w-full border-b border-b-gray-500 border-opacity-10 px-4 py-2 text-sm dark:text-slate-300 last:mb-0 cursor-pointer first:rounded-t last:rounded-b flex space-x-2 items-center capitalize rtl:space-x-reverse">
                                                    <iconify-icon icon="fluent:delete-28-regular"></iconify-icon>
                                                    <span>Supprimer</span></button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </header>
                            <a wire:click="show('{{ $collaborator->id }}')">
                                <div class="text-slate-600 dark:text-slate-400 text-sm  "></div>
                                <div class="grid grid-cols-2 gap-4 mt-6 ">
                                    <div>
                                        <span class="block date-label">Activité</span>
                                        <span class="block date-text">{{ $collaborator->activity->name }}</span>
                                    </div>
                                    <div>
                                        <span class="block date-label">Téléphone</span>
                                        <span class="block date-text">{{ $collaborator->phone }}</span>
                                    </div>
                                </div>
                            </a>
                        </div>

                    @empty
                        <div class="flex justify-center items-center h-full">
                            <span class="">Aucun collaborateur</span>
                        </div>
                    @endforelse
                </div>
            </div>
            <br>
            <div class="col-md-12 mt-5 ">
                <div class="float-center "> {{ $collaborators->links() }}</div>
            </div>
        </div>
        <x-modal class="form-modal">
            <x-slot name="title">
                {{ $isUpdate ? 'Modification du collaborateur ' . $name : "Ajout d'un nouveau collaborateur" }}
            </x-slot>
            <x-slot name="body">
                <form wire:submit.prevent="storeData()" class="flex flex-col space-y-3">
                    @csrf
                    <div class="p-6 space-y-4">
                        <div class="input-area">
                            <div class="relative">
                                <label for="phone" class="form-label">Nom <span
                                        class="text-danger-500">*</span></label>
                                <input wire:model='name' type="text" class="form-control pr-9"
                                    placeholder="Veuillez renseigner le nom de l'collaborateur">
                                @error('name')
                                    <span
                                        class="font-Inter text-sm text-danger-500 pt-2 inline-block">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                        <div>
                            <label for="phone" class="form-label">Téléphone</label>
                            <textarea wire:model='phone' class="form-control" rows="3" placeholder="Veuillez renseigner le téléphone"></textarea>
                            @error('phone')
                                <span
                                    class="font-Inter text-sm text-danger-500 pt-2 inline-block">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="basicSelect" class="form-label">Activités</label>
                            <select wire:model='activity_id' name="basicSelect" id="basicSelect" class="form-control w-full mt-2">
                                <option selected="Selected" disabled="disabled" value="none"
                                    class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                                    Selectionner
                                    une activité</option>
                                @foreach ($activities as $activity)
                                    <option value="{{ $activity->id }}"
                                        class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                                        {{ $activity->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('activity_id')
                                <span
                                    class="font-Inter text-sm text-danger-500 pt-2 inline-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div
                        class="flex items-center justify-end p-6 space-x-2 border-t border-slate-200 rounded-b dark:border-slate-600">
                        <button data-bs-dismiss="modal" type="button"
                            class="btn inline-flex justify-center btn-outline-dark">Fermer</button>
                        <button type="submit"
                            class="btn inline-flex justify-center text-white bg-black-500">{{ $isUpdate ? 'Modifier' : 'Ajouter' }}</button>
                    </div>
                    {{-- <div
                        class="flex items-center p-6 space-x-2 border-t border-slate-200 rounded-b dark:border-slate-600">
                        <button class="btn inline-flex justify-center text-white bg-primary-500">Ajouter</button>
                    </div> --}}
                </form>
            </x-slot>
        </x-modal>
    </div>
</div>
