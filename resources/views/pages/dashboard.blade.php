@extends('layouts.app')

@section('title')
    Dashboard
@endsection

@section('title page')
    Dashboard
@endsection

@section('content')
    <div id="count" class="count tile_count">
        <div class="col-md-3 col-sm-4 tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i> Total Siswa</span>
            <div class="count counter-value" data-count="{{$students}}">0</div>
        </div>
        <div class="col-md-3 col-sm-4 tile_stats_count">
            <span class="count_top"><i class="fa fa-users"></i> Total Pengajar</span>
            <div class="count counter-value" data-count="{{$teachers}}">0</div>
        </div>
        <div class="col-md-3 col-sm-4 tile_stats_count">
            <span class="count_top"><i class="fa fa-building"></i> Total Kelas</span>
            <div class="count green counter-value" data-count="{{$classes}}">0</div>
        </div>
        <div class="col-md-3 col-sm-4 tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i> Total Pengguna</span>
            <div class="count counter-value" data-count="{{$users}}">0</div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>New Partner Contracts Consultancy</h2>
              <div class="clearfix"></div>
            </div>

            <div class="x_content">

              <div class="col-md-9 col-sm-9 ">

                <ul class="stats-overview">
                  <li>
                    <span class="name"> Estimated budget </span>
                    <span class="value text-success"> 2300 </span>
                  </li>
                  <li>
                    <span class="name"> Total amount spent </span>
                    <span class="value text-success"> 2000 </span>
                  </li>
                  <li class="hidden-phone">
                    <span class="name"> Estimated project duration </span>
                    <span class="value text-success"> 20 </span>
                  </li>
                </ul>
                <br />

                <div id="mainb" style="height:350px;"></div>

                <div>

                  <h4>Recent Activity</h4>

                  <!-- end of user messages -->
                  <ul class="messages">
                    <li>
                      <img src="images/img.jpg" class="avatar" alt="Avatar">
                      <div class="message_date">
                        <h3 class="date text-info">24</h3>
                        <p class="month">May</p>
                      </div>
                      <div class="message_wrapper">
                        <h4 class="heading">Desmond Davison</h4>
                        <blockquote class="message">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth.</blockquote>
                        <br />
                        <p class="url">
                          <span class="fs1 text-info" aria-hidden="true" data-icon=""></span>
                          <a href="#"><i class="fa fa-paperclip"></i> User Acceptance Test.doc </a>
                        </p>
                      </div>
                    </li>
                    <li>
                      <img src="images/img.jpg" class="avatar" alt="Avatar">
                      <div class="message_date">
                        <h3 class="date text-error">21</h3>
                        <p class="month">May</p>
                      </div>
                      <div class="message_wrapper">
                        <h4 class="heading">Brian Michaels</h4>
                        <blockquote class="message">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth.</blockquote>
                        <br />
                        <p class="url">
                          <span class="fs1" aria-hidden="true" data-icon=""></span>
                          <a href="#" data-original-title="">Download</a>
                        </p>
                      </div>
                    </li>
                    <li>
                      <img src="images/img.jpg" class="avatar" alt="Avatar">
                      <div class="message_date">
                        <h3 class="date text-info">24</h3>
                        <p class="month">May</p>
                      </div>
                      <div class="message_wrapper">
                        <h4 class="heading">Desmond Davison</h4>
                        <blockquote class="message">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth.</blockquote>
                        <br />
                        <p class="url">
                          <span class="fs1 text-info" aria-hidden="true" data-icon=""></span>
                          <a href="#"><i class="fa fa-paperclip"></i> User Acceptance Test.doc </a>
                        </p>
                      </div>
                    </li>
                  </ul>
                  <!-- end of user messages -->


                </div>


              </div>

              <!-- start project-detail sidebar -->
              <div class="col-md-3 col-sm-3 ">

                <section class="panel">

                  <div class="x_title">
                    <h2>Project Description</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="panel-body">
                    <h3 class="green"><i class="fa fa-paint-brush"></i> Gentelella</h3>

                    <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terr.</p>
                    <br />

                    <div class="project_detail">

                      <p class="title">Client Company</p>
                      <p>Deveint Inc</p>
                      <p class="title">Project Leader</p>
                      <p>Tony Chicken</p>
                    </div>

                    <br />
                    <h5>Project files</h5>
                    <ul class="list-unstyled project_files">
                      <li><a href=""><i class="fa fa-file-word-o"></i> Functional-requirements.docx</a>
                      </li>
                      <li><a href=""><i class="fa fa-file-pdf-o"></i> UAT.pdf</a>
                      </li>
                      <li><a href=""><i class="fa fa-mail-forward"></i> Email-from-flatbal.mln</a>
                      </li>
                      <li><a href=""><i class="fa fa-picture-o"></i> Logo.png</a>
                      </li>
                      <li><a href=""><i class="fa fa-file-word-o"></i> Contract-10_12_2014.docx</a>
                      </li>
                    </ul>
                    <br />

                    <div class="text-center mtop20">
                      <a href="#" class="btn btn-sm btn-primary">Add files</a>
                      <a href="#" class="btn btn-sm btn-warning">Report contact</a>
                    </div>
                  </div>

                </section>

              </div>
              <!-- end project-detail sidebar -->

            </div>
          </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    {{-- Count --}}
    <script>
        $(document).ready(function() {
            var a = 0;
                var cTop = $('#count').offset().top - window.innerHeight,
                    scroll = $(window).scrollTop();
                if (a == 0 && scroll > cTop ) {
                    $('.counter-value').each(function() {
                        var $this 	= $(this),
                            countTo = $this.attr('data-count');
                        $({
                            countNum: $this.text()
                        }).animate({
                            countNum: countTo
                        },
                        {
                            duration: 5*1000,
                            easing: 'swing',
                            step: function() {
                                if($this.hasClass('with-plus')) {
                                    $this.text(Math.floor(this.countNum) + '+');
                                } else {
                                    $this.text(Math.floor(this.countNum));
                                }
                            },
                            complete: function() {
                                if($this.hasClass('with-plus')) {
                                    $this.text(this.countNum + '+');
                                } else {
                                    $this.text(this.countNum);
                                }
                                // alert('finished');
                            }
                        });
                    });
                    a = 1;
                }

        })
    </script>

    {{-- Chart --}}
    {{-- <script>
        $(function () {
        'use strict'

        /* ChartJS
        * -------
        * Here we will create a few charts using ChartJS
        */

        //-----------------------
        // - MONTHLY SALES CHART -
        //-----------------------

        // Get context with jQuery - using jQuery's .get() method.
        var salesChartCanvas = $('#salesChart').get(0).getContext('2d')

        var salesChartData = {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            datasets: [
            {
                label: 'Digital Goods',
                backgroundColor: 'rgba(60,141,188,0.9)',
                borderColor: 'rgba(60,141,188,0.8)',
                pointRadius: false,
                pointColor: '#3b8bba',
                pointStrokeColor: 'rgba(60,141,188,1)',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(60,141,188,1)',
                data: [28, 48, 40, 19, 86, 27, 90]
            },
            {
                label: 'Electronics',
                backgroundColor: 'rgba(210, 214, 222, 1)',
                borderColor: 'rgba(210, 214, 222, 1)',
                pointRadius: false,
                pointColor: 'rgba(210, 214, 222, 1)',
                pointStrokeColor: '#c1c7d1',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(220,220,220,1)',
                data: [65, 59, 80, 81, 56, 55, 40]
            }
            ]
        }

        var salesChartOptions = {
            maintainAspectRatio: false,
            responsive: true,
            legend: {
            display: false
            },
            scales: {
            xAxes: [{
                gridLines: {
                display: false
                }
            }],
            yAxes: [{
                gridLines: {
                display: false
                }
            }]
            }
        }

        // This will get the first returned node in the jQuery collection.
        // eslint-disable-next-line no-unused-vars
        var salesChart = new Chart(salesChartCanvas, {
            type: 'line',
            data: salesChartData,
            options: salesChartOptions
        }
        )

        //---------------------------
        // - END MONTHLY SALES CHART -
        //---------------------------

        //-------------
        // - PIE CHART -
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
        var pieData = {
            labels: [
            'Chrome',
            'IE',
            'FireFox',
            'Safari',
            'Opera',
            'Navigator'
            ],
            datasets: [
            {
                data: [700, 500, 400, 600, 300, 100],
                backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de']
            }
            ]
        }
        var pieOptions = {
            legend: {
            display: false
            }
        }
        // Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        // eslint-disable-next-line no-unused-vars
        var pieChart = new Chart(pieChartCanvas, {
            type: 'doughnut',
            data: pieData,
            options: pieOptions
        })

        //-----------------
        // - END PIE CHART -
        //-----------------

        /* jVector Maps
        * ------------
        * Create a world map with markers
        */
        $('#world-map-markers').mapael({
            map: {
            name: 'usa_states',
            zoom: {
                enabled: true,
                maxLevel: 10
            }
            }
        })

        // $('#world-map-markers').vectorMap({
        //   map              : 'world_en',
        //   normalizeFunction: 'polynomial',
        //   hoverOpacity     : 0.7,
        //   hoverColor       : false,
        //   backgroundColor  : 'transparent',
        //   regionStyle      : {
        //     initial      : {
        //       fill            : 'rgba(210, 214, 222, 1)',
        //       'fill-opacity'  : 1,
        //       stroke          : 'none',
        //       'stroke-width'  : 0,
        //       'stroke-opacity': 1
        //     },
        //     hover        : {
        //       'fill-opacity': 0.7,
        //       cursor        : 'pointer'
        //     },
        //     selected     : {
        //       fill: 'yellow'
        //     },
        //     selectedHover: {}
        //   },
        //   markerStyle      : {
        //     initial: {
        //       fill  : '#00a65a',
        //       stroke: '#111'
        //     }
        //   },
        //   markers          : [
        //     {
        //       latLng: [41.90, 12.45],
        //       name  : 'Vatican City'
        //     },
        //     {
        //       latLng: [43.73, 7.41],
        //       name  : 'Monaco'
        //     },
        //     {
        //       latLng: [-0.52, 166.93],
        //       name  : 'Nauru'
        //     },
        //     {
        //       latLng: [-8.51, 179.21],
        //       name  : 'Tuvalu'
        //     },
        //     {
        //       latLng: [43.93, 12.46],
        //       name  : 'San Marino'
        //     },
        //     {
        //       latLng: [47.14, 9.52],
        //       name  : 'Liechtenstein'
        //     },
        //     {
        //       latLng: [7.11, 171.06],
        //       name  : 'Marshall Islands'
        //     },
        //     {
        //       latLng: [17.3, -62.73],
        //       name  : 'Saint Kitts and Nevis'
        //     },
        //     {
        //       latLng: [3.2, 73.22],
        //       name  : 'Maldives'
        //     },
        //     {
        //       latLng: [35.88, 14.5],
        //       name  : 'Malta'
        //     },
        //     {
        //       latLng: [12.05, -61.75],
        //       name  : 'Grenada'
        //     },
        //     {
        //       latLng: [13.16, -61.23],
        //       name  : 'Saint Vincent and the Grenadines'
        //     },
        //     {
        //       latLng: [13.16, -59.55],
        //       name  : 'Barbados'
        //     },
        //     {
        //       latLng: [17.11, -61.85],
        //       name  : 'Antigua and Barbuda'
        //     },
        //     {
        //       latLng: [-4.61, 55.45],
        //       name  : 'Seychelles'
        //     },
        //     {
        //       latLng: [7.35, 134.46],
        //       name  : 'Palau'
        //     },
        //     {
        //       latLng: [42.5, 1.51],
        //       name  : 'Andorra'
        //     },
        //     {
        //       latLng: [14.01, -60.98],
        //       name  : 'Saint Lucia'
        //     },
        //     {
        //       latLng: [6.91, 158.18],
        //       name  : 'Federated States of Micronesia'
        //     },
        //     {
        //       latLng: [1.3, 103.8],
        //       name  : 'Singapore'
        //     },
        //     {
        //       latLng: [1.46, 173.03],
        //       name  : 'Kiribati'
        //     },
        //     {
        //       latLng: [-21.13, -175.2],
        //       name  : 'Tonga'
        //     },
        //     {
        //       latLng: [15.3, -61.38],
        //       name  : 'Dominica'
        //     },
        //     {
        //       latLng: [-20.2, 57.5],
        //       name  : 'Mauritius'
        //     },
        //     {
        //       latLng: [26.02, 50.55],
        //       name  : 'Bahrain'
        //     },
        //     {
        //       latLng: [0.33, 6.73],
        //       name  : 'São Tomé and Príncipe'
        //     }
        //   ]
        // })
        })
    </script> --}}

    <script src="{{ asset('assets/production/js/alert/sweetalert2.min.js') }}"></script>

    {{-- alert success edit --}}
    <script>
        if ({{session()->has('notification-success-edit')}}) {
            Swal.fire({
                icon: 'success',
                title: 'SUCCESS',
                text: 'Data berhasil di edit!'
            })
        }
    </script>
@endpush
