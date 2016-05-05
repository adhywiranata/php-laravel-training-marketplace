<div class="row">
  <div class="col-lg-12">
      <h4 class="text-center border-bottom"><span class="bold bigger-1-5" style="font-size:1em !important;">SEARCH</span></h4>
  </div>
  <form id="form-fg-1" class="fg-form padding-20 hack-entered-labels">

    <div class="col-xs-12 fg-input uppercase"
      data-type="radio"
      data-label="{{ trans('content.sf_role') }}"
      data-name="role"
      data-validation=""
      data-item-label="<?php echo implode(',',config('custom.list_role')); ?>"
      data-item-value="1,2,3"
      data-classes="form-control"
      data-current="">
    </div>

    <span>{{ trans('content.sf_keywords') }}<br/></span>

    <div id="sf_keywords_box" class="col-xs-12 form-control form-like-box" style="height:auto; overflow:hidden;">
      <div class="col-xs-12 fg-input"
        data-type="text"
        data-label=""
        data-name="sf_keywords"
        data-validation=""
        data-placeholder=""
        data-current=""
        data-classes="form-control form-invisible">
      </div>
      <i class="fa fa-search pull-right padding-10"></i>

      <div class="sf_keyword_assist">Click <b>Enter</b> to Add Keyword..</div>
    </div>


    <span class="text-grey">

      Search by Name, Skill, Participant Demography, Training Experience,
      Training Program, Work Experience

      <!--Search by
      name,
      skill,
      participant industry,
      participant job function,
      participant demography,
      training experience,
      program,
      work experience
    -->
      <br/><br/>
    </span>


    <div class="col-xs-12 fg-input"
      data-type="text"
      data-label="{{ trans('content.sf_budget') }}"
      data-name="budget"
      data-validation="numeric"
      data-placeholder="insert max budget"
      data-classes="form-control"
      data-current="">
    </div>

    <!--
    <div class="col-xs-12 fg-input"
      data-type="text-autocomplete"
      data-label="{{ trans('content.sf_skills') }}"
      data-name="title"
      data-validation=""
      data-placeholder="insert skills"
      data-current=""
      data-classes="form-control"
      data-items="<?php echo implode(',',config('custom.list_expertises')); ?>">
    </div>

  -->
    <!--
    <div class="col-xs-12 fg-input" data-type="combobox" data-label="{{ trans('content.sf_topic') }}" data-name="gender" data-validation="" data-item-label="-- Choose Topics Below --,<?php echo implode(',',config('custom.list_training_topics')); ?>" data-item-value="<?php echo implode(',',config('custom.list_training_topics')); ?>" data-current=""></div>
    -->

    <!--
    <div class="col-xs-12 fg-input"
      data-type="text-autocomplete"
      data-label="{{ trans('content.sf_program') }}"
      data-name="training_program"
      data-validation=""
      data-placeholder="insert training programme"
      data-items="<?php echo implode(',',config('custom.list_locations')); ?>"
      data-current=""
      data-classes="form-control"
      data-multiple="+ Add More Field">
    </div>
  -->
    <a class="trigger-collapse blue-back text-white padding-3-5" data-trigger-collapse="advanced_filter">
        <i class="fa fa-caret-down"></i> More Filters
    </a>

    <br/><br/>
    <div class="collapsible-content" data-collapse="advanced_filter">

      <div class="col-xs-12 fg-input"
        data-type="text-autocomplete"
        data-label="{{ trans('content.sf_location') }}"
        data-name="location"
        data-validation=""
        data-placeholder="insert speaker location"
        data-items="<?php echo implode(',',config('custom.list_locations')); ?>"
        data-classes="form-control"
        data-current="">
      </div>

      <div class="col-xs-12 fg-input"
        data-type="combobox"
        data-label="{{ trans('content.sf_method') }}"
        data-name="method"
        data-validation=""
        data-item-label="-- Choose Methods Below --,<?php echo implode(',',config('custom.list_training_methods')); ?>"
        data-item-value=" ,<?php echo implode(',',config('custom.list_training_methods')); ?>"
        data-current=""
        data-classes="form-control"
        data-multiple="+ Add More Field">
      </div>

      <div class="col-xs-12 fg-input"
        data-type="combobox"
        data-label="{{ trans('content.sf_style') }}"
        data-name="style"
        data-validation=""
        data-item-label="-- Choose Styles Below --,<?php echo implode(',',config('custom.list_training_styles')); ?>"
        data-item-value=" ,<?php echo implode(',',config('custom.list_training_styles')); ?>"
        data-current=""
        data-classes="form-control"
        data-multiple="+ Add More Field">
      </div>

      <div class="col-xs-12 fg-input"
        data-type="checkbox"
        data-label="{{ trans('content.sf_must_have') }}"
        data-name="must_have"
        data-validation=""
        data-item-label="<?php echo implode(',',config('custom.list_must_have')); ?>"
        data-item-value="<?php echo implode(',',config('custom.list_must_have')); ?>"
        data-classes="form-control"
        data-current="">
      </div>

      <div class="col-xs-12 fg-input"
        data-type="date"
        data-label="{{ trans('content.sf_start_date') }}"
        data-name="start_date"
        data-validation=""
        data-classes="form-control"
        data-current="">
      </div>

      <div class="col-xs-12 fg-input"
        data-type="date"
        data-label="{{ trans('content.sf_end_date') }}"
        data-name="end_date"
        data-validation=""
        data-classes="form-control"
        data-current="">
      </div>
    </div> <!-- end of collapsible content -->

    <div class="col-lg-12">
      <a href="#" class="btn btn-submit">
        <span class="fa fa-search"></span>
        <b>SEARCH</b>
      </a>
      <br/><br/>
      <span>If you are confused to look for the right training,click:</span>
      <a href="{{ url('training-needs-analysis') }}">
        <span>Training Needs Analysis</span>
      </a>
    </div>
  </form>
  <div class="col-lg-12">
    <br/>
    <!--<a href="#">Looking for Public Training?</a>-->
  </div>
</div>
