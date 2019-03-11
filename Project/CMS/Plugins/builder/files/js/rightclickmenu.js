(function( $ ){
	var changefluidclass = function(element1, element2) {
		var classes = element1.attr('class');
		if(classes.indexOf(element2 + '-fluid') >= 0){
			$('body iframe.content').contents().find('body').find(element1).removeClass(element2 + '-fluid');
			$('body iframe.content').contents().find('body').find(element1).addClass(element2);
		} else if (classes.indexOf(element2 + '-fluid') == -1){
			$('body iframe.content').contents().find('body').find(element1).removeClass(element2);
			$('body iframe.content').contents().find('body').find(element1).addClass(element2 + '-fluid');
		}
	};
	
	var addrow = function(element, classes, sizes){
		var random_number = Math.floor((Math.random() * 10000) + 1);
		var row = $('<div class="row ' + random_number + ' "><a class="delete-item" href="#">Delete Row</a></div>');
		
		for(var i = 0; i < sizes; i++){
			var col = $('<div class="col ' + classes + ' ' + random_number + '"></div>');
			row.append(col);
		}
		
		$(element).append(row);
	};
	
	var addcontainer = function(element){
		var random_number = Math.floor((Math.random() * 10000) + 1);
		var container = $('<div class="' + random_number + ' container global"><a class="delete-item" href="#">Delete Container</a></div>');
		$(element).append(container);
	};
	
	var addsection = function(element){
		var random_number = Math.floor((Math.random() * 10000) + 1);
		var section = $('<section class="' + random_number + '"><a class="delete-item" href="#">Delete Section</a></section>');
		$(element).append(section);
	};
	
	var new_block;
	var parent_block;	
	
	$.fn.rightclickmenu = function(filename, string) {
		var ctrlDown = false,
			ctrlKey = 17,
			cmdKey = 91,
			vKey = 86,
			cKey = 67;
	
		$("body iframe.content").contents().keydown(function(event) {
			if (event.keyCode == ctrlKey || event.keyCode == cmdKey) ctrlDown = true;
		}).keyup(function(event) {
			if (event.keyCode == ctrlKey || event.keyCode == cmdKey) ctrlDown = false;
		});
	
		$("body iframe.content").contents().keydown(function(event) {
			if (ctrlDown && event.keyCode == vKey) {
				if(new_block){
					if($(this).find(parent_block).length){
						parent_block.append(new_block);
						new_block = new_block.clone(true);
					}
				}
			}
		});
		$("body iframe.content").contents().bind('click', function (event) {
			parent_block = $(event.target);
		});
		
		$(this).unbind('mouseup');
		$(this).mouseup(function(e) {
			if(e.target.node != 'a'){
				e.stopPropagation();
			}
			
			if(e.button == 0) {
				$(".rightclickmenu").hide();
			}
			if(e.button == 2) {
				if($(e.target).closest('#page').length){
					var iframepos = $('body iframe').position();
					x = e.clientX + iframepos.left; 
					y = e.clientY + iframepos.top;
				} else {
					x = e.pageX; 
					y = e.pageY;
				}
				
				$('.rightclickmenu').css({ top: y, left: x, position: 'absolute', display: 'block' });
				$('.rightclickmenu').find('a').unbind('click');
				$('.rightclickmenu').find('a').click(function() {
					$(document).unbind('click')
					var action = $(this).attr('href');
					action = action.replace( /#/, "" );
					if(action == 'setting'){
						$(e.target).windowproperty(filename, string);
					}
					if(action == 'clearstyle'){
						$(e.target).clearStyle(filename);
					}
					if(action == 'copy'){
						new_block = $(e.target).clone(true);
						parent_block = $(e.target).parent();
						new_block.append($('<a class="delete-item">Delete Item</a>'));
					}
					if(action == 'cut'){
						new_block = $(e.target);
						$(e.target).remove();
					}
					if(action == 'paste'){
						$(e.target).append(new_block);
						new_block = new_block.clone(true);
					}
					if(action == 'delete'){
						if($(e.target).attr('class') != 'delete-item'){
							$(e.target).remove();
						}
					}
					if(action == 'addrow1'){
						addrow(e.target, 'col-lg-12 col-md-12 col-sm-12 col-xs-12', 1);
					}
					if(action == 'addrow2'){
						addrow(e.target, 'col-lg-6 col-md-6 col-sm-12 col-xs-12', 2);
					}
					if(action == 'addrow3'){
						addrow(e.target, 'col-lg-4 col-md-4 col-sm-12 col-xs-12', 3);
					}
					if(action == 'addrow4'){
						addrow(e.target, 'col-lg-3 col-md-3 col-sm-12 col-xs-12', 4);
					}
					if(action == 'addrow6'){
						addrow(e.target, 'col-lg-2 col-md-2 col-sm-3 col-xs-12', 6);
					}
					if(action == 'addrow12'){
						addrow(e.target, 'col-lg-1 col-md-1 col-sm-1 col-xs-1', 12);
					}
					if(action == 'addcontainer'){
						addcontainer(e.target);
					}							
					if(action == 'addsection'){
						addsection(e.target);
					}
					if(action == 'normalfluid'){
						if($(e.target).closest('.row').length){
							changefluidclass($(e.target).closest('.row'), 'row');
						} else if ($(e.target).closest('.row-fluid').length) {
							changefluidclass($(e.target).closest('.row-fluid'), 'row');
						} else if ($(e.target).closest('.container').length) {
							changefluidclass($(e.target).closest('.container'), 'container');
						} else if ($(e.target).closest('.container-fluid').length) {
							changefluidclass($(e.target).closest('.container-fluid'), 'container');
						}
					}
					if(action == 'moveup'){
						if($(e.target).closest('.widget-block').length){
							$($(e.target).closest('.widget-block').prev()).before($(e.target).closest('.widget-block'));
						} else if ($(e.target).closest('.row').length) {
							$($(e.target).closest('.row').prev()).before($(e.target).closest('.row'));
						} else if ($(e.target).closest('section').length) {
							$($(e.target).closest('section').prev()).before($(e.target).closest('section'));
						}
					}
					if(action == 'movedown'){
						if($(e.target).closest('.widget-block').length){
							$($(e.target).closest('.widget-block').next()).after($(e.target).closest('.widget-block'));
						} else if ($(e.target).closest('.row').length) {
							$($(e.target).closest('.row').next()).after($(e.target).closest('.row'));
						} else if ($(e.target).closest('section').length) {
							$($(e.target).closest('section').next()).after($(e.target).closest('section'));
						}
					}
					
					$('.rightclickmenu').hide();
				});
			}
		});
	};
	
	$.fn.rightclickmenu2 = function() {
		$(this).unbind('mouseup');
		
		$(this).mouseup(function(e) {
			if(e.target.node != 'a'){
				e.stopPropagation();
			}
			
			if(e.button == 0) {
				$(".rightclickmenu2").hide();
			}
			if(e.button == 2) {
				if($(e.target).closest('#page').length){
					var iframepos = $('body iframe').position();
					x = e.clientX + iframepos.left; 
					y = e.clientY + iframepos.top;
				} else {
					x = e.pageX; 
					y = e.pageY;
				}
				
				$('.rightclickmenu2').css({ top: y, left: x, position: 'absolute', display: 'block' });
				$('.rightclickmenu2').find('a').unbind('click');
				$('.rightclickmenu2').find('a').click(function() {
					$(document).unbind('click')
					var action = $(this).attr('href');
					action = action.replace( /#/, "" );
					if(action == 'copy'){
						new_block = $(e.target).clone(true);
						new_block.append($('<a class="delete-item">Delete Item</a>'));
					}
					
					$('.rightclickmenu2').hide();
				});
			}
		});
	};
})( jQuery );