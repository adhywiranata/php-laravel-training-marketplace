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
          <h3 class="roboto-light text-blue">ADD TRAINING EXPERIENCE</h3>
        </div>
        <br/>
      </div>
      <div class="col-lg-offset-3 col-lg-6 col-md-12">
        <form action="{{url('asd/create-training')}}" method="POST" id="fg-form-1" class="fg-form box-grid padding-20">

          <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />

          <div class="col-xs-12 fg-input"
            data-type="text"
            data-label="Training title"
            data-name="title"
            data-validation="required"
            data-placeholder="insert training title"
            data-current=""
            data-classes="form-control">
          </div>

          <div class="col-xs-12 fg-input"
            data-type="text-autocomplete"
            data-label="Company"
            data-name="company"
            data-validation="required"
            data-placeholder="insert training provider name"
            data-items="Dunamis,Super Coach,Binus Creates,Binus Center"
            data-current=""
            data-classes="form-control">
          </div>

          <div class="col-xs-12 fg-input"
            data-type="date"
            data-label="Training Date"
            data-name="title"
            data-validation=""
            data-placeholder="insert training date"
            data-current=""
            data-classes="form-control">
          </div>

          <div class="col-xs-12 fg-input"
            data-type="textarea"
            data-label="Training Description"
            data-name="description"
            data-validation=""
            data-placeholder="insert training description"
            data-current=""
            data-classes="form-control">
          </div>

          <div class="col-xs-12 fg-input"
            data-type="text-autocomplete"
            data-label="Skills"
            data-name="company"
            data-validation="required"
            data-placeholder="insert training provider name"
            data-items="Dunamis,Super Coach,Binus Creates,Binus Center"
            data-current=""
            data-classes="form-control"
            data-multiple="add more skill">
          </div>

          <div class="col-xs-12 fg-submit" data-value="Insert"></div>
        </form>
      </div>
    </div>
  </div>

@stop
