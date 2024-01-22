@include('header')

<body>
  @include('header_nav')

  <main id="main" class="main">

    @include('sidebar')

    <div class="pagetitle">
      <h1>Settings & Preferences</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
          <li class="breadcrumb-item active">Settings</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section profile">
      <div class="row">


        <div class="col-xl-12">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <!--<li class="nav-item">
                  <button class="nav-link " data-bs-toggle="tab" data-bs-target="#Blank">Blank</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#paths">Paths</button>
                </li>-->

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#categories">Manage Document
                    Categories</button>
                </li>

                <!--
                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#templates">Email Templates</button>
                </li>
                -->

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade  profile-overview" id="Blank">
                  <h5 class="card-title">Blank Section</h5>
                </div>

                <div class="tab-pane fade profile-edit pt-3" id="paths">

                  <!-- Profile Edit Form -->
                  <form>
                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Sent Documents Path</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="fullName" type="text" class="form-control" id="fullName">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="about" class="col-md-4 col-lg-3 col-form-label">Signed Documents Path</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="about" type="text" class="form-control" id="about">
                        </input>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="company" class="col-md-4 col-lg-3 col-form-label">Data File Path</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="company" type="text" class="form-control" id="company">
                      </div>
                    </div>



                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                  </form><!-- End Profile Edit Form -->

                </div>

                <div class="tab-pane fade show active pt-3" id="categories">

                  <!-- Settings Form -->

                  <!-- Small tables -->
                  <table class="table table-borderless w-50">

                    <tbody>
                        <?php 
                        foreach($category_list as $category)
                        {
                            ?>
                            <tr>
                                <td><?php echo $category->category_name; ?></td>
                                <td>
                                    <a href="delete_category/<?php echo $category->category_id; ?>" onclick="return confirm('Are you sure, You want to delete this Record?')"><i class="bi bi-trash px-2 text-danger" title="Delete"></i></a>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                  </table>
                  <!-- End small tables -->

                  <form method="post" action="{{route('add_category')}}">
                        @csrf
                    <div class="row mb-3">
                      <label for="Category" class="col-md-4 col-lg-3 col-form-label">Add New Category</label>
                      <div class="col-md-8 col-lg-9">
                        <input type="text" class="form-control  w-50" id="txt_category" name="txt_category" required>
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                  </form><!-- End settings Form -->

                </div>

                <div class="tab-pane fade pt-3" id="templates">
                  <!-- Change Password Form -->
                  <form>

                    <div class="col-12">
                      <label for="about" class="col-md-4 col-lg-8 col-form-label">Request Signature Email
                        Template</label>
                      <div class="col-md-8 col-lg-9">
                        <textarea name="about" class="form-control" id="about" style="height: 100px"></textarea>
                      </div>
                    </div>
                    <div class="col-12">
                      <label for="about" class="col-md-4 col-lg-8 col-form-label">Remind Customer for Pending Signature
                        Template</label>
                      <div class="col-md-8 col-lg-9">
                        <textarea name="about" class="form-control" id="about" style="height: 100px"></textarea>
                      </div>
                    </div>





                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                  </form><!-- End Change Password Form -->

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>
  </main><!-- End #main -->

  @include('footer')