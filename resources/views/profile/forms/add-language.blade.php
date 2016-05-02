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
          <h3 class="roboto-light text-blue">ADD LANGUAGE</h3>
        </div>
        <br/>
      </div>
      <div class="col-lg-offset-4 col-lg-6 col-md-12">
        <form action="{{url('dashboard/language/create')}}" method="POST" id="fg-form-1" class="fg-form box-grid padding-20">

          <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />


          <div class="col-xs-12 fg-input"
            data-type="text-autocomplete"
            data-label="Languages {{ $errors->first('language')}}"
            data-name="language"
            data-validation="required"
            data-placeholder=""
            data-current="<?php echo Input::old('language'); ?>"
            data-get-ajax="{{ url('getautocompletedata/languages/language') }}/"
            data-get-ajax-column="language"
            data-classes="form-control"
            data-multiple-chip="add more language">
          </div>

          <div class="col-xs-12 fg-submit" data-value="Insert"></div>
        </form>
      </div>
    </div>
  </div>

@stop
