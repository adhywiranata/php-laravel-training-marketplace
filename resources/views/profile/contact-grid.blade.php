
<div class="col-lg-4">
  <div class="col-lg-12 box-grid">
    <div class="col-lg-4 col-md-2 col-sm-2 col-xs-3">
      <div class="" style="width:100%;">
        <img src="{{ url('images/users/thumb/'.$grid->profile_picture) }}" width="80%">
      </div>
    </div>
    <div class="col-lg-8 col-md-7 col-sm-7 col-xs-6 user-list-info">
      <div class="row pointer" title="Verified User">
        @if($gridType == 1)
        <a href="{{url('/u/'.$grid->slug)}}" class="user-name capitalize" style="font-size:1.2em !important;">
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
      </div>
      <div class="row">


        @if($grid->area)
          <i class="fa fa-map-marker"></i>
          {{ $grid->area }}
        @endif
        <br/>
        @if($grid->phone_number != '')
          <i class="fa fa-whatsapp text-green"></i> {{ $grid->phone_number }} <br/>
        @else
          <br/>
        @endif
        @if($grid->email != '')
          <i class="fa fa-envelope-o text-green"></i> {{ $grid->email }}
        @else
          <br/>
        @endif
        <!--
        <i class="fa fa-map-marker"></i>
        Jakarta, Indonesia
        {{ $grid->area }}-->
        <!--
        <i class="fa fa-comment"></i>
        <!-- Indonesian, English-->
      </div>
      <!--
      <div class="row">
        <b>{{ trans('content.pr_expertises') }}</b><br/>
        @foreach($grid->expertises as $grid_expertise)
          <a class="skill-tag tag" title="{{ $grid_expertise->total_endorse }} persons endorsed this skill">
             <span class="bold">{{ $grid_expertise->total_endorse }}</span>
             {{ $grid_expertise->expertise_name }}
           </a>
        @endforeach
      </div>
    -->
      <br/>
    </div>
    <div class="col-lg-12">
      <a class="btn btn-default trigger-popup" data-trigger-popup="send-message">Send Message</a>
      <!--
      <a class="btn btn-default trigger-popup" data-trigger-popup="send-evaluation">Give Evaluation</a>
      -->
      <a class="btn btn-default trigger-popup" data-trigger-popup="send-testimonial">Give Testimonial</a>
    </div>
</div><!-- end of col lg 12 -->
</div>
