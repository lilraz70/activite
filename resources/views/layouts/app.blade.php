<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr" class="light nav-floating">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <x-favicon />
    <title>{{ config('app.name', 'Activite') }}</title>
    {{-- Scripts --}}
    <link href="{{ asset('assets/back/css/custom.css') }}" rel="stylesheet">
    @vite(['resources/css/app.scss', 'resources/js/custom/store.js'])
    @stack('styles')

</head>

<body class="font-inter dashcode-app" id="body_class">
    <div class="app-wrapper">
        <!-- BEGIN: Sidebar Navigation -->
        <x-sidebar-menu />
        <!-- End: Sidebar -->
        <!-- BEGIN: Settings -->
        {{-- <x-dashboard-settings /> --}}
        <!-- End: Settings -->
        <div class="flex flex-col justify-between min-h-screen">
            <div>
                <!-- BEGIN: header -->
                <x-dashboard-header />
                <!-- BEGIN: header -->

                <div class="content-wrapper transition-all duration-150 ltr:ml-0 xl:ltr:ml-[248px] rtl:mr-0 xl:rtl:mr-[248px]"
                    id="content_wrapper">
                    <div class="page-content">
                        <div class="transition-all duration-150 container-fluid" id="page_layout">
                            <main id="content_layout">
                                <!-- Page Content -->
                                {{ $slot }}
                            </main>
                        </div>
                    </div>
                </div>
            </div>

            <!-- BEGIN: footer -->
            <x-dashboard-footer />
            <!-- BEGIN: footer -->

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.18/dist/sweetalert2.all.min.js"></script>
    @vite(['resources/js/app.js', 'resources/js/main.js'])
    @stack('scripts')
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            showCloseButton: true,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

        window.addEventListener('alert', ({
            detail: {
                type,
                message
            }
        }) => {
            Toast.fire({
                icon: type,
                title: message
            });
        });

        window.addEventListener('swal:modal', event => {
            new Swal({
                title: event.detail.title,
                text: event.detail.text,
                icon: event.detail.type
            });
        });
        window.addEventListener('swal:confirm-parameter', event => {
            new Swal({
                title: event.detail.title,
                text: event.detail.text,
                icon: event.detail.type,
                showCancelButton: true,
                confirmButtonColor: '#008000',
                cancelButtonColor: '#aaa',
                confirmButtonText: 'Modifier',
                cancelButtonText: 'Annuler'
            }).then((willDelete) => {
                // console.log(willDelete);
                if (willDelete.isConfirmed) {
                    if (event.detail.other) {
                        Livewire.emit(event.detail.method, event.detail.id, event.detail.other);
                    } else {
                        Livewire.emit(event.detail.method, event.detail.id);
                    }

                }
            });
        });
        window.addEventListener('swal:confirm', event => {
            new Swal({
                title: event.detail.title,
                text: event.detail.text,
                icon: event.detail.type,
                showCancelButton: true,
                confirmButtonColor: '#008000',
                cancelButtonColor: '#aaa',
                confirmButtonText: 'Supprimer',
                cancelButtonText: 'Annuler'
            }).then((willDelete) => {
                // console.log(willDelete);
                if (willDelete.isConfirmed) {
                    if (event.detail.other) {
                        Livewire.emit(event.detail.method, event.detail.id, event.detail.other);
                    } else {
                        Livewire.emit(event.detail.method, event.detail.id);
                    }
                }
            });
        });
        window.addEventListener('task:selected', event => {
            Livewire.emit(event.detail.method, event.detail.id);
        });
        // window.addEventListener('close:modal', event => {
        //     let modal = document.querySelector('.form-modal');
        //     modal.style.display = 'none';
        // });
        window.addEventListener('close:modal', event => {
            let modals = document.querySelectorAll('.form-modal, .form-modal-0');
            modals.forEach(modal => {
                modal.style.display = 'none';
            });
            document.body.classList.remove('modal-open'); // Supprime la classe 'modal-open' du body
            let backdrops = document.querySelectorAll('.modal-backdrop');
            backdrops.forEach(backdrop => {
                if (backdrop) {
                    backdrop.classList.remove('show'); // Supprime la classe 'show' du backdrop
                    backdrop.remove();
                }
            });
            // window.location.reload(); // Recharge la page
        });

        window.livewire.on('refreshPage', () => {
            location.reload();
        });
    </script>
</body>

</html>
