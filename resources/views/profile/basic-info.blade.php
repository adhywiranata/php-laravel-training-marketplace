<div class="col-xs-12">
  <!--
  <div class="col-xs-2">
    <a href="{{ url('') }}" class="uppercase btn btn-default grey-back pull-left bold" style="color:#252525 !important;">
      <i class="fa fa-angle-left"></i>
      Back to Search
    </a>
  </div>
-->

</div>

<div class="col-lg-4 col-md-4 col-sm-4 col-xs-5">
  <div class="profile-picture">

    @if($grids->profile_picture == 'default.png'):
      <img src="{{ url('images/users/thumb/'.$grids->profile_picture) }}" width="100%">
    @else
      <img src="{{ url('images/users/thumb/'.$grids->profile_picture) }}" width="100%">
    @endif

    <?php $user_id = (isset(Auth::user()->id))?Auth::user()->id:''; ?>
    @if($grids->user_id != $user_id)
    <a class="btn full-width trigger-popup" data-trigger-popup="send-message">Send Message</a>
    <a class="btn full-width view_phone"> View Contact Number</a><br/>

    <span class="invisible_phone" style="display:none;" >
      <i class="fa fa-whatsapp text-green"></i> {{ $grids->phone_number }} <br/>
      <i class="fa fa-envelope-o text-green"></i> {{ $grids->email }} <br/>
      <i class="fa fa-building text-green"></i> work area: {{ $grids->service_area }} <br/>
      <!--
      <i class="fa fa-whatsapp text-green"></i> +6281231234 <br/>
      <i class="fa fa-envelope-o text-green"></i> ysubianto@gmail.com <br/>
      <i class="fa fa-whatsapp text-green"></i> office: +6281231234 <br/>
      <i class="fa fa-building text-green"></i> work address: Jalan Satu No. dua <br/>
      -->
    </span>
    @else
      <a href="{{ url('dashboard/basic-profile') }}" class="btn full-width">Edit Basic Profile</a>
      <a href="{{ url('dashboard/group') }}" class="btn full-width">Manage Training Provider</a>
    @endif
    <!--
      <a class="btn full-width">Edit Provider Profile</a>
      <a href="{{ url('dashboard/') }}" class="btn full-width">Manage My Profile</a>
    -->
  </div>
</div>
<div class="col-lg-8 col-md-8 col-sm-8 col-xs-7 user-list-info" style="padding-right:30px;">
  <div class="row">
    <a class="user-name">{{ $grids->name }}</a>

    <!--<a class="user-name">Mulyono Sephiaques</a>-->

    <i class="fa fa-check-circle text-green bigger-1-5 pointer" title="verified user"></i>
    <br/>
        <span class="user-score bigger-1-5"  title="Overall Evaluation Score: 9.5">{{$grids->score}}</span>
    <!--<span class="user-score bigger-1-5">9.0</span>-->
    <a href="{{ url('evaluation/s') }}" class=""  title="5 people evaluated this freelance trainer">
      (5 evaluation(s))
    </a>
  </div>
  <div class="row">
    @if($grids->area)
      <i class="fa fa-map-marker"></i>
      {{ $grids->area }}
    @endif

    <!--Jakarta, Indonesia-->
    @if($grids->languages)
      <i class="fa fa-comment"></i>
      @foreach($grids->languages as $language)
        {{ $language->language_name }}
      @endforeach
    @endif
    <!--Indonesian, English-->
  </div>
  <div class="row text-grey">
    {{$grids->summary}}
    <!--
    <p>Entrepreneur, Business Lecturer at Smartlearn University, Vice Rector of Employability
      and Entrepreneurship Center, Business Speaker</p>-->
  </div>
  <div class="row">
    <!--
    <span class="invisible_phone" style="display:none;">
      <i class="fa fa-whatsapp text-green"></i> +6281231234 <br/>
      <i class="fa fa-envelope-o text-green"></i> ysubianto@gmail.com
    </span>
  -->
    @if(Auth::guest())
      <!--
      <a class="trigger-popup trigger-sign-in"> View Contact Number</a><br/>
    -->
    @else
    <!--
      <a class="view_phone"> View Contact Number</a><br/>-->
    @endif

    <br/>
    <b>{{ trans('content.pr_expertises') }}</b><br/>
    @foreach($grids->expertises as $expertise)
      <a class="skill-tag trigger-popup tag" title="{{$expertise->total_endorse}} persons endorsed this skill">
        <span class="bold">{{$expertise->total_endorse}}</span>
        {{$expertise->expertise_name}}
      </a>
    @endforeach
  </div>
  <div class="row">
    <b>{{ trans('content.pr_industries') }}</b><br/>
    Consumer Electronics, E-Learning, Design
  </div>
  <div class="row">
    <b>{{ trans('content.pr_audience') }}</b><br/>
    Senior, Manager
  </div>
  <div class="row">
    <b>{{ trans('content.pr_job_functions') }}</b><br/>
    Marketing, Information Technology, Education
  </div>
  <br/>
</div>
