@extends('main-app')

@section('title', 'SPEAQUS')

@section('content')
  <!--
  <div class="row heading">
    <div class="col-lg-12" style="background:rgba(0,0,0, .6); padding:130px 0px 0 0px;">
      <div class="col-lg-6 col-md-offset-1">
      </div>
    </div>
  </div>
-->
  <br/><br/><br/><br/>
  <div class="container">

    <!-- BREADCRUMB -->
    <div class="row">
      <div class="col-xs-12">
        <ul class="breadcrumb pull-left full-width">
          <li><a href="{{ url('') }}">Freelance Trainers</a></li>
          <li>
            <a href="{{ url('u/Fandy-Limardi') }}">Fandy Limardi</a>
          </li>
          <li>
            <a href="">Training Evaluations</a>
          </li>
        </ul>
      </div>
    </div>
    <!-- END OF BREADCRUMB -->

    <div class="row">
      <!--
      <div class="col-md-3 sidebar">
        @include('profile.audience-evaluations.filter-box')
      </div>
      -->
      <div class="col-md-12 box-profile padding-20">

        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <ul class="profile-tab-list">
              <li class="active" data-trigger="evaluation-summary">Participant Summary</li>
              <li data-trigger="audience-evaluation">Past Training Evaluations</li>
            </ul>
          </div>

          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding-20 profile-section" data-section="evaluation-summary">

            <div class="col-lg-6">
              <div id="canvas-holder" class="padding-20 col-lg-4">
                <canvas id="chart-area" width="150" height="150"/>
              </div>
              <div class="col-lg-8">
                <div class="border-left padding-20">
                  <h4>Total Participant Seniority Level</h4>
                  <br/>
                  <p>
                    <i class="fa fa-stop text-green"></i>
                    <span class="bold">50</span> Chief X Officers
                  </p>
                  <p>
                    <i class="fa fa-stop text-blue"></i>
                    <span class="bold">30</span> Managers
                  </p>
                  <p>
                    <i class="fa fa-stop text-red"></i>
                    <span class="bold">10</span> Staffs
                  </p>
                </div>
              </div>
            </div>

            <div class="col-lg-6">
              <div id="canvas-holder" class="padding-20 col-lg-4">
                <canvas id="chart-area-2" width="150" height="150"/>
              </div>
              <div class="col-lg-8">
                <div class="border-left padding-20">
                  <h4>Total Participant Industry</h4>
                  <br/>
                  <div class="row">
                    <div class="col-lg-6">
                      <p>
                        <i class="fa fa-stop text-green"></i>
                        <span class="bold">50</span> Agriculture
                      </p>
                      <p>
                        <i class="fa fa-stop text-blue"></i>
                        <span class="bold">30</span> IT
                      </p>
                      <p>
                        <i class="fa fa-stop text-red"></i>
                        <span class="bold">10</span> Government
                      </p>
                    </div>
                    <div class="col-lg-6">
                      <p>
                        <i class="fa fa-stop text-yellow"></i>
                        <span class="bold">5</span> Business
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-6">
              <div id="canvas-holder" class="padding-20 col-lg-4">
                <canvas id="chart-area-3" width="150" height="150"/>
              </div>
              <div class="col-lg-8">
                <div class="border-left padding-20">
                  <h4>Total Participant Job Function</h4>
                  <br/>
                  <p>
                    <i class="fa fa-stop text-green"></i>
                    <span class="bold">50</span> Accounting
                  </p>
                  <p>
                    <i class="fa fa-stop text-blue"></i>
                    <span class="bold">30</span> Business Development
                  </p>
                  <p>
                    <i class="fa fa-stop text-red"></i>
                    <span class="bold">10</span> Analyst
                  </p>
                </div>
              </div>
            </div>

            <div class="col-lg-6">
              <div id="canvas-holder" class="padding-20 col-lg-4">
                <canvas id="chart-area-4" width="150" height="150"/>
              </div>
              <div class="col-lg-8">
                <div class="border-left padding-20">
                  <h4>Total Participant Training Location</h4>
                  <br/>
                  <p>
                    <i class="fa fa-stop text-green"></i>
                    <span class="bold">50</span> Jakarta, Indonesia
                  </p>
                  <p>
                    <i class="fa fa-stop text-blue"></i>
                    <span class="bold">30</span> Bangkok, Thailand
                  </p>
                  <p>
                    <i class="fa fa-stop text-red"></i>
                    <span class="bold">10</span> Bandung, Indonesia
                  </p>
                </div>
              </div>
            </div>



            <script>
          		var pieData = [
          				{
          					value: 300,
          					color:"#D91E18",
          					highlight: "#D91E18",
          					label: "Red"
          				},
          				{
          					value: 50,
          					color: "#26A65B",
          					highlight: "#26A65B",
          					label: "Green"
          				},
          				{
          					value: 100,
          					color: "#22A7F0",
          					highlight: "#22A7F0",
          					label: "Yellow"
          				}
          			];

                var pieData2 = [
            				{
            					value: 100,
            					color:"#D91E18",
            					highlight: "#D91E18",
            					label: "Red"
            				},
            				{
            					value: 150,
            					color: "#26A65B",
            					highlight: "#26A65B",
            					label: "Green"
            				},
            				{
            					value: 200,
            					color: "#22A7F0",
            					highlight: "#22A7F0",
            					label: "Yellow"
            				},
            				{
            					value: 100,
            					color: "#F4D03F",
            					highlight: "#F4D03F",
            					label: "Yellow"
            				}
            			];

                  var pieData3 = [
              				{
              					value: 100,
              					color:"#D91E18",
              					highlight: "#D91E18",
              					label: "Red"
              				},
              				{
              					value: 100,
              					color: "#26A65B",
              					highlight: "#26A65B",
              					label: "Green"
              				},
              				{
              					value: 300,
              					color: "#22A7F0",
              					highlight: "#22A7F0",
              					label: "Yellow"
              				}
              			];


                    var pieData4 = [
                        {
                          value: 200,
                          color:"#D91E18",
                          highlight: "#D91E18",
                          label: "Red"
                        },
                        {
                          value: 50,
                          color: "#26A65B",
                          highlight: "#26A65B",
                          label: "Green"
                        },
                        {
                          value: 100,
                          color: "#22A7F0",
                          highlight: "#22A7F0",
                          label: "Yellow"
                        }
                      ];


          			window.onload = function(){
          				var ctx = document.getElementById("chart-area").getContext("2d");
          				window.myPie = new Chart(ctx).Pie(pieData);

                  var ctx = document.getElementById("chart-area-2").getContext("2d");
          				window.myPie = new Chart(ctx).Pie(pieData2);

                  var ctx = document.getElementById("chart-area-3").getContext("2d");
          				window.myPie = new Chart(ctx).Pie(pieData3);

                  var ctx = document.getElementById("chart-area-4").getContext("2d");
          				window.myPie = new Chart(ctx).Pie(pieData4);
          			};
          	</script>

          </div>

          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 profile-section" data-section="audience-evaluation">
            @include('profile.audience-evaluations.event-evaluation-grid')
          </div>
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
