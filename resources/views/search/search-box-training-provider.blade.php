<div class="row">
  <div class="col-lg-12">
      <h5 class="text-center border-bottom">Search for <span class="bold">TRAINING PROVIDERS</span></h5>
  </div>
  <form id="form-fg-1" class="fg-form">
    <div class="col-xs-12 fg-input" data-type="text-autocomplete" data-label="Keywords" data-name="title" data-validation="" data-placeholder="insert keywords" data-current="" data-items="<?php echo implode(',',config('custom.list_expertises')); ?>"></div>
    <div class="col-xs-12 fg-input" data-type="combobox" data-label="Training Topic" data-name="gender" data-validation="" data-item-label="-- Choose Topics Below --,<?php echo implode(',',config('custom.list_training_topics')); ?>" data-item-value="<?php echo implode(',',config('custom.list_training_topics')); ?>" data-current=""></div>
    <div class="col-xs-12 fg-input" data-type="text-autocomplete" data-label="Location" data-name="training_provider" data-validation="alpha" data-placeholder="insert training provider location" data-items="<?php echo implode(',',config('custom.list_locations')); ?>" data-current=""></div>
    <div class="col-xs-12 fg-input" data-type="text" data-label="Max Budget" data-name="title" data-validation="numeric" data-placeholder="insert training title" data-current=""></div>
    <div class="col-xs-12 fg-input" data-type="text" data-label="Method" data-name="title" data-validation="" data-placeholder="insert training provider method" data-current=""></div>
    <div class="col-xs-12 fg-input" data-type="text" data-label="Style" data-name="title" data-validation="" data-placeholder="insert training provider style" data-current=""></div>

    <div class="col-lg-12">
      <a href="#" class="btn">
        <span class="fa fa-search"></span>
        <b>SEARCH</b>
      </a>

      <br/><br/>
      <a href="#"><span class="trigger-popup trigger-request-trainer">Advanced Search</span></a>

    </div>


  </form>
  <div class="col-lg-12">
    <br/>
    <!--<a href="#">Looking for Public Training?</a>-->
  </div>
</div>
