<div class="col-lg-12 profile-section" data-section="awards">

  @if($is_admin == 1)
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

        @if($is_admin == 1)
          <form action="{{url('/dashboard/award/'.$award->award_id .'/delete')}}" method="post">
            <input type="hidden" name="_method" value="DELETE" />
            <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
            <button type="submit" class="btn btn-margin red-back pull-right">Delete</button>
          </form>

          <a href="{{url('/dashboard/award/'. $award->award_id . '/edit') }}" class="btn btn-margin green-back pull-right">Edit</a>
        @endif
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

            @if(count($award->award_photos) != 0)
            <br/>
            <span class="bold">Photos: <span><br/>
            @endif

            @foreach($award->award_photos as $award_photo)
              <img src="{{ url('images/section_photos/'.$award_photo->photo_path) }}" height="50px">
            @endforeach

          </div>
        </div>

      </div>
    </div>
  </div>
  @endforeach
  <!--endfor-->
</div>
