(function($) {
    "use strict";
    $.Products = function(settings) {
        var config = {
            url: "",
            lang: {
                err: "Error",
                err1: "Invalid file type!",
				name: "Name",
				price: "Price",
				symbol: "$",
				cdkey: "CD Keys",
				currency: "CAD",
            }
        };
        if (settings) {
            $.extend(config, settings);
        }

        var timeout;

        // item history
        if ($.inArray("history", $.url().segment()) !== -1) {
            $("#payment_chart").parent().addClass('loading');
            $.ajax({
                type: 'GET',
                url: config.url + '/helper.php',
                data: {
                    action: "itemChart",
                    id: $.url().segment(-1)
                },
                dataType: 'json'
            }).done(function(json) {
                var legend = '';
                json.legend.map(function(val) {
                    legend += val;
                });
                $("#legend").html(legend);
                Morris.Line({
                    element: 'payment_chart',
                    data: json.data,
                    xkey: 'm',
                    ykeys: json.label,
                    labels: json.label,
                    parseTime: false,
                    lineWidth: 4,
                    pointSize: 6,
                    lineColors: json.color,
                    gridTextColor: "rgba(0,0,0,0.6)",
                    gridTextSize: 12,
                    fillOpacity: '.75',
                    hideHover: 'auto',
                    preUnits: json.preUnits,
                    hoverCallback: function(index, json, content) {
                        var text = $(content)[1].textContent;
                        return content.replace(text, text.replace(json.preUnits, ""));
                    },
                    smooth: true,
                    resize: true,
                });
                $("#payment_chart").parent().removeClass('loading');
            });
        }

        // sort images
        $("#sortable").sortable({
            ghostClass: "ghost",
            animation: 600,
            onUpdate: function() {
                var order = this.toArray();
                $.post(config.url + '/helper.php', {
                    iaction: "sortImages",
                    sorting: order
                }, function() {}, "json");

            }
        });

        // add images
        $('#images').simpleUpload({
            url: config.url + '/helper.php',
            types: ['jpg', 'png', 'JPG', 'PNG'],
            error: function(error) {
                if (error.type === 'fileType') {
                    $.wNotice(config.lang.err1, {
                        autoclose: 12000,
                        type: "error",
                        title: config.lang.err
                    });
                }
            },
            beforeSend: function() {
                $('#sortable').closest('.segment').addClass('loading');
            },
            success: function(data) {
                $('#sortable').prepend(data).sortable();
                $('#sortable').closest('.segment').removeClass('loading');
            }
        });

        // filter files
        $("#filter input").on("keyup", function() {
            window.clearTimeout(timeout);
            var filter = $(this).val(),
                count = 0;
            timeout = window.setTimeout(function() {
                $("#fsearch .item").each(function() {
                    if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                        $(this).fadeOut(100);
                    } else {
                        $(this).fadeIn(100);
                        count++;
                    }
                });
            }, 500);
        });

        // type switcher
        $("input[type=radio][name=type]").on("change", function() {
            switch ($(this).val()) {
                case 'affiliate':
                    $("#cdkey, #multi").fadeOut(120, function() {
                        $("#affiliate").fadeIn(120);
                    });

                    break;
					
                case 'cdkey':
                    $("#affiliate, #multi").fadeOut(120, function() {
                        $("#cdkey").fadeIn(120);
                    });
                    break;
					
                case 'multi':
                    $("#affiliate, #cdkey").fadeOut(120, function() {
                        $("#multi").fadeIn(120);
                    });
					
                    break;
                default:
                    $("#affiliate, #cdkey, #multi").fadeOut(100);
                    break;
            }
        });
		
        $('#btnAdd').on('click', function() {
			var id = randId();
            var html = ('' +
			  '<div class="wojo simple segment">' +
				'<div class="wojo fields align middle">' +
				 ' <div class="field">' +
					'<label>' + config.lang.name + ' <i class="icon asterisk"></i></label>' +
					'<input type="text" placeholder="Name" value="" name="vname['+id+']">' +
					'<div class="margin top">' +
					  '<label class="label">' + config.lang.price + ' <i class="icon asterisk"></i></label>' +
					  '<div class="wojo labeled input">' +
						'<span class="wojo simple label">' + config.lang.symbol + '</span>' +
						'<input type="text" placeholder="Price" value="" name="vprice['+id+']">' +
						'<div class="wojo simple label"><span class="wojo small text">' + config.lang.currency + '</span></div>' +
					  '</div>' +
					'</div>' +
				 '</div>' +
				  '<div class="field">' +
					'<label>' + config.lang.cdkey + ' <i class="icon asterisk"></i></label>' +
					'<textarea name="vkeys['+id+']"></textarea>' +
				  '</div>' +
				 ' <div class="field auto">' +
					'<a><i class="icon small negative trash"></i></a>' +
				 '</div>' +
				'</div>' +
				'</div>');
            $('#items').append(html);
        });

        $("#items, #multi").on('click', '.icon.trash', function() {
            $(this).closest('.segment').remove();
        });
		
		function randId() {
			return Math.floor(Math.random() * 90000000) + 10000000;
		}
    };
})(jQuery);