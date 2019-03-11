(function( $ ){
	$.fn.tabs = function() {
		var $this = $(this);
		$this.find('>div').css('display', 'none');
		$this.find('.nav-tabs').find('li').find('a').click(function(){
			var action = $(this).attr('href');
			$this.find('.box-element').css('display', 'none');
			$this.find(action).css('display', 'block');
		});
		
		$this.find('#background').css('display', 'block');
	};
})( jQuery );