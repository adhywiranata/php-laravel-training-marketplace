@extends('main-app')

@section('title', 'SPEAQUS')

@section('content')
  <br/><br/><br/><br/>
  <div class="container">
    <a href="{{url('public-trainings')}}" class="btn"><i class="fa fa-angle-left"></i> Go back</a>
    <div class="row box-profile">
      <div class="col-md-12 box-section profile-section datatable-section" data-section="trainings">
        <div class="row text-center">
          <h3><span class="lnr lnr-plus-circle bigger-1-5 blue-border circle text-blue" style="padding:15px;"></span></h3>
          <br/>
          <h3 class="roboto-light text-blue">
              Communication: Best Greetings to Your Best Customers</h3>
        </div>
        <br/>
      </div>
      <div class="col-lg-offset-2 col-lg-8 col-md-12">
        <form class="form-engine box-grid padding-20">

          <div class="col-xs-12 input" data-type="text" data-label="Training title" data-name="title" data-validation="required" data-placeholder="insert training title"></div>
          <div class="col-xs-12 input" data-type="text" data-label="Training Provider" data-name="title" data-validation="required" data-placeholder="insert training provider name"></div>
          <div class="col-xs-12 input" data-type="text" data-label="Training Participant" data-name="title" data-validation="required" data-placeholder="insert training participants"></div>
          <div class="col-xs-12 input" data-type="text" data-label="Training title" data-name="title" data-validation="required" data-placeholder="insert training title"></div>

        <!--
          <label>
            <span class="uppercase">Training Title <span class="text-red">*</span></span>
            <input type="text" class="form-control" placeholder="Insert Training Title"/>
          </label>
          <label>
            <span class="uppercase">Start Date</span>
            <div class="row">
              <div class="col-xs-3">
                <input type="text" class="form-control" placeholder="Day" maxlength="2" pattern="\d+"/>
              </div>
              <div class="col-xs-6">
                <select class="form-control">
                  <option>January</option>
                  <option>February</option>
                  <option>March</option>
                  <option>April</option>
                </select>
              </div>
              <div class="col-xs-3">
                <input type="text" class="form-control" placeholder="Year" maxlength="4"/>
              </div>
            </div>
          </label>
          <label>
            <span class="uppercase">End Date</span>
            <div class="row">
              <div class="col-xs-3">
                <input type="text" class="form-control" placeholder="Day" maxlength="2" pattern="\d+"/>
              </div>
              <div class="col-xs-6">
                <select class="form-control">
                  <option>January</option>
                  <option>February</option>
                  <option>March</option>
                  <option>April</option>
                </select>
              </div>
              <div class="col-xs-3">
                <input type="text" class="form-control" placeholder="Year" maxlength="4"/>
              </div>
            </div>
          </label>
          <label>
            <span class="uppercase">Training Area</span>
            <input type="text" class="form-control" placeholder="Insert Training Title"/>
          </label>
          <label>
            <span class="uppercase">Training Method</span>
            <input type="text" class="form-control" placeholder="Insert Training Title"/>
          </label>
          <label>
            <span class="uppercase">Venue</span>
            <input type="text" class="form-control" placeholder="Insert Training Title"/>
          </label>
          <label>
            <span class="uppercase">Training PIC Name</span>
            <input type="text" class="form-control" placeholder="Insert Training Title"/>
          </label>
          <label>
            <span class="uppercase">Number of Participant</span>
            <input type="text" class="form-control" placeholder="Insert Training Title"/>
          </label>
          <label>
            <span class="uppercase">Participant Department</span>
            <input type="text" class="form-control" placeholder="Insert Training Title"/>
          </label>
          <label>
            <span class="uppercase">Training Language</span>
            <input type="text" class="form-control" placeholder="Insert Training Title"/>
          </label>
          <label>
            <span class="uppercase">Training Provider</span>
            <input type="text" class="form-control" placeholder="Insert Training Title"/>
          </label>
          <label>
            <span class="uppercase">Trainer Name</span>
            <input type="text" class="form-control" placeholder="Insert Training Title"/>
          </label>
          <a href="#" class="btn big-btn bold">Add Training</a>
        -->
        </form>
      </div>

    </div>

  </div>

@stop
