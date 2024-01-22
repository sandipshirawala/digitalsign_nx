@include('header')

<body>
  @include('header_nav')

  <main id="main" class="main" style="margin-top: 10px !important;">

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
              <!--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                Open modal
              </button>-->
              <!-- Table with stripped rows -->
              <!--<table class="table datatable table-striped" id="mytable">-->
              <table class="table  table-striped" id="mytable">
                <thead>
                  <tr>
                    <th scope="col" style="width:1% !important">#</th>
                    <th scope="col" style="width:25% !important">Document</th>
                    <th scope="col" style="width:20% !important">Recipient</th>
                    <th scope="col" style="width:20% !important">Date Signed</th>
                    <th scope="col" style="width:5% !important">Status</th>
                    
                    <!--<th scope="col" style="width:25% !important">IP</th>-->
                    
                    <th scope="col"  style="width:30% !important">
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
                        <?php 
                        echo App\Http\Controllers\getsignController::doc_decline_status($document_reply->document_id,$document_reply->form_id);
                        ?>
                      </td>
                      <td>
                        <?php 
                        $fl_name =$document_reply->document_email."_".$document_reply->form_title;
                        ?>
                        <div style="float:left;margin-right:15px !important" id="moreinfo_div">
                            <a class="nav-link nav-profile d-flex align-items-center pe-0"  style="margin-top:3px !important" 
                            data-toggle="modal" data-target="#myModal"
                            onclick="setval('<?php echo $document_reply->document_reply_ip; ?>',
                            '<?php echo $fl_name; ?>',
                            '<?php echo $document_reply->document_email; ?>',
                            '<?php echo $new_date_format; ?>')">
                                <span class="d-none d-md-block dropdown-toggle ps-2" style="cursor:pointer"><i class="bi bi-eye"></i></span>
                            </a>
                            <!--<a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown" style="margin-top:3px !important">
                                <span class="d-none d-md-block dropdown-toggle ps-2"><i class="bi bi-three-dots-vertical"></i></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile" style=" list-style: none inside !important;">
                                <li>
                                    <a class="dropdown-item d-flex align-items-center">
                                        <span>IP : <?php echo $document_reply->document_reply_ip; ?></span>
                                    </a>
                                </li>
                            </ul>-->
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
						/*({ targets: 1, render: $.fn.dataTable.render.ellipsis( 20, true ) },*/
						{ targets: 1, render: $.fn.dataTable.render.ellipsis( 35 ) },
						{ targets: 2, render: $.fn.dataTable.render.ellipsis( 20, true ) },
					]
				} );
		} );
  </script>
  -->
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
						{ targets: 1, render: $.fn.dataTable.render.ellipsis( 25 ) },
						{ targets: 2, render: $.fn.dataTable.render.ellipsis( 10, true ) },
					]
  });
  </script>

  <style type="text/css">
    .table
    {
      width:100% !important;
    }
  </style>
  
  <style type="text/css">
      #moreinfo_div .dropdown-toggle::after {
        display: none !important;
      }
      
      #moreinfo_div .d-md-block {
        color: #4154f1 !important;
      }
  </style>




  <!-- The Modal -->

  <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">-->
  <!-- This was added <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script> -->
  <!--<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
              
  <div class="modal" id="myModal" style="margin-top:200px">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <!--
        <div class="modal-header">
          <h4 class="modal-title">Modal Heading</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        -->
        
        <!-- Modal body -->
        <div class="modal-body">
          <div class="container">
            <table class="table">
              <tr><td>File Name : <span id="filediv" class="clsinfo"></span></td></tr>
              <!--<tr><td>Sent At : <span id="sentatdiv"></span></td></tr>-->
              <tr><td>Customer Name : <span id="customerdiv" class="clsinfo"></span></td></tr>
              <tr><td>Signed At : <span id="signedatdiv" class="clsinfo"></span></td></tr>
              <tr><td>IP : <span id="ipdiv" class="clsinfo"></span></td></tr>
            </table>
          </div>
          <!--Modal body..-->
        </div>
        
        <!-- Modal footer -->
        <!--
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        -->
        
      </div>
    </div>
  </div>

  <script type="text/javascript">
    function setval(document_reply_ip,file_name,email,reply_date_time)
    {
      //alert(document_reply_ip+":"+file_name+":"+email+":"+reply_date_time);
      $("#filediv").text(file_name);
      //$("#sentatdiv").text(document_reply_ip);
      $("#customerdiv").text(email);
      $("#signedatdiv").text(reply_date_time);
      $("#ipdiv").text(document_reply_ip);
    }
    
  </script>
  <style type="text/css">
    .clsinfo
    {
      font-weight:bold;
    }
  </style>

  