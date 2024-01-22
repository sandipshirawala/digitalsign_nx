<?php 
use \App\Http\Controllers\formController;
?>
@include('header')

<body>
  @include('header_nav')

  <main id="main" class="main">

    @include('sidebar')

    <div class="pagetitle col-lg-12">
      <div class="row">
        <div class="col-lg-8">
        <h1>Manage Fillable Forms</h1>
        <nav>
          <ol class=" breadcrumb">
          <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
          <li class="breadcrumb-item active">Manage Forms</li>
          </ol>
          </nav>
        </div>
        <!--<div class="col-lg-4 text-center my-1"">
          <a href="{{ route('add_form') }}" class="btn btn-success rounded-pill"><i class="bi bi-file-earmark-pdf me-1"></i> Add New Form</a>
        </div>-->
      </div>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title"></h5>
              <p>A list of all fillable PDFs you can send to customers for signing</p>

              <!-- Table with stripped rows -->
              <table class="table  table-striped" id="mytable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">File</th>
                    <th scope="col">Category</th>
                    <th scope="col">Date Created</th>
                    <th scope="col">
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $i=1;
                  foreach($forms_list as $form)
                  {
                    ?>
                    <tr>
                      <th scope="row"><?php echo $i; ?></th>
                      <td>
                          <?php 
                          echo substr($form->form_title, 0, -4);
                          ?>
                      </td>
                      <td>
                        <?php 
                        //echo $this->get_category_names('1,2');
                        //echo \App\Http\Controllers\formController::get_category_names('1,2');
                        //echo formController::get_category_names('1,2');
                        if($form->category_id!=0)
                        {
                          echo formController::get_category_names($form->category_id);
                        }
                        else
                        {
                          echo 'Uncategorized';
                        }
                        ?>
                      </td>
                      <?php 
                      $createDate = new DateTime($form->form_created_date);
                      $stripdate = $createDate->format('d/m/Y');
                      ?>
                      <td><?php echo $stripdate; ?></td>
                      <td>
                        <a target="_blank" href="pdf_files/<?php echo $form->form_file; ?>"><i class="bi bi-file-earmark-pdf px-2 text-primary" title="Preview"></i></a>
                        <a href="download_file_by_id/<?php echo $form->form_id; ?>"><i class="bi bi-cloud-download-fill px-2 text-primary" title="Download"></i></a>
                        <!--<a href="form_delete/<?php echo $form->form_id; ?>" onclick="return confirm('Are you sure, You want to delete this Record?')"><i class="bi bi-trash px-2 text-danger" title="Delete"></i></a>-->
                      
                      </td>
                    </tr>
                    <?php
                    $i++;
                  }
                  ?>
                  <!--<tr>
                    <th scope="row">1</th>
                    <td><a href="#">Waiver_Form.pdf</a></td>
                    <td>Insurance</td>
                    <td>05/23/2022</td>

                    <td>
                      <i class="bi bi-file-earmark-pdf px-2 text-primary" title="Preview"></i>
                      <i class="bi bi-cloud-download-fill px-2 text-primary" title="Download"></i>
                      <i class="bi bi-trash px-2 text-danger" title="Delete"></i>

                    </td>
                  </tr>
                  <tr>
                    <th scope="row">2</th>
                    <td><a href="#">Non-Disclosure.pdf</a></td>
                    <td>Contracts</td>
                    <td>05/23/2022</td>

                    <td>
                      <i class="bi bi-file-earmark-pdf px-2 text-primary" title="Preview"></i>
                      <i class="bi bi-cloud-download-fill px-2 text-primary" title="Download"></i>
                      <i class="bi bi-trash px-2 text-danger" title="Delete"></i>

                    </td>
                  </tr>-->


                </tbody>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>
  </main><!-- End #main -->

  @include('footer')
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <link href="https://cdn.datatables.net/v/dt/dt-1.13.6/datatables.min.css" rel="stylesheet">
  <script src="https://cdn.datatables.net/v/dt/dt-1.13.6/datatables.min.js"></script>
  <script src="https://cdn.datatables.net/plug-ins/1.13.6/dataRender/ellipsis.js"></script>
  <script type="text/javascript">
    $(document).ready( function () {
			$('#mytable')
				.addClass( 'nowrap' )
				.DataTable( {
					responsive: true,
					columnDefs: [
						/*{ targets: 1, render: $.fn.dataTable.render.ellipsis( 10, true ) },*/
						{ targets: 1, render: $.fn.dataTable.render.ellipsis( 25 ) },
						{ targets: 2, render: $.fn.dataTable.render.ellipsis( 15 ) },
					]
				} );
		} );
  </script>
