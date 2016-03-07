@extends('main-app')

@section('title', 'SPEAQUS')

@section('content')
  <!--
  <div class="row heading">
    <div class="col-lg-12" style="background:rgba(0,0,0, .6); padding:130px 0px 0 0px;">
      <div class="col-lg-6 col-md-offset-1">
      </div>
    </div>
  </div>
-->


  <br/><br/><br/><br/>
  <div class="container">
    <!-- BREADCRUMB -->
    <div class="row">
      <div class="col-xs-12">
        <ul class="breadcrumb pull-left full-width">
          <li><a href="{{ url('') }}">Freelance Trainers</a></li>
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
          <div class="row col-lg-2">
            @include('profile.sidebar')
          </div>
          <div class="row col-lg-10" style="padding-left:20px;">
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
