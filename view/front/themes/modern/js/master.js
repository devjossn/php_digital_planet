(function($) {
    "use strict";
    $.Master = function(settings) {
        var config = {
            weekstart: 0,
            ampm: 0,
            url: '',
            surl: '',
            theme: '',
            lang: {
                button_text: "Choose file...",
                empty_text: "No file...",
                monthsFull: '',
                monthsShort: '',
                weeksFull: '',
                weeksShort: '',
                weeksMed: '',
                today: "Today",
                now: "Now",
                delBtn: "Delete Record",
                trsBtn: "Move to Trash",
                arcBtn: "Move to Archive",
                uarcBtn: "Restore From Archive",
                restBtn: "Restore Item",
                canBtn: "Cancel",
                clear: "Clear",
				popular: "Popular",
                selProject: "Select Project",
                delMsg1: "Are you sure you want to delete this record?",
                delMsg2: "This action cannot be undone!!!",
                delMsg3: "Trash",
                delMsg5: "Move [NAME] to the archive?",
                delMsg6: "Remove [NAME] from the archive?",
                delMsg7: "Restore [NAME]?",
                delMsg8: "The item will remain in Trash for 30 days. To remove it permanently, go to Trash and empty it.",
                working: "working..."
            }
        };
        var timeout;

        if (settings) {
            $.extend(config, settings);
        }

        /* == Categories == */
		$(".top-menu").find('ul.menu-submenu').parent().children("a").append('<i class=\"icon chevron down\"></i>');
		$(".top-menu > li > ul:not(:has(ul))").addClass('normal-sub');
		$(".top-menu > li").hover(
			function (e) {
				if ($(window).width() > 768) {
					$(this).children("ul").fadeIn(100);
					e.preventDefault();
				}
			}, function (e) {
				if ($(window).width() > 768) {
					$(this).children("ul").fadeOut(150);
					e.preventDefault();
				}
			}
		);
		
		$(".top-menu > li").children("a").find(".icon.chevron").click(function(e) {
			var thisMenu = $(this).closest("li").children("ul");
			var prevState = thisMenu.css('display');
			var icon = $(this);
			$(".top-menu > li > ul").fadeOut();
			if ($(window).width() <= 768) {
				if(prevState !== 'block') {
					thisMenu.fadeIn(150);
					icon.addClass("vertically flipped");
				} else {
					icon.removeClass("vertically flipped");
				}
			}
			e.preventDefault();
		});
	
		$(".menu-mobile").click(function (e) {
			$(".top-menu").toggleClass('show-on-mobile');
			e.preventDefault();
		});

        /* == Vertical Menus == */
        $("ul.vertical-menu").find('ul.menu-submenu').parent().prepend('<i class=\"icon chevron down\"></i>');
        $('ul.vertical-menu .chevron.down').click(function() {
            var icon = this;
            $(this).siblings('ul.vertical-menu ul.menu-submenu').slideToggle(200);
            $(icon).toggleClass('vertically flipped');
        });
		
        // sticky menu desktop only
        if ($("#header").length) {
			$(window).on('scroll', function () {
				var scrollTop = $(this).scrollTop();
				if (scrollTop > 120) {
					$('#header').addClass('sticky');
					$('#header .top-bar').hide();
				} else {
					$('#header').removeClass('sticky');
					$('#header .top-bar').fadeIn();
				}
			});
			var scrollTop = $(window).scrollTop();
			if (scrollTop > 120) {
				$('#header').addClass('sticky');
				$('#header .top-bar').hide();
			} else {
				$('#header').removeClass('sticky');
				$('#header .top-bar').fadeIn();
			}
        }
		
        /* == Input focus == */
		$(document).on("focusout", '.wojo.input input, .wojo.input textarea', function() {
			$('.wojo.input').removeClass('focus');
        });
		$(document).on("focusin", '.wojo.input input, .wojo.input textarea', function() {
			$(this).closest('.input').addClass('focus');
        });
		
        /* == Cart Button == */
		$(".cartButton").click(function() {
			var button = $(this);
			if($("#cartList").hasClass("hide-all")) {
				$("#cartList").removeClass("hide-all").addClass("scaleIn");
			} else {
				$("#cartList").removeClass("scaleIn").addClass("hide-all");
			}
			
			if ($("#cartList").children(".list").children().length === 0) {
				button.addClass('loading');
                $.get(config.url + "/controller.php", {
                    action: 'smallCart',
					url: ($.url().segment(-1) ? $.url().segment(-1) : "index"),
                }, function(json) {
                    $("#cartList").children(".list").html(json.html);
                }, "json").done(function() {
                    button.removeClass('loading');
                });
			}
		});
			
        $('audio').audioPlayer();
        /* == Tabs == */
        $(".wojo.tabs").wTabs();

        /* == Progress Bars == */
        $('.wojo.progress').wProgress();
		
        /* == Number Spinner == */
        $(".wojo.input.number").wNumber();
		
        /* == Scrool to element == */
        $(document).on('click', '[data-scroll="true"]', function(event) {
            event.preventDefault();
            event.stopPropagation();
            var target = $(this).attr('href');
            $("html,body").animate({
                scrollTop: $(target).offset().top - 30
            }, "1000");
            return false;
        });

        /* == Login == */
        $("#backto").on('click', function() {
            $("#loginform").slideDown();
            $("#passform").slideUp();
        });
        $("#passreset").on('click', function() {
            $("#loginform").slideUp();
            $("#passform").slideDown();
        });

        $("#doLogin").on('click', function() {
            var $btn = $(this);
            $btn.addClass('loading');
            var username = $("input[name=username]").val();
            var password = $("input[name=password]").val();

            $.post(config.url + "/controller.php", {
                username: username,
                password: password,
                action: 'userLogin'
            }, function(json) {
                if (json.type === "error") {
                    $.wNotice(decodeURIComponent(json.message), {
                        autoclose: 6000,
                        type: json.type,
                        title: json.title
                    });
                } else {
                    window.location.href = (json.cart > 0) ? config.surl + '/cart/' : config.surl + '/dashboard/';
                }
                $btn.removeClass('loading');
            }, "json");
        });

        /* == Pass Reset == */
        $("#doPass").on('click', function() {
            var $btn = $(this);
            $btn.addClass('loading');
            var email = $("input[name=pEmail]").val();
            var fname = $("input[name=fname]").val();

            $.post(config.url + "/controller.php", {
                email: email,
                fname: fname,
                action: 'uResetPass'
            }, function(json) {
                $.wNotice(decodeURIComponent(json.message), {
                    autoclose: 6000,
                    type: json.type,
                    title: json.title
                });
                if (json.type === "success") {
                    $btn.prop("disabled", true);
                }
                $btn.removeClass('loading');
            }, "json");
        });

        /* == Small contact form == */
        $(document).on('click', '.fContact', function() {
            var parent = $(this).closest('.form');
            var name = parent.find('input[name=name]');
            var email = parent.find('input[name=email]');
            var message = parent.find('textarea[name=message]');
            var num = Math.floor(Math.random() * 90000) + 10000;
            parent.addClass("loading");

            $.post(config.url + "/controller.php", {
                action: 'contact',
                slug: 'index',
                captcha: num,
                name: name.val(),
                email: email.val(),
                notes: message.val(),
                front: true,
            }, function(json) {
                if (json.type === "success") {
                    name.val('');
                    email.val('');
                    message.val('');
                }
                setTimeout(function() {
                    parent.removeClass("loading");
                }, 500);
                $.wNotice(json.message, {
                    autoclose: 12000,
                    type: json.type,
                    title: json.title
                });
            }, "json");
        });

        /* == Wishlist Compare == */
        $(document).on('click', '.wishlist, .compare', function() {
            var $btn = $(this);
            var id = $btn.data('id');
            var type = $btn.hasClass('wishlist') ? 'wishlist' : 'compare';

            switch ($btn.data('layout')) {
                case "list":
                    $btn.children().addClass('primary spinning spin circles');
                    break;

                default:
                    $btn.children().addClass('spinning spin circles');
                    break;
            }

            $.post(config.url + "/controller.php", {
                action: 'wcomp',
                type: type,
                id: id,
            }, function(json) {
                if (json.type === "error") {
                    console.log("Invalid ID");
                }
                setTimeout(function() {
                    $btn.removeClass('wishlist compare');
                    $btn.children().removeClass('inverted spinning spin circles heart collection ');

                    switch ($btn.data('layout')) {
                        case "list":
                            $btn.children().addClass('primary check');
                            break;

                        default:
                            $btn.children().addClass('check');
                            break;
                    }
                }, 500);

            }, "json");
        });

        /* == Buy membership == */
        $(".mCart").on("click", function() {
            $("#mBlock .segment").removeClass('shadow');
            $(this).closest('.segment').addClass('shadow');
            var id = $(this).data('id');
			var button = $(this);
			button.addClass('loading').prop("disabled", true);
            $.post(config.url + "/controller.php", {
                action: "membership",
                id: id
            }, function(json) {
                $("#mResult").html(json.message);
				$("html,body").animate({
					scrollTop: $("#mResult").offset().top - 40
				}, "500");
				button.removeClass('loading').prop("disabled", false);
            }, "json");
        });

        /* == Membership gateways == */
        $("#mResult").on("click", ".sGateway", function() {
            $("#mResult .sGateway").removeClass('primary');
			var $this = $(this);
            $(this).addClass('primary loading');
            var id = $(this).data('id');
            $.post(config.url + "/controller.php", {
                action: "mGateway",
                id: id
            }, function(json) {
                $("#mResult #gdata").html(json.message);
				$this.removeClass('loading');
				$("html,body").animate({
					scrollTop: $("#mResult #gdata").offset().top - 40
				}, "500");
            }, "json");
        });
		
        /* == Language Switcher == */
        $('#dropdown-lMenu').on('click', 'a', function() {
            Cookies.set("LANG_DDP", $(this).data('value'), {
                expires: 120,
                path: '/',
				sameSite: 'lax'
            });
            $('main').transition('scaleOut', {
                duration: 1000,
                complete: function() {
                    window.location.href = $.url().attr('source');
                }
            });
            return false;
        });

        /* == Color Switcher == */
		$('#colorPanel').ColorPanel({
			style: '#styler',
			container: 'main',
			colors: {
				'#ffffff': config.theme + '/css/_default.css',
				'#2196F3': config.theme + '/css/colors/_blue.css',
				'#3F51B5': config.theme + '/css/colors/_indigo.css',
				'#00BCD4': config.theme + '/css/colors/_cyan.css',
				'#795548': config.theme + '/css/colors/_brown.css',
				'#E91E63': config.theme + '/css/colors/_pink.css',
				'#607D8B': config.theme + '/css/colors/_grey.css',
				'#009688': config.theme + '/css/colors/_teal.css',
				'#ff9800': config.theme + '/css/colors/_orange.css',
			}
		});
		
        /* == Add to cart == */
        $(document).on('click', 'a.add', function() {
            var id = $(this).data('id');
            var button = $(this);
            var qty = $('.input.number').children('input').length ? $('.input.number').children('input').val() : 1;

            button.addClass('loading');
            $.post(config.url + "/controller.php", {
                action: "add",
                id: id,
                qty: qty,
            }, function(json) {
                if (json.status === "success") {
                    $("#cartList .list").html(json.html);
                    $('#cTotal').text(json.counter);
                    button.children().removeClass('cart add').addClass('check');
                }
                setTimeout(function() {
                    button.removeClass('loading');
                }, 1200);

                $.wNotice(decodeURIComponent(json.message), {
                    autoclose: 12000,
                    duplicates: false,
                    type: json.type,
                    title: json.title
                });
            }, 'json');
        });

        /* == Apply coupon == */
        $('button[name=discount]').on('click', function() {
            var button = $(this);
            var coupon = $("input[name='coupon']").val();
            $(button).addClass("loading").prop("disabled", true);

            $.post(config.url + "/controller.php", {
                action: "coupon",
                coupon: coupon,
            }, function(json) {
                if (json.type === "success") {
                    $("#subtotal").text(json.subtotal);
                    $("#discount").html(json.coupon);
                    $("#tax").html(json.tax);
                    $("#total").text(json.total);
                }

                setTimeout(function() {
                    $(button).removeClass("loading").prop("disabled", false);
                }, 500);
                $.wNotice(json.message, {
                    autoclose: 12000,
                    type: json.type,
                    title: json.title
                });

            }, 'json');
        });

        //delete from cart
        $("#cartList").on('click', 'a.deleteItem', function() {
            var id = $(this).data('id');
            var item = $(this).closest('.item');

            $.post(config.url + "/controller.php", {
                action: "remove",
                id: id,
            }, function(json) {
                if (json.status === "success") {
                    item.transition('scaleOut', {
                        duration: 400,
                        complete: function() {
                            $("#cartList").html(json.html);
                            $('#cTotal').text(json.counter);
                        }
                    });
                    if (json.counter < 1 && $.inArray("cart", $.url().segment()) !== -1) {
                        window.location.href = config.surl + '/cart';
                    }
                }

            }, 'json');
        });

        //delete from big cart
        $("#bigCart").on('click', 'a.deleteItem', function() {
            var id = $(this).data('id');
            var item = $(this).closest('tr');

            $.post(config.url + "/controller.php", {
                action: "removeBig",
                id: id,
            }, function(json) {
                if (json.status === "success") {
                    item.transition('scaleOut', {
                        duration: 400,
                        complete: function() {
							item.remove();
                            $('#cTotal').text(json.count);

                            $("#subtotal").text(json.subtotal);
                            $("#discount").html(json.coupon);
                            $("#tax").html(json.tax);
                            $("#total").text(json.total);
                        }
                    });
                    if (json.counter < 1) {
                        window.location.href = config.surl + '/cart';
                    }
                }
            }, 'json');
        });
		
        /* == Comments like == */
        $("#comments").on('click', 'a.down, a.up', function() {
            var type = $(this).attr('class').replace("item ", "");
            var id = $(this).data('id');
            var icon = $(this).children('.icon');
            var score = $(this).children('span');
            var down = $(this).data('down');
            var up = $(this).data('up');

            icon.removeClass("chevron up down").addClass("check").fadeIn(150);
            $(this).removeClass("up down");

            $.post(config.url + '/controller.php', {
                action: "vote",
                type: type,
                id: id
            }, function(json) {
                if (json.status === "success") {
                    if (json.type === "down") {
                        score.text(parseInt(down) - 1);
                    } else {
                        score.text(parseInt(up) + 1);
                    }
                }
            }, "json");
        });

        //load reply form
        $("#comments").on('click', 'a.replay', function() {
            $("#replyform, #pError").remove();
            var id = $(this).data('id');
            $.get(config.theme + '/plugins/comments/_replyForm.tpl.php', {
                id: id
            }, function(data) {
                var comment = $("#comment_" + id, "#comments").children('.content');
                comment.append(data);
                $("#replyform").fadeIn(150);
            });
        });

        //comment reply
        $("#comments").on('click', 'button[name=doReply]', function() {
            var parent_id = $(this).closest('.comment').data('id');
            $(this).addClass('loading').prop('disabled', true);

            var data = {
                id: parent_id,
                parent_id: parent_id,
                counter: parseInt($("#pMore .rcounter").text()),
                product_id: $("input[name=product_id]").val(),
                message: $("textarea[name=replybody]").val(),
                username: $("input[name=replayname]").val(),
                acaptcha: $("input[name=acaptcha]").val(),
                url: $("input[name=url]").val(),
                action: "reply"
            };
            submitComment(data);
        });

        //new comment
        $(document).on('click', 'button[name=doComment]', function() {
            $(this).addClass('loading').prop('disabled', true);

            var data = {
                id: 1,
                product_id: $("input[name=product_id]").val(),
                parent_id: -1,
                counter: parseInt($("#pMore .rcounter").text()),
                message: $("textarea[name=body]").val(),
                username: $("input[name=name]").val(),
                captcha: $("input[name=captcha]").val(),
                rating: $("input[type='radio'][name='star']:checked").val(),
                url: $("input[name=url]").val(),
                action: "comment"
            };
            submitComment(data);
        });

        //process comment
        function submitComment(data) {
            $.post(config.url + '/controller.php', data, function(json) {
                if (json.type === "success") {
                    $("#replyform").remove();
                    if (json.html) {
                        if (data.action === "reply") {
                            if ($("#comment_" + data.id).children('.comments').length < 1) {
                                $("#comment_" + data.id).append('<div class="comments"></div>');
                            }
                            $("#comment_" + data.id).children('.comments').append(json.html);
                        } else {
							if($("#comments").children('.comments').length < 1) {
								$("#comments").prepend('<div class="wojo comments threaded"></div>');
							}
							$(".wojo.comments").prepend(json.html);
							$('html, body').animate({
								scrollTop: $("#comments").offset().top
							}, 500);
                            $("#combody").val('');
                        }
                    }
                    $(".rcounter").text(json.counter);
                }
                $.wNotice(json.message, {
                    autoclose: 12000,
                    type: json.type,
                    title: json.title
                });
                $("button[name=doReply], button[name=doComment]").removeClass('loading').prop('disabled', false);
            }, "json");
        }

        //char counter
        $(document).on('keyup paste', '#combody, #replybody', function() {
            var characters = $(this).attr('data-counter');
            if ($(this).val().length > characters) {
                $(this).val($(this).val().substr(0, characters));
            }
            var id = $(this).attr('id');
            var remaining = characters - $(this).val().length;
            $("." + id + "_counter span").html(remaining);
            if (remaining <= 10) {
                $("." + id + "_counter span").addClass('negative').removeClass('positive');
            } else {
                $("." + id + "_counter span").removeClass('negative').addClass('positive');
            }
        });

        //delete comment
        $("#comments").on('click', 'a.delete', function() {
            var id = $(this).closest('.comment').data('id');
            $.post(config.url + '/controller.php', {
                action: "deleteComment",
                id: id
            }, function() {
                var comment = $("#comment_" + id);
                $(comment).fadeOut();
            });
        });

        //load gateway
        $('#dGateways').on('change', 'input[name=gateway]', function() {
            var id = $(this).val();
			var card = $("#card_" + $(this).attr("id").replace("gate_", ""));
			card.addClass("loading");
            $.get(config.url + '/controller.php', {
                action: "gateway",
                id: id
            }, function(json) {
                $("#dCheckout").html(json.message);
				card.removeClass("loading");
				$("html,body").animate({
					scrollTop: $("#dCheckout").offset().top - 40
				}, "500");

            }, "json");
        });

        /* == Video Player == */
        $('#ytube a').on('click', function(event) {
            event.preventDefault();
            var url = $(this).attr('href');
            var id = url.substring(url.search('=') + 1, url.length);
            $('#ytube').addClass('loading');
            setTimeout(function() {
                $('#ytube').html('<iframe width="100%" height="320px" src="https://www.youtube.com/embed/' + id + '?autoplay=1&autohide=1" frameborder="0" allowfullscreen></iframe>');
                $('#ytube').removeClass('loading');
            }, 5000);
        });

        /* == Search == */
        $(document).on('keyup', '#masterSearch', function() {
            $('#searchResult').empty();
            var $button = $(this).parent();
			var $this = $(this);
            $button.children('.button').addClass('loading');
            window.clearTimeout(timeout);
            var srch_string = $.trim($(this).val());
            if (srch_string.length > 2) {
                timeout = window.setTimeout(function() {
                    $.ajax({
                        type: "get",
                        dataType: 'json',
                        url: config.url + '/controller.php',
                        data: {
                            action: "search",
                            value: srch_string,
                        },
                        success: function(json) {
                            $('#searchResult').html(json.html).show();
                            $("#masterSearch").on('blur', function() {
                                $('#searchResult').fadeOut();
                            });
                            $button.children('.button').removeClass('loading');
							$(document).on('click', function(event) {
								if (!($(event.target).is($this))) {
									$('#searchResult').fadeOut();
								}
							});
                        }
                    });
                }, 700);
            }
            return false;
        });

        $(document).on('click', '#doSearch', function() {
            var value = $.trim($("#masterSearch").val());
			window.location.href = config.surl + '/search?keyword=' + value;
        });
		
        /* == Avatar Upload == */
        $('[data-type="image"]').wavatar({
            text: config.lang.selPic,
            validators: {
                maxWidth: 3200,
                maxHeight: 1800
            },
            reject: function(file, errors) {
                if (errors.mimeType) {
                    $.wNotice(decodeURIComponent(file.name + ' must be an image.'), {
                        autoclose: 4000,
                        type: "error",
                        title: 'Error'
                    });
                }
                if (errors.maxWidth || errors.maxHeight) {
                    $.wNotice(decodeURIComponent(file.name + ' must be width:3200px, and height:1800px  max.'), {
                        autoclose: 4000,
                        type: "error",
                        title: 'Error'
                    });
                }
            }
        });

        /* == Clear Session Debug Queries == */
        $("#debug-panel").on('click', 'a.clear_session', function() {
            $.get(config.url + '/controller.php', {
                ClearSessionQueries: 1
            });
            $(this).css('color', '#222');
        });

        /* == Check All == */
        $('#masterCheckbox').click(function() {
            var parent = $(this).data('parent');
            $(parent + ' .checkbox').checkbox('toggle', $(this));
        });


        /* == Master Form == */
        $(document).on('click', 'button[name=dosubmit]', function() {
            var $button = $(this);
            var action = $(this).data('action');
            var $form = $(this).closest("form");
            var asseturl = $(this).data('url');

            function showResponse(json) {
                setTimeout(function() {
                    $($button).removeClass("loading").prop("disabled", false);
                }, 500);
                $.wNotice(json.message, {
                    autoclose: 12000,
                    type: json.type,
                    title: json.title
                });
                if (json.type === "success" && json.redirect) {
                    setTimeout(function() {
                    $('main').transition("scaleOut", {
                        duration: 1000,
                        complete: function() {
                            window.location.href = json.redirect;
                        }
                    });
                    }, 5000);
                }
            }

            function showLoader() {
                $($button).addClass("loading").prop("disabled", true);
            }
            var options = {
                target: null,
                beforeSubmit: showLoader,
                success: showResponse,
                type: "post",
                url: asseturl ? config.url + "/" + asseturl + "/controller.php" : config.url + "/controller.php",
                data: {
                    action: action
                },
                dataType: 'json'
            };

            $($form).ajaxForm(options).submit();
        });

        // product image viewer 
        $('.lightbox').fluidbox();
        $("nav#imageswitch a img").click(function() {
            $('.lightbox').fluidbox('destroy');
            var previewImg = $("img#mainimg");
            var previewLink = previewImg.parent();
            previewLink.parent().addClass('loading');


            var img = $(this);
            var link = $(this).parent();
            var imgHref = img.attr("src");
            var imgAlt = img.attr("alt");
            var linkHref = link.attr("href");

            if ($(img).parent().hasClass("active") === false) {
                $("nav#imageswitch a").removeClass("active");
                img.parent().addClass("active");
				$(previewImg).fadeIn(300, function() {
                    previewImg.attr("src", imgHref);
                    previewImg.attr("alt", imgAlt);
                    previewLink.attr("href", linkHref);
					$('.lightbox').fluidbox();
					previewLink.parent().removeClass('loading');
				});
            }
            return false;
        });

        // download error messages
		if($.url().param('msg')) {
			$.wNotice($.url().param('msg'), {
				autoclose: 12000,
				type: "error",
				title: "Error"
			});
		}

        // convert logo svg to editable 
        $('.logo img').each(function() {
            var $img = $(this);
            var imgID = $img.attr('id');
            var imgClass = $img.attr('class');
            var imgURL = $img.attr('src');

            $.get(imgURL, function(data) {
                var $svg = $(data).find('svg');
                if (typeof imgID !== 'undefined') {
                    $svg = $svg.attr('id', imgID);
                }
                if (typeof imgClass !== 'undefined') {
                    $svg = $svg.attr('class', imgClass + ' replaced-svg');
                }
                $svg = $svg.removeAttr('xmlns:a');
                $img.replaceWith($svg);
            }, 'xml');

        });

        /* == Add/Edit Modal Actions == */
        $(document).on('click', 'a.action, button.action', function() {
            var dataset = $(this).data("set");
            var $parent = dataset.parent;
            var $this = $(this);
            var actions = '';
            var url = config.url + dataset.url;

            $.get(url, dataset.option[0], function(data) {
                if (dataset.buttons !== false) {
                    actions += '' +
                        '<div class="footer">' +
                        '<button type="button" class="wojo small simple button" data="modal:close">' + config.lang.canBtn + '</button>' +
                        '<button type="button" class="wojo small positive button" data="modal:ok">' + dataset.label + '</button>' +
                        '</div>';
                }

                var $wmodal = $('<div class="wojo ' + dataset.modalclass + ' modal"><div class="dialog" role="document"><div class="content">' +
                    '' + data + '' +
                    '' + actions + '' +
                    '</div></div></div>').on($.modal.BEFORE_OPEN, function() {

                }).modal().on('click', '[data="modal:ok"]', function() {
                    $(this).addClass('loading').prop("disabled", true);
                    function showResponse(json) {
                        setTimeout(function() {
                            $('[data="modal:ok"]', $wmodal).removeClass('loading').prop("disabled", false);
                            if (json.message) {
                                $.wNotice(decodeURIComponent(json.message), {
                                    autoclose: 12000,
                                    type: json.type,
                                    title: json.title
                                });
                            }
                            if (json.type === "success") {
                                if (dataset.redirect) {
                                    setTimeout(function() {
                                        $("main").transition('scaleOut');
                                        window.location.href = json.redirect;
                                    }, 800);
                                } else {
                                    switch (dataset.complete) {
                                        case "replace":
                                            $($parent).html(json.html).transition('fadeIn', {
                                                duration: 600
                                            });
                                            break;
                                        case "replaceWith":
                                            $($this).replaceWith(json.html).transition('fadeIn', {
                                                duration: 600
                                            });
                                            break;
                                        case "append":
                                            $($parent).append(json.html).transition('scaleIn', {
                                                duration: 300
                                            });
                                            break;
                                        case "prepend":
                                            $($parent).prepend(json.html).transition('scaleIn', {
                                                duration: 300
                                            });
                                            break;
                                        case "update":
                                            $($parent).replaceWith(json.html).transition('fadeIn', {
                                                duration: 600
                                            });
                                            break;
                                        case "insert":
                                            if (dataset.mode === "append") {
                                                $($parent).append(json.html);
                                            }
                                            if (dataset.mode === "prepend") {
                                                $($parent).prepend(json.html);
                                            }
                                            break;
                                        case "highlite":
                                            $($parent).addClass('highlite');
                                            break;
                                        default:
                                            break;
                                    }
                                    $.modal.close();
                                }
                            }

                        }, 500);
                    }

                    var options = {
                        target: null,
                        success: showResponse,
                        type: "post",
                        url: url,
                        data: dataset.option[0],
                        dataType: 'json'
                    };
                    $('#modal_form').ajaxForm(options).submit();
                });
            });
        });
		
        /* == Simple Actions == */
        $(document).on('click', '.iaction', function() {
            var dataset = $(this).data("set");
            var $parent = $(dataset.parent);
            $.ajax({
                type: 'POST',
                url: config.url + dataset.url,
                dataType: 'json',
                data: dataset.option[0]
            }).done(function(json) {
                if (json.type === "success") {
                    switch (dataset.complete) {
                        case "remove":
                            $parent.transition("scaleOut", {
                                duration: 300,
                                complete: function() {
                                    $parent.remove();
                                    if (dataset.callback === "mason") {
                                        $(".wojo.mason").wMason("refresh");
                                    }
                                }
                            });

                            break;

                        case "replace":
                            $parent.html(json.html).transition('fadeIn', {
                                duration: 600
                            });
                            break;

                        case "prepend":
                            $parent.prepend(json.html).transition('fadeIn', {
                                duration: 600
                            });
                            break;
                    }

                    if (dataset.redirect) {
                        setTimeout(function() {
                            $("main").transition('scaleOut');
                            window.location.href = dataset.redirect;
                        }, 800);
                    }
                }

                if (json.message) {
                    $.wNotice(decodeURIComponent(json.message), {
                        autoclose: 12000,
                        type: json.type,
                        title: json.title
                    });
                }

            });
        });
    };
})(jQuery);