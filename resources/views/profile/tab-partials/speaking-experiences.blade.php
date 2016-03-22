<div class="col-lg-12 profile-section" data-section="training-experiences">
  <?php $user_id = (isset(Auth::user()->id))?Auth::user()->id:''; ?>
  @if($grids->user_id == $user_id)
  <a href="{{ url('dashboard/training-experience/add') }}" class="btn">
    <i class="fa fa-plus"></i>
    Add New Training Experience
  </a>
  @endif
  @foreach($trainingExperiences as $trainingExperience)
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="row experience-grid">

      <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">

        <a href="" class="title">
          {{$trainingExperience->speaking_experience_title}}
        </a>

        <p class="description">
          {{$trainingExperience->training_programme_title}}
          <br/>
          <a href="#">{{$trainingExperience->company_name}}</a>
          <br/>
          Jakarta
          @if($trainingExperience->speaking_experience_start_date != '0000-00-00')
          , {{ date("F jS Y",strtotime($trainingExperience->speaking_experience_start_date)) }}
          @endif
        </p>

        <p class="description">
          {{ $trainingExperience->speaking_experience_description }}
        </p>

        <div class="row">
          <a href="{{url('/dashboard/training-experience/'. $trainingExperience->speaking_experience_id . '/edit') }}" class="btn btn-margin green-back pull-left">Edit</a>
          <form class="pull-left" action="{{url('/dashboard/training-experience/'.$trainingExperience->speaking_experience_id )}}" method="post">
            <input type="hidden" name="_method" value="DELETE" />
            <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
            <button type="submit" class="btn btn-margin red-back pull-right">Delete</button>
          </form>

        </div>
        <div class="row">
          <div class="col-lg-12">
            @if(count($trainingExperience->speaking_experience_expertises) != 0)
            <span class="bold">Related Skills: <span><br/>
            @endif

            @foreach($trainingExperience->speaking_experience_expertises as $speaking_experience_expertise)
              <a class="skill-tag tag" >{{$speaking_experience_expertise->expertise_name}}</a>
            @endforeach

            @if(count($trainingExperience->speaking_experience_photos) != 0)
            <br/>
            <span class="bold">Photos: <span><br/>
            @endif

            @foreach($trainingExperience->speaking_experience_photos as $speaking_experience_photo)
              <img src="{{ url('images/section_photos/'.$speaking_experience_photo->photo_path) }}" height="50px">
            @endforeach
          </div>
        </div>

      </div>
      <div class="col-lg-2 col-md-2">
        <img src="{{ url('images/corporates/'.$trainingExperience->company_profile_picture) }}" width="80%"/>
      </div>
    </div>
  </div>
  @endforeach
</div>
