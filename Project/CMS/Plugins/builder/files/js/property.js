(function( $ ){
	$.fn.windowproperty = function(filename, path_image) {
		var node = $(this).prop("tagName");
		$(this).settingsInit(node, filename, path_image);
	};
	
	$.fn.settingsInit = function(node, filename, path_image) {
		$(this).render_element('element', filename, path_image);
	};
	
	var removeClassPrefix = function(string, prefix) {
		var classes = string.split(" ").filter(function(c) {
			return (c.lastIndexOf(prefix, 0) !== 0);
		});
		
		return $.trim(classes.join(" "));
	};
	
	$.fn.getPath = function () {
        var path, node = this;
        while (node.length) {
            var realNode = node[0], name = realNode.localName;
            if (!name) break;
            name = name.toLowerCase();
            var parent = node.parent();
			if($.trim(realNode.className) != ''){
				var classes = removeClassPrefix(realNode.className, 'init-');
				classes = removeClassPrefix(classes, 'col-');
				classes = removeClassPrefix(classes, 'row');
				classes = removeClassPrefix(classes, 'container');
				classes = classes.split(" ").filter(function(c) {
					return c.replace(/[0-9]/g, '');
				});
				classes = classes.join(" ")
				
				if(classes != ''){
					name += '.' + ($.trim(classes)).split(' ').join('.');
				}
			}
			
			if(classes == ''){
				if($(realNode).attr('id')){
					name += '#' + ($(realNode).attr('id'));
				}
			}
		
			path = name + (path ? ' > ' + path : '');
            node = parent;
        }

        return path;
    }
	
	$.fn.submit_field = function($this, $selector, data) {
		var arr = [];
		var i = 0;
		$(this).find('.style').find($selector).each(function(index, element) {
			var new_value = $(element).val();
			var property = $(element).attr('data-property');
			if(new_value != ''){
				arr[i] = property + ':' + new_value + ';';
				i++;
			}
		});
		return arr;
	};
	
	$.fn.submit_content = function($this, $selector, data) {
		$(this).find('.content').find($selector).each(function(index, element) {
			var new_value = $(element).val();
			$this.html(new_value);
		});
	};
	
	$.fn.submit_attribute = function($this, $selector, data) {
		$(this).find('.attr').find($selector).each(function(index, element) {
			var new_value = $(element).val();
			var property = $(element).attr('data-attribute');
			if(new_value != ''){
				$this.attr(property, new_value);
			}
		});
	};
	
	$.fn.removeClassPrefix = function(prefix) {
		this.each(function(i, el) {
			var classes = el.className.split(" ").filter(function(c) {
				return c.lastIndexOf(prefix, 0) !== 0;
			});
			el.className = $.trim(classes.join(" "));
		});
		return this;
	};
	
	$.fn.toolTipNode = function(container, event, onExtraIframe) {
		var element = event.target;
		var node = element.nodeName;
		var classes = $(element).attr('class');
		if(classes == null){ classes = ''; } else { classes = classes; }
		$(this).text(node + '.' + classes);
		$(this).css('position', 'fixed');
		
		if(onExtraIframe.length){
			var iframepos = onExtraIframe.position();
			var x = (event.clientX + iframepos.left) - ($(document).scrollLeft()); 
			var y = (event.clientY + iframepos.top) - ($(document).scrollTop());
			$(this).css('left', (x) + 'px');
			$(this).css('top', (y - 50) + 'px');
		} else {
			$(this).css('left', (event.pageX - 50) + 'px');
			$(this).css('top', (event.pageY - 50) + 'px');
		}
	};
	
	$.fn.reloadStylesheets = function(src) {
		var queryString = '?reload=' + new Date().getTime();
		$("body iframe.content").contents().find("head").find('link[href*="' + src + '"]').each(function () {
			this.href = this.href.replace(/\?.*|$/, queryString);
		});
	};
	
	$.fn.reloadJavascript = function(src) {
		var queryString = '?reload=' + new Date().getTime();
		$("body iframe.content").contents().find("head").find('script[src*="' + src + '"]').each(function () {
			this.src = this.src.replace(/\?.*|$/, queryString);
		});
	};
	
	$.fn.render_process = function($this, name, data, filename, path_image) {
		if($('body').find('#myModal').length > 0){
			$('body').find('#myModal').remove();
			$('body').find('.trigger').remove();
		}
		
		var content = $.post("../Plugins/builder/files/js/nodes/element.php", data).done(function( info ) {
			$('body').append(info);
			$('body').find('#myModal').modal();
			var modal = $('body').find('#myModal');
			var form = modal.find('form');
			
			if(form.find('#tabs').length){
				form.find('#tabs').tabs();
			}
			
			if(form.find('.upload').length){
				form.find('.upload').bind('click', function (e) {
					$('#popup').modal('show');
				});
			}
			
			if(form.find('.selecting-file').length && form.find('.refresh-files').length){
				form.find('.refresh-files').bind('click', function (event) {
					var $select = $(this).prev();
					var $attribute = $select.attr('data-property');
					var initial = {
						start_value: data[$attribute],
						pathImages: path_image
					};
					var allFiles = $.get("../Plugins/builder/files/js/nodes/allFiles.php", initial).done(function( information ) {
						$select.html(information);
					});
				});
				form.find('.refresh-files').click();
			}
			
			form.find('.reset').bind('click', function (e) {
				$(this).closest('div').find("input,select").val('');
				$(this).closest('div').find("input[type=checkbox], input[type=radio]").prop("checked", "");
			});
			
			form.bind('submit', function() {
				form.submit_attribute($this, 'input[type="text"]', data);
				form.submit_attribute($this, 'select', data);
				form.submit_attribute($this, 'textarea', data);
				form.submit_content($this, 'textarea', data);
				var data1 = form.submit_field($this, 'input[type="text"]', data);
				var data2 = form.submit_field($this, 'select', data);
				var data3 = form.submit_field($this, 'textarea', data);
				var full_data = data1.concat(data2, data3);
				var full_path = $this.getPath();
				var data_to_send = {
					path: full_path,
					css: $.extend({}, full_data),
					file: filename
				};
				
				$.ajax({
				  method: "POST",
				  url: "../Plugins/builder/files/style/post_to_css.php",
				  data: data_to_send
				}).done(function() {
					alert("CSS Updated!");
				});
				
				$('body').reloadStylesheets(filename);
				
				return false;
			});
			
			modal.find('button[type="submit"]').bind('click', function() {
				form.submit();
			});
			$('body').find('button[data-toggle="modal"]').click();
	  	});
		
	};
	
	$.fn.clearStyle = function(filename) {
		var full_path = $(this).getPath();
		var data_to_send = {
			path: full_path,
			file: filename
		};
		
		$.ajax({
		  method: "POST",
		  url: "../Plugins/builder/files/style/clear_style.php",
		  data: data_to_send
		}).done(function() {
			alert( "Style Cleared!" );
		});
		
		$('body').reloadStylesheets(filename);
	};
	
	$.fn.clearCSS = function(filename) {
		var data_to_send = {
			file: filename
		};
		
		$.ajax({
		  method: "POST",
		  url: "../Plugins/builder/files/style/clear_css.php",
		  data: data_to_send
		}).done(function() {
			alert( "CSS Cleared!" );
		});
		
		$('body').reloadStylesheets(filename);
	};
	
	$.fn.copyCSS = function (style1) {
        var returns = {
			'background-attachment' : '',
			'background-blend-mode' : '',
			'background-clip' : '',
			'background-color' : '',
			'background-image' : '',
			'background-origin' : '',
			'background-position' : '',
			'background-position-x' : '',
			'background-position-y' : '',
			'background-repeat' : '',
			'background-size' : '',
			'width' : '',
			'height' : '',
			'display' : '',
			'padding-top' : '',
			'padding-right' : '',
			'padding-bottom' : '',
			'padding-left' : '',
			'margin-top' : '',
			'margin-right' : '',
			'margin-bottom' : '',
			'margin-left' : '',
			'font-size' : '',
			'font-weight' : '',
			'color' : '',
			'text-decoration' : '',
			'border-bottom-color' : '',
			'border-bottom-left-radius' : '',
			'border-bottom-right-radius' : '',
			'border-bottom-style' : '',
			'border-bottom-width' : '',
			'border-left-color' : '',
			'border-left-style' : '',
			'border-left-width' : '',
			'border-right-color' : '',
			'border-right-style' : '',
			'border-right-width' : '',
			'border-top-color' : '',
			'border-top-left-radius' : '',
			'border-top-right-radius' : '',
			'border-top-style' : '',
			'border-top-width' : ''
		};
        
		for(var i in returns){
			if(style1[i]){
				returns[i] = style1[i];
			} else {
				returns[i] = '';
			}
		}
		return returns;
    };
	
	$.fn.copyAttr = function () {
		var attributes = $(this).prop("attributes");
		var s = {};
		$.each(attributes, function() {
			s[this.name] = this.value;
		});
		
		return s
	}
	
	$.fn.render_element = function(name, filename, path_image) {
		var $this = $(this);
		var data_to_send = {
			file: filename,
			element: $this.getPath()
		};
		var style;
		$.ajax({
		  method: "POST",
		  url: "../Plugins/builder/files/style/get_css.php",
		  data: data_to_send,
		  dataType: 'json',
		  success: function(data) {
			style = $this.copyCSS(data.array);
		  }
		}).done(function(){
			var attr = $this.copyAttr();
			var content = { editor: $this.html()};
			var data = $.extend(style, attr, content);
			$this.render_process($this, name, data, filename, path_image);
		});
	};
	
})( jQuery );