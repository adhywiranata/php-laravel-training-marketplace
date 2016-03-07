@extends('main-app')

@section('title', 'SPEAQUS')

@section('content')
  <br/><br/><br/><br/>
  <div class="container">
    <a href="{{url('super-cool-coach/trainings')}}" class="btn"><i class="fa fa-angle-left"></i> Go back</a>
    <div class="row box-profile">
      <div class="col-md-12 box-section profile-section datatable-section" data-section="trainings">
        <div class="row">
          <!--
          <a href="" class="btn blue-back pull-right margin-5"><i class="fa fa-cog"></i> Manage Training Sheet</a>
        -->
          <a href="{{url('super-cool-coach/training/1/add-evaluation')}}" class="btn blue-back pull-right margin-5">Add new Evaluation</a>
        </div>
        <div class="row text-center">
          <h3><span class="lnr lnr-magnifier bigger-1-5 blue-border circle text-blue" style="padding:15px;"></span></h3>
          <br/>
          <h3 class="roboto-light text-blue">TRAINING: LEADERSHIP AND ENTREPREURSHIP DEVELOPMENT</h3>
        </div>
        <br/>
        <table id="audience-table" class="display table" width="100%" cellspacing="0">
          <thead>
            <tr class="uppercase">
              <th>No.</th>
              <th>Audience Name</th>
              <th>Job Title</th>
              <th>Job Level</th>
              <th>Job Function</th>
              <th>Material</th>
              <th>Material Description</th>
              <th>Delivery</th>
              <th>Delivery Description</th>
              <th>Facility</th>
              <th>Facility Description</th>
              <th>Post Test Score</th>
            </tr>
          </thead>
          <tbody>
            @foreach($evaluations as $key=>$evaluation)
            <tr>
              <td>{{ $key+1 }}</td>
              <td><a href="#">{{ $evaluation->audience_name }}</a></td>
              <td>{{ $evaluation->job_title }}</td>
              <td>{{ $evaluation->job_level }}</td>
              <td>{{ $evaluation->job_function }}</td>
              <td>{{ $evaluation->material }}</td>
              <td>{{ $evaluation->material_description }}</td>
              <td>{{ $evaluation->delivery }}</td>
              <td>{{ $evaluation->delivery_description }}</td>
              <td>{{ $evaluation->facility }}</td>
              <td>{{ $evaluation->facility_description }}</td>
              <td>{{ $evaluation->post_test_score }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>

    </div>

  </div>

@stop
