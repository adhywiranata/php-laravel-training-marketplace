@extends('main-app')

@section('title', 'Training Needs Analysis | SPEAQUS')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <form action="{{ url() }}" method="GET">

          <!-- STEP 0 -->
          <div class="tna-section first-section text-center" id="search-wizard-step-0">
            <br/><br/><br/><br/>
            <h3><span class="lnr lnr-magnifier bigger-1-5 blue-border circle text-blue" style="padding:15px;"></span></h3>
            <br/>
            <h1 class="roboto-light text-blue">TRAINING NEEDS ANALYSIS</h1>
            <h3 class="roboto-light text-blue">What do you want to search?</h3>
            <br/>

            <button type="button" class="btn btn-default tna-option">Customize Training</button> &nbsp;
            <button type="button" class="btn btn-default tna-option" onclick="goToSearchWizard('1')">Public Training</button>
          </div>


          <!-- STEP 1 -->
          <div class="tna-section text-center fg-form" id="search-wizard-step-1">
            <h3 class="roboto-light text-blue">Step 1 of 8<br/>What is Your Objective?</h3>
            <br/>

            <div class="row">
              <div class="col-md-8 col-md-offset-2">
                <div class="fg-input"
                  data-type="combobox"
                  data-name="gender"
                  data-validation=""
                  data-item-label="-- Choose Objective Category Below --,<?php echo implode(',',trans('custom.list_training_objectives_category')); ?>"
                  data-item-value="0,<?php echo implode(',',trans('custom.list_training_objectives_category')); ?>"
                  data-current=""
                  data-classes="form-control">
                </div>
              </div>
              <br/>

              <div class="col-md-12">
                <button type="button" class="btn btn-default" onclick="goToSearchWizard('0')">&lt;&lt; Prev</button>
                <button type="button" class="btn btn-default" onclick="goToSearchWizard('2')">Next &gt;&gt;</button>
              </div>
            </div>
          </div>


          <!-- STEP 2 -->
          <div class="tna-section text-center fg-form" id="search-wizard-step-2">
            <h3 class="roboto-light text-blue">Step 2 of 8<br/>What is Your Detailed Objective?</h3>
            <br/>

            <div class="row">
              <div class="col-md-8 col-md-offset-2">
                <div class="fg-input"
                  data-type="combobox"
                  data-name="gender"
                  data-validation=""
                  data-item-label="-- Choose Detailed Objective Below --,<?php echo implode(',',trans('custom.list_training_objectives')); ?>"
                  data-item-value="0,<?php echo implode(',',trans('custom.list_training_objectives')); ?>"
                  data-current=""
                  data-classes="form-control">
                </div>
              </div>
              <br/>

              <div class="col-md-12">
                <button type="button" class="btn btn-default" onclick="goToSearchWizard('1')">&lt;&lt; Prev</button>
                <button type="button" class="btn btn-default" onclick="goToSearchWizard('3')">Next &gt;&gt;</button>
              </div>
            </div>
          </div>


          <!-- STEP 3 -->
          <div class="tna-section text-center fg-form" id="search-wizard-step-3">
            <h3 class="roboto-light text-blue">Step 3 of 8<br/>What is Your Participant Job Function?</h3>
            <br/>

            <div class="row">
              <div class="col-md-8 col-md-offset-2">
                <div class="fg-input"
                  data-type="combobox"
                  data-name="gender"
                  data-validation=""
                  data-item-label="-- Choose Job Function Below --,<?php echo implode(',',trans('custom.list_job_functions')); ?>"
                  data-item-value="0,<?php echo implode(',',trans('custom.list_job_functions')); ?>"
                  data-current=""
                  data-classes="form-control">
                </div>
              </div>
              <br/>

              <div class="col-md-12">
                <button type="button" class="btn btn-default" onclick="goToSearchWizard('2')">&lt;&lt; Prev</button>
                <button type="button" class="btn btn-default" onclick="goToSearchWizard('4')">Next &gt;&gt;</button>
              </div>
            </div>
          </div>


          <!-- STEP 4 -->
          <div class="tna-section text-center fg-form" id="search-wizard-step-4">
            <h3 class="roboto-light text-blue">Step 4 of 8<br/>What is Your Participant Seniority Level?</h3>
            <br/>

            <div class="row">
              <div class="col-md-8 col-md-offset-2">
                <div class="fg-input"
                  data-type="combobox"
                  data-name="gender"
                  data-validation=""
                  data-item-label="-- Choose Seniority Level Below --,<?php echo implode(',',trans('custom.list_seniority_levels')); ?>"
                  data-item-value="0,<?php echo implode(',',trans('custom.list_seniority_levels')); ?>"
                  data-current=""
                  data-classes="form-control">
                </div>
              </div>
              <br/>

              <div class="col-md-12">
                <button type="button" class="btn btn-default" onclick="goToSearchWizard('3')">&lt;&lt; Prev</button>
                <button type="button" class="btn btn-default" onclick="goToSearchWizard('5')">Next &gt;&gt;</button>
              </div>
            </div>
          </div>


          <!-- STEP 5 -->
          <div class="tna-section text-center fg-form" id="search-wizard-step-5">
            <h3 class="roboto-light text-blue">Step 5 of 8<br/>What is Your Participant Industry Type?</h3>
            <br/>

            <div class="row">
              <div class="col-md-8 col-md-offset-2">
                <div class="fg-input"
                  data-type="combobox"
                  data-name="gender"
                  data-validation=""
                  data-item-label="-- Choose Industry Type Below --,<?php echo implode(',',trans('custom.list_industries')); ?>"
                  data-item-value="0,<?php echo implode(',',trans('custom.list_industries')); ?>"
                  data-current=""
                  data-classes="form-control">
                </div>
              </div>
              <br/>

              <div class="col-md-12">
                <button type="button" class="btn btn-default" onclick="goToSearchWizard('4')">&lt;&lt; Prev</button>
                <button type="button" class="btn btn-default" onclick="goToSearchWizard('6')">Next &gt;&gt;</button>
              </div>
            </div>
          </div>


          <!-- STEP 6 -->
          <div class="tna-section text-center fg-form" id="search-wizard-step-6">
            <h3 class="roboto-light text-blue">Step 6 of 8<br/>What is Your Prefered Outcome Competency?</h3>
            <br/>

            <div class="row">
              <div class="col-md-8 col-md-offset-2">
                <div class="fg-input"
                  data-type="combobox"
                  data-name="gender"
                  data-validation=""
                  data-item-label="-- Choose Prefered Outcome Competency Below --,<?php echo implode(',',trans('custom.list_competency_preference')); ?>"
                  data-item-value="0,<?php echo implode(',',trans('custom.list_competency_preference')); ?>"
                  data-current=""
                  data-classes="form-control">
                </div>
              </div>
              <br/>

              <div class="col-md-12">
                <button type="button" class="btn btn-default" onclick="goToSearchWizard('5')">&lt;&lt; Prev</button>
                <button type="button" class="btn btn-default" onclick="goToSearchWizard('7')">Next &gt;&gt;</button>
              </div>
            </div>
          </div>


          <!-- STEP 7 -->
          <div class="tna-section no-padding text-center fg-form" id="search-wizard-step-7">
            <h3 class="roboto-light text-blue">Step 7 of 8<br/>You can select more than one related skills and training programs</h3>
            <br/>

            <div class="row">
              <div class="col-md-8 col-md-offset-2">
                <div class="fg-input"
                  data-type="combobox"
                  data-name="gender"
                  data-validation=""
                  data-item-label="-- Choose Related Skills and Training Programs --,<?php echo implode(',',trans('custom.list_industries')); ?>"
                  data-item-value="0,<?php echo implode(',',trans('custom.list_industries')); ?>"
                  data-current=""
                  data-classes="form-control"
                  data-multiple="+ Add More Field">
                </div>
                <br/>
              </div>

              <div class="col-md-12">
                <button type="button" class="btn btn-default" onclick="goToSearchWizard('6')">&lt;&lt; Prev</button>
                <button type="button" class="btn btn-default" onclick="goToSearchWizard('8')">Next &gt;&gt;</button>
              </div>
            </div>
          </div>


          <!-- STEP 8 -->
          <div class="tna-section text-center fg-form" id="search-wizard-step-8">
            <h3 class="roboto-light text-blue">Step 8 of 8<br/>Do you need Certification for your Training?</h3>
            <br/>

            <div class="row">
              <div class="col-md-8 col-md-offset-2">
                <div class="fg-input"
                  data-type="combobox"
                  data-name="gender"
                  data-validation=""
                  data-item-label="Yes, No"
                  data-item-value="Yes, No"
                  data-current=""
                  data-classes="form-control">
                </div>
                <br/>
              </div>

              <div class="col-md-12">
                <button type="button" class="btn btn-default" onclick="goToSearchWizard('7')">&lt;&lt; Prev</button>
                <button type="submit" class="btn btn-default"><i class="lnr lnr-magnifier"></i> Search</button>
              </div>
            </div>
          </div>

        </form>

      </div>
    </div>
  </div>

  <script>
    document.getElementsByTagName("BODY")[0].style.overflow = "hidden";
  </script>
@stop