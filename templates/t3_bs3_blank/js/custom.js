
jQuery( document ).ready(function($) {
    $('.Fungicide a').click(function(event) {
          event.preventDefault();
  // $.scrollTo($('#myDiv'), 1000);

  console.log(this.href);
  var url=this.href;
   var hash_value=url.split("#")[1];
 
 //show the value with an alert pop-up
 console.log(hash_value);
        console.log($( "a[name='"+hash_value+"']" ));
       //$('body,html').scrollTo($( "a[value='"+this.href+"']" ), 800, {easing:'elasout'});
          $('html, body').animate({ scrollTop: $( "a[name='"+hash_value+"']" ).offset().top}, 1000);
   //jQuery.scrollTo($( "a[value='"+this.href+"']" ), 1000);
})
});