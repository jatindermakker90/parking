 ! function(t) {
                "use strict";
                t.fn.validateOnBlur = function(e, i) {
                    return this.find("input[data-validation], textarea[data-validation]").unbind("blur.validation").bind("blur.validation", (function() {
                        t(this).validateInputOnBlur(e, i)
                    })), this
                }, t.fn.showHelpOnFocus = function(e) {
                    return e || (e = "data-validation-help"), this.find(".has-help-txt").valAttr("has-keyup-event", !1).valAttr("backend-valid", !1).valAttr("backend-invalid", !1).unbind("focus.validation").unbind("blur.validation").removeClass("has-help-txt"), this.find("textarea,input").each((function() {
                        var i = t(this),
                            s = "jquery_form_help_" + (i.attr("name") || "").replace(/(:|\.|\[|\])/g, ""),
                            n = i.attr(e);
                        n && i.addClass("has-help-txt").bind("focus.validation", (function() {
                            var e = i.parent().find("." + s);
                            0 == e.length && (e = t("<span />").addClass(s).addClass("help-block").text(n).hide(), i.after(e)), e.fadeIn()
                        })).bind("blur.validation", (function() {
                            t(this).parent().find("." + s).fadeOut("slow")
                        }))
                    })), this
                }, t.fn.validateInputOnBlur = function(e, i, s, n) {
                    void 0 === s && (s = !0), n || (n = "blur"), e = t.extend(t.formUtils.LANG, e || {}), (i = t.extend(t.formUtils.defaultConfig(), i || {})).errorMessagePosition = "element";
                    var o = document.getElementById(this.attr("name") + "_err_msg"),
                        a = this.closest("form");
                    this.attr(i.validationRuleAttribute);
                    this.removeClass(i.errorElementClass).css("border-color", "").parent().find("." + i.errorMessageClass).remove(), a.find(".has-error").removeClass("has-error"), this.removeClass("valid").parent().removeClass("has-success"), null != o && (o.innerHTML = "");
                    var r = t.formUtils.validateInput(this, e, i, a, n);
                    if (this.trigger("validation", [!0 === r]), !0 === r) this.addClass("valid").parent().addClass("has-success");
                    else if (null === r) this.removeClass("valid").parent().removeClass("has-error").removeClass("has-success");
                    else {
                        if (this.addClass(i.errorElementClass).removeClass("valid").parent().addClass("has-error").removeClass("has-success"), null != o) o.innerHTML = r;
                        else {
                            var l = this.parent();
                            l.append('<span class="' + i.errorMessageClass + ' help-block">' + r + "</span>"), l.addClass("has-error")
                        }
                        "" !== i.borderColorOnError && this.css("border-color", i.borderColorOnError), s && this.bind("keyup", (function() {
                            t(this).validateInputOnBlur(e, i, !1, "keyup")
                        }))
                    }
                    return this
                }, t.fn.valAttr = function(t, e) {
                    return void 0 === e ? this.attr("data-validation-" + t) : !1 === e || null === e ? this.removeAttr("data-validation-" + t) : (t.length > 0 && (t = "-" + t), this.attr("data-validation" + t, e))
                }, t.fn.validateForm = function(e, i) {
                    e = t.extend(t.formUtils.LANG, e || {}), i = t.extend(t.formUtils.defaultConfig(), i || {}), t.formUtils.isValidatingEntireForm = !0, t.formUtils.haltValidation = !1;
                    var s = function(e, i) {
                            null !== e && (t.inArray(e, n) < 0 && n.push(e), o.push(i), i.valAttr("current-error", e).removeClass("valid").parent().removeClass("has-success"))
                        },
                        n = [],
                        o = [],
                        a = this;
                    if (a.find("input,textarea,select").filter(':not([type="submit"],[type="button"])').each((function() {
                            var n, o, r = t(this),
                                l = r.attr("type");
                            if (n = r.attr("name"), !("submit" === (o = l) || "button" === o || t.inArray(n, i.ignore || []) > -1)) {
                                var h = t.formUtils.validateInput(r, e, i, a, "submit");
                                r.trigger("validation", [!0 === h]), !0 !== h ? s(h, r) : r.valAttr("current-error", !1).addClass("valid").parent().addClass("has-success")
                            }
                        })), a.find(".has-error").removeClass("has-error"), a.find("input,textarea,select").css("border-color", "").removeClass(i.errorElementClass), t("." + t.split(i.errorMessageClass, " ").join(".")).remove(), t("." + i.errorMessageClass).remove(), "function" == typeof i.onValidate) {
                        var r = i.onValidate(a);
                        r && r.element && r.message && s(r.message, r.element)
                    }
                    if (!t.formUtils.haltValidation && o.length > 0) {
                        if (t.formUtils.isValidatingEntireForm = !1, t.each(o, (function(t, e) {
                                "" !== i.borderColorOnError && e.css("border-color", i.borderColorOnError), e.addClass(i.errorElementClass).parent().addClass("has-error")
                            })), "top" === i.errorMessagePosition) {
                            var l = "<strong>" + e.errorTitle + "</strong>";
                            t.each(n, (function(t, e) {
                                l += "<br />* " + e
                            })), a.children().eq(0).before('<div class="' + i.errorMessageClass + ' alert alert-danger">' + l + "</div>"), i.scrollToTopOnError && t(window).scrollTop(a.offset().top - 20)
                        } else t.each(o, (function(t, e) {
                            var s = e.parent(),
                                n = s.find("span[class=" + i.errorMessageClass + "]");
                            n.length > 0 ? n.text(", " + e.valAttr("current-error")) : s.append('<span class="' + i.errorMessageClass + ' help-block">' + e.valAttr("current-error") + "</span>")
                        }));
                        return !1
                    }
                    return t.formUtils.isValidatingEntireForm = !1, !t.formUtils.haltValidation
                }, t.fn.restrictLength = function(e) {
                    return new t.formUtils.lengthRestriction(this, e), this
                }, t.fn.addSuggestions = function(e) {
                    var i = !1;
                    return this.find("input").each((function() {
                        var s = t(this);
                        (i = t.split(s.attr("data-suggestions"))).length > 0 && !s.hasClass("has-suggestions") && (t.formUtils.suggest(s, i, e), s.addClass("has-suggestions"))
                    })), this
                }, t.split = function(e, i, s) {
                    if ("function" != typeof i) {
                        if (!e) return [];
                        var n = [];
                        return t.each(e.split(i || ","), (function(e, i) {
                            (i = t.trim(i)).length && n.push(i)
                        })), n
                    }
                    e && (s || (s = ","), t.each(e.split(s), (function(e, s) {
                        if ((s = t.trim(s)).length) return i(s, e)
                    })))
                }, t.validate = function(e) {
                    e = t.extend({
                        form: "form",
                        validateOnBlur: !0,
                        showHelpOnFocus: !0,
                        addSuggestions: !0,
                        modules: "",
                        onModulesLoaded: null,
                        language: !1,
                        onSuccess: !1,
                        onError: !1
                    }, e || {}), t("form.has-validation-callback").removeClass("has-validation-callback").unbind("submit.validation"), t.split(e.form, (function(i) {
                        var s = t(i);
                        s.bind("submit.validation", (function() {
                            var i = t(this);
                            if (t.formUtils.isLoadingModules) return setTimeout((function() {
                                i.trigger("submit.validation")
                            }), 200), !1;
                            var s = t(this).validateForm(e.language, e);
                            return s && "function" == typeof e.onSuccess ? !1 !== e.onSuccess(i) && void 0 : s || "function" != typeof e.onError ? s : (e.onError(i), !1)
                        })).addClass("has-validation-callback"), e.showHelpOnFocus && s.showHelpOnFocus(), e.addSuggestions && s.addSuggestions(), e.validateOnBlur && s.validateOnBlur(e.language, e)
                    })), "" != e.modules && ("function" == typeof e.onModulesLoaded && t.formUtils.on("load", (function() {
                        e.onModulesLoaded()
                    })), t.formUtils.loadModules(e.modules))
                }, t.validationSetup = function(e) {
                    "undefined" != typeof console && console.warn && window.console.warn("Using deprecated function $.validationSetup, pls use $.validate instead"), t.validate(e)
                }, t.formUtils = {
                    defaultConfig: function() {
                        return {
                            ignore: [],
                            errorElementClass: "error",
                            borderColorOnError: "red",
                            errorMessageClass: "form-error",
                            validationRuleAttribute: "data-validation",
                            validationErrorMsgAttribute: "data-validation-error-msg",
                            errorMessagePosition: "element",
                            scrollToTopOnError: !0,
                            dateFormat: "yyyy-mm-dd",
                            addValidClassOnAll: !1,
                            decimalSeparator: "."
                        }
                    },
                    validators: {},
                    _events: {
                        load: [],
                        valid: [],
                        invalid: []
                    },
                    haltValidation: !1,
                    isValidatingEntireForm: !1,
                    addValidator: function(t) {
                        var e = 0 === t.name.indexOf("validate_") ? t.name : "validate_" + t.name;
                        void 0 === t.validateOnKeyUp && (t.validateOnKeyUp = !0), this.validators[e] = t
                    },
                    on: function(t, e) {
                        void 0 === this._events[t] && (this._events[t] = []), this._events[t].push(e)
                    },
                    trigger: function(e, i, s) {
                        t.each(this._events[e] || [], (function(t, e) {
                            e(i, s)
                        }))
                    },
                    isLoadingModules: !1,
                    loadedModules: {},
                    loadModules: function(e, i, s) {
                        if (void 0 === s && (s = !0), t.formUtils.isLoadingModules) setTimeout((function() {
                            t.formUtils.loadModules(e, i, s)
                        }));
                        else {
                            var n = !1,
                                o = function(e, i) {
                                    var o = t.split(e),
                                        a = o.length,
                                        r = function() {
                                            0 == --a && (t.formUtils.isLoadingModules = !1, s && n && t.formUtils.trigger("load", i))
                                        };
                                    a > 0 && (t.formUtils.isLoadingModules = !0);
                                    var l = "?__=" + (new Date).getTime(),
                                        h = document.getElementsByTagName("head")[0] || document.getElementsByTagName("body")[0];
                                    t.each(o, (function(e, s) {
                                        if (0 == (s = t.trim(s)).length) r();
                                        else {
                                            var o = i + s + (".js" == s.substr(-3) ? "" : ".js"),
                                                a = document.createElement("SCRIPT");
                                            o in t.formUtils.loadedModules ? r() : (t.formUtils.loadedModules[o] = 1, n = !0, a.type = "text/javascript", a.onload = r, a.src = o + (".dev.js" == o.substr(-7) ? l : ""), a.onreadystatechange = function() {
                                                "complete" == this.readyState && r()
                                            }, h.appendChild(a))
                                        }
                                    }))
                                };
                            if (i) o(e, i);
                            else {
                                var a = function() {
                                    var i = !1;
                                    return t("script").each((function() {
                                        if (this.src) {
                                            var t = this.src.substr(this.src.lastIndexOf("/") + 1, this.src.length);
                                            if (t.indexOf("jquery.form-validator.js") > -1 || t.indexOf("jquery.form-validator.min.js") > -1) return "/" == (i = this.src.substr(0, this.src.lastIndexOf("/")) + "/") && (i = ""), !1
                                        }
                                    })), !1 !== i && (o(e, i), !0)
                                };
                                a() || t(a)
                            }
                        }
                    },
                    validateInput: function(e, i, s, n, o) {
                        e.trigger("beforeValidation");
                        var a = t.trim(e.val() || ""),
                            r = e.valAttr("optional"),
                            l = !1,
                            h = !1,
                            c = e.valAttr("if-checked");
                        if (null != c && (l = !0, n.find('input[name="' + c + '"]').prop("checked") && (h = !0)), !a && "true" === r || l && !h) return !!s.addValidClassOnAll || null;
                        var u = e.attr(s.validationRuleAttribute),
                            d = !0;
                        return u ? (t.split(u, (function(r) {
                            0 !== r.indexOf("validate_") && (r = "validate_" + r);
                            var l = t.formUtils.validators[r];
                            if (l && "function" == typeof l.validatorFunction) {
                                "validate_checkbox_group" == r && (e = t("[name='" + e.attr("name") + "']:eq(0)"));
                                var h = !0;
                                if (("keyup" != o || l.validateOnKeyUp) && (h = l.validatorFunction(a, e, s, i, n)), !h) return (d = e.attr(s.validationErrorMsgAttribute)) || (d = i[l.errorMessageKey]) || (d = l.errorMessage), !1
                            } else console.warn('Using undefined validator "' + r + '"')
                        }), " "), "string" != typeof d || d) : !!s.addValidClassOnAll || null
                    },
                    parseDate: function(e, i) {
                        var s, n, o, a, r = i.replace(/[a-zA-Z]/gi, "").substring(0, 1),
                            l = "^",
                            h = i.split(r);
                        if (t.each(h, (function(t, e) {
                                l += (t > 0 ? "\\" + r : "") + "(\\d{" + e.length + "})"
                            })), l += "$", null === (s = e.match(new RegExp(l)))) return !1;
                        var c = function(e, i, s) {
                            for (var n = 0; n < i.length; n++)
                                if (i[n].substring(0, 1) === e) return t.formUtils.parseDateInt(s[n + 1]);
                            return -1
                        };
                        return o = c("m", h, s), n = c("d", h, s), a = c("y", h, s), !(2 === o && n > 28 && (a % 4 != 0 || a % 100 == 0 && a % 400 != 0) || 2 === o && n > 29 && (a % 4 == 0 || a % 100 != 0 && a % 400 == 0) || o > 12 || 0 === o) && (!(this.isShortMonth(o) && n > 30 || !this.isShortMonth(o) && n > 31 || 0 === n) && [a, o, n])
                    },
                    parseDateInt: function(t) {
                        return 0 === t.indexOf("0") && (t = t.replace("0", "")), parseInt(t, 10)
                    },
                    isShortMonth: function(t) {
                        return t % 2 == 0 && t < 7 || t % 2 != 0 && t > 7
                    },
                    lengthRestriction: function(e, i) {
                        var s = parseInt(i.text(), 10),
                            n = function() {
                                var t = e.val().length;
                                if (t > s) {
                                    var n = e.scrollTop();
                                    e.val(e.val().substring(0, s)), e.scrollTop(n)
                                }
                                i.text(s - t)
                            };
                        t(e).bind("keydown keyup keypress focus blur", n).bind("cut paste", (function() {
                            setTimeout(n, 100)
                        })), t(document).bind("ready", n)
                    },
                    numericRangeCheck: function(e, i) {
                        var s = t.split(i, "-"),
                            n = parseInt(i.substr(3), 10);
                        return 2 == s.length && (e < parseInt(s[0], 10) || e > parseInt(s[1], 10)) ? ["out", s[0], s[1]] : 0 === i.indexOf("min") && e < n ? ["min", n] : 0 === i.indexOf("max") && e > n ? ["max", n] : ["ok"]
                    },
                    _numSuggestionElements: 0,
                    _selectedSuggestion: null,
                    _previousTypedVal: null,
                    suggest: function(e, i, s) {
                        var n = {
                                css: {
                                    maxHeight: "150px",
                                    background: "#FFF",
                                    lineHeight: "150%",
                                    textDecoration: "underline",
                                    overflowX: "hidden",
                                    overflowY: "auto",
                                    border: "#CCC solid 1px",
                                    borderTop: "none",
                                    cursor: "pointer"
                                },
                                activeSuggestionCSS: {
                                    background: "#E9E9E9"
                                }
                            },
                            o = function(t, e) {
                                var i = e.offset();
                                t.css({
                                    width: e.outerWidth(),
                                    left: i.left + "px",
                                    top: i.top + e.outerHeight() + "px"
                                })
                            };
                        s && t.extend(n, s), n.css.position = "absolute", n.css["z-index"] = 9999, e.attr("autocomplete", "off"), 0 === this._numSuggestionElements && t(window).bind("resize", (function() {
                            t(".jquery-form-suggestions").each((function() {
                                var e = t(this),
                                    i = e.attr("data-suggest-container");
                                o(e, t(".suggestions-" + i).eq(0))
                            }))
                        })), this._numSuggestionElements++;
                        var a = function(e) {
                            var i = e.valAttr("suggestion-nr");
                            t.formUtils._selectedSuggestion = null, t.formUtils._previousTypedVal = null, t(".jquery-form-suggestion-" + i).fadeOut("fast")
                        };
                        return e.data("suggestions", i).valAttr("suggestion-nr", this._numSuggestionElements).unbind("focus.validation").bind("focus.validation", (function() {
                            t(this).trigger("keyup"), t.formUtils._selectedSuggestion = null
                        })).unbind("keyup.validation").bind("keyup.validation", (function() {
                            var i = t(this),
                                s = [],
                                r = t.trim(i.val()).toLocaleLowerCase();
                            if (r != t.formUtils._previousTypedVal) {
                                t.formUtils._previousTypedVal = r;
                                var l = !1,
                                    h = i.valAttr("suggestion-nr"),
                                    c = t(".jquery-form-suggestion-" + h);
                                if (c.scrollTop(0), "" != r) {
                                    var u = r.length > 2;
                                    t.each(i.data("suggestions"), (function(t, e) {
                                        var i = e.toLocaleLowerCase();
                                        if (i == r) return s.push("<strong>" + e + "</strong>"), l = !0, !1;
                                        (0 === i.indexOf(r) || u && i.indexOf(r) > -1) && s.push(e.replace(new RegExp(r, "gi"), "<strong>$&</strong>"))
                                    }))
                                }
                                l || 0 == s.length && c.length > 0 ? c.hide() : s.length > 0 && 0 == c.length ? (c = t("<div></div>").css(n.css).appendTo("body"), e.addClass("suggestions-" + h), c.attr("data-suggest-container", h).addClass("jquery-form-suggestions").addClass("jquery-form-suggestion-" + h)) : s.length > 0 && !c.is(":visible") && c.show(), s.length > 0 && r.length != s[0].length && (o(c, i), c.html(""), t.each(s, (function(e, s) {
                                    t("<div></div>").append(s).css({
                                        overflow: "hidden",
                                        textOverflow: "ellipsis",
                                        whiteSpace: "nowrap",
                                        padding: "5px"
                                    }).addClass("form-suggest-element").appendTo(c).click((function() {
                                        i.focus(), i.val(t(this).text()), a(i)
                                    }))
                                })))
                            }
                        })).unbind("keydown.validation").bind("keydown.validation", (function(e) {
                            var i, s, o = e.keyCode ? e.keyCode : e.which,
                                r = t(this);
                            if (13 == o && null !== t.formUtils._selectedSuggestion) {
                                if (i = r.valAttr("suggestion-nr"), (s = t(".jquery-form-suggestion-" + i)).length > 0) {
                                    var l = s.find("div").eq(t.formUtils._selectedSuggestion).text();
                                    r.val(l), a(r), e.preventDefault()
                                }
                            } else {
                                i = r.valAttr("suggestion-nr");
                                var h = (s = t(".jquery-form-suggestion-" + i)).children();
                                if (h.length > 0 && t.inArray(o, [38, 40]) > -1) {
                                    38 == o ? (null === t.formUtils._selectedSuggestion ? t.formUtils._selectedSuggestion = h.length - 1 : t.formUtils._selectedSuggestion--, t.formUtils._selectedSuggestion < 0 && (t.formUtils._selectedSuggestion = h.length - 1)) : 40 == o && (null === t.formUtils._selectedSuggestion ? t.formUtils._selectedSuggestion = 0 : t.formUtils._selectedSuggestion++, t.formUtils._selectedSuggestion > h.length - 1 && (t.formUtils._selectedSuggestion = 0));
                                    var c = s.innerHeight(),
                                        u = s.scrollTop(),
                                        d = s.children().eq(0).outerHeight() * t.formUtils._selectedSuggestion;
                                    return (d < u || d > u + c) && s.scrollTop(d), h.removeClass("active-suggestion").css("background", "none").eq(t.formUtils._selectedSuggestion).addClass("active-suggestion").css(n.activeSuggestionCSS), e.preventDefault(), !1
                                }
                            }
                        })).unbind("blur.validation").bind("blur.validation", (function() {
                            a(t(this))
                        })), e
                    },
                    LANG: {
                        errorTitle: "Form submission failed!",
                        requiredFields: "You have not answered all required fields",
                        badTime: "You have not given a correct time",
                        badEmail: "You have not given a correct e-mail address",
                        badTelephone: "You have not given a correct phone number",
                        badSecurityAnswer: "You have not given a correct answer to the security question",
                        badDate: "You have not given a correct date",
                        lengthBadStart: "You must give an answer between ",
                        lengthBadEnd: " characters",
                        lengthTooLongStart: "You have given an answer longer than ",
                        lengthTooShortStart: "You have given an answer shorter than ",
                        notConfirmed: "Values could not be confirmed",
                        badDomain: "Incorrect domain value",
                        badUrl: "The answer you gave was not a correct URL",
                        badCustomVal: "You gave an incorrect answer",
                        badInt: "The answer you gave was not a correct number",
                        badSecurityNumber: "Your social security number was incorrect",
                        badUKVatAnswer: "Incorrect UK VAT Number",
                        badStrength: "The password isn't strong enough",
                        badNumberOfSelectedOptionsStart: "You have to choose at least ",
                        badNumberOfSelectedOptionsEnd: " answers",
                        badAlphaNumeric: "The answer you gave must contain only alphanumeric characters ",
                        badAlphaNumericExtra: " and ",
                        wrongFileSize: "The file you are trying to upload is too large",
                        wrongFileType: "The file you are trying to upload is of wrong type",
                        groupCheckedRangeStart: "Please choose between ",
                        groupCheckedTooFewStart: "Please choose at least ",
                        groupCheckedTooManyStart: "Please choose a maximum of ",
                        groupCheckedEnd: " item(s)"
                    }
                }, t.formUtils.addValidator({
                    name: "email",
                    validatorFunction: function(e) {
                        var i = e.toLowerCase().split("@");
                        return 2 == i.length && (t.formUtils.validators.validate_domain.validatorFunction(i[1]) && !/[^\w\+\.\-]/.test(i[0]))
                    },
                    errorMessage: "",
                    errorMessageKey: "badEmail"
                }), t.formUtils.addValidator({
                    name: "domain",
                    validatorFunction: function(t, e) {
                        for (var i = [".ac", ".ad", ".ae", ".aero", ".af", ".ag", ".ai", ".al", ".am", ".an", ".ao", ".aq", ".ar", ".arpa", ".as", ".asia", ".at", ".au", ".aw", ".ax", ".az", ".ba", ".bb", ".bd", ".be", ".bf", ".bg", ".bh", ".bi", ".bike", ".biz", ".bj", ".bm", ".bn", ".bo", ".br", ".bs", ".bt", ".bv", ".bw", ".by", ".bz", ".ca", ".camera", ".cat", ".cc", ".cd", ".cf", ".cg", ".ch", ".ci", ".ck", ".cl", ".clothing", ".cm", ".cn", ".co", ".com", ".construction", ".contractors", ".coop", ".cr", ".cu", ".cv", ".cw", ".cx", ".cy", ".cz", ".de", ".diamonds", ".directory", ".dj", ".dk", ".dm", ".do", ".dz", ".ec", ".edu", ".ee", ".eg", ".enterprises", ".equipment", ".er", ".es", ".estate", ".et", ".eu", ".fi", ".fj", ".fk", ".fm", ".fo", ".fr", ".ga", ".gallery", ".gb", ".gd", ".ge", ".gf", ".gg", ".gh", ".gi", ".gl", ".gm", ".gn", ".gov", ".gp", ".gq", ".gr", ".graphics", ".gs", ".gt", ".gu", ".guru", ".gw", ".gy", ".hk", ".hm", ".hn", ".holdings", ".hr", ".ht", ".hu", ".id", ".ie", ".il", ".im", ".in", ".info", ".int", ".io", ".iq", ".ir", ".is", ".it", ".je", ".jm", ".jo", ".jobs", ".jp", ".ke", ".kg", ".kh", ".ki", ".kitchen", ".km", ".kn", ".kp", ".kr", ".kw", ".ky", ".kz", ".la", ".land", ".lb", ".lc", ".li", ".lighting", ".lk", ".lr", ".ls", ".lt", ".lu", ".lv", ".ly", ".ma", ".mc", ".md", ".me", ".menu", ".mg", ".mh", ".mil", ".mk", ".ml", ".mm", ".mn", ".mo", ".mobi", ".mp", ".mq", ".mr", ".ms", ".mt", ".mu", ".museum", ".mv", ".mw", ".mx", ".my", ".mz", ".na", ".name", ".nc", ".ne", ".net", ".nf", ".ng", ".ni", ".nl", ".no", ".np", ".nr", ".nu", ".nz", ".om", ".org", ".pa", ".pe", ".pf", ".pg", ".ph", ".photography", ".pk", ".pl", ".plumbing", ".pm", ".pn", ".post", ".pr", ".pro", ".ps", ".pt", ".pw", ".py", ".qa", ".re", ".ro", ".rs", ".ru", ".rw", ".sa", ".sb", ".sc", ".sd", ".se", ".sexy", ".sg", ".sh", ".si", ".singles", ".sj", ".sk", ".sl", ".sm", ".sn", ".so", ".sr", ".st", ".su", ".sv", ".sx", ".sy", ".sz", ".tattoo", ".tc", ".td", ".technology", ".tel", ".tf", ".tg", ".th", ".tips", ".tj", ".tk", ".tl", ".tm", ".tn", ".to", ".today", ".tp", ".tr", ".travel", ".tt", ".tv", ".tw", ".tz", ".ua", ".ug", ".uk", ".uno", ".us", ".uy", ".uz", ".va", ".vc", ".ve", ".ventures", ".vg", ".vi", ".vn", ".voyage", ".vu", ".wf", ".ws", ".xn--3e0b707e", ".xn--45brj9c", ".xn--80ao21a", ".xn--80asehdb", ".xn--80aswg", ".xn--90a3ac", ".xn--clchc0ea0b2g2a9gcd", ".xn--fiqs8s", ".xn--fiqz9s", ".xn--fpcrj9c3d", ".xn--fzc2c9e2c", ".xn--gecrj9c", ".xn--h2brj9c", ".xn--j1amh", ".xn--j6w193g", ".xn--kprw13d", ".xn--kpry57d", ".xn--l1acc", ".xn--lgbbat1ad8j", ".xn--mgb9awbf", ".xn--mgba3a4f16a", ".xn--mgbaam7a8h", ".xn--mgbayh7gpa", ".xn--mgbbh1a71e", ".xn--mgbc0a9azcg", ".xn--mgberp4a5d4ar", ".xn--mgbx4cd0ab", ".xn--ngbc5azd", ".xn--o3cw4h", ".xn--ogbpf8fl", ".xn--p1ai", ".xn--pgbs0dh", ".xn--q9jyb4c", ".xn--s9brj9c", ".xn--unup4y", ".xn--wgbh1c", ".xn--wgbl6a", ".xn--xkc2al3hye2a", ".xn--xkc2dl3a5ee0h", ".xn--yfro4i67o", ".xn--ygbi2ammx", ".xxx", ".ye", ".yt", ".za", ".zm", ".zw"], s = ["co", "me", "ac", "gov", "judiciary", "ltd", "mod", "net", "nhs", "nic", "org", "parliament", "plc", "police", "sch", "bl", "british-library", "jet", "nls"], n = t.lastIndexOf("."), o = t.substring(0, n), a = t.substring(n, t.length), r = !1, l = 0; l < i.length; l++)
                            if (i[l] === a) {
                                if (".uk" !== a) {
                                    r = !0;
                                    break
                                }
                                for (var h = t.split("."), c = h[h.length - 2], u = 0; u < s.length; u++)
                                    if (s[u] === c) {
                                        r = !0;
                                        break
                                    } if (r) break
                            } if (!r) return !1;
                        if (n < 2 || n > 57) return !1;
                        var d = o.substring(0, 1),
                            p = o.substring(o.length - 1, o.length);
                        return "-" !== d && "." !== d && "-" !== p && "." !== p && (!(o.split(".").length > 3 || o.split("..").length > 1) && ("" === o.replace(/[-\da-z\.]/g, "") && (void 0 !== e && e.val(t), !0)))
                    },
                    errorMessage: "",
                    errorMessageKey: "badDomain"
                }), t.formUtils.addValidator({
                    name: "required",
                    validatorFunction: function(e, i) {
                        return "checkbox" == i.attr("type") ? i.is(":checked") : "" !== t.trim(e)
                    },
                    errorMessage: "",
                    errorMessageKey: "requiredFields"
                }), t.formUtils.addValidator({
                    name: "length",
                    validatorFunction: function(e, i, s, n) {
                        var o = i.valAttr("length"),
                            a = i.attr("type");
                        if (null == o) {
                            var r = i.get(0).nodeName;
                            return alert('Please add attribute "data-validation-length" to ' + r + " named " + i.attr("name")), !0
                        }
                        var l, h = "file" == a && void 0 !== i.get(0).files ? i.get(0).files.length : e.length,
                            c = t.formUtils.numericRangeCheck(h, o);
                        switch (c[0]) {
                            case "out":
                                this.errorMessage = n.lengthBadStart + o + n.lengthBadEnd, l = !1;
                                break;
                            case "min":
                                this.errorMessage = n.lengthTooShortStart + c[1] + n.lengthBadEnd, l = !1;
                                break;
                            case "max":
                                this.errorMessage = n.lengthTooLongStart + c[1] + n.lengthBadEnd, l = !1;
                                break;
                            default:
                                l = !0
                        }
                        return l
                    },
                    errorMessage: "",
                    errorMessageKey: ""
                }), t.formUtils.addValidator({
                    name: "url",
                    validatorFunction: function(e) {
                        if (/^(https?|ftp):\/\/((((\w|-|\.|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])(\w|-|\.|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])(\w|-|\.|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/(((\w|-|\.|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/((\w|-|\.|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|\[|\]|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(\#(((\w|-|\.|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i.test(e)) {
                            var i = e.split("://")[1],
                                s = i.indexOf("/");
                            return s > -1 && (i = i.substr(0, s)), t.formUtils.validators.validate_domain.validatorFunction(i)
                        }
                        return !1
                    },
                    errorMessage: "",
                    errorMessageKey: "badUrl"
                }), t.formUtils.addValidator({
                    name: "number",
                    validatorFunction: function(t, e, i) {
                        if ("" !== t) {
                            var s, n, o = e.valAttr("allowing") || "",
                                a = e.valAttr("decimal-separator") || i.decimalSeparator,
                                r = !1;
                            if (-1 == o.indexOf("number") && (o += ",number"), o.indexOf("negative") > -1 && 0 === t.indexOf("-") && (t = t.substr(1)), o.indexOf("range") > -1 && (s = parseFloat(o.substring(o.indexOf("[") + 1, o.indexOf(";"))), n = parseFloat(o.substring(o.indexOf(";") + 1, o.indexOf("]"))), r = !0), o.indexOf("number") > -1 && "" === t.replace(/[0-9]/g, "") && (!r || t >= s && t <= n)) return !0;
                            if (o.indexOf("float") > -1 && null !== t.match(new RegExp("^([0-9]+)\\" + a + "([0-9]+)$")) && (!r || t >= s && t <= n)) return !0
                        }
                        return !1
                    },
                    errorMessage: "",
                    errorMessageKey: "badInt"
                }), t.formUtils.addValidator({
                    name: "alphanumeric",
                    validatorFunction: function(t, e, i, s) {
                        var n = e.attr("data-validation-allowing"),
                            o = "";
                        if (n) {
                            o = "^([a-zA-Z0-9" + n + "]+)$";
                            var a = n.replace(/\\/g, "");
                            a.indexOf(" ") > -1 && (a = a.replace(" ", ""), a += " and spaces "), this.errorMessage = s.badAlphaNumeric + s.badAlphaNumericExtra + a
                        } else o = "^([a-zA-Z0-9]+)$", this.errorMessage = s.badAlphaNumeric;
                        return new RegExp(o).test(t)
                    },
                    errorMessage: "",
                    errorMessageKey: ""
                }), t.formUtils.addValidator({
                    name: "custom",
                    validatorFunction: function(t, e, i) {
                        return new RegExp(e.valAttr("regexp")).test(t)
                    },
                    errorMessage: "",
                    errorMessageKey: "badCustomVal"
                }), t.formUtils.addValidator({
                    name: "date",
                    validatorFunction: function(e, i, s) {
                        var n = "yyyy-mm-dd";
                        return i.valAttr("format") ? n = i.valAttr("format") : s.dateFormat && (n = s.dateFormat), !1 !== t.formUtils.parseDate(e, n)
                    },
                    errorMessage: "",
                    errorMessageKey: "badDate"
                }), t.formUtils.addValidator({
                    name: "checkbox_group",
                    validatorFunction: function(e, i, s, n, o) {
                        var a = !0,
                            r = i.attr("name"),
                            l = t("input[type=checkbox][name^='" + r + "']:checked", o).length,
                            h = i.valAttr("qty");
                        if (null == h) {
                            var c = i.get(0).nodeName;
                            alert('Attribute "data-validation-qty" is missing from ' + c + " named " + i.attr("name"))
                        }
                        var u = t.formUtils.numericRangeCheck(l, h);
                        switch (u[0]) {
                            case "out":
                                this.errorMessage = n.groupCheckedRangeStart + h + n.groupCheckedEnd, a = !1;
                                break;
                            case "min":
                                this.errorMessage = n.groupCheckedTooFewStart + u[1] + n.groupCheckedEnd, a = !1;
                                break;
                            case "max":
                                this.errorMessage = n.groupCheckedTooManyStart + u[1] + n.groupCheckedEnd, a = !1;
                                break;
                            default:
                                a = !0
                        }
                        return a
                    }
                })
            }(jQuery)