
            $(document).ready((function() {
                $.validator.addMethod("valueNotEquals", (function(t, e, i) {
                    return i != t
                }), "Time Must Not Be 00:00"), $.validator.addMethod("valueNotEquals", (function(t, e, i) {
                    return i != t
                }), "Value must not equal arg."), $("#Home").validate({
                    rules: {
                        airportId: {
                            valueNotEquals_airport: "0"
                        },
                        DepTime: {
                            valueNotEquals: "00:00"
                        },
                        ReturnTime: {
                            valueNotEquals: "00:00"
                        },
                        DepTime2: {
                            valueNotEquals: "00:00"
                        },
                        ReturnTime2: {
                            valueNotEquals: "00:00"
                        }
                    },
                    messages: {
                        name: "Please Enter Terminal Name",
                        aid: "Please Select Airport"
                    }
                });
                $(".frontendLogin").on("click", (function() {
                    $("#travelo-login").show()
                }));
                $("#log_ref").validate({
                    rules: {
                        ref_no: {
                            required: !0
                        },
                        email_address: {
                            required: !0
                        }
                    },
                    messages: {
                        ref_no: "Please Enter Booking Ref",
                        email_address: "Please Enter Email Address"
                    },
                    submitHandler: function() {
                        var t = $("#log_ref").serialize();
                        return $.ajax({
                            type: "POST",
                            url: "model/user-login.php",
                            data: t,
                            beforeSend: function() {},
                            success: function(t) {
                                "ok" == t ? setTimeout((function() {
                                    window.location.replace("user-dashboard.php")
                                }), 1e3) : $("#error_user").show()
                            }
                        }), !1
                    }
                });

                }));

            function i(t) {
                return (i = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function(t) {
                    return typeof t
                } : function(t) {
                    return t && "function" == typeof Symbol && t.constructor === Symbol && t !== Symbol.prototype ? "symbol" : typeof t
                })(t)
            }
         
             
                var e = $("#BookForm"),
                    i = e.validate({
                    debug: !0,
                    errorPlacement: function(t, e) {
                        $(e).closest("form").find("span[for='" + e.attr("id") + "']").append(t)
                    },
                    errorElement: "span",
                    ignore: ":hidden",
                    rules: {
                        FirstName: {
                            required: !0
                        },
                        LastName: {
                            required: !0
                        },
                        Email: {
                            required: !0,
                            email: !0
                        },
                        Mobile: {
                            required: !0,
                            phoneUK: !0
                        },
                        Make: {
                            required: !0
                        },
                        Model: {
                            required: !0
                        },
                        Color: {
                            required: !0
                        },
                        RegNo: {
                            required: !0
                        }
                    },
                    messages: {
                        FirstName: {
                            required: "Please Enter Your First Name"
                        },
                        LastName: {
                            required: "Please Enter Your Last Name"
                        },
                        Email: {
                            required: "Please Enter Your Email Address"
                        },
                        Mobile: {
                            required: "Please Enter Your Mobile Number"
                        },
                        Make: {
                            required: "Please Enter Your Car Make"
                        },
                        Model: {
                            required: "Please Enter Your Car Model"
                        },
                        Color: {
                            required: "Please Enter Your Car color"
                        },
                        RegNo: {
                            required: "Please Enter Your Car Registration No"
                        }
                    },
                    submitHandler: function(t, e) {
                        $("#paymentlog").modal("show"), setTimeout((function() {
                            t.submit()
                        }), 1500)
                    }
                });

                function s() {
                    var e = $("#Title"),
                        i = "" !== e.val() && void 0 !== e.val() ? e.val() : null,
                        s = $("#FirstName"),
                        n = "" !== s.val() && void 0 !== s.val() ? s.val() : null,
                        o = $("#LastName"),
                        a = "" !== o.val() && void 0 !== o.val() ? o.val() : null,
                        r = $("#Email"),
                        l = "" !== r.val() && void 0 !== r.val() ? r.val() : null,
                        h = $("#Mobile"),
                        c = "" !== h.val() && void 0 !== h.val() ? h.val() : null,
                        u = $("#Make"),
                        d = "" !== u.val() && void 0 !== u.val() ? u.val() : null,
                        p = $("#Model"),
                        f = "" !== p.val() && void 0 !== p.val() ? p.val() : null,
                        m = $("#Color"),
                        g = "" !== m.val() && void 0 !== m.val() ? m.val() : null,
                        v = $("#RegNo"),
                        b = "" !== v.val() && void 0 !== v.val() ? v.val() : null,
                        y = $("#DepartureTerminal"),
                        _ = "" !== y.val() && void 0 !== y.val() ? y.val() : null,
                        w = $("#ArrivalTerminal"),
                        x = "" !== w.val() && void 0 !== w.val() ? w.val() : null,
                        k = $("#ArrivalFlightNumber"),
                        C = "" !== k.val() && void 0 !== k.val() ? k.val() : null,
                        D = $("#TotalAmount"),
                        T = "" !== D.val() && void 0 !== D.val() ? D.val() : null,
                        P = $("#CanceledAmount"),
                        S = "" !== P.val() && void 0 !== P.val() ? P.val() : null,
                        F = $("#SmsAmount"),
                        M = "" !== F.val() && void 0 !== F.val() ? F.val() : null,
                        E = $("#PostalAmount"),
                        I = "" !== E.val() && void 0 !== E.val() ? E.val() : null;
                    null !== n && null !== a && null !== l && null !== c && $.ajax({
                        type: "GET",
                        url: t + "/OrderProcessAjax.php",
                        data: {
                            Title: i,
                            FirstName: n,
                            LastName: a,
                            Email: l,
                            Mobile: c,
                            Make: d,
                            Model: f,
                            Color: g,
                            RegNo: b,
                            DepartureTerminal: _,
                            ArrivalTerminal: x,
                            ArrivalFlightNumber: C,
                            TotalAmount: T,
                            CanceledAmount: S,
                            SmsAmount: M,
                            PostalAmount: I
                        },
                        success: function(t) {
                            if ("/index.php?status=false&message=Session-Data-Timed-Out-On-OPA&response_code=OPASDT440" === t) console.log("OPASDT440 triggered"), window.location.replace(sitePath + t);
                            else if ("/index.php?status=false&message=Session-Timed-Out-On-OPA&response_code=OPAST440" === t) console.log("OPAST440 triggered"), window.location.replace(sitePath + t);
                            else if ("/index.php?status=false&message=Session-Data-Missing-For-Search-On-OPA&response_code=OPASMS400" === t) console.log("OPASMS400 triggered"), window.location.replace(sitePath + t);
                            else if ("/index.php?status=false&message=Session-Data-Missing-For-QuoteProcess-On-OPA&response_code=OPASMQP400" === t) console.log("OPASMQP400 triggered"), window.location.replace(sitePath + t);
                            else if (-1 !== t.indexOf("/Bookingsummary.php")) console.log("Bookingsummary triggered"), window.location.replace(sitePath + t);
                            else {
                                console.log("Updated: ", t);
                                var e = JSON.parse(t);
                                e.reference_no && "" == $("#referenceNoAjax").val() && $("#referenceNoAjax").val(e.reference_no)
                            }
                        }
                    })
                }

                function n(t) {
                    return e.valid() ? (console.log("validation passed trigger: ", "validation passed"), !0) : (console.log("validtion failed trigger: ", "validation failed"), null !== t && i.focusInvalid(), !1)
                }
                $("#pencil").click((function() {
                    $("#booking_panel").show(), $(".page-title-container").height("auto")
                }));

                $("#FirstName, #LastName, #Email, #Mobile").on("blur", (function() {
                    var t = n(null);
                    "" !== $(this).val() && t && s()
                }));
                $("#Make, #Model, #Color, #RegNo, #ArrivalFlightNumber").on("click", (function() {
                    "TBC" === $(this).val() && $(this).val("")
                }));
                $("#Make, #Model, #Color, #RegNo, #ArrivalFlightNumber").blur((function() {
                    "" === $(this).val() && $(this).val("TBC");
                    var t = n(null);
                    "" !== $(this).val() && t && s()
                }));
                $("#cancel-protection").click((function() {
                    $("#cancel-protection").data("clicked"), total = parseFloat($("#TotalAmount").val()) + parseFloat($("#CancelationProtectionCharges").val()), $("#cancel-protection-active").show(), $("#cancel-protection").hide(), $("#ShowCancel").show(), $("#CanceledAmount").val($("#CancelationProtectionCharges").val()), $("#TotalAmount").val(parseFloat(total).toFixed(2)), $("#TotalPrice").html("&pound; " + parseFloat(total).toFixed(2)), n(null) && s()
                }));
                $("#cancel-protection-active").click((function() {
                    $("#cancel-protection-active").data("clicked"), total = parseFloat($("#TotalAmount").val()) - parseFloat($("#CancelationProtectionCharges").val()), $("#cancel-protection").show(), $("#cancel-protection-active").hide(), $("#ShowCancel").hide(), $("#CanceledAmount").val(0), $("#TotalAmount").val(parseFloat(total).toFixed(2)), $("#TotalPrice").html("&pound; " + parseFloat(total).toFixed(2)), n(null) && s()
                }));
                $("#sms-protection").click((function() {
                    $("#sms-protection").data("clicked"), total = parseFloat($("#TotalAmount").val()) + parseFloat($("#SmsProtectionCharges").val()), $("#sms-protection-active").show(), $("#sms-protection").hide(), $("#ShowSms").show(), $("#SmsAmount").val($("#SmsProtectionCharges").val()), $("#TotalAmount").val(parseFloat(total).toFixed(2)), $("#TotalPrice").html("&pound; " + parseFloat(total).toFixed(2)), n(null) && s()
                }));
                $("#sms-protection-active").click((function() {
                    $("#sms-protection-active").data("clicked"), total = parseFloat($("#TotalAmount").val()) - parseFloat($("#SmsProtectionCharges").val()), $("#sms-protection").show(), $("#sms-protection-active").hide(), $("#ShowSms").hide(), $("#SmsAmount").val(0), $("#TotalAmount").val(parseFloat(total).toFixed(2)), $("#TotalPrice").html("&pound; " + parseFloat(total).toFixed(2)), n(null) && s()
                }));
                $("#postal-protection").click((function() {
                    $("#postal-protection").data("clicked"), total = parseFloat($("#TotalAmount").val()) + parseFloat($("#PostalCoverCharges").val()), $("#postal-protection-active").show(), $("#postal-protection").hide(), $("#ShowPostal").show(), $("#PostalAmount").val($("#PostalCoverCharges").val()), $("#TotalAmount").val(parseFloat(total).toFixed(2)), $("#TotalPrice").html("&pound; " + parseFloat(total).toFixed(2)), n(null) && s()
                }));
                $("#postal-protection-active").click((function() {
                    $("#postal-protection-active").data("clicked"), total = parseFloat($("#TotalAmount").val()) - parseFloat($("#PostalCoverCharges").val()), $("#postal-protection").show(), $("#postal-protection-active").hide(), $("#ShowPostal").hide(), $("#PostalAmount").val(0), $("#TotalAmount").val(parseFloat(total).toFixed(2)), $("#TotalPrice").html("&pound; " + parseFloat(total).toFixed(2)), n(null) && s()
                }));
                if ($(window).width() < 960) 
                var t = 1;
                else t = 1;
                $("#DropDate, #ReturnDate").datepicker({
                    dateFormat: "dd-MM-yy",
                    numberOfMonths: t,
                    minDate: 0,
                    onClose: function(t) {
                        if ("DropDate" == this.id) {
                            var e = $("#DropDate").datepicker("getDate"),
                                i = new Date(e.getFullYear(), e.getMonth(), e.getDate() + 0),
                                s = new Date(e.getFullYear(), e.getMonth(), e.getDate() + 3e11);
                            $("#ReturnDate").datepicker("option", "minDate", i), $("#ReturnDate").datepicker("option", "maxDate", s), $("#ReturnDate").datepicker("option", "maxDateTime", i), $("#ReturnDate").datepicker("setDate", new Date(i.getFullYear(), i.getMonth(), i.getDate() + 7))
                        }
                    }
                });
                $("#DropDate").datepicker("setDate", new Date);
                var e = $("#DropDate").datepicker("getDate");
                $("#ReturnDate").datepicker("setDate", new Date(e.getFullYear(), e.getMonth(), e.getDate() + 7));
                var i = new Date(e.getFullYear(), e.getMonth(), e.getDate() + 0),
                    s = new Date(e.getFullYear(), e.getMonth(), e.getDate() + 3e11);
                $("#ReturnDate").datepicker("option", "minDate", i), $("#ReturnDate").datepicker("option", "maxDate", s), $("#ReturnDate").datepicker("option", "maxDateTime", i)
          
                $("#dropOffDate, #returnDate").datepicker({
                    dateFormat: "dd-MM-yy",
                    minDate: 0,
                    onClose: function(t) {
                        if ("dropOffDate" == this.id) {
                            var e = $("#dropOffDate").datepicker("getDate"),
                                i = new Date(e.getFullYear(), e.getMonth(), e.getDate() + 0),
                                s = new Date(e.getFullYear(), e.getMonth(), e.getDate() + 3e11);
                            $("#returnDate").datepicker("option", "minDate", i), $("#returnDate").datepicker("option", "maxDate", s), $("#returnDate").datepicker("option", "maxDateTime", i), $("#returnDate").datepicker("setDate", new Date(i.getFullYear(), i.getMonth(), i.getDate() + 7))
                        }
                    }
                });
                var t = $("#dropOffDate").datepicker("getDate"),
                    e = new Date(t.getFullYear(), t.getMonth(), t.getDate() + 0),
                    i = new Date(t.getFullYear(), t.getMonth(), t.getDate() + 3e11);
                $("#returnDate").datepicker("option", "minDate", e), $("#returnDate").datepicker("option", "maxDate", i), $("#returnDate").datepicker("option", "maxDateTime", e)
                $("body").removeClass("loaded"), setTimeout((function() {
                    $("body").addClass("loaded")
                }), 2e3)
                    var t = $(".terminalgridpopular:visible").length;
                    t = "(" + t + ")", $("#all_filter").html(t), $("#total-result").html(t), $("#pencil").click((function() {
                        $("#booking_panel").css("margin-bottom", "15px"), $("#booking_panel").stop().toggle("slow")
                    })), setTimeout((function() {
                        $(".hide-button").css("opacity", "100")
                    }), 500);
                    var e = [],
                        i = [];
                    $(".sortGrid").each((function(t, s) {
                        $(this).is(":visible") && ($(this).data("premium").length ? e.push(s) : i.push(s))
                    })), e.sort((function(t, e) {
                        return $(t).data("amount") - $(e).data("amount")
                    })), i.sort((function(t, e) {
                        return $(t).data("amount") - $(e).data("amount")
                    })), e.map((function(t, e) {
                        $("#sortGridPopular").append(t)
                    })), i.map((function(t, e) {
                        $("#sortGridPopular").append(t)
                    })), $(".comp-logo").each((function(t, e) {
                        var i = $(this);
                        if (i.is(":visible")) {
                            var s = i.data("image");
                            i.attr("src", s)
                        }
                    }))
                var s, n, o = "[object OperaMini]" == Object.prototype.toString.call(t.operamini),
                    a = "placeholder" in e.createElement("input") && !o,
                    r = "placeholder" in e.createElement("textarea") && !o,
                    l = i.fn,
                    h = i.valHooks,
                    c = i.propHooks;

                function u(t, e) {
                    var s = i(this);
                    if (this.value == s.attr("placeholder") && s.hasClass("placeholder"))
                        if (s.data("placeholder-password")) {
                            if (s = s.hide().next().show().attr("id", s.removeAttr("id").data("placeholder-id")), !0 === t) return s[0].value = e;
                            s.focus()
                        } else this.value = "", s.removeClass("placeholder"), this == p() && this.select()
                }

                function d() {
                    var t, e, s, n, o = i(this),
                        a = this.id;
                    if ("" == this.value) {
                        if ("password" == this.type) {
                            if (!o.data("placeholder-textinput")) {
                                try {
                                    t = o.clone().attr({
                                        type: "text"
                                    })
                                } catch (o) {
                                    t = i("<input>").attr(i.extend((e = this, s = {}, n = /^jQuery\d+$/, i.each(e.attributes, (function(t, e) {
                                        e.specified && !n.test(e.name) && (s[e.name] = e.value)
                                    })), s), {
                                        type: "text"
                                    }))
                                }
                                t.removeAttr("name").data({
                                    "placeholder-password": o,
                                    "placeholder-id": a
                                }).bind("focus.placeholder", u), o.data({
                                    "placeholder-textinput": t,
                                    "placeholder-id": a
                                }).before(t)
                            }
                            o = o.removeAttr("id").hide().prev().attr("id", a).show()
                        }
                        o.addClass("placeholder"), o[0].value = o.attr("placeholder")
                    } else o.removeClass("placeholder")
                }
       
           

            function changeTraveloElementUI() {
                $(".selector select").each((function() {
                    var t = $(this);
                    t.parent().children(".custom-select").length < 1 && (t.after("<span class='custom-select'>" + t.children("option:selected").html() + "</span>"), t.hasClass("white-bg") && t.next("span.custom-select").addClass("white-bg"), t.hasClass("full-width") && t.next("span.custom-select").addClass("full-width"))
                }));
                $("body").on("change", ".selector select", (function() {
                    $(this).next("span.custom-select").length > 0 && $(this).next("span.custom-select").text($(this).find("option:selected").text())
                }));
                $("body").on("keydown", ".selector select", (function() {
                    $(this).next("span.custom-select").length > 0 && $(this).next("span.custom-select").text($(this).find("option:selected").text())
                }));
                $(".fileinput input[type=file]").each((function() {
                    var t = $(this);
                    t.parent().children(".custom-fileinput").length < 1 && (t.after('<input type="text" class="custom-fileinput" />'), void 0 !== t.data("placeholder") && t.next(".custom-fileinput").attr("placeholder", t.data("placeholder")), void 0 !== t.prop("class") && t.next(".custom-fileinput").addClass(t.prop("class")), t.parent().css("line-height", t.outerHeight() + "px"))
                }));
                $(".fileinput input[type=file]").on("change", (function() {
                    var t = this.value,
                        e = t.lastIndexOf("\\"); - 1 == e && (e = t.lastIndexOf("/")), -1 != e && (t = t.substring(e + 1)), $(this).next(".custom-fileinput").val(t)
                }));
                $(".checkbox input[type='checkbox'], .radio input[type='radio']").each((function() {
                    $(this).is(":checked") && ($(this).closest(".checkbox").addClass("checked"), $(this).closest(".radio").addClass("checked"))
                })), $(".checkbox input[type='checkbox']").bind("change", (function() {
                    $(this).is(":checked") ? $(this).closest(".checkbox").addClass("checked") : $(this).closest(".checkbox").removeClass("checked")
                })), $(".radio input[type='radio']").bind("change", (function(t, e) {
                    if ($(this).is(":checked")) {
                        var i = $(this).prop("name");
                        void 0 !== i && $(".radio input[name='" + i + "']").closest(".radio").removeClass("checked"), $(this).closest(".radio").addClass("checked")
                    }
                })), $(".datepicker-wrap input").each((function() {
                    var t = $(this).data("min-date");
                    void 0 === t && (t = 0), $(this).datepicker({
                        showOn: "button",
                        buttonImage: "images/icon/blank.png",
                        buttonText: "",
                        buttonImageOnly: !0,
                        changeYear: !1,
                        minDate: t,
                        dateFormat: "mm/dd/yy",
                        dayNamesMin: ["S", "M", "T", "W", "T", "F", "S"],
                        beforeShow: function(t, e) {
                            var i = $(t).parent().attr("class").replace("datepicker-wrap", "");
                            $("#ui-datepicker-div").attr("class", ""), $("#ui-datepicker-div").addClass("ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all"), $("#ui-datepicker-div").addClass(i)
                        },
                        onClose: function(t) {
                            "date_from" == $(this).attr("name") && $(this).closest("form").find('input[name="date_to"]').length > 0 && $(this).closest("form").find('input[name="date_to"]').datepicker("option", "minDate", t), "date_to" == $(this).attr("name") && $(this).closest("form").find('input[name="date_from"]').length > 0 && $(this).closest("form").find('input[name="date_from"]').datepicker("option", "maxDate", t)
                        }
                    })
                }));
                try {
                    $("input, textarea").placeholder()
                } catch (t) {}
            }

            function displayPhotoGallery($item) {
                if (!(!$.fn.flexslider || $item.length < 1 || $item.is(":hidden"))) {
                    var dataAnimation = $item.data("animation"),
                        dataSync = $item.data("sync");
                    void 0 === dataAnimation && (dataAnimation = "slide");
                    var dataFixPos = $item.data("fix-control-nav-pos"),
                        callFunc = $item.data("func-on-start");
                    $item.flexslider({
                        animation: dataAnimation,
                        controlNav: !0,
                        animationLoop: !0,
                        slideshow: !0,
                        pauseOnHover: !0,
                        sync: dataSync,
                        start: function start(slider) {
                            if (void 0 !== dataFixPos && "1" == dataFixPos) {
                                var height = $(slider).find(".slides img").height();
                                $(slider).find(".flex-control-nav").css("top", height - 44 + "px")
                            }
                            if (void 0 !== callFunc) try {
                                eval(callFunc + "();")
                            } catch (t) {}
                        }
                    })
                }
            }

            function displayImageCarousel(t) {
                if (!(!$.fn.flexslider || t.length < 1 || t.is(":hidden"))) {
                    var e = t.data("animation"),
                        i = t.data("item-width"),
                        s = t.data("item-margin"),
                        n = t.data("sync");
                    void 0 === e && (e = "slide"), void 0 === i && (i = 70), void 0 === s && (s = 10), i = parseInt(i, 10), s = parseInt(s, 10);
                    var o = !1;
                    void 0 === n && (n = "", o = !0), t.flexslider({
                        animation: e,
                        controlNav: !0,
                        animationLoop: !0,
                        slideshow: o,
                        itemWidth: i,
                        itemMargin: s,
                        minItems: 2,
                        pauseOnHover: !0,
                        asNavFor: n,
                        start: function(t) {
                            "" != n ? ($(t).find(".slides > li").height(i), $(t).find(".slides > li > img").each((function() {
                                $(this).width() < 1 ? $(this).load((function() {
                                    $(this).parent().middleblock()
                                })) : $(this).parent().middleblock()
                            }))) : $(t).find(".middle-block img, .middle-block .middle-item").each((function() {
                                $(this).width() < 1 ? $(this).load((function() {
                                    $(this).closest(".middle-block").middleblock()
                                })) : $(this).closest(".middle-block").middleblock()
                            }))
                        },
                        after: function(t) {
                            0 == t.currentItem && (target = 0, t.transitions && (target = "vertical" === t.vars.direction ? "translate3d(0," + target + ",0)" : "translate3d(" + target + ",0,0)", t.container.css("-" + t.pfx + "-transition-duration", "0s"), t.container.css("transition-duration", "0s")), t.args[t.prop] = target, t.container.css(t.args), t.container.css("transform", target))
                        }
                    })
                }
            }
            stGlobals.isMobile = /(Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini|windows phone)/.test(navigator.userAgent), stGlobals.isMobileWebkit = /WebKit/.test(navigator.userAgent) && /Mobile/.test(navigator.userAgent), stGlobals.isIOS = /iphone|ipad|ipod/gi.test(navigator.appVersion), String.prototype.lpad = function(t, e) {
                    for (var i = this; i.length < e;) i = t + i;
                    return i
                }, $.fn.removeClassPrefix = function(t) {
                    return this.each((function(e, i) {
                        var s = i.className.split(" ").filter((function(e) {
                            return 0 !== e.lastIndexOf(t, 0)
                        }));
                        i.className = s.join(" ")
                    })), this
                },
                function(t, e, i) {
                    function s(t, e) {
                        var s = i(this),
                            n = s.find(".middle-item");
                        if (n.length < 1 && (n = s.children("img")), !(n.length < 1)) {
                            var o = n.width(),
                                a = n.height();
                            if (s.width() <= 1) {
                                for (var r = s; r.width() <= 1;) r = r.parent();
                                s.css("width", r.width() + "px")
                            }
                            if (s.css("position", "relative"), n.css("position", "absolute"), s.hasClass("middle-block-auto-height") && (s.removeClass("middle-block-auto-height"), s.height(0)), s.height() <= 1) {
                                for (r = s; r.height() <= 1;) r = "left" == r.css("float") && 0 == r.index() && r.next().length > 0 ? r.next() : "left" == r.css("float") && r.index() > 0 ? r.prev() : r.parent();
                                s.css("height", r.outerHeight() + "px"), s.addClass("middle-block-auto-height"), o = n.width(), (a = n.height()) <= 1 && (a = r.outerHeight())
                            }
                            n.css("top", "50%"), n.css("margin-top", "-" + a / 2 + "px"), o >= 1 ? (n.css("left", "50%"), n.css("margin-left", "-" + o / 2 + "px")) : n.css("left", "0")
                        }
                    }
                    i.fn.middleblock = function() {
                        return i(this).is(":visible") && this.bind("set.middleblock", s).trigger("set.middleblock"), this
                    }
                }(0, document, jQuery), a = jQuery, a.fn.countTo = function(t) {
                    return t = t || {}, a(this).each((function() {
                        function e(t) {
                            t = i.formatter.call(o, t, i), r.html(t)
                        }
                        var i = a.extend({}, a.fn.countTo.defaults, {
                                from: a(this).data("from"),
                                to: a(this).data("to"),
                                speed: a(this).data("speed"),
                                refreshInterval: a(this).data("refresh-interval"),
                                decimals: a(this).data("decimals")
                            }, t),
                            s = Math.ceil(i.speed / i.refreshInterval),
                            n = (i.to - i.from) / s,
                            o = this,
                            r = a(this),
                            l = 0,
                            h = i.from,
                            c = r.data("countTo") || {};
                        r.data("countTo", c), c.interval && clearInterval(c.interval), c.interval = setInterval((function() {
                            l++, e(h += n), "function" == typeof i.onUpdate && i.onUpdate.call(o, h), l >= s && (r.removeData("countTo"), clearInterval(c.interval), h = i.to, "function" == typeof i.onComplete && i.onComplete.call(o, h))
                        }), i.refreshInterval), e(h)
                    }))
                }, a.fn.countTo.defaults = {
                    from: 0,
                    to: 0,
                    speed: 1e3,
                    refreshInterval: 100,
                    decimals: 0,
                    formatter: function(t, e) {
                        return t.toFixed(e.decimals)
                    },
                    onUpdate: null,
                    onComplete: null
                },
                function(t, e, i) {
                    i.fn.onstage = function() {
                        var e = i(t).scrollTop(),
                            s = i(t).height();
                        return this.offset().top + .9 * this.height() <= e + s && this.offset().top + .9 * this.height() > e
                    }
                }(this, document, jQuery),
                function(t) {
                    var e, i = function() {};
                    i.prototype = {
                        constructor: i,
                        init: function() {},
                        open: function(i, s) {
                            void 0 === i && (i = {});
                            var n = i.wrapId ? "#" + i.wrapId : ".opacity-overlay";
                            if (t(n).length < 1) {
                                var o = i.wrapId ? " id='" + i.wrapId + "'" : "";
                                t("<div class='opacity-overlay' " + o + "><div class='container'><div class='popup-wrapper'><i class='fa fa-spinner fa-spin spinner'></i><div class='col-xs-12 col-sm-9 popup-content'></div></div></div></div>").appendTo("body")
                            }
                            if (e.wrap = t(n), e.content = e.wrap.find(".popup-content"), e.spinner = e.wrap.find(".spinner"), e.contentContainer = e.wrap.find(".popup-wrapper"), stGlobals.isMobile && (e.wrap.css({
                                    height: t(document).height(),
                                    position: "absolute"
                                }), e.contentContainer.css("top", t(window).scrollTop())), e.updateSize(), "ajax" == i.type) e.content.html(""), e.content.height("auto").css("visibility", "hidden"), e.wrap.fadeIn(), e.spinner.show(), t("body").addClass("overlay-open"), t.ajax({
                                url: s.attr("href"),
                                type: "post",
                                dataType: "html",
                                success: function(t) {
                                    e.content.html(t), i.callBack && i.callBack(e), setTimeout((function() {
                                        e.content.css("visibility", "visible"), e.spinner.hide()
                                    }), 100)
                                }
                            });
                            else if ("map" == i.type) {
                                e.wrap.fadeIn(), e.spinner.show();
                                var a = i.lngltd.split(","),
                                    r = e.content.width();
                                e.content.gmap3({
                                    clear: {
                                        name: "marker",
                                        last: !0
                                    }
                                });
                                var l = i.zoom ? parseInt(i.zoom, 10) : 12;
                                e.content.height(.5 * r).gmap3({
                                    map: {
                                        options: {
                                            center: a,
                                            zoom: l
                                        }
                                    },
                                    marker: {
                                        values: [{
                                            latLng: a
                                        }],
                                        options: {
                                            draggable: !1
                                        }
                                    }
                                }), t("body").addClass("overlay-open")
                            } else {
                                var h = s.attr("href");
                                void 0 === h && (h = s.data("target")), e.content.children().hide(), e.content.children(h).length > 0 || t(h).appendTo(e.content), t(h).show(), e.spinner.hide(), e.wrap.fadeIn((function() {
                                    t(h).find(".input-text").eq(0).focus(), t("body").addClass("overlay-open")
                                }))
                            }
                        },
                        close: function() {
                            t("body").removeClass("overlay-open"), t("html").css("overflow", ""), t("html").css("margin-right", ""), e.spinner.hide(), e.wrap.fadeOut()
                        },
                        updateSize: function() {
                            if (stGlobals.isIOS) {
                                var i = document.documentElement.clientWidth / window.innerWidth,
                                    s = window.innerHeight * i;
                                e.contentContainer.css("height", s)
                            } else stGlobals.isMobile && e.contentContainer.css("height", t(window).height())
                        },
                        getScrollbarSize: function() {
                            if (document.body.scrollHeight <= t(window).height()) return 0;
                            if (void 0 === e.scrollbarSize) {
                                var i = document.createElement("div");
                                i.style.cssText = "width: 99px; height: 99px; overflow: scroll; position: absolute; top: -9999px;", document.body.appendChild(i), e.scrollbarSize = i.offsetWidth - i.clientWidth, document.body.removeChild(i)
                            }
                            return e.scrollbarSize
                        }
                    }, t.fn.soapPopup = function(s) {
                        return (e = new i).init(), t(document).bind("keydown", (function(i) {
                            var s = i.keyCode;
                            t(".opacity-overlay:visible").length > 0 && 27 === s && (i.preventDefault(), e.close())
                        })), t(document).on("click touchend", ".opacity-overlay", (function(i) {
                            t("body").hasClass("overlay-open") && !t(i.target).is(".opacity-overlay .popup-content *") && (i.preventDefault(), e.close())
                        })), t(document).on("click touchend", ".opacity-overlay [data-dismiss='modal']", (function(t) {
                            e.close()
                        })), t(window).resize((function() {
                            e.updateSize()
                        })), e.open(s, t(this)), t(this)
                    }
                }(jQuery), "undefined" == typeof enableChaser && (enableChaser = 1), $("body").on("click", "a.popup-gallery", (function(t) {
                    return t.preventDefault(), !1
                })), $(document).ready((function() {
                    changeTraveloElementUI(), stGlobals.isMobile && $("body").addClass("is-mobile"), stGlobals.isMobileWebkit && $(".parallax").css("background-attachment", "scroll")
                })), $(window).on((function() {
                    if ($("body").on("click", "#back-to-top", (function(t) {
                            t.preventDefault(), $("html,body").animate({
                                scrollTop: 0
                            }, 1e3)
                        })), $("#mobile-search-tabs").length > 0) $("#mobile-search-tabs").bxSlider({
                        mode: "fade",
                        infiniteLoop: !1,
                        hideControlOnEnd: !0,
                        touchEnabled: !0,
                        pager: !1,
                        onSlideAfter: function(t, e, i) {
                            $('a[href="' + $(t).children("a").attr("href") + '"]').tab("show")
                        }
                    });

                    function t() {
                        $("#main-menu .menu li.menu-item-has-children > ul, .ribbon ul.menu.mini").each((function(t) {
                            $(this).closest(".megamenu").length > 0 || ($(this).parent().offset().left + $(this).parent().width() + $(this).width() > $("body").width() ? $(this).addClass("left") : $(this).removeClass("left"))
                        }))
                    }
                    if ($(".mobile-menu ul.menu > li.menu-item-has-children").each((function(t) {
                            var e = "mobile-menu-submenu-item-" + t;
                            $('<button class="dropdown-toggle collapsed" data-toggle="collapse" data-target="#' + e + '"></button>').insertAfter($(this).children("a")), $(this).children("ul").prop("id", e), $(this).children("ul").addClass("collapse"), $("#" + e).on("show.bs.collapse", (function() {
                                $(this).parent().addClass("open")
                            })), $("#" + e).on("hidden.bs.collapse", (function() {
                                $(this).parent().removeClass("open")
                            }))
                        })), $(".middle-block").middleblock(), t(), 1 == enableChaser && $("#content").length > 0 && $("#main-menu ul.menu").length > 0) {
                        var e, i = $("#main-menu ul.menu").clone().hide().appendTo(document.body).wrap("<div class='chaser hidden-mobile'><div class='container'></div></div>");
                        $('<h1 class="logo navbar-brand"><a title="Travelo - home" href="index.html"><img alt="" src="https://www.compareparkingdeals.uk/images/logo.png"></a></h1>').insertBefore(".chaser .menu");
                        var s = $("#content").first();
                        e = s.offset().top + 2, $(window).on("scroll", (function() {
                            var t = $(document).scrollTop();
                            $(".chaser").is(":hidden") && t > e ? $(".chaser").slideDown(300) : $(".chaser").is(":visible") && t < e && $(".chaser").slideUp(200)
                        })), $(window).on("resize", (function() {
                            var t = $(document).scrollTop();
                            $(".chaser").is(":hidden") && t > e ? $(".chaser").slideDown(300) : $(".chaser").is(":visible") && t < e && $(".chaser").slideUp(200)
                        })), $(".chaser").css("visibility", "hidden"), i.show(), fixPositionMegaMenu(".chaser"), $(".chaser .megamenu-menu").removeClass("light"), $(".chaser").hide(), $(".chaser").css("visibility", "visible")
                    }

                    function n(t) {
                        var e = 0;
                        $(t).find(".slides > li").each((function() {
                            $(this).css("height", "auto"), $(this).height() > e && (e = $(this).height())
                        })), $(t).find(".slides > li").height(e)
                    }

                    function o() {
                        try {
                            $(".testimonial.style1").length > 0 && $(".testimonial.style1").is(":visible") && $(".testimonial.style1").flexslider({
                                namespace: "testimonial-",
                                animation: "slide",
                                controlNav: !0,
                                animationLoop: !1,
                                directionNav: !1,
                                slideshow: !1,
                                start: n
                            })
                        } catch (t) {}
                        try {
                            $(".testimonial.style2").length > 0 && $(".testimonial.style2").is(":visible") && $(".testimonial.style2").flexslider({
                                namespace: "testimonial-",
                                animation: "slide",
                                controlNav: !1,
                                animationLoop: !1,
                                directionNav: !0,
                                slideshow: !1,
                                start: n
                            })
                        } catch (t) {}
                        try {
                            $(".testimonial.style3").length > 0 && $(".testimonial.style3").is(":visible") && $(".testimonial.style3").flexslider({
                                namespace: "testimonial-",
                                controlNav: !1,
                                animationLoop: !1,
                                directionNav: !0,
                                slideshow: !1,
                                start: n
                            })
                        } catch (t) {}
                    }

                    function a() {
                        $(".promo-box").each((function() {
                            if ("right" == $(this).find(".content-section").css("float")) {
                                var t = $(this).find(".image-container > img").height();
                                $(this).find(".content-section .table-wrapper").css("height", "auto");
                                var e = $(".content-section").css("padding-top"),
                                    i = $(".content-section").css("padding-bottom"),
                                    s = 0;
                                try {
                                    s = parseInt(e, 10) + parseInt(i, 10)
                                } catch (t) {}
                                var n = $(this).find(".content-section >.table-wrapper").length > 0 ? $(this).find(".content-section > .table-wrapper").height() + s : $(this).find(".content-section").innerHeight();
                                t < n ? t = n : t += 15, $(this).find(".image-container").height(t), $(this).find(".content-section").innerHeight(t), $(this).find(".content-section .table-wrapper").css("height", "100%"), $(this).find(".image-container").css("margin-left", "-5%"), $(this).find(".image-container").css("position", "relative"), $(this).find(".image-container > img").css("position", "absolute"), $(this).find(".image-container > img").css("bottom", "0"), $(this).find(".image-container > img").css("left", "0")
                            } else $(this).find(".image-container").css("height", "auto"), $(this).find(".image-container").css("margin", "0"), $(this).find(".content-section").css("height", "auto"), $(this).find(".image-container > img").css("position", "static");
                            $(this).find(".image-container > img").hasClass("animated") || $(this).find(".image-container > img").css("visibility", "visible")
                        }))
                    }
                    $(".toggle-container .panel-collapse").each((function() {
                        $(this).hasClass("in") || $(this).closest(".panel").find("[data-toggle=collapse]").addClass("collapsed")
                    })), $(".toggle-container.with-image").each((function() {
                        var t = "",
                            e = "1s";
                        void 0 !== $(this).data("image-animation-type") && (t = $(this).data("image-animation-type")), void 0 !== $(this).data("image-animation-duration") && (e = $(this).data("image-animation-duration"));
                        var i = '<div class="image-container';
                        if ("" != t && (i += ' animated" data-animation-type="' + t + '" data-animation-duration="' + e), i += '"><img src="" alt="" /></div>', $(this).prepend(i), $(this).find(".panel-collapse.in").length > 0) {
                            var s = $(this).find(".panel-collapse.in").parent().children("img"),
                                n = s.attr("src"),
                                o = s.attr("width"),
                                a = s.attr("height"),
                                r = s.attr("alt"),
                                l = $(this).find(".image-container img");
                            l.attr("src", n), void 0 !== o && l.attr("width", o), void 0 !== a && l.attr("height", a), void 0 !== r && l.attr("alt", r), $(this).children(".image-container").show()
                        }
                    })), $(".toggle-container.with-image").on("show.bs.collapse", (function(t) {
                        var e = $(t.target).parent().children("img");
                        if (e.length > 0) {
                            var i = e.attr("src"),
                                s = e.attr("width"),
                                n = e.attr("height"),
                                o = e.attr("alt"),
                                a = $(this).find(".image-container img");
                            a.attr("src", i), void 0 !== s && a.attr("width", s), void 0 !== n && a.attr("height", n), void 0 !== o && a.attr("alt", o), a.parent().css("visibility", "hidden"), a.parent().removeClass(a.parent().data("animation-type")), setTimeout((function() {
                                a.parent().addClass(a.parent().data("animation-type")), a.parent().css("visibility", "visible")
                            }), 10)
                        }
                    })), $(".toggle-container.with-image").on("shown.bs.collapse", (function(t) {})), $("body").on("click", ".alert > .close, .info-box > .close", (function() {
                        $(this).parent().fadeOut(300)
                    })), $("[data-toggle=tooltip]").tooltip(), o(), $(".image-carousel").each((function() {
                        displayImageCarousel($(this))
                    })), $(".photo-gallery").each((function() {
                        displayPhotoGallery($(this))
                    })), $('a[data-toggle="tab"]').on("shown.bs.tab", (function(t) {
                        var e = $(t.target).attr("href");
                        $(e).find(".image-carousel").length > 0 && displayImageCarousel($(e).find(".image-carousel")), $(e).find(".photo-gallery").length > 0 && displayPhotoGallery($(e).find(".photo-gallery")), $(e).find(".testimonial").length > 0 && o(), $(e).find(".middle-block").middleblock()
                    })), $("body").on("click", "a.popup-gallery", (function(t) {
                        t.preventDefault(), $(this).soapPopup({
                            type: "ajax",
                            wrapId: "soap-gallery-popup",
                            callBack: function(t) {
                                t.wrap.find(".image-carousel").length > 0 && displayImageCarousel(t.wrap.find(".image-carousel")), t.wrap.find(".photo-gallery").length > 0 && displayPhotoGallery(t.wrap.find(".photo-gallery"))
                            }
                        })
                    })), $("body").on("click", ".popup-map", (function(t) {
                        var e = $(this).data("box");
                        void 0 !== e && (t.preventDefault(), $(this).soapPopup({
                            type: "map",
                            zoom: 12,
                            wrapId: "soap-map-popup",
                            lngltd: e
                        }))
                    })), $("body").on("click", ".soap-popupbox", (function(t) {
                        t.preventDefault();
                        var e = $(this).attr("href");
                        void 0 === e && (e = $(this).data("target")), void 0 !== e && ($(e).length < 1 || $(this).soapPopup({
                            wrapId: "soap-popupbox"
                        }))
                    })), $(".style-changer .design-skins a").click((function(t) {
                        t.preventDefault(), $(this).closest("ul").children("li").removeClass("active"), $(this).parent().addClass("active")
                    })), $("#style-changer .style-toggle").click((function(t) {
                        t.preventDefault(), $(this).hasClass("open") ? ($("#style-changer").css("left", "0"), $(this).removeClass("open"), $(this).addClass("close")) : ($("#style-changer").css("left", "-275px"), $(this).removeClass("close"), $(this).addClass("open"))
                    })), $(".filters-container .filters-option a").click((function(t) {
                        t.preventDefault(), $(this).parent().hasClass("active") ? $(this).parent().removeClass("active") : $(this).parent().addClass("active")
                    })), $(".sort-trip a").click((function(t) {
                        t.preventDefault(), $(this).parent().parent().children().removeClass("active"), $(this).parent().addClass("active")
                    })), $(".location-reload").click((function(t) {
                        t.preventDefault();
                        var e = $(this).prop("href").split("#")[0];
                        if (-1 != window.location.href.indexOf(e)) {
                            var i = $(this).prop("href").split("#")[1];
                            void 0 !== i && "" != i && $("a[href='#" + i + "']").length > 0 && $("a[href='#" + i + "']").tab("show")
                        } else window.location.href = $(this).prop("href")
                    })), a(), $.fn.fitVids && $(".full-video").fitVids(), $(".go-back").click((function(t) {
                        t.preventDefault(), window.history.go(-1)
                    }));
                    var r = window.location.hash;

                    function l() {
                        if (1 == $(".slideshow-bg.full-screen").length) {
                            var t = $(".slideshow-bg.full-screen").offset().top;
                            $(".slideshow-bg.full-screen").height($(window).height() - t)
                        }
                    }
                    "" != r && (r = escape(r.replace("#", "")), $('a[href="#' + r + '"]').length > 0 && setTimeout((function() {
                        $('a[href="#' + r + '"]').tab("show")
                    }), 100)), !stGlobals.isMobileWebkit && $(".parallax").length > 0 && $.stellar({
                        responsive: !0,
                        horizontalScrolling: !1
                    }), $().waypoint && !stGlobals.isMobile && $(".animated").waypoint((function() {
                        var t = $(this).data("animation-type");
                        void 0 !== t && 0 != t || (t = "fadeIn"), $(this).addClass(t);
                        var e = $(this).data("animation-duration");
                        void 0 !== e && 0 != e || (e = "1"), $(this).css("animation-duration", e + "s");
                        var i = $(this).data("animation-delay");
                        void 0 !== i && 0 != i && $(this).css("animation-delay", i + "s"), $(this).css("visibility", "visible"), setTimeout((function() {
                            $.waypoints("refresh")
                        }), 1e3)
                    }), {
                        triggerOnce: !0,
                        offset: "bottom-in-view"
                    }), $().waypoint ? $(".counters-box").waypoint((function() {
                        $(this).find(".display-counter").each((function() {
                            var t = $(this).data("value");
                            $(this).countTo({
                                from: 0,
                                to: t,
                                speed: 3e3,
                                refreshInterval: 10
                            })
                        })), setTimeout((function() {
                            $.waypoints("refresh")
                        }), 1e3)
                    }), {
                        triggerOnce: !0,
                        offset: "100%"
                    }) : $(".counters-box .display-counter").each((function() {
                        var t = $(this).data("value");
                        $(this).text(t)
                    })), $("body").on("click", (function(t) {
                        $(t.target).is(".mobile-topnav .ribbon.opened *") || ($(".mobile-topnav .ribbon.opened > .menu").toggle(), $(".mobile-topnav .ribbon.opened").removeClass("opened"))
                    })), $(".mobile-topnav .ribbon > a").on("click", (function(t) {
                        if (t.preventDefault(), $(".mobile-topnav .ribbon.opened").length > 0 && !$(this).parent().hasClass("opened") && ($(".mobile-topnav .ribbon.opened > .menu").toggle(), $(".mobile-topnav .ribbon.opened").removeClass("opened")), $(this).parent().toggleClass("opened"), $(this).parent().children(".menu").toggle(200), $(this).parent().hasClass("opened") && $(this).parent().children(".menu").offset().left + $(this).parent().children(".menu").width() > $("body").width()) {
                            var e = $(this).parent().children(".menu").offset().left + $(this).parent().children(".menu").width() - $("body").width();
                            e = $(this).parent().children(".menu").position().left - e - 1, $(this).parent().children(".menu").css("left", e + "px")
                        } else $(this).parent().children(".menu").css("left", "0")
                    })), l(), $(".items-container.isotope").each((function() {
                        if ($.fn.isotope) {
                            var t = $(this),
                                e = t.siblings(".gallery-filter").find("a"),
                                i = {
                                    layoutMode: "fitRows",
                                    itemSelector: ".iso-item",
                                    animationEngine: "best-available",
                                    resizable: !1
                                };
                            e.bind("click", (function() {
                                var s = $(this),
                                    n = s.data("filter");
                                return e.removeClass("active"), s.addClass("active"), i.filter = "." + n, t.isotope(i, (function() {
                                    t.css({
                                        overflow: "visible"
                                    })
                                })), !1
                            })), $(window).on("debouncedresize", (function() {
                                t.isotope("reLayout")
                            })), t.addClass("active").isotope(i, (function() {
                                t.css({
                                    overflow: "visible"
                                })
                            }))
                        }
                    })), $(window).resize((function() {
                        $(".middle-block").middleblock(), fixPositionMegaMenu(), t(), a(), n(".testimonial"), $(".photo-gallery.style2").length > 0 && $(".photo-gallery.style2").each((function() {
                            var t = $(this).find(".slides img").height();
                            $(this).find(".flex-control-nav").css("top", t - 44 + "px")
                        })), l()
                    }))
                }));
            var megamenu_items_per_column = 6;

            function fixPositionMegaMenu(t) {
                void 0 === t ? t = "" : t += " ", $(t + ".megamenu-menu").each((function() {
                    var t = $(this).closest(".container").css("padding-left"),
                        e = parseInt(t, 10),
                        i = $(this).offset().left - $(this).closest(".container").offset().left - e;
                    if (0 != i) {
                        $(this).children(".megamenu-wrapper").css("left", "-" + i + "px"), $(this).children(".megamenu-wrapper").css("width", $(this).closest(".container").width() + "px"), void 0 !== $(this).children(".megamenu-wrapper").data("items-per-column") && (megamenu_items_per_column = parseInt($(this).children(".megamenu-wrapper").data("items-per-column"), 10));
                        var s = new Array,
                            n = 0;
                        $(this).find(".megamenu > li").each((function() {
                            var t = Math.ceil($(this).find("li > a").length / megamenu_items_per_column);
                            0 == t && (t = 1), s.push(t), n += t
                        })), $(this).find(".megamenu > li").each((function(t) {
                            $(this).css("width", s[t] / n * 100 + "%"), $(this).addClass("megamenu-columns-" + s[t])
                        })), $(this).find(".megamenu > li.menu-item-has-children").each((function(t) {
                            if ($(this).children(".sub-menu").length < 1) {
                                $(this).append("<ul class='sub-menu'></ul>");
                                for (var e = 0; e < s[t]; e++) $(this).children(".sub-menu").append("<li><ul></ul></li>");
                                var i = $(this).children("ul").eq(0).children("li").length - 1;
                                $(this).children("ul").eq(0).children("li").each((function(t) {
                                    var e = Math.floor(t / megamenu_items_per_column);
                                    $(this).closest("li.menu-item-has-children").children(".sub-menu").children("li").eq(e).children("ul").append($(this).clone()), t == i && $(this).closest(".menu-item-has-children").children("ul").eq(0).remove()
                                }))
                            }
                        })), $(this).children(".megamenu-wrapper").show()
                    }
                }))
            }
            fixPositionMegaMenu(), $("body").on("click", ".travelo-signup-box .signup-email", (function(t) {
                t.preventDefault(), $(this).closest(".travelo-signup-box").find(".simple-signup").hide(), $(this).closest(".travelo-signup-box").find(".email-signup").show(), $(this).closest(".travelo-signup-box").find(".email-signup").find(".input-text").eq(0).focus()
            })), $(document).ready((function() {
                var t = window.location.pathname.split(/[/ ]+/).pop();
                $("#main-menu a, #mobile-primary-menu a").each((function() {
                    var e = $(this),
                        i = e.attr("href"),
                        s = e.parents("li");
                    t == i && s.addClass("active").siblings().removeClass("active")
                }))
            }))
        },
        c7f5d42a936dab2594fa: function(t, e, i) {},
        c9347281b07959a490d0: function(t, e) {
            $("#paymentStrip3dsPage").length && $(document).ready((function() {
                var t = "1" == is_stripe3DSeure_test_active ? stripe3DSecure_test_public_key : stripe3DSecure_live_public_key;
                if (window.Stripe) {
                    var e = Stripe(t),
                        i = e.elements(),
                        s = i.create("cardNumber");
                    s.mount("#cardNumberElement");
                    var n = i.create("cardExpiry");
                    n.mount("#expiryDateElement");
                    var o = i.create("cardCvc");
                    o.mount("#cvcElement"), document.getElementById("card-button"), s.addEventListener("change", (function(t) {
                        var e = $("span[for=cardNumberElement]");
                        t.error ? e.html("<span id='nameOnCardElement-error' class='error'>" + t.error.message + "</span>") : e.html("")
                    })), n.addEventListener("change", (function(t) {
                        var e = $("span[for=expiryDateElement]");
                        t.error ? e.html("<span id='nameOnCardElement-error' class='error'>" + t.error.message + "</span>") : e.html("")
                    })), o.addEventListener("change", (function(t) {
                        var e = $("span[for=cvcElement]");
                        t.error ? e.html("<span id='nameOnCardElement-error' class='error'>" + t.error.message + "</span>") : e.html("")
                    }))
                } else a("Stripe3d secure javascript initialization failed. <br> These are the probable causes of this error in sequence <br> 1: Please check you network / internet connection <br> 2: Make sure your browser has javascript enabled <br> 3: Make sure your browser is latest and upto dated<br> Note: Please refresh the page to see if above problem still exists"), $("#card-button").addClass("btn btn-large btn-block btn-default"), $("#card-button").attr("disabled", !0);

                function a(t) {
                    var e, i = $("#Stripe3DS_Log_Error_Message_Div"),
                        s = $("#Stripe3DS_Log_Error_Message");
                    s.text(""), i.removeClass("hidden"), s.html(t), e = i, $("html, body").animate({
                        scrollTop: e.offset().top - 100
                    }, 500)
                }
                $("#card-button").click((function(t) {
                    t.preventDefault(), $("#Stripe3DS_Loader").modal("show");
                    var i = void 0 !== $("#card-button").data("secret"),
                        n = $("#card-button").attr("data-secret");
                    if (i && "" != n) {
                        var o = $("#FirstName").val() + " " + $("#LastName").val(),
                            r = $("#Email").val(),
                            l = $("#paymentIntentID");
                        "" !== l.val() ? ($("#paymentWrapper").hide(), $("#PaymentForm").trigger("submit")) : e.handleCardPayment(n, s, {
                            payment_method_data: {
                                billing_details: {
                                    name: o,
                                    email: r
                                }
                            }
                        }).then((function(t) {
                            t.error ? ($("#Stripe3DS_Loader").modal("hide"), a(t.error.message)) : (l.val(t.paymentIntent.id), "" !== l.val() ? $.ajax({
                                type: "GET",
                                url: "./saveOrderIDToSession.php?orderID=" + l.val() + "&type=stripe",
                                success: function(t) {
                                    var e, i;
                                    $("#PaymentForm").trigger("submit"), $("#paymentWrapper").hide(), $("#alreadyPaid").show(), $("#back").hide(), e = $("#Stripe3DS_Log_Error_Message_Div"), i = $("#Stripe3DS_Log_Error_Message"), e.addClass("hidden"), i.text("")
                                }
                            }) : a("Some thing went terribly wrong with stripe3d secure payment."))
                        }))
                    } else window.location.replace(sitePath + "/PaymentStripe.php?status=false&message=Stripe3d secure initialization was failed, Stripe reloaded again. Please continue your booking or choose a different payment method if you continuously face the same problem.&hideonclick=true")
                })), $("#back").on("click", (function() {
                    window.location.replace(sitePath + "/bookingdetails.php")
                })), $("#pencil").click((function() {
                    $("#booking_panel").show(), $(".page-title-container").height("auto")
                }))
            }))
        },
        cb25021b866fec983918: function(t, e, i) {
            var s, n, o;

            function a(t) {
                return (a = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function(t) {
                    return typeof t
                } : function(t) {
                    return t && "function" == typeof Symbol && t.constructor === Symbol && t !== Symbol.prototype ? "symbol" : typeof t
                })(t)
            }! function(r) {
                "use strict";
                n = [i("7a7fe18389b53515766d")], void 0 === (o = "function" == typeof(s = function(t) {
                    var e = -1,
                        i = -1,
                        s = function(t) {
                            return parseFloat(t) || 0
                        },
                        n = function(e) {
                            var i = t(e),
                                n = null,
                                o = [];
                            return i.each((function() {
                                var e = t(this),
                                    i = e.offset().top - s(e.css("margin-top")),
                                    a = o.length > 0 ? o[o.length - 1] : null;
                                null === a ? o.push(e) : Math.floor(Math.abs(n - i)) <= 1 ? o[o.length - 1] = a.add(e) : o.push(e), n = i
                            })), o
                        },
                        o = function(e) {
                            var i = {
                                byRow: !0,
                                property: "height",
                                target: null,
                                remove: !1
                            };
                            return "object" === a(e) ? t.extend(i, e) : ("boolean" == typeof e ? i.byRow = e : "remove" === e && (i.remove = !0), i)
                        },
                        r = t.fn.matchHeight = function(e) {
                            var i = o(e);
                            if (i.remove) {
                                var s = this;
                                return this.css(i.property, ""), t.each(r._groups, (function(t, e) {
                                    e.elements = e.elements.not(s)
                                })), this
                            }
                            return this.length <= 1 && !i.target || (r._groups.push({
                                elements: this,
                                options: i
                            }), r._apply(this, i)), this
                        };
                    r.version = "master", r._groups = [], r._throttle = 80, r._maintainScroll = !1, r._beforeUpdate = null, r._afterUpdate = null, r._rows = n, r._parse = s, r._parseOptions = o, r._apply = function(e, i) {
                        var a = o(i),
                            l = t(e),
                            h = [l],
                            c = t(window).scrollTop(),
                            u = t("html").outerHeight(!0),
                            d = l.parents().filter(":hidden");
                        return d.each((function() {
                            var e = t(this);
                            e.data("style-cache", e.attr("style"))
                        })), d.css("display", "block"), a.byRow && !a.target && (l.each((function() {
                            var e = t(this),
                                i = e.css("display");
                            "inline-block" !== i && "flex" !== i && "inline-flex" !== i && (i = "block"), e.data("style-cache", e.attr("style")), e.css({
                                display: i,
                                "padding-top": "0",
                                "padding-bottom": "0",
                                "margin-top": "0",
                                "margin-bottom": "0",
                                "border-top-width": "0",
                                "border-bottom-width": "0",
                                height: "100px",
                                overflow: "hidden"
                            })
                        })), h = n(l), l.each((function() {
                            var e = t(this);
                            e.attr("style", e.data("style-cache") || "")
                        }))), t.each(h, (function(e, i) {
                            var n = t(i),
                                o = 0;
                            if (a.target) o = a.target.outerHeight(!1);
                            else {
                                if (a.byRow && n.length <= 1) return void n.css(a.property, "");
                                n.each((function() {
                                    var e = t(this),
                                        i = e.attr("style"),
                                        s = e.css("display");
                                    "inline-block" !== s && "flex" !== s && "inline-flex" !== s && (s = "block");
                                    var n = {
                                        display: s
                                    };
                                    n[a.property] = "", e.css(n), e.outerHeight(!1) > o && (o = e.outerHeight(!1)), i ? e.attr("style", i) : e.css("display", "")
                                }))
                            }
                            n.each((function() {
                                var e = t(this),
                                    i = 0;
                                a.target && e.is(a.target) || ("border-box" !== e.css("box-sizing") && (i += s(e.css("border-top-width")) + s(e.css("border-bottom-width")), i += s(e.css("padding-top")) + s(e.css("padding-bottom"))), e.css(a.property, o - i + "px"))
                            }))
                        })), d.each((function() {
                            var e = t(this);
                            e.attr("style", e.data("style-cache") || null)
                        })), r._maintainScroll && t(window).scrollTop(c / u * t("html").outerHeight(!0)), this
                    }, r._applyDataApi = function() {
                        var e = {};
                        t("[data-match-height], [data-mh]").each((function() {
                            var i = t(this),
                                s = i.attr("data-mh") || i.attr("data-match-height");
                            e[s] = s in e ? e[s].add(i) : i
                        })), t.each(e, (function() {
                            this.matchHeight(!0)
                        }))
                    };
                    var l = function(e) {
                        r._beforeUpdate && r._beforeUpdate(e, r._groups), t.each(r._groups, (function() {
                            r._apply(this.elements, this.options)
                        })), r._afterUpdate && r._afterUpdate(e, r._groups)
                    };
                    r._update = function(s, n) {
                        if (n && "resize" === n.type) {
                            var o = t(window).width();
                            if (o === e) return;
                            e = o
                        }
                        s ? -1 === i && (i = setTimeout((function() {
                            l(n), i = -1
                        }), r._throttle)) : l(n)
                    }, t(r._applyDataApi);
                    var h = t.fn.on ? "on" : "bind";
                    t(window)[h]("load", (function(t) {
                        r._update(!1, t)
                    })), t(window)[h]("resize orientationchange", (function(t) {
                        r._update(!0, t)
                    }))
                }) ? s.apply(e, n) : s) || (t.exports = o)
            }()
        },
        f00014218db805a4c898: function(t, e, i) {
            var s, n, o;

            function a(t) {
                return (a = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function(t) {
                    return typeof t
                } : function(t) {
                    return t && "function" == typeof Symbol && t.constructor === Symbol && t !== Symbol.prototype ? "symbol" : typeof t
                })(t)
            }
            /*! jQuery Validation Plugin - v1.13.1 - 10/14/2014
             * http://jqueryvalidation.org/
             * Copyright (c) 2014 JÃƒÂ¶rn Zaefferer; Licensed MIT */
            n = [i("7a7fe18389b53515766d")], void 0 === (o = "function" == typeof(s = function(t) {
                t.extend(t.fn, {
                    validate: function(e) {
                        if (this.length) {
                            var i = t.data(this[0], "validator");
                            return i || (this.attr("novalidate", "novalidate"), i = new t.validator(e, this[0]), t.data(this[0], "validator", i), i.settings.onsubmit && (this.validateDelegate(":submit", "click", (function(e) {
                                i.settings.submitHandler && (i.submitButton = e.target), t(e.target).hasClass("cancel") && (i.cancelSubmit = !0), void 0 !== t(e.target).attr("formnovalidate") && (i.cancelSubmit = !0)
                            })), this.submit((function(e) {
                                function s() {
                                    var s, n;
                                    return !i.settings.submitHandler || (i.submitButton && (s = t("<input type='hidden'/>").attr("name", i.submitButton.name).val(t(i.submitButton).val()).appendTo(i.currentForm)), n = i.settings.submitHandler.call(i, i.currentForm, e), i.submitButton && s.remove(), void 0 !== n && n)
                                }
                                return i.settings.debug && e.preventDefault(), i.cancelSubmit ? (i.cancelSubmit = !1, s()) : i.form() ? i.pendingRequest ? (i.formSubmitted = !0, !1) : s() : (i.focusInvalid(), !1)
                            }))), i)
                        }
                        e && e.debug && window.console && console.warn("Nothing selected, can't validate, returning nothing.")
                    },
                    valid: function() {
                        var e, i;
                        return t(this[0]).is("form") ? e = this.validate().form() : (e = !0, i = t(this[0].form).validate(), this.each((function() {
                            e = i.element(this) && e
                        }))), e
                    },
                    removeAttrs: function(e) {
                        var i = {},
                            s = this;
                        return t.each(e.split(/\s/), (function(t, e) {
                            i[e] = s.attr(e), s.removeAttr(e)
                        })), i
                    },
                    rules: function(e, i) {
                        var s, n, o, a, r, l, h = this[0];
                        if (e) switch (s = t.data(h.form, "validator").settings, n = s.rules, o = t.validator.staticRules(h), e) {
                            case "add":
                                t.extend(o, t.validator.normalizeRule(i)), delete o.messages, n[h.name] = o, i.messages && (s.messages[h.name] = t.extend(s.messages[h.name], i.messages));
                                break;
                            case "remove":
                                return i ? (l = {}, t.each(i.split(/\s/), (function(e, i) {
                                    l[i] = o[i], delete o[i], "required" === i && t(h).removeAttr("aria-required")
                                })), l) : (delete n[h.name], o)
                        }
                        return (a = t.validator.normalizeRules(t.extend({}, t.validator.classRules(h), t.validator.attributeRules(h), t.validator.dataRules(h), t.validator.staticRules(h)), h)).required && (r = a.required, delete a.required, a = t.extend({
                            required: r
                        }, a), t(h).attr("aria-required", "true")), a.remote && (r = a.remote, delete a.remote, a = t.extend(a, {
                            remote: r
                        })), a
                    }
                }), t.extend(t.expr[":"], {
                    blank: function(e) {
                        return !t.trim("" + t(e).val())
                    },
                    filled: function(e) {
                        return !!t.trim("" + t(e).val())
                    },
                    unchecked: function(e) {
                        return !t(e).prop("checked")
                    }
                }), t.validator = function(e, i) {
                    this.settings = t.extend(!0, {}, t.validator.defaults, e), this.currentForm = i, this.init()
                }, t.validator.format = function(e, i) {
                    return 1 === arguments.length ? function() {
                        var i = t.makeArray(arguments);
                        return i.unshift(e), t.validator.format.apply(this, i)
                    } : (arguments.length > 2 && i.constructor !== Array && (i = t.makeArray(arguments).slice(1)), i.constructor !== Array && (i = [i]), t.each(i, (function(t, i) {
                        e = e.replace(new RegExp("\\{" + t + "\\}", "g"), (function() {
                            return i
                        }))
                    })), e)
                }, t.extend(t.validator, {
                    defaults: {
                        messages: {},
                        groups: {},
                        rules: {},
                        errorClass: "error",
                        validClass: "valid",
                        errorElement: "label",
                        focusCleanup: !1,
                        focusInvalid: !0,
                        errorContainer: t([]),
                        errorLabelContainer: t([]),
                        onsubmit: !0,
                        ignore: ":hidden",
                        ignoreTitle: !1,
                        onfocusin: function(t) {
                            this.lastActive = t, this.settings.focusCleanup && (this.settings.unhighlight && this.settings.unhighlight.call(this, t, this.settings.errorClass, this.settings.validClass), this.hideThese(this.errorsFor(t)))
                        },
                        onfocusout: function(t) {
                            this.checkable(t) || !(t.name in this.submitted) && this.optional(t) || this.element(t)
                        },
                        onkeyup: function(t, e) {
                            (9 !== e.which || "" !== this.elementValue(t)) && (t.name in this.submitted || t === this.lastElement) && this.element(t)
                        },
                        onclick: function(t) {
                            t.name in this.submitted ? this.element(t) : t.parentNode.name in this.submitted && this.element(t.parentNode)
                        },
                        highlight: function(e, i, s) {
                            "radio" === e.type ? this.findByName(e.name).addClass(i).removeClass(s) : t(e).addClass(i).removeClass(s)
                        },
                        unhighlight: function(e, i, s) {
                            "radio" === e.type ? this.findByName(e.name).removeClass(i).addClass(s) : t(e).removeClass(i).addClass(s)
                        }
                    },
                    setDefaults: function(e) {
                        t.extend(t.validator.defaults, e)
                    },
                    messages: {
                        required: "This field is required.",
                        remote: "Please fix this field.",
                        email: "Please enter a valid email address.",
                        url: "Please enter a valid URL.",
                        date: "Please enter a valid date.",
                        dateISO: "Please enter a valid date ( ISO ).",
                        number: "Please enter a valid number.",
                        digits: "Please enter only digits.",
                        creditcard: "Please enter a valid credit card number.",
                        equalTo: "Please enter the same value again.",
                        maxlength: t.validator.format("Please enter no more than {0} characters."),
                        minlength: t.validator.format("Please enter at least {0} characters."),
                        rangelength: t.validator.format("Please enter a value between {0} and {1} characters long."),
                        range: t.validator.format("Please enter a value between {0} and {1}."),
                        max: t.validator.format("Please enter a value less than or equal to {0}."),
                        min: t.validator.format("Please enter a value greater than or equal to {0}.")
                    },
                    autoCreateRanges: !1,
                    prototype: {
                        init: function() {
                            function e(e) {
                                var i = t.data(this[0].form, "validator"),
                                    s = "on" + e.type.replace(/^validate/, ""),
                                    n = i.settings;
                                n[s] && !this.is(n.ignore) && n[s].call(i, this[0], e)
                            }
                            this.labelContainer = t(this.settings.errorLabelContainer), this.errorContext = this.labelContainer.length && this.labelContainer || t(this.currentForm), this.containers = t(this.settings.errorContainer).add(this.settings.errorLabelContainer), this.submitted = {}, this.valueCache = {}, this.pendingRequest = 0, this.pending = {}, this.invalid = {}, this.reset();
                            var i, s = this.groups = {};
                            t.each(this.settings.groups, (function(e, i) {
                                "string" == typeof i && (i = i.split(/\s/)), t.each(i, (function(t, i) {
                                    s[i] = e
                                }))
                            })), i = this.settings.rules, t.each(i, (function(e, s) {
                                i[e] = t.validator.normalizeRule(s)
                            })), t(this.currentForm).validateDelegate(":text, [type='password'], [type='file'], select, textarea, [type='number'], [type='search'] ,[type='tel'], [type='url'], [type='email'], [type='datetime'], [type='date'], [type='month'], [type='week'], [type='time'], [type='datetime-local'], [type='range'], [type='color'], [type='radio'], [type='checkbox']", "focusin focusout keyup", e).validateDelegate("select, option, [type='radio'], [type='checkbox']", "click", e), this.settings.invalidHandler && t(this.currentForm).bind("invalid-form.validate", this.settings.invalidHandler), t(this.currentForm).find("[required], [data-rule-required], .required").attr("aria-required", "true")
                        },
                        form: function() {
                            return this.checkForm(), t.extend(this.submitted, this.errorMap), this.invalid = t.extend({}, this.errorMap), this.valid() || t(this.currentForm).triggerHandler("invalid-form", [this]), this.showErrors(), this.valid()
                        },
                        checkForm: function() {
                            this.prepareForm();
                            for (var t = 0, e = this.currentElements = this.elements(); e[t]; t++) this.check(e[t]);
                            return this.valid()
                        },
                        element: function(e) {
                            var i = this.clean(e),
                                s = this.validationTargetFor(i),
                                n = !0;
                            return this.lastElement = s, void 0 === s ? delete this.invalid[i.name] : (this.prepareElement(s), this.currentElements = t(s), (n = !1 !== this.check(s)) ? delete this.invalid[s.name] : this.invalid[s.name] = !0), t(e).attr("aria-invalid", !n), this.numberOfInvalids() || (this.toHide = this.toHide.add(this.containers)), this.showErrors(), n
                        },
                        showErrors: function(e) {
                            if (e) {
                                for (var i in t.extend(this.errorMap, e), this.errorList = [], e) this.errorList.push({
                                    message: e[i],
                                    element: this.findByName(i)[0]
                                });
                                this.successList = t.grep(this.successList, (function(t) {
                                    return !(t.name in e)
                                }))
                            }
                            this.settings.showErrors ? this.settings.showErrors.call(this, this.errorMap, this.errorList) : this.defaultShowErrors()
                        },
                        resetForm: function() {
                            t.fn.resetForm && t(this.currentForm).resetForm(), this.submitted = {}, this.lastElement = null, this.prepareForm(), this.hideErrors(), this.elements().removeClass(this.settings.errorClass).removeData("previousValue").removeAttr("aria-invalid")
                        },
                        numberOfInvalids: function() {
                            return this.objectLength(this.invalid)
                        },
                        objectLength: function(t) {
                            var e, i = 0;
                            for (e in t) i++;
                            return i
                        },
                        hideErrors: function() {
                            this.hideThese(this.toHide)
                        },
                        hideThese: function(t) {
                            t.not(this.containers).text(""), this.addWrapper(t).hide()
                        },
                        valid: function() {
                            return 0 === this.size()
                        },
                        size: function() {
                            return this.errorList.length
                        },
                        focusInvalid: function() {
                            if (this.settings.focusInvalid) try {
                                t(this.findLastActive() || this.errorList.length && this.errorList[0].element || []).filter(":visible").focus().trigger("focusin")
                            } catch (t) {}
                        },
                        findLastActive: function() {
                            var e = this.lastActive;
                            return e && 1 === t.grep(this.errorList, (function(t) {
                                return t.element.name === e.name
                            })).length && e
                        },
                        elements: function() {
                            var e = this,
                                i = {};
                            return t(this.currentForm).find("input, select, textarea").not(":submit, :reset, :image, [disabled], [readonly]").not(this.settings.ignore).filter((function() {
                                return !this.name && e.settings.debug && window.console && console.error("%o has no name assigned", this), !(this.name in i || !e.objectLength(t(this).rules()) || (i[this.name] = !0, 0))
                            }))
                        },
                        clean: function(e) {
                            return t(e)[0]
                        },
                        errors: function() {
                            var e = this.settings.errorClass.split(" ").join(".");
                            return t(this.settings.errorElement + "." + e, this.errorContext)
                        },
                        reset: function() {
                            this.successList = [], this.errorList = [], this.errorMap = {}, this.toShow = t([]), this.toHide = t([]), this.currentElements = t([])
                        },
                        prepareForm: function() {
                            this.reset(), this.toHide = this.errors().add(this.containers)
                        },
                        prepareElement: function(t) {
                            this.reset(), this.toHide = this.errorsFor(t)
                        },
                        elementValue: function(e) {
                            var i, s = t(e),
                                n = e.type;
                            return "radio" === n || "checkbox" === n ? t("input[name='" + e.name + "']:checked").val() : "number" === n && void 0 !== e.validity ? !e.validity.badInput && s.val() : "string" == typeof(i = s.val()) ? i.replace(/\r/g, "") : i
                        },
                        check: function(e) {
                            e = this.validationTargetFor(this.clean(e));
                            var i, s, n, o = t(e).rules(),
                                a = t.map(o, (function(t, e) {
                                    return e
                                })).length,
                                r = !1,
                                l = this.elementValue(e);
                            for (s in o) {
                                n = {
                                    method: s,
                                    parameters: o[s]
                                };
                                try {
                                    if ("dependency-mismatch" === (i = t.validator.methods[s].call(this, l, e, n.parameters)) && 1 === a) {
                                        r = !0;
                                        continue
                                    }
                                    if (r = !1, "pending" === i) return void(this.toHide = this.toHide.not(this.errorsFor(e)));
                                    if (!i) return this.formatAndAdd(e, n), !1
                                } catch (t) {
                                    throw this.settings.debug && window.console && console.log("Exception occurred when checking element " + e.id + ", check the '" + n.method + "' method.", t), t
                                }
                            }
                            if (!r) return this.objectLength(o) && this.successList.push(e), !0
                        },
                        customDataMessage: function(e, i) {
                            return t(e).data("msg" + i.charAt(0).toUpperCase() + i.substring(1).toLowerCase()) || t(e).data("msg")
                        },
                        customMessage: function(t, e) {
                            var i = this.settings.messages[t];
                            return i && (i.constructor === String ? i : i[e])
                        },
                        findDefined: function() {
                            for (var t = 0; t < arguments.length; t++)
                                if (void 0 !== arguments[t]) return arguments[t]
                        },
                        defaultMessage: function(e, i) {
                            return this.findDefined(this.customMessage(e.name, i), this.customDataMessage(e, i), !this.settings.ignoreTitle && e.title || void 0, t.validator.messages[i], "<strong>Warning: No message defined for " + e.name + "</strong>")
                        },
                        formatAndAdd: function(e, i) {
                            var s = this.defaultMessage(e, i.method),
                                n = /\$?\{(\d+)\}/g;
                            "function" == typeof s ? s = s.call(this, i.parameters, e) : n.test(s) && (s = t.validator.format(s.replace(n, "{$1}"), i.parameters)), this.errorList.push({
                                message: s,
                                element: e,
                                method: i.method
                            }), this.errorMap[e.name] = s, this.submitted[e.name] = s
                        },
                        addWrapper: function(t) {
                            return this.settings.wrapper && (t = t.add(t.parent(this.settings.wrapper))), t
                        },
                        defaultShowErrors: function() {
                            var t, e, i;
                            for (t = 0; this.errorList[t]; t++) i = this.errorList[t], this.settings.highlight && this.settings.highlight.call(this, i.element, this.settings.errorClass, this.settings.validClass), this.showLabel(i.element, i.message);
                            if (this.errorList.length && (this.toShow = this.toShow.add(this.containers)), this.settings.success)
                                for (t = 0; this.successList[t]; t++) this.showLabel(this.successList[t]);
                            if (this.settings.unhighlight)
                                for (t = 0, e = this.validElements(); e[t]; t++) this.settings.unhighlight.call(this, e[t], this.settings.errorClass, this.settings.validClass);
                            this.toHide = this.toHide.not(this.toShow), this.hideErrors(), this.addWrapper(this.toShow).show()
                        },
                        validElements: function() {
                            return this.currentElements.not(this.invalidElements())
                        },
                        invalidElements: function() {
                            return t(this.errorList).map((function() {
                                return this.element
                            }))
                        },
                        showLabel: function(e, i) {
                            var s, n, o, a = this.errorsFor(e),
                                r = this.idOrName(e),
                                l = t(e).attr("aria-describedby");
                            a.length ? (a.removeClass(this.settings.validClass).addClass(this.settings.errorClass), a.html(i)) : (s = a = t("<" + this.settings.errorElement + ">").attr("id", r + "-error").addClass(this.settings.errorClass).html(i || ""), this.settings.wrapper && (s = a.hide().show().wrap("<" + this.settings.wrapper + "/>").parent()), this.labelContainer.length ? this.labelContainer.append(s) : this.settings.errorPlacement ? this.settings.errorPlacement(s, t(e)) : s.insertAfter(e), a.is("label") ? a.attr("for", r) : 0 === a.parents("label[for='" + r + "']").length && (o = a.attr("id").replace(/(:|\.|\[|\])/g, "\\$1"), l ? l.match(new RegExp("\\b" + o + "\\b")) || (l += " " + o) : l = o, t(e).attr("aria-describedby", l), (n = this.groups[e.name]) && t.each(this.groups, (function(e, i) {
                                i === n && t("[name='" + e + "']", this.currentForm).attr("aria-describedby", a.attr("id"))
                            })))), !i && this.settings.success && (a.text(""), "string" == typeof this.settings.success ? a.addClass(this.settings.success) : this.settings.success(a, e)), this.toShow = this.toShow.add(a)
                        },
                        errorsFor: function(e) {
                            var i = this.idOrName(e),
                                s = t(e).attr("aria-describedby"),
                                n = "label[for='" + i + "'], label[for='" + i + "'] *";
                            return s && (n = n + ", #" + s.replace(/\s+/g, ", #")), this.errors().filter(n)
                        },
                        idOrName: function(t) {
                            return this.groups[t.name] || (this.checkable(t) ? t.name : t.id || t.name)
                        },
                        validationTargetFor: function(e) {
                            return this.checkable(e) && (e = this.findByName(e.name)), t(e).not(this.settings.ignore)[0]
                        },
                        checkable: function(t) {
                            return /radio|checkbox/i.test(t.type)
                        },
                        findByName: function(e) {
                            return t(this.currentForm).find("[name='" + e + "']")
                        },
                        getLength: function(e, i) {
                            switch (i.nodeName.toLowerCase()) {
                                case "select":
                                    return t("option:selected", i).length;
                                case "input":
                                    if (this.checkable(i)) return this.findByName(i.name).filter(":checked").length
                            }
                            return e.length
                        },
                        depend: function(t, e) {
                            return !this.dependTypes[a(t)] || this.dependTypes[a(t)](t, e)
                        },
                        dependTypes: {
                            boolean: function(t) {
                                return t
                            },
                            string: function(e, i) {
                                return !!t(e, i.form).length
                            },
                            function: function(t, e) {
                                return t(e)
                            }
                        },
                        optional: function(e) {
                            var i = this.elementValue(e);
                            return !t.validator.methods.required.call(this, i, e) && "dependency-mismatch"
                        },
                        startRequest: function(t) {
                            this.pending[t.name] || (this.pendingRequest++, this.pending[t.name] = !0)
                        },
                        stopRequest: function(e, i) {
                            this.pendingRequest--, this.pendingRequest < 0 && (this.pendingRequest = 0), delete this.pending[e.name], i && 0 === this.pendingRequest && this.formSubmitted && this.form() ? (t(this.currentForm).submit(), this.formSubmitted = !1) : !i && 0 === this.pendingRequest && this.formSubmitted && (t(this.currentForm).triggerHandler("invalid-form", [this]), this.formSubmitted = !1)
                        },
                        previousValue: function(e) {
                            return t.data(e, "previousValue") || t.data(e, "previousValue", {
                                old: null,
                                valid: !0,
                                message: this.defaultMessage(e, "remote")
                            })
                        }
                    },
                    classRuleSettings: {
                        required: {
                            required: !0
                        },
                        email: {
                            email: !0
                        },
                        url: {
                            url: !0
                        },
                        date: {
                            date: !0
                        },
                        dateISO: {
                            dateISO: !0
                        },
                        number: {
                            number: !0
                        },
                        digits: {
                            digits: !0
                        },
                        creditcard: {
                            creditcard: !0
                        }
                    },
                    addClassRules: function(e, i) {
                        e.constructor === String ? this.classRuleSettings[e] = i : t.extend(this.classRuleSettings, e)
                    },
                    classRules: function(e) {
                        var i = {},
                            s = t(e).attr("class");
                        return s && t.each(s.split(" "), (function() {
                            this in t.validator.classRuleSettings && t.extend(i, t.validator.classRuleSettings[this])
                        })), i
                    },
                    attributeRules: function(e) {
                        var i, s, n = {},
                            o = t(e),
                            a = e.getAttribute("type");
                        for (i in t.validator.methods) "required" === i ? ("" === (s = e.getAttribute(i)) && (s = !0), s = !!s) : s = o.attr(i), /min|max/.test(i) && (null === a || /number|range|text/.test(a)) && (s = Number(s)), s || 0 === s ? n[i] = s : a === i && "range" !== a && (n[i] = !0);
                        return n.maxlength && /-1|2147483647|524288/.test(n.maxlength) && delete n.maxlength, n
                    },
                    dataRules: function(e) {
                        var i, s, n = {},
                            o = t(e);
                        for (i in t.validator.methods) void 0 !== (s = o.data("rule" + i.charAt(0).toUpperCase() + i.substring(1).toLowerCase())) && (n[i] = s);
                        return n
                    },
                    staticRules: function(e) {
                        var i = {},
                            s = t.data(e.form, "validator");
                        return s.settings.rules && (i = t.validator.normalizeRule(s.settings.rules[e.name]) || {}), i
                    },
                    normalizeRules: function(e, i) {
                        return t.each(e, (function(s, n) {
                            if (!1 !== n) {
                                if (n.param || n.depends) {
                                    var o = !0;
                                    switch (a(n.depends)) {
                                        case "string":
                                            o = !!t(n.depends, i.form).length;
                                            break;
                                        case "function":
                                            o = n.depends.call(i, i)
                                    }
                                    o ? e[s] = void 0 === n.param || n.param : delete e[s]
                                }
                            } else delete e[s]
                        })), t.each(e, (function(s, n) {
                            e[s] = t.isFunction(n) ? n(i) : n
                        })), t.each(["minlength", "maxlength"], (function() {
                            e[this] && (e[this] = Number(e[this]))
                        })), t.each(["rangelength", "range"], (function() {
                            var i;
                            e[this] && (t.isArray(e[this]) ? e[this] = [Number(e[this][0]), Number(e[this][1])] : "string" == typeof e[this] && (i = e[this].replace(/[\[\]]/g, "").split(/[\s,]+/), e[this] = [Number(i[0]), Number(i[1])]))
                        })), t.validator.autoCreateRanges && (null != e.min && null != e.max && (e.range = [e.min, e.max], delete e.min, delete e.max), null != e.minlength && null != e.maxlength && (e.rangelength = [e.minlength, e.maxlength], delete e.minlength, delete e.maxlength)), e
                    },
                    normalizeRule: function(e) {
                        if ("string" == typeof e) {
                            var i = {};
                            t.each(e.split(/\s/), (function() {
                                i[this] = !0
                            })), e = i
                        }
                        return e
                    },
                    addMethod: function(e, i, s) {
                        t.validator.methods[e] = i, t.validator.messages[e] = void 0 !== s ? s : t.validator.messages[e], i.length < 3 && t.validator.addClassRules(e, t.validator.normalizeRule(e))
                    },
                    methods: {
                        required: function(e, i, s) {
                            if (!this.depend(s, i)) return "dependency-mismatch";
                            if ("select" === i.nodeName.toLowerCase()) {
                                var n = t(i).val();
                                return n && n.length > 0
                            }
                            return this.checkable(i) ? this.getLength(e, i) > 0 : t.trim(e).length > 0
                        },
                        email: function(t, e) {
                            return this.optional(e) || /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/.test(t)
                        },
                        url: function(t, e) {
                            return this.optional(e) || /^(https?|s?ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i.test(t)
                        },
                        date: function(t, e) {
                            return this.optional(e) || !/Invalid|NaN/.test(new Date(t).toString())
                        },
                        dateISO: function(t, e) {
                            return this.optional(e) || /^\d{4}[\/\-](0?[1-9]|1[012])[\/\-](0?[1-9]|[12][0-9]|3[01])$/.test(t)
                        },
                        number: function(t, e) {
                            return this.optional(e) || /^-?(?:\d+|\d{1,3}(?:,\d{3})+)?(?:\.\d+)?$/.test(t)
                        },
                        digits: function(t, e) {
                            return this.optional(e) || /^\d+$/.test(t)
                        },
                        creditcard: function(t, e) {
                            if (this.optional(e)) return "dependency-mismatch";
                            if (/[^0-9 \-]+/.test(t)) return !1;
                            var i, s, n = 0,
                                o = 0,
                                a = !1;
                            if ((t = t.replace(/\D/g, "")).length < 13 || t.length > 19) return !1;
                            for (i = t.length - 1; i >= 0; i--) s = t.charAt(i), o = parseInt(s, 10), a && (o *= 2) > 9 && (o -= 9), n += o, a = !a;
                            return n % 10 == 0
                        },
                        minlength: function(e, i, s) {
                            var n = t.isArray(e) ? e.length : this.getLength(e, i);
                            return this.optional(i) || n >= s
                        },
                        maxlength: function(e, i, s) {
                            var n = t.isArray(e) ? e.length : this.getLength(e, i);
                            return this.optional(i) || s >= n
                        },
                        rangelength: function(e, i, s) {
                            var n = t.isArray(e) ? e.length : this.getLength(e, i);
                            return this.optional(i) || n >= s[0] && n <= s[1]
                        },
                        min: function(t, e, i) {
                            return this.optional(e) || t >= i
                        },
                        max: function(t, e, i) {
                            return this.optional(e) || i >= t
                        },
                        range: function(t, e, i) {
                            return this.optional(e) || t >= i[0] && t <= i[1]
                        },
                        equalTo: function(e, i, s) {
                            var n = t(s);
                            return this.settings.onfocusout && n.unbind(".validate-equalTo").bind("blur.validate-equalTo", (function() {
                                t(i).valid()
                            })), e === n.val()
                        },
                        remote: function(e, i, s) {
                            if (this.optional(i)) return "dependency-mismatch";
                            var n, o, a = this.previousValue(i);
                            return this.settings.messages[i.name] || (this.settings.messages[i.name] = {}), a.originalMessage = this.settings.messages[i.name].remote, this.settings.messages[i.name].remote = a.message, s = "string" == typeof s && {
                                url: s
                            } || s, a.old === e ? a.valid : (a.old = e, n = this, this.startRequest(i), (o = {})[i.name] = e, t.ajax(t.extend(!0, {
                                url: s,
                                mode: "abort",
                                port: "validate" + i.name,
                                dataType: "json",
                                data: o,
                                context: n.currentForm,
                                success: function(s) {
                                    var o, r, l, h = !0 === s || "true" === s;
                                    n.settings.messages[i.name].remote = a.originalMessage, h ? (l = n.formSubmitted, n.prepareElement(i), n.formSubmitted = l, n.successList.push(i), delete n.invalid[i.name], n.showErrors()) : (o = {}, r = s || n.defaultMessage(i, "remote"), o[i.name] = a.message = t.isFunction(r) ? r(e) : r, n.invalid[i.name] = !0, n.showErrors(o)), a.valid = h, n.stopRequest(i, h)
                                }
                            }, s)), "pending")
                        }
                    }
                }), t.format = function() {
                    throw "$.format has been deprecated. Please use $.validator.format instead."
                };
                var e, i = {};
                t.ajaxPrefilter ? t.ajaxPrefilter((function(t, e, s) {
                    var n = t.port;
                    "abort" === t.mode && (i[n] && i[n].abort(), i[n] = s)
                })) : (e = t.ajax, t.ajax = function(s) {
                    var n = ("mode" in s ? s : t.ajaxSettings).mode,
                        o = ("port" in s ? s : t.ajaxSettings).port;
                    return "abort" === n ? (i[o] && i[o].abort(), i[o] = e.apply(this, arguments), i[o]) : e.apply(this, arguments)
                }), t.extend(t.fn, {
                    validateDelegate: function(e, i, s) {
                        return this.bind(i, (function(i) {
                            var n = t(i.target);
                            return n.is(e) ? s.apply(n, arguments) : void 0
                        }))
                    }
                })
            }) ? s.apply(e, n) : s) || (t.exports = o)
        },
        fa2f24c5d355c24bad79: function(t, e) {
            function i(t, e, i) {
                return e in t ? Object.defineProperty(t, e, {
                    value: i,
                    enumerable: !0,
                    configurable: !0,
                    writable: !0
                }) : t[e] = i, t
            }
            $(document).ready((function() {
                var t;
                $.validator.addMethod("valueNotEquals", (function(t, e, i) {
                    return i != t
                }), "Time Must Not Be 00:00"), $.validator.addMethod("valueNotEquals_airport", (function(t, e, i) {
                    return i != t
                }), "Please Select Airport");
                $("#QuoteForm").validate({
                    errorPlacement: function(t, e) {
                        $(e).closest("form").find("spans[for='" + e.attr("id") + "']").append(t)
                    },
                    errorClass: "errorbooking",
                    errorElement: "spans",
                    ignore: ":hidden",
                    rules: {
                        airportId: {
                            valueNotEquals_airport: "0"
                        },
                        DepTime: {
                            valueNotEquals: "00:00"
                        },
                        ReturnTime: {
                            valueNotEquals: "00:00"
                        },
                        DepTime2: {
                            valueNotEquals: "00:00"
                        },
                        ReturnTime2: {
                            valueNotEquals: "00:00"
                        }
                    },
                    messages: {
                        DepTime: {
                            required: "Please Select Departure Time"
                        },
                        ReturnTime: {
                            required: "Please Select Arrival Time"
                        }
                    }
                }), $("#updateQuoteForm").validate({
                    errorPlacement: function(t, e) {
                        $(e).closest("form").find("spans[for='" + e.attr("id") + "']").append(t)
                    },
                    errorElement: "spans",
                    ignore: ":hidden",
                    rules: {
                        DepTime: {
                            valueNotEquals: "00:00"
                        },
                        ReturnTime: {
                            valueNotEquals: "00:00"
                        }
                    },
                    messages: {
                        DepTime: {
                            required: "Please Select Departure Time"
                        },
                        ReturnTime: {
                            required: "Please Select Arrival Time"
                        }
                    }
                });
                $("#myModal").on("show.bs.modal", (function(t) {
                    console.log("testing modal");
                    var e = $(t.relatedTarget).data("book-value"),
                        i = $('.Price-Form[data-value="' + e + '"]').html();
                    $("#NewForm").html(i);
                    var s = $('.quotecharges[data-price="' + e + '"]').html();
                    $(".modal-qprice").html(s);
                    var n = $('.discountcharges[data-discount="' + e + '"]').html();
                    $(".modal-dicountprice").html(n);
                    var o = $('.comptitle[data-title="' + e + '"]').html();
                    $(".modal-comptitle").html(o);
                    var a = $('.comp-logo[data-cimage="' + e + '"]').attr("src");
                    $(".modal-complogo").attr("src", a);
                    var r = $('.comptype[data-comptype="' + e + '"]').html();
                    $(".modal-comptype").html(r);
                    var l = "compid=" + $(t.relatedTarget).data("comp");
                    $.ajax({
                        type: "POST",
                        url: "moreinfo.php",
                        data: l,
                        cache: !1,
                        success: function(t) {
                            $(".modalloader").hide(), $(".modal-header").find(".Price-Form").hide(), $("#companycontent").html(t)
                        }
                    }), $(".modal-header").find(".btn").removeClass("btn-booking"), $(".modal-header").find(".btn").removeClass("btn-no-booking")
                })), $("#myModal").on("hidden.bs.modal", (function() {
                    $(this).removeData("bs.modal")
                })), $("#TermsModal").on("show.bs.modal", (function() {
                    $("#mcontent").css("height", .7 * $(window).height()), $("#mcontent").css({
                        "overflow-y": "scroll"
                    })
                })), $("#myModal, #TermsModal").on("show.bs.modal", (function() {
                    $(".modal").css({
                        overflow: "hidden"
                    })
                })), $("#myModal, #TermsModal").on("hide.bs.modal", (function() {
                    $(".modal").css({
                        "overflow-y": "scroll"
                    })
                })), $("#Email").keyup((function() {
                    this.value = this.value.toLowerCase()
                })), $("#BookingForm").validate({
                    errorPlacement: function(t, e) {
                        $(e).closest("form").find("spans[for='" + e.attr("id") + "']").append(t)
                    },
                    errorElement: "spans",
                    ignore: ":hidden",
                    rules: {
                        ConfirmEmail: {
                            equalTo: "#Email"
                        },
                        Password: {
                            minlength: 6
                        },
                        ConfirmPass: {
                            equalTo: "#Password",
                            minlength: 6
                        },
                        Mobile: {
                            number: !0
                        },
                        Agree: {
                            required: !0
                        },
                        FirstName: {
                            required: !0
                        },
                        LastName: {
                            required: !0
                        }
                    },
                    messages: (t = {
                        Title: {
                            required: "Please select Title"
                        },
                        FullName: {
                            required: "Please enter your Full Name"
                        },
                        FirstName: {
                            required: "Please enter your First Name"
                        },
                        LastName: {
                            required: "Please enter your Last Name"
                        },
                        Email: {
                            required: "Please enter your Email Address"
                        },
                        ConfirmEmail: {
                            required: "Please Confirm Email Address",
                            equalTo: "Email Address Doesnot Match"
                        },
                        Password: {
                            required: "Please enter Password",
                            minlength: "Your password must be at least 6 characters long"
                        },
                        ConfirmPass: {
                            required: "Please Confirm Password",
                            minlength: "Your password must be at least 6 characters long",
                            equalTo: "Password Doesnot Match"
                        },
                        Mobile: {
                            required: "Please enter your Mobile Number"
                        },
                        Address: {
                            required: "Please enter Address"
                        },
                        City: {
                            required: "Please enter City"
                        },
                        Town: {
                            required: "Please enter Town / County"
                        },
                        PostCode: {
                            required: "Please enter Postcode"
                        },
                        DepartFlight: {
                            required: "Please enter Outbound Flight"
                        },
                        ReturnFlight: {
                            required: "Please enter Return Flight"
                        },
                        Make: {
                            required: "Please enter Vehicle Make"
                        },
                        Model: {
                            required: "Please enter Vehicle Model"
                        },
                        Color: {
                            required: "Please enter Vehicle color"
                        },
                        RegNo: {
                            required: "Please enter Vehicle Reg. No."
                        },
                        Make2: {
                            required: "Please enter Additional Vehicle Make"
                        },
                        Model2: {
                            required: "Please enter Addtional Vehicle Model"
                        },
                        Color2: {
                            required: "Please enter Addtional Vehicle Color"
                        },
                        RegNo2: {
                            required: "Please enter Addtional Vehicle Reg Number"
                        }
                    }, i(t, "Email", "Please enter a valid email address"), i(t, "Agree", "Please Accept Terms and Conditions"), t)
                }), $("#ForgetPass").validate({
                    rules: {
                        email: {
                            required: !0,
                            email: !0,
                            remote: {
                                url: "../../system/CheckEmail.php",
                                type: "post"
                            }
                        }
                    },
                    messages: {
                        email: {
                            required: "Please enter your email address.",
                            email: "Please enter a valid email address.",
                            remote: "Entered Email Not Registered!"
                        }
                    },
                    submitHandler: function(t) {
                        t.submit()
                    }
                }), $("#Guest").validate({
                    rules: {
                        email_guest: {
                            required: !0
                        },
                        confirmemail: {
                            equalTo: "#email_guest"
                        }
                    },
                    messages: {
                        email_guest: {
                            required: "Please enter your email address.",
                            email_guest: "Please enter a valid email address."
                        },
                        confirmemail: {
                            required: "Please Confirm Email",
                            equalTo: "Email Doesnot Match"
                        }
                    }
                }), $("#CustomerLogin").validate({
                    rules: {
                        email: {
                            required: !0,
                            email: !0,
                            remote: {
                                url: "../compare/system/CheckEmail.php",
                                type: "post"
                            }
                        },
                        password: {
                            minlength: 6
                        }
                    },
                    messages: {
                        email: {
                            required: "Please enter your email address.",
                            email: "Please enter a valid email address.",
                            remote: "Entered Email Not Registered!"
                        },
                        password: {
                            required: "Please enter Password",
                            minlength: "Your password must be at least 6 characters long"
                        }
                    }
                }), $("#ChangePassword").validate({
                    rules: {
                        OldPassword: {
                            required: !0,
                            remote: {
                                url: "../../system/CheckPassword.php",
                                type: "post"
                            }
                        },
                        NewPassword: {
                            minlength: 6
                        },
                        ConfPassword: {
                            equalTo: "#NewPassword",
                            minlength: 6
                        }
                    },
                    messages: {
                        OldPassword: {
                            required: "Please enter your Old Password.",
                            remote: "Entered Old Password is Wrong!"
                        },
                        NewPassword: {
                            required: "Please enter New Password",
                            minlength: "Your password must be at least 6 characters long"
                        },
                        ConfPassword: {
                            required: "Please Re-enter New Password",
                            minlength: "Your password must be at least 6 characters long",
                            equalTo: "Password Doesnot Match"
                        }
                    }
                }), $("#NewRegisteration").validate({
                    rules: {
                        email: {
                            required: !0,
                            remote: {
                                url: "../../system/CheckNewUser.php",
                                type: "post"
                            }
                        },
                        password: {
                            minlength: 6
                        },
                        confpass: {
                            equalTo: "#password",
                            minlength: 6
                        },
                        mobile: {
                            number: !0
                        }
                    },
                    messages: {
                        email: {
                            required: "Please enter your email address.",
                            email: "Please enter a valid email address.",
                            remote: "Entered Email Already Registered!"
                        },
                        firstname: {
                            required: "Please enter your First Name"
                        },
                        lastname: {
                            required: "Please enter your Last Name"
                        },
                        password: {
                            required: "Please enter Password",
                            minlength: "Your password must be at least 6 characters long"
                        },
                        confpass: {
                            required: "Please Confirm Password",
                            minlength: "Your password must be at least 6 characters long",
                            equalTo: "Password Doesnot Match"
                        },
                        mobile: {
                            required: "Please enter your Mobile Number"
                        },
                        phone: {
                            required: "Please enter your Phone Number"
                        },
                        address: {
                            required: "Please enter Address"
                        },
                        city: {
                            required: "Please enter City"
                        },
                        town: {
                            required: "Please enter Town / County"
                        },
                        postcode: {
                            required: "Please enter Postcode"
                        }
                    }
                }), $("#ContactusForm").validate({
                    rules: {
                        mobile: {
                            number: !0
                        }
                    },
                    messages: {
                        email: {
                            required: "Please enter your Email Address.",
                            email: "Please enter a valid Email Address."
                        },
                        firstname: {
                            required: "Please enter your First Name"
                        },
                        lastname: {
                            required: "Please enter your Last Name"
                        },
                        mobile: {
                            required: "Please enter your Mobile Number"
                        },
                        contactmessage: {
                            required: "Please enter your Message"
                        }
                    }
                }), $(".open-datetimepicker").click((function(t) {
                    t.preventDefault(), $("#datetimepicker").click()
                })), $("#log_ref").validate({
                    rules: {
                        ref_no: {
                            valueNotEquals: "00:00"
                        },
                        email_address: {
                            valueNotEquals: "00:00"
                        }
                    },
                    messages: {
                        ref_no: "Please Enter Booking Ref",
                        email_address: "Please Enter Email Address"
                    },
                    submitHandler: function() {
                        var t = $("#log_ref").serialize();
                        return $.ajax({
                            type: "POST",
                            url: "model/user-login.php",
                            data: t,
                            beforeSend: function() {},
                            success: function(t) {
                                "ok" == t ? setTimeout((function() {
                                    window.location.replace("dashboard.php")
                                }), 1e3) : $("#error_user").show()
                            }
                        }), !1
                    }
                }), $("#log_email").validate({
                    rules: {
                        email: {
                            valueNotEquals: "00:00"
                        },
                        password: {
                            valueNotEquals: "00:00"
                        }
                    },
                    messages: {
                        password: "Please Enter your password",
                        email: "Please Enter Email Address"
                    },
                    submitHandler: function() {
                        var t = $("#log_email").serialize();
                        return $.ajax({
                            type: "POST",
                            url: "model/user-login.php",
                            data: t,
                            beforeSend: function() {},
                            success: function(t) {
                                "ok" == t ? setTimeout((function() {
                                    window.location.replace("dashboard.php")
                                }), 1e3) : $("#error_log").show()
                            }
                        }), !1
                    }
                }), $("#Booking-Login").validate({
                    rules: {
                        email: {
                            valueNotEquals: "00:00"
                        },
                        password: {
                            valueNotEquals: "00:00"
                        }
                    },
                    messages: {
                        password: "Please Enter your password",
                        email: "Please Enter Email Address"
                    },
                    submitHandler: function() {
                        var t = $("#Booking-Login").serialize();
                        return $.ajax({
                            type: "POST",
                            url: "model/CustomerLogin_booking.php",
                            data: t,
                            beforeSend: function() {},
                            success: function(t) {
                                "ok" == t ? setTimeout((function() {
                                    window.location.replace("booking-details.php")
                                }), 1e3) : $("#error_log").show()
                            }
                        }), !1
                    }
                }), $("#detail_booking").on("show.bs.modal", (function(t) {
                    var e = $(t.relatedTarget).data("book-value"),
                        i = $(t.relatedTarget).data("booking-id"),
                        s = $('#companytitle[data-company="' + e + '"]').html();
                    $(".modal-comptitle").html(s);
                    var n = $('#reference[data-ref="' + e + '"]').html();
                    $("#modal-ref").html(n);
                    var o = $('#dropoff[data-dropoff="' + e + '"]').html();
                    $("#modal-dropoff").html(o);
                    var a = $('#dropofftime[data-dropofftime="' + e + '"]').html();
                    $("#modal-dropofftime").html(a);
                    var r = $('#returndate[data-returndate="' + e + '"]').html();
                    $("#modal-returndate").html(r);
                    var l = $('#returntime[data-returntime="' + e + '"]').html();
                    $("#modal-returntime").html(l);
                    var h = $('#price[data-price="' + e + '"]').html();
                    $("#modal-price").html(h), $("#bookid").val(i);
                    var c = "bookingid=" + i;
                    $.ajax({
                        type: "POST",
                        url: "booking-detail.php",
                        data: c,
                        cache: !1,
                        success: function(t) {
                            $(".modalloader").hide(), $(".modal-header").find(".Price-Form").hide(), $("#companycontent").html(t)
                        }
                    }), $(".modal-header").find(".btn").removeClass("btn-booking"), $(".modal-header").find(".btn").removeClass("btn-no-booking")
                })), $((function() {
                    $(".item-home").matchHeight({
                        property: "min-height"
                    })
                }))
            }))
        },
        fafda60c78eec37aa915: function(t, e) {
            function i(t) {
                return (i = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function(t) {
                    return typeof t
                } : function(t) {
                    return t && "function" == typeof Symbol && t.constructor === Symbol && t !== Symbol.prototype ? "symbol" : typeof t
                })(t)
            }! function(t) {
                "use strict";
                var e = '[data-dismiss="alert"]',
                    i = function(i) {
                        t(i).on("click", e, this.close)
                    };
                i.prototype.close = function(e) {
                    var i = t(this),
                        s = i.attr("data-target");
                    s || (s = (s = i.attr("href")) && s.replace(/.*(?=#[^\s]*$)/, ""));
                    var n = t(s);

                    function o() {
                        n.trigger("closed.bs.alert").remove()
                    }
                    e && e.preventDefault(), n.length || (n = i.hasClass("alert") ? i : i.parent()), n.trigger(e = t.Event("close.bs.alert")), e.isDefaultPrevented() || (n.removeClass("in"), t.support.transition && n.hasClass("fade") ? n.one(t.support.transition.end, o).emulateTransitionEnd(150) : o())
                };
                var s = t.fn.alert;
                t.fn.alert = function(e) {
                    return this.each((function() {
                        var s = t(this),
                            n = s.data("bs.alert");
                        n || s.data("bs.alert", n = new i(this)), "string" == typeof e && n[e].call(s)
                    }))
                }, t.fn.alert.Constructor = i, t.fn.alert.noConflict = function() {
                    return t.fn.alert = s, this
                }, t(document).on("click.bs.alert.data-api", e, i.prototype.close)
            }(jQuery),
            function(t) {
                "use strict";
                var e = function e(i, s) {
                    this.$element = t(i), this.options = t.extend({}, e.DEFAULTS, s), this.isLoading = !1
                };
                e.DEFAULTS = {
                    loadingText: "loading..."
                }, e.prototype.setState = function(e) {
                    var i = "disabled",
                        s = this.$element,
                        n = s.is("input") ? "val" : "html",
                        o = s.data();
                    e += "Text", o.resetText || s.data("resetText", s[n]()), s[n](o[e] || this.options[e]), setTimeout(t.proxy((function() {
                        "loadingText" == e ? (this.isLoading = !0, s.addClass(i).attr(i, i)) : this.isLoading && (this.isLoading = !1, s.removeClass(i).removeAttr(i))
                    }), this), 0)
                }, e.prototype.toggle = function() {
                    var t = !0,
                        e = this.$element.closest('[data-toggle="buttons"]');
                    if (e.length) {
                        var i = this.$element.find("input");
                        "radio" == i.prop("type") && (i.prop("checked") && this.$element.hasClass("active") ? t = !1 : e.find(".active").removeClass("active")), t && i.prop("checked", !this.$element.hasClass("active")).trigger("change")
                    }
                    t && this.$element.toggleClass("active")
                };
                var s = t.fn.button;
                t.fn.button = function(s) {
                    return this.each((function() {
                        var n = t(this),
                            o = n.data("bs.button"),
                            a = "object" == i(s) && s;
                        o || n.data("bs.button", o = new e(this, a)), "toggle" == s ? o.toggle() : s && o.setState(s)
                    }))
                }, t.fn.button.Constructor = e, t.fn.button.noConflict = function() {
                    return t.fn.button = s, this
                }, t(document).on("click.bs.button.data-api", "[data-toggle^=button]", (function(e) {
                    var i = t(e.target);
                    i.hasClass("btn") || (i = i.closest(".btn")), i.button("toggle"), e.preventDefault()
                }))
            }(jQuery),
            function(t) {
                "use strict";
                var e = function(e, i) {
                    this.$element = t(e), this.$indicators = this.$element.find(".carousel-indicators"), this.options = i, this.paused = this.sliding = this.interval = this.$active = this.$items = null, "hover" == this.options.pause && this.$element.on("mouseenter", t.proxy(this.pause, this)).on("mouseleave", t.proxy(this.cycle, this))
                };
                e.DEFAULTS = {
                    interval: 5e3,
                    pause: "hover",
                    wrap: !0
                }, e.prototype.cycle = function(e) {
                    return e || (this.paused = !1), this.interval && clearInterval(this.interval), this.options.interval && !this.paused && (this.interval = setInterval(t.proxy(this.next, this), this.options.interval)), this
                }, e.prototype.getActiveIndex = function() {
                    return this.$active = this.$element.find(".item.active"), this.$items = this.$active.parent().children(), this.$items.index(this.$active)
                }, e.prototype.to = function(e) {
                    var i = this,
                        s = this.getActiveIndex();
                    if (!(e > this.$items.length - 1 || e < 0)) return this.sliding ? this.$element.one("slid.bs.carousel", (function() {
                        i.to(e)
                    })) : s == e ? this.pause().cycle() : this.slide(e > s ? "next" : "prev", t(this.$items[e]))
                }, e.prototype.pause = function(e) {
                    return e || (this.paused = !0), this.$element.find(".next, .prev").length && t.support.transition && (this.$element.trigger(t.support.transition.end), this.cycle(!0)), this.interval = clearInterval(this.interval), this
                }, e.prototype.next = function() {
                    if (!this.sliding) return this.slide("next")
                }, e.prototype.prev = function() {
                    if (!this.sliding) return this.slide("prev")
                }, e.prototype.slide = function(e, i) {
                    var s = this.$element.find(".item.active"),
                        n = i || s[e](),
                        o = this.interval,
                        a = "next" == e ? "left" : "right",
                        r = "next" == e ? "first" : "last",
                        l = this;
                    if (!n.length) {
                        if (!this.options.wrap) return;
                        n = this.$element.find(".item")[r]()
                    }
                    if (n.hasClass("active")) return this.sliding = !1;
                    var h = t.Event("slide.bs.carousel", {
                        relatedTarget: n[0],
                        direction: a
                    });
                    return this.$element.trigger(h), h.isDefaultPrevented() ? void 0 : (this.sliding = !0, o && this.pause(), this.$indicators.length && (this.$indicators.find(".active").removeClass("active"), this.$element.one("slid.bs.carousel", (function() {
                        var e = t(l.$indicators.children()[l.getActiveIndex()]);
                        e && e.addClass("active")
                    }))), t.support.transition && this.$element.hasClass("slide") ? (n.addClass(e), n[0].offsetWidth, s.addClass(a), n.addClass(a), s.one(t.support.transition.end, (function() {
                        n.removeClass([e, a].join(" ")).addClass("active"), s.removeClass(["active", a].join(" ")), l.sliding = !1, setTimeout((function() {
                            l.$element.trigger("slid.bs.carousel")
                        }), 0)
                    })).emulateTransitionEnd(1e3 * s.css("transition-duration").slice(0, -1))) : (s.removeClass("active"), n.addClass("active"), this.sliding = !1, this.$element.trigger("slid.bs.carousel")), o && this.cycle(), this)
                };
                var s = t.fn.carousel;
                t.fn.carousel = function(s) {
                    return this.each((function() {
                        var n = t(this),
                            o = n.data("bs.carousel"),
                            a = t.extend({}, e.DEFAULTS, n.data(), "object" == i(s) && s),
                            r = "string" == typeof s ? s : a.slide;
                        o || n.data("bs.carousel", o = new e(this, a)), "number" == typeof s ? o.to(s) : r ? o[r]() : a.interval && o.pause().cycle()
                    }))
                }, t.fn.carousel.Constructor = e, t.fn.carousel.noConflict = function() {
                    return t.fn.carousel = s, this
                }, t(document).on("click.bs.carousel.data-api", "[data-slide], [data-slide-to]", (function(e) {
                    var i, s = t(this),
                        n = t(s.attr("data-target") || (i = s.attr("href")) && i.replace(/.*(?=#[^\s]+$)/, "")),
                        o = t.extend({}, n.data(), s.data()),
                        a = s.attr("data-slide-to");
                    a && (o.interval = !1), n.carousel(o), (a = s.attr("data-slide-to")) && n.data("bs.carousel").to(a), e.preventDefault()
                })), t(window).on("load", (function() {
                    t('[data-ride="carousel"]').each((function() {
                        var e = t(this);
                        e.carousel(e.data())
                    }))
                }))
            }(jQuery),
            function(t) {
                "use strict";
                var e = "[data-toggle=dropdown]",
                    i = function(e) {
                        t(e).on("click.bs.dropdown", this.toggle)
                    };

                function s(i) {
                    t(".dropdown-backdrop").remove(), t(e).each((function() {
                        var e = n(t(this)),
                            s = {
                                relatedTarget: this
                            };
                        e.hasClass("open") && (e.trigger(i = t.Event("hide.bs.dropdown", s)), i.isDefaultPrevented() || e.removeClass("open").trigger("hidden.bs.dropdown", s))
                    }))
                }

                function n(e) {
                    var i = e.attr("data-target");
                    i || (i = (i = e.attr("href")) && /#[A-Za-z]/.test(i) && i.replace(/.*(?=#[^\s]*$)/, ""));
                    var s = i && t(i);
                    return s && s.length ? s : e.parent()
                }
                i.prototype.toggle = function(e) {
                    var i = t(this);
                    if (!i.is(".disabled, :disabled")) {
                        var o = n(i),
                            a = o.hasClass("open");
                        if (s(), !a) {
                            "ontouchstart" in document.documentElement && !o.closest(".navbar-nav").length && t('<div class="dropdown-backdrop"/>').insertAfter(t(this)).on("click", s);
                            var r = {
                                relatedTarget: this
                            };
                            if (o.trigger(e = t.Event("show.bs.dropdown", r)), e.isDefaultPrevented()) return;
                            o.toggleClass("open").trigger("shown.bs.dropdown", r), i.focus()
                        }
                        return !1
                    }
                }, i.prototype.keydown = function(i) {
                    if (/(38|40|27)/.test(i.keyCode)) {
                        var s = t(this);
                        if (i.preventDefault(), i.stopPropagation(), !s.is(".disabled, :disabled")) {
                            var o = n(s),
                                a = o.hasClass("open");
                            if (!a || a && 27 == i.keyCode) return 27 == i.which && o.find(e).focus(), s.click();
                            var r = " li:not(.divider):visible a",
                                l = o.find("[role=menu]" + r + ", [role=listbox]" + r);
                            if (l.length) {
                                var h = l.index(l.filter(":focus"));
                                38 == i.keyCode && h > 0 && h--, 40 == i.keyCode && h < l.length - 1 && h++, ~h || (h = 0), l.eq(h).focus()
                            }
                        }
                    }
                };
                var o = t.fn.dropdown;
                t.fn.dropdown = function(e) {
                    return this.each((function() {
                        var s = t(this),
                            n = s.data("bs.dropdown");
                        n || s.data("bs.dropdown", n = new i(this)), "string" == typeof e && n[e].call(s)
                    }))
                }, t.fn.dropdown.Constructor = i, t.fn.dropdown.noConflict = function() {
                    return t.fn.dropdown = o, this
                }, t(document).on("click.bs.dropdown.data-api", s).on("click.bs.dropdown.data-api", ".dropdown form", (function(t) {
                    t.stopPropagation()
                })).on("click.bs.dropdown.data-api", e, i.prototype.toggle).on("keydown.bs.dropdown.data-api", e + ", [role=menu], [role=listbox]", i.prototype.keydown)
            }(jQuery),
            function(t) {
                "use strict";
                var e = function(e, i) {
                    this.options = i, this.$element = t(e), this.$backdrop = this.isShown = null, this.options.remote && this.$element.find(".modal-content").load(this.options.remote, t.proxy((function() {
                        this.$element.trigger("loaded.bs.modal")
                    }), this))
                };
                e.DEFAULTS = {
                    backdrop: !0,
                    keyboard: !0,
                    show: !0
                }, e.prototype.toggle = function(t) {
                    return this[this.isShown ? "hide" : "show"](t)
                }, e.prototype.show = function(e) {
                    var i = this,
                        s = t.Event("show.bs.modal", {
                            relatedTarget: e
                        });
                    this.$element.trigger(s), this.isShown || s.isDefaultPrevented() || (this.isShown = !0, this.escape(), this.$element.on("click.dismiss.bs.modal", '[data-dismiss="modal"]', t.proxy(this.hide, this)), this.backdrop((function() {
                        var s = t.support.transition && i.$element.hasClass("fade");
                        i.$element.parent().length || i.$element.appendTo(document.body), i.$element.show().scrollTop(0), s && i.$element[0].offsetWidth, i.$element.addClass("in").attr("aria-hidden", !1), i.enforceFocus();
                        var n = t.Event("shown.bs.modal", {
                            relatedTarget: e
                        });
                        s ? i.$element.find(".modal-dialog").one(t.support.transition.end, (function() {
                            i.$element.focus().trigger(n)
                        })).emulateTransitionEnd(300) : i.$element.focus().trigger(n)
                    })))
                }, e.prototype.hide = function(e) {
                    e && e.preventDefault(), e = t.Event("hide.bs.modal"), this.$element.trigger(e), this.isShown && !e.isDefaultPrevented() && (this.isShown = !1, this.escape(), t(document).off("focusin.bs.modal"), this.$element.removeClass("in").attr("aria-hidden", !0).off("click.dismiss.bs.modal"), t.support.transition && this.$element.hasClass("fade") ? this.$element.one(t.support.transition.end, t.proxy(this.hideModal, this)).emulateTransitionEnd(300) : this.hideModal())
                }, e.prototype.enforceFocus = function() {
                    t(document).off("focusin.bs.modal").on("focusin.bs.modal", t.proxy((function(t) {
                        this.$element[0] === t.target || this.$element.has(t.target).length || this.$element.focus()
                    }), this))
                }, e.prototype.escape = function() {
                    this.isShown && this.options.keyboard ? this.$element.on("keyup.dismiss.bs.modal", t.proxy((function(t) {
                        27 == t.which && this.hide()
                    }), this)) : this.isShown || this.$element.off("keyup.dismiss.bs.modal")
                }, e.prototype.hideModal = function() {
                    var t = this;
                    this.$element.hide(), this.backdrop((function() {
                        t.removeBackdrop(), t.$element.trigger("hidden.bs.modal")
                    }))
                }, e.prototype.removeBackdrop = function() {
                    this.$backdrop && this.$backdrop.remove(), this.$backdrop = null
                }, e.prototype.backdrop = function(e) {
                    var i = this.$element.hasClass("fade") ? "fade" : "";
                    if (this.isShown && this.options.backdrop) {
                        var s = t.support.transition && i;
                        if (this.$backdrop = t('<div class="modal-backdrop ' + i + '" />').appendTo(document.body), this.$element.on("click.dismiss.bs.modal", t.proxy((function(t) {
                                t.target === t.currentTarget && ("static" == this.options.backdrop ? this.$element[0].focus.call(this.$element[0]) : this.hide.call(this))
                            }), this)), s && this.$backdrop[0].offsetWidth, this.$backdrop.addClass("in"), !e) return;
                        s ? this.$backdrop.one(t.support.transition.end, e).emulateTransitionEnd(150) : e()
                    } else !this.isShown && this.$backdrop ? (this.$backdrop.removeClass("in"), t.support.transition && this.$element.hasClass("fade") ? this.$backdrop.one(t.support.transition.end, e).emulateTransitionEnd(150) : e()) : e && e()
                };
                var s = t.fn.modal;
                t.fn.modal = function(s, n) {
                    return this.each((function() {
                        var o = t(this),
                            a = o.data("bs.modal"),
                            r = t.extend({}, e.DEFAULTS, o.data(), "object" == i(s) && s);
                        a || o.data("bs.modal", a = new e(this, r)), "string" == typeof s ? a[s](n) : r.show && a.show(n)
                    }))
                }, t.fn.modal.Constructor = e, t.fn.modal.noConflict = function() {
                    return t.fn.modal = s, this
                }, t(document).on("click.bs.modal.data-api", '[data-toggle="modal"]', (function(e) {
                    var i = t(this),
                        s = i.attr("href"),
                        n = t(i.attr("data-target") || s && s.replace(/.*(?=#[^\s]+$)/, "")),
                        o = n.data("bs.modal") ? "toggle" : t.extend({
                            remote: !/#/.test(s) && s
                        }, n.data(), i.data());
                    i.is("a") && e.preventDefault(), n.modal(o, this).one("hide", (function() {
                        i.is(":visible") && i.focus()
                    }))
                })), t(document).on("show.bs.modal", ".modal", (function() {
                    t(document.body).addClass("modal-open")
                })).on("hidden.bs.modal", ".modal", (function() {
                    t(document.body).removeClass("modal-open")
                }))
            }(jQuery),
            function(t) {
                "use strict";
                var e = function(t, e) {
                    this.type = this.options = this.enabled = this.timeout = this.hoverState = this.$element = null, this.init("tooltip", t, e)
                };
                e.DEFAULTS = {
                    animation: !0,
                    placement: "top",
                    selector: !1,
                    template: '<div class="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>',
                    trigger: "hover focus",
                    title: "",
                    delay: 0,
                    html: !1,
                    container: !1
                }, e.prototype.init = function(e, i, s) {
                    this.enabled = !0, this.type = e, this.$element = t(i), this.options = this.getOptions(s);
                    for (var n = this.options.trigger.split(" "), o = n.length; o--;) {
                        var a = n[o];
                        if ("click" == a) this.$element.on("click." + this.type, this.options.selector, t.proxy(this.toggle, this));
                        else if ("manual" != a) {
                            var r = "hover" == a ? "mouseenter" : "focusin",
                                l = "hover" == a ? "mouseleave" : "focusout";
                            this.$element.on(r + "." + this.type, this.options.selector, t.proxy(this.enter, this)), this.$element.on(l + "." + this.type, this.options.selector, t.proxy(this.leave, this))
                        }
                    }
                    this.options.selector ? this._options = t.extend({}, this.options, {
                        trigger: "manual",
                        selector: ""
                    }) : this.fixTitle()
                }, e.prototype.getDefaults = function() {
                    return e.DEFAULTS
                }, e.prototype.getOptions = function(e) {
                    return (e = t.extend({}, this.getDefaults(), this.$element.data(), e)).delay && "number" == typeof e.delay && (e.delay = {
                        show: e.delay,
                        hide: e.delay
                    }), e
                }, e.prototype.getDelegateOptions = function() {
                    var e = {},
                        i = this.getDefaults();
                    return this._options && t.each(this._options, (function(t, s) {
                        i[t] != s && (e[t] = s)
                    })), e
                }, e.prototype.enter = function(e) {
                    var i = e instanceof this.constructor ? e : t(e.currentTarget)[this.type](this.getDelegateOptions()).data("bs." + this.type);
                    if (clearTimeout(i.timeout), i.hoverState = "in", !i.options.delay || !i.options.delay.show) return i.show();
                    i.timeout = setTimeout((function() {
                        "in" == i.hoverState && i.show()
                    }), i.options.delay.show)
                }, e.prototype.leave = function(e) {
                    var i = e instanceof this.constructor ? e : t(e.currentTarget)[this.type](this.getDelegateOptions()).data("bs." + this.type);
                    if (clearTimeout(i.timeout), i.hoverState = "out", !i.options.delay || !i.options.delay.hide) return i.hide();
                    i.timeout = setTimeout((function() {
                        "out" == i.hoverState && i.hide()
                    }), i.options.delay.hide)
                }, e.prototype.show = function() {
                    var e = t.Event("show.bs." + this.type);
                    if (this.hasContent() && this.enabled) {
                        if (this.$element.trigger(e), e.isDefaultPrevented()) return;
                        var i = this,
                            s = this.tip();
                        this.setContent(), this.options.animation && s.addClass("fade");
                        var n = "function" == typeof this.options.placement ? this.options.placement.call(this, s[0], this.$element[0]) : this.options.placement,
                            o = /\s?auto?\s?/i,
                            a = o.test(n);
                        a && (n = n.replace(o, "") || "top"), s.detach().css({
                            top: 0,
                            left: 0,
                            display: "block"
                        }).addClass(n), this.options.container ? s.appendTo(this.options.container) : s.insertAfter(this.$element);
                        var r = this.getPosition(),
                            l = s[0].offsetWidth,
                            h = s[0].offsetHeight;
                        if (a) {
                            var c = this.$element.parent(),
                                u = n,
                                d = document.documentElement.scrollTop || document.body.scrollTop,
                                p = "body" == this.options.container ? window.innerWidth : c.outerWidth(),
                                f = "body" == this.options.container ? window.innerHeight : c.outerHeight(),
                                m = "body" == this.options.container ? 0 : c.offset().left;
                            n = "bottom" == n && r.top + r.height + h - d > f ? "top" : "top" == n && r.top - d - h < 0 ? "bottom" : "right" == n && r.right + l > p ? "left" : "left" == n && r.left - l < m ? "right" : n, s.removeClass(u).addClass(n)
                        }
                        var g = this.getCalculatedOffset(n, r, l, h);
                        this.applyPlacement(g, n), this.hoverState = null;
                        var v = function() {
                            i.$element.trigger("shown.bs." + i.type)
                        };
                        t.support.transition && this.$tip.hasClass("fade") ? s.one(t.support.transition.end, v).emulateTransitionEnd(150) : v()
                    }
                }, e.prototype.applyPlacement = function(e, i) {
                    var s, n = this.tip(),
                        o = n[0].offsetWidth,
                        a = n[0].offsetHeight,
                        r = parseInt(n.css("margin-top"), 10),
                        l = parseInt(n.css("margin-left"), 10);
                    isNaN(r) && (r = 0), isNaN(l) && (l = 0), e.top = e.top + r, e.left = e.left + l, t.offset.setOffset(n[0], t.extend({
                        using: function(t) {
                            n.css({
                                top: Math.round(t.top),
                                left: Math.round(t.left)
                            })
                        }
                    }, e), 0), n.addClass("in");
                    var h = n[0].offsetWidth,
                        c = n[0].offsetHeight;
                    if ("top" == i && c != a && (s = !0, e.top = e.top + a - c), /bottom|top/.test(i)) {
                        var u = 0;
                        e.left < 0 && (u = -2 * e.left, e.left = 0, n.offset(e), h = n[0].offsetWidth, c = n[0].offsetHeight), this.replaceArrow(u - o + h, h, "left")
                    } else this.replaceArrow(c - a, c, "top");
                    s && n.offset(e)
                }, e.prototype.replaceArrow = function(t, e, i) {
                    this.arrow().css(i, t ? 50 * (1 - t / e) + "%" : "")
                }, e.prototype.setContent = function() {
                    var t = this.tip(),
                        e = this.getTitle();
                    t.find(".tooltip-inner")[this.options.html ? "html" : "text"](e), t.removeClass("fade in top bottom left right")
                }, e.prototype.hide = function() {
                    var e = this,
                        i = this.tip(),
                        s = t.Event("hide.bs." + this.type);

                    function n() {
                        "in" != e.hoverState && i.detach(), e.$element.trigger("hidden.bs." + e.type)
                    }
                    if (this.$element.trigger(s), !s.isDefaultPrevented()) return i.removeClass("in"), t.support.transition && this.$tip.hasClass("fade") ? i.one(t.support.transition.end, n).emulateTransitionEnd(150) : n(), this.hoverState = null, this
                }, e.prototype.fixTitle = function() {
                    var t = this.$element;
                    (t.attr("title") || "string" != typeof t.attr("data-original-title")) && t.attr("data-original-title", t.attr("title") || "").attr("title", "")
                }, e.prototype.hasContent = function() {
                    return this.getTitle()
                }, e.prototype.getPosition = function() {
                    var e = this.$element[0];
                    return t.extend({}, "function" == typeof e.getBoundingClientRect ? e.getBoundingClientRect() : {
                        width: e.offsetWidth,
                        height: e.offsetHeight
                    }, this.$element.offset())
                }, e.prototype.getCalculatedOffset = function(t, e, i, s) {
                    return "bottom" == t ? {
                        top: e.top + e.height,
                        left: e.left + e.width / 2 - i / 2
                    } : "top" == t ? {
                        top: e.top - s,
                        left: e.left + e.width / 2 - i / 2
                    } : "left" == t ? {
                        top: e.top + e.height / 2 - s / 2,
                        left: e.left - i
                    } : {
                        top: e.top + e.height / 2 - s / 2,
                        left: e.left + e.width
                    }
                }, e.prototype.getTitle = function() {
                    var t = this.$element,
                        e = this.options;
                    return t.attr("data-original-title") || ("function" == typeof e.title ? e.title.call(t[0]) : e.title)
                }, e.prototype.tip = function() {
                    return this.$tip = this.$tip || t(this.options.template)
                }, e.prototype.arrow = function() {
                    return this.$arrow = this.$arrow || this.tip().find(".tooltip-arrow")
                }, e.prototype.validate = function() {
                    this.$element[0].parentNode || (this.hide(), this.$element = null, this.options = null)
                }, e.prototype.enable = function() {
                    this.enabled = !0
                }, e.prototype.disable = function() {
                    this.enabled = !1
                }, e.prototype.toggleEnabled = function() {
                    this.enabled = !this.enabled
                }, e.prototype.toggle = function(e) {
                    var i = e ? t(e.currentTarget)[this.type](this.getDelegateOptions()).data("bs." + this.type) : this;
                    i.tip().hasClass("in") ? i.leave(i) : i.enter(i)
                }, e.prototype.destroy = function() {
                    clearTimeout(this.timeout), this.hide().$element.off("." + this.type).removeData("bs." + this.type)
                };
                var s = t.fn.tooltip;
                t.fn.tooltip = function(s) {
                    return this.each((function() {
                        var n = t(this),
                            o = n.data("bs.tooltip"),
                            a = "object" == i(s) && s;
                        (o || "destroy" != s) && (o || n.data("bs.tooltip", o = new e(this, a)), "string" == typeof s && o[s]())
                    }))
                }, t.fn.tooltip.Constructor = e, t.fn.tooltip.noConflict = function() {
                    return t.fn.tooltip = s, this
                }
            }(jQuery),
            function(t) {
                "use strict";
                var e = function(t, e) {
                    this.init("popover", t, e)
                };
                if (!t.fn.tooltip) throw new Error("Popover requires tooltip.js");
                e.DEFAULTS = t.extend({}, t.fn.tooltip.Constructor.DEFAULTS, {
                    placement: "right",
                    trigger: "click",
                    content: "",
                    template: '<div class="popover"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>'
                }), (e.prototype = t.extend({}, t.fn.tooltip.Constructor.prototype)).constructor = e, e.prototype.getDefaults = function() {
                    return e.DEFAULTS
                }, e.prototype.setContent = function() {
                    var t = this.tip(),
                        e = this.getTitle(),
                        i = this.getContent();
                    t.find(".popover-title")[this.options.html ? "html" : "text"](e), t.find(".popover-content")[this.options.html ? "string" == typeof i ? "html" : "append" : "text"](i), t.removeClass("fade top bottom left right in"), t.find(".popover-title").html() || t.find(".popover-title").hide()
                }, e.prototype.hasContent = function() {
                    return this.getTitle() || this.getContent()
                }, e.prototype.getContent = function() {
                    var t = this.$element,
                        e = this.options;
                    return t.attr("data-content") || ("function" == typeof e.content ? e.content.call(t[0]) : e.content)
                }, e.prototype.arrow = function() {
                    return this.$arrow = this.$arrow || this.tip().find(".arrow")
                }, e.prototype.tip = function() {
                    return this.$tip || (this.$tip = t(this.options.template)), this.$tip
                };
                var s = t.fn.popover;
                t.fn.popover = function(s) {
                    return this.each((function() {
                        var n = t(this),
                            o = n.data("bs.popover"),
                            a = "object" == i(s) && s;
                        (o || "destroy" != s) && (o || n.data("bs.popover", o = new e(this, a)), "string" == typeof s && o[s]())
                    }))
                }, t.fn.popover.Constructor = e, t.fn.popover.noConflict = function() {
                    return t.fn.popover = s, this
                }
            }(jQuery),
            function(t) {
                "use strict";
                var e = function(e) {
                    this.element = t(e)
                };
                e.prototype.show = function() {
                    var e = this.element,
                        i = e.closest("ul:not(.dropdown-menu)"),
                        s = e.data("target");
                    if (s || (s = (s = e.attr("href")) && s.replace(/.*(?=#[^\s]*$)/, "")), !e.parent("li").hasClass("active")) {
                        var n = i.find(".active:last a")[0],
                            o = t.Event("show.bs.tab", {
                                relatedTarget: n
                            });
                        if (e.trigger(o), !o.isDefaultPrevented()) {
                            var a = t(s);
                            this.activate(e.parent("li"), i), this.activate(a, a.parent(), (function() {
                                e.trigger({
                                    type: "shown.bs.tab",
                                    relatedTarget: n
                                })
                            }))
                        }
                    }
                }, e.prototype.activate = function(e, i, s) {
                    var n = i.find("> .active"),
                        o = s && t.support.transition && n.hasClass("fade");

                    function a() {
                        n.removeClass("active").find("> .dropdown-menu > .active").removeClass("active"), e.addClass("active"), o ? (e[0].offsetWidth, e.addClass("in")) : e.removeClass("fade"), e.parent(".dropdown-menu") && e.closest("li.dropdown").addClass("active"), s && s()
                    }
                    o ? n.one(t.support.transition.end, a).emulateTransitionEnd(150) : a(), n.removeClass("in")
                };
                var i = t.fn.tab;
                t.fn.tab = function(i) {
                    return this.each((function() {
                        var s = t(this),
                            n = s.data("bs.tab");
                        n || s.data("bs.tab", n = new e(this)), "string" == typeof i && n[i]()
                    }))
                }, t.fn.tab.Constructor = e, t.fn.tab.noConflict = function() {
                    return t.fn.tab = i, this
                }, t(document).on("click.bs.tab.data-api", '[data-toggle="tab"], [data-toggle="pill"]', (function(e) {
                    e.preventDefault(), t(this).tab("show")
                }))
            }(jQuery),
            function(t) {
                "use strict";
                var e = function e(i, s) {
                    this.options = t.extend({}, e.DEFAULTS, s), this.$window = t(window).on("scroll.bs.affix.data-api", t.proxy(this.checkPosition, this)).on("click.bs.affix.data-api", t.proxy(this.checkPositionWithEventLoop, this)), this.$element = t(i), this.affixed = this.unpin = this.pinnedOffset = null, this.checkPosition()
                };
                e.RESET = "affix affix-top affix-bottom", e.DEFAULTS = {
                    offset: 0
                }, e.prototype.getPinnedOffset = function() {
                    if (this.pinnedOffset) return this.pinnedOffset;
                    this.$element.removeClass(e.RESET).addClass("affix");
                    var t = this.$window.scrollTop(),
                        i = this.$element.offset();
                    return this.pinnedOffset = i.top - t
                }, e.prototype.checkPositionWithEventLoop = function() {
                    setTimeout(t.proxy(this.checkPosition, this), 1)
                }, e.prototype.checkPosition = function() {
                    if (this.$element.is(":visible")) {
                        var s = t(document).height(),
                            n = this.$window.scrollTop(),
                            o = this.$element.offset(),
                            a = this.options.offset,
                            r = a.top,
                            l = a.bottom;
                        "top" == this.affixed && (o.top += n), "object" != i(a) && (l = r = a), "function" == typeof r && (r = a.top(this.$element)), "function" == typeof l && (l = a.bottom(this.$element));
                        var h = !(null != this.unpin && n + this.unpin <= o.top) && (null != l && o.top + this.$element.height() >= s - l ? "bottom" : null != r && n <= r && "top");
                        if (this.affixed !== h) {
                            this.unpin && this.$element.css("top", "");
                            var c = "affix" + (h ? "-" + h : ""),
                                u = t.Event(c + ".bs.affix");
                            this.$element.trigger(u), u.isDefaultPrevented() || (this.affixed = h, this.unpin = "bottom" == h ? this.getPinnedOffset() : null, this.$element.removeClass(e.RESET).addClass(c).trigger(t.Event(c.replace("affix", "affixed"))), "bottom" == h && this.$element.offset({
                                top: s - l - this.$element.height()
                            }))
                        }
                    }
                };
                var s = t.fn.affix;
                t.fn.affix = function(s) {
                    return this.each((function() {
                        var n = t(this),
                            o = n.data("bs.affix"),
                            a = "object" == i(s) && s;
                        o || n.data("bs.affix", o = new e(this, a)), "string" == typeof s && o[s]()
                    }))
                }, t.fn.affix.Constructor = e, t.fn.affix.noConflict = function() {
                    return t.fn.affix = s, this
                }, t(window).on("load", (function() {
                    t('[data-spy="affix"]').each((function() {
                        var e = t(this),
                            i = e.data();
                        i.offset = i.offset || {}, i.offsetBottom && (i.offset.bottom = i.offsetBottom), i.offsetTop && (i.offset.top = i.offsetTop), e.affix(i)
                    }))
                }))
            }(jQuery),
            function(t) {
                "use strict";
                var e = function e(i, s) {
                    this.$element = t(i), this.options = t.extend({}, e.DEFAULTS, s), this.transitioning = null, this.options.parent && (this.$parent = t(this.options.parent)), this.options.toggle && this.toggle()
                };
                e.DEFAULTS = {
                    toggle: !0
                }, e.prototype.dimension = function() {
                    return this.$element.hasClass("width") ? "width" : "height"
                }, e.prototype.show = function() {
                    if (!this.transitioning && !this.$element.hasClass("in")) {
                        var e = t.Event("show.bs.collapse");
                        if (this.$element.trigger(e), !e.isDefaultPrevented()) {
                            var i = this.$parent && this.$parent.find("> .panel > .in");
                            if (i && i.length) {
                                var s = i.data("bs.collapse");
                                if (s && s.transitioning) return;
                                i.collapse("hide"), s || i.data("bs.collapse", null)
                            }
                            var n = this.dimension();
                            this.$element.removeClass("collapse").addClass("collapsing")[n](0), this.transitioning = 1;
                            var o = function() {
                                this.$element.removeClass("collapsing").addClass("collapse in")[n]("auto"), this.transitioning = 0, this.$element.trigger("shown.bs.collapse")
                            };
                            if (!t.support.transition) return o.call(this);
                            var a = t.camelCase(["scroll", n].join("-"));
                            this.$element.one(t.support.transition.end, t.proxy(o, this)).emulateTransitionEnd(350)[n](this.$element[0][a])
                        }
                    }
                }, e.prototype.hide = function() {
                    if (!this.transitioning && this.$element.hasClass("in")) {
                        var e = t.Event("hide.bs.collapse");
                        if (this.$element.trigger(e), !e.isDefaultPrevented()) {
                            var i = this.dimension();
                            this.$element[i](this.$element[i]())[0].offsetHeight, this.$element.addClass("collapsing").removeClass("collapse").removeClass("in"), this.transitioning = 1;
                            var s = function() {
                                this.transitioning = 0, this.$element.trigger("hidden.bs.collapse").removeClass("collapsing").addClass("collapse")
                            };
                            if (!t.support.transition) return s.call(this);
                            this.$element[i](0).one(t.support.transition.end, t.proxy(s, this)).emulateTransitionEnd(350)
                        }
                    }
                }, e.prototype.toggle = function() {
                    this[this.$element.hasClass("in") ? "hide" : "show"]()
                };
                var s = t.fn.collapse;
                t.fn.collapse = function(s) {
                    return this.each((function() {
                        var n = t(this),
                            o = n.data("bs.collapse"),
                            a = t.extend({}, e.DEFAULTS, n.data(), "object" == i(s) && s);
                        !o && a.toggle && "show" == s && (s = !s), o || n.data("bs.collapse", o = new e(this, a)), "string" == typeof s && o[s]()
                    }))
                }, t.fn.collapse.Constructor = e, t.fn.collapse.noConflict = function() {
                    return t.fn.collapse = s, this
                }, t(document).on("click.bs.collapse.data-api", "[data-toggle=collapse]", (function(e) {
                    var i, s = t(this),
                        n = s.attr("data-target") || e.preventDefault() || (i = s.attr("href")) && i.replace(/.*(?=#[^\s]+$)/, ""),
                        o = t(n),
                        a = o.data("bs.collapse"),
                        r = a ? "toggle" : s.data(),
                        l = s.attr("data-parent"),
                        h = l && t(l);
                    a && a.transitioning || (h && h.find('[data-toggle=collapse][data-parent="' + l + '"]').not(s).addClass("collapsed"), s[o.hasClass("in") ? "addClass" : "removeClass"]("collapsed")), o.collapse(r)
                }))
            }(jQuery),
            function(t) {
                "use strict";

                function e(i, s) {
                    var n, o = t.proxy(this.process, this);
                    this.$element = t(i).is("body") ? t(window) : t(i), this.$body = t("body"), this.$scrollElement = this.$element.on("scroll.bs.scroll-spy.data-api", o), this.options = t.extend({}, e.DEFAULTS, s), this.selector = (this.options.target || (n = t(i).attr("href")) && n.replace(/.*(?=#[^\s]+$)/, "") || "") + " .nav li > a", this.offsets = t([]), this.targets = t([]), this.activeTarget = null, this.refresh(), this.process()
                }
                e.DEFAULTS = {
                    offset: 10
                }, e.prototype.refresh = function() {
                    var e = this.$element[0] == window ? "offset" : "position";
                    this.offsets = t([]), this.targets = t([]);
                    var i = this;
                    this.$body.find(this.selector).map((function() {
                        var s = t(this),
                            n = s.data("target") || s.attr("href"),
                            o = /^#./.test(n) && t(n);
                        return o && o.length && o.is(":visible") && [
                            [o[e]().top + (!t.isWindow(i.$scrollElement.get(0)) && i.$scrollElement.scrollTop()), n]
                        ] || null
                    })).sort((function(t, e) {
                        return t[0] - e[0]
                    })).each((function() {
                        i.offsets.push(this[0]), i.targets.push(this[1])
                    }))
                }, e.prototype.process = function() {
                    var t, e = this.$scrollElement.scrollTop() + this.options.offset,
                        i = (this.$scrollElement[0].scrollHeight || this.$body[0].scrollHeight) - this.$scrollElement.height(),
                        s = this.offsets,
                        n = this.targets,
                        o = this.activeTarget;
                    if (e >= i) return o != (t = n.last()[0]) && this.activate(t);
                    if (o && e <= s[0]) return o != (t = n[0]) && this.activate(t);
                    for (t = s.length; t--;) o != n[t] && e >= s[t] && (!s[t + 1] || e <= s[t + 1]) && this.activate(n[t])
                }, e.prototype.activate = function(e) {
                    this.activeTarget = e, t(this.selector).parentsUntil(this.options.target, ".active").removeClass("active");
                    var i = this.selector + '[data-target="' + e + '"],' + this.selector + '[href="' + e + '"]',
                        s = t(i).parents("li").addClass("active");
                    s.parent(".dropdown-menu").length && (s = s.closest("li.dropdown").addClass("active")), s.trigger("activate.bs.scrollspy")
                };
                var s = t.fn.scrollspy;
                t.fn.scrollspy = function(s) {
                    return this.each((function() {
                        var n = t(this),
                            o = n.data("bs.scrollspy"),
                            a = "object" == i(s) && s;
                        o || n.data("bs.scrollspy", o = new e(this, a)), "string" == typeof s && o[s]()
                    }))
                }, t.fn.scrollspy.Constructor = e, t.fn.scrollspy.noConflict = function() {
                    return t.fn.scrollspy = s, this
                }, t(window).on("load", (function() {
                    t('[data-spy="scroll"]').each((function() {
                        var e = t(this);
                        e.scrollspy(e.data())
                    }))
                }))
            }(jQuery),
            function(t) {
                "use strict";
                t.fn.emulateTransitionEnd = function(e) {
                    var i = !1,
                        s = this;
                    t(this).one(t.support.transition.end, (function() {
                        i = !0
                    }));
                    return setTimeout((function() {
                        i || t(s).trigger(t.support.transition.end)
                    }), e), this
                }, t((function() {
                    t.support.transition = function() {
                        var t = document.createElement("bootstrap"),
                            e = {
                                WebkitTransition: "webkitTransitionEnd",
                                MozTransition: "transitionend",
                                OTransition: "oTransitionEnd otransitionend",
                                transition: "transitionend"
                            };
                        for (var i in e)
                            if (void 0 !== t.style[i]) return {
                                end: e[i]
                            };
                        return !1
                    }()
                }))
            }(jQuery)
        }
    },
    [
        ["491d6a5c397556712989", 1, 2]
    ]
]);