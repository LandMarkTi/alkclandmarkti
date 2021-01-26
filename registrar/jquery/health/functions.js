(function($) {
	
	$.fn.disableMe = function(options){
		return $(this).each(function(){
			var settings = $.extend({
				classes		: ($(this).attr('data-classes')) ? $(this).attr('data-classes') : 'tooltipBox',
				attribute	: ($(this).attr('data-attribute')) ? $(this).attr('data-attribute') : 'disabled'
			}, options);
			
			$(this).bind('click mouseenter mouseleave focus blur change', function(e){
				if (!$(this).hasClass(settings.classes) && $(this).attr(settings.attribute) == undefined) return true;
				
				e.preventDefault();
				e.stopPropagation();
				return false;
			});
		});
	}
	
	$.fn.dismiss = function(){
		return $(this).each(function(){
			$(this).click(function(e){
				e.preventDefault();
				e.stopPropagation();
				
				$(this).parent('.' + $(this).attr('data-dismiss')).animate({opacity: 0}, 250).slideUp(250, function(){ $(this).remove(); });
				
				return false;
			});
		});
	}
	
	$.fn.tooltip = function(options){
		return this.each(function(){
			var settings = $.extend({
				classes			: ($(this).attr('data-classes')) ? $(this).attr('data-classes') : 'tooltipBox',
				text			: $(this).attr('data-text'),
				position		: ($(this).attr('data-position')) ? $(this).attr('data-position') : 'top center',
				target			: ($(this).attr('data-target')) ? $(this).attr('data-target') : 'event',
				showEvent		: ($(this).attr('data-show')) ? $(this).attr('data-show') : 'mouseenter',
				hideEvent		: ($(this).attr('data-hide')) ? $(this).attr('data-hide') : 'mouseleave'
			}, options);
			
			var positionSettings	= settings.position.split(' ');
			
			switch (positionSettings[0]) {
				case 'top':
					positionSettings[0] = 'bottom';
					break;
				case 'bottom':
					positionSettings[0] = 'top';
					break;
			}
			
			switch (positionSettings[1]) {
				case 'left':
					positionSettings[1] = 'right';
					break;
				case 'right':
					positionSettings[1] = 'left';
					break;
			}
			
			settings.tipPosition = positionSettings.join(' ');
			
			// qTip Plugin
			$(this).qtip({
				content: {
					text: settings.text
				},
				style: {
					classes: settings.classes,
					tip: {
						corner: true,
						width: 20,
						height: 12
					},
					def: false
				},
				position: {
					my: settings.tipPosition,
					at: settings.position,
					target: settings.target,
					adjust: { method: 'flip' }
				},
				show: {
					event: settings.showEvent,
					delay: 100,
					effect: function() {
						$(this).fadeIn(250);
					}
				},
				hide: {
					event: settings.hideEvent,
					delay: 200,
					effect: function() {
						$(this).fadeOut(250);
					},
					fixed: true
				}
			});
		});
	};
	
	$.fn.messageField = function(mode, options){
		return this.each(function(){
			var settings = $.extend({
				messageElement			: '<span></span>',
				messageElementClass		: 'help-block-message',
				iconElement				: '<i></i>',
				iconElementClass		: 'field-icon-message',
				parentIconClass			: 'iconedMessage',
				previousMessageClass	: 'help-block',
				previousIconClass		: 'field-icon'
			}, options);
			
			var parent			= $(this).parents($(this).attr('data-message-target') || '.controls');
			var message 		= $(this).attr('data-message') || false;
			var messageClass	= $(this).attr('data-message-class');
			var icon			= $(this).attr('data-message-icon') || false;
			
			if (!messageClass) return;
			
			if (mode) {
				if (!$(this).hasClass(messageClass)){
					$(this).addClass(messageClass);
					parent.addClass(messageClass);
					
					if (message) {
						parent.find('.' + settings.previousMessageClass).slideUp(250);
						
						var newMessage = $(settings.messageElement);
						newMessage.addClass(settings.messageElementClass);
						newMessage.addClass(messageClass);
						newMessage.html(message);
						
						parent.append(newMessage);
						newMessage.slideUp(0).slideDown(250);
					}
					
					if (icon) {
						parent.addClass(settings.parentIconClass);
						
						parent.find('.' + settings.previousIconClass).slideUp(250);
						
						var newIcon = $(settings.iconElement);
						newIcon.addClass(settings.iconElementClass);
						newIcon.addClass(messageClass);
						newIcon.addClass(icon);
						
						parent.prepend(newIcon);
						newIcon.slideUp(0).slideDown(250);
					}
				}
				
				return true;
			}
			
			// Reset
			$(this).removeClass(messageClass);
			parent.removeClass(messageClass);
			
			if (message) {
				parent.find('.' + settings.messageElementClass).slideUp(250, function(){ $(this).remove(); });
				parent.find('.' + settings.previousMessageClass).slideDown(250);
			}
			
			if (icon) {
				parent.find('.' + settings.iconElementClass).slideUp(250, function(){
					$(this).remove();
					
					parent.removeClass(settings.parentIconClass);
				});
				parent.find('.' + settings.previousIconClass).slideDown(250);
			}
			
			return false;
		});
	}
	
	$.fn.fullHeight = function(){
		return $(this).each(function(){
			var t = $(this);
			var w = $(window);
			var h = $(this).attr('data-height') || 0;
			var a = 0;
			
			if (t.index() == 0 && (!$('#header').hasClass('fixed') || $('html').hasClass('ie8'))) a = -$('#header').height();
			
			t.css('height', 'auto');
			
			if (t.height() < w.height()) t.css('height', w.height() + h + a + 'px');
		});
	}
	
	$.fn.verticalCenter = function(){
		return $(this).each(function(){
			var t = $(this);
			var p = $(this).parent();
			
			if (p.height() > t.height()){
				t.css('position', 'absolute');
				t.css('top', '50%');
				
				h = Math.round((t.height() / 2));
				
				if ($('#header').hasClass('floating')) h = h - (Math.floor($('#header').height() / 4));
				
				t.css('margin-top', '-' + h + 'px');
			} else {
				t.css('position', 'relative');
				t.css('margin-top', 0);
			}
		});
	}
	
	$.fn.horizontalCenter = function(){
		return $(this).each(function(){
			var t = $(this);
			var p = $(this).parent();
			
			if (p.width() > t.width()){
				t.css('position', 'absolute');
				t.css('left', '50%');
				t.css('margin-left', '-' + Math.floor(($(this).width() / 2)) + 'px');
			} else {
				t.css('position', 'relative');
				t.css('margin-left', 0);
			}
		});
	}
	
	$.fn.scrollToTarget = function(){
		return $(this).each(function(){
			$(this).click(function(e){
				e.stopPropagation();
				e.preventDefault();
				
				var target = $($(this).attr('href'));
				var hFix = ($('#header').hasClass('fixed') && !$('html').hasClass('ie8')) ? $('#header').height() : 0;
				
				if (target.length) {
					var min_height		= parseInt($(this).css('min-height').replace('px', ''));
					var target_offset	= target.offset();
					var target_top		= target_offset.top - (hFix + min_height);
			
					$('html, body').animate({scrollTop: target_top}, 500);
				}
				
				return false;
			});
		});
	}


}(jQuery));

(function(a){jQuery.browser.mobile=/android|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(ad|hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|symbian|tablet|treo|up\.(browser|link)|vodafone|wap|webos|windows (ce|phone)|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|e\-|e\/|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(di|rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|xda(\-|2|g)|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))})(navigator.userAgent||navigator.vendor||window.opera);



var Tracker = {
	event: function(category, action, label){
		ga('send', 'event', category, action, label);
	},
	pageview: function(page, title){
		ga('send', 'pageview', {
		  'page': page,
		  'title': title
		});
	}
}



function string_to_slug(str) {
  str = str.replace(/^\s+|\s+$/g, ''); // trim
  str = str.toLowerCase();
  
  // remove accents, swap ñ for n, etc
  var from = "àáäâãèéëêìíïîòóöôõùúüûñç·/_,:;";
  var to   = "aaaaaeeeeiiiiooooouuuunc------";
  for (var i=0, l=from.length ; i<l ; i++) {
    str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
  }

  str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
    .replace(/\s+/g, '-') // collapse whitespace and replace by -
    .replace(/-+/g, '-'); // collapse dashes

  return str;
}