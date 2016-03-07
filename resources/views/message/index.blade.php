@extends('main-app')

@section('title', 'SPEAQUS')

@section('content')
  <br/><br/><br/><br/>
  <div class="container">
    <!-- BREADCRUMB -->
    <div class="row">
      <div class="col-xs-12">
        <ul class="breadcrumb pull-left full-width">
          <li><a href="{{ url('u/Fandy-Limardi') }}">Dashboard</a></li>
          <li>
            <a href="">Messages</a>
          </li>
        </ul>
      </div>
    </div>
    <!-- END OF BREADCRUMB -->
    <div class="row">
      <div class="col-md-4">
        <div class="row list-header bold text-center">
          MESSAGES
          <a class="btn btn-default pull-right">Add New Message</a>
        </div>
        <div class="row message-list">
          @for($i=0;$i<10;$i++)
            @include('message.list-each')
          @endfor
        </div>
      </div>
      <div class="col-md-7 box-section">
        <div class="row message-header">
          <div class="col-md-2">
            <img class="pull-right" src="{{ url('images/users/boto_simatupang.jpeg') }}" width="60%;" />
          </div>
          <div class="col-md-5">
            <a class="bigger-1-5">Brandon Lee</a>
            <p>Trainer</p>
          </div>
        </div>
        <div class="row message-content">

          <p class="text-grey text-center padding-20">Mon, 12 Feb 2016</p>
          <div class="pull-right message-each">
            <span>
              Hi nice to meet you, I'm Fandy from SPEAQUS.
            </span>
            <p class="text-grey pull-right text-right">11.59</p>
          </div>

          <div class="pull-right message-each-left">
            <span>
              Hi nice to see you. I'm Brandon. Anything i can help you with?
            </span>
            <p class="text-grey pull-right text-right">11.59</p>
          </div>

          <div class="pull-right message-each-left">
            <span>
              I'm a freelance trainer based in Jakarta.
            </span>
            <p class="text-grey pull-right text-right">11.59</p>
          </div>

          <div class="pull-right message-each">
            <span>
              Hi, excellent. I'm looking for a trainer for my 2-day training.
            </span>
            <p class="text-grey pull-right text-right">11.59</p>
          </div>

          <div class="pull-right message-each">
            <span>
              I've read your profile and it seems you are good at leadership.
              I need to have twenty managers trained in leadership.
            </span>
            <p class="text-grey pull-right text-right">11.59</p>
          </div>

        </div>
        <div class="row">
          <textarea style="border:1px solid #ccc !important; margin:0; width:100%; height:100px; padding:8px !important;" class="form-control"></textarea>
        </div>
        <div class="row"><br/><br/></div>
        <div class="row" style="margin-top:100px;">
          <center>
            <i class="fa fa-circle-o-notch fa-spin bigger-2 blue-border circle text-blue" style="padding:15px;"></i>
          </center>
        </div>
        <div class="row"><br/><br/><br/></div>
      </div>

    </div>

  </div>
@stop
