@include('header')

<body>
  @include('header_nav')

  <main id="main" class="main">

    @include('sidebar-customer')

    <div class="pagetitle">
      <h1>Your Signatures Are Requested<h1>
          <!--<nav>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.html">Home</a></li>
              <li class="breadcrumb-item active">Signature Request</li>
            </ol>
          </nav>-->
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title"></h5>
                <button style="float:right" type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                  Add Signature
                </button>
              

                <div class="col-12 bg-light pb-3">
                  <p></p>
                  <p>Dear John,
                    <br />
                    TLC International have requested your signature on the following documents.
                    You can download the documents, open in a PDF editor of your choice, fill the required details,
                    sign them and then reupload the documents for [Client / Business Name] review.
                  </p>
                  <p></p>
                </div>


                <!-- Document Preview -->
                <div class="col-12">
                  <div class="row">
                    <?php 
                    $form_file = "";
                    $form_id = "";
                    foreach($forms_list as $form)
                    {
                      $form_file = $form->form_file;
                      $form_id = $form->form_id;
                      ?>
                      <div class="card w-25 me-3">
                        <img src="assets/img/doc-sample-image.png" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title"><?php echo $form->form_title; ?></h5>
                          <p class="card-text">Document Details If any</p>
                          
                        </div>
                      </div>
                      <?php
                    }
                    ?>
                    <!--
                    <div class="card w-25 me-3">
                      <img src="assets/img/doc-sample-image.png" class="card-img-top" alt="...">
                      <div class="card-body">
                        <h5 class="card-title">Document Name</h5>
                        <p class="card-text">Document Details If any</p>
                      </div>
                    </div>
                    <div class="card w-25  me-3">
                      <img src="assets/img/doc-sample-image.png" class="card-img-top" alt="...">
                      <div class="card-body">
                        <h5 class="card-title">Document Name</h5>
                        <p class="card-text">Document Details If any</p>
                      </div>
                    </div>
                    <div class="card w-25">
                      <img src="assets/img/doc-sample-image.png" class="card-img-top" alt="...">
                      <div class="card-body">
                        <h5 class="card-title">Document Name</h5>
                        <p class="card-text">Document Details If any</p>
                      </div>
                    </div>
                    -->
                  </div>
                </div>

                <!-- Card with header and footer -->
                <div class="card">
                  <div class="card-header">Step 1 - Download, Fill & Sign</div>
                  <div class="card-body">
                    <p></p>
                    Click on download button below to download the document. Open it in 
                    any PDF editor / app of your choice, fill the required fields and sign it.
                    <p></p>
                  </div>
                  <div class="card-footer">
                  <div class="col-sm-10">
                    <!--<button class="btn btn-warning"  id="download"><i class="bi bi-cloud-download me-1"></i> Download</button>-->
                    <a class="btn btn-warning" id="download" href="pdf_files/<?php echo $form_file; ?>" target="_blank" >Download</a>
                  </div>
                  </div>
                </div><!-- End Card with header and footer -->

                  <form method="post" action="upload_reply" enctype="multipart/form-data" >
                    @csrf
                    <!-- Card with header and footer -->
                    <div class="card">
                      <div class="card-header">Step 2 - Upload Signed Document(s)</div>
                      <input type="hidden" id="txt_document_id" name="txt_document_id" value="<?php echo $document_id; ?>">
                      <input type="hidden" id="txt_form_id" name="txt_form_id" value="<?php echo $form_id; ?>">
                      <input type="hidden" id="txt_email" name="txt_email">
                      <div class="card-body">   
                        <p></p> 
                        After filling and signing upload the documents using the form below
                        <p></p>
                        <div class="col-sm-10">
                        <!--<input class="form-control" multiple type="file" id="formFile">-->
                        <input class="form-control" type="file" id="replyFile" name="replyFile">
                      </div>
                      </div>
                      <div class="card-footer">
                      <div class="col-sm-10">
                        <button type="submit" class="btn btn-success"><i class="bi bi-cloud-upload me-1"></i> Upload</button>
                      </div>
                      </div>
                    </div><!-- End Card with header and footer -->
                  </form>


                

              


            </div>
          </div>

        </div>
      </div>
    </section>
  </main><!-- End #main -->

    @include('footer')

    <script src= 
"https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"> 
    </script> 
  <script type="text/javascript">
    /*
    $('#download').click(function(e) {
        e.preventDefault();  //stop the browser from following
        //window.location.href = 'pdf_files/91086_sample_pdf.pdf';
        //window.location.href = 'pdf_files/95565_dummy.pdf';

        window.open("pdf_files/91086_sample_pdf.pdf", "_blank");
        window.open("pdf_files/95565_dummy.pdf", "_blank");
        
        
        
    });
    */
  </script>
  
  






