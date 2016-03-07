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
          <h3>
            <span class="lnr lnr-plus-circle bigger-1-5 blue-border circle text-blue" style="padding:15px;">
            </span>
          </h3>
          <br/>
          <h3 class="roboto-light text-blue">BASIC PROFILE</h3>
        </div>
        <br/>
      </div>
      <div class="col-lg-offset-3 col-lg-6 col-md-12">
        <form action="{{url('dashboard/basic-profile')}}" method="POST" id="fg-form-1" class="fg-form box-grid padding-20">

          <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
          <input type="hidden" name="_method" value="PUT" />

          <input type="hidden" name="user_id" value="{{ $user->user_id }}">
          <div class="col-xs-6 fg-input"
            data-type="text"
            data-label="First Name"
            data-name="first_name"
            data-validation="required"
            data-placeholder="insert award title"
            data-current="{{ $user->first_name }}"
            data-classes="form-control">
          </div>

          <div class="col-xs-6 fg-input"
            data-type="text"
            data-label="Last Name"
            data-name="last_name"
            data-validation="required"
            data-placeholder="insert award title"
            data-current="{{ $user->last_name }}"
            data-classes="form-control">
          </div>

          <div class="col-xs-6 fg-input"
            data-type="textarea"
            data-label="Profile Summary"
            data-name="summary"
            data-validation="required"
            data-placeholder="insert your brief summary"
            data-current="{{ $user->summary }}"
            data-classes="form-control">
          </div>

          @if($user->group_id == 0)
            <?php $group_name = ''; ?>
          @else
            <?php $group_name = $user->group->group_name ?>
          @endif
          "

          <div class="col-xs-12 fg-input"
            data-type="text-autocomplete"
            data-label="Current Company"
            data-name="group_name"
            data-validation="required"
            data-placeholder="insert publisher name"
            data-items="Dunamis,Super Coach,Binus Creates,Binus Center"
            data-current="{{ $group_name }}"
            data-classes="form-control">
          </div>

          <div class="col-xs-12 fg-input"
            data-type="text-autocomplete"
            data-label="Current Job Title"
            data-name="job_title"
            data-validation="required"
            data-placeholder="insert publisher name"
            data-items="Dunamis,Super Coach,Binus Creates,Binus Center"
            data-current="{{ $user->current_job_position }}"
            data-classes="form-control">
          </div>

          <div class="col-xs-12 fg-input"
            data-type="text"
            data-label="Email"
            data-name="email"
            data-validation="required|email"
            data-placeholder="insert email"
            data-current="{{ $user->email }}"
            data-classes="form-control">
          </div>

          <div class="col-xs-12 fg-input"
            data-type="date"
            data-label="Date of Birth"
            data-name="dob"
            data-validation=""
            data-placeholder=""
            data-current="{{ $user->dob }}"
            data-classes="form-control">
          </div>

          <div class="col-xs-12 fg-input"
            data-type="text-autocomplete"
            data-label="Location"
            data-name="location"
            data-validation="required"
            data-placeholder="insert publisher name"
            data-items="Dunamis,Super Coach,Binus Creates,Binus Center"
            data-current="{{ $user->area }}"
            data-classes="form-control">
          </div>

          <div class="col-xs-12 fg-input"
            data-type="text-autocomplete"
            data-label="Area of Service"
            data-name="area"
            data-validation="required"
            data-placeholder="insert publisher name"
            data-items="Dunamis,Super Coach,Binus Creates,Binus Center"
            data-current="{{ $user->area }}"
            data-classes="form-control">
          </div>

          <div class="col-xs-12 fg-input"
            data-type="textarea"
            data-label="Address"
            data-name="address"
            data-validation=""
            data-placeholder="insert address"
            data-current="{{ $user->address }}"
            data-classes="form-control">
          </div>

          <div class="col-xs-12 fg-input"
            data-type="text"
            data-label="Phone Number"
            data-name="phone"
            data-validation=""
            data-placeholder="insert phone number"
            data-current="{{ $user->phone_number }}"
            data-classes="form-control">
          </div>

          <div class="col-xs-12 fg-input"
            data-type="combobox"
            data-label="Gender"
            data-name="gender"
            data-validation=""
            data-item-label="Male,Female"
            data-item-value="M,F"
            data-current="{{ $user->gender }}"
            data-classes="form-control">
          </div>

          <div class="col-xs-12 fg-submit" data-value="Insert"></div>
        </form>
      </div>
    </div>
  </div>

@stop
