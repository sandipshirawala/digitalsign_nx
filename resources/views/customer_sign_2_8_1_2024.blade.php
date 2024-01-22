@include('header_customer')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<input type="hidden" id="csrf-token" value="{{ csrf_token() }}">
<input type="hidden" id="txt_document_id" value="<?php 
if(isset($_GET['document_id']))
{
  echo $_GET['document_id']; 
}?>">
<input type="hidden" id="txt_form_id" value="
<?php 
if(isset($_GET['form_id']))
{
  echo $_GET['form_id']; 
}
?>">
<input type="hidden" id="txt_url" name="txt_url" value="<?php echo config('app.url'); ?>">
<script type="text/javascript">
  var app_url = document.getElementById('txt_url').value;
</script>
              
<style type="text/css">
      .header-nav
      {
          display:none;
      }
      #main {
        margin-top: 20px !important;
      }
  </style>
  
  <!-- flatten file -->
  <script src="https://unpkg.com/pdf-lib@1.14.0"></script>
  <script src="https://unpkg.com/downloadjs@1.4.7"></script>
  <script src="mergepdf/script.js"></script>
  <script type="text/javascript">
    //added by sandip 
    const { PDFDocument } = PDFLib
    async function flattenForm(document_id,form_id) {
      const formUrl = app_url+'/signed_pdf_files/'+document_id+'_'+form_id+'.pdf'
      const formPdfBytes = await fetch(formUrl).then(res => res.arrayBuffer())

      // Load a PDF with form fields
      const pdfDoc = await PDFDocument.load(formPdfBytes)
      // Get the form containing all the fields
      const form = pdfDoc.getForm()

      // Flatten the form's fields
      //alert("this is before form flatten");
      form.flatten();

      // Serialize the PDFDocument to bytes (a Uint8Array)
      const pdfBytes = await pdfDoc.save()

      var ajax = new XMLHttpRequest();
      ajax.open("POST", app_url+"/save_flatten_file?document_id="+document_id+"&form_id="+form_id,true);
      ajax.setRequestHeader("X-CSRF-TOKEN",document.getElementById('csrf-token').value);
      ajax.send(pdfBytes);


      //setTimeout(function() {location.reload()}, 3000);
      setTimeout(function() {
        //location.reload();
        joinPdf(document_id+"_"+form_id+".pdf");
        //location.reload();
        setTimeout(function() {
          location.reload();
        },10000);
      }, 3000);
      
    }
    //added by sandip
  </script>
  <!-- flatten file -->
  
<body>
  <link href="assets/css/custom.css" rel="stylesheet">
  @include('header-nav-customer')

  <main id="main" class="main" style="margin-top:50px !important">
    
    @include('sidebar-customer')

    <!--<div class="pagetitle">-->
    <div class="card-body" style="padding: 0 5px 5px 5px !important;">
      <?php 
        if(!in_array($_GET['form_id'],$replied_form_id_array))
        {
            if(isset($_GET['form_id']))
            {
            ?>
            <!--<h1>Your Signatures Are Requested</h1>-->
                <!--<button style="float:right" type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                  Add Signature
                </button>-->
              <!--<nav>
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                  <li class="breadcrumb-item active">Signature Request</li>
                </ol>
              </nav>-->
              <?php 
                if(!in_array($_GET['form_id'],$replied_form_id_array))
                {
                  if(isset($_GET['form_id']))
                  {
                    ?>
                    <!--<div class="col-12" >
                      <p></p>
                      <p>Dear <?php echo $document_email_name; ?>,
                        <br />
                        You are requested to review and sign the following document(s). Click on side bar document name to review, fill and sign the document(s) and click Submit to send.  
                      </p>
                      <p></p>
                    </div>-->
                    <div class="col-md-12 my-2">
                      <div class="row">
                        <div class="col-md-8 my-2 small">
                          Dear <?php echo $document_email_name; ?>,
                            <br />
                            You are requested to review and sign the following document(s).
                            Click on side bar document name to review, fill and sign the document(s) and click Submit to
                            send.
                          
                        </div>
                        <div class="col-md-3 text-center">
                          <button type="button" class="btn btn-success my-4" onclick="downloadfile()" ><i class="bi bi-cloud-upload me-1"></i>
                            Submit</button>
                        </div>
                      </div>
                    </div>
                    <?php
                  }
                }
                ?>
            <?php
            }
        }
        ?>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title"></h5>

              <!--<form class="row g-3">-->
                
                

                <div style="height:600px">
                <?php 
                $original_file_name ="";
                $file_name = "";
                if(isset($_GET['form_id']))
                {
                   foreach($single_form_list as $single_form)
                   {
                    //print_r($single_form);
                    //echo $single_form->form_id.":".$single_form->form_title;
                    $original_file_name = $single_form->form_title;
                    $file_name = $single_form->form_file;
                   }
                   
                }

                //echo "<h1>".$file_name."</h1>";
                ?>
                <?php 
                /*
                print("<pre>");
                print_r($replied_form_id_array);
                print("</pre>");
                if(isset($_GET['form_id']))
                {
                  ?>
                  @include('customer_sign_2_pdf_working')
                  <?php
                }
                */
                if(!in_array($_GET['form_id'],$replied_form_id_array))
                {
                  if(isset($_GET['form_id']))
                  {
                    ?>
                    @include('customer_sign_2_pdf_working')
                    <?php
                  }
                }
                else
                {
                  //echo "<center><strong style='color:red'>Thanks for submitting the document. You will receive your signed copy via email shortly. </strong></center>";
                  //added by sandip
                  if($mode=="Email")
                  {
                    echo "<center><strong style='color:red'>Thanks for signing. Miami Rent Boat admin will contact you shortly with next steps.</strong></center>";
                  }
                  else if($mode=="Local")
                  {
                    echo "<center><strong style='color:red'>Thanks for signing.</strong>
                    <br><br><a href='/dashboard'>Go to Dashboard</a></center>";
                  }
                  //added by sandip
                }
                ?>
               </div>



               



              <!--</form>-->
              <!-- End General Form Elements -->


            </div>
          </div>

        </div>
      </div>
    </section>
  </main><!-- End #main -->

  @include('footer')
  
  
   <script type="text/javascript">
    document.getElementById('openFile').style.display="none";
    document.getElementById('download').style.display="none";
    document.getElementById('print').style.display="none";
    //document.getElementById('editorFreeText').style.display="none";
    document.getElementById('secondaryToolbarToggle').style.display="none";
    document.getElementById('sidebarToggle').style.display="none";
  </script>
  
  <!-- Loader -->
    <div id="loading" style="visibility:hidden">
      <img id="loading-image" src="http://rreverser.github.io/mpegts/assets/ajax-loader.gif" alt="Loading..." />
    </div>
    <style type="text/css">
        #loading {
          position: fixed;
          display: block;
          width: 100%;
          height: 100%;
          top: 0;
          left: 0;
          text-align: center;
          opacity: 0.7;
          background-color: #fff;
          z-index: 99;
        }
        
        #loading-image {
          position: absolute;
          /*top: 100px;
          left: 240px;
          */
          top:50%;
          left:50%;
          z-index: 100;
        }
    </style>
  <!-- Loader -->
  
  
  <!-- Modal Popup-->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<div class="modal fade" id="myModal">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                    
                      <!-- Modal Header -->
                      <div style="margin-top:40px">
                      <!--<div class="modal-header">
                        <h4 class="modal-title">Modal Heading</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>-->
                        <button type="button" class="close" data-dismiss="modal" style="display:none">&times;</button>
                        <center>
                          <h2>Create Signature</h2>
                          <h4 style="color:gray">Signatures you create with Esignpro are legally valid.</h4>
                          <hr style="margin-top:20px;margin-bottom:20px">
                          <input type="hidden" id="selected_div">
                          <script type="text/javascript">
                            function update_data(val)
                            {
                              //alert(val);
                              $(".update-text").text(val);
                            }
                            /*
                            $(".update-text").click(function()
                            {
                              alert("clicked here");
                            });
                            */
                           /*
                            $(".update-text").on('click', function(){
                              alert("clicked here");
                            });
                            */
                            $(document).on('click', '.update-text', function(element) {
                              //alert(element);
                              //alert("clicked here");
                              $('td').removeClass("selected-text");
                              //alert($(this).closest('div').attr('id'));
                              $("#selected_div").val($(this).closest('div').attr('id'));
                              $(this).closest('td').addClass("selected-text");
                            });
                          </script>
                        </center>
                      </div>
                      
                      <!-- Modal body -->
                      <div class="modal-body">

                        <!--tab start-->
                        <ul class="nav nav-tabs">
                          <!--<li class="active"><a data-toggle="tab" href="#home">Home</a></li>-->
                          <li id="menu1_li" class="tab-link"><a data-toggle="tab" href="#menu1">Upload Image</a></li>
                          <li id="menu2_li" class="tab-link"><a data-toggle="tab" href="#menu2">Draw</a></li>
                          <li id="menu3_li" class="active tab-link"><a data-toggle="tab" href="#menu3">Type</a></li>
                        </ul>
                        <div class="tab-content">
                          <!--<div id="home" class="tab-pane fade in active">
                            <h3>HOME</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                          </div>-->
                          <div id="menu1"  class="tab-pane fade">
                            <!--<h3>Upload Image</h3>-->
                            <center>
                              <button style="margin-top:100px;margin-bottom:100px" type="button" class="btn btn-primary" id="editorStampAddImage" >
                              <span data-l10n-id="editor_stamp_add_image_label">Add image</span>
                              </button>
                              
                            </center>
                          </div>
                          <div id="menu2" class="tab-pane fade">
                            
                            <link rel="stylesheet" href="draw_signature/style.css">
                            <center>
                              <p  style="margin-top:25px;font-weight:bold;margin-bottom:25px">Draw Signature</p>
                              <canvas id="sig-canvas" width="620" height="160">
                              Get a better browser, bro.
                              </canvas>
                              <div class="row">
                                <div class="col-md-12">
                                  <button class="btn btn-primary" id="sig-submitBtn">Submit Signature</button>
                                  <button class="btn btn-default" id="sig-clearBtn">Clear Signature</button>
                                </div>
                              </div>
                            </center>
                            
                            <br/>
                            <div style="display:none">
                              <div class="row">
                                <div class="col-md-12">
                                  <textarea id="sig-dataUrl" class="form-control" rows="5">Data URL for your signature will go here!</textarea>
                                </div>
                              </div>
                              <br/>
                              <div class="row">
                                <div class="col-md-12">
                                  <img id="sig-image" src="" alt="Your signature will go here!"/>
                                </div>
                              </div>
                            </div>
                              <script  src="draw_signature//script.js"></script>



                            <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
                          </div>
                          <div id="menu3" class="tab-pane fade show in active">
                              <!--<h3>Menu 3</h3>-->
                              <link rel="preconnect" href="https://fonts.googleapis.com">
                              <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
                              <link rel="preconnect" href="https://fonts.googleapis.com">
                              <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
                              <link href="https://fonts.googleapis.com/css2?family=Festive&family=Arizonia&family=Edu+TAS+Beginner&family=Great+Vibes&family=Italianno&family=La+Belle+Aurore&family=Mr+Dafoe&family=Mrs+Saint+Delafield&family=My+Soul&family=Roboto:wght@300&family=Yellowtail&display=swap" rel="stylesheet">

                              <style type="text/css">
                                
                                  .tas-edu
                                  {
                                      font-family: 'Edu TAS Beginner', cursive;
                                  }
                                  .great-vibes
                                  {
                                      font-family: 'Great Vibes', cursive;
                                  }
                                  .mr-dafoe
                                  {
                                      font-family: 'Mr Dafoe', cursive;
                                  }
                                  .Arizonia
                                  {
                                      font-family: 'Arizonia', sans-serif;
                                  }
                                  .yellowtail
                                  {
                                      font-family: 'Yellowtail', cursive;
                                  }
                                  .italiano
                                  {
                                      font-family: 'Italianno', cursive;
                                  }
                                  .mrs-saint
                                  {
                                      font-family: 'Mrs Saint Delafield', cursive;
                                  }
                                  .my-soul
                                  {
                                      font-family: 'My Soul', cursive;
                                  }
                                  .labella
                                  {
                                      font-family : 'La Belle Aurore',cursive;
                                  }
                                  .festive
                                  {
                                      font-family : 'Festive',cursive;
                                  }
                                  td
                                  {
                                      /*
                                      padding:20px;
                                      */
                                      border:1px gray solid;
                                      
                                  }
                              </style>
                              <center>
                                <div style="margin-bottom:20px;margin-top:20px">
                                Enter Name : <input type="text" style="height:25px;font-size:20px;border:2px gray solid;border-radius:10px;padding-left:15px !important" onkeyup="update_data(this.value)">
                                </div>
                              </center>
                                
                              <table style="width:100% !important" >
                                  <tr>
                                      <td>
                                        <div id="div1">
                                          <h1 class="tas-edu update-text">Akash Sareen</h1>
                                        </div>
                                      </td>
                                      <td>
                                        <div id="div2">
                                          <h1 class="great-vibes update-text">Akash Sareen</h1>
                                        </div>
                                      </td>
                                  </tr>
                                  <tr>
                                      <td>
                                        <div id="div3">
                                          <h1 class="mr-dafoe update-text">Akash Sareen</h1>
                                        </div>
                                      </td>
                                      <td>
                                        <div id="div4">
                                          <h1 class="Arizonia update-text">Akash Sareen</h1>
                                        </div>
                                      </td>
                                  </tr>
                                  <tr>
                                      <td>
                                        <div id="div5">
                                          <h1 class="yellowtail update-text">Akash Sareen</h1>
                                        </div>
                                      </td>
                                      <td>
                                        <div id="div6">
                                          <h1 class="italiano update-text">Akash Sareen</h1>
                                        </div>
                                      </td>
                                  </tr>
                                  <tr>
                                      <td>
                                        <div id="div7">
                                          <h1 class="labella update-text">Akash Sareen</h1>
                                        </div>
                                      </td>
                                      <td>
                                        <div id="div8">
                                          <h1 class="mrs-saint update-text">Akash Sareen</h1>
                                        </div>
                                      </td>
                                  </tr>
                                  <tr>
                                      <td>
                                        <div id="div9">
                                          <h1 class="my-soul update-text">Akash Sareen</h1>
                                        </div>
                                      </td>
                                      <td>
                                        <div id="div10">
                                          <h1 class="festive update-text">Akash Sareen</h1>
                                        </div>
                                      </td>
                                  </tr>
                              </table>
                          </div>
                        </div>
                        <!--tab end -->


                        

                      </div>
                      
                      <!-- Modal footer -->
                      <div class="modal-footer">
                        <!--<button type="button" class="btn btn-secondary" data-dismiss="modal">Save</button>-->
                        <button type="button" style="border-radius:10px" class="btn btn-secondary" onclick="savesign()" >Save Signature</button>
                        
                      </div>
                      
                    </div>
                  </div>
                </div>
                <style type="text/css">
                  .modal-open {
                    overflow: hidden;
                  }

                  .modal-open .modal {
                    overflow-x: hidden;
                    overflow-y: auto;
                  }

                  .modal {
                    position: fixed;
                    top: 0;
                    left: 0;
                    z-index: 1050;
                    display: none;
                    width: 100%;
                    height: 100%;
                    overflow: hidden;
                    outline: 0;
                  }

                  .modal-dialog {
                    position: relative;
                    width: auto;
                    margin: 0.5rem;
                    pointer-events: none;
                  }

                  .modal.fade .modal-dialog {
                    transition: -webkit-transform 0.3s ease-out;
                    transition: transform 0.3s ease-out;
                    transition: transform 0.3s ease-out, -webkit-transform 0.3s ease-out;
                    -webkit-transform: translate(0, -50px);
                    transform: translate(0, -50px);
                  }

                  @media (prefers-reduced-motion: reduce) {
                    .modal.fade .modal-dialog {
                      transition: none;
                    }
                  }

                  .modal.show .modal-dialog {
                    -webkit-transform: none;
                    transform: none;
                  }

                  .modal.modal-static .modal-dialog {
                    -webkit-transform: scale(1.02);
                    transform: scale(1.02);
                  }

                  .modal-dialog-scrollable {
                    display: -ms-flexbox;
                    display: flex;
                    max-height: calc(100% - 1rem);
                  }

                  .modal-dialog-scrollable .modal-content {
                    max-height: calc(100vh - 1rem);
                    overflow: hidden;
                  }

                  .modal-dialog-scrollable .modal-header,
                  .modal-dialog-scrollable .modal-footer {
                    -ms-flex-negative: 0;
                    flex-shrink: 0;
                  }

                  .modal-dialog-scrollable .modal-body {
                    overflow-y: auto;
                  }

                  .modal-dialog-centered {
                    display: -ms-flexbox;
                    display: flex;
                    -ms-flex-align: center;
                    align-items: center;
                    min-height: calc(100% - 1rem);
                  }

                  .modal-dialog-centered::before {
                    display: block;
                    height: calc(100vh - 1rem);
                    height: -webkit-min-content;
                    height: -moz-min-content;
                    height: min-content;
                    content: "";
                  }

                  .modal-dialog-centered.modal-dialog-scrollable {
                    -ms-flex-direction: column;
                    flex-direction: column;
                    -ms-flex-pack: center;
                    justify-content: center;
                    height: 100%;
                  }

                  .modal-dialog-centered.modal-dialog-scrollable .modal-content {
                    max-height: none;
                  }

                  .modal-dialog-centered.modal-dialog-scrollable::before {
                    content: none;
                  }

                  .modal-content {
                    position: relative;
                    display: -ms-flexbox;
                    display: flex;
                    -ms-flex-direction: column;
                    flex-direction: column;
                    width: 100%;
                    pointer-events: auto;
                    background-color: #fff;
                    background-clip: padding-box;
                    border: 1px solid rgba(0, 0, 0, 0.2);
                    border-radius: 0.3rem;
                    outline: 0;
                  }

                  .modal-backdrop {
                    position: fixed;
                    top: 0;
                    left: 0;
                    z-index: 1040;
                    width: 100vw;
                    height: 100vh;
                    background-color: #000;
                  }

                  .modal-backdrop.fade {
                    opacity: 0;
                  }

                  .modal-backdrop.show {
                    opacity: 0.5;
                  }

                  .modal-header {
                    display: -ms-flexbox;
                    display: flex;
                    -ms-flex-align: start;
                    align-items: flex-start;
                    -ms-flex-pack: justify;
                    justify-content: space-between;
                    padding: 1rem 1rem;
                    border-bottom: 1px solid #dee2e6;
                    border-top-left-radius: calc(0.3rem - 1px);
                    border-top-right-radius: calc(0.3rem - 1px);
                  }

                  .modal-header .close {
                    padding: 1rem 1rem;
                    margin: -1rem -1rem -1rem auto;
                  }

                  .modal-title {
                    margin-bottom: 0;
                    line-height: 1.5;
                  }

                  .modal-body {
                    position: relative;
                    -ms-flex: 1 1 auto;
                    flex: 1 1 auto;
                    padding: 1rem;
                  }

                  .modal-footer {
                    display: -ms-flexbox;
                    display: flex;
                    -ms-flex-wrap: wrap;
                    flex-wrap: wrap;
                    -ms-flex-align: center;
                    align-items: center;
                    -ms-flex-pack: end;
                    justify-content: flex-end;
                    padding: 0.75rem;
                    border-top: 1px solid #dee2e6;
                    border-bottom-right-radius: calc(0.3rem - 1px);
                    border-bottom-left-radius: calc(0.3rem - 1px);
                  }

                  .modal-footer > * {
                    margin: 0.25rem;
                  }

                  .modal-scrollbar-measure {
                    position: absolute;
                    top: -9999px;
                    width: 50px;
                    height: 50px;
                    overflow: scroll;
                  }

                  @media (min-width: 576px) {
                    .modal-dialog {
                      max-width: 500px;
                      margin: 1.75rem auto;
                    }
                    .modal-dialog-scrollable {
                      max-height: calc(100% - 3.5rem);
                    }
                    .modal-dialog-scrollable .modal-content {
                      max-height: calc(100vh - 3.5rem);
                    }
                    .modal-dialog-centered {
                      min-height: calc(100% - 3.5rem);
                    }
                    .modal-dialog-centered::before {
                      height: calc(100vh - 3.5rem);
                      height: -webkit-min-content;
                      height: -moz-min-content;
                      height: min-content;
                    }
                    .modal-sm {
                      max-width: 300px;
                    }
                    @media (min-width: 992px) {
                      .modal-lg,
                      .modal-xl {
                        max-width: 800px;
                      }
                    }

                    @media (min-width: 1200px) {
                      .modal-xl {
                        max-width: 1140px;
                      }
                    }
                  }

                </style>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Festive&family=Arizonia&family=Edu+TAS+Beginner&family=Great+Vibes&family=Italianno&family=La+Belle+Aurore&family=Mr+Dafoe&family=Mrs+Saint+Delafield&family=My+Soul&family=Roboto:wght@300&family=Yellowtail&display=swap" rel="stylesheet">

<style type="text/css">
   
    .tas-edu
    {
        font-family: 'Edu TAS Beginner', cursive;
    }
    .great-vibes
    {
        font-family: 'Great Vibes', cursive;
    }
    .mr-dafoe
    {
        font-family: 'Mr Dafoe', cursive;
    }
    .Arizonia
    {
        font-family: 'Arizonia', sans-serif;
    }
    .yellowtail
    {
        font-family: 'Yellowtail', cursive;
    }
    .italiano
    {
        font-family: 'Italianno', cursive;
    }
    .mrs-saint
    {
        font-family: 'Mrs Saint Delafield', cursive;
    }
    .my-soul
    {
        font-family: 'My Soul', cursive;
    }
    .labella
    {
        font-family : 'La Belle Aurore',cursive;
    }
    .festive
    {
        font-family : 'Festive',cursive;
    }
    table
    {
      border-spacing: 5px !important;
    }
    td
    {
        /*
        padding:20px;
        */
        border:1px gray dotted !important;
        margin:20px !important;
        border-radius: 10px;
        
        
    }

    .toolbar {
      z-index:0 !important;
    }

    table td {
      text-align: center;
      height:50px !important;
    } 

    td:hover,h1:hover
    {
      background-color:black !important;
      color:white !important;
    }

    .selected-text
    {
      background-color:black !important;
      color:white !important;
    }

    h1
    {
      color:black !important;
    }


    .selected-text h1
    {
      color:red !important;
    }
    


</style>
<!-- Modal Popup -->


<!-- Div to Image -->
<script src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
    <script type="text/javascript">

        function savesign()
        {
          //alert("helo");
          //alert($("#selected_div").val());

          var div_id = $("#selected_div").val();
          downloadimage(div_id);
          //downloadimage("htmltoimage");
        }

        function downloadimage(div_id) {
            /*var container = document.getElementById("image-wrap");*/ /*specific element on page*/
            //var container = document.getElementById("htmltoimage");; /* full page */
            var container = document.getElementById(div_id); /* full page */
            
            //alert("helo world");
            html2canvas(container, { /*allowTaint: true*/ }).then(function (canvas) {
            

                //document.getElementById('imgdiv').src=canvas.toDataURL();
                var link = document.createElement("a");
                document.body.appendChild(link);
                link.download = "html_image.jpg";
                link.href = canvas.toDataURL();
                link.target = '_blank';
                link.click();

               
            });
            
            
            //$('#myModal').modal('toggle');
            //$('#myModal').modal().hide();
            $("#myModal .close").click();
        }

    </script>


    <style>
        #htmltoimage {
            width: 65%;
            margin: auto;
        }
    </style>
<!-- Div to Image -->
  
  <style type="text/css">
    .nav {
      padding-left: 0;
      margin-bottom: 0;
      list-style: none;
    }
    .nav > li {
      position: relative;
      display: block;
    }
    .nav > li > a {
      position: relative;
      display: block;
      padding: 10px 15px;
    }
    .nav > li > a:hover,
    .nav > li > a:focus {
      text-decoration: none;
      background-color: #eeeeee;
    }
    .nav > li.disabled > a {
      color: #777777;
    }
    .nav > li.disabled > a:hover,
    .nav > li.disabled > a:focus {
      color: #777777;
      text-decoration: none;
      cursor: not-allowed;
      background-color: transparent;
    }
    .nav .open > a,
    .nav .open > a:hover,
    .nav .open > a:focus {
      background-color: #eeeeee;
      border-color: #337ab7;
    }
    .nav .nav-divider {
      height: 1px;
      margin: 9px 0;
      overflow: hidden;
      background-color: #e5e5e5;
    }
    .nav > li > a > img {
      max-width: none;
    }
    .nav-tabs {
      border-bottom: 1px solid #ddd;
    }
    .nav-tabs > li {
      float: left;
      margin-bottom: -1px;
    }
    .nav-tabs > li > a {
      margin-right: 2px;
      line-height: 1.42857143;
      border: 1px solid transparent;
      border-radius: 4px 4px 0 0;
    }
    .nav-tabs > li > a:hover {
      border-color: #eeeeee #eeeeee #ddd;
    }
    .nav-tabs > li.active > a,
    .nav-tabs > li.active > a:hover,
    .nav-tabs > li.active > a:focus {
      color: #555555;
      cursor: default;
      background-color: #fff;
      border: 1px solid #ddd;
      border-bottom-color: transparent;
    }
    .nav-tabs.nav-justified {
      width: 100%;
      border-bottom: 0;
    }
    .nav-tabs.nav-justified > li {
      float: none;
    }
    .nav-tabs.nav-justified > li > a {
      margin-bottom: 5px;
      text-align: center;
    }
    .nav-tabs.nav-justified > .dropdown .dropdown-menu {
      top: auto;
      left: auto;
    }
    @media (min-width: 768px) {
      .nav-tabs.nav-justified > li {
        display: table-cell;
        width: 1%;
      }
      .nav-tabs.nav-justified > li > a {
        margin-bottom: 0;
      }
    }
    .nav-tabs.nav-justified > li > a {
      margin-right: 0;
      border-radius: 4px;
    }
    .nav-tabs.nav-justified > .active > a,
    .nav-tabs.nav-justified > .active > a:hover,
    .nav-tabs.nav-justified > .active > a:focus {
      border: 1px solid #ddd;
    }
    @media (min-width: 768px) {
      .nav-tabs.nav-justified > li > a {
        border-bottom: 1px solid #ddd;
        border-radius: 4px 4px 0 0;
      }
      .nav-tabs.nav-justified > .active > a,
      .nav-tabs.nav-justified > .active > a:hover,
      .nav-tabs.nav-justified > .active > a:focus {
        border-bottom-color: #fff;
      }
    }
    .nav-pills > li {
      float: left;
    }
    .nav-pills > li > a {
      border-radius: 4px;
    }
    .nav-pills > li + li {
      margin-left: 2px;
    }
    .nav-pills > li.active > a,
    .nav-pills > li.active > a:hover,
    .nav-pills > li.active > a:focus {
      color: #fff;
      background-color: #337ab7;
    }
    .nav-stacked > li {
      float: none;
    }
    .nav-stacked > li + li {
      margin-top: 2px;
      margin-left: 0;
    }
    .nav-justified {
      width: 100%;
    }
    .nav-justified > li {
      float: none;
    }
    .nav-justified > li > a {
      margin-bottom: 5px;
      text-align: center;
    }
    .nav-justified > .dropdown .dropdown-menu {
      top: auto;
      left: auto;
    }
  </style>

  <script type="text/javascript">
    $(".tab-link").click(function()
    {
      //alert("li isa clicked");
      var id = $(this).attr('id');
      $(".tab-link").removeClass("active");
      $("#"+id).addClass("active");
      //alert(id);
    })
  </script>

<script>
/*
    (function(){
      document.addEventListener("webviewerloaded", () => {
        PDFViewerApplicationOptions.set("disablePreferences", true);
        PDFViewerApplicationOptions.set("annotationMode", pdfjsLib.AnnotationMode.ENABLE);
        PDFViewerApplication.initializedPromise.then(() => {
          console.log(
            "Current annotationMode is",
            PDFViewerApplicationOptions.get('annotationMode')
          )
        });
      });
    })();
    */
  </script>
  <style type="text/css">
        .pagetitle {
            margin-left: 50px !important;
            margin-top: 0px !important;
        }
        .card-title {
            padding: 0 !important;
        }
        body
        {
            overflow-y:hidden !important;
            overflow-x:hidden !important;
        }
        .my-2 {
            margin-top: 0rem !important;
        }
        #outerContainer {
            
            height: 450px !important;
        }
  </style>
<!--
 <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Freehand&display=swap" rel="stylesheet">-->
<style type="text/css">
        .internal
        {
          /*font-family: 'Freehand', cursive !important;*/
          font-size:15px !important;
          color:blue !important;
        }
        
        .sidebar {
            width: 260px !important;
        }
        
  </style>

  
  