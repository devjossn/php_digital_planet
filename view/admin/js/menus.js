(function($) {
    "use strict";
    $.Menus = function(settings) {
        var config = {
            url: "",
        };
		
        if (settings) {
            $.extend(config, settings);
        }

        $('#contenttype').on('change', function() {
            var $icon = $(this).parent();
            $icon.addClass('loading');
            var option = $(this).val();
            $.get(config.url + "/helper.php", {
				action: "contenttype",
                type: option,
            }, function(json) {
                switch (json.type) {
                    case "page":
                        $("#contentid").show();
                        $("#webid").hide();
                        $('#page_id').html(json.message);
                        $('#page_id').prop('name', 'page_id');
                        break;

                    default:
                        $("#contentid").hide();
						$("#webid").show();
                        $('#page_id').prop('name', 'web_id');
                        break;
                }

                $icon.removeClass('loading');
            }, "json");
        });

        // sort menu
		$('#sortlist').nestable({
			maxDepth: 1
		}).on('change', function() {
			var json_text = $('#sortlist').nestable('serialize');
			$.ajax({
				cache: false,
				type: "post",
				url: config.url + "/helper.php",
				dataType: "json",
				data: {
					iaction: "sortMenus",
					sorting: JSON.stringify(json_text)
				}
			});
		}).nestable('collapseAll');
    };
})(jQuery);