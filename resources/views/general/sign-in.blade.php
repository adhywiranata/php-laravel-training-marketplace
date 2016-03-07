<div class="popup sign-in-popup row" style="display:none;">
  <a href="" class="popup-close"><span class="lnr lnr-cross"></span></a>
  <div class="col-lg-7 col-sm-12 sign-form-col">
    <div class="row">
      <img src="{{ url('images/cektraining-color.png')}}" class="popup-logo">
    </div>
    <div class="row">
      <p>Please Sign In or Sign Up to view Trainer's Profile.<br/>
        We provide more than you can imagine! <a href="">See why you should join SPEAQUS</a>
      </p>
    </div>
    <div class="col-lg-12">
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
          <div class="col-lg-12">
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
  <div class="col-lg-5 hidden-md hidden-sm hidden-xs sign-in-col">
    <div class="row">
      <br/>
      <br/>
      <p>
        <div class="full-width">Are You from</div>
        <div class="bigger-2 bold full-width">Training Provider ?</div>
      </p>
      <p>Increase your Training Sales by 90% by Signing Up as
        a Training Provider and invite your trainers!
      </p>
      <br/>
      <div class="row">
        <a href="#" class="btn"><b>Sign Up</b> as <b>Training Provider</b></a><br/><br/>
        <a href="#" class="see-more">See why you should join the other <b>3,000 trainers</b> here</a>
      </div>
    </div>
  </div>
</div>
