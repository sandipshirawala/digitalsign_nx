<!-- merge -->
<meta name="csrf-token" content="{{ csrf_token() }}" />
<input type="hidden" id="csrf-token" value="{{ csrf_token() }}">
<script src="https://unpkg.com/pdf-lib@1.14.0"></script>
<script src="https://unpkg.com/downloadjs@1.4.7"></script>
<script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
<script src="pdf_assets/viewer.js"></script>
<script type="text/javascript">
    const {
        PDFDocument
    } = PDFLib
</script>
<script src="mergepdf/script_cancel.js"></script>
<input type="hidden" id="txt_url" name="txt_url" value="<?php echo config('app.url'); ?>">
<script type="text/javascript">
  var app_url = document.getElementById('txt_url').value;
</script>
              
<br>
<?php 
//echo $file_name;
?>
<!-- merge -->
<script type="text/javascript">
    joinPdf("<?php echo $file_name; ?>");

    
    setTimeout(function() {
      
      //alert(app_url);
        //location.reload();
    window.location.href=app_url+"/customer_sign_2?document_id=<?php echo $document_id; ?>&form_id=<?php echo $form_id; ?>";
    },5000);
    
   
</script>


<!-- Loader -->
    <div id="loading" style="visibility:visible">
      <img id="loading-image" src="http://rreverser.github.io/mpegts/assets/ajax-loader.gif" alt="Loading..." />
      <h1>Your cancel signing in process...</h1>
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