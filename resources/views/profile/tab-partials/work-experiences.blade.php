<div class="col-lg-12 profile-section" data-section="work-experiences">
  <?php $user_id = (isset(Auth::user()->user_id))?Auth::user()->user_id:''; ?>
  @if($grids->user_id == $user_id)
  <a href="{{ url('dashboard/work-experience/add') }}" class="btn">
    <i class="fa fa-plus"></i>
    Add New Work Experience
  </a>
  @endif
  <!--for($i=0;$i<2;$i++)-->
  @foreach($workExperiences as $workExperience)
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="row experience-grid">
      <!--
      <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 image-holder">
        <img src="{{ url('images/groups/astra.jpg') }}" width="100%"/>
      </div>
      -->
      <!--<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">-->
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <a href="" class="title">{{$workExperience->title}}</a>
        <!--<a href="" class="title">Marketing Manager</a>-->
        <!--
        <a href="#" class="btn btn-margin red-back pull-right">Delete</a>
        <a href="#" class="btn btn-margin green-back pull-right">Edit</a>
      -->
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

        <!--
        <div class="row">
          <div class="col-lg-12">
            <a class="skill-tag tag" title="10 persons endorsed this skill">Entrepreneurship <span class="bold">10</span></a>
            <a class="skill-tag tag" title="10 persons endorsed this skill">Business <span class="bold">10</span></a>
            <a class="skill-tag tag" title="10 persons endorsed this skill">Leadership <span class="bold">10</span></a>
            <a class="skill-tag tag" title="10 persons endorsed this skill">Key Performance Indicator <span class="bold">10</span></a>
          </div>
        </div>
        -->
      </div>
    </div>
  </div>
  @endforeach
  <!--endfor-->
</div>
