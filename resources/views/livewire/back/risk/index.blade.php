<div class="flex-1 md:w-[calc(100%-320px)]">
    <div class="h-full card">
        <div class="p-0  h-full relative card-body">
            <!-- BEGIN: Email Header -->
            <div
                class="md:flex justify-between items-center sticky bg-white dark:bg-slate-800 top-0 pt-6 pb-4 px-6 z-[3] border-b
border-slate-100 dark:border-slate-700 rounded-t-md">
                <div class="flex items-center rtl:space-x-reverse">
                    <div
                        class="open-sidebar md:h-8 md:w-8 h-6 w-6 bg-slate-100 dark:bg-slate-900 dark:text-slate-400 flex flex-col justify-center
        items-center ltr:mr-3 rlt:ml-3 lg:hidden md:text-base text-sm rounded-full cursor-pointer">
                        <iconify-icon icon="heroicons-outline:menu-alt-2"></iconify-icon>
                    </div>
                    <div class="max-w-[180px] flex items-center space-x-1 rtl:space-x-reverse leading-[0]">
                        <div class="search px-3 mx-6 rounded flex items-center space-x-3 rtl:space-x-reverse">
                            <input placeholder="Rechercher..." wire:model.live="search"
                                class="w-full flex-none block bg-transparent placeholder:font-normal placeholder:text-slate-400 py-2 focus:ring-0 focus:outline-none dark:text-slate-200 dark:placeholder:text-slate-400">
                            <div class="flex-none text-base text-slate-900 dark:text-slate-400">
                                <iconify-icon icon="bytesize:search"></iconify-icon>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="md:block hidden">
                    <div class="relative">
                        <div class="flex-auto h-full px-6 flex justify-end">
                            @if ($task)
                                <button class="btn inline-flex justify-center btn-dark w-full" data-bs-toggle="modal"
                                    data-bs-target=".form-modal-0">
                                    <span class="flex items-center">
                                        <iconify-icon class="text-xl ltr:mr-2 rtl:ml-2"
                                            icon="ph:plus-bold"></iconify-icon>
                                        <span>Ajouter un risque</span>
                                    </span>
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Email Header -->
            <div class="h-full all-todos overflow-x-hidden">
                <ul class=" h-full email-list">
                    @forelse ($risks as $risk)
                        <li data-status="sent,spam,personal,business" data-stared="false"
                            class="flex px-7 space-x-6 group md:py-6 py-3 relative cursor-pointer hover:bg-slate-50 dark:hover:bg-transparent group
                items-center rtl:space-x-reverse">

                            <div class="email-fav">
                                {{ $loop->iteration }}
                            </div>
                            <div class="flex items-center space-x-3 rtl:space-x-reverse">
                                <div class="read-unread-name flex-1 text-sm min-w-max">

                                </div>
                            </div>
                            <p class="truncate">
                                <span class="text-sm text-slate-600 dark:text-slate-300 font-normal">
                                    <a wire:click="show('{{ $risk->id }}')"> {{ $risk->name }}</a>

                                </span>
                            </p>
                            <div class="grow"></div>
                            <span>

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
                                                <button wire:click="openModal('{{ $risk->id }}')"
                                                    data-bs-toggle="modal" data-bs-target=".form-modal-0"
                                                    class="hover:bg-slate-900 dark:hover:bg-slate-600 dark:hover:bg-opacity-70 hover:text-white
                    w-full border-b border-b-gray-500 border-opacity-10 px-4 py-2 text-sm dark:text-slate-300  last:mb-0 cursor-pointer first:rounded-t last:rounded-b flex space-x-2 items-center capitalize  rtl:space-x-reverse">
                                                    <iconify-icon icon="heroicons-outline:eye"></iconify-icon>
                                                    <span>voir</span></button>
                                            </li>
                                            <li>
                                                <button
                                                    wire:click="confirmDelete('{{ $risk->name }}', '{{ $risk->id }}')"
                                                    class="hover:bg-slate-900 dark:hover:bg-slate-600 dark:hover:bg-opacity-70 hover:text-white w-full border-b border-b-gray-500 border-opacity-10 px-4 py-2 text-sm dark:text-slate-300 last:mb-0 cursor-pointer first:rounded-t last:rounded-b flex space-x-2 items-center capitalize rtl:space-x-reverse">
                                                    <iconify-icon icon="fluent:delete-28-regular"></iconify-icon>
                                                    <span>Supprimer</span></button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </span>
                        </li>
                    @empty
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <li class="flex items
                    -center justify-center h-full">
                            <div class="text-center">
                                <p class="text-slate
                        dark:text-slate-300">Aucun risque trouvé
                                    @if (!$task)
                                        selectionner une tâche
                                    @endif
                                </p>
                            </div>
                        </li>
                    @endforelse
                    <br>
                    <br>
                    <li class="flex items
                    -center justify-center h-full mt-[-5]">
                        {{ $risks->links() }}
                    </li>
                </ul>

            </div>
        </div>

        {{-- <x-email.single-email /> --}}
    </div>
    <x-form-modal class="form-modal-0">
        <x-slot name="title">
            {{ $isUpdate ? 'Modification du risque ' . $name : "Ajout d'un nouveau risque" }}
        </x-slot>
        <x-slot name="body">
            <form wire:submit.prevent="storeRiskData()" class="flex flex-col space-y-3">
                @csrf
                <div class="p-6 space-y-4">
                    <div class="input-area">
                        <div class="relative">
                            <label for="description" class="form-label">Nom <span
                                    class="text-danger-500">*</span></label>
                            <input wire:model='name' type="text" class="form-control pr-9"
                                placeholder="Veuillez renseigner le nom du risque">
                            @error('name')
                                <span
                                    class="font-Inter text-sm text-danger-500 pt-2 inline-block">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                    <div>
                        <label for="description" class="form-label">Description</label>
                        <textarea wire:model='description' class="form-control" rows="3" placeholder="Veuillez renseigner la description"></textarea>
                        @error('description')
                            <span class="font-Inter text-sm text-danger-500 pt-2 inline-block">{{ $message }}</span>
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
            </form>
        </x-slot>
    </x-form-modal>

</div>
