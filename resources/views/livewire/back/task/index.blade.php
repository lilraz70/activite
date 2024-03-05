<div>

    <div class="border-b border-slate-100 dark:border-slate-700 py-1">
        <div class="flex-1 h-full px-6">
            <button class="btn inline-flex justify-center btn-dark w-full" data-bs-toggle="modal"
                data-bs-target=".form-modal">
                <span class="flex items-center">
                    <iconify-icon class="text-xl ltr:mr-2 rtl:ml-2" icon="ph:plus-bold"></iconify-icon>
                    <span>Ajouter une tâche</span>
                </span>
            </button>
        </div>
        <br>
        <div class="search px-3 mx-6 rounded flex items-center space-x-3 rtl:space-x-reverse">
            <input placeholder="Rechercher..." wire:model.live="search"
                class="w-full flex-1 block bg-transparent placeholder:font-normal placeholder:text-slate-400 py-2 focus:ring-0
focus:outline-none dark:text-slate-200 dark:placeholder:text-slate-400">
            <div class="flex-none text-base text-slate-900 dark:text-slate-400">
                <iconify-icon icon="bytesize:search"></iconify-icon>
            </div>
        </div>
    </div>
    <br>
    @forelse ($tasks as $task)
        <li class="{{ $firstTask ? 'active' : '' }} email-categorie-list">
            <div class="flex justify-between">
                <label>
                    <span class="flex-1 flex space-x-2 rtl:space-x-reverse">
                        <span class="capitalize text-sm">
                            <a wire:click="dispatchTaskSelected('{{ $task->id }}')"> {{ $task->name }}</a>

                        </span>
                    </span>
                </label>
                <div>
                    <div class="dropstart relative">
                        <button class="inline-flex justify-center items-center" type="button"
                            id="tableDropdownMenuButton3" data-bs-toggle="dropdown" aria-expanded="false">
                            <iconify-icon class="text-xl ltr:ml-2 rtl:mr-2"
                                icon="heroicons-outline:dots-vertical"></iconify-icon>
                        </button>
                        <ul
                            class="dropdown-menu min-w-max absolute text-sm text-slate-700 dark:text-white hidden bg-white dark:bg-slate-700 shadow z-[2] float-left overflow-hidden list-none text-left rounded-lg mt-1 m-0 bg-clip-padding border-none">
                            <li>
                                <button wire:click="openModal('{{ $task->id }}')" data-bs-toggle="modal"
                                    data-bs-target=".form-modal"
                                    class="hover:bg-slate-900 dark:hover:bg-slate-600 dark:hover:bg-opacity-70 hover:text-white
    w-full border-b border-b-gray-500 border-opacity-10 px-4 py-2 text-sm dark:text-slate-300  last:mb-0 cursor-pointer first:rounded-t last:rounded-b flex space-x-2 items-center capitalize  rtl:space-x-reverse">
                                    <iconify-icon icon="heroicons-outline:eye"></iconify-icon>
                                    <span>voir</span></button>
                            </li>
                            {{-- <li>
                                <button wire:click="openModal('{{ $task->id }}')" data-bs-toggle="modal"
                                    data-bs-target=".form-modal"
                                    class="hover:bg-slate-900 dark:hover:bg-slate-600 dark:hover:bg-opacity-70 hover:text-white w-full border-b border-b-gray-500 border-opacity-10 px-4 py-2 text-sm dark:text-slate-300 last:mb-0 cursor-pointer first:rounded-t last:rounded-b flex space-x-2 items-center capitalize rtl:space-x-reverse">
                                    <iconify-icon icon="clarity:note-edit-line"></iconify-icon>
                                    <span>Editer</span></button>
                            </li> --}}
                            <li>
                                <button wire:click="confirmDelete('{{ $task->name }}', '{{ $task->id }}')"
                                    class="hover:bg-slate-900 dark:hover:bg-slate-600 dark:hover:bg-opacity-70 hover:text-white w-full border-b border-b-gray-500 border-opacity-10 px-4 py-2 text-sm dark:text-slate-300 last:mb-0 cursor-pointer first:rounded-t last:rounded-b flex space-x-2 items-center capitalize rtl:space-x-reverse">
                                    <iconify-icon icon="fluent:delete-28-regular"></iconify-icon>
                                    <span>Supprimer</span></button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </li>
        {{ $firstTask = false }}
    @empty
        <li class="active email-categorie-list" data-status="all">
            <label>
                <span class="flex-1 flex space-x-2 rtl:space-x-reverse">
                    <span class="capitalize text-sm">
                        Aucune tâche trouvée
                    </span>
                </span>
            </label>
        </li>
    @endforelse

    <br>
    <div class="col-md-12 mt-5 ">
        <div class="float-center "> {{ $tasks->links() }}</div>
    </div>
    <x-modal class="form-modal">
        <x-slot name="title">
            {{ $isUpdate ? 'Modification de la tâche ' . $name : "Ajout d'une nouvelle tâche" }}
        </x-slot>
        <x-slot name="body">
            <form wire:submit.prevent="storeData()" class="flex flex-col space-y-3">
                @csrf
                <div class="p-6 space-y-4">
                    <div class="input-area">
                        <div class="relative">
                            <label for="description" class="form-label">Nom <span
                                    class="text-danger-500">*</span></label>
                            <input wire:model='name' type="text" class="form-control pr-9"
                                placeholder="Veuillez renseigner le nom de la tâche">
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
    </x-modal>
</div>
