<div class="col-lg-12 profile-section" data-section="work-experiences">
  @if($is_admin == 1)
  <a href="{{ url('dashboard/work-experience/add') }}" class="btn">
    <i class="fa fa-plus"></i>
    Add New Work Experience
  </a>
  @endif
  @foreach($workExperiences as $workExperience)
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="row experience-grid">
      <!--
      <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 image-holder">
        <img src="{{ url('images/groups/astra.jpg') }}" width="100%"/>
      </div>
      -->
      <!--<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">-->
      <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
        <a href="" class="title">{{$workExperience->title}}</a>
        <!--<a href="" class="title">Marketing Manager</a>-->

        @if($is_admin == 1)
        <form action="{{url('/dashboard/work-experience/'.$workExperience->work_experience_id .'/delete')}}" method="post">
          <input type="hidden" name="_method" value="DELETE" />
          <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
          <button type="submit" class="btn btn-margin red-back pull-right">Delete</button>
        </form>

        <a href="{{url('/dashboard/work-experience/'. $workExperience->work_experience_id . '/edit') }}" class="btn btn-margin green-back pull-right">Edit</a>
        @endif

        <br/>
        <a href="#">{{ $workExperience->corporate_name }}</a>
        <p>{{ date("F jS Y",strtotime($workExperience->start_date)) }} - {{ date("F jS Y",strtotime($workExperience->end_date)) }}</p>
        <!--<p>May 23th 2015 - May 23th 2016 (1 year)</p>-->

        <p class="description">
          {{ $workExperience->description }}
          <!--Trained 50 future leaders from Smartlearn University
          to teach them the way to be a successful entrepreneur.
          Each participants learned from how to build a business
          by bootstrapping, using their own pocket money, and show
          them that a good business is not from the initial funding,
          but it is all about the business idea and brilliant strategies.-->
        </p>
      </div>
      <div class="col-lg-2 col-md-2">
        <img src="{{ url('images/corporates/'.$workExperience->corporate_profile_picture) }}" width="80%"/>
      </div>
    </div>
  </div>
  @endforeach
</div>
