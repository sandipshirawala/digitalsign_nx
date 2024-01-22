@include('header')

<body>
  @include('header_nav')

  <main id="main" class="main">

    @include('sidebar')

    <div class="pagetitle">
      <h1>Request a Signature</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
          <li class="breadcrumb-item active">Request Signatures</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title"></h5>

              <form class="row g-3" id="signature_form" method="post" action="{{route('send_signature_form')}}"> 
                @csrf
                <div class="col-12 bg-light pb-3">
                  <legend class="col-form-label col-12 pt-0">Choose mode? <i class="bi bi-info-circle-fill text-primary"
                      data-bs-toggle="modal" data-bs-target="#SignatureMode_modal"></i></legend>
                  <div class="col-sm-10">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="txt_mode" id="txt_mode" value="Local">
                      <label class="form-check-label" for="gridCheck1">
                        Open document locally
                      </label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="txt_mode" id="txt_mode" value="Email"  checked='checked'>
                      <label class="form-check-label" for="gridCheck2">
                        Send via Email
                      </label>
                    </div>
                  </div>
                </div>

                <!-- modal info box for Signature Mode?-->
                <div class="modal fade" id="SignatureMode_modal" tabindex="-1">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Signature Mode? </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">Indicate wether you want to get the form signed physically on premise or
                        send it via email to your customer
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-12">
                  <label class="col-12 col-form-label">Select document(s) to send / open <i
                      class="bi bi-info-circle-fill text-primary" data-bs-toggle="modal"
                      data-bs-target="#selectdocs_modal"></i></label>
                  <div class="col-sm-10">
                    <select class="form-select" id="ddHeating Type" name="cmb_form[]" multiple size="5"
                      aria-label="Select document(s) to send">
                        
                      <?php
                      $flag=false;
                      foreach($forms_list as $form)
                      {
                        ?>
                        <option value="<?php echo $form->form_id;?>"
                        <?php 
                        if($flag==false)
                        {
                          echo "selected='selected'";
                        }
                        ?>><?php echo $form->form_title; ?></option>
                        <?php
                        $flag=true;
                      }
                      ?>
                      
                    </select>
                  </div>
                </div>

                <!-- modal info box for Select document(s)-->
                <div class="modal fade" id="selectdocs_modal" tabindex="-1">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Select document(s) </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">Select one or more document to send/open.
                        If send via email option is chosen, you can select upto 4 documents at a time and total file
                        size of selected documents must be less than 20MB
                      </div>
                    </div>
                  </div>
                </div>


                <!-- Document Preview -->
                <!--<div class="col-12">
                  <div class="row">
                    <div class="card w-25 me-3">
                      <img src="assets/img/doc-sample-image.png" class="card-img-top" alt="...">
                      <div class="card-body">
                        <h5 class="card-title">Document Preview</h5>
                        <p class="card-text">Can we show a preview here of the selected document?</p>
                      </div>
                    </div>
                    <div class="card w-25  me-3">
                      <img src="assets/img/doc-sample-image.png" class="card-img-top" alt="...">
                      <div class="card-body">
                        <h5 class="card-title">Document Preview</h5>
                        <p class="card-text">Can we show a preview here of the selected document?</p>
                      </div>
                    </div>
                    <div class="card w-25">
                      <img src="assets/img/doc-sample-image.png" class="card-img-top" alt="...">
                      <div class="card-body">
                        <h5 class="card-title">Document Preview</h5>
                        <p class="card-text">Can we show a preview here of the selected document?</p>
                      </div>
                    </div>
                   
                  </div>
                </div>-->


                <div class="col-12 bg-light pb-3" id="email_div">
                  <label for="inputText" class="col-sm-12 col-form-label">Recipient Emails ( Upto 3) <i
                      class="bi bi-info-circle-fill text-primary" data-bs-toggle="modal"
                      data-bs-target="#RecipientEmail_modal"></i></label>
                  <div class="col-sm-10">
                      
                      
                      <!-- TagsInput -->
                  <div class="col-sm-10" style="border: 1px solid #ccc;;background-color:white">
                      <input type="email" class="form-control" data-role="tagsinput" id="txtRecipientEmail"  name="txt_email"
                      pattern="[a-zA-Z0-9!#$%&amp;'*+\/=?^_`{|}~.-]+@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*">
                    
                  </div>

                
                  <link rel='stylesheet' href='https://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.css'>
                  <style type="text/css">
                    
                    .bootstrap-tagsinput .tag {
                        margin-right: 2px;
                        color: white;
                    }
                    
                    .bootstrap-tagsinput {
                        background-color: #fff;
                        border: 1px solid #ccc;
                        box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
                        display: inline-block;
                        padding: 4px 6px;
                        color: #555;
                        vertical-align: middle;
                        border-radius: 4px;
                        max-width: 100%;
                        width:100%;
                        line-height: 22px;
                        cursor: text;
                    }
                    .label {
                        display: inline;
                        padding: .2em .6em .3em;
                        font-size: 75%;
                        font-weight: 700;
                        line-height: 1;
                        color: #fff;
                        text-align: center;
                        white-space: nowrap;
                        vertical-align: baseline;
                        border-radius: .25em;
                    }
                    .label-info {
                        background-color: #0d6efd;
                    }
                    </style>
                  
                  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>
                  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js'></script>
                  <script src='https://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js'></script><script  src="./script.js"></script>
                   <!-- TagsInput -->
                    
                    <!--<input type="text" id="tag-input1">-->
                  </div>
                </div>
                
                <div class="col-12 bg-light pb-3" id="name_div">
                  <label for="inputPassword" class="col-12 col-form-label">Recipient Name <i
                      class="bi bi-info-circle-fill text-primary" data-bs-toggle="modal"
                      data-bs-target="#Message_modal"></i></label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="txt_name" name="txt_name" />
                  </div>
                </div>

                <!-- modal info box for Recipient Email -->
                <div class="modal fade" id="RecipientEmail_modal" tabindex="-1">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Recipient Emails</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">Enter Email IDs of recipients you want to send the documents to. 
                      You can add upto 3 email IDs separated with comma(,) <br>
                      Example : tom@gmail.com,hardy@gmail.com,nathan@gmail.com
                      </div>

                    </div>
                  </div>
                </div>

                <div class="col-12 bg-light pb-3"  id="msg_div">
                  <label for="inputPassword" class="col-12 col-form-label">Message For Recipients (Optional) <i
                      class="bi bi-info-circle-fill text-primary" data-bs-toggle="modal"
                      data-bs-target="#Message_modal"></i></label>
                  <div class="col-sm-10">
                    <textarea class="form-control" id="txt_message" name="txt_message" style="height: 100px"></textarea>
                  </div>
                </div>


                <!-- modal info box for Message For Recipient-->
                <div class="modal fade" id="Message_modal" tabindex="-1">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Message For Recipient</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">Add a message to recipients. Optional
                      </div>

                    </div>
                  </div>
                </div>


                <div class="col-12">
                  <label class="col-sm-2 col-form-label"></label>
                  <div class="col-sm-10">
                    <!--<button type="submit" class="btn btn-success"><i class="bi bi-vector-pen me-1"></i> Send</button>-->
                    <button type="button" class="btn btn-success" onclick="submitform()"><i class="bi bi-vector-pen me-1"></i> Send</button>
                    
                  </div>
                </div>

              </form><!-- End General Form Elements -->


            </div>
          </div>

        </div>
      </div>
    </section>
  </main><!-- End #main -->

  @include('footer')

  
  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#name_div').hide();
        $('input[type=radio]').change(function(){
            switch($(this).val()) {
              case 'Local' :
                  $("#msg_div").hide();
                  $("#email_div").hide();
                  $("#name_div").show();
                  break;
              case 'Email' :
                  $('#name_div').hide();
                  $("#msg_div").show();
                  $("#email_div").show();
                  break;
            }
        });
    });
</script>
<script type="text/javascript">
                      function submitform()
                      {
                        var mode = document.querySelector('input[name="txt_mode"]:checked').value;
                        //alert(mode);
                        if(mode=="Email")
                        {
                          if(document.getElementById('txtRecipientEmail').value=="")
                          {
                            alert("Please Enter Email");
                          }
                          else
                          {
                            //$("#signature_form").submit();
                            document.getElementById('signature_form').submit();

                          }
                        }
                        else if(mode=="Local")
                        {
                          if(document.getElementById('txt_name').value=="")
                          {
                            alert("Please Enter Receipent Name");
                          }
                          else
                          {
                            //$("#signature_form").submit();
                            document.getElementById('signature_form').submit();
                          }
                        }
                      }
</script>