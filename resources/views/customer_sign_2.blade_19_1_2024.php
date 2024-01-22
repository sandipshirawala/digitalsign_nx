@include('header_customer')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<input type="hidden" id="csrf-token" value="{{ csrf_token() }}">
<input type="hidden" id="txt_document_id" value="<?php 
if(isset($_GET['document_id']))
{
  echo $_GET['document_id']; 
}?>">
<input type="hidden" id="txt_form_id" value="<?php 
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
  /*
      .header-nav
      {
          display:none;
      }
      */
      #main {
        margin-top: 20px !important;
      }
</style>

<!-- merge -->
<script src="https://unpkg.com/pdf-lib@1.14.0"></script>
<script src="https://unpkg.com/downloadjs@1.4.7"></script>
<script src="mergepdf/script.js"></script>
<!-- merge -->

<body>
  <link href="assets/css/custom.css" rel="stylesheet">
  @include('header-nav-customer')

  <main id="main" class="main" style="margin-top:50px !important">
    
    @include('sidebar-customer')

    <!--<input type="button" onclick="joinPdf('48_1.pdf')" value="Join files" id="btn_join">-->
    
    <?php 
    $fl_name = $_GET['document_id']."_".$_GET['form_id'].".pdf";
    ?>
    <!--<input type="button" onclick="joinPdf('<?php echo $fl_name; ?>')" value="Join files" id="btn_join">-->
    
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
                    
                    <!--<div class="col-md-12 my-2">
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
                    </div>-->
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
                
                

                <!--<div style="height:600px">-->
                <div style="width:100% !important;">
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
                  ?>
                  <script type="text/javascript">
                    //$("#nextButton").css("display","none");
                    document.getElementById('nextButton').style.display="none";
                  </script>
                  <?php 
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
            
            /*height: 450px !important;*/
             height: 550px !important;
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
        
        #outerContainer {
          width: 100% !important;
        }

        #toolbarViewerRight
        {
          display:none !important;
        }
  </style>

  

<script>
    $(document).ready(function(){
        $("#approveModal").modal('show');
    });
</script>
<div id="approveModal" class="modal fade" data-keyboard="false" data-backdrop="static"  data-bs-keyboard="false" data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Instructions</h5>
                <!--<a style="cursor:pointer" class="close" onclick="cancel_review()" data-dismiss="modal">&times;</a>-->
            </div>
            <div class="modal-body">
                <form>
                    <p>
                      Dear <?php echo $document_email_name; ?> you are requested to fill and sign this document. 
                      Please click on the "Accept" button, review the document, and commence the signing process
                    </p>
                    <!--<button type="button" class="btn btn-primary" onclick="approve()" data-dismiss="modal">Accept</button>-->
                    <button type="button" class="btn btn-warning btn-sm" onclick="approve()" data-dismiss="modal" ><i class="bi bi-check2-circle me-1"></i>Review &amp; Sign</button>


                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
  function cancel_review()
  {
    //confirm("Are you sure you want to decline signing this document?");
    //window.location.href = app_url+"/cancel_review?document_id="+$("#txt_document_id").val()+"&form_id="+$("#txt_form_id").val();
    if (confirm("Are you sure you want to decline signing this document??") == true) {
        window.location.href = app_url+"/cancel_review?document_id="+$("#txt_document_id").val()+"&form_id="+$("#txt_form_id").val();
      } else {
        return false;
      }
  }

  function approve()
  {
    //alert("approve called");
    $('#approveModal').modal('toggle');
    startTimer();
  }
  </script>