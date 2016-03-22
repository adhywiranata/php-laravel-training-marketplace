@extends('main-app')

@section('title', 'SPEAQUS')

@section('content')
  <div class="container">
    <a href="{{ url('') }}" class="btn">
      <i class="fa fa-angle-left"></i> Go back
    </a>
    <div class="row box-profile">
      <div class="col-md-12 box-section profile-section datatable-section" data-section="trainings">
        <div class="row text-center">
          <!--<h3>
            <span class="lnr lnr-plus-circle bigger-1-5 blue-border circle text-blue" style="padding:15px;">
            </span>
          </h3>-->
          <br/>
          <h3 class="roboto-light text-blue">SIGN UP TO CEKTRAINING</h3>
        </div>
        <br/>
      </div>
      <div class="col-lg-offset-3 col-lg-6 col-md-12">
        <form action="{{url('signup-front/'.$role)}}" method="POST" id="fg-form-1" class="fg-form box-grid padding-20" enctype="multipart/form-data">

          <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />

          <div class="row col-xs-12">
            <h4 class="text-center">User Profile</h4>
            <hr/>
          </div>

          <div class="col-xs-12 fg-input"
            data-label="Email"
            data-classes="form-control"
            data-type="text"
            data-label=""
            data-name="email"
            data-validation="required,email"
            data-placeholder="insert your email"
            data-current="">
          </div>

          <span class="fg-error">{{$errors->first('email')}}</span>

          <div class="col-xs-12 fg-input"
            data-label="Password"
            data-classes="form-control"
            data-type="password"
            data-label=""
            data-name="password"
            data-validation="required"
            data-placeholder="insert your password"
            data-current="">
          </div>

          <span class="fg-error">{{$errors->first('password')}}</span>

          <div class="col-xs-6 fg-input"
            data-type="text"
            data-label="First Name"
            data-name="first_name"
            data-validation="required"
            data-placeholder="insert award title"
            data-current=""
            data-classes="form-control">
          </div>

          <span class="fg-error">{{$errors->first('first_name')}}</span>

          <div class="col-xs-6 fg-input"
            data-type="text"
            data-label="Last Name"
            data-name="last_name"
            data-validation="required"
            data-placeholder="insert award title"
            data-current=""
            data-classes="form-control">
          </div>

          <span class="fg-error">{{$errors->first('last_name')}}</span>

          <div class="col-xs-6 fg-input"
            data-type="textarea"
            data-label="Profile Summary"
            data-name="summary"
            data-validation="required"
            data-placeholder="insert your brief summary"
            data-current=""
            data-classes="form-control">
          </div>

          <div class="col-xs-12 fg-input"
            data-type="text-autocomplete"
            data-label="Current Corporate"
            data-name="corporate_name"
            data-validation=""
            data-placeholder="insert corporate name"
            data-current=""
            data-items="Foo, Bar, John, Doe, Hello, World"
            data-classes="form-control"
            data-get-ajax="{{ url('getautocompletedata/corporates/corporate_name') }}/"
            data-get-ajax-column="corporate_name">
          </div>

          <div class="col-xs-12 fg-input"
            data-type="text-autocomplete"
            data-label="Current Job Title"
            data-name="job_title"
            data-validation=""
            data-placeholder="pick job title name"
            data-current=""
            data-items="Foo, Bar, John, Doe, Hello, World"
            data-classes="form-control"
            data-get-ajax="{{ url('getautocompletedata/job_titles/job_title_name') }}/"
            data-get-ajax-column="job_title_name">
          </div>

          <!--
          <div class="col-xs-12 fg-input"
            data-type="date"
            data-label="Date of Birth"
            data-name="dob"
            data-validation=""
            data-placeholder=""
            data-current=""
            data-classes="form-control">
          </div>
          -->

          <!--
          <div class="col-xs-12 fg-input"
            data-type="text-autocomplete"
            data-label="Location"
            data-name="domicle_area"
            data-validation="required"
            data-placeholder="insert publisher name"
            data-items="Dunamis,Super Coach,Binus Creates,Binus Center"
            data-current=""
            data-classes="form-control">
          </div>
          -->

          <div class="col-xs-12 fg-input"
            data-type="text-autocomplete"
            data-label="Area of Service"
            data-name="service_area"
            data-validation="required"
            data-placeholder="insert area of service"
            data-items="<?php echo implode(',',trans('custom.list_locations')); ?>"
            data-current=""
            data-classes="form-control">
          </div>

          <!--
          <div class="col-xs-12 fg-input"
            data-type="textarea"
            data-label="Address"
            data-name="address"
            data-validation=""
            data-placeholder="insert address"
            data-current=""
            data-classes="form-control">
          </div>
          -->

          <div class="col-xs-12 fg-input"
            data-type="text"
            data-label="Phone Number"
            data-name="phone"
            data-validation=""
            data-placeholder="insert phone number"
            data-current=""
            data-classes="form-control">
          </div>

          <!--
          <div class="col-xs-12 fg-input"
            data-type="combobox"
            data-label="Gender"
            data-name="gender"
            data-validation=""
            data-item-label="Male,Female"
            data-item-value="M,F"
            data-current=""
            data-classes="form-control">
          </div>
          -->

          <!--
          <div class="col-xs-12 fg-input"
            data-type="combobox"
            data-label="Training Method"
            data-name="training_method"
            data-validation=""
            data-item-label="-- Choose Training Methods Below --,<?php echo implode(',',trans('custom.list_training_methods')); ?>"
            data-item-value="0,<?php echo implode(',',trans('custom.list_training_methods')); ?>"
            data-current=""
            data-classes="form-control">
          </div>
        -->
        <!--
          <div class="col-xs-12 fg-input"
            data-type="combobox"
            data-label="Training Style"
            data-name="training_style"
            data-validation=""
            data-item-label="-- Choose Training Styles Below --,<?php echo implode(',',trans('custom.list_training_styles')); ?>"
            data-item-value="0,<?php echo implode(',',trans('custom.list_training_styles')); ?>"
            data-current=""
            data-classes="form-control">
          </div>
          -->

          <!--
          <div class="col-xs-12 fg-input"
            data-type="text"
            data-label="Daily Rate"
            data-name="mandays_fee"
            data-validation="numeric"
            data-placeholder="insert daily rate"
            data-current=""
            data-classes="form-control">
          </div>
        -->
        <!--
          <div class="col-xs-12 fg-input"
            data-type="text"
            data-label="Slug"
            data-name="mandays_fee"
            data-validation="required"
            data-placeholder="insert daily rate"
            data-current=""
            data-classes="form-control">
          </div>
        -->
          <div class="col-xs-12 fg-input"
            data-type="image"
            data-label="profile Picture"
            data-name="profile_picture"
            data-validation="required"
            data-placeholder="insert profile picture"
            data-current=""
            data-classes="form-control">
          </div>

          @if($role == 'training-provider')
          <div class="row col-xs-12">
            <h4 class="text-center">Provider Profile</h4>
            <hr/>
          </div>

          <div class="col-xs-12 fg-input"
            data-label="Provider Name"
            data-classes="form-control"
            data-type="text"
            data-label=""
            data-name="provider_name"
            data-validation="required"
            data-placeholder="insert training provider name"
            data-current="">
          </div>

          <div class="col-xs-12 fg-input"
            data-label="Provider Email"
            data-classes="form-control"
            data-type="text"
            data-label=""
            data-name="provider_email"
            data-validation="required,email"
            data-placeholder="insert training provider email"
            data-current="">
          </div>

          <div class="col-xs-12 fg-input"
            data-type="text"
            data-label="Provider Contact Number"
            data-name="provider_phone"
            data-validation=""
            data-placeholder="insert phone number"
            data-current=""
            data-classes="form-control">
          </div>

          <div class="col-xs-12 fg-input"
            data-type="image"
            data-label="Training Provider Logo"
            data-name="provider_profile_picture"
            data-validation="required"
            data-placeholder="insert profile picture"
            data-current=""
            data-classes="form-control">
          </div>

          @endif

          <div class="col-xs-12 fg-submit" data-value="Update Profile"></div>
        </form>
      </div>
    </div>
  </div>

@stop
