require( ['jquery' , 'bootstrap' , 'moment' , 'daterange' ,'bselect' , 'bselect.i18n' ],
function ($) {

	$(document).ready(function(){	
		// Configure/customize these variables.
	    var showChar = 100;  // How many characters are shown by default
	    var ellipsestext = "...";
	    var moretext = "<b>más</b>";
	    var lesstext = "<b>menos</b>";
    

	    $('.more').each(function() {

	        var content = $(this).html();	        	 
	        if(content.length > showChar) {
	 
	            var c = content.substr(0, showChar);
	            var h = content.substr(showChar, content.length - showChar);
	 
	            var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';
	 
	            $(this).html(html);
	        }	 
	    });
 
	    $(".morelink").click(function(){
	        if($(this).hasClass("less")) {
	            $(this).removeClass("less");
	            $(this).html(moretext);
	        } else {
	            $(this).addClass("less");
	            $(this).html(lesstext);
	        }
	        $(this).parent().prev().toggle();
	        $(this).prev().toggle();
	        return false;
	    });


		var dropdownSelectors = $('.dropdown, .dropup');

		// Custom function to read dropdown data
		// =========================
		function dropdownEffectData(target) {
			// @todo - page level global?
			var effectInDefault = null,
				effectOutDefault = null;
			var dropdown = $(target),
				dropdownMenu = $('.dropdown-menu', target);
			var parentUl = dropdown.parents('ul.nav'); 

			// If parent is ul.nav allow global effect settings
			if (parentUl.size() > 0) {
				effectInDefault = parentUl.data('dropdown-in') || null;
				effectOutDefault = parentUl.data('dropdown-out') || null;
			}

			return {
				target:       target,
				dropdown:     dropdown,
				dropdownMenu: dropdownMenu,
				effectIn:     dropdownMenu.data('dropdown-in') || effectInDefault,
				effectOut:    dropdownMenu.data('dropdown-out') || effectOutDefault,  
				};
		}

		// Custom function to start effect (in or out)
		// =========================
		function dropdownEffectStart(data, effectToStart) {
			if (effectToStart) {
				data.dropdown.addClass('dropdown-animating');
				data.dropdownMenu.addClass('animated');
				data.dropdownMenu.addClass(effectToStart);    
			}
		}

// Custom function to read when animation is over
// =========================
function dropdownEffectEnd(data, callbackFunc) {
  var animationEnd = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
  data.dropdown.one(animationEnd, function() {
    data.dropdown.removeClass('dropdown-animating');
    data.dropdownMenu.removeClass('animated');
    data.dropdownMenu.removeClass(data.effectIn);
    data.dropdownMenu.removeClass(data.effectOut);
    
    // Custom callback option, used to remove open class in out effect
    if(typeof callbackFunc == 'function'){
      callbackFunc();
    }
  });
}

		dropdownSelectors.on({
			"show.bs.dropdown": function () {
			// On show, start in effect
			var dropdown = dropdownEffectData(this);
			dropdownEffectStart(dropdown, dropdown.effectIn);
		},
			"shown.bs.dropdown": function () {
			// On shown, remove in effect once complete
			var dropdown = dropdownEffectData(this);
			if (dropdown.effectIn && dropdown.effectOut) {
				dropdownEffectEnd(dropdown, function() {}); 
			}
		},  
		"hide.bs.dropdown":  function(e) {
			// On hide, start out effect
			var dropdown = dropdownEffectData(this);
			if (dropdown.effectOut) {
					e.preventDefault();   
					dropdownEffectStart(dropdown, dropdown.effectOut);   
					dropdownEffectEnd(dropdown, function() {
					dropdown.dropdown.removeClass('open');
				}); 
			}    
			}, 
		});

    	$('.date').daterangepicker({
		    "singleDatePicker": true,
		    "autoApply": true,
		    "locale": {
		        "format": "YYYY-MM-DD",
		        "separator": " - ",
		        "applyLabel": "Apply",
		        "cancelLabel": "Cancel",
		        "fromLabel": "From",
		        "toLabel": "To",
		        "customRangeLabel": "Custom",
		        "daysOfWeek": [
		            "Do",
		            "Lu",
		            "Ma",
		            "Mi",
		            "Ju",
		            "Vi",
		            "Sa"
		        ],
		        "monthNames": [
		            "ENERO",
		            "FEBRERO",
		            "MARZO",
		            "ABRIL",
		            "MAYO",
		            "JUNIO",
		            "JULIO",
		            "AGOSTO",
		            "SEPTIEMBRE",
		            "OCTUBRE",
		            "NOVIEMBRE",
		            "DICIEMBRE"
		        ],
		        "firstDay": 1
		    },
		    "parentEl": "body",				   
		    "opens": "center"
		}, function(start, end, label) {
		  	
		});	
   
		// Remove menu for searching
		$('#search-trigger').click(function () {

		    $('.navbar-nav').removeClass('slide-in');
		    $('.side-body').removeClass('body-slide-in');

		});		

   		$("#save_file").click(function(){

			var href = $(this).parent().parent().find(".modal-body form");
			var body = $(this).parent().parent();
			var $this = $(this);		
			
			if(href.attr("action")){

				var formData = new FormData($("#form1")[0]);			
				
				$.ajax({
					url : href.attr("action") ,
					data : formData ,
					cache : false ,
					type : 'POST' ,				
					processData:false ,
					contentType:false ,
					beforeSend : function(){
						$this.attr("disabled",true);
						body.find('.modal-body').html('<center><i class="fa fa-cog fa-spin fa-3x text-site"></i></center>');
					},
					success : function(data){					
						$this.removeAttr("disabled");
						body.find('.modal-body').html(data);						
						
					},
					error : function(error){
						$this.removeAttr("disabled");
						body.find('.modal-body').html(error.responseText);
					}
				});
			}	

		});   		

		$("input:text").attr("autocomplete","off");		
		$('[data-toggle="popover"]').popover({ 'html' : true });		

		$("body").delegate("#rut,#dv","change load", function(){
			var rut = $.trim($("#rut").val());
			var dv = $.trim($("#dv").val());

			$("#usuario").val(rut + "" + dv);
		});
		
		$('#myModal,#myModalFile').on('show.bs.modal', function (event) {

			var button = $(event.relatedTarget);
			var title = button.data('title');
			var url = button.data('href');
			var show = button.data('buttons');
			var large = button.data('large');
			var short = button.data('short');
			var footer = button.data('footer');	

			var modal = $(this);
			modal.find('.modal-title').html(title);

			if(large == true){			
				modal.find(".modal-dialog").addClass("modal-lg");
			}

			if(short == true){			
				modal.find(".modal-dialog").addClass("modal-sm");
			}

			if(show == false ){
				modal.find(".modal-body").css("border-radius","0 0 5px 5px");			
				modal.find(".modal-footer").addClass("hide");
			}

			$.ajax({
				async:true,
				url : url ,
				type : 'GET' ,
				dataType : 'html' ,
				beforeSend : function(){
					modal.find('.modal-body').html('<center><i class="fa fa-cog fa-spin fa-3x text-site"></i></center>');
				},
				success : function(data){

					modal.find('.modal-body').html(data);
					$('.selectpicker').selectpicker();					
					$('[data-toggle="tooltip"]').tooltip({ 'html' : true });

					$('.date').daterangepicker({
					    "singleDatePicker": true,
					    "autoApply": true,
					    "locale": {
					        "format": "YYYY-MM-DD",
					        "separator": " - ",
					        "applyLabel": "Apply",
					        "cancelLabel": "Cancel",
					        "fromLabel": "From",
					        "toLabel": "To",
					        "customRangeLabel": "Custom",
					        "daysOfWeek": [
					            "Do",
					            "Lu",
					            "Ma",
					            "Mi",
					            "Ju",
					            "Vi",
					            "Sa"
					        ],
					        "monthNames": [
					            "ENERO",
					            "FEBRERO",
					            "MARZO",
					            "ABRIL",
					            "MAYO",
					            "JUNIO",
					            "JULIO",
					            "AGOSTO",
					            "SEPTIEMBRE",
					            "OCTUBRE",
					            "NOVIEMBRE",
					            "DICIEMBRE"
					        ],
					        "firstDay": 1
					    },
					    "parentEl": "body",				   
					    "opens": "center"
					}, function(start, end, label) {
					  	
					});					

					$("input:text").attr("autocomplete","off");
					$('[data-toggle="tooltip"]').tooltip({ 'trigger': 'focus' , 'animation': true , 'container' : '.form-group' });	
						
				},
				error : function( j , s , t){
					modal.find('.modal-body').html('<div class="alert alert-warning">Hubo un problema al cargar modulo, cierre la venta e intente nuevamente</div>');
				}
			});
			
		});		

		$('#myModal,#myModalFile').on('hidden.bs.modal', function (event) {
			var modal = $(this);
			modal.find(".modal-dialog").removeClass("modal-lg").removeClass('modal-sm');
			modal.find(".modal-body").css("border-radius","0");
			modal.find(".modal-footer").removeClass("hide");
		});		

		$("body").delegate(".link","click", function(e){

			e.preventDefault();
			var href = $(this).attr("href");
			var large = $(this).data('large');
			var body = $("#myModal");
			var show = $(this).data('buttons');
			var title = $(this).data('title');
			body.find('.modal-title').html(title);

			if(large == true){			
				body.find(".modal-dialog").addClass("modal-lg");
			}else{
				body.find(".modal-dialog").removeClass("modal-lg");
			}

			if(show == false ){
				body.find(".modal-body").css("border-radius","0 0 5px 5px");			
				body.find(".modal-footer").addClass("hide");
			}else{
				body.find(".modal-body").css("border-radius","0");			
				body.find(".modal-footer").removeClass("hide");
			}

			if(href){
				$.ajax({
					url : href ,					
					cache : false ,
					type : 'GET' ,
					dataType : 'html' ,
					beforeSend : function(){						
						body.find('.modal-body').html('<center><i class="fa fa-cog fa-3x fa-spin text-site"></i></center>');
					},
					success : function(data){						
						body.find('.modal-body').html(data);
						$('.selectpicker').selectpicker();
						$('[data-toggle="popover"]').popover({ 'html' : true });				
					},
					error : function(error){						
						body.find('.modal-body').html(error.responseText);
					}
				});
			}	
			
		});
		

		$("#modal_send").click(function(){

			var href = $(this).parent().parent().find(".modal-body form");
			var body = $(this).parent().parent();
			var $this = $(this);
			
			if(href.attr("action")){
				$.ajax({
					url : href.attr("action") ,
					data : href.serialize() ,
					cache : false ,
					type : 'POST' ,
					dataType : 'html' ,
					beforeSend : function(){
						$this.attr("disabled",true);
						body.find('.modal-body').html('<center><i class="fa fa-cog fa-3x fa-spin text-site"></i></center>');
					},
					success : function(data){						
						$this.removeAttr("disabled");
						body.find('.modal-body').html(data);
						$('.selectpicker').selectpicker();
						$('[data-toggle="popover"]').popover({ 'html' : true });	

						$('.date').daterangepicker({
						    "singleDatePicker": true,
						    "autoApply": true,
						    "locale": {
						        "format": "YYYY-MM-DD",
						        "separator": " - ",
						        "applyLabel": "Apply",
						        "cancelLabel": "Cancel",
						        "fromLabel": "From",
						        "toLabel": "To",
						        "customRangeLabel": "Custom",
						        "daysOfWeek": [
						            "Do",
						            "Lu",
						            "Ma",
						            "Mi",
						            "Ju",
						            "Vi",
						            "Sa"
						        ],
						        "monthNames": [
						            "ENERO",
						            "FEBRERO",
						            "MARZO",
						            "ABRIL",
						            "MAYO",
						            "JUNIO",
						            "JULIO",
						            "AGOSTO",
						            "SEPTIEMBRE",
						            "OCTUBRE",
						            "NOVIEMBRE",
						            "DICIEMBRE"
						        ],
						        "firstDay": 1
						    },
						    "parentEl": "body",				   
						    "opens": "center"
						}, function(start, end, label) {
						  	
						});						

					},
					error : function(error){
						$this.removeAttr("disabled");
						body.find('.modal-body').html(error.responseText);
					}
				});
			}	

		});
	});
});