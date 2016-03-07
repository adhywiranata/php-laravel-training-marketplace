@extends('main-app')

@section('title', 'SPEAQUS')

@section('content')
  <br/><br/><br/><br/>
  <div class="container">
    <div class="row box-profile">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <ul class="profile-tab-list">
          <li class="active" data-trigger="trainings">Trainings</li>
          <li data-trigger="training-providers">Training Providers</li>
          <li data-trigger="audiences">Training Audiences</li>
          <!--<li data-trigger="questionnaires">Training Questionnaires</li>-->
        </ul>
      </div>
      <br/><br/><br/><br/>
      <div class="col-md-12 box-section profile-section datatable-section" data-section="trainings">
        <div class="row">
          <a href="" class="btn blue-back pull-right margin-5"><i class="fa fa-cog"></i> Manage Training Sheet</a>
          <a href="{{url('super-cool-coach/create-training')}}" class="btn blue-back pull-right margin-5">Add new Training</a>
        </div>

        <div class="row text-center">
          <h3><span class="lnr lnr-magnifier bigger-1-5 blue-border circle text-blue" style="padding:15px;"></span></h3>
          <br/>
          <h3 class="roboto-light text-blue">TRAININGS</h3>
        </div>

        <!-- Column Views -->
        <div class="toggle-list border-bottom border-top" data-table="training-table">
          <span class="bold uppercase">Column Views</span><br/>

          <a href="#" data-column="6" class="btn green-back text-white check-btn margin-5 toggle-vis">
            <i class="fa fa-check-circle-o"></i>
            Training Area
          </a>
          <a href="#" data-column="7" class="btn green-back text-white check-btn margin-5 toggle-vis">
            <i class="fa fa-check-circle-o"></i>
            Method
          </a>
          <a href="#" data-column="8" class="btn green-back text-white check-btn margin-5 toggle-vis">
            <i class="fa fa-check-circle-o"></i>
            Venue
          </a>
          <a href="#" data-column="9" class="btn green-back text-white check-btn margin-5 toggle-vis">
            <i class="fa fa-check-circle-o"></i>
            PIC Name
          </a>
          <a href="#" data-column="10" class="btn green-back text-white check-btn margin-5 toggle-vis">
            <i class="fa fa-check-circle-o"></i>
            Material Score
          </a>
          <a href="#" data-column="11" class="btn green-back text-white check-btn margin-5 toggle-vis">
            <i class="fa fa-check-circle-o"></i>
            Delivery Score
          </a>
          <a href="#" data-column="12" class="btn green-back text-white check-btn margin-5 toggle-vis">
            <i class="fa fa-check-circle-o"></i>
            Facility Score
          </a>
          <a href="#" data-column="13" class="btn green-back text-white check-btn margin-5 toggle-vis">
            <i class="fa fa-check-circle-o"></i>
            Total Participants
          </a>
          <a href="#" data-column="14" class="btn green-back text-white check-btn margin-5 toggle-vis">
            <i class="fa fa-check-circle-o"></i>
            Participants Department
          </a>
          <a href="#" data-column="15" class="btn green-back text-white check-btn margin-5 toggle-vis">
            <i class="fa fa-check-circle-o"></i>
            Language
          </a>
          <a href="#" data-column="16" class="btn green-back text-white check-btn margin-5 toggle-vis">
            <i class="fa fa-check-circle-o"></i>
            Avg. Post Test Score
          </a>
          <a href="#" data-column="16" class="btn green-back text-white check-btn margin-5 toggle-vis">
            <i class="fa fa-check-circle-o"></i>
            Competencies
          </a>
        </div>
        <!-- end of Column Views -->

        <table id="training-table" class="display table" width="100%" cellspacing="0">
          <thead>
            <tr class="uppercase">
              <th>No.</th>
              <th>Title</th>
              <th>Training Provider</th>
              <th>Trainer</th>
              <th>Start Date</th>
              <th>End Date</th>
              <th>Training Area</th>
              <th>Method</th>
              <th>Venue</th>
              <th>PIC Name</th>
              <th>Material</th>
              <th>Delivery</th>
              <th>Facility</th>
              <th>Total Participants</th>
              <th>Participants Department</th>
              <th>Language</th>
              <th>Average Post Test Score</th>
              <th>Team Lead</th>
              <th>Competencies</th>
              <th>Edit</th>
              <th>Delete</th>
            </tr>
          </thead>
          <tbody>
            @foreach($trainings as $key=>$training)
            <tr>
              <td>{{ $key+1 }}</td>
              <td><a href="{{url('super-cool-coach/training/leadership-development')}}">{{ $training->title }}</a></td>
              <td>{{ $training->training_provider }}</td>
              <td>{{ $training->trainer }}</td>
              <td>{{ $training->start_date }}</td>
              <td>{{ $training->end_date }}</td>
              <td>{{ $training->training_area }}</td>
              <td>{{ $training->method }}</td>
              <td>{{ $training->venue }}</td>
              <td>{{ $training->pic_name }}</td>
              <td>{{ $training->material }}</td>
              <td>{{ $training->delivery }}</td>
              <td>{{ $training->facility }}</td>
              <td>{{ $training->total_participants }}</td>
              <td>{{ $training->participants_department }}</td>
              <td>{{ $training->language }}</td>
              <td>{{ $training->average_post_test_score }}</td>
              <td>{{ $training->team_lead }}</td>
              <td>{{ $training->competencies }}</td>
              <td>
                <a href="" class="btn green-back">Edit</a>
              </td>
              <td>
                <a href="" class="btn red-back">Delete</a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="col-md-12 box-section profile-section datatable-section" data-section="training-providers">
        <div class="row">
          <a href="" class="btn blue-back pull-right margin-5"><i class="fa fa-cog"></i> Manage Training Sheet</a>
          <a href="" class="btn blue-back pull-right margin-5"><i class="fa fa-search"></i> Find New Providers</a>
        </div>
        <div class="row text-center">
          <h3><span class="lnr lnr-magnifier bigger-1-5 blue-border circle text-blue" style="padding:15px;"></span></h3>
          <br/>
          <h3 class="roboto-light text-blue">TRAINING PROVIDERS</h3>
        </div>

        <!-- Column Views -->
        <div class="toggle-list border-bottom border-top" data-table="training-table">
          <span class="bold uppercase">Column Views</span><br/>

          <a href="#" data-column="6" class="btn green-back text-white check-btn margin-5 toggle-vis">
            <i class="fa fa-check-circle-o"></i>
            Training Area
          </a>
          <a href="#" data-column="7" class="btn green-back text-white check-btn margin-5 toggle-vis">
            <i class="fa fa-check-circle-o"></i>
            Method
          </a>
          <a href="#" data-column="8" class="btn green-back text-white check-btn margin-5 toggle-vis">
            <i class="fa fa-check-circle-o"></i>
            Venue
          </a>
          <a href="#" data-column="9" class="btn green-back text-white check-btn margin-5 toggle-vis">
            <i class="fa fa-check-circle-o"></i>
            PIC Name
          </a>
          <a href="#" data-column="10" class="btn green-back text-white check-btn margin-5 toggle-vis">
            <i class="fa fa-check-circle-o"></i>
            Material Score
          </a>
          <a href="#" data-column="11" class="btn green-back text-white check-btn margin-5 toggle-vis">
            <i class="fa fa-check-circle-o"></i>
            Delivery Score
          </a>
          <a href="#" data-column="12" class="btn green-back text-white check-btn margin-5 toggle-vis">
            <i class="fa fa-check-circle-o"></i>
            Facility Score
          </a>
          <a href="#" data-column="13" class="btn green-back text-white check-btn margin-5 toggle-vis">
            <i class="fa fa-check-circle-o"></i>
            Total Participants
          </a>
          <a href="#" data-column="14" class="btn green-back text-white check-btn margin-5 toggle-vis">
            <i class="fa fa-check-circle-o"></i>
            Language
          </a>
          <a href="#" data-column="15" class="btn green-back text-white check-btn margin-5 toggle-vis">
            <i class="fa fa-check-circle-o"></i>
            Avg. Post Test Score
          </a>
          <a href="#" data-column="16" class="btn green-back text-white check-btn margin-5 toggle-vis">
            <i class="fa fa-check-circle-o"></i>
            Competencies
          </a>
        </div>
        <!-- end of Column Views -->

        <table id="training-provider-table" class="display table" width="100%" cellspacing="0">
          <thead>
            <tr class="uppercase">
              <th>No.</th>
              <th>Training Provider</th>
              <th>Top Video</th>
              <th>Company Evaluation Material</th>
              <th>Company Evaluation Delivery</th>
              <th>Company Evaluation Facility</th>
              <th>Company Avg. Post Test Score</th>
              <th>Company Total Audiences</th>
              <th>Company Total Unique Audiences</th>
              <th>Company Trained Audience Job Level</th>
              <th>Company Trained Audience Job Function</th>
              <th>Company Audience Average Age</th>
              <th>Company Top 3 Competencies</th>
              <th>Global Evaluation Material</th>
              <th>Global Evaluation Delivery</th>
              <th>Global Evaluation Facility</th>
              <th>Global Avg. Post Test Score</th>
              <th>Global Total Audiences</th>
              <th>Global Total Unique Audiences</th>
              <th>Global Trained Audience Job Level</th>
              <th>Global Trained Audience Job Function</th>
              <th>Global Audience Average Age</th>
              <th>Global Top 3 Competencies</th>
              <th>Global Evaluation</th>
              <th>Trainings Done</th>
              <th>Competencies</th>
              <th>Customized Evaluation</th>
              <th>Edit</th>
              <th>Delete</th>
            </tr>
          </thead>
          <tbody>
            @for($i=1;$i<20;$i++)
            <tr>
              <td>{{ $i }}</td>
              <td><a href="#">Super Cool Coach</a></td>
              <td>15</td>
              <td>15</td>
              <td>15</td>
              <td>15</td>
              <td>15</td>
              <td>15</td>
              <td>15</td>
              <td>15</td>
              <td>15</td>
              <td>15</td>
              <td>15</td>
              <td>15</td>
              <td>15</td>
              <td>15</td>
              <td>15</td>
              <td>15</td>
              <td>15</td>
              <td>15</td>
              <td>15</td>
              <td>15</td>
              <td>15</td>
              <td>15</td>
              <td>15</td>
              <td>
                <div class="">
                  Entrepreneurship, Leadership
                </div>
              </td>
              <td>20</td>
              <td>
                <a href="" class="btn green-back">Edit</a>
              </td>
              <td>
                <a href="" class="btn red-back">Delete</a>
              </td>
            </tr>
            @endfor
          </tbody>
        </table>
      </div>
      <div class="col-md-12 box-section profile-section datatable-section" data-section="audiences">
        <div class="row">
          <a href="" class="btn blue-back pull-right margin-5"><i class="fa fa-cog"></i> Manage Training Sheet</a>
        </div>
        <div class="row text-center">
          <h3><span class="lnr lnr-magnifier bigger-1-5 blue-border circle text-blue" style="padding:15px;"></span></h3>
          <br/>
          <h3 class="roboto-light text-blue">TRAINING AUDIENCES</h3>
        </div>

        <!-- Column Views -->
        <div class="toggle-list border-bottom border-top" data-table="training-table">
          <span class="bold uppercase">Column Views</span><br/>

          <a href="#" data-column="6" class="btn green-back text-white check-btn margin-5 toggle-vis">
            <i class="fa fa-check-circle-o"></i>
            Training Area
          </a>
          <a href="#" data-column="7" class="btn green-back text-white check-btn margin-5 toggle-vis">
            <i class="fa fa-check-circle-o"></i>
            Method
          </a>
          <a href="#" data-column="8" class="btn green-back text-white check-btn margin-5 toggle-vis">
            <i class="fa fa-check-circle-o"></i>
            Venue
          </a>
          <a href="#" data-column="9" class="btn green-back text-white check-btn margin-5 toggle-vis">
            <i class="fa fa-check-circle-o"></i>
            PIC Name
          </a>
          <a href="#" data-column="10" class="btn green-back text-white check-btn margin-5 toggle-vis">
            <i class="fa fa-check-circle-o"></i>
            Material Score
          </a>
          <a href="#" data-column="11" class="btn green-back text-white check-btn margin-5 toggle-vis">
            <i class="fa fa-check-circle-o"></i>
            Delivery Score
          </a>
          <a href="#" data-column="12" class="btn green-back text-white check-btn margin-5 toggle-vis">
            <i class="fa fa-check-circle-o"></i>
            Facility Score
          </a>
          <a href="#" data-column="13" class="btn green-back text-white check-btn margin-5 toggle-vis">
            <i class="fa fa-check-circle-o"></i>
            Total Participants
          </a>
          <a href="#" data-column="14" class="btn green-back text-white check-btn margin-5 toggle-vis">
            <i class="fa fa-check-circle-o"></i>
            Language
          </a>
          <a href="#" data-column="15" class="btn green-back text-white check-btn margin-5 toggle-vis">
            <i class="fa fa-check-circle-o"></i>
            Avg. Post Test Score
          </a>
          <a href="#" data-column="16" class="btn green-back text-white check-btn margin-5 toggle-vis">
            <i class="fa fa-check-circle-o"></i>
            Competencies
          </a>
        </div>
        <!-- end of Column Views -->

        <table id="audience-table" class="display table" width="100%" cellspacing="0">
          <thead>
            <tr class="uppercase">
              <th>No.</th>
              <th>Audience Name</th>
              <th>Job Title</th>
              <th>Audience Department</th>
              <th>Training Participations</th>
              <th>Job Level</th>
              <th>Job Function</th>
              <th>Material</th>
              <th>Delivery</th>
              <th>Facility</th>
              <th>Top 3 Competencies</th>
              <th>Average Post Test Score</th>
              <th>Last Training</th>
              <th>last Training Date</th>
              <th>Edit</th>
              <th>Delete</th>
            </tr>
          </thead>
          <tbody>
            @for($i=1;$i<15;$i++)
            <tr>
              <td>{{ $i }}</td>
              <td><a href="#">Jonathan Toby</a></td>
              <td>IT Manager</td>
              <td>IT Division</td>
              <td>15</td>
              <td>Manager</td>
              <td>Management</td>
              <td>9</td>
              <td>8</td>
              <td>6</td>
              <td>Programming, Business, Design</td>
              <td>9.5</td>
              <td><a href="{{ url('super-cool-coach/training/leadership-development') }}"> Leadership Development </a></td>
              <td>26 January 2016</td>
              <td>
                <a href="" class="btn green-back">Edit</a>
              </td>
              <td>
                <a href="" class="btn red-back">Delete</a>
              </td>
            </tr>
            @endfor
          </tbody>
        </table>
      </div>
      <div class="col-md-12 box-section profile-section datatable-section" data-section="questionnaires" style="display:none">
        <div class="row">
          <a href="" class="btn blue-back pull-right margin-5"><i class="fa fa-cog"></i> Manage Training Sheet</a>
          <a href="" class="btn blue-back pull-right margin-5">Add New Questionnaire</a>
        </div>
        <div class="row text-center">
          <h3><span class="lnr lnr-magnifier bigger-1-5 blue-border circle text-blue" style="padding:15px;"></span></h3>
          <br/>
          <h3 class="roboto-light text-blue">TRAINING QUESTIONNAIRES</h3>
        </div>
        <table id="questionnaire-table" class="display table" width="100%" cellspacing="0">
          <thead>
            <tr class="uppercase">
              <th>No.</th>
              <th>Questionnaire Name</th>
              <th>Create Date</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @for($i=1;$i<15;$i++)
            <tr>
              <td>{{ $i }}</td>
              <td><a href="#">Leadership Training</a></td>
              <td>23 March 2015</td>
              <td>
                <a href="" class="btn green-back">Edit</a>
                <br/><br/>
                <a href="" class="btn red-back">Back</a>
              </td>
            </tr>
            @endfor
          </tbody>
        </table>
      </div>

    </div>

  </div>

  @include('training.manage-training.company.training-sheet-popup')

@stop
