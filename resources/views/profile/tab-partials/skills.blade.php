<div class="col-lg-12 profile-section" data-section="skills">

  @if($is_admin == 1)
  <a href="{{ url('dashboard/skill/add') }}" class="btn">
    <i class="fa fa-plus"></i>
    Add New Skills
  </a>
  @endif

  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="row">
      <div class="col-lg-12 col-md-10 col-sm-10 col-xs-10">
        <h4>Skill Endorsements</h4>
      </div>
    </div>
  </div>
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

  @foreach($expertises as $expertise)

    <div class="row">
      <div class="col-lg-5 col-md-3 col-sm-3 col-xs-10">
        <a title="0 persons endorsed this skill" class="skill-tag tag pull-left">
              <span class="bold">{{$expertise->total_endorse}}</span>
              {{$expertise->expertise_name}}
        </a>

        @if(Auth::check())
          <?php $user_id = Auth::user()->id; ?>
          @if($grids->user_id != $user_id)
            @if($expertise->endorse_status == 0)
              <a href="{{ url('/skill/'.$expertise->expertise_node_id.'/endorse') }}">endorse</a>
            @else
              <form action="{{ url('/skill/'.$expertise->expertise_node_id.'/remove-endorse') }}" method="post" style="float:left !important">
                <input type="hidden" name="_method" value="DELETE" />
                <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                <input type="submit" value="remove endorse" style="background:none; border:0; color:#337ab7; float:left !important; cursor:pointer;" />
              </form>
            @endif
          @endif
        @else
          <a class="trigger-popup trigger-sign-in">endorse</a>
        @endif


        @if( ($is_admin == 1) && (count($expertise->endorse_users) == 0) )
          <form action="{{url('/dashboard/skill/'.$expertise->expertise_node_id )}}" method="post">
            <input type="hidden" name="_method" value="DELETE" />
            <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
            <button type="submit" class="btn btn-margin red-back pull-right">Delete</button>
          </form>
        @endif
      </div>
      <div class="col-lg-5">
        @if(count($expertise->endorse_users) > 0)
        <a href="">
          <i class="fa fa-caret-right fa-2x pull-right"></i>
        </a>
        @endif
        @foreach($expertise->endorse_users as $endorse_user)
        <a href="{{url('/u/'.$endorse_user->endorse_slug)}}">
          <img title="<?php echo $endorse_user->first_name." ".$endorse_user->last_name; ?>" class="pull-right" style="margin:0 2px;" src="{{ url('images/users/'.$endorse_user->profile_picture) }}" height="30px" />
        </a>
        @endforeach
      </div>
    </div>

  @endforeach
<!--
    <div class="row">
      <div class="col-lg-5 col-md-3 col-sm-3 col-xs-10">
        <a title="0 persons endorsed this skill" class="skill-tag tag">
              <span class="bold">10</span>
              Web Programming
        </a>
      </div>
      <div class="col-lg-5">
        <a href="">
          <i class="fa fa-caret-right fa-2x pull-right"></i>
        </a>
        @for($i=0;$i<9;$i++)
        <img class="pull-right" style="margin:0 2px;" src="{{ url('images/users/boto_simatupang.jpeg') }}" height="30px" />
        @endfor
      </div>
    </div>


    <div class="row">
      <div class="col-lg-5 col-md-3 col-sm-3 col-xs-10">
        <a title="0 persons endorsed this skill" class="skill-tag tag">
              <span class="bold">7</span>
              Web Design
        </a>
      </div>
      <div class="col-lg-5">
        <a href="">
          <i class="fa fa-caret-right fa-2x pull-right"></i>
        </a>
        @for($i=0;$i<7;$i++)
        <img class="pull-right" style="margin:0 2px;" src="{{ url('images/users/boto_simatupang.jpeg') }}" height="30px" />
        @endfor
      </div>
    </div>

    <div class="row">
      <div class="col-lg-5 col-md-3 col-sm-3 col-xs-10">
        <a title="0 persons endorsed this skill" class="skill-tag tag">
              <span class="bold">5</span>
              Scrum Project Management
        </a>
      </div>
      <div class="col-lg-5">
        <a href="">
          <i class="fa fa-caret-right fa-2x pull-right"></i>
        </a>
        @for($i=0;$i<5;$i++)
        <img class="pull-right" style="margin:0 2px;" src="{{ url('images/users/boto_simatupang.jpeg') }}" height="30px" />
        @endfor
      </div>
    </div>

    <div class="row">
      <div class="col-lg-5 col-md-3 col-sm-3 col-xs-10">
        <a title="0 persons endorsed this skill" class="skill-tag tag">
              <span class="bold">3</span>
              Agile PHP Development
        </a>
      </div>
      <div class="col-lg-5">
        <a href="">
          <i class="fa fa-caret-right fa-2x pull-right"></i>
        </a>
        @for($i=0;$i<3;$i++)
        <img class="pull-right" style="margin:0 2px;" src="{{ url('images/users/boto_simatupang.jpeg') }}" height="30px" />
        @endfor
      </div>
    </div>

-->

  </div>
</div>
