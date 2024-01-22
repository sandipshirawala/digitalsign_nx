@include('header')

<body>
  @include('header_nav')

  <main id="main" class="main">

    @include('sidebar')

    <div class="pagetitle col-lg-12">
      <div class="row">
        <div class="col-lg-8">
        <h1>Manage Signed Docs</h1>
        <nav>
          <ol class=" breadcrumb">
          <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
          <li class="breadcrumb-item active">Manage Signed Docs</li>
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
              <p>Docs Signed and Returned By Recipients</p>

              <!-- Table with stripped rows -->
              <!--<table class="table datatable table-striped" id="mytable">-->
              <table class="table  table-striped" id="mytable">
                <thead>
                  <tr>
                    <th scope="col" style="width:5% !important">#</th>
                    <th scope="col" style="width:25% !important">Document</th>
                    <th scope="col" style="width:20% !important">Recipient</th>
                    <th scope="col" style="width:25% !important">Date Signed</th>
                    <!--<th scope="col" style="width:25% !important">IP</th>-->
                    
                    <th scope="col"  style="width:25% !important">
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $i=1;
                  foreach($document_reply_list as $document_reply)
                  {
                    ?>
                    <tr>
                      <th scope="row"><?php echo $i; ?></th>
                      <!--<td>
                          <a href="signed_pdf_files/<?php echo $document_reply->document_reply_file; ?>" target="_blank">
                          <?php //echo $document_reply->document_email."_".$document_reply->form_title; ?>
                          <?php 
                          echo substr($document_reply->document_email."_".$document_reply->form_title, 0, -4);
                          ?>
                          </a>
                      </td>-->
                      <td>
                          <?php 
                          echo substr($document_reply->document_email."_".$document_reply->form_title, 0, -4);
                          ?>
                      </td>
                      <td><?php echo $document_reply->document_email; ?></td>
                      <?php 
                      $new_date_format = date('m/d/Y H:i:s', strtotime($document_reply->document_reply_date));
                      ?>
                      <td><?php echo $new_date_format; ?></td>
                      <!--<td><?php //echo $document_reply->document_reply_ip; ?></td>-->
                      <!--<td>
                        <ul class="d-flex align-items-center">
                          <li class="nav-item dropdown pe-3">

                            <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                              
                              <span class="d-none d-md-block dropdown-toggle ps-2"><i class="bi bi-info-square"></i></span>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                              
                              <li>
                                <a class="dropdown-item d-flex align-items-center" href="/categories">
                                  <i class="bi bi-gear"></i>
                                  <span>IP : <?php echo $document_reply->document_reply_ip; ?></span>
                                </a>
                              </li>
                              

                            </ul>
                          </li>

                        </ul>
                      </td>-->
                      
                      <td>
                        <div style="float:left" style="width:30%" id="moreinfo_div">
                            <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown" style="margin-top:3px !important">
                                <span class="d-none d-md-block dropdown-toggle ps-2"><i class="bi bi-three-dots-vertical"></i></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile" style=" list-style: none inside !important;">
                                <li>
                                    <a class="dropdown-item d-flex align-items-center">
                                        <!--<i class="bi bi-gear"></i>-->
                                        <span>IP : <?php echo $document_reply->document_reply_ip; ?></span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div  style="width:70%">
                            <a href="signed_pdf_files/<?php echo $document_reply->document_reply_file; ?>" target="_blank"><i class="bi bi-file-earmark-pdf px-2 text-primary" title="View"></i></a>
                            <a href="download_signedfile_by_id/<?php echo $document_reply->document_reply_id; ?>"><i class="bi bi-cloud-download-fill px-2 text-primary" title="Download"></i>
                            <a href="documentreply_delete/<?php echo $document_reply->document_reply_id; ?>"  onclick="return confirm('Are you sure, You want to delete this Record?')"><i class="bi bi-trash px-2 text-danger" title="Delete"></i></a>
                        </div>
                      </td>
                    </tr>
                    <?php
                    $i++;
                  }
                  ?>
                  <!--
                  <tr>
                    <th scope="row">1</th>
                    <td><a href="#">Waiver_Form_john@gmail.com_05_July23.pdf</a></td>
                    <td>John@gmail.com</td>
                    <td>05/23/2022</td>
                    
                    <td>
                      <i class="bi bi-file-earmark-pdf px-2 text-primary" title="View"></i>
                      <i class="bi bi-cloud-download-fill px-2 text-primary" title="Download"></i>
                      <i class="bi bi-trash px-2 text-danger" title="Delete"></i>

                    </td>
                  </tr>
                  <tr>
                    <th scope="row">1</th>
                    <td><a href="#">Consent_Form_samantha@gmail.com_05_July23.pdf</a></td>
                    <td>samantha@gmail.com</td>
                    <td>05/23/2022</td>
                    
                    <td>
                      <i class="bi bi-file-earmark-pdf px-2 text-primary" title="View"></i>
                      <i class="bi bi-cloud-download-fill px-2 text-primary" title="Download"></i>
                      <i class="bi bi-trash px-2 text-danger" title="Delete"></i>

                    </td>
                  </tr>
                  -->

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
						/*({ targets: 1, render: $.fn.dataTable.render.ellipsis( 20, true ) },*/
						{ targets: 1, render: $.fn.dataTable.render.ellipsis( 35 ) },
						{ targets: 2, render: $.fn.dataTable.render.ellipsis( 20, true ) },
					]
				} );
		} );
  </script>
  
  <style type="text/css">
      #moreinfo_div .dropdown-toggle::after {
        display: none !important;
      }
      
      #moreinfo_div .d-md-block {
        color: #4154f1 !important;
      }
  </style>