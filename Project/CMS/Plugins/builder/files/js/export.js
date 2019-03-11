(function( $ ){
	$.fn.exporting = function(css_filename, bootstrap_theme, template, path_images) {
		$('body').append($('<div class="new_content-30940239"></div>'));
		var html_content = $('body iframe.content').contents().find("body").find("#page").html();
		$('.new_content-30940239').append(html_content);
		$('.new_content-30940239').find('.delete-item').remove();
		//$('.new_content-30940239').find('*').removeAttr('style');
		$('.new_content-30940239').find('*').contents().each(function() {
			if(this.nodeType === Node.COMMENT_NODE) {
				$(this).remove();
			}
		});
		$('.new_content-30940239').htmlClean();
		html_content = $('.new_content-30940239').html();
		$('.new_content-30940239').remove();
		
		$(this).initExporting(html_content, css_filename, bootstrap_theme, template, path_images);
	};
	
	$.fn.use_content = function() {
		$('body').append($('<div class="new_content-30940239"></div>'));
		var html_content = $('body iframe.content').contents().find("body").find("#page").html();
		$('.new_content-30940239').append(html_content);
		$('.new_content-30940239').find('.delete-item').remove();
		$('.new_content-30940239').find('*').contents().each(function() {
			if(this.nodeType === Node.COMMENT_NODE) {
				$(this).remove();
			}
		});
		$('.new_content-30940239').htmlClean();
		html_content = $('.new_content-30940239').html();
		$('.new_content-30940239').remove();
		return html_content;
	};
	
	$.fn.htmlClean = function() {
		this.contents().filter(function() {
			if (this.nodeType != 3) {
				$(this).htmlClean();
				return false;
			}
			else {
				this.textContent = $.trim(this.textContent);
				return !/\S/.test(this.nodeValue);
			}
		}).remove();
		return this;
	}
	
	function removeParams(sParam) {
		var url = window.location.href.split('?')[0]+'?';
		var sPageURL = decodeURIComponent(window.location.search.substring(1)),
			sURLVariables = sPageURL.split('&'),
			sParameterName,
			i;
	 
		for (i = 0; i < sURLVariables.length; i++) {
			sParameterName = sURLVariables[i].split('=');
			if (sParameterName[0] != sParam) {
				url = url + sParameterName[0] + '=' + sParameterName[1] + '&'
			}
		}
		return url.substring(0,url.length-1);
	}
	
	$.fn.initExporting = function(html_content, css_filename, bootstrap_theme, template, path_images) {
		var data_to_send = {
			content: html_content,
			css_file: css_filename,
			bootstrap: bootstrap_theme,
			template: template,
			pathImages: path_images
		};
		
		$.ajax({
			method: "POST",
			url: "../Plugins/builder/files/export.php",
			data: data_to_send,
			dataType: 'json',
			success: function (data) { 
				alert("Saving/Export complete!");
				var url = removeParams("template");
				window.location.href = url;
			}
		});
	};
})( jQuery );