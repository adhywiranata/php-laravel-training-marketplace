<div class="col-lg-12 box-grid">
  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3">
    <div class="profile-picture">
      <img src="http://speaqus.com/img/photos/profile_picture/100x100/{{ $grid->profile_picture }}" width="100%">


      @if($gridType == 1)
        <a href="{{url('/u/'.$grid->slug)}}" class="btn btn-default full-width">
          <i class="fa fa-mail-forward"></i>
          Profile
        </a>
      @endif
      @if($gridType == 2)
        <a href="{{url('/g/'.$grid->slug)}}" class="btn btn-default full-width">
          <i class="fa fa-mail-forward"></i>
          Profile
        </a>
      @endif

    </div>
  </div>
  <div class="col-lg-6 col-md-7 col-sm-7 col-xs-6 user-list-info">
    <div class="row pointer" title="Verified User">
      @if($gridType == 1)
      <a href="{{url('/u/'.$grid->slug)}}" class="user-name capitalize">
        {{ $grid->name }}
      </a>
      @endif
      @if($gridType == 2)
      <a href="{{url('/g/'.$grid->slug)}}" class="user-name capitalize">
        {{ $grid->name }}
      </a>
      <!--<a href="{{url('/g/super-cool-coach')}}" class="user-name">{{ $grid->name }}</a>-->
      @endif
      <i class="fa fa-check-circle text-green bigger-1-5 pointer"></i>
      <span class="user-score">{{ $grid->score }}</span>
      <span class="text-grey">
        <a href="{{ url('evaluation/s') }}" class=""  title="5 people evaluated this freelance trainer">
          (0 evaluation)
        </a>
        </span>
    </div>
    <div class="row">


      @if($grid->area)
        <i class="fa fa-map-marker"></i>
        {{ $grid->area }}
      @endif

      <!--
      <i class="fa fa-map-marker"></i>
      Jakarta, Indonesia
      {{ $grid->area }}-->
      <!--
      <i class="fa fa-comment"></i>
      <!-- Indonesian, English-->
    </div>
    <div class="row">
      <p class="text-grey">
        {{ $grid->summary }}
      </p>
    </div>
    <div class="row">
      <b>{{ trans('content.pr_expertises') }}</b><br/>
      @foreach($grid->expertises as $grid_expertise)
        <a class="skill-tag trigger-popup tag" title="{{ $grid_expertise->total_endorse }} persons endorsed this skill">
           <span class="bold">{{ $grid_expertise->total_endorse }}</span>
           {{ $grid_expertise->expertise_name }}
         </a>
      @endforeach
        <!--<a class="skill-tag tag">more <i class="fa fa-angle-right"></i></a>-->
    </div>

    <br/>
  </div>
  <div class="col-lg-4 col-md-3 col-sm-3 col-xs-3 user-side-info">
    <div class="row">
      <div class="col-lg-12">
        @if(Auth::guest())
          <a class="btn full-width trigger-popup trigger-sign-in">
            <i class="fa fa-plus"></i>
            Add to Contacts
          </a>
        @else
          <a class="btn full-width trigger-connect">
            <i class="fa fa-plus"></i>
            Add to Contacts
          </a>
        @endif
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <b>{{ trans('content.pr_industries') }}</b><br/>
        Consumer Electronics, E-Learning, Design
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <b>{{ trans('content.pr_audience') }}</b><br/>
        Senior, Manager
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <b>{{ trans('content.pr_job_functions') }}</b><br/>
        Marketing, Information Technology, Education
      </div>
    </div>
    <div class="row">
      <div class="col-lg-6">
        <i class="fa fa-thumb-up"></i>
        Added <b>{{ $grid->connection }}</b> times
      </div>
      <div class="col-lg-6">
        <i class="fa fa-thumb-up"></i>
        <b>{{ $grid->review }}</b> Testimonials
      </div>
      <div class="col-lg-6">
        <i class="fa fa-thumb-up"></i>
        <b>{{ $grid->training }}</b> Trainings
      </div>
      <div class="col-lg-6">
        <i class="fa fa-thumb-up"></i>
        <b>{{$grid->view}}</b> views
      </div>
    </div>
    <!--
    <div class="row">
      <div class="col-lg-12">
        Price Range <br/>
        <b>Rp 15.000.000 </b>
        -
        <b>Rp 30.000.000 </b>
      </div>
    </div>
    -->
  </div>
  <!-- Training Info! -->
  <!--
  <div class="col-lg-12" style="border-top:1px solid rgba(0,0,0, .1); position:absolute; bottom:0; height:auto; overflow:hidden; padding:10px; z-index:+1; background:#f5f5f5">
    <i class="fa fa-bell"></i>
    Will be speaking at
    <a href="#">Great Business Comes from Finding the Right Opportunities</a>
    at Jakarta on March 23th 2016.
    <a class="#">Join Now</a>
  </div-->
</div>
