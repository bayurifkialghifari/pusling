<html>
    <head>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="https://unpkg.com/@adminkit/core@latest/dist/css/app.css">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
        <script src="https://unpkg.com/@adminkit/core@latest/dist/js/app.js" data-navigate-once="true"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <style>
            body {
                font-family: "Roboto", sans-serif;
                margin: 0;
                padding: 0;
                background-color: #f4f4f4;
                print-color-adjust: exact;
            }

            @page {
                size: auto;   /* auto is the initial value */
                margin: 0;
            }
        </style>
    </head>
    <body>
        <div class="wrapper" data-scroll-x="0">
            <div class="main">
                <main class="content">
                    <div class="container-fluid p-0">
                        <livewire:cms.petugas.jadwal-laporan :$id />
                    </div>
                </main>
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                setTimeout(() => {
                    window.print();
                }, 500);
            });
        </script>
    </body>
</html>
