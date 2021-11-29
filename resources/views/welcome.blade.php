<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Recipe Now</title>
        <link href="http://fonts.cdnfonts.com/css/sofia-pro" rel="stylesheet">
       <script>
         (function(){
           window.Laravel = {
             csrfToken: '{{ csrf_token() }}'
           };
         })();
       </script>
    </head>
  <body>
      <div id="app">
        @if (Auth::check())
        <App :user="{{ Auth::user() }}"></App>
        @else
          <App :user="false"></App>
        @endif
      </div>
  </body>
  <script src="{{ mix('js/app.js') }}"></script>
  <style>
@import url("http://fonts.cdnfonts.com/css/sofia-pro");
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Sofia Pro", sans-serif;
}  
  </style>
</html>
