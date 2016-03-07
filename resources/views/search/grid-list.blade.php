@extends('main-app')

@section('title', 'SPEAQUS')

@section('content')
  <br/><br/><br/><br/>
  <div class="container">
    <!-- HIDDEN FIELD TO HIGHLIGHT SEARCH TAGS -->
    <input id="hidden-tag-highlighter"
      type="hidden"
      value="Services|||Neuro Linguistic Programming|||Leadership|||SEO" />
    <!-- -->
    <div class="row">
      <div class="col-md-3 sidebar">
        @if($gridType == 1)
          @include('search.search-box-speaker')
        @endif
        @if($gridType == 2)
          @include('search.search-box-speaker')
        @endif
        @if($gridType == 3)
          @include('search.search-box-speaker')
        @endif
      </div>
      <div class="col-md-9 box-section">
        <h3 class="bold uppercase text-grey">
          @if($gridType == 1)
            83 Trainers Found
          @endif
          @if($gridType == 2)
            3 Training Providers Found
          @endif
          @if($gridType == 3)
            1 Public Training Found
          @endif

        </h3>

        @if($gridType == 1 || $gridType == 2)
          @foreach($grids as $grid)
            @include('search.grid-list-partials.profile-grid')
          @endforeach
        @endif
        @if($gridType == 3)
          @include('search.grid-list-partials.event-grid')
        @endif

        @include('search.grid-list-partials.not-found-grid')
        <div class="row"><br/><br/></div>
        <div class="row" style="margin-top:100px;">
          <center>
            <i class="fa fa-circle-o-notch fa-spin bigger-2 blue-border circle text-blue" style="padding:15px;"></i>
          </center>
        </div>
        <div class="row"><br/><br/><br/></div>
      </div>

    </div>

  </div>
@stop
