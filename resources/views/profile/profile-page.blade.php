@extends('main-app')

@section('title', 'SPEAQUS')

@section('content')

  <div class="container">
    <!-- BREADCRUMB -->
    <div class="row">
      <div class="col-xs-12">
        <ul class="breadcrumb pull-left full-width">

          <li><a href="{{ url('') }}">{{ $gridType }}</a></li>

          <li>
            <a href="">{{ $grids->name }}</a>
          </li>
        </ul>
      </div>
    </div>
    <!-- END OF BREADCRUMB -->

    <div class="row">
      <div class="col-md-12 box-section">
        <div class="col-lg-12 box-profile">
          <!--
          <div class="row col-lg-1">

          </div>-->
          <div class="row col-lg-12" style="padding-left:20px;">
            <!-- user info -->
            @include('profile.basic-info')
            <!-- end of user info -->
            <!-- Row Box Profile -->
            @include('profile.tabs')
            <!-- end of Row Box Profile -->

          </div>

          @include('profile.video-popup')

        </div>
      </div>

    </div>

  </div>
@stop
