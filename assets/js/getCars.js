function appendOffer(ble,ble1) {
  var object='<article class="offer bg-white margin-bottom padding-left"><hr>';
  object+='<h3>Name: '+ble.name+'</h3>';
  if(ble1.length>0) {
    object+='<p><img class="smallPic" src="'+$('#baseUrl').data('baseurl')+ble1[0].path+'" alt="picture"></p>';
  }
  else object+='<p><img class="smallPic" src="'+$('#baseUrl').data('baseurl')+'/img/nopic.png" alt="no picture"></p>';
  object+='<p>Model: '+ble.mark+' '+ble.model+'</p>';
  object+='<p>Engine: '+ble.capacity+' '+ble.fuel+'</p>';
  object+='<p>Body: '+ble.body+'</p>';
  object+='<p>Year: '+ble.year+'</p>';
  object+='<p>Wage: '+ble.wage+'PLN</p>';
  object+='<p><a class="user-anchor" href="'+$('#baseUrl').data('baseurl')+'/index.php/offer/details/'+ble.id+'">See details</a></p>';
  object+='</article';
  $('.offers').append(object);
}

function getOffers() {
  $.ajax({
    type: "POST",
    url: $('#baseUrl').data('baseurl')+'index.php/ajax/getCars',
    dataType: "json",
    data: {
      orderby: $('#offerOrder').find(':selected').data('orderby'),
      way: $('#offerOrder').find(':selected').data('way'),
      page: $('#page').data('page')
    },
    success: function(json) {
      console.log(json);
      $('.offers').empty();
      for(i=0;i<json.basic.length;i++) {
        appendOffer(json.basic[i],json.pics[i]);
      }
    }
  });
}

$(document).ready(function(){
  getOffers();
  $('#offerOrder').on('change', function(){
    getOffers();
  });
});
