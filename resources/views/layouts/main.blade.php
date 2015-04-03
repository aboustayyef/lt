{{-- Meta Data and page info --}}
@include('layouts.partials.header')

{{-- "website loading curtain" --}}
@include('layouts.partials.loading')


<div id="siteWrapper">
  {{-- Header of Site --}}
  @include('layouts.partials.topBar')

<div id="momentumScrollingViewport">

  <div id="content">  
    <div class="posts cards">

  
    <h1>This is a test</h1>

    </div> <!-- posts cards -->
  </div> <!-- #content -->

</div> <!-- momentumScrollingViewport -->

@include('layouts.partials.sidebar')
</div> <!-- / siteWrapper -->

{{-- footer --}}
@include('layouts.partials.footer')