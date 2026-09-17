import $ from 'jquery';

window.$ = window.jQuery = $;


/*
|--------------------------------------------------------------------------
| FEATHER ICONS
|--------------------------------------------------------------------------
*/

document.addEventListener('DOMContentLoaded', function () {

    if (typeof feather !== 'undefined') {

        feather.replace();

    }

});



/*
|--------------------------------------------------------------------------
| SIDEBAR MOBILE
|--------------------------------------------------------------------------
*/

document.addEventListener('DOMContentLoaded', function () {


    const sidebar = document.getElementById('sidebar');
    const overlay = document.querySelector('.sidebar-overlay');
    const toggleButtons = document.querySelectorAll('.sidebar-toggle');

    /* Toggle Sidebar */

    toggleButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        });

    });

    /* Close Sidebar melalui Overlay */

    if (overlay) {
        overlay.addEventListener('click', function(){
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
            }
        );
    }
});



/*
|--------------------------------------------------------------------------
| SIDEBAR SUBMENU
|--------------------------------------------------------------------------
|
| Mendukung submenu bertingkat:
|
| Level 1
| └── Level 2
|     └── Level 3
|
| Bahkan dapat digunakan lebih dari 3 level.
|
| Aturan:
|
| - Tidak menggunakan onclick=""
| - Tidak menggunakan ID submenu
| - Tidak menggunakan submenu-arrow
| - Hanya submenu pada level yang sama yang ditutup
|
*/

document.addEventListener('DOMContentLoaded', function(){
    document.querySelectorAll('.sidebar-item > .sidebar-menu').forEach(function(menu){
            menu.addEventListener('click', function(event){
                event.preventDefault();

                // Parent sidebar item

                const parent = this.closest('.sidebar-item');

                if (!parent) {
                    return;
                }

                /*
                |--------------------------------------------------------------------------
                | Ambil submenu langsung
                |--------------------------------------------------------------------------
                */

                const submenu = parent.querySelector(':scope > .submenu');

                if (!submenu) {
                    return;
                }

                /*
                |--------------------------------------------------------------------------
                | Status submenu
                |--------------------------------------------------------------------------
                */

                const isClosed = submenu.classList.contains('hidden');

                /*
                |--------------------------------------------------------------------------
                | Parent list
                |--------------------------------------------------------------------------
                |
                | Ini penting untuk submenu bertingkat.
                |
                | Kita hanya menutup sibling pada
                | level yang sama.
                |
                */

                const parentList = parent.parentElement;

                if (parentList) {
                    parentList.querySelectorAll(':scope > .sidebar-item').forEach(function (item) {


                        /*
                        |--------------------------------------------------------------------------
                        | Jangan tutup menu yang sedang diklik
                        |--------------------------------------------------------------------------
                        */

                        if (item === parent) {
                            return;
                        }



                        /*
                        |--------------------------------------------------------------------------
                        | Tutup submenu sibling
                        |--------------------------------------------------------------------------
                        */

                        item.classList.remove('open');

                        const child = item.querySelector(':scope > .submenu');

                        if (child) {
                            child.classList.add('hidden');
                        }

                        /*
                        |--------------------------------------------------------------------------
                        | Reset warna menu sibling
                        |--------------------------------------------------------------------------
                        */

                        const parentMenu = item.querySelector(':scope > .sidebar-menu');

                        if (parentMenu) {
                            parentMenu.classList.remove('bg-indigo-600','text-white');
                            parentMenu.classList.add('text-slate-300');
                        }
                    });
                }


                /*
                |--------------------------------------------------------------------------
                | BUKA SUBMENU
                |--------------------------------------------------------------------------
                */

                if (isClosed) {
                    submenu.classList.remove('hidden');
                    parent.classList.add('open');
                    this.classList.remove('text-slate-300');
                    this.classList.add('bg-indigo-600','text-white');
                }

                /*
                |--------------------------------------------------------------------------
                | TUTUP SUBMENU
                |--------------------------------------------------------------------------
                */

                else {
                    submenu.classList.add('hidden');
                    parent.classList.remove('open');
                    this.classList.remove('bg-indigo-600','text-white');
                    this.classList.add('text-slate-300');

                    /*
                    |--------------------------------------------------------------------------
                    | Reset semua child submenu
                    |--------------------------------------------------------------------------
                    |
                    | Jika Level 1 ditutup, maka Level 2
                    | dan Level 3 di bawahnya ikut ditutup.
                    |
                    */

                    submenu.querySelectorAll('.sidebar-item').forEach(function (childItem) {

                        childItem.classList.remove('open');
                        const childSubmenu = childItem.querySelector(':scope > .submenu');

                        if (childSubmenu) {
                            childSubmenu.classList.add('hidden');
                        }

                        const childMenu = childItem.querySelector(':scope > .sidebar-menu');

                        if (childMenu) {
                            childMenu.classList.remove('bg-indigo-600','text-white');
                            childMenu.classList.add('text-slate-300');
                        }
                    });
                }
            }
        );
    });
});



/*
|--------------------------------------------------------------------------
| DROPDOWN
|--------------------------------------------------------------------------
*/

document.addEventListener('DOMContentLoaded', function () {
    const dropdownButtons = document.querySelectorAll('.dropdown-toggle');

    /*
    |--------------------------------------------------------------------------
    | Toggle Dropdown
    |--------------------------------------------------------------------------
    */

    dropdownButtons.forEach(function (button) {
        button.addEventListener(
            'click',
            function (event) {
                event.stopPropagation();



                /*
                |--------------------------------------------------------------------------
                | Parent dropdown
                |--------------------------------------------------------------------------
                */

                const parent =
                    this.closest(
                        '.relative'
                    );


                if (!parent) {

                    return;

                }


                const dropdown =
                    parent.querySelector(
                        '.dropdown-menu'
                    );


                if (!dropdown) {

                    return;

                }



                /*
                |--------------------------------------------------------------------------
                | Tutup dropdown lainnya
                |--------------------------------------------------------------------------
                */

                document
                    .querySelectorAll(
                        '.dropdown-menu'
                    )
                    .forEach(function (item) {


                        if (item !== dropdown) {

                            item.classList.add(
                                'hidden'
                            );

                        }


                    });



                /*
                |--------------------------------------------------------------------------
                | Toggle dropdown aktif
                |--------------------------------------------------------------------------
                */

                dropdown.classList.toggle(
                    'hidden'
                );


            }
        );


    });



    /*
    |--------------------------------------------------------------------------
    | Close dropdown ketika klik di luar
    |--------------------------------------------------------------------------
    */

    document.addEventListener(
        'click',
        function (event) {


            document
                .querySelectorAll(
                    '.dropdown-menu'
                )
                .forEach(function (dropdown) {


                    const parent =
                        dropdown.closest(
                            '.relative'
                        );


                    if (
                        parent &&
                        !parent.contains(
                            event.target
                        )
                    ) {

                        dropdown.classList.add(
                            'hidden'
                        );

                    }


                });


        }
    );


});





// Jalankan langsung paling atas untuk menghindari FOUC (Flash of Unstyled Content)
if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
    document.documentElement.classList.add('dark');
} else {
    document.documentElement.classList.remove('dark');
}

document.addEventListener('DOMContentLoaded', () => {
    // ... kode interaksi sebelumnya ...

    // Logika Button Dark Mode
    const toggleBtn = document.getElementById('dark-mode-toggle');
    if (toggleBtn) {
        toggleBtn.addEventListener('click', () => {
            // Ubah class di tag HTML
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.theme = 'light';
            } else {
                document.documentElement.classList.add('dark');
                localStorage.theme = 'dark';
            }
        });
    }
});

