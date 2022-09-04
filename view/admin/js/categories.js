(function($) {
    "use strict";
    $.Categories = function(settings) {
        var config = {
            url: "",
            lang: {
                delMsg3: "",
                delMsg8: "",
                canBtn: "",
                trsBtn: "",
            }
        };
		
        if (settings) {
            $.extend(config, settings);
        }
		
        // delete category
        $(document).on('click', 'a.trashCategory', function() {
            var dataset = $(this).data("set");
            var $parent = $(this).closest(dataset.parent);

            var btnLabel = config.lang.trsBtn;
            var subtext = '<span class="wojo bold text">' + config.lang.delMsg8 + '</span>';
            var header = config.lang.delMsg3 + " <span class=\"wojo secondary text\">" + dataset.option[0].title + "?</span>";
            var content = "<img src=\"" + config.url + "/images/trash.svg\" class=\"wojo basic center notification image\">";

            $('<div class="wojo modal"><div class="dialog" role="document"><div class="content">' +
                '<div class="header"><h5>' + header + '</h5></div>' +
                '<div class="body center aligned">' + content + '<p class="margin top">' + subtext + '</p></div>' +
                '<div class="footer">' +
                '<button type="button" class="wojo small simple button" data="modal:close">' + config.lang.canBtn + '</button>' +
                '<button type="button" class="wojo small positive button" data="modal:ok">' + btnLabel + '</button>' +
                '</div></div></div></div>').modal().on('click', '[data="modal:ok"]', function() {
                $(this).addClass('loading').prop("disabled", true);

                $.ajax({
                    type: 'POST',
                    url: config.url + "/controller.php",
                    dataType: 'json',
                    data: dataset.option[0]
                }).done(function(json) {
                    if (json.type === "success") {
                        $($parent).transition("scaleOut", {
                            duration: 300,
                            complete: function() {
                                $($parent).remove();
                            }
                        });
                        $("#parent_id").html(json.menu);
                        $(".wojo.modal").find(".notification.image").attr("src", config.url + "/images/checkmark.svg").transition('rollInTop', {
                            duration: 500,
                            complete: function() {
                                $.modal.close();
                                $.wNotice(decodeURIComponent(json.message), {
                                    autoclose: 6000,
                                    type: json.type,
                                    title: json.title
                                });
                            }
                        });
                    }
                });
            });
        });

        // sort categories
		$('#sortlist').nestable({
			maxDepth: 4
		}).on('change', function() {
			var json_text = $('#sortlist').nestable('serialize');
			$.ajax({
				cache: false,
				type: "post",
				url: config.url + "/helper.php",
				dataType: "json",
				data: {
					iaction: "sortCategories",
					sorting: JSON.stringify(json_text)
				}
			});
		}).nestable('collapseAll');
    };
})(jQuery);