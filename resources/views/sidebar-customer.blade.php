 <!-- ======= Sidebar ======= -->
 <aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">
  <?php 
  foreach($forms_list as $form)
  {
    //print_r($form);
    ?>
    <li class="nav-item">
      <a class="nav-link" href="customer_sign_2?document_id=<?php echo $_GET['document_id']; ?>&form_id=<?php echo $form->form_id; ?>">
        <i class="bi bi-clipboard"></i>
        <span><?php echo $form->form_title; ?></span>
      </a>
    </li>
    <?php
  }
  ?>
  <!--<li class="nav-item">
    <a class="nav-link" href="#">
      <i class="bi bi-clipboard"></i>
      <span>Consent Form</span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="#">
      <i class="bi bi-clipboard"></i>
      <span>Enrollment Form</span>
    </a>
  </li>-->
  
  
  

 </ul>

</aside><!-- End Sidebar-->

