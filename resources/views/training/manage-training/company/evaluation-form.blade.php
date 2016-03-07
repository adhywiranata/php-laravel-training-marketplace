@extends('main-app')

@section('title', 'SPEAQUS')

@section('content')
  <br/><br/><br/><br/>
  <div class="container">
    <a href="{{url('super-cool-coach/training/1')}}" class="btn"><i class="fa fa-angle-left"></i> Go back</a>
    <div class="row box-profile">
      <div class="col-md-12 box-section profile-section datatable-section" data-section="trainings">
        <div class="row text-center">
          <h3><span class="lnr lnr-plus-circle bigger-1-5 blue-border circle text-blue" style="padding:15px;"></span></h3>
          <br/>
          <h3 class="roboto-light text-blue">ADD EVALUATION</h3>
        </div>
        <br/>
      </div>
      <div class="col-lg-offset-2 col-lg-8 col-md-12">
        <form action="{{url('super-cool-coach/training/1/add-evaluation')}}" method="POST" id="fg-form-2" class="fg-form box-grid padding-20">
          <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
          <div class="col-xs-12 fg-input" data-type="text" data-label="Audience Name" data-name="audience_name" data-validation="" data-placeholder="insert training title" data-current=""></div>
          <div class="col-xs-12 fg-input" data-type="text" data-label="Job Title" data-name="job_title" data-validation="" data-placeholder="insert training title" data-current=""></div>
          <div class="col-xs-12 fg-input" data-type="text" data-label="Job Level" data-name="job_level" data-validation="" data-placeholder="insert training title" data-current=""></div>
          <div class="col-xs-12 fg-input" data-type="text" data-label="Job Function" data-name="job_function" data-validation="" data-placeholder="insert training title" data-current=""></div>
          <div class="col-xs-12 fg-input" data-type="text" data-label="Material Score" data-name="material" data-validation="" data-placeholder="insert training title" data-current=""></div>
          <div class="col-xs-12 fg-input" data-type="textarea" data-label="Material Description" data-name="material_description" data-validation="" data-placeholder="insert training title" data-current=""></div>
          <div class="col-xs-12 fg-input" data-type="text" data-label="Delivery Score" data-name="delivery" data-validation="" data-placeholder="insert training title" data-current=""></div>
          <div class="col-xs-12 fg-input" data-type="textarea" data-label="Delivery Description" data-name="delivery_description" data-validation="" data-placeholder="insert training title" data-current=""></div>
          <div class="col-xs-12 fg-input" data-type="text" data-label="Facility Score" data-name="facility" data-validation="" data-placeholder="insert training title" data-current=""></div>
          <div class="col-xs-12 fg-input" data-type="textarea" data-label="Facility Description" data-name="facility_description" data-validation="" data-placeholder="insert training title" data-current=""></div>
          <div class="col-xs-12 fg-input" data-type="text" data-label="Post Test Score" data-name="post_test_score" data-validation="" data-placeholder="insert training title" data-current=""></div>
          <div class="col-xs-12 fg-submit" data-value="Add Evaluation"></div>
        </form>
      </div>

    </div>

  </div>

@stop
