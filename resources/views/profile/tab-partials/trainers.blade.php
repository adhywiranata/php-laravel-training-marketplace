<div class="col-lg-12 profile-section" data-section="trainers">
  <!--<a href="" class="btn">
    <i class="fa fa-plus"></i>
    Add New Trainer
  </a>-->
  <!--for($i=0;$i<2;$i++)-->
  @foreach($trainers as $trainer)
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="row experience-grid">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <span>{{$trainer->initial_name}}</span>
        <a href="" class="title"><!--B. S--></a>
        <!--
        <a href="#" class="btn btn-margin red-back pull-right">Delete</a>
        <a href="#" class="btn btn-margin green-back pull-right">Edit</a>
      -->

        <p class="description">
          <!--{{$trainer->summary}}-->
          <!--Certificate Trainer-->
        </p>

        <div class="row">
          <div class="col-lg-12">
            @foreach($trainer->expertises as $expertise)
              <a class="skill-tag tag" >{{$expertise->expertise_name}} </a>
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
