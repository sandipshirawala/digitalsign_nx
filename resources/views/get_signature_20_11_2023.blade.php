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

              <form class="row g-3" method="post" action="{{route('send_signature_form')}}"> 
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
                      <input type="email" class="form-control" id="txtRecipientEmail" name="txt_email" 
                      pattern="[a-zA-Z0-9!#$%&amp;'*+\/=?^_`{|}~.-]+@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*">
                    <!--<input type="text" class="form-control" id="txtRecipientEmail" name="txt_email" novalidate required>-->
                    <!--<input type="text" class="form-control" id="txtRecipientEmail" name="txtRecipientEmail" novalidate required>-->
                    
                    <!--<input type="text" id="tag-input1">-->
                  </div>
                </div>
                
                <div class="col-12 bg-light pb-3" id="name_div">
                  <label for="inputPassword" class="col-12 col-form-label">Recipient Name<i
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
                      <div class="modal-body">Enter Email IDs of recipients you want to send the documents to. You can chose upto 3 recipients using adding Commas(,) <br>
                      tom@gmail.com,hardy@gmail.com,nathan@gmail.com
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
                    <button type="submit" class="btn btn-success"><i class="bi bi-vector-pen me-1"></i> Send</button>
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

  <script type="text/javascript">
    (function () {

      "use strict";


      // Plugin Constructor
      var TagsInput = function (opts) {
        this.options = Object.assign(TagsInput.defaults, opts);
        this.init();
      };

      // Initialize the plugin
      TagsInput.prototype.init = function (opts) {
        this.options = opts ? Object.assign(this.options, opts) : this.options;

        if (this.initialized)
        this.destroy();

        if (!(this.orignal_input = document.getElementById(this.options.selector))) {
          console.error("tags-input couldn't find an element with the specified ID");
          return this;
        }

        this.arr = [];
        this.wrapper = document.createElement('div');
        this.input = document.createElement('input');
        init(this);
        initEvents(this);

        this.initialized = true;
        return this;
      };

      // Add Tags
      TagsInput.prototype.addTag = function (string) {

        if (this.anyErrors(string))
        return;

        this.arr.push(string);
        var tagInput = this;

        var tag = document.createElement('span');
        tag.className = this.options.tagClass;
        tag.innerText = string;

        var closeIcon = document.createElement('a');
        closeIcon.innerHTML = '&times;';

        // delete the tag when icon is clicked
        closeIcon.addEventListener('click', function (e) {
          e.preventDefault();
          var tag = this.parentNode;

          for (var i = 0; i < tagInput.wrapper.childNodes.length; i++) {
            if (tagInput.wrapper.childNodes[i] == tag)
            tagInput.deleteTag(tag, i);
          }
        });


        tag.appendChild(closeIcon);
        this.wrapper.insertBefore(tag, this.input);
        this.orignal_input.value = this.arr.join(',');

        return this;
      };

      // Delete Tags
      TagsInput.prototype.deleteTag = function (tag, i) {
        tag.remove();
        this.arr.splice(i, 1);
        this.orignal_input.value = this.arr.join(',');
        return this;
      };

      // Make sure input string have no error with the plugin
      TagsInput.prototype.anyErrors = function (string) {
        if (this.options.max != null && this.arr.length >= this.options.max) {
          console.log('max tags limit reached');
          return true;
        }

        if (!this.options.duplicate && this.arr.indexOf(string) != -1) {
          console.log('duplicate found " ' + string + ' " ');
          return true;
        }

        return false;
      };

      // Add tags programmatically 
      TagsInput.prototype.addData = function (array) {
        var plugin = this;

        array.forEach(function (string) {
          plugin.addTag(string);
        });
        return this;
      };

      // Get the Input String
      TagsInput.prototype.getInputString = function () {
        return this.arr.join(',');
      };


      // destroy the plugin
      TagsInput.prototype.destroy = function () {
        this.orignal_input.removeAttribute('hidden');

        delete this.orignal_input;
        var self = this;

        Object.keys(this).forEach(function (key) {
          if (self[key] instanceof HTMLElement)
          self[key].remove();

          if (key != 'options')
          delete self[key];
        });

        this.initialized = false;
      };

      // Private function to initialize the tag input plugin
      function init(tags) {
        tags.wrapper.append(tags.input);
        tags.wrapper.classList.add(tags.options.wrapperClass);
        tags.orignal_input.setAttribute('hidden', 'true');
        tags.orignal_input.parentNode.insertBefore(tags.wrapper, tags.orignal_input);
      }

      // initialize the Events
      function initEvents(tags) {
        tags.wrapper.addEventListener('click', function () {
          tags.input.focus();
        });


        tags.input.addEventListener('keydown', function (e) {
          var str = tags.input.value.trim();

          if (!!~[9, 13, 188].indexOf(e.keyCode))
          {
            e.preventDefault();
            tags.input.value = "";
            if (str != "")
            tags.addTag(str);
          }

        });
      }


      // Set All the Default Values
      TagsInput.defaults = {
        selector: '',
        wrapperClass: 'tags-input-wrapper',
        tagClass: 'tag',
        max: null,
        duplicate: false };


      window.TagsInput = TagsInput;

      })();

      var tagInput1 = new TagsInput({
      /*selector: 'tag-input1',*/
      selector:'txtRecipientEmail',
      duplicate: false,
      max: 10 });

      //tagInput1.addData(['PHP', 'JavaScript', 'CSS']);
  </script>
  <style type="text/css">
    .tags-input-wrapper{
        /*background: transparent;*/
        padding: 1px !important;
        border-radius: 4px;
        /*max-width: 400px;*/
        border: 1px solid #ccc
    }
    .tags-input-wrapper input{
        border: none;
        /*background: transparent;*/
        outline: none;
        width: 140px;
        margin-left: 8px;
    }
    .tags-input-wrapper .tag{
        display: inline-block;
        background-color: #fa0e7e;
        color: white;
        border-radius: 40px;
        padding: 0px 3px 0px 7px;
        margin-right: 5px;
        margin-bottom:5px;
        box-shadow: 0 5px 15px -2px rgba(250 , 14 , 126 , .7)
    }
    .tags-input-wrapper .tag a {
        margin: 0 7px 3px;
        display: inline-block;
        cursor: pointer;
    }
  </style>
  
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