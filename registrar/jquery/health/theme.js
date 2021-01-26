var mobileDevice = false;
var UIInterval = false;
var waitingUIUpdate = false;
var sk;
var plansCycle;
var ie8;
var win;
var hash;

$(function() {
	win = (navigator.appVersion.indexOf("Win") != -1);
	ie8 = $('html').hasClass('ie8');
	hash	= location.hash;
	
	// Customs
	if (win) {
		$('html').addClass('windows');
	}
	
	if (ie8) {
		$('#slider *[data-transition]').each(function(){$(this).attr('data-transition', '');});
	}
	
	$('#loginBox').slideUp(0);
	
	//var pathname = document.location.pathname.match(/[^\/]+$/);
	//if (pathname) $('#header ul li a[href="' + pathname[0] + '"]').parent().addClass('active');
	$('#header ul li a[href="' + window.location.pathname + '"]').parent().addClass('active');
	
	$('#header .loginButton').click(function(e){
		e.stopPropagation();
		e.preventDefault();
		
		if ($('#loginBox').hasClass('state-opened')) closeLoginBox();
		else openLoginBox();
		
		return false;
	});
	
	$('#mobileMenu').slideUp(0).addClass('hide-on-desktop');
	
	$('#header .mobileButton').click(function(e){
		e.stopPropagation();
		e.preventDefault();
		
		if ($('#mobileMenu').hasClass('state-opened')) closeMobileMenu();
		else openMobileMenu();
		
		return false;
	});
	
	$('#mobileMenu, #loginBox').click(function(e){
		e.stopPropagation();
		
		updateBoxUI($(this).attr('id'));
	});
	
	$(document).click(function(e){ updateBoxUI(); });
	
	$('form').each(function(){
		var t = $(this);
		
		if (t.hasClass('validate')) {
			var validationTrigger = t.attr('data-validation') || 'blur';
			
			t.validationEngine('attach', {
				validationEventTrigger: validationTrigger,
				scroll: false,
				focusFirstField: false,
				showPrompts: false,
				onFieldSuccess: function(field){
					$(field).messageField(false);
				},
				onFieldFailure: function(field){
					$(field).messageField(true);
				},
				onValidationComplete: function(form, status){
					t.find('.messages div').slideUp(250);
					
					t.attr('data-validation', status);
				}
			});
		}
		
		if (t.hasClass('ajaxForm')) {
			t.find('.messages div').slideUp();
			
			t.submit(function(e){
				e.preventDefault();
				e.stopPropagation();
				
				if (t.attr('data-validation') == 'false') return;
				
				t.find('.messages div').slideUp(250);
				
				var bs			= t.find('button[type="submit"]');
				var bsl			= bs.html();
				var formData	= new FormData(t[0]);
				
				bs.attr('disabled', 'disabled');
				bs.html('Enviando...');
				
				$.ajax({
					url: t.attr('action'),
					type: 'POST',
					data: formData,
					async: false,
					cache: false,
					contentType: false,
					processData: false,
					error: function(){
						t.find('.messages .error').slideDown(250);
						
						bs.removeAttr('disabled');
						bs.html(bsl);
					},
					success: function (data) {
						
						if(t.hasClass("form-download")) {
							window.location = '/dowload-pdf/' + data.id;
						}
						
						t.append("<iframe style='width:0; height:0;' src='/conversion'></iframe>");
						var page = window.location.pathname + ($("select[name='profile']").length == 0 ? "sucesso/" : (string_to_slug($("select[name='profile'] option:selected").text()) + "/sucesso/" ) );
						var title = $("title").text() + " - Sucesso";

						Tracker.pageview(page, title);

						if (data){
							t.find('.messages .success').slideDown(250);
						}
						else t.find('.messages .error').slideDown(250);
						
						bs.removeAttr('disabled');
						bs.html(bsl);

					}
				});
			});
		}
		
		if (t.find('.icon-search')) {
			t.find('.icon-search').click(function(e){
				e.preventDefault();
				e.stopPropagation();
				
				t.submit();
			});
		}



	});
	
	$('#search input[name="search"]').autocomplete({
		appendTo: $('#search .autocomplete-target'),
		//source: 'json.php',
		source:  function( request, response ) {
			$.ajax ({
				url: "/api/medicalnetwork/suggestions/",
				dataType: "json",
				data: {
					term: request.term
				},
				success: function( data ) {					
					response( $.map( data, function( item ) {
						return {
							label: item.phrase,
							value: item.phrase
						}
					}));
				}
			});
		},
		minLength: 2,
		open: function(e, ui ){
			
		},
		select: function(e, ui) {
			$('#search input[name="search"]').val(ui.item.label);
			
			var selectedPlan = $('#search form').find("select[name=plan] option:selected").val();
			var query = $('#search form').find("input[name=search]").val();

			var url = $('#search form').attr("action") + (selectedPlan == '0' ? query : (selectedPlan + '/' + query));

			window.location = encodeURI(url.replace(/ /g,'-'));

			//$('#search form').submit();
		}
	});
	$('#search form').submit(function(e){
		e.stopPropagation();
		e.preventDefault();
		
		var selectedPlan = $('#search form').find("select[name=plan] option:selected").val();
		var query = $('#search form').find("input[name=search]").val();

		var url = $('#search form').attr("action") + (selectedPlan == '0' ? query : (selectedPlan + '/' + query));

		window.location = encodeURI(url.replace(/ /g,'-'));
	});
	
	$('#searchPage a.loadMore').on("click" ,function(e){
		e.stopPropagation();
		e.preventDefault();
		
		loadMoreResults($(this));
	});
	
	$('#contactPage select[name="profile"]').change(updateContactForm);
	initializeContactForm();
	
	$('#signInPage .empty').hide(0);
	$('#signInPage select[name="type"]').change(updateSignInForm);
	initializeSignInForm();
	
	$('#plans .priceContent .controlsContainer').hide(0);
	$('#plans .priceContent').hide(0);
	
	$('#plans .details .planBox .price a').each(function(){
		$(this).click(function(e) {
			e.stopPropagation();
			e.preventDefault();
			
			updatePlansPricesTable($(this));
			
			return false;
		});
	});
	
	$('#footer .social a').each(function(){
		var t	= $(this);
		var h	= t.attr('href');
		
		t.attr('href', h.replace('URLENCODED_URL', encodeURI(window.location.href)));
		
		t.click(socialShare);
	});
	
	mobileDevice = /ipad|iphone|ipod|android|blackberry|windows phone|tablet/i.test(navigator.userAgent.toLowerCase());
	
	if (!mobileDevice)
	{
		var tHeader = $('#header');
		
		tHeader.addClass('fixed');
		tHeader.addClass('floating');
		
		if ($('#body-content').hasClass('skrollr-enabled') && !ie8) {
			sk = skrollr.init({
				forceHeight: false,
				smoothScrolling: true
			});
		}
		
		if (!$('#body-content').hasClass('no-header-spacer')) $('#headerSpacer').show(0);
	} else {
		$('#plans .priceContent .container').touchwipe({
			wipeLeft: function() { if (plansCycle) plansCycle.cycle('next'); },
			wipeRight: function() { if (plansCycle) plansCycle.cycle('prev'); },
			min_move_x: 20,
			preventDefaultEvents: false
		});
	}
	
	// Buttons
	$('.button-disabled, :disabled').disableMe({ classes: 'button-disabled' });
	$('*[data-dismiss]').dismiss();
	
	$('.tooltip').tooltip();
	
	$('.skip-bar a').scrollToTarget();
	
	// Pretty Code
	window.prettyPrint && prettyPrint();
	
	// Forms
	$('.auto').autosize();
	$('.select').select2();
	$('.tags').tagsInput({width:'100%'});
	$('.tags_autoComplete').tagsInput({
		width:'100%'
	});
	
	$('.limited').each(function(){
		var limit		= $(this).attr('data-limit');
		var boxId		= $(this).attr('data-limit-target');
		var remText		= ($(this).attr('data-limit-rem')) ? $(this).attr('data-limit-rem') : '%n caractere%s restantes.';
		var limitText	= ($(this).attr('data-limit-message')) ? $(this).attr('data-limit-message') : 'Máximo %n caractere%s.';
		
		$(this).inputlimiter({
			limit: limit,
			boxId: boxId,
			boxAttach: false,
			remText: remText,
			limitText: limitText,
			limitTextShow: false
		});
	});
	
	$('.select').each(function(){
		var placeholder = $(this).attr('data-placeholder');
		var maximum = $(this).attr('data-maximum');
		var minimum = $(this).attr('data-minimum');
		
		var allowClear = $(this).hasClass('allowClear');
		
		$(this).select2({
			placeholder: placeholder,
			maximumSelectionSize: maximum,
			minimumInputLength: minimum,
			allowClear: allowClear
		});
	});
	
	$('.styled').uniform({
		radioClass: 'choice',
		fileDefaultText: 'Nenhum arquivo selecionado',
		fileBtnText: 'Escolher arquivo'
	});
	
	$(window).resize(onResizeHandler);
	
	onResizeHandler();
});

function onResizeHandler(){
	// This is used by iOS resize handler to get right dimensions.
	if (waitingUIUpdate == false) {
		UIInterval = setInterval(updateUI, 250);
		
		waitingUIUpdate = true;
	}
}

function updateUI(){
	var tBody	= $('#body-content');
	var tHeader	= $('#header');
	var tFooter	= $('#footer-content');
	
	$('#searchPage .tableContent').css('height', $('#moreTarget').height());
	
	$('#plans .priceContent .container').css('height', $('#plans .priceContent .container .planTable').height() + 'px');
	
	$('.full-height').fullHeight();
	$('.vertical-center').verticalCenter();
	
	var minHeight = $(window).height() - tFooter.height();
	if (ie8) minHeight = $(window).height() - (tHeader.height() + tFooter.height());
	
	tBody.css('min-height', minHeight);
	if (!ie8) tBody.css('margin-bottom', tFooter.height() - 30);
	
	if (sk !== undefined) sk.refresh();
	
	clearInterval(UIInterval);
	
	waitingUIUpdate = false;
}

function updateBoxUI(target){
	var loginBox = $('#loginBox');
	var mobileMenu = $('#mobileMenu');
	
	if (target !== 'loginBox' && loginBox.hasClass('state-opened')) closeLoginBox();
	if (target !== 'mobileMenu' && mobileMenu.hasClass('state-opened')) closeMobileMenu();
}

function openLoginBox(){
	var t = $('#header .loginButton');
	var loginBox = $('#loginBox');
	
	t.addClass('button-hover');
	loginBox.addClass('state-opened');
	loginBox.slideDown(250, 'easeInQuad');
	
	updateBoxUI('loginBox');
}

function closeLoginBox(){
	var t = $('#header .loginButton');
	var loginBox = $('#loginBox');
	
	t.removeClass('button-hover');
	loginBox.removeClass('state-opened');
	loginBox.slideUp(250, 'easeOutQuad');
}

function openMobileMenu(){
	var t = $('#header .mobileButton');
	var mobileMenu = $('#mobileMenu');
	
	t.addClass('button-hover');
	mobileMenu.addClass('state-opened');
	mobileMenu.slideDown(250, 'easeInQuad');
	
	updateBoxUI('mobileMenu');
}

function closeMobileMenu(){
	var t = $('#header .mobileButton');
	var mobileMenu = $('#mobileMenu');
	
	t.removeClass('button-hover');
	mobileMenu.removeClass('state-opened');
	mobileMenu.slideUp(250, 'easeOutQuad');
}




function loadMoreResults(target){
	if (target.hasClass('disabled')) return;
	
	target.find('b').html(target.attr('data-loading'));
	target.addClass('disabled');
	
	$.ajax({
		url: target.attr('href'),
		dataType: 'html',
		error: function(jqXHR, textStatus, errorThrown){
			target.find('b').html(target.attr('data-waiting'));
			target.removeClass('disabled');
		},
		success: function(data){
			var dataTarget = $(target.attr('data-target'));

			$("#api_endpoint_url").val('/api'+target.attr('href'));

			var nextPageValue = $($(data)[$(data).length - 1]).val();

			
			target.attr('href', nextPageValue);
		
			dataTarget.append(data);
			dataTarget.parent().animate({height: dataTarget.height() + 'px'}, 500);
			
			refreshMap();

			if (typeof($($(data)[3]).val()) === 'undefined') return target.animate({opacity: 0}, 250).slideUp(250, function(){ $(this).remove(); });
			
			target.find('b').html(target.attr('data-waiting'));
			target.removeClass('disabled');
			
			
			if(nextPageValue == "")
				target.hide();
			

		}
	});
}


function updatePlansPricesTable(target){
	var pricesContent	= $('#plans .priceContent');
	var container		= pricesContent.find('.container');
	var rel				= parseInt(target.attr('rel')) - 1;
	
	if (pricesContent.is(':hidden')) {
		pricesContent.show();
		container.css('height', container.find('.planTable').height() + 'px');
		
		plansCycle = container.cycle({ 
			fx: 'scrollHorz',
			timeout: 0,
			speed:  500,
			startingSlide: rel,
			next: '#plansPriceContentNext', 
			prev: '#plansPriceContentPrev'
		});
		
		pricesContent.find('.controlsContainer').show();
		
		pricesContent.hide().slideDown(250);
	}
	
	// function.js->scrollToTarget clone
	var hFix = $('#header').hasClass('fixed') ? $('#header').height() : 0;
	
	if (target.length) {
		var target_offset	= pricesContent.offset();
		var target_top		= target_offset.top - (hFix + 50);

		$('html, body').animate({scrollTop: target_top}, 500);
	}
	//
	
	plansCycle.cycle(rel);
}

function initializeContactForm(){
	value = 0;
	
	switch (hash) {
		case '#nao-cliente':
			value = 1;
			break;
		case '#cliente':
			value = 2;
			break;
		case '#credenciado':
			value = 3;
			break;
		case '#corretor':
			value = 4;
			break;
	}
	
	if (value) $('#contactPage select[name="profile"]').find('option[value="' + value + '"]').attr('selected', 'selected');
	
	updateContactForm(0);
}

function updateContactForm(duration){
	if (duration == null || isNaN(duration)) duration = 250;
	
	var contactData			= $('#contactPage .contactData');
	var newData				= $('#contactPage .newData');
	var personalData		= $('#contactPage .personalData');
	var professionalData	= $('#contactPage .professionalData');
	var selected			= parseInt($('#contactPage select[name="profile"]').val());
	
	if (selected == 0) {
		return contactData.slideUp(duration, function(){
			newData.css('display', 'none');
			personalData.css('display', 'none');
			professionalData.css('display', 'none');
		});
	}
	
	if (contactData.is(':hidden')) {
		switch (selected) {
			case 1:
				newData.slideDown(0);
				break;
			case 2:
			case 4:
				personalData.slideDown(0);
				break;
			case 3:
				professionalData.slideDown(0);
				break;
		}
		
		return contactData.slideDown(duration);
	}
	
	var parts = [newData, personalData, professionalData];
	
	var toShow;
	
	switch (selected) {
		case 1:
			toShow = newData;
			break;
		case 2:
		case 4:
			toShow = personalData;
			break;
		case 3:
			toShow = professionalData;
			break;
	}
	
	for (i = 0; i < parts.length; i++) {
		if (parts[i] == toShow) parts[i].delay(duration).slideDown(duration);
		else parts[i].slideUp(duration);
	}
	
	return true;
}

function initializeSignInForm(){
	value = 0;
	
	switch (hash) {
		case '#cliente':
			value = 1;
			break;
		case '#corretor':
			value = 2;
			break;
		case '#credenciado':
			value = 3;
			break;
	}
	
	if (value) $('#signInPage select[name="type"]').find('option[value="' + value + '"]').attr('selected', 'selected');
	
	updateSignInForm(0);
}

function updateSignInForm(duration){
	if (duration == null || isNaN(duration)) duration = 250;
	
	var signInData			= $('#signInPage .signInData');
	var signInBackground	= $('#signInPage .empty');
	var personalData		= $('#signInPage .personalData');
	var professionalData	= $('#signInPage .professionalData');
	var selected			= parseInt($('#signInPage select[name="type"]').val());
	
	if (selected == 0) {
		signInBackground.fadeOut(duration);
		
		return signInData.slideUp(duration, function(){
			personalData.css('display', 'none');
			professionalData.css('display', 'none');
		});
	}
	
	if (signInData.is(':hidden')) {
		signInBackground.css('background-position-y', '-' + parseInt((selected - 1) * 700) + 'px');
		signInBackground.fadeIn(duration);
		
		if (selected < 3) personalData.slideDown(0);
		else professionalData.slideDown(0);
		
		return signInData.slideDown(duration);
	}
	
	signInBackground.fadeOut(duration, function(){
		signInBackground.css('background-position-y', '-' + parseInt((selected - 1) * 700) + 'px');
		signInBackground.fadeIn(duration);
	});
	
	// Personal Data
	if (selected < 3) {
		if (professionalData.is(':hidden')) return personalData.slideDown(duration);
		
		return professionalData.slideUp(duration, function(){
			personalData.slideDown(duration);
		});
	}
	
	// User Data
	if (personalData.is(':hidden')) return professionalData.slideDown(duration);
	
	return personalData.slideUp(duration, function(){
		professionalData.slideDown(duration);
	});
}

function socialShare(e) {
	e.stopPropagation();
	e.preventDefault();
	
	var t = $(e.currentTarget);
	
	window.open(t.attr('href'), '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');
	
	return false;
}