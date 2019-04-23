$(document).ready(function(){
  
    fill_datatable();
    
    function fill_datatable(filter_status = '', filter_country = '')
    {
     var dataTable = $('#customer_data').DataTable({
      "processing" : true,
      "serverSide" : true,
      "order" : [],
      "searching" : false,
      "ajax" : {
       url:"fetch.php",
       type:"POST",
       data:{
        filter_status:filter_status, filter_country:filter_country
       }
      }
     });
    }
    
    $('#filter').click(function(){
     var filter_status = $('#filter_status').val();
     var filter_country = $('#filter_country').val();
     if(filter_gender != '' && filter_country != '')
     {
      $('#customer_data').DataTable().destroy();
      fill_datatable(filter_status, filter_country);
     }
     else
     {
      alert('Select filter option');
      $('#customer_data').DataTable().destroy();
      fill_datatable();
     }
    });
    
    
   });