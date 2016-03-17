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
            @if(isset($certification))
              EDIT CERTIFICATION
            @else
              ADD CERTIFICATION
            @endif
          </h3>
        </div>
        <br/>
      </div>
      <div class="col-lg-offset-3 col-lg-6 col-md-12">
        @if(isset($certification))
          <form action="{{url('dashboard/certification/'.$certification->id.'/edit')}}" method="POST" id="fg-form-1" class="fg-form box-grid padding-20">
          <input type="hidden" name="_method" value="PUT" />
        @else
          <form action="{{url('dashboard/certification/add')}}" method="POST" id="fg-form-1" class="fg-form box-grid padding-20">
        @endif
          <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />

          <div class="col-xs-12 fg-input"
            data-type="text"
            data-label="Certification Title"
            data-name="title"
            data-validation="required"
            data-placeholder="insert certification title"
            data-current="<?php if(isset($certification)): echo $certification->title; else: echo Input::old('title'); endif; ?>"
            data-classes="form-control">
          </div>

          <div class="col-xs-12 fg-input"
            data-type="text"
            data-label="Publisher Name"
            data-name="publisher"
            data-validation="required"
            data-placeholder="insert certification title"
            data-current="<?php if(isset($certification)): echo $certification->publisher; else: echo Input::old('publisher'); endif; ?>"
            data-classes="form-control">
          </div>

          <div class="col-xs-12 fg-input"
            data-type="date"
            data-label="Date"
            data-name="published_date"
            data-validation=""
            data-placeholder="insert training date"
            data-current="<?php if(isset($certification)): echo $certification->published_date; else: echo Input::old('published_date'); endif; ?>"
            data-classes="form-control">
          </div>

          <div class="col-xs-12 fg-input"
            data-type="text-autocomplete"
            data-label="Skills"
            data-name="skill"
            data-validation=""
            data-placeholder="insert training provider name"
            data-items="Dunamis,Super Coach,Binus Creates,Binus Center"
            data-current=""
            data-get-ajax="{{ url('getautocompletedata/skills/skill_name') }}/"
            data-get-ajax-column="skill_name"
            data-classes="form-control"
            data-multiple-chip="add more skill">
          </div>

          <div class="col-xs-12 fg-input"
            data-type="textarea"
            data-label="Certification Description"
            data-name="description"
            data-validation=""
            data-placeholder="insert certification description"
            data-current="<?php if(isset($certification)): echo $certification->description; else: echo Input::old('description'); endif; ?>"
            data-classes="form-control">
          </div>

          <div class="col-xs-12 fg-submit" data-value="Insert"></div>
        </form>
      </div>
    </div>
  </div>

@stop
