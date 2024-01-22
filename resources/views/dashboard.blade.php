@include ('header')

<body>
  @include('header_nav')

  <main id="main" class="main">

    @include('sidebar')

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-8">
          <div class="row">

            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">


                <div class="card-body">
                  <h5 class="card-title">Docs <span>| Pending</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-card-list"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php //echo $document_count-$reply_count; ?>0</h6>


                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->

            <!-- Revenue Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">


                <div class="card-body">
                  <h5 class="card-title">Docs <span>| Signed</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-pencil-square"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo $reply_count; ?></h6>


                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Revenue Card -->

            <!-- Customers Card -->
            <div class="col-xxl-4 col-xl-12">

              <div class="card info-card customers-card">

                <div class="card-body">
                  <h5 class="card-title">Docs <span>| Sent</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-envelope"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo $document_count; ?></h6>


                    </div>
                  </div>

                </div>
              </div>

            </div><!-- End Customers Card -->

            <!-- Reports -->
            <!--<div class="col-12">
              <div class="card">


                <div class="card-body">
                  <h5 class="card-title">Misc <span>/Card</span></h5>



                </div>

              </div>
            </div>

            <div class="col-12">
              <div class="card recent-sales overflow-auto">


                <div class="card-body">
                  <h5 class="card-title">Misc <span>| Card</span></h5>



                </div>

              </div>
            </div>--><!-- End Recent Sales -->

            <!-- Top Selling -->
            <!--
            <div class="col-12">
              <div class="card top-selling overflow-auto">



                <div class="card-body pb-0">
                  <h5 class="card-title">Misc <span>| Card</span></h5>



                </div>

              </div>
            </div>-->
          </div>
        </div>
        <!-- Right side columns -->
        <!--<div class="col-lg-4">

          <div class="card">


            <div class="card-body">
              <h5 class="card-title">Misc <span>| Card</span></h5>



            </div>
          </div>

          <div class="card">


            <div class="card-body pb-0">
              <h5 class="card-title">Misc <span>| Card</span></h5>



            </div>
          </div>

          <div class="card">


            <div class="card-body pb-0">
              <h5 class="card-title">Misc <span>| Card</span></h5>



            </div>
          </div>

          <div class="card">


            <div class="card-body pb-0">
              <h5 class="card-title">Misc <span>| Card</span></h5>

          
            </div>
          </div>

        </div>-->

      </div>
    </section>
  </main><!-- End #main -->

  @include('footer')  