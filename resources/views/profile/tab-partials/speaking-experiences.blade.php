<div class="col-lg-12 profile-section" data-section="speaking-experiences">
  <?php $user_id = (isset(Auth::user()->id))?Auth::user()->id:''; ?>
  @if($grids->user_id == $user_id)
  <a href="{{ url('dashboard/training-experience/add') }}" class="btn">
    <i class="fa fa-plus"></i>
    Add New Training Experience
  </a>
  @endif
  <!--for($i=0;$i<7;$i++) -->
  @foreach($trainingExperiences as $trainingExperience)
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="row experience-grid">
      <!--
      <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 image-holder">
        <img src="{{ url('images/groups/astra.jpg') }}" width="100%"/>
      </div>
      <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
      -->

      <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
        <!--<a href="" class="title">Business Coaching for Young Entrepreneurs</a>-->
        <a href="" class="title">
          {{$trainingExperience->speaking_experience_title}}
        </a>


        <form action="{{url('/dashboard/training-experience/'.$trainingExperience->speaking_experience_id .'/delete')}}" method="post">
          <input type="hidden" name="_method" value="DELETE" />
          <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
          <button type="submit" class="btn btn-margin red-back pull-right">Delete</button>
        </form>

        <a href="{{url('/dashboard/training-experience/'. $trainingExperience->speaking_experience_id . '/edit') }}" class="btn btn-margin green-back pull-right">Edit</a>

        <br/>
        <a href="#">{{$trainingExperience->company_name}}</a>
        <p>Jakarta, {{ date("F jS Y",strtotime($trainingExperience->speaking_experience_start_date)) }}</p>
        <!--<p>Jakarta, May 23th 2015 at Great Place Hotel</p>-->

        <p class="description">
          {{ $trainingExperience->speaking_experience_description }}
          <!--Trained 50 future leaders from Smartlearn University
          to teach them the way to be a successful entrepreneur.
          Each participants learned from how to build a business
          by bootstrapping, using their own pocket money, and show
          them that a good business is not from the initial funding,
          but it is all about the business idea and brilliant strategies.-->
        </p>

        <div class="row">
          <div class="col-lg-12">
            @if(count($trainingExperience->speaking_experience_expertises) != 0)
            <span class="bold">Related Skills: <span><br/>
            @endif

            @foreach($trainingExperience->speaking_experience_expertises as $speaking_experience_expertise)
              <a class="skill-tag tag" >{{$speaking_experience_expertise->expertise_name}}</a>
            @endforeach

            @if(count($trainingExperience->speaking_experience_photos) != 0)
            <span class="bold">Photos: <span><br/>
            @endif

            @foreach($trainingExperience->speaking_experience_photos as $speaking_experience_photo)
              <img src="{{ url('images/section_photos/'.$speaking_experience_photo->photo_path) }}" height="50px">
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
      <div class="col-lg-2 col-md-2">
        <img src="{{ url('images/corporates/'.$trainingExperience->company_profile_picture) }}" width="80%"/>
      </div>
    </div>
  </div>
  @endforeach
  <!--endfor-->
</div>
