$(function() {
   $('#form_file_upload').submit(function(e) {
   
   var url ="<?php echo base_url().'file/doUploadFile';?>"

      e.preventDefault();
      $.ajaxFileUpload({
         url         :url, 
         secureuri      :false,
         fileElementId  :'userfile',
         dataType    : 'html',
         data        : {
                     'title': $('#title').val()
         },
         beforeSend: function(){
         },
         success  : function (data, status){

            if(data.status != 0){

            $('#files').html('<p>Reloading files...</p>');
            // refresh_files();
            $('#title').val('');

            }

            alert(data.msg);
         }
      });
      return false;
   });
});

function refresh_files()
{
   $.get('./upload/files/')
   .success(function (data){
      $('#files').html(data);
   });
}

$(document).ready(function(){

   $('.delete_file_link').on('click', function(e) {
      e.preventDefault();
      if (confirm('Are you sure you want to delete this file?'))
      {
         var link = $(this);
         $.ajax({
            url         : './upload/delete_file/' + link.data('file_id'),
            dataType : 'json',
            success     : function (data)
            {
               //files = $(#files);
               files = $(files);
               if (data.status === "success")
               {
                  link.parents('li').fadeOut('fast', function() {
                     $(this).remove();
                     if (files.find('li').length == 0)
                     {
                        files.html('<p>No Files Uploaded</p>');
                     }
                  });
               }
               else
               {
                  alert(data.msg);
               }
            }
         });
      }
   });

});
