<div class="col-lg-12 profile-section" data-section="awards">
  <?php $user_id = (isset(Auth::user()->user_id))?Auth::user()->user_id:''; ?>
  @if($grids->user_id == $user_id)
  <a href="{{ url('dashboard/award/add') }}" class="btn">
    <i class="fa fa-plus"></i>
    Add New Award
  </a>
  @endif
  <!--for($i=0;$i<2;$i++)-->
  @foreach($awards as $award)
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="row experience-grid">
      <div class="col-lg-12 col-md-10 col-sm-10 col-xs-10">
        <a href="" class="title">{{$award->award_title}}</a>
        <!--<a href="" class="title">Best Smartlearn Trainer 2016</a>-->
        <br/>
        <a href="">{{$award->award_publisher_name}}</a>
        <!--
        <a href="#" class="btn btn-margin red-back pull-right">Delete</a>
        <a href="#" class="btn btn-margin green-back pull-right">Edit</a>
      -->
        <p>{{ date("F jS Y",strtotime($award->award_date)) }}</p>

        <p class="description">
          {{$award->award_description}}
          <!--Award for the most performing trainer in Smartlearn for the 2016 period-->
        </p>

        <div class="row">
          <div class="col-lg-12">
            <span class="bold">Related Skills: <span><br/>
            @foreach($award->award_expertises as $award_expertise)
              <a class="skill-tag tag" >{{$award_expertise->expertise_name}} </a>
            @endforeach
            <!--
            <a class="skill-tag tag" title="10 persons endorsed this skill">Entrepreneurship <span class="bold">10</span></a>
            <a class="skill-tag tag" title="10 persons endorsed this skill">Business <span class="bold">10</span></a>
            <a class="skill-tag tag" title="10 persons endorsed this skill">Leadership <span class="bold">10</span></a>
            <a class="skill-tag tag" title="10 persons endorsed this skill">Key Performance Indicator <span class="bold">10</span></a>
            -->
          </div>
        </div>

      </div>
    </div>
  </div>
  @endforeach
  <!--endfor-->
</div>
