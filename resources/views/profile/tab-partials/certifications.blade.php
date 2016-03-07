<div class="col-lg-12 profile-section" data-section="certifications">
  <?php $user_id = (isset(Auth::user()->user_id))?Auth::user()->user_id:''; ?>
  @if($grids->user_id == $user_id)
  <a href="{{ url('dashboard/certification/add') }}" class="btn">
    <i class="fa fa-plus"></i>
    Add New Certication
  </a>
  @endif
  <!--for($i=0;$i<2;$i++)-->
  @foreach($certifications as $certification)
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="row experience-grid">
      <div class="col-lg-12 col-md-10 col-sm-10 col-xs-10">
        <a href="" class="title">{{$certification->certification_title}}</a>
        <!--<a href="" class="title">Cisco Certified Network Associate (CCNA)</a>-->
        <br/>
        <a href="">{{$certification->certification_publisher_name}}</a>

        <!--
        <a href="#" class="btn btn-margin red-back pull-right">Delete</a>
        <a href="#" class="btn btn-margin green-back pull-right">Edit</a>
      -->
        <p>{{ date("F jS Y",strtotime($certification->certification_date)) }}</p>
        <p class="description">
          {{$certification->certification_description}}
          <!--Certification for Cisco Certified Network Associate (CCNA)-->
        </p>

        <div class="row">
          <div class="col-lg-12">
            <span class="bold">Related Skills: <span><br/>
            @foreach($certification->certification_expertises as $certification_expertise)
              <a class="skill-tag tag" >{{$certification_expertise->expertise_name}} </a>
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
