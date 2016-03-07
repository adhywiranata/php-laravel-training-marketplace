@extends('main-app')

@section('title', 'SPEAQUS')

@section('content')
  <br/><br/><br/><br/>
  <div class="container">
    <a href="{{url('')}}" class="btn"><i class="fa fa-angle-left"></i> Go back</a>
    <div class="row box-profile">
      <div class="col-md-12 box-section profile-section datatable-section" data-section="trainings">
        <div class="row text-center">
          <h3><span class="lnr lnr-plus-circle bigger-1-5 blue-border circle text-blue" style="padding:15px;"></span></h3>
          <br/>
          <h3 class="roboto-light text-blue">CREATE PUBLIC TRAINING</h3>
        </div>
        <br/>
      </div>
      <div class="col-lg-offset-2 col-lg-8 col-md-12">
        <form action="{{url('super-cool-coach/training/1')}}" id="fg-form-1" class="fg-form box-grid padding-20">
          <div class="col-xs-12 fg-input" data-type="text" data-label="Public Training Name" data-name="training_title" data-validation="" data-placeholder="insert public training name" data-current=""></div>
          <div class="col-xs-12 fg-input" data-type="text" data-label="Trainer Name" data-name="trainer_name" data-validation="" data-placeholder="insert trainer name" data-current=""></div>
          <div class="col-xs-12 fg-input" data-type="text" data-label="Job Level" data-name="job_level" data-validation="" data-placeholder="insert job level" data-current=""></div>
          <div class="col-xs-12 fg-input" data-type="text" data-label="Job Function" data-name="job_function" data-validation="" data-placeholder="insert job function" data-current=""></div>
          <div class="col-xs-12 fg-input" data-type="text" data-label="Venue" data-name="venue" data-validation="" data-placeholder="insert training venue" data-current=""></div>
          <div class="col-xs-12 fg-input" data-type="text" data-label="Ticket Price" data-name="price" data-validation="" data-placeholder="insert training price" data-current=""></div>
          <div class="col-xs-12 fg-input" data-type="text" data-label="Target Industry" data-name="industry" data-validation="" data-placeholder="insert industries" data-current=""></div>
          <div class="col-xs-12 fg-input" data-type="text" data-label="Target Audience" data-name="audience" data-validation="" data-placeholder="insert training audiences" data-current=""></div>
          <div class="col-xs-12 fg-submit" data-value="Insert"></div>
        </form>
      </div>
    </div>
  </div>

@stop
