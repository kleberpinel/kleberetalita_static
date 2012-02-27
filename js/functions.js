// TOGGLES & TABS
$(document).ready(function() {
 	$(".toggle_container").hide(); 
 	$(".trigger").click(function(){
			$(this).toggleClass("active").next().slideToggle("fast");
		return false; 	
	});
	$(".tab_content").hide(); 
		$("ul.tabs li:first").addClass("active").show();
		$(".tab_content:first").show(); 
		$("ul.tabs li").click(function() {

			$("ul.tabs li").removeClass("active"); 
				$(this).addClass("active"); 
			$(".tab_content").hide(); 

		var activeTab = $(this).find("a").attr("href"); 
		$(activeTab).fadeIn(); 
		return false;
	});
});
// NOTIFICATIONS
$(document).ready(function(){
    $(".box-close").click(function(){
    $(this).parent(".box").fadeOut('normal');
    })
});
// EVENTS
$(document).ready(function(){
	$('.eve-list tr td.link').click(function () {
		var href = $(this).attr('id');
		$(".loading").fadeIn("fast").delay(500);
		$("#content").hide().load("dates.html #"+href).delay(800).fadeIn("slow");
		$(".loading").fadeOut("fast");
	});	
});
$(document).ready(function(){	
	  $("td.link").click(function(){
	  	$("a.all").removeClass("active");
	    $(this).addClass("active").siblings("td.link").removeClass("active");
	    $(this).addClass("active").parent().siblings("tr").find("td.link").removeClass("active");
	  });
});
$(document).ready(function(){	
	$('.all').click(function () {
		var href = $(this).attr('id');
		$("td.link").removeClass("active");
		$(".loading").fadeIn("fast").delay(500);
		$("#content").hide().load("dates.html").delay(800).fadeIn("slow");
		$(".loading").fadeOut("fast");
	});
});
$(document).ready(function(){	
		$('a.all').click(
			function(){ $(this).addClass('active') 
		},
			function(){ $(this).removeClass('active') 
		})
});      	
// FANCYBOX
$(document).ready(function() {
	$(".fancybox").fancybox({
		openEffect	: 'elastic',
		closeEffect	: 'elastic',
		autoSize	: true,
		fitToView	: true
	});
});