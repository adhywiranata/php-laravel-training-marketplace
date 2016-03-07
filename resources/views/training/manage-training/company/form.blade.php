@extends('main-app')

@section('title', 'SPEAQUS')

@section('content')
  <br/><br/><br/><br/>
  <div class="container">
    <a href="{{url('super-cool-coach/trainings')}}" class="btn"><i class="fa fa-angle-left"></i> Go back</a>
    <div class="row box-profile">
      <div class="col-md-12 box-section profile-section datatable-section" data-section="trainings">
        <div class="row text-center">
          <h3><span class="lnr lnr-plus-circle bigger-1-5 blue-border circle text-blue" style="padding:15px;"></span></h3>
          <br/>
          <h3 class="roboto-light text-blue">ADD TRAINING</h3>
        </div>
        <br/>
      </div>
      <div class="col-lg-offset-2 col-lg-8 col-md-12">
        <form action="{{url('asd/create-training')}}" method="POST" id="fg-form-1" class="fg-form box-grid padding-20">
          <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
          <div class="col-xs-12 fg-input" data-type="text" data-label="Training title" data-name="title" data-validation="" data-placeholder="insert training title" data-current=""></div>
          <div class="col-xs-12 fg-input" data-type="text-autocomplete" data-label="Training Provider" data-name="training_provider" data-validation="alpha" data-placeholder="insert training provider name" data-items="Dunamis,Super Coach,Binus Creates,Binus Center" data-current=""></div>
          <div class="col-xs-12 fg-input" data-type="text" data-label="Trainer" data-name="trainer" data-validation="" data-placeholder="insert training participants" data-current=""></div>
          <div class="col-xs-12 fg-input" data-type="date" data-label="Start Date" data-name="start_date" data-validation="" data-current=""></div>
          <div class="col-xs-12 fg-input" data-type="date" data-label="End Date" data-name="end_date" data-validation="" data-current=""></div>
          <div class="col-xs-12 fg-input" data-type="text" data-label="Training Topic" data-name="topic" data-validation="" data-placeholder="insert training topic" data-current=""></div>
          <div class="col-xs-12 fg-input" data-type="text" data-label="Method" data-name="method" data-validation="" data-placeholder="insert training method" data-current=""></div>
          <div class="col-xs-12 fg-input" data-type="text" data-label="Venue" data-name="venue" data-validation="" data-placeholder="insert training venue" data-current=""></div>
          <div class="col-xs-12 fg-input" data-type="text" data-label="PIC Name" data-name="pic_name" data-validation="" data-placeholder="insert name of PIC of the training" data-current=""></div>
          <div class="col-xs-12 fg-input" data-type="text" data-label="Material" data-name="material" data-validation="" data-placeholder="insert material score" data-current=""></div>
          <div class="col-xs-12 fg-input" data-type="text" data-label="Delivery" data-name="delivery" data-validation="" data-placeholder="insert delivery score" data-current=""></div>
          <div class="col-xs-12 fg-input" data-type="text" data-label="Facility" data-name="facility" data-validation="" data-placeholder="insert facility score" data-current=""></div>
          <div class="col-xs-12 fg-input" data-type="text" data-label="Total Participant" data-name="participant" data-validation="" data-placeholder="insert number of training participant" data-current=""></div>
          <div class="col-xs-12 fg-input" data-type="text" data-label="Participant Department" data-name="department" data-validation="" data-placeholder="insert audience department" data-current=""></div>
          <div class="col-xs-12 fg-input" data-type="text" data-label="Language" data-name="language" data-validation="" data-placeholder="insert training language" data-current=""></div>
          <div class="col-xs-12 fg-input" data-type="text" data-label="Average Post Test Score" data-name="avg_post_test_score" data-validation="" data-placeholder="insert average post test score" data-current=""></div>
          <div class="col-xs-12 fg-input" data-type="text" data-label="Team Lead" data-name="team_lead" data-validation="" data-placeholder="insert the name of the team lead" data-current=""></div>
          <div class="col-xs-12 fg-input" data-type="text" data-label="Competencies" data-name="competencies" data-validation="" data-placeholder="insert training competencies" data-current=""></div>
          <div class="col-xs-12 fg-submit" data-value="Insert"></div>
        </form>
      </div>
    </div>
  </div>

@stop
