var navbarOffset = 0;

$(document).ready(function () {
	setupHeader();
	setupNavbar();
	setupGallery();
	calcNavbarOffset();
	setupScrollLinks();
});

$(window).resize(function() {
	setupHeader();
	calcNavbarOffset();
});

function calcNavbarOffset() {
	if ($(window).width() >= 768) {
		navbarOffset = 0;
	}
	else {
		navbarOffset = 50;
	}
}

function setupHeader() {
	$('.jumbotron').css({ height: ($(window).height()) + 'px' });
	$('#overlay').css({
		'height': ($(window).height()) + 'px',
		'width': ($(window).width()) + 'px'
	});
}

function setupNavbar() {
	if ($(window).width() > 768) {
		$('.navbar').animate({left:'-87px'}, 1000);
		$('.navbar').hover(function() {
			$(this).stop().animate({left:'0px'}, 500);
		}, function() {
			$(this).stop().animate({left:'-87px'}, 500);
		});
	}
}

function setupGallery() {
	$('.gallery-container').each(function(index) {
		var bgimg = $(this).attr('bg');
		var descElem = $(this).find('.gallery-desc')[0];
		$(this).css('background-image', 'url(../img/' + bgimg + ')');
		//$(this).hover(galleryMouseIn(descElem), galleryMouseOut(descElem));
		if ($(window).width() > 768) {
			$(this).hover(function() {
				$(descElem).animate({top: "0px"}, 300);
			}, function() {
				$(descElem).animate({top: "100px"}, 300);
			});
		}
		else {
			$(descElem).css('top', '0px');
		}
	});
}

// http://www.learningjquery.com/2007/10/improved-animated-scrolling-script-for-same-page-links
function filterPath(link) {
	return link
    .replace(/^\//,'')
    .replace(/(index|default).[a-zA-Z]{3,4}$/,'')
    .replace(/\/$/,'');
}

function scrollableElement(els) {
	for (var i = 0, argLength = arguments.length; i <argLength; i++) {
	    var el = arguments[i], $scrollElement = $(el);
	    if ($scrollElement.scrollTop()> 0) {
	    	return el;
	    } else {
	        $scrollElement.scrollTop(1);
	        var isScrollable = $scrollElement.scrollTop()> 0;
	        $scrollElement.scrollTop(0);
	        if (isScrollable) {
	          return el;
	        }
	    }
	}
    return [];
}

function setupScrollLinks() {
	var curPath = filterPath(location.pathname);
	var scrollElem = scrollableElement('html', 'body');
	
	$('a[href*=#]').each(function() {
	    var thisPath = filterPath(this.pathname) || curPath;
	    if (curPath == thisPath
	    	&& (location.hostname == this.hostname || !this.hostname)
	    	&& this.hash.replace(/#/,'') ) {
	      var $target = $(this.hash), target = this.hash;
	      if (target) {
	        var targetOffset = $target.offset().top - navbarOffset;
	        $(this).click(function(e) {
	          e.preventDefault();
	          $('#navigation-collapsible').collapse('hide');
	          $(scrollElem).animate({scrollTop: targetOffset}, 600, function() {
	            //location.hash = target;
	          });
	        });
	      }
	    }
  	});
}