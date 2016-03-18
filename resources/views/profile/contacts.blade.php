@extends('main-app')

@section('title', 'SPEAQUS')

@section('content')
  <br/><br/><br/><br/>

  <div class="container">
    <!-- BREADCRUMB -->
    <div class="row">
      <div class="col-xs-12">
        <ul class="breadcrumb pull-left full-width">
          <li><a href="{{ url('u/Fandy-Limardi') }}">Dashboard</a></li>
          <li>
            <a href="">Contacts</a>
          </li>
        </ul>
      </div>
    </div>
    <!-- END OF BREADCRUMB -->

    <div class="row">
      <div class="col-md-12 sidebar">
        <div class="col-md-3">
          <div class="row">
            <div class="col-xs-1">
              <i class="fa fa-search padding-10"></i>
            </div>
            <div class="col-xs-10">
              <input type="text" class="form-control" placeholder="Search..." />
            </div>
          </div>
        </div>

        <div class="col-md-3">
          <div class="row border-left">
            <div class="col-xs-4 padding-10">
              <span class="bold uppercase">
                Sort By
              </span>
            </div>
            <div class="col-xs-8">
              <select class="form-control">
                <option>First Name</option>
                <option>Last Name</option>
                <option>Newly Added</option>
              </select>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="row border-left">
            <div class="col-xs-2 padding-10">
              <span class="bold uppercase">
                Filter By
              </span>
            </div>
            <div class="col-xs-4">
              <select class="form-control">
                <option>Corporate</option>
                <option>Training Program</option>
                <option>Skill</option>
              </select>
            </div>
            <div class="col-xs-4">
              <input type="text" class="form-control" placeholder="Search..." />
            </div>
            <div class="col-xs-2">
              <a class="btn btn-default">
                <i class="fa fa-spinner"></i> Reset
              </a>
            </div>

          </div>
        </div>

      </div>
    </div>
    <div class="row">
      <div class="col-md-12 box-profile padding-20">
        @if($gridType == 1 || $gridType == 2)
          <?php $loopflag = 1; ?>
          @foreach($grids as $grid)
            @if($loopflag%3!=0)
              <div class="row">
            @endif
            @include('profile.contact-grid')
            @if($loopflag%3==0)
              </div>
            @endif
            <?php $loopflag++ ?>
          @endforeach
        @endif
        @if($gridType == 3)
          @include('profile.contact-grid')
        @endif
      </div>

    </div>

  </div>

@stop
