$(document).ready(function(){
    tinymce.init({
        selector: 'textarea#local-upload',
        menubar: false,
        plugins: [
          'advlist autolink lists link image charmap print preview anchor',
          'searchreplace visualblocks code fullscreen',
          'insertdatetime media table paste code help wordcount',
          'image code'
        ],
  
        toolbar: 'undo redo | image code| formatselect |' +
          'bold italic backcolor | alignleft aligncenter ' +
          'alignright alignjustify | bullist numlist outdent indent | ' +
          'removeformat | help',
        content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',
  
        /* without images_upload_url set, Upload tab won't show up*/
        images_upload_url: 'postAcceptor.php',
  
        /* we override default upload handler to simulate successful upload*/
        images_upload_handler: function(blobInfo, success, failure) {
          setTimeout(function() {
            /* no matter what you upload, we will turn it into TinyMCE logo :)*/
            success('http://moxiecode.cachefly.net/tinymce/v9/images/logo.png');
          }, 2000);
        },
        content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
      });
})