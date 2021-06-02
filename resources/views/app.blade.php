<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="shortcut icon" type="image/png" href="/icon.p">
{{--        <link rel="shortcut icon" type="image/png" href="/img/asset1.png">--}}

        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        {!!  instance()->CssLinkTag() !!}
{{--        <link rel="stylesheet" href="{{ ('/css/preview/main.css') }}">--}}
{{--        <link rel="stylesheet" href="{{ ('/css/preview/media.css') }}">--}}
{{--        <link href="//db.onlinewebfonts.com/c/0fadaa21fcac88ceee0bb8da992c221b?family=SalesforceSans-Regular" rel="stylesheet" type="text/css" />--}}
        <!-- Scripts -->
        @routes
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        @inertia

        <script>
            !function(){var analytics=window.analytics=window.analytics||[];if(!analytics.initialize)if(analytics.invoked)window.console&&console.error&&console.error("Segment snippet included twice.");else{analytics.invoked=!0;analytics.methods=["trackSubmit","trackClick","trackLink","trackForm","pageview","identify","reset","group","track","ready","alias","debug","page","once","off","on","addSourceMiddleware","addIntegrationMiddleware","setAnonymousId","addDestinationMiddleware"];analytics.factory=function(e){return function(){var t=Array.prototype.slice.call(arguments);t.unshift(e);analytics.push(t);return analytics}};for(var e=0;e<analytics.methods.length;e++){var key=analytics.methods[e];analytics[key]=analytics.factory(key)}analytics.load=function(key,e){var t=document.createElement("script");t.type="text/javascript";t.async=!0;t.src="https://cdn.segment.com/analytics.js/v1/" + key + "/analytics.min.js";var n=document.getElementsByTagName("script")[0];n.parentNode.insertBefore(t,n);analytics._loadOptions=e};analytics._writeKey="teFBELMofUmS7mAWZvUwGF57gw1L6kzP";analytics.SNIPPET_VERSION="4.13.2";
                analytics.load("teFBELMofUmS7mAWZvUwGF57gw1L6kzP");
            }}();
        </script>
    </body>
</html>
