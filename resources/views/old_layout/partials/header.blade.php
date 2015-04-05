<!DOCTYPE html>

<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="@yield('description')">
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- Page Title -->
        <title>@yield('title')</title>

    <!-- Add to homescreen for Chrome on Android -->
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="icon" sizes="192x192" href="">

    <!-- Facebook Open Graph Data -->
    <meta property="og:url" content="">
    <meta property="og:title" content="">
    <meta property="og:description" content="">
    <meta property="og:image" content="">

    <!-- Link to Facebook Page -->
    <meta property="fb:app_id" content="" />

    <!-- Add to homescreen for Safari on iOS -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="LB">

    <link rel="apple-touch-icon" sizes="76x76" href="">
    <link rel="apple-touch-icon" sizes="120x120" href="">
    <link rel="apple-touch-icon" sizes="152x152" href="">
    <link rel="apple-touch-icon" sizes="180x180" href="">

    <!-- Style Sheet -->
    <link rel="stylesheet" href="">

    <!-- Favicon -->
    <link rel="shortcut icon" href="http://lebaneseblogs.com/img/favicon.ico" >
</head>

      <script>
        // Initiate Lebanese Blogs App object
        if ( typeof ltApp != 'object'){
          ltApp = {}
        };
        // Set up app Variables that require php and blade logic
          lbApp.imagePlaceHolder = 'http://lebaneseblogs.com/img/grey.gif';
          lbApp.rootPath = 'http://lebaneseblogs.com';
          lbApp.currentPageNumber= 1;
          lbApp.reachedEndOfPosts = false;
      </script>


<body>
