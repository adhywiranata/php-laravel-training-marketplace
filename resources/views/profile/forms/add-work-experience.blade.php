@extends('main-app')

@section('title', 'SPEAQUS')

@section('content')
  <br/><br/><br/><br/>
  <div class="container">
    <a href="{{ url('dashboard') }}" class="btn">
      <i class="fa fa-angle-left"></i>
      Go back
    </a>
    <div class="row box-profile">
      <div class="col-md-12 box-section profile-section datatable-section" data-section="trainings">
        <div class="row text-center">
          <h3><span class="lnr lnr-plus-circle bigger-1-5 blue-border circle text-blue" style="padding:15px;"></span></h3>
          <br/>
          <h3 class="roboto-light text-blue">
            @if(isset($work_experience))
              EDIT WORK EXPERIENCE
            @else
              ADD WORK EXPERIENCE
            @endif
          </h3>
        </div>
        <br/>
      </div>
      <div class="col-lg-offset-3 col-lg-6 col-md-12">

        @if(isset($work_experience))
          <form action="{{url('dashboard/work-experience/'.$work_experience->work_experience_id.'/edit')}}" method="POST" id="fg-form-1" class="fg-form box-grid padding-20">
          <input type="hidden" name="_method" value="PUT" />
        @else
          <form action="{{url('dashboard/work-experience/add')}}" method="POST" id="fg-form-1" class="fg-form box-grid padding-20">
        @endif

          <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />

          <div class="col-xs-12 fg-input"
            data-type="text"
            data-label="Title"
            data-name="title"
            data-validation="required"
            data-placeholder="insert work experience title"
            data-current="<?php if(isset($work_experience)): echo $work_experience->title; else: echo Input::old('title'); endif; ?>"
            data-classes="form-control">
          </div>

          <div class="col-xs-12 fg-input"
            data-type="text-autocomplete"
            data-label="Company"
            data-name="company"
            data-validation="required"
            data-placeholder="insert company name"
            data-items="Dunamis,Super Coach,Binus Creates,Binus Center"
            data-current="<?php if(isset($work_experience)): echo $work_experience->corporate_name; else: echo Input::old('company'); endif; ?>"
            data-get-ajax="{{ url('getautocompletedata/corporates/corporate_name') }}/"
            data-get-ajax-column="corporate_name"
            data-classes="form-control">
          </div>

          <div class="col-xs-12 fg-input"
            data-type="text"
            data-label="Position"
            data-name="position"
            data-validation="required"
            data-placeholder="insert position"
            data-current="<?php if(isset($work_experience)): echo $work_experience->position; else: echo Input::old('position'); endif; ?>"
            data-classes="form-control">
          </div>

          <div class="col-xs-12 fg-input"
            data-type="date"
            data-label="Start Date"
            data-name="start_date"
            data-validation=""
            data-placeholder="insert work experience start date"
            data-current=""
            data-classes="form-control">
          </div>

          <div class="col-xs-12 fg-input"
            data-type="date"
            data-label="End Date"
            data-name="end_date"
            data-validation=""
            data-placeholder="insert work experience end date"
            data-current=""
            data-classes="form-control">
          </div>

          <div class="col-xs-12 fg-input"
            data-type="textarea"
            data-label="Work Description"
            data-name="description"
            data-validation=""
            data-placeholder="insert work experience description"
            data-current="<?php if(isset($work_experience)): echo $work_experience->description; else: echo Input::old('description'); endif; ?>"
            data-classes="form-control">
          </div>

          @if(isset($work_experience))
          <div class="col-xs-12 fg-submit" data-value="Update"></div>
          @else
          <div class="col-xs-12 fg-submit" data-value="Insert"></div>
          @endif
        </form>
      </div>
    </div>
  </div>

@stop
