<!doctype html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">
    <title>Admin - @yield('title')</title>
    <!-- Simple bar CSS -->
    <link rel="stylesheet" href="{{ asset('admin-asstes') }}/css/simplebar.css">
    <!-- Fonts CSS -->
    <link
        href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <!-- Icons CSS -->
    <link rel="stylesheet" href="{{ asset('admin-asstes') }}/css/feather.css">
    <link rel="stylesheet" href="{{ asset('admin-asstes') }}/css/select2.css">
    <link rel="stylesheet" href="{{ asset('admin-asstes') }}/css/dropzone.css">
    <link rel="stylesheet" href="{{ asset('admin-asstes') }}/css/uppy.min.css">
    <link rel="stylesheet" href="{{ asset('admin-asstes') }}/css/jquery.steps.css">
    <link rel="stylesheet" href="{{ asset('admin-asstes') }}/css/jquery.timepicker.css">
    <link rel="stylesheet" href="{{ asset('admin-asstes') }}/css/quill.snow.css">
    <!-- Date Range Picker CSS -->
    <link rel="stylesheet" href="{{ asset('admin-asstes') }}/css/daterangepicker.css">
    <!-- App CSS -->
    <link rel="stylesheet" href="{{ asset('admin-asstes') }}/css/app-light.css" id="lightTheme">
    <link rel="stylesheet" href="{{ asset('admin-asstes') }}/css/app-dark.css" id="darkTheme" disabled>

    {{-- ================================================================================= --}}

    <style>
        /* CSS لتنسيق الرابط */
        a.list-group-item {
            text-decoration: none;
            /* إزالة الخط تحت الرابط */
            color: inherit;
            /* استخدام نفس لون النص */
        }

        /* تغيير لون الخلفية عند التمرير فوق العنصر */
        a.list-group-item:hover {
            background-color: #f0f0f0;
            /* لون خلفية عند التمرير */
        }

        /* تغيير لون النص داخل الرابط */
        a.list-group-item small {
            color: #333;
            /* لون النص */
        }

        /* تنسيق النص داخل البادج (badge) */
        .badge-pill {
            background-color: #e0e0e0;
            color: #ff0000;
            /* لون النص */
        }
    </style>

</head>
