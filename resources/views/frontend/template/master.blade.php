<!DOCTYPE html>
<html lang="en">

@include('frontend.partials.head')

<body>

  @include('frontend.partials.navbar')

  @yield('subtitle')

  @yield('content')

  @include('frontend.partials.footer')

  @include('frontend.partials.loader')

  @include('frontend.partials.script')

  @yield('addscript')

</body>

</html>