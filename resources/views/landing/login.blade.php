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
          <h3 class="roboto-light text-blue">SIGN IN TO CEKTRAINING</h3>
        </div>
        <br/>
      </div>
      <div class="col-lg-offset-3 col-lg-6 col-md-12">
        <form action="{{ url('auth') }}" method="POST" id="fg-form-1" class="fg-form padding-20">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="col-xs-12 fg-input" data-type="text" data-label="" data-name="email" data-validation="required,email" data-placeholder="insert your email" data-current=""></div>
            <div class="col-xs-12 fg-input" data-type="password" data-label="" data-name="password" data-validation="required" data-placeholder="insert your password" data-current=""></div>
          <!--
          <div class="row">
            <div class="col-lg-12">
              <input type="text" class="form-control" placeholder="Email Address" name="email">
            </div>
            <div class="col-lg-12 error-message text-left">Sorry, email is not valid. Try using the @domain.com</div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <input type="password" class="form-control" placeholder="Password" name="password">
            </div>
            <div class="col-lg-12 error-message text-left">Invalid password, please try again.</div>
          </div>
          -->
          <div class="row">
            <div class="col-lg-12 text-center">
              <button type="submit" class="btn"><b>Create an Account</b> or <b>Sign In</b></button>
              <br/><br/>
              <a href="#">I forgot my password</a>
            </div>
          </div>
        </form>
        <div class="row border-top sign-in-social">
          <div class="col-lg-12 row">
            <div class="col-lg-12 bold">Or Login Via</div>
            <div class="col col-lg-6 col-sm-6">
              <a href="{{ url('auth/linkedin') }}" class="btn linkedin-back full-width">
                <i class="fa fa-linkedin"></i>
                LinkedIn
              </a>
            </div>
            <div class="col col-lg-6 col-sm-6">
              <a href="{{ url('auth/google') }}" class="btn google-back full-width">
                <i class="fa fa-google-plus"></i>
                Google
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@stop
