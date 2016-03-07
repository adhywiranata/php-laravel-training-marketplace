<div class="col-lg-12 profile-section" data-section="skills">
  <?php $user_id = (isset(Auth::user()->user_id))?Auth::user()->user_id:''; ?>
  @if($grids->user_id == $user_id)
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

  </div>
</div>
