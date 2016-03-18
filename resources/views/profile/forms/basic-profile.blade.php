@extends('main-app')

@section('title', 'SPEAQUS')

@section('content')
  <br/><br/><br/><br/>
  <div class="container">
    <a href="{{ url('dashboard') }}" class="btn">
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
          <h3 class="roboto-light text-blue">BASIC PROFILE</h3>
        </div>
        <br/>
      </div>
      <div class="col-lg-offset-3 col-lg-6 col-md-12">
        <form action="{{url('dashboard/basic-profile')}}" method="POST" id="fg-form-1" class="fg-form box-grid padding-20" enctype="multipart/form-data">

          <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
          <input type="hidden" name="_method" value="PUT" />

          <input type="hidden" name="user_id" value="{{ $user->id }}">
          <div class="col-xs-6 fg-input"
            data-type="text"
            data-label="First Name"
            data-name="first_name"
            data-validation="required"
            data-placeholder=""
            data-current="<?php if(isset($user->first_name)): echo $user->first_name; else: echo Input::old('first_name'); endif; ?>"
            data-classes="form-control">
          </div>

          <div class="col-xs-6 fg-input"
            data-type="text"
            data-label="Last Name"
            data-name="last_name"
            data-validation="required"
            data-placeholder=""
            data-current="<?php if(isset($user->last_name)): echo $user->last_name; else: echo Input::old('last_name'); endif; ?>"
            data-classes="form-control">
          </div>

          <div class="col-xs-6 fg-input"
            data-type="textarea"
            data-label="Profile Summary"
            data-name="summary"
            data-validation="required"
            data-placeholder=""
            data-current="<?php if(isset($user->summary)): echo $user->summary; else: echo Input::old('summary'); endif; ?>"
            data-classes="form-control">
          </div>

          @if($user->group_id == 0)
            <?php $group_name = ''; ?>
          @else
            <?php $group_name = $user->group->group_name ?>
          @endif

          <div class="col-xs-12 fg-input"
            data-type="text-autocomplete"
            data-label="Current Corporate"
            data-name="corporate_name"
            data-validation=""
            data-placeholder=""
            data-current="<?php if(isset($user->corporate_name)): echo $user->corporate_name; else: echo Input::old('corporate_name'); endif; ?>"
            data-items="Foo, Bar, John, Doe, Hello, World"
            data-classes="form-control"
            data-get-ajax="{{ url('getautocompletedata/corporates/corporate_name') }}/"
            data-get-ajax-column="corporate_name"
            >
          </div>

          <div class="col-xs-12 fg-input"
            data-type="text-autocomplete"
            data-label="Current Job Title"
            data-name="job_title"
            data-validation=""
            data-placeholder=""
            data-current="<?php if(isset($user->title)): echo $user->title; else: echo Input::old('job_title'); endif; ?>"
            data-items="Foo, Bar, John, Doe, Hello, World"
            data-classes="form-control"
            data-get-ajax="{{ url('getautocompletedata/job_titles/job_title_name') }}/"
            data-get-ajax-column="job_title_name"
            >
          </div>

          <div class="col-xs-12 fg-input"
            data-type="date"
            data-label="Date of Birth"
            data-name="dob"
            data-validation=""
            data-placeholder=""
            data-current="<?php if(isset($user->dob)): echo $user->dob; else: echo Input::old('dob'); endif; ?>"
            data-classes="form-control">
          </div>

          <div class="col-xs-12 fg-input"
            data-type="text-autocomplete"
            data-label="Location"
            data-name="domicle_area"
            data-validation="required"
            data-placeholder=""
            data-items="<?php echo implode(',',Config('custom.list_locations')); ?>"
            data-current="<?php if(isset($user->domicle_area)): echo $user->domicle_area; else: echo Input::old('domicle_area'); endif; ?>"
            data-classes="form-control">
          </div>

          <div class="col-xs-12 fg-input"
            data-type="text-autocomplete"
            data-label="Area of Service"
            data-name="service_area"
            data-validation="required"
            data-placeholder=""
            data-items="Dunamis,Super Coach,Binus Creates,Binus Center"
            data-current="<?php if(isset($user->service_area)): echo $user->service_area; else: echo Input::old('service_area'); endif; ?>"
            data-classes="form-control">
          </div>

          <div class="col-xs-12 fg-input"
            data-type="textarea"
            data-label="Address"
            data-name="address"
            data-validation=""
            data-placeholder=""
            data-current="<?php if(isset($user->address)): echo $user->address; else: echo Input::old('address'); endif; ?>"
            data-classes="form-control">
          </div>

          <div class="col-xs-12 fg-input"
            data-type="text"
            data-label="Phone Number"
            data-name="phone_number"
            data-validation=""
            data-placeholder=""
            data-current="<?php if(isset($user->phone_number)): echo $user->phone_number; else: echo Input::old('phone_number'); endif; ?>"
            data-classes="form-control">
          </div>

          <div class="col-xs-12 fg-input"
            data-type="combobox"
            data-label="Gender"
            data-name="gender"
            data-validation=""
            data-item-label="Male,Female"
            data-item-value="M,F"
            data-current="<?php if(isset($user->gender)): echo $user->gender; else: echo Input::old('gender'); endif; ?>"
            data-classes="form-control">
          </div>

          <div class="col-xs-12 fg-input"
            data-type="combobox"
            data-label="Training Method"
            data-name="training_method"
            data-validation=""
            data-item-label="-- Choose Training Methods Below --,<?php echo implode(',',trans('custom.list_training_methods')); ?>"
            data-item-value="0,<?php echo implode(',',trans('custom.list_training_methods')); ?>"
            data-current="<?php if(isset($user->training_method)): echo $user->training_method; else: echo Input::old('training_method'); endif; ?>"
            data-classes="form-control">
          </div>

          <div class="col-xs-12 fg-input"
            data-type="combobox"
            data-label="Training Style"
            data-name="training_style"
            data-validation=""
            data-item-label="-- Choose Training Styles Below --,<?php echo implode(',',trans('custom.list_training_styles')); ?>"
            data-item-value="0,<?php echo implode(',',trans('custom.list_training_styles')); ?>"
            data-current="<?php if(isset($user->training_style)): echo $user->training_style; else: echo Input::old('training_style'); endif; ?>"
            data-classes="form-control">
          </div>

          <div class="col-xs-12 fg-input"
            data-type="text"
            data-label="Daily Rate"
            data-name="mandays_fee"
            data-validation="numeric"
            data-placeholder=""
            data-current="<?php if(isset($user->mandays_fee)): echo $user->mandays_fee; else: echo Input::old('mandays_fee'); endif; ?>"
            data-classes="form-control">
          </div>

          <div class="col-xs-12 fg-input"
            data-type="text"
            data-label="Your Custom URL"
            data-name="slug"
            data-validation="required"
            data-placeholder=""
            data-current="<?php if(isset($user->slug)): echo $user->slug; else: echo Input::old('slug'); endif; ?>"
            data-classes="form-control">
          </div>

          <div class="col-xs-12 fg-input"
            data-type="image"
            data-label="profile Picture"
            data-name="profile_picture"
            data-validation="required"
            data-placeholder=""
            data-current="<?php if(isset($user->profile_picture)): echo $user->profile_picture; else: echo Input::old('profile_picture'); endif; ?>"
            data-classes="form-control">
          </div>
          <img src="{{ url('images/users/'.$user->profile_picture) }}" width="200px" />

          <div class="col-xs-12 fg-submit" data-value="Update Profile"></div>
        </form>
      </div>
    </div>
  </div>

@stop
