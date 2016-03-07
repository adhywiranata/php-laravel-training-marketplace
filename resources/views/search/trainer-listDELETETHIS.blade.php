@extends('main-app')

@section('title', 'SPEAQUS')

@section('content')
  <div class="row heading">
    <div class="col-lg-12" style="background:rgba(0,0,0, .6); padding:130px 0px 0 0px;">
      <div class="col-lg-6 col-md-offset-1">
        <h1>Find A Speaker</h1>
        <span style="position:relative; bottom:8px; font-size:1.2em;">Search your desired trainers from over 10,000 trainers</span>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-md-3 sidebar">
        @include('search.search-box-speaker')
      </div>
      <div class="col-md-9 box-section">

      @foreach($users as $user)
        @include('search.user-grid-n')
      @endforeach

        <!--
        include('search.user-grid-n')
        include('search.user-grid-n')
        include('search.user-grid-n')
        include('search.user-grid-n')
        -->

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


  <div class="popup-overlay">
  </div>

  @include('general.sign-in')

  @include('general.request-popup')

@stop
