@include('header')

<body>
  @include('header_nav')

  <main id="main" class="main">

    @include('sidebar')

    <div class="pagetitle col-lg-12">
      <div class="row">
        <div class="col-lg-8">
        <h1>Options</h1>
        <nav>
          <ol class=" breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Signature Options For Customer</li>
          </ol>
          </nav>
        </div>
        <div class="col-lg-4 text-right">
          </div>
      </div>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title"></h5>
              <p>Option 1 - Download Documents & Sign - <a href="customer_sign?document_id=<?php echo $document_id; ?>">Click here</a> </p>
              <p></p>
              <p>Option 2 - Sign Documents Directly - <a href="customer_sign_2?document_id=<?php echo $document_id; ?>">Click here</a> </p>

            </div>
          </div>

        </div>
      </div>
    </section>
  </main><!-- End #main -->

  @include('footer')