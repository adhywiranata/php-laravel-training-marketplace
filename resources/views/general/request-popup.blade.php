<div class="popup request-popup row" style="display:none">
  <a href="" class="popup-close text-black"><span class="lnr lnr-cross"></span></a>
  <div class="col-lg-12 col-sm-12 sign-form-col request-section-wrapper" data-section="1">
    <div class="row border-bottom">
      <h4 class="uppercase">Find Which Training Providers do You Need</h4>
    </div>

    <!-- Step 1 -->
    <div class="scrollable request-section request-section-1" style="overflow-y:auto !important; height:300px !important;">
      <div class="row">
        <h3><span class="lnr lnr-magnifier bigger-1-5 blue-border circle text-blue" style="padding:15px;"></span></h3>
        <br/>
        <h5>1 of 5 : Which Industry Do you Want the Trainer to Be Excel at?</h5>
      </div>
      <div class="row">
        <div class="col-lg-12 industry-list">
          <?php $industries = config('custom.list_industries'); ?>
          @foreach($industries as $industry)
          <label class="btn light-grey-back check-btn text-grey" data-checked="0"><i class="fa fa-circle-o bigger-1-5"></i> {{ $industry }}</label>
          @endforeach
        </div>
      </div>
      <br/><br/>
    </div>
    <!-- end of Step 1 -->

    <!-- Step 2 -->
    <div class="scrollable request-section request-section-2" style="display:none; overflow-y:auto !important; height:300px !important;">
      <div class="row">
        <h3><span class="lnr lnr-flag bigger-1-5 blue-border circle text-blue" style="padding:15px;"></span></h3>
        <br/>
        <h4>2 of 5 : What are the Categories that the Trainers Excel at ?</h4>
      </div>
      <div class="row">
        <div class="col-lg-12 industry-list">
          <?php $topics = config('custom.list_training_topics'); ?>
          @foreach($topics as $topic)
          <label class="btn light-grey-back check-btn text-grey" data-checked="0"><i class="fa fa-circle-o bigger-1-5"></i> {{ $topic }}</label>
          @endforeach
        </div>
      </div>
      <br/><br/>
    </div>
    <!-- end of Step 2 -->

    <!-- Step 3 -->
    <div class="scrollable request-section request-section-3" style="display:none; overflow-y:auto !important; height:300px !important;">
      <div class="row">
        <h3><span class="lnr lnr-tag bigger-1-5 blue-border circle text-blue" style="padding:15px;"></span></h3>
        <br/>
        <h4>3 of 5 : What are the Competencies of the Trainers that You Seek ?</h4>
      </div>
      <div class="row">
        <div class="col-lg-12 industry-list">
          <?php $expertises = config('custom.list_expertises'); ?>
          @foreach($expertises as $expertise)
          <label class="btn light-grey-back check-btn text-grey" data-checked="0"><i class="fa fa-circle-o bigger-1-5"></i> {{ $expertise }}</label>
          @endforeach
        </div>
      </div>
      <br/><br/>
    </div>
    <!-- end of Step 3 -->

    <!-- Step 4 -->
    <div class="scrollable request-section request-section-4" style="display:none; overflow-y:auto !important; height:300px !important;">
      <div class="row">
        <h3><span class="lnr lnr-pushpin bigger-1-5 blue-border circle text-blue" style="padding:15px;"></span></h3>
        <br/>
        <h4>4 of 5 : Which Job Function do You Need the Trainer to Specialize at ?</h4>
      </div>
      <div class="row">
        <div class="col-lg-12 industry-list">
          <?php $job_functions = config('custom.list_job_functions'); ?>
          @foreach($job_functions as $job_function)
          <label class="btn light-grey-back check-btn text-grey" data-checked="0"><i class="fa fa-circle-o bigger-1-5"></i> {{ $job_function }}</label>
          @endforeach
        </div>
      </div>
      <br/><br/>
    </div>
    <!-- end of Step 5 -->

    <!-- Step 5 -->
    <div class="scrollable request-section request-section-5" style="display:none; overflow-y:auto !important; height:300px !important;">
      <div class="row">
        <h3><span class="lnr lnr-eye bigger-1-5 blue-border circle text-blue" style="padding:15px;"></span></h3>
        <br/>
        <h4>5 of 5 : What is the level of the Audience ?</h4>
      </div>
      <div class="row">
        <div class="col-lg-12 industry-list">
          <?php $seniority_levels = config('custom.list_seniority_levels'); ?>
          @foreach($seniority_levels as $seniority_level)
          <label class="btn light-grey-back check-btn text-grey" data-checked="0"><i class="fa fa-circle-o bigger-1-5"></i> {{ $seniority_level }}</label>
          @endforeach
        </div>
      </div>
      <br/><br/>
    </div>
    <!-- end of Step 5 -->

    <!-- Step finish -->
    <div class="scrollable request-section request-section-last" style="display:none; overflow-y:auto !important; height:300px !important;">
      <br/><br/>
      <div class="row">
        <h3><i class="fa fa-circle-o-notch fa-spin circle blue-border text-blue fa-3x" style="padding:15px !important;"></i></h3>
        <br/>
        <h5 class="text-blue">Please Wait.. We'll get you the best trainer according to your need...</h5>
      </div>
      <br/><br/>
    </div>
    <!-- end of Step 5 -->

    <div class="row border-top">
      <a href="#" class="btn big-btn light-grey-back text-grey bold request-section-trigger request-section-prev" style="display:none;">
        <i class="fa fa-angle-left bigger-1-5"></i> PREV
      </a>
      <a href="#" class="btn big-btn bold request-section-trigger request-section-next">
        <i class="fa fa-angle-right bigger-1-5"></i> NEXT
      </a>
      <a href="#" class="btn big-btn green-back bold request-section-trigger request-section-finish" style="display:none;">
        <i class="fa fa-angle-right bigger-1-5"></i> FINISH
      </a>
    </div>
  </div>
</div>
