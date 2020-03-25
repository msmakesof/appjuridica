//reset type=date inputs to text
$.mobile.page.prototype.options.degradeInputs.date = true;

$("#form").trigger("create");
$( document )
  .on( "pageinit", function(){

$("#date")
    .prop("readonly", "true")
    .on("click", function(){
$input=$(this);
$next=$input.next();

if($next.hasClass("hasDatepicker"))
  $next.hide();

$input
      .hide()
      .after( $( "<div />", {   id  :   "datepicker_"+$input.attr("id")}).datepicker(
        {
          altField          : "#" + $input.attr( "id" ),
          altFormat         : "dd/mm/yy",
          defaultDate       : $input.val(),
          showOtherMonths   : true,
          selectOtherMonths : true,
          //showWeek        : true,
          changeYear        : true,
          changeMonth       : true,
          //showButtonPanel : true,
          //beforeShowDay   : beforeShowDay,
          onSelect          : function( dateText, inst)
          {             $("#datepicker_"+$input.attr("id")).hide();
$input.show();
          }
        }));
    });
        });


(function($, undefined ) {

    //cache previous datepicker ui method
    var prevDp = $.fn.datepicker;

    //rewrite datepicker
    $.fn.datepicker = function( options ){

        var dp = this;

        //call cached datepicker plugin
        prevDp.call( this, options );

        //extend with some dom manipulation to update the markup for jQM
        //call immediately
        function updateDatepicker(event){

          $( ".ui-datepicker-header", dp ).addClass("ui-body-c ui-corner-top").removeClass("ui-corner-all");
            $( ".ui-datepicker-prev, .ui-datepicker-next", dp ).attr("href", "#");
            $( ".ui-datepicker-prev", dp ).buttonMarkup({iconpos: "notext", icon: "arrow-l", shadow: true, corners: true});
            $( ".ui-datepicker-next", dp ).buttonMarkup({iconpos: "notext", icon: "arrow-r", shadow: true, corners: true});
            $( ".ui-datepicker-calendar th", dp ).addClass("ui-bar-c");
            $( ".ui-datepicker-calendar td", dp ).addClass("ui-body-c");
            $( ".ui-datepicker-calendar a", dp ).buttonMarkup({corners: false, shadow: false}); 
            $( ".ui-datepicker-calendar a.ui-state-active", dp ).addClass("ui-btn-active"); // selected date
            $( ".ui-datepicker-calendar a.ui-state-highlight", dp ).addClass("ui-btn-up-e"); // today"s date

            if(typeof event != "undefined")
                {
                var classe= $(event.target).attr("class");
                //alert(classe);
                }
          $( ".ui-datepicker-calendar .ui-btn", dp ).each(function(){
                    var el = $(this);
                    var buttonText = el.find( ".ui-btn-text" );
                    // remove extra button markup - necessary for date value to be interpreted correctly
                    if(buttonText.length)
                        el.html( el.find( ".ui-btn-text" ).text() ); 
                    });
        //      }

        $( dp )
            .off()
            .on( "click", updateDatepicker)
            .find("select")
            .on( "change", function(event){updateDatepicker(event);});
        }

        //update now
        updateDatepicker();

        //return jqm obj 
        return this;
    };
})( jQuery );