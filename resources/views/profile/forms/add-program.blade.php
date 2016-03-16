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
          <h3>
            <span class="lnr lnr-plus-circle bigger-1-5 blue-border circle text-blue" style="padding:15px;"></span>
          </h3>
          <br/>
          <h3 class="roboto-light text-blue">ADD TRAINING PROGRAM</h3>
        </div>
        <br/>
      </div>
      <div class="col-lg-offset-3 col-lg-6 col-md-12">
        <form action="{{url('dashboard/program/add')}}" method="POST" id="fg-form-1" class="fg-form box-grid padding-20">

          <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />

          <div class="col-xs-12 fg-input"
            data-type="text-autocomplete"
            data-label="Program"
            data-name="training_program"
            data-validation="required"
            data-placeholder="insert training program title"
            data-current=""
            data-get-ajax="{{ url('getautocompletedata/training_program/training_program_name_en') }}/"
            data-get-ajax-column="training_program_name_en"
            data-classes="form-control">
          </div>

          <div class="col-xs-12 fg-input"
            data-type="text"
            data-label="Learning Outcome"
            data-name="learning_outcomes"
            data-validation="required"
            data-placeholder="insert learning outcome"
            data-current=""
            data-multiple-chip="Add More Learning Outcome"
            data-classes="form-control">
          </div>

          <div class="col-xs-12 fg-input"
            data-type="combobox"
            data-label="Outcome Preferences"
            data-name="outcome_preferences"
            data-validation="required"
            data-placeholder="insert learning outcome"
            data-current=""
            data-item-label="Skill, Knowledge, Attitude"
            data-item-value="S,K,A"
            data-multiple-chip="Add More Learning Outcome"
            data-classes="form-control">
          </div>

          <div class="col-xs-12 fg-input"
            data-type="combobox"
            data-label="Include Certificate?"
            data-name="is_certification_included"
            data-validation="required"
            data-placeholder=""
            data-current=""
            data-item-label="Yes, No"
            data-item-value="1, 0"
            data-classes="form-control">
          </div>

          <!--
          <div class="col-xs-12 fg-input"
            data-type="combobox"
            data-label="Objective"
            data-name="title"
            data-validation="required"
            data-placeholder="insert award title"
            data-current=""
            data-classes="form-control"
            data-item-label="{{ implode(',',trans('custom.list_training_objectives')) }}"
            data-item-value="{{ implode(',',trans('custom.list_training_objectives')) }}">
          </div>

          <div class="col-xs-12 fg-input"
            data-type="combobox"
            data-label="Participant Seniority Level"
            data-name="title"
            data-validation="required"
            data-placeholder="insert award title"
            data-current=""
            data-classes="form-control"
            data-item-label="{{ implode(',',trans('custom.list_seniority_levels')) }}"
            data-item-value="{{ implode(',',trans('custom.list_seniority_levels')) }}">
          </div>

          <div class="col-xs-12 fg-input"
            data-type="combobox"
            data-label="Job Function"
            data-name="title"
            data-validation="required"
            data-placeholder="insert award title"
            data-current=""
            data-classes="form-control"
            data-item-label="{{ implode(',',trans('custom.list_job_functions')) }}"
            data-item-value="{{ implode(',',trans('custom.list_job_functions')) }}">
          </div>

          <div class="col-xs-12 fg-input"
            data-type="combobox"
            data-label="Industry"
            data-name="title"
            data-validation="required"
            data-placeholder="insert industry"
            data-current=""
            data-classes="form-control"
            data-item-label="{{ implode(',',trans('custom.list_industries')) }}"
            data-item-value="{{ implode(',',trans('custom.list_industries')) }}">
          </div>

          <div class="col-xs-12 fg-input"
            data-type="combobox"
            data-label="Able to Give Out Certification"
            data-name="title"
            data-validation="required"
            data-placeholder=""
            data-current=""
            data-classes="form-control"
            data-item-label="Yes, No"
            data-item-value="1, 0">
          </div>

          <div class="col-xs-12 fg-input"
            data-type="textarea"
            data-label="Learning Outcomes"
            data-name="title"
            data-validation=""
            data-placeholder="insert award description"
            data-current=""
            data-classes="form-control">
          </div>-->

          <div class="col-xs-12 fg-submit" data-value="Insert"></div>
        </form>
      </div>
    </div>
  </div>

@stop
