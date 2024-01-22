@include('header')

<body>
  @include('header_nav')

  <main id="main" class="main">

    @include('sidebar')

    <div class="pagetitle">
      <h1>Add New Fillable Form(s)</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
          <li class="breadcrumb-item active">Upload New Form</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title"></h5>
              <p>Upload any fillable forms to your master list.</p>

              <form class="row g-3" id="myform" action="{{route('upload_form')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="col-12">
                  <label for="inputNumber" class="col-12 col-form-label">Choose Files <i
                      class="bi bi-info-circle-fill text-primary" data-bs-toggle="modal"
                      data-bs-target="#chooseFiles_modal"></i></label>
                  <div class="col-sm-10">
                      <div id="myform_errorloc" class="error_strings">
                      </div>    
                    <!--<input type="text" id="txt_form" name="txt_form">-->
                    <!--<input class="form-control" multiple type="file" id="formFile" name="formFile" accept="image/*;capture=camera">-->
                    <input class="form-control" multiple type="file" id="formFile" name="formFile[]" accept="application/pdf">
                    
                  </div>
                </div>

                <!-- modal info box for Choose Files -->
                <div class="modal fade" id="chooseFiles_modal" tabindex="-1">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Select Files to Upload</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">Select one or more fillable PDFs you want to upload to the system. <br/>
                      Only PDF files below 4 MB Size are allowed</div>
                    </div>
                  </div>
                </div>


                <div class="col-12 bg-light pb-3">
                  <label class="col-12 col-form-label">Category (Choose All That Apply) <i
                      class="bi bi-info-circle-fill text-primary" data-bs-toggle="modal"
                      data-bs-target="#Category_modal"></i></label>
                  <div class="col-sm-10">
                    <select class="form-select" multiple size="6" id="cmb_category[]" name="cmb_category[]"
                      aria-label="Category">
                      <option value="0" selected='selected'>Uncategorized</option>
                      <?php 
                      foreach($category_list as $category)
                      {
                        ?>
                        <option value="<?php echo $category->category_id; ?>" ><?php echo $category->category_name; ?></option>
                        <?php 
                      }
                      ?>
                      <!--<option value="Walkup" >Uncategorized</option>
                      <option value="Walkout">Insurance</option>
                      <option value="Garage">Contracts</option>
                      <option value="Bulkhead">Waiver Forms</option>-->
                      
                    </select>
                  </div>
                </div>


                <!-- modal info box for Category-->
                <div class="modal fade" id="Category_modal" tabindex="-1">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Choose Categories</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">Select which category(ies) the uploaded file belongs. Default Category is -Uncategorized-
                      </div>
                    </div>
                  </div>
                </div>



                <div class="col-12">
                  <label class="col-sm-2 col-form-label"></label>
                  <div class="col-sm-10">
                   <button type="submit" class="btn btn-success"><i class="bi bi-upload me-1"></i> Upload</button>
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
  
    <style type="text/css">
      .error_strings
      {
        color:red;
      }
    </style>
  
  <script src="gen_validatorv4.js" type="text/javascript"></script>
    <script type="text/javascript">
    var frmvalidator  = new Validator("myform");
    
      frmvalidator.EnableOnPageErrorDisplaySingleBox();
      frmvalidator.EnableMsgsTogether();
      
      frmvalidator.addValidation("formFile","file_extn=pdf","Allowed files types are: pdf");
      frmvalidator.addValidation("formFile","req_file","Please select at least once file to upload");
    </script>