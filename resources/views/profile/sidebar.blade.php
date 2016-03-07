<div class="col-lg-2 col-md-3 col-sm-3 col-xs-3 user-side-info hidden-md hidden-sm hidden-xs" style="position:fixed; left:3%; padding-top:10px; border:0; border-right:1px solid rgba(0,0,0, .1); height:100%">
  <div class="row">
    <div class="col-lg-12">
      @if(Auth::guest())
        <a class="btn full-width trigger-popup trigger-sign-in bold">
          <i class="fa fa-plus"></i>
          Add to Contacts
        </a>
      @else
        <a class="btn full-width trigger-connect bold">
          <i class="fa fa-plus"></i>
          Add to Contacts
        </a>
      @endif
    </div>
    <br/><br/>
    <!--
    <div class="col-lg-12">
      <a href="{{ url('evaluation/s') }}" class="btn green-back full-width bold">
        <i class="fa fa-eye"></i>
        Training Evaluation
      </a>
    </div>
    -->
  </div>
  <div class="row">
    <div class="col-lg-12">
      <h4 class="border-top">
        <br/>Videos</h4>
      <div class="row text-center video-grid">
        <span class="lnr lnr-chevron-left bigger-2 pointer"></span>
        <img class="trigger-popup" src="{{ url('images/users/video.jpg') }}" width="70%" data-trigger-popup="profile-video" />
        <span class="lnr lnr-chevron-right bigger-2 pointer"></span>
        <span class="fa fa-play fa-4x text-white trigger-popup" data-trigger-popup="profile-video" style="position:absolute; top:40%; left:40%;"></span>
        <br/><br/><a href="">Business Coaching Trial</a>
      </div>
    </div>
    <div class="col-lg-12">
      <h4 class="border-top">
        <br/>Clients</h4>
        <a href="">Bank Mandiri</a>
        <br/><a href="">Binus University</a>
        <br/><a href="">FWD</a>
        <br/><a href="">Coca Cola</a>
        <!--
      <div class="row text-center client-grid">
        <span class="lnr lnr-chevron-left bigger-2 pointer"></span>
        <img src="{{ url('images/groups/astra.jpg') }}" width="70%" />
        <span class="lnr lnr-chevron-right bigger-2 pointer"></span>
        <br/><br/><a href="">PT Great Company</a>
      </div>-->
    </div>
  </div>
</div>
