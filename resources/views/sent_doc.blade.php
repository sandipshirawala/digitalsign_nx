<?php 
use \App\Http\Controllers\getsignController;
?>
@include('header')

<body>
  @include('header_nav')

  <main id="main" class="main">
    
    @include('sidebar')

    <div class="pagetitle col-lg-12">
      <div class="row">
        <div class="col-lg-8">
        <h1>Manage Sent Docs</h1>
        <nav>
          <ol class=" breadcrumb">
          <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
          <li class="breadcrumb-item active">Manage Sent Docs</li>
          </ol>
          </nav>
        </div>   
      </div>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title"></h5>
              @if(Session::has('message'))
              <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
              @endif
              <p>Docs you have requested signature on</p>

              <!-- Table with stripped rows -->
              <table class="table  table-striped table-responsive" id="mytable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Document</th>
                    <th scope="col">Recipient</th>
                    <th scope="col">Date Sent</th>
                    <th scope="col">Status</th>
                    <th scope="col">
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $i=1;
                  foreach($document_list as $document)
                  {
                        //$files = getsignController::get_file_names($document->document_form_files);
                        $files = $document->document_form_files;
                        $files_array = explode(",",$files);
                        for($j=0;$j<count($files_array);$j++)
                        {
                            $count  = getsignController::get_status($document->document_id,$files_array[$j]);
                            if($count!=1)
                            {
                            ?>
                            <tr>
                              <th scope="row"><?php echo $i; ?></th>
                              <td style="width:20%">
                                  <?php 
                                    $file_name = getsignController::get_file_names($files_array[$j]);
                                    echo substr($file_name, 0, -4);
                                    ?></td>
                              <td><?php echo $document->document_email; ?></td>
                              <td><?php echo $document->document_sent_date; ?></td>
                              <td>
                                    <?php 
                                    //$count  = getsignController::get_status($document->document_id,$files_array[$j]);
                                    if($count==0)
                                    {
                                      ?>
                                      <span class="badge bg-danger">Pending</span>
                                      <?php 
                                      if($document->document_mode=="Local")
                                      {
                                        $url = "customer_sign_2?document_id=".$document->document_id."&form_id=".$files_array[$j];
                                        echo '<a href="'.$url.'" target="_blank"><span class="badge bg-info"><i class="bi-box-arrow-up-right"></i> Open</span></a>';
                                      }
                                      else if($document->document_mode=="Email")
                                      {
                                        $url = "resend_email/".$document->document_id."/".$files_array[$j];
                                        echo '<a href="'.$url.'"><span class="badge bg-info"><i class="bi-envelope"></i> Resend</span></a>';
                                      }
                                    }
                                    else if($count==1)
                                    {
                                      ?>
                                      <span class="badge bg-success">Completed</span>
                                      <?php
                                    }
                                    ?>
                                  <?php //echo "Document id :".$document->document_id." Form id :".$files_array[$j]." "; ?>
                                  <!--<span class="badge bg-danger"><?php echo $document->document_status; ?></span>-->
                              </td>
                              <td>
                                <!--<i class="bi bi-file-earmark-pdf px-2 text-primary" title="View"></i>
                                <i class="bi bi-cloud-download-fill px-2 text-primary" title="Download"></i>
                                <i class="bi bi-trash px-2 text-danger" title="Delete"></i>-->
                                <?php 
                                $file_original_name = getsignController::get_file_original_name($files_array[$j]);
                                ?>
                                <a target="_blank" href="pdf_files/<?php echo $file_original_name; ?>"><i class="bi bi-file-earmark-pdf px-2 text-primary" title="Preview"></i></a>
                                <a href="download_file_by_id/<?php echo $files_array[$j]; ?>"><i class="bi bi-cloud-download-fill px-2 text-primary" title="Download"></i></a>
                            
                                <a href="document_delete/<?php echo $document->document_id; ?>/<?php echo $files_array[$j]; ?>"
                                onclick="return confirm('Are you sure, You want to delete this Record?')"><i class="bi bi-trash px-2 text-danger" title="Delete"></i></a>
                                
        
                              </td>
                            </tr>
                            <?php
                            $i++;
                            }
                        
                        }
                  }
                  ?>
                  <!--<tr>
                    <th scope="row">1</th>
                    <td><a href="#">Waiver_Form.pdf</a></td>
                    <td>John@gmail.com</td>
                    <td>05/23/2022</td>
                    <td><span class="badge bg-danger">Pending</span></td>
                    <td>
                      <i class="bi bi-file-earmark-pdf px-2 text-primary" title="View"></i>
                      <i class="bi bi-cloud-download-fill px-2 text-primary" title="Download"></i>
                      <i class="bi bi-trash px-2 text-danger" title="Delete"></i>

                    </td>
                  </tr>
                  <tr>
                    <th scope="row">1</th>
                    <td><a href="#">Consent_Form.pdf</a></td>
                    <td>samantha@gmail.com</td>
                    <td>05/23/2022</td>
                    <td><span class="badge bg-success">Completed</span></td>
                    <td>
                      <i class="bi bi-file-earmark-pdf px-2 text-primary" title="View"></i>
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
  
  <!--
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
  -->

  <!--<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">-->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap4.min.css">
    
  <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.7.0.js"></script>
  <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap4.min.js"></script>
  <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
  <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap4.min.js"></script>

  <script src="https://cdn.datatables.net/plug-ins/1.13.6/dataRender/ellipsis.js"></script>
  <script type="text/javascript">
    new DataTable('#mytable', {
      responsive: true,
      columnDefs: [
						/*{ targets: 1, render: $.fn.dataTable.render.ellipsis( 10, true ) },*/
						{ targets: 1, render: $.fn.dataTable.render.ellipsis( 20 ) },
						{ targets: 2, render: $.fn.dataTable.render.ellipsis( 15 ) },
					]
  });
  </script>

  <style type="text/css">
    .table
    {
      width:100% !important;
    }
  </style>