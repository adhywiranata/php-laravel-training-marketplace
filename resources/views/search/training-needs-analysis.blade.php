@extends('main-app')

@section('title', 'Training Needs Analysis | SPEAQUS')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <form action="" method="GET">

          <!-- STEP 0 -->
          <div class="tna-section first-section text-center" id="search-wizard-step-0">
            <br/><br/><br/><br/>
            <h3><span class="lnr lnr-magnifier bigger-1-5 blue-border circle text-blue" style="padding:15px;"></span></h3>
            <br/>
            <h1 class="roboto-light text-blue">TRAINING NEEDS ANALYSIS</h1>
            <h3 class="roboto-light text-blue">What do you want to search?</h3>
            <br/>

            <input type="hidden" name="type">

            <div id="customize-training-button" hidden>
              <button type="button" class="btn btn-default tna-option">Customize Training</button> &nbsp;
              <button type="button" class="btn btn-default tna-option" onclick="goToSearchWizard('1', 'Public Training')">Public Training</button>
            </div>

            <div id="customize-training-option">
              <button type="button" class="btn btn-default tna-option" onclick="goToSearchWizard('1', 'Freelance Trainer')">Freelance Trainer</button> &nbsp;
              <button type="button" class="btn btn-default tna-option" onclick="goToSearchWizard('1', 'Training Provider')">Training Provider</button>
            </div>
          </div>


          <!-- STEP 1 -->
          <div class="tna-section text-center fg-form" id="search-wizard-step-1">
            <h3 class="roboto-light text-blue">Step 1 of 8<br/>What is Your Objective?</h3>
            <br/>

            <div class="row">
              <div class="col-md-8 col-md-offset-2">
                @foreach($data['training-objective'] as $row)
                  <button type="button" class="btn btn-default tna-option" style="width: auto;" onclick="goToSearchWizard('2', '{{ $row->id }}')">{{ $row->training_objective }}</button> &nbsp;
                @endforeach
              </div>
              <br/>

              <!-- <div class="col-md-12">
                <button type="button" class="btn btn-default" onclick="goToSearchWizard('1')">&lt;&lt; Prev</button>
                <button type="button" class="btn btn-default" onclick="goToSearchWizard('2')">Next &gt;&gt;</button>
              </div> -->
            </div>
          </div>


          <!-- STEP 2 -->
          <div class="tna-section text-center fg-form" id="search-wizard-step-2">
            <h3 class="roboto-light text-blue">Step 2 of 8<br/>What is Your Objective's detail?</h3>
            <br/>

            <div class="row">

              <div class="col-md-8 col-md-offset-2">
                <div class="fg-input"
                  data-type="text-autocomplete"
                  data-name="sub_objectives"
                  data-validation=""
                  data-placeholder="Insert Your Objective's detail"
                  data-current=""
                  data-items=""
                  data-classes="form-control"
                  data-multiple-chip="Add More Objective's detail">
                </div>
              </div>

              <div class="col-md-12">
                <br/>
                <button type="button" class="btn btn-default" onclick="goToSearchWizard('1')">
                  <span class="lnr lnr-chevron-left-circle"></span> Prev
                </button>
                <button type="button" class="btn btn-default" onclick="goToSearchWizard('3', 'next')">
                  Next <span class="lnr lnr-chevron-right-circle"></span>
                </button>
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
                  data-type="text-autocomplete"
                  data-name="job_functions"
                  data-validation=""
                  data-placeholder="Insert Your Job Functions"
                  data-current=""
                  data-items=""
                  data-classes="form-control"
                  data-multiple-chip="Add More Job Function">
                </div>
              </div>
              <br/>

              <div class="col-md-12">
                <br/>
                <button type="button" class="btn btn-default" onclick="goToSearchWizard('2')">
                  <span class="lnr lnr-chevron-left-circle"></span> Prev
                </button>
                <button type="button" class="btn btn-default" onclick="goToSearchWizard('4', 'next')">
                  Next <span class="lnr lnr-chevron-right-circle"></span>
                </button>
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
                  data-type="text-autocomplete"
                  data-name="seniority_levels"
                  data-validation=""
                  data-placeholder="Insert participant Seniority Level"
                  data-current=""
                  data-items=""
                  data-classes="form-control"
                  data-multiple-chip="Add More Seniority Level">
                </div>
              </div>
              <br/>

              <div class="col-md-12">
                <br/>
                <button type="button" class="btn btn-default" onclick="goToSearchWizard('3')">
                  <span class="lnr lnr-chevron-left-circle"></span> Prev
                </button>
                <button type="button" class="btn btn-default" onclick="goToSearchWizard('5', 'next')">
                  Next <span class="lnr lnr-chevron-right-circle"></span>
                </button>
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
                  data-type="text-autocomplete"
                  data-name="seniority_levels"
                  data-validation=""
                  data-placeholder="Insert participant Industry Type"
                  data-current=""
                  data-items=""
                  data-classes="form-control"
                  data-multiple-chip="Add More Industry Type">
                </div>
              </div>
              <br/>

              <div class="col-md-12">
                <br/>
                <button type="button" class="btn btn-default" onclick="goToSearchWizard('4')">
                  <span class="lnr lnr-chevron-left-circle"></span> Prev
                </button>
                <button type="button" class="btn btn-default" onclick="goToSearchWizard('6', 'next')">
                  Next <span class="lnr lnr-chevron-right-circle"></span>
                </button>
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
                  data-classes="form-control"
                  data-multiple="+ Add More Outcome Competency">
                </div>
              </div>
              <br/>

              <div class="col-md-12">
                <br/>
                <button type="button" class="btn btn-default" onclick="goToSearchWizard('5')">
                  <span class="lnr lnr-chevron-left-circle"></span> Prev
                </button>
                <button type="button" class="btn btn-default" onclick="goToSearchWizard('7', 'next')">
                  Next <span class="lnr lnr-chevron-right-circle"></span>
                </button>
              </div>
            </div>
          </div>


          <!-- STEP 7 -->
          <div class="tna-section text-center fg-form" id="search-wizard-step-7">
            <h3 class="roboto-light text-blue">Step 7 of 8<br/>You can select more than one related skills and training programs</h3>
            <br/>

            <div class="row">
              <div class="col-md-8 col-md-offset-2">
                <div class="fg-input"
                  data-type="text-autocomplete"
                  data-name="related_skills"
                  data-validation=""
                  data-placeholder="Select related skill and training programs"
                  data-current=""
                  data-items=""
                  data-classes="form-control"
                  data-multiple-chip="Add More">
                </div>
                <br/>
              </div>

              <div class="col-md-12">
                <br/>
                <button type="button" class="btn btn-default" onclick="goToSearchWizard('6')">
                  <span class="lnr lnr-chevron-left-circle"></span> Prev
                </button>
                <button type="button" class="btn btn-default" onclick="goToSearchWizard('8', 'next')">
                  Next <span class="lnr lnr-chevron-right-circle"></span>
                </button>
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
                <br/>
                <button type="button" class="btn btn-default" onclick="goToSearchWizard('7')">
                  <span class="lnr lnr-chevron-left-circle"></span> Prev
                </button>
                <button type="button" class="btn btn-default" onclick="submitTNA()">
                  Submit
                </button>
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