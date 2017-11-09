function changeModels() {
  $.ajax({
    type: "POST",
    url: $('#baseUrl').data('baseurl')+'index.php/ajax/getModels',
    dataType: "json",
    data: {
      mark: $('#mark').val()
    },
    success: function(json) {
      $('#model').empty();
      $.each(json, function(i, ob) {
        $('#model').append('<option value="'+ob.id+'">'+ob.name+'</option>')
      });
    }
  });
}

$(document).ready(function(){
  changeModels();
  $('#mark').on('change', function(){
    changeModels();
  });
});
