<div class="col-lg-12 profile-section" data-section="programs">
  <?php $user_id = (isset(Auth::user()->user_id))?Auth::user()->user_id:''; ?>
  @if($grids->user_id == $user_id)
  <a href="{{ url('dashboard/program/add') }}" class="btn">
    <i class="fa fa-plus"></i>
    Add New Training Program
  </a>
  @endif
  <!--for($i=0;$i<2;$i++)-->
  <?php $flag = 1 ?>
  @foreach($trainingProgrammes as $trainingProgramme)

  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="row experience-grid">
      <div class="col-lg-12 col-md-10 col-sm-10 col-xs-10">

        <a href="" class="title">{{$trainingProgramme->training_programme_title}}</a>
        <!--<a href="" class="title">Marketing in Entrepreneurship</a>-->
        <!--
        <a href="#" class="btn btn-margin red-back pull-right">Delete</a>
        <a href="#" class="btn btn-margin green-back pull-right">Edit</a>
      -->
        <p class="description">
        <?php echo $trainingProgramme->training_programme_description; ?>
        <!--
        <?php if($flag % 2 == 0){ ?>
          1. the history and basis of NLP (Neuro-Linguistic Programming)<br/>
          2. how we perceive the world and why that affects our results<br/>
          3. how to create and maintain genuine rapport<br/>
        <?php }else if ($flag % 3 == 0){?>
          1. understand and utilise body language in communication</br>
          2. skills in observing other people</br>
          3. how to create positive change in yourself and others<br/>
          4. the conscious use of language<br/>
          5. increase your influence<br/>
        <?php }else{?>
          1. how to set effective value-driven goals both personally and professionally<br/>
          2. how to adapt to different thinking and learning styles, and experience different perspectives<br/>
          3. enhance your self confidence<br/>
          4. create and manage your own emotional states to gain high performance<br/>
          <?php } ?>
        -->

        </p>

        <!--
        <p class="description">
          Trained 50 future leaders from Smartlearn University
          to teach them the way to be a successful entrepreneur.
          Each participants learned from how to build a business
          by bootstrapping, using their own pocket money, and show
          them that a good business is not from the initial funding,
          but it is all about the business idea and brilliant strategies.
        </p>
        -->
      </div>
    </div>
  </div>
  <?php $flag++; ?>
  @endforeach
  <!--endfor-->
</div>
