! function(t, e) {
                var i, s, n = 0,
                    o = /^ui-id-\d+$/;

                function a(e, i) {
                    var s, n, o, a = e.nodeName.toLowerCase();
                    return "area" === a ? (n = (s = e.parentNode).name, !(!e.href || !n || "map" !== s.nodeName.toLowerCase()) && (!!(o = t("img[usemap=#" + n + "]")[0]) && r(o))) : (/input|select|textarea|button|object/.test(a) ? !e.disabled : "a" === a && e.href || i) && r(e)
                }

                function r(e) {
                    return t.expr.filters.visible(e) && !t(e).parents().addBack().filter((function() {
                        return "hidden" === t.css(this, "visibility")
                    })).length
                }
                t.ui = t.ui || {}, t.extend(t.ui, {
                    version: "1.10.3",
                    keyCode: {
                        BACKSPACE: 8,
                        COMMA: 188,
                        DELETE: 46,
                        DOWN: 40,
                        END: 35,
                        ENTER: 13,
                        ESCAPE: 27,
                        HOME: 36,
                        LEFT: 37,
                        NUMPAD_ADD: 107,
                        NUMPAD_DECIMAL: 110,
                        NUMPAD_DIVIDE: 111,
                        NUMPAD_ENTER: 108,
                        NUMPAD_MULTIPLY: 106,
                        NUMPAD_SUBTRACT: 109,
                        PAGE_DOWN: 34,
                        PAGE_UP: 33,
                        PERIOD: 190,
                        RIGHT: 39,
                        SPACE: 32,
                        TAB: 9,
                        UP: 38
                    }
                }), t.fn.extend({
                    focus: (i = t.fn.focus, function(e, s) {
                        return "number" == typeof e ? this.each((function() {
                            var i = this;
                            setTimeout((function() {
                                t(i).focus(), s && s.call(i)
                            }), e)
                        })) : i.apply(this, arguments)
                    }),
                    scrollParent: function() {
                        var e;
                        return e = t.ui.ie && /(static|relative)/.test(this.css("position")) || /absolute/.test(this.css("position")) ? this.parents().filter((function() {
                            return /(relative|absolute|fixed)/.test(t.css(this, "position")) && /(auto|scroll)/.test(t.css(this, "overflow") + t.css(this, "overflow-y") + t.css(this, "overflow-x"))
                        })).eq(0) : this.parents().filter((function() {
                            return /(auto|scroll)/.test(t.css(this, "overflow") + t.css(this, "overflow-y") + t.css(this, "overflow-x"))
                        })).eq(0), /fixed/.test(this.css("position")) || !e.length ? t(document) : e
                    },
                    zIndex: function(e) {
                        if (void 0 !== e) return this.css("zIndex", e);
                        if (this.length)
                            for (var i, s, n = t(this[0]); n.length && n[0] !== document;) {
                                if (("absolute" === (i = n.css("position")) || "relative" === i || "fixed" === i) && (s = parseInt(n.css("zIndex"), 10), !isNaN(s) && 0 !== s)) return s;
                                n = n.parent()
                            }
                        return 0
                    },
                    uniqueId: function() {
                        return this.each((function() {
                            this.id || (this.id = "ui-id-" + ++n)
                        }))
                    },
                    removeUniqueId: function() {
                        return this.each((function() {
                            o.test(this.id) && t(this).removeAttr("id")
                        }))
                    }
                }), t.extend(t.expr[":"], {
                    data: t.expr.createPseudo ? t.expr.createPseudo((function(e) {
                        return function(i) {
                            return !!t.data(i, e)
                        }
                    })) : function(e, i, s) {
                        return !!t.data(e, s[3])
                    },
                    focusable: function(e) {
                        return a(e, !isNaN(t.attr(e, "tabindex")))
                    },
                    tabbable: function(e) {
                        var i = t.attr(e, "tabindex"),
                            s = isNaN(i);
                        return (s || i >= 0) && a(e, !s)
                    }
                }), t("<a>").outerWidth(1).jquery || t.each(["Width", "Height"], (function(e, i) {
                    var s = "Width" === i ? ["Left", "Right"] : ["Top", "Bottom"],
                        n = i.toLowerCase(),
                        o = {
                            innerWidth: t.fn.innerWidth,
                            innerHeight: t.fn.innerHeight,
                            outerWidth: t.fn.outerWidth,
                            outerHeight: t.fn.outerHeight
                        };

                    function a(e, i, n, o) {
                        return t.each(s, (function() {
                            i -= parseFloat(t.css(e, "padding" + this)) || 0, n && (i -= parseFloat(t.css(e, "border" + this + "Width")) || 0), o && (i -= parseFloat(t.css(e, "margin" + this)) || 0)
                        })), i
                    }
                    t.fn["inner" + i] = function(e) {
                        return void 0 === e ? o["inner" + i].call(this) : this.each((function() {
                            t(this).css(n, a(this, e) + "px")
                        }))
                    }, t.fn["outer" + i] = function(e, s) {
                        return "number" != typeof e ? o["outer" + i].call(this, e) : this.each((function() {
                            t(this).css(n, a(this, e, !0, s) + "px")
                        }))
                    }
                })), t.fn.addBack || (t.fn.addBack = function(t) {
                    return this.add(null == t ? this.prevObject : this.prevObject.filter(t))
                }), t("<a>").data("a-b", "a").removeData("a-b").data("a-b") && (t.fn.removeData = (s = t.fn.removeData, function(e) {
                    return arguments.length ? s.call(this, t.camelCase(e)) : s.call(this)
                })), t.ui.ie = !!/msie [\w.]+/.exec(navigator.userAgent.toLowerCase()), t.support.selectstart = "onselectstart" in document.createElement("div"), t.fn.extend({
                    disableSelection: function() {
                        return this.bind((t.support.selectstart ? "selectstart" : "mousedown") + ".ui-disableSelection", (function(t) {
                            t.preventDefault()
                        }))
                    },
                    enableSelection: function() {
                        return this.unbind(".ui-disableSelection")
                    }
                }), t.extend(t.ui, {
                    plugin: {
                        add: function(e, i, s) {
                            var n, o = t.ui[e].prototype;
                            for (n in s) o.plugins[n] = o.plugins[n] || [], o.plugins[n].push([i, s[n]])
                        },
                        call: function(t, e, i) {
                            var s, n = t.plugins[e];
                            if (n && t.element[0].parentNode && 11 !== t.element[0].parentNode.nodeType)
                                for (s = 0; s < n.length; s++) t.options[n[s][0]] && n[s][1].apply(t.element, i)
                        }
                    },
                    hasScroll: function(e, i) {
                        if ("hidden" === t(e).css("overflow")) return !1;
                        var s, n = i && "left" === i ? "scrollLeft" : "scrollTop";
                        return e[n] > 0 || (e[n] = 1, s = e[n] > 0, e[n] = 0, s)
                    }
                })
            }(jQuery);
            function(t, e) {
                var i = 0,
                    s = Array.prototype.slice,
                    n = t.cleanData;
                t.cleanData = function(e) {
                    for (var i, s = 0; null != (i = e[s]); s++) try {
                        t(i).triggerHandler("remove")
                    } catch (t) {}
                    n(e)
                }, t.widget = function(e, i, s) {
                    var n, o, a, r, l = {},
                        h = e.split(".")[0];
                    e = e.split(".")[1], n = h + "-" + e, s || (s = i, i = t.Widget), t.expr[":"][n.toLowerCase()] = function(e) {
                        return !!t.data(e, n)
                    }, t[h] = t[h] || {}, o = t[h][e], a = t[h][e] = function(t, e) {
                        if (!this._createWidget) return new a(t, e);
                        arguments.length && this._createWidget(t, e)
                    }, t.extend(a, o, {
                        version: s.version,
                        _proto: t.extend({}, s),
                        _childConstructors: []
                    }), (r = new i).options = t.widget.extend({}, r.options), t.each(s, (function(e, s) {
                        var n, o;
                        t.isFunction(s) ? l[e] = (n = function() {
                            return i.prototype[e].apply(this, arguments)
                        }, o = function(t) {
                            return i.prototype[e].apply(this, t)
                        }, function() {
                            var t, e = this._super,
                                i = this._superApply;
                            return this._super = n, this._superApply = o, t = s.apply(this, arguments), this._super = e, this._superApply = i, t
                        }) : l[e] = s
                    })), a.prototype = t.widget.extend(r, {
                        widgetEventPrefix: o ? r.widgetEventPrefix : e
                    }, l, {
                        constructor: a,
                        namespace: h,
                        widgetName: e,
                        widgetFullName: n
                    }), o ? (t.each(o._childConstructors, (function(e, i) {
                        var s = i.prototype;
                        t.widget(s.namespace + "." + s.widgetName, a, i._proto)
                    })), delete o._childConstructors) : i._childConstructors.push(a), t.widget.bridge(e, a)
                }, t.widget.extend = function(e) {
                    for (var i, n, o = s.call(arguments, 1), a = 0, r = o.length; a < r; a++)
                        for (i in o[a]) n = o[a][i], o[a].hasOwnProperty(i) && void 0 !== n && (t.isPlainObject(n) ? e[i] = t.isPlainObject(e[i]) ? t.widget.extend({}, e[i], n) : t.widget.extend({}, n) : e[i] = n);
                    return e
                }, t.widget.bridge = function(e, i) {
                    var n = i.prototype.widgetFullName || e;
                    t.fn[e] = function(o) {
                        var a = "string" == typeof o,
                            r = s.call(arguments, 1),
                            l = this;
                        return o = !a && r.length ? t.widget.extend.apply(null, [o].concat(r)) : o, a ? this.each((function() {
                            var i, s = t.data(this, n);
                            return s ? t.isFunction(s[o]) && "_" !== o.charAt(0) ? (i = s[o].apply(s, r)) !== s && void 0 !== i ? (l = i && i.jquery ? l.pushStack(i.get()) : i, !1) : void 0 : t.error("no such method '" + o + "' for " + e + " widget instance") : t.error("cannot call methods on " + e + " prior to initialization; attempted to call method '" + o + "'")
                        })) : this.each((function() {
                            var e = t.data(this, n);
                            e ? e.option(o || {})._init() : t.data(this, n, new i(o, this))
                        })), l
                    }
                }, t.Widget = function() {}, t.Widget._childConstructors = [], t.Widget.prototype = {
                    widgetName: "widget",
                    widgetEventPrefix: "",
                    defaultElement: "<div>",
                    options: {
                        disabled: !1,
                        create: null
                    },
                    _createWidget: function(e, s) {
                        s = t(s || this.defaultElement || this)[0], this.element = t(s), this.uuid = i++, this.eventNamespace = "." + this.widgetName + this.uuid, this.options = t.widget.extend({}, this.options, this._getCreateOptions(), e), this.bindings = t(), this.hoverable = t(), this.focusable = t(), s !== this && (t.data(s, this.widgetFullName, this), this._on(!0, this.element, {
                            remove: function(t) {
                                t.target === s && this.destroy()
                            }
                        }), this.document = t(s.style ? s.ownerDocument : s.document || s), this.window = t(this.document[0].defaultView || this.document[0].parentWindow)), this._create(), this._trigger("create", null, this._getCreateEventData()), this._init()
                    },
                    _getCreateOptions: t.noop,
                    _getCreateEventData: t.noop,
                    _create: t.noop,
                    _init: t.noop,
                    destroy: function() {
                        this._destroy(), this.element.unbind(this.eventNamespace).removeData(this.widgetName).removeData(this.widgetFullName).removeData(t.camelCase(this.widgetFullName)), this.widget().unbind(this.eventNamespace).removeAttr("aria-disabled").removeClass(this.widgetFullName + "-disabled ui-state-disabled"), this.bindings.unbind(this.eventNamespace), this.hoverable.removeClass("ui-state-hover"), this.focusable.removeClass("ui-state-focus")
                    },
                    _destroy: t.noop,
                    widget: function() {
                        return this.element
                    },
                    option: function(e, i) {
                        var s, n, o, a = e;
                        if (0 === arguments.length) return t.widget.extend({}, this.options);
                        if ("string" == typeof e)
                            if (a = {}, s = e.split("."), e = s.shift(), s.length) {
                                for (n = a[e] = t.widget.extend({}, this.options[e]), o = 0; o < s.length - 1; o++) n[s[o]] = n[s[o]] || {}, n = n[s[o]];
                                if (e = s.pop(), void 0 === i) return void 0 === n[e] ? null : n[e];
                                n[e] = i
                            } else {
                                if (void 0 === i) return void 0 === this.options[e] ? null : this.options[e];
                                a[e] = i
                            } return this._setOptions(a), this
                    },
                    _setOptions: function(t) {
                        var e;
                        for (e in t) this._setOption(e, t[e]);
                        return this
                    },
                    _setOption: function(t, e) {
                        return this.options[t] = e, "disabled" === t && (this.widget().toggleClass(this.widgetFullName + "-disabled ui-state-disabled", !!e).attr("aria-disabled", e), this.hoverable.removeClass("ui-state-hover"), this.focusable.removeClass("ui-state-focus")), this
                    },
                    enable: function() {
                        return this._setOption("disabled", !1)
                    },
                    disable: function() {
                        return this._setOption("disabled", !0)
                    },
                    _on: function(e, i, s) {
                        var n, o = this;
                        "boolean" != typeof e && (s = i, i = e, e = !1), s ? (i = n = t(i), this.bindings = this.bindings.add(i)) : (s = i, i = this.element, n = this.widget()), t.each(s, (function(s, a) {
                            function r() {
                                if (e || !0 !== o.options.disabled && !t(this).hasClass("ui-state-disabled")) return ("string" == typeof a ? o[a] : a).apply(o, arguments)
                            }
                            "string" != typeof a && (r.guid = a.guid = a.guid || r.guid || t.guid++);
                            var l = s.match(/^(\w+)\s*(.*)$/),
                                h = l[1] + o.eventNamespace,
                                c = l[2];
                            c ? n.delegate(c, h, r) : i.bind(h, r)
                        }))
                    },
                    _off: function(t, e) {
                        e = (e || "").split(" ").join(this.eventNamespace + " ") + this.eventNamespace, t.unbind(e).undelegate(e)
                    },
                    _delay: function(t, e) {
                        var i = this;
                        return setTimeout((function() {
                            return ("string" == typeof t ? i[t] : t).apply(i, arguments)
                        }), e || 0)
                    },
                    _hoverable: function(e) {
                        this.hoverable = this.hoverable.add(e), this._on(e, {
                            mouseenter: function(e) {
                                t(e.currentTarget).addClass("ui-state-hover")
                            },
                            mouseleave: function(e) {
                                t(e.currentTarget).removeClass("ui-state-hover")
                            }
                        })
                    },
                    _focusable: function(e) {
                        this.focusable = this.focusable.add(e), this._on(e, {
                            focusin: function(e) {
                                t(e.currentTarget).addClass("ui-state-focus")
                            },
                            focusout: function(e) {
                                t(e.currentTarget).removeClass("ui-state-focus")
                            }
                        })
                    },
                    _trigger: function(e, i, s) {
                        var n, o, a = this.options[e];
                        if (s = s || {}, (i = t.Event(i)).type = (e === this.widgetEventPrefix ? e : this.widgetEventPrefix + e).toLowerCase(), i.target = this.element[0], o = i.originalEvent)
                            for (n in o) n in i || (i[n] = o[n]);
                        return this.element.trigger(i, s), !(t.isFunction(a) && !1 === a.apply(this.element[0], [i].concat(s)) || i.isDefaultPrevented())
                    }
                }, t.each({
                    show: "fadeIn",
                    hide: "fadeOut"
                }, (function(e, i) {
                    t.Widget.prototype["_" + e] = function(s, n, o) {
                        "string" == typeof n && (n = {
                            effect: n
                        });
                        var a, r = n ? !0 === n || "number" == typeof n ? i : n.effect || i : e;
                        "number" == typeof(n = n || {}) && (n = {
                            duration: n
                        }), a = !t.isEmptyObject(n), n.complete = o, n.delay && s.delay(n.delay), a && t.effects && t.effects.effect[r] ? s[e](n) : r !== e && s[r] ? s[r](n.duration, n.easing, o) : s.queue((function(i) {
                            t(this)[e](), o && o.call(s[0]), i()
                        }))
                    }
                }))
            }(jQuery);
            function(t, e) {
                var i = !1;
                t(document).mouseup((function() {
                    i = !1
                })), t.widget("ui.mouse", {
                    version: "1.10.3",
                    options: {
                        cancel: "input,textarea,button,select,option",
                        distance: 1,
                        delay: 0
                    },
                    _mouseInit: function() {
                        var e = this;
                        this.element.bind("mousedown." + this.widgetName, (function(t) {
                            return e._mouseDown(t)
                        })).bind("click." + this.widgetName, (function(i) {
                            if (!0 === t.data(i.target, e.widgetName + ".preventClickEvent")) return t.removeData(i.target, e.widgetName + ".preventClickEvent"), i.stopImmediatePropagation(), !1
                        })), this.started = !1
                    },
                    _mouseDestroy: function() {
                        this.element.unbind("." + this.widgetName), this._mouseMoveDelegate && t(document).unbind("mousemove." + this.widgetName, this._mouseMoveDelegate).unbind("mouseup." + this.widgetName, this._mouseUpDelegate)
                    },
                    _mouseDown: function(e) {
                        if (!i) {
                            this._mouseStarted && this._mouseUp(e), this._mouseDownEvent = e;
                            var s = this,
                                n = 1 === e.which,
                                o = !("string" != typeof this.options.cancel || !e.target.nodeName) && t(e.target).closest(this.options.cancel).length;
                            return !(n && !o && this._mouseCapture(e)) || (this.mouseDelayMet = !this.options.delay, this.mouseDelayMet || (this._mouseDelayTimer = setTimeout((function() {
                                s.mouseDelayMet = !0
                            }), this.options.delay)), this._mouseDistanceMet(e) && this._mouseDelayMet(e) && (this._mouseStarted = !1 !== this._mouseStart(e), !this._mouseStarted) ? (e.preventDefault(), !0) : (!0 === t.data(e.target, this.widgetName + ".preventClickEvent") && t.removeData(e.target, this.widgetName + ".preventClickEvent"), this._mouseMoveDelegate = function(t) {
                                return s._mouseMove(t)
                            }, this._mouseUpDelegate = function(t) {
                                return s._mouseUp(t)
                            }, t(document).bind("mousemove." + this.widgetName, this._mouseMoveDelegate).bind("mouseup." + this.widgetName, this._mouseUpDelegate), e.preventDefault(), i = !0, !0))
                        }
                    },
                    _mouseMove: function(e) {
                        return t.ui.ie && (!document.documentMode || document.documentMode < 9) && !e.button ? this._mouseUp(e) : this._mouseStarted ? (this._mouseDrag(e), e.preventDefault()) : (this._mouseDistanceMet(e) && this._mouseDelayMet(e) && (this._mouseStarted = !1 !== this._mouseStart(this._mouseDownEvent, e), this._mouseStarted ? this._mouseDrag(e) : this._mouseUp(e)), !this._mouseStarted)
                    },
                    _mouseUp: function(e) {
                        return t(document).unbind("mousemove." + this.widgetName, this._mouseMoveDelegate).unbind("mouseup." + this.widgetName, this._mouseUpDelegate), this._mouseStarted && (this._mouseStarted = !1, e.target === this._mouseDownEvent.target && t.data(e.target, this.widgetName + ".preventClickEvent", !0), this._mouseStop(e)), !1
                    },
                    _mouseDistanceMet: function(t) {
                        return Math.max(Math.abs(this._mouseDownEvent.pageX - t.pageX), Math.abs(this._mouseDownEvent.pageY - t.pageY)) >= this.options.distance
                    },
                    _mouseDelayMet: function() {
                        return this.mouseDelayMet
                    },
                    _mouseStart: function() {},
                    _mouseDrag: function() {},
                    _mouseStop: function() {},
                    _mouseCapture: function() {
                        return !0
                    }
                })
            }(jQuery);
            function(t, e) {
                t.ui = t.ui || {};
                var i, s = Math.max,
                    n = Math.abs,
                    o = Math.round,
                    a = /left|center|right/,
                    r = /top|center|bottom/,
                    l = /[\+\-]\d+(\.[\d]+)?%?/,
                    h = /^\w+/,
                    c = /%$/,
                    u = t.fn.position;

                function d(t, e, i) {
                    return [parseFloat(t[0]) * (c.test(t[0]) ? e / 100 : 1), parseFloat(t[1]) * (c.test(t[1]) ? i / 100 : 1)]
                }

                function p(e, i) {
                    return parseInt(t.css(e, i), 10) || 0
                }

                function f(e) {
                    var i = e[0];
                    return 9 === i.nodeType ? {
                        width: e.width(),
                        height: e.height(),
                        offset: {
                            top: 0,
                            left: 0
                        }
                    } : t.isWindow(i) ? {
                        width: e.width(),
                        height: e.height(),
                        offset: {
                            top: e.scrollTop(),
                            left: e.scrollLeft()
                        }
                    } : i.preventDefault ? {
                        width: 0,
                        height: 0,
                        offset: {
                            top: i.pageY,
                            left: i.pageX
                        }
                    } : {
                        width: e.outerWidth(),
                        height: e.outerHeight(),
                        offset: e.offset()
                    }
                }
                t.position = {
                        scrollbarWidth: function() {
                            if (void 0 !== i) return i;
                            var e, s, n = t("<div style='display:block;width:50px;height:50px;overflow:hidden;'><div style='height:100px;width:auto;'></div></div>"),
                                o = n.children()[0];
                            return t("body").append(n), e = o.offsetWidth, n.css("overflow", "scroll"), e === (s = o.offsetWidth) && (s = n[0].clientWidth), n.remove(), i = e - s
                        },
                        getScrollInfo: function(e) {
                            var i = e.isWindow ? "" : e.element.css("overflow-x"),
                                s = e.isWindow ? "" : e.element.css("overflow-y"),
                                n = "scroll" === i || "auto" === i && e.width < e.element[0].scrollWidth;
                            return {
                                width: "scroll" === s || "auto" === s && e.height < e.element[0].scrollHeight ? t.position.scrollbarWidth() : 0,
                                height: n ? t.position.scrollbarWidth() : 0
                            }
                        },
                        getWithinInfo: function(e) {
                            var i = t(e || window),
                                s = t.isWindow(i[0]);
                            return {
                                element: i,
                                isWindow: s,
                                offset: i.offset() || {
                                    left: 0,
                                    top: 0
                                },
                                scrollLeft: i.scrollLeft(),
                                scrollTop: i.scrollTop(),
                                width: s ? i.width() : i.outerWidth(),
                                height: s ? i.height() : i.outerHeight()
                            }
                        }
                    }, t.fn.position = function(e) {
                        if (!e || !e.of) return u.apply(this, arguments);
                        e = t.extend({}, e);
                        var i, c, m, g, v, b, y = t(e.of),
                            _ = t.position.getWithinInfo(e.within),
                            w = t.position.getScrollInfo(_),
                            x = (e.collision || "flip").split(" "),
                            k = {};
                        return b = f(y), y[0].preventDefault && (e.at = "left top"), c = b.width, m = b.height, g = b.offset, v = t.extend({}, g), t.each(["my", "at"], (function() {
                            var t, i, s = (e[this] || "").split(" ");
                            1 === s.length && (s = a.test(s[0]) ? s.concat(["center"]) : r.test(s[0]) ? ["center"].concat(s) : ["center", "center"]), s[0] = a.test(s[0]) ? s[0] : "center", s[1] = r.test(s[1]) ? s[1] : "center", t = l.exec(s[0]), i = l.exec(s[1]), k[this] = [t ? t[0] : 0, i ? i[0] : 0], e[this] = [h.exec(s[0])[0], h.exec(s[1])[0]]
                        })), 1 === x.length && (x[1] = x[0]), "right" === e.at[0] ? v.left += c : "center" === e.at[0] && (v.left += c / 2), "bottom" === e.at[1] ? v.top += m : "center" === e.at[1] && (v.top += m / 2), i = d(k.at, c, m), v.left += i[0], v.top += i[1], this.each((function() {
                            var a, r, l = t(this),
                                h = l.outerWidth(),
                                u = l.outerHeight(),
                                f = p(this, "marginLeft"),
                                b = p(this, "marginTop"),
                                C = h + f + p(this, "marginRight") + w.width,
                                D = u + b + p(this, "marginBottom") + w.height,
                                $ = t.extend({}, v),
                                T = d(k.my, l.outerWidth(), l.outerHeight());
                            "right" === e.my[0] ? $.left -= h : "center" === e.my[0] && ($.left -= h / 2), "bottom" === e.my[1] ? $.top -= u : "center" === e.my[1] && ($.top -= u / 2), $.left += T[0], $.top += T[1], t.support.offsetFractions || ($.left = o($.left), $.top = o($.top)), a = {
                                marginLeft: f,
                                marginTop: b
                            }, t.each(["left", "top"], (function(s, n) {
                                t.ui.position[x[s]] && t.ui.position[x[s]][n]($, {
                                    targetWidth: c,
                                    targetHeight: m,
                                    elemWidth: h,
                                    elemHeight: u,
                                    collisionPosition: a,
                                    collisionWidth: C,
                                    collisionHeight: D,
                                    offset: [i[0] + T[0], i[1] + T[1]],
                                    my: e.my,
                                    at: e.at,
                                    within: _,
                                    elem: l
                                })
                            })), e.using && (r = function(t) {
                                var i = g.left - $.left,
                                    o = i + c - h,
                                    a = g.top - $.top,
                                    r = a + m - u,
                                    d = {
                                        target: {
                                            element: y,
                                            left: g.left,
                                            top: g.top,
                                            width: c,
                                            height: m
                                        },
                                        element: {
                                            element: l,
                                            left: $.left,
                                            top: $.top,
                                            width: h,
                                            height: u
                                        },
                                        horizontal: o < 0 ? "left" : i > 0 ? "right" : "center",
                                        vertical: r < 0 ? "top" : a > 0 ? "bottom" : "middle"
                                    };
                                c < h && n(i + o) < c && (d.horizontal = "center"), m < u && n(a + r) < m && (d.vertical = "middle"), s(n(i), n(o)) > s(n(a), n(r)) ? d.important = "horizontal" : d.important = "vertical", e.using.call(this, t, d)
                            }), l.offset(t.extend($, {
                                using: r
                            }))
                        }))
                    }, t.ui.position = {
                        fit: {
                            left: function(t, e) {
                                var i, n = e.within,
                                    o = n.isWindow ? n.scrollLeft : n.offset.left,
                                    a = n.width,
                                    r = t.left - e.collisionPosition.marginLeft,
                                    l = o - r,
                                    h = r + e.collisionWidth - a - o;
                                e.collisionWidth > a ? l > 0 && h <= 0 ? (i = t.left + l + e.collisionWidth - a - o, t.left += l - i) : t.left = h > 0 && l <= 0 ? o : l > h ? o + a - e.collisionWidth : o : l > 0 ? t.left += l : h > 0 ? t.left -= h : t.left = s(t.left - r, t.left)
                            },
                            top: function(t, e) {
                                var i, n = e.within,
                                    o = n.isWindow ? n.scrollTop : n.offset.top,
                                    a = e.within.height,
                                    r = t.top - e.collisionPosition.marginTop,
                                    l = o - r,
                                    h = r + e.collisionHeight - a - o;
                                e.collisionHeight > a ? l > 0 && h <= 0 ? (i = t.top + l + e.collisionHeight - a - o, t.top += l - i) : t.top = h > 0 && l <= 0 ? o : l > h ? o + a - e.collisionHeight : o : l > 0 ? t.top += l : h > 0 ? t.top -= h : t.top = s(t.top - r, t.top)
                            }
                        },
                        flip: {
                            left: function(t, e) {
                                var i, s, o = e.within,
                                    a = o.offset.left + o.scrollLeft,
                                    r = o.width,
                                    l = o.isWindow ? o.scrollLeft : o.offset.left,
                                    h = t.left - e.collisionPosition.marginLeft,
                                    c = h - l,
                                    u = h + e.collisionWidth - r - l,
                                    d = "left" === e.my[0] ? -e.elemWidth : "right" === e.my[0] ? e.elemWidth : 0,
                                    p = "left" === e.at[0] ? e.targetWidth : "right" === e.at[0] ? -e.targetWidth : 0,
                                    f = -2 * e.offset[0];
                                c < 0 ? ((i = t.left + d + p + f + e.collisionWidth - r - a) < 0 || i < n(c)) && (t.left += d + p + f) : u > 0 && ((s = t.left - e.collisionPosition.marginLeft + d + p + f - l) > 0 || n(s) < u) && (t.left += d + p + f)
                            },
                            top: function(t, e) {
                                var i, s, o = e.within,
                                    a = o.offset.top + o.scrollTop,
                                    r = o.height,
                                    l = o.isWindow ? o.scrollTop : o.offset.top,
                                    h = t.top - e.collisionPosition.marginTop,
                                    c = h - l,
                                    u = h + e.collisionHeight - r - l,
                                    d = "top" === e.my[1],
                                    p = d ? -e.elemHeight : "bottom" === e.my[1] ? e.elemHeight : 0,
                                    f = "top" === e.at[1] ? e.targetHeight : "bottom" === e.at[1] ? -e.targetHeight : 0,
                                    m = -2 * e.offset[1];
                                c < 0 ? (s = t.top + p + f + m + e.collisionHeight - r - a, t.top + p + f + m > c && (s < 0 || s < n(c)) && (t.top += p + f + m)) : u > 0 && (i = t.top - e.collisionPosition.marginTop + p + f + m - l, t.top + p + f + m > u && (i > 0 || n(i) < u) && (t.top += p + f + m))
                            }
                        },
                        flipfit: {
                            left: function() {
                                t.ui.position.flip.left.apply(this, arguments), t.ui.position.fit.left.apply(this, arguments)
                            },
                            top: function() {
                                t.ui.position.flip.top.apply(this, arguments), t.ui.position.fit.top.apply(this, arguments)
                            }
                        }
                    },
                    function() {
                        var e, i, s, n, o, a = document.getElementsByTagName("body")[0],
                            r = document.createElement("div");
                        for (o in e = document.createElement(a ? "div" : "body"), s = {
                                visibility: "hidden",
                                width: 0,
                                height: 0,
                                border: 0,
                                margin: 0,
                                background: "none"
                            }, a && t.extend(s, {
                                position: "absolute",
                                left: "-1000px",
                                top: "-1000px"
                            }), s) e.style[o] = s[o];
                        e.appendChild(r), (i = a || document.documentElement).insertBefore(e, i.firstChild), r.style.cssText = "position: absolute; left: 10.7432222px;", n = t(r).offset().left, t.support.offsetFractions = n > 10 && n < 11, e.innerHTML = "", i.removeChild(e)
                    }()
            }(jQuery);
            function(t, e) {
                t.widget("ui.draggable", t.ui.mouse, {
                    version: "1.10.3",
                    widgetEventPrefix: "drag",
                    options: {
                        addClasses: !0,
                        appendTo: "parent",
                        axis: !1,
                        connectToSortable: !1,
                        containment: !1,
                        cursor: "auto",
                        cursorAt: !1,
                        grid: !1,
                        handle: !1,
                        helper: "original",
                        iframeFix: !1,
                        opacity: !1,
                        refreshPositions: !1,
                        revert: !1,
                        revertDuration: 500,
                        scope: "default",
                        scroll: !0,
                        scrollSensitivity: 20,
                        scrollSpeed: 20,
                        snap: !1,
                        snapMode: "both",
                        snapTolerance: 20,
                        stack: !1,
                        zIndex: !1,
                        drag: null,
                        start: null,
                        stop: null
                    },
                    _create: function() {
                        "original" !== this.options.helper || /^(?:r|a|f)/.test(this.element.css("position")) || (this.element[0].style.position = "relative"), this.options.addClasses && this.element.addClass("ui-draggable"), this.options.disabled && this.element.addClass("ui-draggable-disabled"), this._mouseInit()
                    },
                    _destroy: function() {
                        this.element.removeClass("ui-draggable ui-draggable-dragging ui-draggable-disabled"), this._mouseDestroy()
                    },
                    _mouseCapture: function(e) {
                        var i = this.options;
                        return !(this.helper || i.disabled || t(e.target).closest(".ui-resizable-handle").length > 0) && (this.handle = this._getHandle(e), !!this.handle && (t(!0 === i.iframeFix ? "iframe" : i.iframeFix).each((function() {
                            t("<div class='ui-draggable-iframeFix' style='background: #fff;'></div>").css({
                                width: this.offsetWidth + "px",
                                height: this.offsetHeight + "px",
                                position: "absolute",
                                opacity: "0.001",
                                zIndex: 1e3
                            }).css(t(this).offset()).appendTo("body")
                        })), !0))
                    },
                    _mouseStart: function(e) {
                        var i = this.options;
                        return this.helper = this._createHelper(e), this.helper.addClass("ui-draggable-dragging"), this._cacheHelperProportions(), t.ui.ddmanager && (t.ui.ddmanager.current = this), this._cacheMargins(), this.cssPosition = this.helper.css("position"), this.scrollParent = this.helper.scrollParent(), this.offsetParent = this.helper.offsetParent(), this.offsetParentCssPosition = this.offsetParent.css("position"), this.offset = this.positionAbs = this.element.offset(), this.offset = {
                            top: this.offset.top - this.margins.top,
                            left: this.offset.left - this.margins.left
                        }, this.offset.scroll = !1, t.extend(this.offset, {
                            click: {
                                left: e.pageX - this.offset.left,
                                top: e.pageY - this.offset.top
                            },
                            parent: this._getParentOffset(),
                            relative: this._getRelativeOffset()
                        }), this.originalPosition = this.position = this._generatePosition(e), this.originalPageX = e.pageX, this.originalPageY = e.pageY, i.cursorAt && this._adjustOffsetFromHelper(i.cursorAt), this._setContainment(), !1 === this._trigger("start", e) ? (this._clear(), !1) : (this._cacheHelperProportions(), t.ui.ddmanager && !i.dropBehaviour && t.ui.ddmanager.prepareOffsets(this, e), this._mouseDrag(e, !0), t.ui.ddmanager && t.ui.ddmanager.dragStart(this, e), !0)
                    },
                    _mouseDrag: function(e, i) {
                        if ("fixed" === this.offsetParentCssPosition && (this.offset.parent = this._getParentOffset()), this.position = this._generatePosition(e), this.positionAbs = this._convertPositionTo("absolute"), !i) {
                            var s = this._uiHash();
                            if (!1 === this._trigger("drag", e, s)) return this._mouseUp({}), !1;
                            this.position = s.position
                        }
                        return this.options.axis && "y" === this.options.axis || (this.helper[0].style.left = this.position.left + "px"), this.options.axis && "x" === this.options.axis || (this.helper[0].style.top = this.position.top + "px"), t.ui.ddmanager && t.ui.ddmanager.drag(this, e), !1
                    },
                    _mouseStop: function(e) {
                        var i = this,
                            s = !1;
                        return t.ui.ddmanager && !this.options.dropBehaviour && (s = t.ui.ddmanager.drop(this, e)), this.dropped && (s = this.dropped, this.dropped = !1), !("original" === this.options.helper && !t.contains(this.element[0].ownerDocument, this.element[0])) && ("invalid" === this.options.revert && !s || "valid" === this.options.revert && s || !0 === this.options.revert || t.isFunction(this.options.revert) && this.options.revert.call(this.element, s) ? t(this.helper).animate(this.originalPosition, parseInt(this.options.revertDuration, 10), (function() {
                            !1 !== i._trigger("stop", e) && i._clear()
                        })) : !1 !== this._trigger("stop", e) && this._clear(), !1)
                    },
                    _mouseUp: function(e) {
                        return t("div.ui-draggable-iframeFix").each((function() {
                            this.parentNode.removeChild(this)
                        })), t.ui.ddmanager && t.ui.ddmanager.dragStop(this, e), t.ui.mouse.prototype._mouseUp.call(this, e)
                    },
                    cancel: function() {
                        return this.helper.is(".ui-draggable-dragging") ? this._mouseUp({}) : this._clear(), this
                    },
                    _getHandle: function(e) {
                        return !this.options.handle || !!t(e.target).closest(this.element.find(this.options.handle)).length
                    },
                    _createHelper: function(e) {
                        var i = this.options,
                            s = t.isFunction(i.helper) ? t(i.helper.apply(this.element[0], [e])) : "clone" === i.helper ? this.element.clone().removeAttr("id") : this.element;
                        return s.parents("body").length || s.appendTo("parent" === i.appendTo ? this.element[0].parentNode : i.appendTo), s[0] === this.element[0] || /(fixed|absolute)/.test(s.css("position")) || s.css("position", "absolute"), s
                    },
                    _adjustOffsetFromHelper: function(e) {
                        "string" == typeof e && (e = e.split(" ")), t.isArray(e) && (e = {
                            left: +e[0],
                            top: +e[1] || 0
                        }), "left" in e && (this.offset.click.left = e.left + this.margins.left), "right" in e && (this.offset.click.left = this.helperProportions.width - e.right + this.margins.left), "top" in e && (this.offset.click.top = e.top + this.margins.top), "bottom" in e && (this.offset.click.top = this.helperProportions.height - e.bottom + this.margins.top)
                    },
                    _getParentOffset: function() {
                        var e = this.offsetParent.offset();
                        return "absolute" === this.cssPosition && this.scrollParent[0] !== document && t.contains(this.scrollParent[0], this.offsetParent[0]) && (e.left += this.scrollParent.scrollLeft(), e.top += this.scrollParent.scrollTop()), (this.offsetParent[0] === document.body || this.offsetParent[0].tagName && "html" === this.offsetParent[0].tagName.toLowerCase() && t.ui.ie) && (e = {
                            top: 0,
                            left: 0
                        }), {
                            top: e.top + (parseInt(this.offsetParent.css("borderTopWidth"), 10) || 0),
                            left: e.left + (parseInt(this.offsetParent.css("borderLeftWidth"), 10) || 0)
                        }
                    },
                    _getRelativeOffset: function() {
                        if ("relative" === this.cssPosition) {
                            var t = this.element.position();
                            return {
                                top: t.top - (parseInt(this.helper.css("top"), 10) || 0) + this.scrollParent.scrollTop(),
                                left: t.left - (parseInt(this.helper.css("left"), 10) || 0) + this.scrollParent.scrollLeft()
                            }
                        }
                        return {
                            top: 0,
                            left: 0
                        }
                    },
                    _cacheMargins: function() {
                        this.margins = {
                            left: parseInt(this.element.css("marginLeft"), 10) || 0,
                            top: parseInt(this.element.css("marginTop"), 10) || 0,
                            right: parseInt(this.element.css("marginRight"), 10) || 0,
                            bottom: parseInt(this.element.css("marginBottom"), 10) || 0
                        }
                    },
                    _cacheHelperProportions: function() {
                        this.helperProportions = {
                            width: this.helper.outerWidth(),
                            height: this.helper.outerHeight()
                        }
                    },
                    _setContainment: function() {
                        var e, i, s, n = this.options;
                        n.containment ? "window" !== n.containment ? "document" !== n.containment ? n.containment.constructor !== Array ? ("parent" === n.containment && (n.containment = this.helper[0].parentNode), (s = (i = t(n.containment))[0]) && (e = "hidden" !== i.css("overflow"), this.containment = [(parseInt(i.css("borderLeftWidth"), 10) || 0) + (parseInt(i.css("paddingLeft"), 10) || 0), (parseInt(i.css("borderTopWidth"), 10) || 0) + (parseInt(i.css("paddingTop"), 10) || 0), (e ? Math.max(s.scrollWidth, s.offsetWidth) : s.offsetWidth) - (parseInt(i.css("borderRightWidth"), 10) || 0) - (parseInt(i.css("paddingRight"), 10) || 0) - this.helperProportions.width - this.margins.left - this.margins.right, (e ? Math.max(s.scrollHeight, s.offsetHeight) : s.offsetHeight) - (parseInt(i.css("borderBottomWidth"), 10) || 0) - (parseInt(i.css("paddingBottom"), 10) || 0) - this.helperProportions.height - this.margins.top - this.margins.bottom], this.relative_container = i)) : this.containment = n.containment : this.containment = [0, 0, t(document).width() - this.helperProportions.width - this.margins.left, (t(document).height() || document.body.parentNode.scrollHeight) - this.helperProportions.height - this.margins.top] : this.containment = [t(window).scrollLeft() - this.offset.relative.left - this.offset.parent.left, t(window).scrollTop() - this.offset.relative.top - this.offset.parent.top, t(window).scrollLeft() + t(window).width() - this.helperProportions.width - this.margins.left, t(window).scrollTop() + (t(window).height() || document.body.parentNode.scrollHeight) - this.helperProportions.height - this.margins.top] : this.containment = null
                    },
                    _convertPositionTo: function(e, i) {
                        i || (i = this.position);
                        var s = "absolute" === e ? 1 : -1,
                            n = "absolute" !== this.cssPosition || this.scrollParent[0] !== document && t.contains(this.scrollParent[0], this.offsetParent[0]) ? this.scrollParent : this.offsetParent;
                        return this.offset.scroll || (this.offset.scroll = {
                            top: n.scrollTop(),
                            left: n.scrollLeft()
                        }), {
                            top: i.top + this.offset.relative.top * s + this.offset.parent.top * s - ("fixed" === this.cssPosition ? -this.scrollParent.scrollTop() : this.offset.scroll.top) * s,
                            left: i.left + this.offset.relative.left * s + this.offset.parent.left * s - ("fixed" === this.cssPosition ? -this.scrollParent.scrollLeft() : this.offset.scroll.left) * s
                        }
                    },
                    _generatePosition: function(e) {
                        var i, s, n, o, a = this.options,
                            r = "absolute" !== this.cssPosition || this.scrollParent[0] !== document && t.contains(this.scrollParent[0], this.offsetParent[0]) ? this.scrollParent : this.offsetParent,
                            l = e.pageX,
                            h = e.pageY;
                        return this.offset.scroll || (this.offset.scroll = {
                            top: r.scrollTop(),
                            left: r.scrollLeft()
                        }), this.originalPosition && (this.containment && (this.relative_container ? (s = this.relative_container.offset(), i = [this.containment[0] + s.left, this.containment[1] + s.top, this.containment[2] + s.left, this.containment[3] + s.top]) : i = this.containment, e.pageX - this.offset.click.left < i[0] && (l = i[0] + this.offset.click.left), e.pageY - this.offset.click.top < i[1] && (h = i[1] + this.offset.click.top), e.pageX - this.offset.click.left > i[2] && (l = i[2] + this.offset.click.left), e.pageY - this.offset.click.top > i[3] && (h = i[3] + this.offset.click.top)), a.grid && (n = a.grid[1] ? this.originalPageY + Math.round((h - this.originalPageY) / a.grid[1]) * a.grid[1] : this.originalPageY, h = i ? n - this.offset.click.top >= i[1] || n - this.offset.click.top > i[3] ? n : n - this.offset.click.top >= i[1] ? n - a.grid[1] : n + a.grid[1] : n, o = a.grid[0] ? this.originalPageX + Math.round((l - this.originalPageX) / a.grid[0]) * a.grid[0] : this.originalPageX, l = i ? o - this.offset.click.left >= i[0] || o - this.offset.click.left > i[2] ? o : o - this.offset.click.left >= i[0] ? o - a.grid[0] : o + a.grid[0] : o)), {
                            top: h - this.offset.click.top - this.offset.relative.top - this.offset.parent.top + ("fixed" === this.cssPosition ? -this.scrollParent.scrollTop() : this.offset.scroll.top),
                            left: l - this.offset.click.left - this.offset.relative.left - this.offset.parent.left + ("fixed" === this.cssPosition ? -this.scrollParent.scrollLeft() : this.offset.scroll.left)
                        }
                    },
                    _clear: function() {
                        this.helper.removeClass("ui-draggable-dragging"), this.helper[0] === this.element[0] || this.cancelHelperRemoval || this.helper.remove(), this.helper = null, this.cancelHelperRemoval = !1
                    },
                    _trigger: function(e, i, s) {
                        return s = s || this._uiHash(), t.ui.plugin.call(this, e, [i, s]), "drag" === e && (this.positionAbs = this._convertPositionTo("absolute")), t.Widget.prototype._trigger.call(this, e, i, s)
                    },
                    plugins: {},
                    _uiHash: function() {
                        return {
                            helper: this.helper,
                            position: this.position,
                            originalPosition: this.originalPosition,
                            offset: this.positionAbs
                        }
                    }
                }), t.ui.plugin.add("draggable", "connectToSortable", {
                    start: function(e, i) {
                        var s = t(this).data("ui-draggable"),
                            n = s.options,
                            o = t.extend({}, i, {
                                item: s.element
                            });
                        s.sortables = [], t(n.connectToSortable).each((function() {
                            var i = t.data(this, "ui-sortable");
                            i && !i.options.disabled && (s.sortables.push({
                                instance: i,
                                shouldRevert: i.options.revert
                            }), i.refreshPositions(), i._trigger("activate", e, o))
                        }))
                    },
                    stop: function(e, i) {
                        var s = t(this).data("ui-draggable"),
                            n = t.extend({}, i, {
                                item: s.element
                            });
                        t.each(s.sortables, (function() {
                            this.instance.isOver ? (this.instance.isOver = 0, s.cancelHelperRemoval = !0, this.instance.cancelHelperRemoval = !1, this.shouldRevert && (this.instance.options.revert = this.shouldRevert), this.instance._mouseStop(e), this.instance.options.helper = this.instance.options._helper, "original" === s.options.helper && this.instance.currentItem.css({
                                top: "auto",
                                left: "auto"
                            })) : (this.instance.cancelHelperRemoval = !1, this.instance._trigger("deactivate", e, n))
                        }))
                    },
                    drag: function(e, i) {
                        var s = t(this).data("ui-draggable"),
                            n = this;
                        t.each(s.sortables, (function() {
                            var o = !1,
                                a = this;
                            this.instance.positionAbs = s.positionAbs, this.instance.helperProportions = s.helperProportions, this.instance.offset.click = s.offset.click, this.instance._intersectsWith(this.instance.containerCache) && (o = !0, t.each(s.sortables, (function() {
                                return this.instance.positionAbs = s.positionAbs, this.instance.helperProportions = s.helperProportions, this.instance.offset.click = s.offset.click, this !== a && this.instance._intersectsWith(this.instance.containerCache) && t.contains(a.instance.element[0], this.instance.element[0]) && (o = !1), o
                            }))), o ? (this.instance.isOver || (this.instance.isOver = 1, this.instance.currentItem = t(n).clone().removeAttr("id").appendTo(this.instance.element).data("ui-sortable-item", !0), this.instance.options._helper = this.instance.options.helper, this.instance.options.helper = function() {
                                return i.helper[0]
                            }, e.target = this.instance.currentItem[0], this.instance._mouseCapture(e, !0), this.instance._mouseStart(e, !0, !0), this.instance.offset.click.top = s.offset.click.top, this.instance.offset.click.left = s.offset.click.left, this.instance.offset.parent.left -= s.offset.parent.left - this.instance.offset.parent.left, this.instance.offset.parent.top -= s.offset.parent.top - this.instance.offset.parent.top, s._trigger("toSortable", e), s.dropped = this.instance.element, s.currentItem = s.element, this.instance.fromOutside = s), this.instance.currentItem && this.instance._mouseDrag(e)) : this.instance.isOver && (this.instance.isOver = 0, this.instance.cancelHelperRemoval = !0, this.instance.options.revert = !1, this.instance._trigger("out", e, this.instance._uiHash(this.instance)), this.instance._mouseStop(e, !0), this.instance.options.helper = this.instance.options._helper, this.instance.currentItem.remove(), this.instance.placeholder && this.instance.placeholder.remove(), s._trigger("fromSortable", e), s.dropped = !1)
                        }))
                    }
                }), t.ui.plugin.add("draggable", "cursor", {
                    start: function() {
                        var e = t("body"),
                            i = t(this).data("ui-draggable").options;
                        e.css("cursor") && (i._cursor = e.css("cursor")), e.css("cursor", i.cursor)
                    },
                    stop: function() {
                        var e = t(this).data("ui-draggable").options;
                        e._cursor && t("body").css("cursor", e._cursor)
                    }
                }), t.ui.plugin.add("draggable", "opacity", {
                    start: function(e, i) {
                        var s = t(i.helper),
                            n = t(this).data("ui-draggable").options;
                        s.css("opacity") && (n._opacity = s.css("opacity")), s.css("opacity", n.opacity)
                    },
                    stop: function(e, i) {
                        var s = t(this).data("ui-draggable").options;
                        s._opacity && t(i.helper).css("opacity", s._opacity)
                    }
                }), t.ui.plugin.add("draggable", "scroll", {
                    start: function() {
                        var e = t(this).data("ui-draggable");
                        e.scrollParent[0] !== document && "HTML" !== e.scrollParent[0].tagName && (e.overflowOffset = e.scrollParent.offset())
                    },
                    drag: function(e) {
                        var i = t(this).data("ui-draggable"),
                            s = i.options,
                            n = !1;
                        i.scrollParent[0] !== document && "HTML" !== i.scrollParent[0].tagName ? (s.axis && "x" === s.axis || (i.overflowOffset.top + i.scrollParent[0].offsetHeight - e.pageY < s.scrollSensitivity ? i.scrollParent[0].scrollTop = n = i.scrollParent[0].scrollTop + s.scrollSpeed : e.pageY - i.overflowOffset.top < s.scrollSensitivity && (i.scrollParent[0].scrollTop = n = i.scrollParent[0].scrollTop - s.scrollSpeed)), s.axis && "y" === s.axis || (i.overflowOffset.left + i.scrollParent[0].offsetWidth - e.pageX < s.scrollSensitivity ? i.scrollParent[0].scrollLeft = n = i.scrollParent[0].scrollLeft + s.scrollSpeed : e.pageX - i.overflowOffset.left < s.scrollSensitivity && (i.scrollParent[0].scrollLeft = n = i.scrollParent[0].scrollLeft - s.scrollSpeed))) : (s.axis && "x" === s.axis || (e.pageY - t(document).scrollTop() < s.scrollSensitivity ? n = t(document).scrollTop(t(document).scrollTop() - s.scrollSpeed) : t(window).height() - (e.pageY - t(document).scrollTop()) < s.scrollSensitivity && (n = t(document).scrollTop(t(document).scrollTop() + s.scrollSpeed))), s.axis && "y" === s.axis || (e.pageX - t(document).scrollLeft() < s.scrollSensitivity ? n = t(document).scrollLeft(t(document).scrollLeft() - s.scrollSpeed) : t(window).width() - (e.pageX - t(document).scrollLeft()) < s.scrollSensitivity && (n = t(document).scrollLeft(t(document).scrollLeft() + s.scrollSpeed)))), !1 !== n && t.ui.ddmanager && !s.dropBehaviour && t.ui.ddmanager.prepareOffsets(i, e)
                    }
                }), t.ui.plugin.add("draggable", "snap", {
                    start: function() {
                        var e = t(this).data("ui-draggable"),
                            i = e.options;
                        e.snapElements = [], t(i.snap.constructor !== String ? i.snap.items || ":data(ui-draggable)" : i.snap).each((function() {
                            var i = t(this),
                                s = i.offset();
                            this !== e.element[0] && e.snapElements.push({
                                item: this,
                                width: i.outerWidth(),
                                height: i.outerHeight(),
                                top: s.top,
                                left: s.left
                            })
                        }))
                    },
                    drag: function(e, i) {
                        var s, n, o, a, r, l, h, c, u, d, p = t(this).data("ui-draggable"),
                            f = p.options,
                            m = f.snapTolerance,
                            g = i.offset.left,
                            v = g + p.helperProportions.width,
                            b = i.offset.top,
                            y = b + p.helperProportions.height;
                        for (u = p.snapElements.length - 1; u >= 0; u--) l = (r = p.snapElements[u].left) + p.snapElements[u].width, c = (h = p.snapElements[u].top) + p.snapElements[u].height, v < r - m || g > l + m || y < h - m || b > c + m || !t.contains(p.snapElements[u].item.ownerDocument, p.snapElements[u].item) ? (p.snapElements[u].snapping && p.options.snap.release && p.options.snap.release.call(p.element, e, t.extend(p._uiHash(), {
                            snapItem: p.snapElements[u].item
                        })), p.snapElements[u].snapping = !1) : ("inner" !== f.snapMode && (s = Math.abs(h - y) <= m, n = Math.abs(c - b) <= m, o = Math.abs(r - v) <= m, a = Math.abs(l - g) <= m, s && (i.position.top = p._convertPositionTo("relative", {
                            top: h - p.helperProportions.height,
                            left: 0
                        }).top - p.margins.top), n && (i.position.top = p._convertPositionTo("relative", {
                            top: c,
                            left: 0
                        }).top - p.margins.top), o && (i.position.left = p._convertPositionTo("relative", {
                            top: 0,
                            left: r - p.helperProportions.width
                        }).left - p.margins.left), a && (i.position.left = p._convertPositionTo("relative", {
                            top: 0,
                            left: l
                        }).left - p.margins.left)), d = s || n || o || a, "outer" !== f.snapMode && (s = Math.abs(h - b) <= m, n = Math.abs(c - y) <= m, o = Math.abs(r - g) <= m, a = Math.abs(l - v) <= m, s && (i.position.top = p._convertPositionTo("relative", {
                            top: h,
                            left: 0
                        }).top - p.margins.top), n && (i.position.top = p._convertPositionTo("relative", {
                            top: c - p.helperProportions.height,
                            left: 0
                        }).top - p.margins.top), o && (i.position.left = p._convertPositionTo("relative", {
                            top: 0,
                            left: r
                        }).left - p.margins.left), a && (i.position.left = p._convertPositionTo("relative", {
                            top: 0,
                            left: l - p.helperProportions.width
                        }).left - p.margins.left)), !p.snapElements[u].snapping && (s || n || o || a || d) && p.options.snap.snap && p.options.snap.snap.call(p.element, e, t.extend(p._uiHash(), {
                            snapItem: p.snapElements[u].item
                        })), p.snapElements[u].snapping = s || n || o || a || d)
                    }
                }), t.ui.plugin.add("draggable", "stack", {
                    start: function() {
                        var e, i = this.data("ui-draggable").options,
                            s = t.makeArray(t(i.stack)).sort((function(e, i) {
                                return (parseInt(t(e).css("zIndex"), 10) || 0) - (parseInt(t(i).css("zIndex"), 10) || 0)
                            }));
                        s.length && (e = parseInt(t(s[0]).css("zIndex"), 10) || 0, t(s).each((function(i) {
                            t(this).css("zIndex", e + i)
                        })), this.css("zIndex", e + s.length))
                    }
                }), t.ui.plugin.add("draggable", "zIndex", {
                    start: function(e, i) {
                        var s = t(i.helper),
                            n = t(this).data("ui-draggable").options;
                        s.css("zIndex") && (n._zIndex = s.css("zIndex")), s.css("zIndex", n.zIndex)
                    },
                    stop: function(e, i) {
                        var s = t(this).data("ui-draggable").options;
                        s._zIndex && t(i.helper).css("zIndex", s._zIndex)
                    }
                })
            }(jQuery);
            function(t, e) {
                function i(t, e, i) {
                    return t > e && t < e + i
                }
                t.widget("ui.droppable", {
                    version: "1.10.3",
                    widgetEventPrefix: "drop",
                    options: {
                        accept: "*",
                        activeClass: !1,
                        addClasses: !0,
                        greedy: !1,
                        hoverClass: !1,
                        scope: "default",
                        tolerance: "intersect",
                        activate: null,
                        deactivate: null,
                        drop: null,
                        out: null,
                        over: null
                    },
                    _create: function() {
                        var e = this.options,
                            i = e.accept;
                        this.isover = !1, this.isout = !0, this.accept = t.isFunction(i) ? i : function(t) {
                            return t.is(i)
                        }, this.proportions = {
                            width: this.element[0].offsetWidth,
                            height: this.element[0].offsetHeight
                        }, t.ui.ddmanager.droppables[e.scope] = t.ui.ddmanager.droppables[e.scope] || [], t.ui.ddmanager.droppables[e.scope].push(this), e.addClasses && this.element.addClass("ui-droppable")
                    },
                    _destroy: function() {
                        for (var e = 0, i = t.ui.ddmanager.droppables[this.options.scope]; e < i.length; e++) i[e] === this && i.splice(e, 1);
                        this.element.removeClass("ui-droppable ui-droppable-disabled")
                    },
                    _setOption: function(e, i) {
                        "accept" === e && (this.accept = t.isFunction(i) ? i : function(t) {
                            return t.is(i)
                        }), t.Widget.prototype._setOption.apply(this, arguments)
                    },
                    _activate: function(e) {
                        var i = t.ui.ddmanager.current;
                        this.options.activeClass && this.element.addClass(this.options.activeClass), i && this._trigger("activate", e, this.ui(i))
                    },
                    _deactivate: function(e) {
                        var i = t.ui.ddmanager.current;
                        this.options.activeClass && this.element.removeClass(this.options.activeClass), i && this._trigger("deactivate", e, this.ui(i))
                    },
                    _over: function(e) {
                        var i = t.ui.ddmanager.current;
                        i && (i.currentItem || i.element)[0] !== this.element[0] && this.accept.call(this.element[0], i.currentItem || i.element) && (this.options.hoverClass && this.element.addClass(this.options.hoverClass), this._trigger("over", e, this.ui(i)))
                    },
                    _out: function(e) {
                        var i = t.ui.ddmanager.current;
                        i && (i.currentItem || i.element)[0] !== this.element[0] && this.accept.call(this.element[0], i.currentItem || i.element) && (this.options.hoverClass && this.element.removeClass(this.options.hoverClass), this._trigger("out", e, this.ui(i)))
                    },
                    _drop: function(e, i) {
                        var s = i || t.ui.ddmanager.current,
                            n = !1;
                        return !(!s || (s.currentItem || s.element)[0] === this.element[0]) && (this.element.find(":data(ui-droppable)").not(".ui-draggable-dragging").each((function() {
                            var e = t.data(this, "ui-droppable");
                            if (e.options.greedy && !e.options.disabled && e.options.scope === s.options.scope && e.accept.call(e.element[0], s.currentItem || s.element) && t.ui.intersect(s, t.extend(e, {
                                    offset: e.element.offset()
                                }), e.options.tolerance)) return n = !0, !1
                        })), !n && (!!this.accept.call(this.element[0], s.currentItem || s.element) && (this.options.activeClass && this.element.removeClass(this.options.activeClass), this.options.hoverClass && this.element.removeClass(this.options.hoverClass), this._trigger("drop", e, this.ui(s)), this.element)))
                    },
                    ui: function(t) {
                        return {
                            draggable: t.currentItem || t.element,
                            helper: t.helper,
                            position: t.position,
                            offset: t.positionAbs
                        }
                    }
                }), t.ui.intersect = function(t, e, s) {
                    if (!e.offset) return !1;
                    var n, o = (t.positionAbs || t.position.absolute).left,
                        a = o + t.helperProportions.width,
                        r = (t.positionAbs || t.position.absolute).top,
                        l = r + t.helperProportions.height,
                        h = e.offset.left,
                        c = h + e.proportions.width,
                        u = e.offset.top,
                        d = u + e.proportions.height;
                    switch (s) {
                        case "fit":
                            return h <= o && a <= c && u <= r && l <= d;
                        case "intersect":
                            return h < o + t.helperProportions.width / 2 && a - t.helperProportions.width / 2 < c && u < r + t.helperProportions.height / 2 && l - t.helperProportions.height / 2 < d;
                        case "pointer":
                            return n = (t.positionAbs || t.position.absolute).left + (t.clickOffset || t.offset.click).left, i((t.positionAbs || t.position.absolute).top + (t.clickOffset || t.offset.click).top, u, e.proportions.height) && i(n, h, e.proportions.width);
                        case "touch":
                            return (r >= u && r <= d || l >= u && l <= d || r < u && l > d) && (o >= h && o <= c || a >= h && a <= c || o < h && a > c);
                        default:
                            return !1
                    }
                }, t.ui.ddmanager = {
                    current: null,
                    droppables: {
                        default: []
                    },
                    prepareOffsets: function(e, i) {
                        var s, n, o = t.ui.ddmanager.droppables[e.options.scope] || [],
                            a = i ? i.type : null,
                            r = (e.currentItem || e.element).find(":data(ui-droppable)").addBack();
                        t: for (s = 0; s < o.length; s++)
                            if (!(o[s].options.disabled || e && !o[s].accept.call(o[s].element[0], e.currentItem || e.element))) {
                                for (n = 0; n < r.length; n++)
                                    if (r[n] === o[s].element[0]) {
                                        o[s].proportions.height = 0;
                                        continue t
                                    } o[s].visible = "none" !== o[s].element.css("display"), o[s].visible && ("mousedown" === a && o[s]._activate.call(o[s], i), o[s].offset = o[s].element.offset(), o[s].proportions = {
                                    width: o[s].element[0].offsetWidth,
                                    height: o[s].element[0].offsetHeight
                                })
                            }
                    },
                    drop: function(e, i) {
                        var s = !1;
                        return t.each((t.ui.ddmanager.droppables[e.options.scope] || []).slice(), (function() {
                            this.options && (!this.options.disabled && this.visible && t.ui.intersect(e, this, this.options.tolerance) && (s = this._drop.call(this, i) || s), !this.options.disabled && this.visible && this.accept.call(this.element[0], e.currentItem || e.element) && (this.isout = !0, this.isover = !1, this._deactivate.call(this, i)))
                        })), s
                    },
                    dragStart: function(e, i) {
                        e.element.parentsUntil("body").bind("scroll.droppable", (function() {
                            e.options.refreshPositions || t.ui.ddmanager.prepareOffsets(e, i)
                        }))
                    },
                    drag: function(e, i) {
                        e.options.refreshPositions && t.ui.ddmanager.prepareOffsets(e, i), t.each(t.ui.ddmanager.droppables[e.options.scope] || [], (function() {
                            if (!this.options.disabled && !this.greedyChild && this.visible) {
                                var s, n, o, a = t.ui.intersect(e, this, this.options.tolerance),
                                    r = !a && this.isover ? "isout" : a && !this.isover ? "isover" : null;
                                r && (this.options.greedy && (n = this.options.scope, (o = this.element.parents(":data(ui-droppable)").filter((function() {
                                    return t.data(this, "ui-droppable").options.scope === n
                                }))).length && ((s = t.data(o[0], "ui-droppable")).greedyChild = "isover" === r)), s && "isover" === r && (s.isover = !1, s.isout = !0, s._out.call(s, i)), this[r] = !0, this["isout" === r ? "isover" : "isout"] = !1, this["isover" === r ? "_over" : "_out"].call(this, i), s && "isout" === r && (s.isout = !1, s.isover = !0, s._over.call(s, i)))
                            }
                        }))
                    },
                    dragStop: function(e, i) {
                        e.element.parentsUntil("body").unbind("scroll.droppable"), e.options.refreshPositions || t.ui.ddmanager.prepareOffsets(e, i)
                    }
                }
            }(jQuery);
            function(t, e) {
                function s(t) {
                    return parseInt(t, 10) || 0
                }

                function n(t) {
                    return !isNaN(parseInt(t, 10))
                }
                t.widget("ui.resizable", t.ui.mouse, {
                    version: "1.10.3",
                    widgetEventPrefix: "resize",
                    options: {
                        alsoResize: !1,
                        animate: !1,
                        animateDuration: "slow",
                        animateEasing: "swing",
                        aspectRatio: !1,
                        autoHide: !1,
                        containment: !1,
                        ghost: !1,
                        grid: !1,
                        handles: "e,s,se",
                        helper: !1,
                        maxHeight: null,
                        maxWidth: null,
                        minHeight: 10,
                        minWidth: 10,
                        zIndex: 90,
                        resize: null,
                        start: null,
                        stop: null
                    },
                    _create: function() {
                        var e, i, s, n, o = this,
                            a = this.options;
                        if (this.element.addClass("ui-resizable"), t.extend(this, {
                                _aspectRatio: !!a.aspectRatio,
                                aspectRatio: a.aspectRatio,
                                originalElement: this.element,
                                _proportionallyResizeElements: [],
                                _helper: a.helper || a.ghost || a.animate ? a.helper || "ui-resizable-helper" : null
                            }), this.element[0].nodeName.match(/canvas|textarea|input|select|button|img/i) && (this.element.wrap(t("<div class='ui-wrapper' style='overflow: hidden;'></div>").css({
                                position: this.element.css("position"),
                                width: this.element.outerWidth(),
                                height: this.element.outerHeight(),
                                top: this.element.css("top"),
                                left: this.element.css("left")
                            })), this.element = this.element.parent().data("ui-resizable", this.element.data("ui-resizable")), this.elementIsWrapper = !0, this.element.css({
                                marginLeft: this.originalElement.css("marginLeft"),
                                marginTop: this.originalElement.css("marginTop"),
                                marginRight: this.originalElement.css("marginRight"),
                                marginBottom: this.originalElement.css("marginBottom")
                            }), this.originalElement.css({
                                marginLeft: 0,
                                marginTop: 0,
                                marginRight: 0,
                                marginBottom: 0
                            }), this.originalResizeStyle = this.originalElement.css("resize"), this.originalElement.css("resize", "none"), this._proportionallyResizeElements.push(this.originalElement.css({
                                position: "static",
                                zoom: 1,
                                display: "block"
                            })), this.originalElement.css({
                                margin: this.originalElement.css("margin")
                            }), this._proportionallyResize()), this.handles = a.handles || (t(".ui-resizable-handle", this.element).length ? {
                                n: ".ui-resizable-n",
                                e: ".ui-resizable-e",
                                s: ".ui-resizable-s",
                                w: ".ui-resizable-w",
                                se: ".ui-resizable-se",
                                sw: ".ui-resizable-sw",
                                ne: ".ui-resizable-ne",
                                nw: ".ui-resizable-nw"
                            } : "e,s,se"), this.handles.constructor === String)
                            for ("all" === this.handles && (this.handles = "n,e,s,w,se,sw,ne,nw"), e = this.handles.split(","), this.handles = {}, i = 0; i < e.length; i++) s = t.trim(e[i]), (n = t("<div class='ui-resizable-handle " + ("ui-resizable-" + s) + "'></div>")).css({
                                zIndex: a.zIndex
                            }), "se" === s && n.addClass("ui-icon ui-icon-gripsmall-diagonal-se"), this.handles[s] = ".ui-resizable-" + s, this.element.append(n);
                        this._renderAxis = function(e) {
                            var i, s, n, o;
                            for (i in e = e || this.element, this.handles) this.handles[i].constructor === String && (this.handles[i] = t(this.handles[i], this.element).show()), this.elementIsWrapper && this.originalElement[0].nodeName.match(/textarea|input|select|button/i) && (s = t(this.handles[i], this.element), o = /sw|ne|nw|se|n|s/.test(i) ? s.outerHeight() : s.outerWidth(), n = ["padding", /ne|nw|n/.test(i) ? "Top" : /se|sw|s/.test(i) ? "Bottom" : /^e$/.test(i) ? "Right" : "Left"].join(""), e.css(n, o), this._proportionallyResize()), t(this.handles[i]).length
                        }, this._renderAxis(this.element), this._handles = t(".ui-resizable-handle", this.element).disableSelection(), this._handles.mouseover((function() {
                            o.resizing || (this.className && (n = this.className.match(/ui-resizable-(se|sw|ne|nw|n|e|s|w)/i)), o.axis = n && n[1] ? n[1] : "se")
                        })), a.autoHide && (this._handles.hide(), t(this.element).addClass("ui-resizable-autohide").mouseenter((function() {
                            a.disabled || (t(this).removeClass("ui-resizable-autohide"), o._handles.show())
                        })).mouseleave((function() {
                            a.disabled || o.resizing || (t(this).addClass("ui-resizable-autohide"), o._handles.hide())
                        }))), this._mouseInit()
                    },
                    _destroy: function() {
                        this._mouseDestroy();
                        var e, i = function(e) {
                            t(e).removeClass("ui-resizable ui-resizable-disabled ui-resizable-resizing").removeData("resizable").removeData("ui-resizable").unbind(".resizable").find(".ui-resizable-handle").remove()
                        };
                        return this.elementIsWrapper && (i(this.element), e = this.element, this.originalElement.css({
                            position: e.css("position"),
                            width: e.outerWidth(),
                            height: e.outerHeight(),
                            top: e.css("top"),
                            left: e.css("left")
                        }).insertAfter(e), e.remove()), this.originalElement.css("resize", this.originalResizeStyle), i(this.originalElement), this
                    },
                    _mouseCapture: function(e) {
                        var i, s, n = !1;
                        for (i in this.handles)((s = t(this.handles[i])[0]) === e.target || t.contains(s, e.target)) && (n = !0);
                        return !this.options.disabled && n
                    },
                    _mouseStart: function(e) {
                        var i, n, o, a = this.options,
                            r = this.element.position(),
                            l = this.element;
                        return this.resizing = !0, /absolute/.test(l.css("position")) ? l.css({
                            position: "absolute",
                            top: l.css("top"),
                            left: l.css("left")
                        }) : l.is(".ui-draggable") && l.css({
                            position: "absolute",
                            top: r.top,
                            left: r.left
                        }), this._renderProxy(), i = s(this.helper.css("left")), n = s(this.helper.css("top")), a.containment && (i += t(a.containment).scrollLeft() || 0, n += t(a.containment).scrollTop() || 0), this.offset = this.helper.offset(), this.position = {
                            left: i,
                            top: n
                        }, this.size = this._helper ? {
                            width: l.outerWidth(),
                            height: l.outerHeight()
                        } : {
                            width: l.width(),
                            height: l.height()
                        }, this.originalSize = this._helper ? {
                            width: l.outerWidth(),
                            height: l.outerHeight()
                        } : {
                            width: l.width(),
                            height: l.height()
                        }, this.originalPosition = {
                            left: i,
                            top: n
                        }, this.sizeDiff = {
                            width: l.outerWidth() - l.width(),
                            height: l.outerHeight() - l.height()
                        }, this.originalMousePosition = {
                            left: e.pageX,
                            top: e.pageY
                        }, this.aspectRatio = "number" == typeof a.aspectRatio ? a.aspectRatio : this.originalSize.width / this.originalSize.height || 1, o = t(".ui-resizable-" + this.axis).css("cursor"), t("body").css("cursor", "auto" === o ? this.axis + "-resize" : o), l.addClass("ui-resizable-resizing"), this._propagate("start", e), !0
                    },
                    _mouseDrag: function(e) {
                        var i, s = this.helper,
                            n = {},
                            o = this.originalMousePosition,
                            a = this.axis,
                            r = this.position.top,
                            l = this.position.left,
                            h = this.size.width,
                            c = this.size.height,
                            u = e.pageX - o.left || 0,
                            d = e.pageY - o.top || 0,
                            p = this._change[a];
                        return !!p && (i = p.apply(this, [e, u, d]), this._updateVirtualBoundaries(e.shiftKey), (this._aspectRatio || e.shiftKey) && (i = this._updateRatio(i, e)), i = this._respectSize(i, e), this._updateCache(i), this._propagate("resize", e), this.position.top !== r && (n.top = this.position.top + "px"), this.position.left !== l && (n.left = this.position.left + "px"), this.size.width !== h && (n.width = this.size.width + "px"), this.size.height !== c && (n.height = this.size.height + "px"), s.css(n), !this._helper && this._proportionallyResizeElements.length && this._proportionallyResize(), t.isEmptyObject(n) || this._trigger("resize", e, this.ui()), !1)
                    },
                    _mouseStop: function(e) {
                        this.resizing = !1;
                        var i, s, n, o, a, r, l, h = this.options;
                        return this._helper && (n = (s = (i = this._proportionallyResizeElements).length && /textarea/i.test(i[0].nodeName)) && t.ui.hasScroll(i[0], "left") ? 0 : this.sizeDiff.height, o = s ? 0 : this.sizeDiff.width, a = {
                            width: this.helper.width() - o,
                            height: this.helper.height() - n
                        }, r = parseInt(this.element.css("left"), 10) + (this.position.left - this.originalPosition.left) || null, l = parseInt(this.element.css("top"), 10) + (this.position.top - this.originalPosition.top) || null, h.animate || this.element.css(t.extend(a, {
                            top: l,
                            left: r
                        })), this.helper.height(this.size.height), this.helper.width(this.size.width), this._helper && !h.animate && this._proportionallyResize()), t("body").css("cursor", "auto"), this.element.removeClass("ui-resizable-resizing"), this._propagate("stop", e), this._helper && this.helper.remove(), !1
                    },
                    _updateVirtualBoundaries: function(t) {
                        var e, i, s, o, a, r = this.options;
                        a = {
                            minWidth: n(r.minWidth) ? r.minWidth : 0,
                            maxWidth: n(r.maxWidth) ? r.maxWidth : 1 / 0,
                            minHeight: n(r.minHeight) ? r.minHeight : 0,
                            maxHeight: n(r.maxHeight) ? r.maxHeight : 1 / 0
                        }, (this._aspectRatio || t) && (e = a.minHeight * this.aspectRatio, s = a.minWidth / this.aspectRatio, i = a.maxHeight * this.aspectRatio, o = a.maxWidth / this.aspectRatio, e > a.minWidth && (a.minWidth = e), s > a.minHeight && (a.minHeight = s), i < a.maxWidth && (a.maxWidth = i), o < a.maxHeight && (a.maxHeight = o)), this._vBoundaries = a
                    },
                    _updateCache: function(t) {
                        this.offset = this.helper.offset(), n(t.left) && (this.position.left = t.left), n(t.top) && (this.position.top = t.top), n(t.height) && (this.size.height = t.height), n(t.width) && (this.size.width = t.width)
                    },
                    _updateRatio: function(t) {
                        var e = this.position,
                            i = this.size,
                            s = this.axis;
                        return n(t.height) ? t.width = t.height * this.aspectRatio : n(t.width) && (t.height = t.width / this.aspectRatio), "sw" === s && (t.left = e.left + (i.width - t.width), t.top = null), "nw" === s && (t.top = e.top + (i.height - t.height), t.left = e.left + (i.width - t.width)), t
                    },
                    _respectSize: function(t) {
                        var e = this._vBoundaries,
                            i = this.axis,
                            s = n(t.width) && e.maxWidth && e.maxWidth < t.width,
                            o = n(t.height) && e.maxHeight && e.maxHeight < t.height,
                            a = n(t.width) && e.minWidth && e.minWidth > t.width,
                            r = n(t.height) && e.minHeight && e.minHeight > t.height,
                            l = this.originalPosition.left + this.originalSize.width,
                            h = this.position.top + this.size.height,
                            c = /sw|nw|w/.test(i),
                            u = /nw|ne|n/.test(i);
                        return a && (t.width = e.minWidth), r && (t.height = e.minHeight), s && (t.width = e.maxWidth), o && (t.height = e.maxHeight), a && c && (t.left = l - e.minWidth), s && c && (t.left = l - e.maxWidth), r && u && (t.top = h - e.minHeight), o && u && (t.top = h - e.maxHeight), t.width || t.height || t.left || !t.top ? t.width || t.height || t.top || !t.left || (t.left = null) : t.top = null, t
                    },
                    _proportionallyResize: function() {
                        if (this._proportionallyResizeElements.length) {
                            var t, e, i, s, n, o = this.helper || this.element;
                            for (t = 0; t < this._proportionallyResizeElements.length; t++) {
                                if (n = this._proportionallyResizeElements[t], !this.borderDif)
                                    for (this.borderDif = [], i = [n.css("borderTopWidth"), n.css("borderRightWidth"), n.css("borderBottomWidth"), n.css("borderLeftWidth")], s = [n.css("paddingTop"), n.css("paddingRight"), n.css("paddingBottom"), n.css("paddingLeft")], e = 0; e < i.length; e++) this.borderDif[e] = (parseInt(i[e], 10) || 0) + (parseInt(s[e], 10) || 0);
                                n.css({
                                    height: o.height() - this.borderDif[0] - this.borderDif[2] || 0,
                                    width: o.width() - this.borderDif[1] - this.borderDif[3] || 0
                                })
                            }
                        }
                    },
                    _renderProxy: function() {
                        var e = this.element,
                            i = this.options;
                        this.elementOffset = e.offset(), this._helper ? (this.helper = this.helper || t("<div style='overflow:hidden;'></div>"), this.helper.addClass(this._helper).css({
                            width: this.element.outerWidth() - 1,
                            height: this.element.outerHeight() - 1,
                            position: "absolute",
                            left: this.elementOffset.left + "px",
                            top: this.elementOffset.top + "px",
                            zIndex: ++i.zIndex
                        }), this.helper.appendTo("body").disableSelection()) : this.helper = this.element
                    },
                    _change: {
                        e: function(t, e) {
                            return {
                                width: this.originalSize.width + e
                            }
                        },
                        w: function(t, e) {
                            var i = this.originalSize;
                            return {
                                left: this.originalPosition.left + e,
                                width: i.width - e
                            }
                        },
                        n: function(t, e, i) {
                            var s = this.originalSize;
                            return {
                                top: this.originalPosition.top + i,
                                height: s.height - i
                            }
                        },
                        s: function(t, e, i) {
                            return {
                                height: this.originalSize.height + i
                            }
                        },
                        se: function(e, i, s) {
                            return t.extend(this._change.s.apply(this, arguments), this._change.e.apply(this, [e, i, s]))
                        },
                        sw: function(e, i, s) {
                            return t.extend(this._change.s.apply(this, arguments), this._change.w.apply(this, [e, i, s]))
                        },
                        ne: function(e, i, s) {
                            return t.extend(this._change.n.apply(this, arguments), this._change.e.apply(this, [e, i, s]))
                        },
                        nw: function(e, i, s) {
                            return t.extend(this._change.n.apply(this, arguments), this._change.w.apply(this, [e, i, s]))
                        }
                    },
                    _propagate: function(e, i) {
                        t.ui.plugin.call(this, e, [i, this.ui()]), "resize" !== e && this._trigger(e, i, this.ui())
                    },
                    plugins: {},
                    ui: function() {
                        return {
                            originalElement: this.originalElement,
                            element: this.element,
                            helper: this.helper,
                            position: this.position,
                            size: this.size,
                            originalSize: this.originalSize,
                            originalPosition: this.originalPosition
                        }
                    }
                }), t.ui.plugin.add("resizable", "animate", {
                    stop: function(e) {
                        var i = t(this).data("ui-resizable"),
                            s = i.options,
                            n = i._proportionallyResizeElements,
                            o = n.length && /textarea/i.test(n[0].nodeName),
                            a = o && t.ui.hasScroll(n[0], "left") ? 0 : i.sizeDiff.height,
                            r = o ? 0 : i.sizeDiff.width,
                            l = {
                                width: i.size.width - r,
                                height: i.size.height - a
                            },
                            h = parseInt(i.element.css("left"), 10) + (i.position.left - i.originalPosition.left) || null,
                            c = parseInt(i.element.css("top"), 10) + (i.position.top - i.originalPosition.top) || null;
                        i.element.animate(t.extend(l, c && h ? {
                            top: c,
                            left: h
                        } : {}), {
                            duration: s.animateDuration,
                            easing: s.animateEasing,
                            step: function() {
                                var s = {
                                    width: parseInt(i.element.css("width"), 10),
                                    height: parseInt(i.element.css("height"), 10),
                                    top: parseInt(i.element.css("top"), 10),
                                    left: parseInt(i.element.css("left"), 10)
                                };
                                n && n.length && t(n[0]).css({
                                    width: s.width,
                                    height: s.height
                                }), i._updateCache(s), i._propagate("resize", e)
                            }
                        })
                    }
                }), t.ui.plugin.add("resizable", "containment", {
                    start: function() {
                        var e, i, n, o, a, r, l, h = t(this).data("ui-resizable"),
                            c = h.options,
                            u = h.element,
                            d = c.containment,
                            p = d instanceof t ? d.get(0) : /parent/.test(d) ? u.parent().get(0) : d;
                        p && (h.containerElement = t(p), /document/.test(d) || d === document ? (h.containerOffset = {
                            left: 0,
                            top: 0
                        }, h.containerPosition = {
                            left: 0,
                            top: 0
                        }, h.parentData = {
                            element: t(document),
                            left: 0,
                            top: 0,
                            width: t(document).width(),
                            height: t(document).height() || document.body.parentNode.scrollHeight
                        }) : (e = t(p), i = [], t(["Top", "Right", "Left", "Bottom"]).each((function(t, n) {
                            i[t] = s(e.css("padding" + n))
                        })), h.containerOffset = e.offset(), h.containerPosition = e.position(), h.containerSize = {
                            height: e.innerHeight() - i[3],
                            width: e.innerWidth() - i[1]
                        }, n = h.containerOffset, o = h.containerSize.height, a = h.containerSize.width, r = t.ui.hasScroll(p, "left") ? p.scrollWidth : a, l = t.ui.hasScroll(p) ? p.scrollHeight : o, h.parentData = {
                            element: p,
                            left: n.left,
                            top: n.top,
                            width: r,
                            height: l
                        }))
                    },
                    resize: function(e) {
                        var i, s, n, o, a = t(this).data("ui-resizable"),
                            r = a.options,
                            l = a.containerOffset,
                            h = a.position,
                            c = a._aspectRatio || e.shiftKey,
                            u = {
                                top: 0,
                                left: 0
                            },
                            d = a.containerElement;
                        d[0] !== document && /static/.test(d.css("position")) && (u = l), h.left < (a._helper ? l.left : 0) && (a.size.width = a.size.width + (a._helper ? a.position.left - l.left : a.position.left - u.left), c && (a.size.height = a.size.width / a.aspectRatio), a.position.left = r.helper ? l.left : 0), h.top < (a._helper ? l.top : 0) && (a.size.height = a.size.height + (a._helper ? a.position.top - l.top : a.position.top), c && (a.size.width = a.size.height * a.aspectRatio), a.position.top = a._helper ? l.top : 0), a.offset.left = a.parentData.left + a.position.left, a.offset.top = a.parentData.top + a.position.top, i = Math.abs((a._helper, a.offset.left - u.left + a.sizeDiff.width)), s = Math.abs((a._helper ? a.offset.top - u.top : a.offset.top - l.top) + a.sizeDiff.height), n = a.containerElement.get(0) === a.element.parent().get(0), o = /relative|absolute/.test(a.containerElement.css("position")), n && o && (i -= a.parentData.left), i + a.size.width >= a.parentData.width && (a.size.width = a.parentData.width - i, c && (a.size.height = a.size.width / a.aspectRatio)), s + a.size.height >= a.parentData.height && (a.size.height = a.parentData.height - s, c && (a.size.width = a.size.height * a.aspectRatio))
                    },
                    stop: function() {
                        var e = t(this).data("ui-resizable"),
                            i = e.options,
                            s = e.containerOffset,
                            n = e.containerPosition,
                            o = e.containerElement,
                            a = t(e.helper),
                            r = a.offset(),
                            l = a.outerWidth() - e.sizeDiff.width,
                            h = a.outerHeight() - e.sizeDiff.height;
                        e._helper && !i.animate && /relative/.test(o.css("position")) && t(this).css({
                            left: r.left - n.left - s.left,
                            width: l,
                            height: h
                        }), e._helper && !i.animate && /static/.test(o.css("position")) && t(this).css({
                            left: r.left - n.left - s.left,
                            width: l,
                            height: h
                        })
                    }
                }), t.ui.plugin.add("resizable", "alsoResize", {
                    start: function() {
                        var e = t(this).data("ui-resizable").options,
                            s = function(e) {
                                t(e).each((function() {
                                    var e = t(this);
                                    e.data("ui-resizable-alsoresize", {
                                        width: parseInt(e.width(), 10),
                                        height: parseInt(e.height(), 10),
                                        left: parseInt(e.css("left"), 10),
                                        top: parseInt(e.css("top"), 10)
                                    })
                                }))
                            };
                        "object" !== i(e.alsoResize) || e.alsoResize.parentNode ? s(e.alsoResize) : e.alsoResize.length ? (e.alsoResize = e.alsoResize[0], s(e.alsoResize)) : t.each(e.alsoResize, (function(t) {
                            s(t)
                        }))
                    },
                    resize: function(e, s) {
                        var n = t(this).data("ui-resizable"),
                            o = n.options,
                            a = n.originalSize,
                            r = n.originalPosition,
                            l = {
                                height: n.size.height - a.height || 0,
                                width: n.size.width - a.width || 0,
                                top: n.position.top - r.top || 0,
                                left: n.position.left - r.left || 0
                            },
                            h = function(e, i) {
                                t(e).each((function() {
                                    var e = t(this),
                                        n = t(this).data("ui-resizable-alsoresize"),
                                        o = {},
                                        a = i && i.length ? i : e.parents(s.originalElement[0]).length ? ["width", "height"] : ["width", "height", "top", "left"];
                                    t.each(a, (function(t, e) {
                                        var i = (n[e] || 0) + (l[e] || 0);
                                        i && i >= 0 && (o[e] = i || null)
                                    })), e.css(o)
                                }))
                            };
                        "object" !== i(o.alsoResize) || o.alsoResize.nodeType ? h(o.alsoResize) : t.each(o.alsoResize, (function(t, e) {
                            h(t, e)
                        }))
                    },
                    stop: function() {
                        t(this).removeData("resizable-alsoresize")
                    }
                }), t.ui.plugin.add("resizable", "ghost", {
                    start: function() {
                        var e = t(this).data("ui-resizable"),
                            i = e.options,
                            s = e.size;
                        e.ghost = e.originalElement.clone(), e.ghost.css({
                            opacity: .25,
                            display: "block",
                            position: "relative",
                            height: s.height,
                            width: s.width,
                            margin: 0,
                            left: 0,
                            top: 0
                        }).addClass("ui-resizable-ghost").addClass("string" == typeof i.ghost ? i.ghost : ""), e.ghost.appendTo(e.helper)
                    },
                    resize: function() {
                        var e = t(this).data("ui-resizable");
                        e.ghost && e.ghost.css({
                            position: "relative",
                            height: e.size.height,
                            width: e.size.width
                        })
                    },
                    stop: function() {
                        var e = t(this).data("ui-resizable");
                        e.ghost && e.helper && e.helper.get(0).removeChild(e.ghost.get(0))
                    }
                }), t.ui.plugin.add("resizable", "grid", {
                    resize: function() {
                        var e = t(this).data("ui-resizable"),
                            i = e.options,
                            s = e.size,
                            n = e.originalSize,
                            o = e.originalPosition,
                            a = e.axis,
                            r = "number" == typeof i.grid ? [i.grid, i.grid] : i.grid,
                            l = r[0] || 1,
                            h = r[1] || 1,
                            c = Math.round((s.width - n.width) / l) * l,
                            u = Math.round((s.height - n.height) / h) * h,
                            d = n.width + c,
                            p = n.height + u,
                            f = i.maxWidth && i.maxWidth < d,
                            m = i.maxHeight && i.maxHeight < p,
                            g = i.minWidth && i.minWidth > d,
                            v = i.minHeight && i.minHeight > p;
                        i.grid = r, g && (d += l), v && (p += h), f && (d -= l), m && (p -= h), /^(se|s|e)$/.test(a) ? (e.size.width = d, e.size.height = p) : /^(ne)$/.test(a) ? (e.size.width = d, e.size.height = p, e.position.top = o.top - u) : /^(sw)$/.test(a) ? (e.size.width = d, e.size.height = p, e.position.left = o.left - c) : (e.size.width = d, e.size.height = p, e.position.top = o.top - u, e.position.left = o.left - c)
                    }
                })
            }(jQuery);
            function(t, e) {
                t.widget("ui.selectable", t.ui.mouse, {
                    version: "1.10.3",
                    options: {
                        appendTo: "body",
                        autoRefresh: !0,
                        distance: 0,
                        filter: "*",
                        tolerance: "touch",
                        selected: null,
                        selecting: null,
                        start: null,
                        stop: null,
                        unselected: null,
                        unselecting: null
                    },
                    _create: function() {
                        var e, i = this;
                        this.element.addClass("ui-selectable"), this.dragged = !1, this.refresh = function() {
                            (e = t(i.options.filter, i.element[0])).addClass("ui-selectee"), e.each((function() {
                                var e = t(this),
                                    i = e.offset();
                                t.data(this, "selectable-item", {
                                    element: this,
                                    $element: e,
                                    left: i.left,
                                    top: i.top,
                                    right: i.left + e.outerWidth(),
                                    bottom: i.top + e.outerHeight(),
                                    startselected: !1,
                                    selected: e.hasClass("ui-selected"),
                                    selecting: e.hasClass("ui-selecting"),
                                    unselecting: e.hasClass("ui-unselecting")
                                })
                            }))
                        }, this.refresh(), this.selectees = e.addClass("ui-selectee"), this._mouseInit(), this.helper = t("<div class='ui-selectable-helper'></div>")
                    },
                    _destroy: function() {
                        this.selectees.removeClass("ui-selectee").removeData("selectable-item"), this.element.removeClass("ui-selectable ui-selectable-disabled"), this._mouseDestroy()
                    },
                    _mouseStart: function(e) {
                        var i = this,
                            s = this.options;
                        this.opos = [e.pageX, e.pageY], this.options.disabled || (this.selectees = t(s.filter, this.element[0]), this._trigger("start", e), t(s.appendTo).append(this.helper), this.helper.css({
                            left: e.pageX,
                            top: e.pageY,
                            width: 0,
                            height: 0
                        }), s.autoRefresh && this.refresh(), this.selectees.filter(".ui-selected").each((function() {
                            var s = t.data(this, "selectable-item");
                            s.startselected = !0, e.metaKey || e.ctrlKey || (s.$element.removeClass("ui-selected"), s.selected = !1, s.$element.addClass("ui-unselecting"), s.unselecting = !0, i._trigger("unselecting", e, {
                                unselecting: s.element
                            }))
                        })), t(e.target).parents().addBack().each((function() {
                            var s, n = t.data(this, "selectable-item");
                            if (n) return s = !e.metaKey && !e.ctrlKey || !n.$element.hasClass("ui-selected"), n.$element.removeClass(s ? "ui-unselecting" : "ui-selected").addClass(s ? "ui-selecting" : "ui-unselecting"), n.unselecting = !s, n.selecting = s, n.selected = s, s ? i._trigger("selecting", e, {
                                selecting: n.element
                            }) : i._trigger("unselecting", e, {
                                unselecting: n.element
                            }), !1
                        })))
                    },
                    _mouseDrag: function(e) {
                        if (this.dragged = !0, !this.options.disabled) {
                            var i, s = this,
                                n = this.options,
                                o = this.opos[0],
                                a = this.opos[1],
                                r = e.pageX,
                                l = e.pageY;
                            return o > r && (i = r, r = o, o = i), a > l && (i = l, l = a, a = i), this.helper.css({
                                left: o,
                                top: a,
                                width: r - o,
                                height: l - a
                            }), this.selectees.each((function() {
                                var i = t.data(this, "selectable-item"),
                                    h = !1;
                                i && i.element !== s.element[0] && ("touch" === n.tolerance ? h = !(i.left > r || i.right < o || i.top > l || i.bottom < a) : "fit" === n.tolerance && (h = i.left > o && i.right < r && i.top > a && i.bottom < l), h ? (i.selected && (i.$element.removeClass("ui-selected"), i.selected = !1), i.unselecting && (i.$element.removeClass("ui-unselecting"), i.unselecting = !1), i.selecting || (i.$element.addClass("ui-selecting"), i.selecting = !0, s._trigger("selecting", e, {
                                    selecting: i.element
                                }))) : (i.selecting && ((e.metaKey || e.ctrlKey) && i.startselected ? (i.$element.removeClass("ui-selecting"), i.selecting = !1, i.$element.addClass("ui-selected"), i.selected = !0) : (i.$element.removeClass("ui-selecting"), i.selecting = !1, i.startselected && (i.$element.addClass("ui-unselecting"), i.unselecting = !0), s._trigger("unselecting", e, {
                                    unselecting: i.element
                                }))), i.selected && (e.metaKey || e.ctrlKey || i.startselected || (i.$element.removeClass("ui-selected"), i.selected = !1, i.$element.addClass("ui-unselecting"), i.unselecting = !0, s._trigger("unselecting", e, {
                                    unselecting: i.element
                                })))))
                            })), !1
                        }
                    },
                    _mouseStop: function(e) {
                        var i = this;
                        return this.dragged = !1, t(".ui-unselecting", this.element[0]).each((function() {
                            var s = t.data(this, "selectable-item");
                            s.$element.removeClass("ui-unselecting"), s.unselecting = !1, s.startselected = !1, i._trigger("unselected", e, {
                                unselected: s.element
                            })
                        })), t(".ui-selecting", this.element[0]).each((function() {
                            var s = t.data(this, "selectable-item");
                            s.$element.removeClass("ui-selecting").addClass("ui-selected"), s.selecting = !1, s.selected = !0, s.startselected = !0, i._trigger("selected", e, {
                                selected: s.element
                            })
                        })), this._trigger("stop", e), this.helper.remove(), !1
                    }
                })
            }(jQuery);
            function(t, e) {
                function i(t, e, i) {
                    return t > e && t < e + i
                }

                function s(t) {
                    return /left|right/.test(t.css("float")) || /inline|table-cell/.test(t.css("display"))
                }
                t.widget("ui.sortable", t.ui.mouse, {
                    version: "1.10.3",
                    widgetEventPrefix: "sort",
                    ready: !1,
                    options: {
                        appendTo: "parent",
                        axis: !1,
                        connectWith: !1,
                        containment: !1,
                        cursor: "auto",
                        cursorAt: !1,
                        dropOnEmpty: !0,
                        forcePlaceholderSize: !1,
                        forceHelperSize: !1,
                        grid: !1,
                        handle: !1,
                        helper: "original",
                        items: "> *",
                        opacity: !1,
                        placeholder: !1,
                        revert: !1,
                        scroll: !0,
                        scrollSensitivity: 20,
                        scrollSpeed: 20,
                        scope: "default",
                        tolerance: "intersect",
                        zIndex: 1e3,
                        activate: null,
                        beforeStop: null,
                        change: null,
                        deactivate: null,
                        out: null,
                        over: null,
                        receive: null,
                        remove: null,
                        sort: null,
                        start: null,
                        stop: null,
                        update: null
                    },
                    _create: function() {
                        var t = this.options;
                        this.containerCache = {}, this.element.addClass("ui-sortable"), this.refresh(), this.floating = !!this.items.length && ("x" === t.axis || s(this.items[0].item)), this.offset = this.element.offset(), this._mouseInit(), this.ready = !0
                    },
                    _destroy: function() {
                        this.element.removeClass("ui-sortable ui-sortable-disabled"), this._mouseDestroy();
                        for (var t = this.items.length - 1; t >= 0; t--) this.items[t].item.removeData(this.widgetName + "-item");
                        return this
                    },
                    _setOption: function(e, i) {
                        "disabled" === e ? (this.options[e] = i, this.widget().toggleClass("ui-sortable-disabled", !!i)) : t.Widget.prototype._setOption.apply(this, arguments)
                    },
                    _mouseCapture: function(e, i) {
                        var s = null,
                            n = !1,
                            o = this;
                        return !this.reverting && (!this.options.disabled && "static" !== this.options.type && (this._refreshItems(e), t(e.target).parents().each((function() {
                            if (t.data(this, o.widgetName + "-item") === o) return s = t(this), !1
                        })), t.data(e.target, o.widgetName + "-item") === o && (s = t(e.target)), !!s && (!(this.options.handle && !i && (t(this.options.handle, s).find("*").addBack().each((function() {
                            this === e.target && (n = !0)
                        })), !n)) && (this.currentItem = s, this._removeCurrentsFromItems(), !0))))
                    },
                    _mouseStart: function(e, i, s) {
                        var n, o, a = this.options;
                        if (this.currentContainer = this, this.refreshPositions(), this.helper = this._createHelper(e), this._cacheHelperProportions(), this._cacheMargins(), this.scrollParent = this.helper.scrollParent(), this.offset = this.currentItem.offset(), this.offset = {
                                top: this.offset.top - this.margins.top,
                                left: this.offset.left - this.margins.left
                            }, t.extend(this.offset, {
                                click: {
                                    left: e.pageX - this.offset.left,
                                    top: e.pageY - this.offset.top
                                },
                                parent: this._getParentOffset(),
                                relative: this._getRelativeOffset()
                            }), this.helper.css("position", "absolute"), this.cssPosition = this.helper.css("position"), this.originalPosition = this._generatePosition(e), this.originalPageX = e.pageX, this.originalPageY = e.pageY, a.cursorAt && this._adjustOffsetFromHelper(a.cursorAt), this.domPosition = {
                                prev: this.currentItem.prev()[0],
                                parent: this.currentItem.parent()[0]
                            }, this.helper[0] !== this.currentItem[0] && this.currentItem.hide(), this._createPlaceholder(), a.containment && this._setContainment(), a.cursor && "auto" !== a.cursor && (o = this.document.find("body"), this.storedCursor = o.css("cursor"), o.css("cursor", a.cursor), this.storedStylesheet = t("<style>*{ cursor: " + a.cursor + " !important; }</style>").appendTo(o)), a.opacity && (this.helper.css("opacity") && (this._storedOpacity = this.helper.css("opacity")), this.helper.css("opacity", a.opacity)), a.zIndex && (this.helper.css("zIndex") && (this._storedZIndex = this.helper.css("zIndex")), this.helper.css("zIndex", a.zIndex)), this.scrollParent[0] !== document && "HTML" !== this.scrollParent[0].tagName && (this.overflowOffset = this.scrollParent.offset()), this._trigger("start", e, this._uiHash()), this._preserveHelperProportions || this._cacheHelperProportions(), !s)
                            for (n = this.containers.length - 1; n >= 0; n--) this.containers[n]._trigger("activate", e, this._uiHash(this));
                        return t.ui.ddmanager && (t.ui.ddmanager.current = this), t.ui.ddmanager && !a.dropBehaviour && t.ui.ddmanager.prepareOffsets(this, e), this.dragging = !0, this.helper.addClass("ui-sortable-helper"), this._mouseDrag(e), !0
                    },
                    _mouseDrag: function(e) {
                        var i, s, n, o, a = this.options,
                            r = !1;
                        for (this.position = this._generatePosition(e), this.positionAbs = this._convertPositionTo("absolute"), this.lastPositionAbs || (this.lastPositionAbs = this.positionAbs), this.options.scroll && (this.scrollParent[0] !== document && "HTML" !== this.scrollParent[0].tagName ? (this.overflowOffset.top + this.scrollParent[0].offsetHeight - e.pageY < a.scrollSensitivity ? this.scrollParent[0].scrollTop = r = this.scrollParent[0].scrollTop + a.scrollSpeed : e.pageY - this.overflowOffset.top < a.scrollSensitivity && (this.scrollParent[0].scrollTop = r = this.scrollParent[0].scrollTop - a.scrollSpeed), this.overflowOffset.left + this.scrollParent[0].offsetWidth - e.pageX < a.scrollSensitivity ? this.scrollParent[0].scrollLeft = r = this.scrollParent[0].scrollLeft + a.scrollSpeed : e.pageX - this.overflowOffset.left < a.scrollSensitivity && (this.scrollParent[0].scrollLeft = r = this.scrollParent[0].scrollLeft - a.scrollSpeed)) : (e.pageY - t(document).scrollTop() < a.scrollSensitivity ? r = t(document).scrollTop(t(document).scrollTop() - a.scrollSpeed) : t(window).height() - (e.pageY - t(document).scrollTop()) < a.scrollSensitivity && (r = t(document).scrollTop(t(document).scrollTop() + a.scrollSpeed)), e.pageX - t(document).scrollLeft() < a.scrollSensitivity ? r = t(document).scrollLeft(t(document).scrollLeft() - a.scrollSpeed) : t(window).width() - (e.pageX - t(document).scrollLeft()) < a.scrollSensitivity && (r = t(document).scrollLeft(t(document).scrollLeft() + a.scrollSpeed))), !1 !== r && t.ui.ddmanager && !a.dropBehaviour && t.ui.ddmanager.prepareOffsets(this, e)), this.positionAbs = this._convertPositionTo("absolute"), this.options.axis && "y" === this.options.axis || (this.helper[0].style.left = this.position.left + "px"), this.options.axis && "x" === this.options.axis || (this.helper[0].style.top = this.position.top + "px"), i = this.items.length - 1; i >= 0; i--)
                            if (n = (s = this.items[i]).item[0], (o = this._intersectsWithPointer(s)) && s.instance === this.currentContainer && !(n === this.currentItem[0] || this.placeholder[1 === o ? "next" : "prev"]()[0] === n || t.contains(this.placeholder[0], n) || "semi-dynamic" === this.options.type && t.contains(this.element[0], n))) {
                                if (this.direction = 1 === o ? "down" : "up", "pointer" !== this.options.tolerance && !this._intersectsWithSides(s)) break;
                                this._rearrange(e, s), this._trigger("change", e, this._uiHash());
                                break
                            } return this._contactContainers(e), t.ui.ddmanager && t.ui.ddmanager.drag(this, e), this._trigger("sort", e, this._uiHash()), this.lastPositionAbs = this.positionAbs, !1
                    },
                    _mouseStop: function(e, i) {
                        if (e) {
                            if (t.ui.ddmanager && !this.options.dropBehaviour && t.ui.ddmanager.drop(this, e), this.options.revert) {
                                var s = this,
                                    n = this.placeholder.offset(),
                                    o = this.options.axis,
                                    a = {};
                                o && "x" !== o || (a.left = n.left - this.offset.parent.left - this.margins.left + (this.offsetParent[0] === document.body ? 0 : this.offsetParent[0].scrollLeft)), o && "y" !== o || (a.top = n.top - this.offset.parent.top - this.margins.top + (this.offsetParent[0] === document.body ? 0 : this.offsetParent[0].scrollTop)), this.reverting = !0, t(this.helper).animate(a, parseInt(this.options.revert, 10) || 500, (function() {
                                    s._clear(e)
                                }))
                            } else this._clear(e, i);
                            return !1
                        }
                    },
                    cancel: function() {
                        if (this.dragging) {
                            this._mouseUp({
                                target: null
                            }), "original" === this.options.helper ? this.currentItem.css(this._storedCSS).removeClass("ui-sortable-helper") : this.currentItem.show();
                            for (var e = this.containers.length - 1; e >= 0; e--) this.containers[e]._trigger("deactivate", null, this._uiHash(this)), this.containers[e].containerCache.over && (this.containers[e]._trigger("out", null, this._uiHash(this)), this.containers[e].containerCache.over = 0)
                        }
                        return this.placeholder && (this.placeholder[0].parentNode && this.placeholder[0].parentNode.removeChild(this.placeholder[0]), "original" !== this.options.helper && this.helper && this.helper[0].parentNode && this.helper.remove(), t.extend(this, {
                            helper: null,
                            dragging: !1,
                            reverting: !1,
                            _noFinalSort: null
                        }), this.domPosition.prev ? t(this.domPosition.prev).after(this.currentItem) : t(this.domPosition.parent).prepend(this.currentItem)), this
                    },
                    serialize: function(e) {
                        var i = this._getItemsAsjQuery(e && e.connected),
                            s = [];
                        return e = e || {}, t(i).each((function() {
                            var i = (t(e.item || this).attr(e.attribute || "id") || "").match(e.expression || /(.+)[\-=_](.+)/);
                            i && s.push((e.key || i[1] + "[]") + "=" + (e.key && e.expression ? i[1] : i[2]))
                        })), !s.length && e.key && s.push(e.key + "="), s.join("&")
                    },
                    toArray: function(e) {
                        var i = this._getItemsAsjQuery(e && e.connected),
                            s = [];
                        return e = e || {}, i.each((function() {
                            s.push(t(e.item || this).attr(e.attribute || "id") || "")
                        })), s
                    },
                    _intersectsWith: function(t) {
                        var e = this.positionAbs.left,
                            i = e + this.helperProportions.width,
                            s = this.positionAbs.top,
                            n = s + this.helperProportions.height,
                            o = t.left,
                            a = o + t.width,
                            r = t.top,
                            l = r + t.height,
                            h = this.offset.click.top,
                            c = this.offset.click.left,
                            u = "x" === this.options.axis || s + h > r && s + h < l,
                            d = "y" === this.options.axis || e + c > o && e + c < a,
                            p = u && d;
                        return "pointer" === this.options.tolerance || this.options.forcePointerForContainers || "pointer" !== this.options.tolerance && this.helperProportions[this.floating ? "width" : "height"] > t[this.floating ? "width" : "height"] ? p : o < e + this.helperProportions.width / 2 && i - this.helperProportions.width / 2 < a && r < s + this.helperProportions.height / 2 && n - this.helperProportions.height / 2 < l
                    },
                    _intersectsWithPointer: function(t) {
                        var e = "x" === this.options.axis || i(this.positionAbs.top + this.offset.click.top, t.top, t.height),
                            s = "y" === this.options.axis || i(this.positionAbs.left + this.offset.click.left, t.left, t.width),
                            n = e && s,
                            o = this._getDragVerticalDirection(),
                            a = this._getDragHorizontalDirection();
                        return !!n && (this.floating ? a && "right" === a || "down" === o ? 2 : 1 : o && ("down" === o ? 2 : 1))
                    },
                    _intersectsWithSides: function(t) {
                        var e = i(this.positionAbs.top + this.offset.click.top, t.top + t.height / 2, t.height),
                            s = i(this.positionAbs.left + this.offset.click.left, t.left + t.width / 2, t.width),
                            n = this._getDragVerticalDirection(),
                            o = this._getDragHorizontalDirection();
                        return this.floating && o ? "right" === o && s || "left" === o && !s : n && ("down" === n && e || "up" === n && !e)
                    },
                    _getDragVerticalDirection: function() {
                        var t = this.positionAbs.top - this.lastPositionAbs.top;
                        return 0 !== t && (t > 0 ? "down" : "up")
                    },
                    _getDragHorizontalDirection: function() {
                        var t = this.positionAbs.left - this.lastPositionAbs.left;
                        return 0 !== t && (t > 0 ? "right" : "left")
                    },
                    refresh: function(t) {
                        return this._refreshItems(t), this.refreshPositions(), this
                    },
                    _connectWith: function() {
                        var t = this.options;
                        return t.connectWith.constructor === String ? [t.connectWith] : t.connectWith
                    },
                    _getItemsAsjQuery: function(e) {
                        var i, s, n, o, a = [],
                            r = [],
                            l = this._connectWith();
                        if (l && e)
                            for (i = l.length - 1; i >= 0; i--)
                                for (s = (n = t(l[i])).length - 1; s >= 0; s--)(o = t.data(n[s], this.widgetFullName)) && o !== this && !o.options.disabled && r.push([t.isFunction(o.options.items) ? o.options.items.call(o.element) : t(o.options.items, o.element).not(".ui-sortable-helper").not(".ui-sortable-placeholder"), o]);
                        for (r.push([t.isFunction(this.options.items) ? this.options.items.call(this.element, null, {
                                options: this.options,
                                item: this.currentItem
                            }) : t(this.options.items, this.element).not(".ui-sortable-helper").not(".ui-sortable-placeholder"), this]), i = r.length - 1; i >= 0; i--) r[i][0].each((function() {
                            a.push(this)
                        }));
                        return t(a)
                    },
                    _removeCurrentsFromItems: function() {
                        var e = this.currentItem.find(":data(" + this.widgetName + "-item)");
                        this.items = t.grep(this.items, (function(t) {
                            for (var i = 0; i < e.length; i++)
                                if (e[i] === t.item[0]) return !1;
                            return !0
                        }))
                    },
                    _refreshItems: function(e) {
                        this.items = [], this.containers = [this];
                        var i, s, n, o, a, r, l, h, c = this.items,
                            u = [
                                [t.isFunction(this.options.items) ? this.options.items.call(this.element[0], e, {
                                    item: this.currentItem
                                }) : t(this.options.items, this.element), this]
                            ],
                            d = this._connectWith();
                        if (d && this.ready)
                            for (i = d.length - 1; i >= 0; i--)
                                for (s = (n = t(d[i])).length - 1; s >= 0; s--)(o = t.data(n[s], this.widgetFullName)) && o !== this && !o.options.disabled && (u.push([t.isFunction(o.options.items) ? o.options.items.call(o.element[0], e, {
                                    item: this.currentItem
                                }) : t(o.options.items, o.element), o]), this.containers.push(o));
                        for (i = u.length - 1; i >= 0; i--)
                            for (a = u[i][1], s = 0, h = (r = u[i][0]).length; s < h; s++)(l = t(r[s])).data(this.widgetName + "-item", a), c.push({
                                item: l,
                                instance: a,
                                width: 0,
                                height: 0,
                                left: 0,
                                top: 0
                            })
                    },
                    refreshPositions: function(e) {
                        var i, s, n, o;
                        for (this.offsetParent && this.helper && (this.offset.parent = this._getParentOffset()), i = this.items.length - 1; i >= 0; i--)(s = this.items[i]).instance !== this.currentContainer && this.currentContainer && s.item[0] !== this.currentItem[0] || (n = this.options.toleranceElement ? t(this.options.toleranceElement, s.item) : s.item, e || (s.width = n.outerWidth(), s.height = n.outerHeight()), o = n.offset(), s.left = o.left, s.top = o.top);
                        if (this.options.custom && this.options.custom.refreshContainers) this.options.custom.refreshContainers.call(this);
                        else
                            for (i = this.containers.length - 1; i >= 0; i--) o = this.containers[i].element.offset(), this.containers[i].containerCache.left = o.left, this.containers[i].containerCache.top = o.top, this.containers[i].containerCache.width = this.containers[i].element.outerWidth(), this.containers[i].containerCache.height = this.containers[i].element.outerHeight();
                        return this
                    },
                    _createPlaceholder: function(e) {
                        var i, s = (e = e || this).options;
                        s.placeholder && s.placeholder.constructor !== String || (i = s.placeholder, s.placeholder = {
                            element: function() {
                                var s = e.currentItem[0].nodeName.toLowerCase(),
                                    n = t("<" + s + ">", e.document[0]).addClass(i || e.currentItem[0].className + " ui-sortable-placeholder").removeClass("ui-sortable-helper");
                                return "tr" === s ? e.currentItem.children().each((function() {
                                    t("<td>&#160;</td>", e.document[0]).attr("colspan", t(this).attr("colspan") || 1).appendTo(n)
                                })) : "img" === s && n.attr("src", e.currentItem.attr("src")), i || n.css("visibility", "hidden"), n
                            },
                            update: function(t, n) {
                                i && !s.forcePlaceholderSize || (n.height() || n.height(e.currentItem.innerHeight() - parseInt(e.currentItem.css("paddingTop") || 0, 10) - parseInt(e.currentItem.css("paddingBottom") || 0, 10)), n.width() || n.width(e.currentItem.innerWidth() - parseInt(e.currentItem.css("paddingLeft") || 0, 10) - parseInt(e.currentItem.css("paddingRight") || 0, 10)))
                            }
                        }), e.placeholder = t(s.placeholder.element.call(e.element, e.currentItem)), e.currentItem.after(e.placeholder), s.placeholder.update(e, e.placeholder)
                    },
                    _contactContainers: function(e) {
                        var n, o, a, r, l, h, c, u, d, p, f = null,
                            m = null;
                        for (n = this.containers.length - 1; n >= 0; n--)
                            if (!t.contains(this.currentItem[0], this.containers[n].element[0]))
                                if (this._intersectsWith(this.containers[n].containerCache)) {
                                    if (f && t.contains(this.containers[n].element[0], f.element[0])) continue;
                                    f = this.containers[n], m = n
                                } else this.containers[n].containerCache.over && (this.containers[n]._trigger("out", e, this._uiHash(this)), this.containers[n].containerCache.over = 0);
                        if (f)
                            if (1 === this.containers.length) this.containers[m].containerCache.over || (this.containers[m]._trigger("over", e, this._uiHash(this)), this.containers[m].containerCache.over = 1);
                            else {
                                for (a = 1e4, r = null, l = (p = f.floating || s(this.currentItem)) ? "left" : "top", h = p ? "width" : "height", c = this.positionAbs[l] + this.offset.click[l], o = this.items.length - 1; o >= 0; o--) t.contains(this.containers[m].element[0], this.items[o].item[0]) && this.items[o].item[0] !== this.currentItem[0] && (p && !i(this.positionAbs.top + this.offset.click.top, this.items[o].top, this.items[o].height) || (u = this.items[o].item.offset()[l], d = !1, Math.abs(u - c) > Math.abs(u + this.items[o][h] - c) && (d = !0, u += this.items[o][h]), Math.abs(u - c) < a && (a = Math.abs(u - c), r = this.items[o], this.direction = d ? "up" : "down")));
                                if (!r && !this.options.dropOnEmpty) return;
                                if (this.currentContainer === this.containers[m]) return;
                                r ? this._rearrange(e, r, null, !0) : this._rearrange(e, null, this.containers[m].element, !0), this._trigger("change", e, this._uiHash()), this.containers[m]._trigger("change", e, this._uiHash(this)), this.currentContainer = this.containers[m], this.options.placeholder.update(this.currentContainer, this.placeholder), this.containers[m]._trigger("over", e, this._uiHash(this)), this.containers[m].containerCache.over = 1
                            }
                    },
                    _createHelper: function(e) {
                        var i = this.options,
                            s = t.isFunction(i.helper) ? t(i.helper.apply(this.element[0], [e, this.currentItem])) : "clone" === i.helper ? this.currentItem.clone() : this.currentItem;
                        return s.parents("body").length || t("parent" !== i.appendTo ? i.appendTo : this.currentItem[0].parentNode)[0].appendChild(s[0]), s[0] === this.currentItem[0] && (this._storedCSS = {
                            width: this.currentItem[0].style.width,
                            height: this.currentItem[0].style.height,
                            position: this.currentItem.css("position"),
                            top: this.currentItem.css("top"),
                            left: this.currentItem.css("left")
                        }), s[0].style.width && !i.forceHelperSize || s.width(this.currentItem.width()), s[0].style.height && !i.forceHelperSize || s.height(this.currentItem.height()), s
                    },
                    _adjustOffsetFromHelper: function(e) {
                        "string" == typeof e && (e = e.split(" ")), t.isArray(e) && (e = {
                            left: +e[0],
                            top: +e[1] || 0
                        }), "left" in e && (this.offset.click.left = e.left + this.margins.left), "right" in e && (this.offset.click.left = this.helperProportions.width - e.right + this.margins.left), "top" in e && (this.offset.click.top = e.top + this.margins.top), "bottom" in e && (this.offset.click.top = this.helperProportions.height - e.bottom + this.margins.top)
                    },
                    _getParentOffset: function() {
                        this.offsetParent = this.helper.offsetParent();
                        var e = this.offsetParent.offset();
                        return "absolute" === this.cssPosition && this.scrollParent[0] !== document && t.contains(this.scrollParent[0], this.offsetParent[0]) && (e.left += this.scrollParent.scrollLeft(), e.top += this.scrollParent.scrollTop()), (this.offsetParent[0] === document.body || this.offsetParent[0].tagName && "html" === this.offsetParent[0].tagName.toLowerCase() && t.ui.ie) && (e = {
                            top: 0,
                            left: 0
                        }), {
                            top: e.top + (parseInt(this.offsetParent.css("borderTopWidth"), 10) || 0),
                            left: e.left + (parseInt(this.offsetParent.css("borderLeftWidth"), 10) || 0)
                        }
                    },
                    _getRelativeOffset: function() {
                        if ("relative" === this.cssPosition) {
                            var t = this.currentItem.position();
                            return {
                                top: t.top - (parseInt(this.helper.css("top"), 10) || 0) + this.scrollParent.scrollTop(),
                                left: t.left - (parseInt(this.helper.css("left"), 10) || 0) + this.scrollParent.scrollLeft()
                            }
                        }
                        return {
                            top: 0,
                            left: 0
                        }
                    },
                    _cacheMargins: function() {
                        this.margins = {
                            left: parseInt(this.currentItem.css("marginLeft"), 10) || 0,
                            top: parseInt(this.currentItem.css("marginTop"), 10) || 0
                        }
                    },
                    _cacheHelperProportions: function() {
                        this.helperProportions = {
                            width: this.helper.outerWidth(),
                            height: this.helper.outerHeight()
                        }
                    },
                    _setContainment: function() {
                        var e, i, s, n = this.options;
                        "parent" === n.containment && (n.containment = this.helper[0].parentNode), "document" !== n.containment && "window" !== n.containment || (this.containment = [0 - this.offset.relative.left - this.offset.parent.left, 0 - this.offset.relative.top - this.offset.parent.top, t("document" === n.containment ? document : window).width() - this.helperProportions.width - this.margins.left, (t("document" === n.containment ? document : window).height() || document.body.parentNode.scrollHeight) - this.helperProportions.height - this.margins.top]), /^(document|window|parent)$/.test(n.containment) || (e = t(n.containment)[0], i = t(n.containment).offset(), s = "hidden" !== t(e).css("overflow"), this.containment = [i.left + (parseInt(t(e).css("borderLeftWidth"), 10) || 0) + (parseInt(t(e).css("paddingLeft"), 10) || 0) - this.margins.left, i.top + (parseInt(t(e).css("borderTopWidth"), 10) || 0) + (parseInt(t(e).css("paddingTop"), 10) || 0) - this.margins.top, i.left + (s ? Math.max(e.scrollWidth, e.offsetWidth) : e.offsetWidth) - (parseInt(t(e).css("borderLeftWidth"), 10) || 0) - (parseInt(t(e).css("paddingRight"), 10) || 0) - this.helperProportions.width - this.margins.left, i.top + (s ? Math.max(e.scrollHeight, e.offsetHeight) : e.offsetHeight) - (parseInt(t(e).css("borderTopWidth"), 10) || 0) - (parseInt(t(e).css("paddingBottom"), 10) || 0) - this.helperProportions.height - this.margins.top])
                    },
                    _convertPositionTo: function(e, i) {
                        i || (i = this.position);
                        var s = "absolute" === e ? 1 : -1,
                            n = "absolute" !== this.cssPosition || this.scrollParent[0] !== document && t.contains(this.scrollParent[0], this.offsetParent[0]) ? this.scrollParent : this.offsetParent,
                            o = /(html|body)/i.test(n[0].tagName);
                        return {
                            top: i.top + this.offset.relative.top * s + this.offset.parent.top * s - ("fixed" === this.cssPosition ? -this.scrollParent.scrollTop() : o ? 0 : n.scrollTop()) * s,
                            left: i.left + this.offset.relative.left * s + this.offset.parent.left * s - ("fixed" === this.cssPosition ? -this.scrollParent.scrollLeft() : o ? 0 : n.scrollLeft()) * s
                        }
                    },
                    _generatePosition: function(e) {
                        var i, s, n = this.options,
                            o = e.pageX,
                            a = e.pageY,
                            r = "absolute" !== this.cssPosition || this.scrollParent[0] !== document && t.contains(this.scrollParent[0], this.offsetParent[0]) ? this.scrollParent : this.offsetParent,
                            l = /(html|body)/i.test(r[0].tagName);
                        return "relative" !== this.cssPosition || this.scrollParent[0] !== document && this.scrollParent[0] !== this.offsetParent[0] || (this.offset.relative = this._getRelativeOffset()), this.originalPosition && (this.containment && (e.pageX - this.offset.click.left < this.containment[0] && (o = this.containment[0] + this.offset.click.left), e.pageY - this.offset.click.top < this.containment[1] && (a = this.containment[1] + this.offset.click.top), e.pageX - this.offset.click.left > this.containment[2] && (o = this.containment[2] + this.offset.click.left), e.pageY - this.offset.click.top > this.containment[3] && (a = this.containment[3] + this.offset.click.top)), n.grid && (i = this.originalPageY + Math.round((a - this.originalPageY) / n.grid[1]) * n.grid[1], a = this.containment ? i - this.offset.click.top >= this.containment[1] && i - this.offset.click.top <= this.containment[3] ? i : i - this.offset.click.top >= this.containment[1] ? i - n.grid[1] : i + n.grid[1] : i, s = this.originalPageX + Math.round((o - this.originalPageX) / n.grid[0]) * n.grid[0], o = this.containment ? s - this.offset.click.left >= this.containment[0] && s - this.offset.click.left <= this.containment[2] ? s : s - this.offset.click.left >= this.containment[0] ? s - n.grid[0] : s + n.grid[0] : s)), {
                            top: a - this.offset.click.top - this.offset.relative.top - this.offset.parent.top + ("fixed" === this.cssPosition ? -this.scrollParent.scrollTop() : l ? 0 : r.scrollTop()),
                            left: o - this.offset.click.left - this.offset.relative.left - this.offset.parent.left + ("fixed" === this.cssPosition ? -this.scrollParent.scrollLeft() : l ? 0 : r.scrollLeft())
                        }
                    },
                    _rearrange: function(t, e, i, s) {
                        i ? i[0].appendChild(this.placeholder[0]) : e.item[0].parentNode.insertBefore(this.placeholder[0], "down" === this.direction ? e.item[0] : e.item[0].nextSibling), this.counter = this.counter ? ++this.counter : 1;
                        var n = this.counter;
                        this._delay((function() {
                            n === this.counter && this.refreshPositions(!s)
                        }))
                    },
                    _clear: function(t, e) {
                        this.reverting = !1;
                        var i, s = [];
                        if (!this._noFinalSort && this.currentItem.parent().length && this.placeholder.before(this.currentItem), this._noFinalSort = null, this.helper[0] === this.currentItem[0]) {
                            for (i in this._storedCSS) "auto" !== this._storedCSS[i] && "static" !== this._storedCSS[i] || (this._storedCSS[i] = "");
                            this.currentItem.css(this._storedCSS).removeClass("ui-sortable-helper")
                        } else this.currentItem.show();
                        for (this.fromOutside && !e && s.push((function(t) {
                                this._trigger("receive", t, this._uiHash(this.fromOutside))
                            })), !this.fromOutside && this.domPosition.prev === this.currentItem.prev().not(".ui-sortable-helper")[0] && this.domPosition.parent === this.currentItem.parent()[0] || e || s.push((function(t) {
                                this._trigger("update", t, this._uiHash())
                            })), this !== this.currentContainer && (e || (s.push((function(t) {
                                this._trigger("remove", t, this._uiHash())
                            })), s.push(function(t) {
                                return function(e) {
                                    t._trigger("receive", e, this._uiHash(this))
                                }
                            }.call(this, this.currentContainer)), s.push(function(t) {
                                return function(e) {
                                    t._trigger("update", e, this._uiHash(this))
                                }
                            }.call(this, this.currentContainer)))), i = this.containers.length - 1; i >= 0; i--) e || s.push(function(t) {
                            return function(e) {
                                t._trigger("deactivate", e, this._uiHash(this))
                            }
                        }.call(this, this.containers[i])), this.containers[i].containerCache.over && (s.push(function(t) {
                            return function(e) {
                                t._trigger("out", e, this._uiHash(this))
                            }
                        }.call(this, this.containers[i])), this.containers[i].containerCache.over = 0);
                        if (this.storedCursor && (this.document.find("body").css("cursor", this.storedCursor), this.storedStylesheet.remove()), this._storedOpacity && this.helper.css("opacity", this._storedOpacity), this._storedZIndex && this.helper.css("zIndex", "auto" === this._storedZIndex ? "" : this._storedZIndex), this.dragging = !1, this.cancelHelperRemoval) {
                            if (!e) {
                                for (this._trigger("beforeStop", t, this._uiHash()), i = 0; i < s.length; i++) s[i].call(this, t);
                                this._trigger("stop", t, this._uiHash())
                            }
                            return this.fromOutside = !1, !1
                        }
                        if (e || this._trigger("beforeStop", t, this._uiHash()), this.placeholder[0].parentNode.removeChild(this.placeholder[0]), this.helper[0] !== this.currentItem[0] && this.helper.remove(), this.helper = null, !e) {
                            for (i = 0; i < s.length; i++) s[i].call(this, t);
                            this._trigger("stop", t, this._uiHash())
                        }
                        return this.fromOutside = !1, !0
                    },
                    _trigger: function() {
                        !1 === t.Widget.prototype._trigger.apply(this, arguments) && this.cancel()
                    },
                    _uiHash: function(e) {
                        var i = e || this;
                        return {
                            helper: i.helper,
                            placeholder: i.placeholder || t([]),
                            position: i.position,
                            originalPosition: i.originalPosition,
                            offset: i.positionAbs,
                            item: i.currentItem,
                            sender: e ? e.element : null
                        }
                    }
                })
            }(jQuery);
            function(t, e) {
                var i = 0,
                    s = {},
                    n = {};
                s.height = s.paddingTop = s.paddingBottom = s.borderTopWidth = s.borderBottomWidth = "hide", n.height = n.paddingTop = n.paddingBottom = n.borderTopWidth = n.borderBottomWidth = "show", t.widget("ui.accordion", {
                    version: "1.10.3",
                    options: {
                        active: 0,
                        animate: {},
                        collapsible: !1,
                        event: "click",
                        header: "> li > :first-child,> :not(li):even",
                        heightStyle: "auto",
                        icons: {
                            activeHeader: "ui-icon-triangle-1-s",
                            header: "ui-icon-triangle-1-e"
                        },
                        activate: null,
                        beforeActivate: null
                    },
                    _create: function() {
                        var e = this.options;
                        this.prevShow = this.prevHide = t(), this.element.addClass("ui-accordion ui-widget ui-helper-reset").attr("role", "tablist"), e.collapsible || !1 !== e.active && null != e.active || (e.active = 0), this._processPanels(), e.active < 0 && (e.active += this.headers.length), this._refresh()
                    },
                    _getCreateEventData: function() {
                        return {
                            header: this.active,
                            panel: this.active.length ? this.active.next() : t(),
                            content: this.active.length ? this.active.next() : t()
                        }
                    },
                    _createIcons: function() {
                        var e = this.options.icons;
                        e && (t("<span>").addClass("ui-accordion-header-icon ui-icon " + e.header).prependTo(this.headers), this.active.children(".ui-accordion-header-icon").removeClass(e.header).addClass(e.activeHeader), this.headers.addClass("ui-accordion-icons"))
                    },
                    _destroyIcons: function() {
                        this.headers.removeClass("ui-accordion-icons").children(".ui-accordion-header-icon").remove()
                    },
                    _destroy: function() {
                        var t;
                        this.element.removeClass("ui-accordion ui-widget ui-helper-reset").removeAttr("role"), this.headers.removeClass("ui-accordion-header ui-accordion-header-active ui-helper-reset ui-state-default ui-corner-all ui-state-active ui-state-disabled ui-corner-top").removeAttr("role").removeAttr("aria-selected").removeAttr("aria-controls").removeAttr("tabIndex").each((function() {
                            /^ui-accordion/.test(this.id) && this.removeAttribute("id")
                        })), this._destroyIcons(), t = this.headers.next().css("display", "").removeAttr("role").removeAttr("aria-expanded").removeAttr("aria-hidden").removeAttr("aria-labelledby").removeClass("ui-helper-reset ui-widget-content ui-corner-bottom ui-accordion-content ui-accordion-content-active ui-state-disabled").each((function() {
                            /^ui-accordion/.test(this.id) && this.removeAttribute("id")
                        })), "content" !== this.options.heightStyle && t.css("height", "")
                    },
                    _setOption: function(t, e) {
                        "active" !== t ? ("event" === t && (this.options.event && this._off(this.headers, this.options.event), this._setupEvents(e)), this._super(t, e), "collapsible" !== t || e || !1 !== this.options.active || this._activate(0), "icons" === t && (this._destroyIcons(), e && this._createIcons()), "disabled" === t && this.headers.add(this.headers.next()).toggleClass("ui-state-disabled", !!e)) : this._activate(e)
                    },
                    _keydown: function(e) {
                        if (!e.altKey && !e.ctrlKey) {
                            var i = t.ui.keyCode,
                                s = this.headers.length,
                                n = this.headers.index(e.target),
                                o = !1;
                            switch (e.keyCode) {
                                case i.RIGHT:
                                case i.DOWN:
                                    o = this.headers[(n + 1) % s];
                                    break;
                                case i.LEFT:
                                case i.UP:
                                    o = this.headers[(n - 1 + s) % s];
                                    break;
                                case i.SPACE:
                                case i.ENTER:
                                    this._eventHandler(e);
                                    break;
                                case i.HOME:
                                    o = this.headers[0];
                                    break;
                                case i.END:
                                    o = this.headers[s - 1]
                            }
                            o && (t(e.target).attr("tabIndex", -1), t(o).attr("tabIndex", 0), o.focus(), e.preventDefault())
                        }
                    },
                    _panelKeyDown: function(e) {
                        e.keyCode === t.ui.keyCode.UP && e.ctrlKey && t(e.currentTarget).prev().focus()
                    },
                    refresh: function() {
                        var e = this.options;
                        this._processPanels(), !1 === e.active && !0 === e.collapsible || !this.headers.length ? (e.active = !1, this.active = t()) : !1 === e.active ? this._activate(0) : this.active.length && !t.contains(this.element[0], this.active[0]) ? this.headers.length === this.headers.find(".ui-state-disabled").length ? (e.active = !1, this.active = t()) : this._activate(Math.max(0, e.active - 1)) : e.active = this.headers.index(this.active), this._destroyIcons(), this._refresh()
                    },
                    _processPanels: function() {
                        this.headers = this.element.find(this.options.header).addClass("ui-accordion-header ui-helper-reset ui-state-default ui-corner-all"), this.headers.next().addClass("ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom").filter(":not(.ui-accordion-content-active)").hide()
                    },
                    _refresh: function() {
                        var e, s = this.options,
                            n = s.heightStyle,
                            o = this.element.parent(),
                            a = this.accordionId = "ui-accordion-" + (this.element.attr("id") || ++i);
                        this.active = this._findActive(s.active).addClass("ui-accordion-header-active ui-state-active ui-corner-top").removeClass("ui-corner-all"), this.active.next().addClass("ui-accordion-content-active").show(), this.headers.attr("role", "tab").each((function(e) {
                            var i = t(this),
                                s = i.attr("id"),
                                n = i.next(),
                                o = n.attr("id");
                            s || (s = a + "-header-" + e, i.attr("id", s)), o || (o = a + "-panel-" + e, n.attr("id", o)), i.attr("aria-controls", o), n.attr("aria-labelledby", s)
                        })).next().attr("role", "tabpanel"), this.headers.not(this.active).attr({
                            "aria-selected": "false",
                            tabIndex: -1
                        }).next().attr({
                            "aria-expanded": "false",
                            "aria-hidden": "true"
                        }).hide(), this.active.length ? this.active.attr({
                            "aria-selected": "true",
                            tabIndex: 0
                        }).next().attr({
                            "aria-expanded": "true",
                            "aria-hidden": "false"
                        }) : this.headers.eq(0).attr("tabIndex", 0), this._createIcons(), this._setupEvents(s.event), "fill" === n ? (e = o.height(), this.element.siblings(":visible").each((function() {
                            var i = t(this),
                                s = i.css("position");
                            "absolute" !== s && "fixed" !== s && (e -= i.outerHeight(!0))
                        })), this.headers.each((function() {
                            e -= t(this).outerHeight(!0)
                        })), this.headers.next().each((function() {
                            t(this).height(Math.max(0, e - t(this).innerHeight() + t(this).height()))
                        })).css("overflow", "auto")) : "auto" === n && (e = 0, this.headers.next().each((function() {
                            e = Math.max(e, t(this).css("height", "").height())
                        })).height(e))
                    },
                    _activate: function(e) {
                        var i = this._findActive(e)[0];
                        i !== this.active[0] && (i = i || this.active[0], this._eventHandler({
                            target: i,
                            currentTarget: i,
                            preventDefault: t.noop
                        }))
                    },
                    _findActive: function(e) {
                        return "number" == typeof e ? this.headers.eq(e) : t()
                    },
                    _setupEvents: function(e) {
                        var i = {
                            keydown: "_keydown"
                        };
                        e && t.each(e.split(" "), (function(t, e) {
                            i[e] = "_eventHandler"
                        })), this._off(this.headers.add(this.headers.next())), this._on(this.headers, i), this._on(this.headers.next(), {
                            keydown: "_panelKeyDown"
                        }), this._hoverable(this.headers), this._focusable(this.headers)
                    },
                    _eventHandler: function(e) {
                        var i = this.options,
                            s = this.active,
                            n = t(e.currentTarget),
                            o = n[0] === s[0],
                            a = o && i.collapsible,
                            r = a ? t() : n.next(),
                            l = s.next(),
                            h = {
                                oldHeader: s,
                                oldPanel: l,
                                newHeader: a ? t() : n,
                                newPanel: r
                            };
                        e.preventDefault(), o && !i.collapsible || !1 === this._trigger("beforeActivate", e, h) || (i.active = !a && this.headers.index(n), this.active = o ? t() : n, this._toggle(h), s.removeClass("ui-accordion-header-active ui-state-active"), i.icons && s.children(".ui-accordion-header-icon").removeClass(i.icons.activeHeader).addClass(i.icons.header), o || (n.removeClass("ui-corner-all").addClass("ui-accordion-header-active ui-state-active ui-corner-top"), i.icons && n.children(".ui-accordion-header-icon").removeClass(i.icons.header).addClass(i.icons.activeHeader), n.next().addClass("ui-accordion-content-active")))
                    },
                    _toggle: function(e) {
                        var i = e.newPanel,
                            s = this.prevShow.length ? this.prevShow : e.oldPanel;
                        this.prevShow.add(this.prevHide).stop(!0, !0), this.prevShow = i, this.prevHide = s, this.options.animate ? this._animate(i, s, e) : (s.hide(), i.show(), this._toggleComplete(e)), s.attr({
                            "aria-expanded": "false",
                            "aria-hidden": "true"
                        }), s.prev().attr("aria-selected", "false"), i.length && s.length ? s.prev().attr("tabIndex", -1) : i.length && this.headers.filter((function() {
                            return 0 === t(this).attr("tabIndex")
                        })).attr("tabIndex", -1), i.attr({
                            "aria-expanded": "true",
                            "aria-hidden": "false"
                        }).prev().attr({
                            "aria-selected": "true",
                            tabIndex: 0
                        })
                    },
                    _animate: function(t, e, i) {
                        var o, a, r, l = this,
                            h = 0,
                            c = t.length && (!e.length || t.index() < e.index()),
                            u = this.options.animate || {},
                            d = c && u.down || u,
                            p = function() {
                                l._toggleComplete(i)
                            };
                        return "number" == typeof d && (r = d), "string" == typeof d && (a = d), a = a || d.easing || u.easing, r = r || d.duration || u.duration, e.length ? t.length ? (o = t.show().outerHeight(), e.animate(s, {
                            duration: r,
                            easing: a,
                            step: function(t, e) {
                                e.now = Math.round(t)
                            }
                        }), void t.hide().animate(n, {
                            duration: r,
                            easing: a,
                            complete: p,
                            step: function(t, i) {
                                i.now = Math.round(t), "height" !== i.prop ? h += i.now : "content" !== l.options.heightStyle && (i.now = Math.round(o - e.outerHeight() - h), h = 0)
                            }
                        })) : e.animate(s, r, a, p) : t.animate(n, r, a, p)
                    },
                    _toggleComplete: function(t) {
                        var e = t.oldPanel;
                        e.removeClass("ui-accordion-content-active").prev().removeClass("ui-corner-top").addClass("ui-corner-all"), e.length && (e.parent()[0].className = e.parent()[0].className), this._trigger("activate", null, t)
                    }
                })
            }(jQuery);
            function(t, e) {
                var i = 0;
                t.widget("ui.autocomplete", {
                    version: "1.10.3",
                    defaultElement: "<input>",
                    options: {
                        appendTo: null,
                        autoFocus: !1,
                        delay: 300,
                        minLength: 1,
                        position: {
                            my: "left top",
                            at: "left bottom",
                            collision: "none"
                        },
                        source: null,
                        change: null,
                        close: null,
                        focus: null,
                        open: null,
                        response: null,
                        search: null,
                        select: null
                    },
                    pending: 0,
                    _create: function() {
                        var e, i, s, n = this.element[0].nodeName.toLowerCase(),
                            o = "textarea" === n,
                            a = "input" === n;
                        this.isMultiLine = !!o || !a && this.element.prop("isContentEditable"), this.valueMethod = this.element[o || a ? "val" : "text"], this.isNewMenu = !0, this.element.addClass("ui-autocomplete-input").attr("autocomplete", "off"), this._on(this.element, {
                            keydown: function(n) {
                                if (this.element.prop("readOnly")) return e = !0, s = !0, void(i = !0);
                                e = !1, s = !1, i = !1;
                                var o = t.ui.keyCode;
                                switch (n.keyCode) {
                                    case o.PAGE_UP:
                                        e = !0, this._move("previousPage", n);
                                        break;
                                    case o.PAGE_DOWN:
                                        e = !0, this._move("nextPage", n);
                                        break;
                                    case o.UP:
                                        e = !0, this._keyEvent("previous", n);
                                        break;
                                    case o.DOWN:
                                        e = !0, this._keyEvent("next", n);
                                        break;
                                    case o.ENTER:
                                    case o.NUMPAD_ENTER:
                                        this.menu.active && (e = !0, n.preventDefault(), this.menu.select(n));
                                        break;
                                    case o.TAB:
                                        this.menu.active && this.menu.select(n);
                                        break;
                                    case o.ESCAPE:
                                        this.menu.element.is(":visible") && (this._value(this.term), this.close(n), n.preventDefault());
                                        break;
                                    default:
                                        i = !0, this._searchTimeout(n)
                                }
                            },
                            keypress: function(s) {
                                if (e) return e = !1, void(this.isMultiLine && !this.menu.element.is(":visible") || s.preventDefault());
                                if (!i) {
                                    var n = t.ui.keyCode;
                                    switch (s.keyCode) {
                                        case n.PAGE_UP:
                                            this._move("previousPage", s);
                                            break;
                                        case n.PAGE_DOWN:
                                            this._move("nextPage", s);
                                            break;
                                        case n.UP:
                                            this._keyEvent("previous", s);
                                            break;
                                        case n.DOWN:
                                            this._keyEvent("next", s)
                                    }
                                }
                            },
                            input: function(t) {
                                if (s) return s = !1, void t.preventDefault();
                                this._searchTimeout(t)
                            },
                            focus: function() {
                                this.selectedItem = null, this.previous = this._value()
                            },
                            blur: function(t) {
                                this.cancelBlur ? delete this.cancelBlur : (clearTimeout(this.searching), this.close(t), this._change(t))
                            }
                        }), this._initSource(), this.menu = t("<ul>").addClass("ui-autocomplete ui-front").appendTo(this._appendTo()).menu({
                            role: null
                        }).hide().data("ui-menu"), this._on(this.menu.element, {
                            mousedown: function(e) {
                                e.preventDefault(), this.cancelBlur = !0, this._delay((function() {
                                    delete this.cancelBlur
                                }));
                                var i = this.menu.element[0];
                                t(e.target).closest(".ui-menu-item").length || this._delay((function() {
                                    var e = this;
                                    this.document.one("mousedown", (function(s) {
                                        s.target === e.element[0] || s.target === i || t.contains(i, s.target) || e.close()
                                    }))
                                }))
                            },
                            menufocus: function(e, i) {
                                if (this.isNewMenu && (this.isNewMenu = !1, e.originalEvent && /^mouse/.test(e.originalEvent.type))) return this.menu.blur(), void this.document.one("mousemove", (function() {
                                    t(e.target).trigger(e.originalEvent)
                                }));
                                var s = i.item.data("ui-autocomplete-item");
                                !1 !== this._trigger("focus", e, {
                                    item: s
                                }) ? e.originalEvent && /^key/.test(e.originalEvent.type) && this._value(s.value) : this.liveRegion.text(s.value)
                            },
                            menuselect: function(t, e) {
                                var i = e.item.data("ui-autocomplete-item"),
                                    s = this.previous;
                                this.element[0] !== this.document[0].activeElement && (this.element.focus(), this.previous = s, this._delay((function() {
                                    this.previous = s, this.selectedItem = i
                                }))), !1 !== this._trigger("select", t, {
                                    item: i
                                }) && this._value(i.value), this.term = this._value(), this.close(t), this.selectedItem = i
                            }
                        }), this.liveRegion = t("<span>", {
                            role: "status",
                            "aria-live": "polite"
                        }).addClass("ui-helper-hidden-accessible").insertBefore(this.element), this._on(this.window, {
                            beforeunload: function() {
                                this.element.removeAttr("autocomplete")
                            }
                        })
                    },
                    _destroy: function() {
                        clearTimeout(this.searching), this.element.removeClass("ui-autocomplete-input").removeAttr("autocomplete"), this.menu.element.remove(), this.liveRegion.remove()
                    },
                    _setOption: function(t, e) {
                        this._super(t, e), "source" === t && this._initSource(), "appendTo" === t && this.menu.element.appendTo(this._appendTo()), "disabled" === t && e && this.xhr && this.xhr.abort()
                    },
                    _appendTo: function() {
                        var e = this.options.appendTo;
                        return e && (e = e.jquery || e.nodeType ? t(e) : this.document.find(e).eq(0)), e || (e = this.element.closest(".ui-front")), e.length || (e = this.document[0].body), e
                    },
                    _initSource: function() {
                        var e, i, s = this;
                        t.isArray(this.options.source) ? (e = this.options.source, this.source = function(i, s) {
                            s(t.ui.autocomplete.filter(e, i.term))
                        }) : "string" == typeof this.options.source ? (i = this.options.source, this.source = function(e, n) {
                            s.xhr && s.xhr.abort(), s.xhr = t.ajax({
                                url: i,
                                data: e,
                                dataType: "json",
                                success: function(t) {
                                    n(t)
                                },
                                error: function() {
                                    n([])
                                }
                            })
                        }) : this.source = this.options.source
                    },
                    _searchTimeout: function(t) {
                        clearTimeout(this.searching), this.searching = this._delay((function() {
                            this.term !== this._value() && (this.selectedItem = null, this.search(null, t))
                        }), this.options.delay)
                    },
                    search: function(t, e) {
                        return t = null != t ? t : this._value(), this.term = this._value(), t.length < this.options.minLength ? this.close(e) : !1 !== this._trigger("search", e) ? this._search(t) : void 0
                    },
                    _search: function(t) {
                        this.pending++, this.element.addClass("ui-autocomplete-loading"), this.cancelSearch = !1, this.source({
                            term: t
                        }, this._response())
                    },
                    _response: function() {
                        var t = this,
                            e = ++i;
                        return function(s) {
                            e === i && t.__response(s), t.pending--, t.pending || t.element.removeClass("ui-autocomplete-loading")
                        }
                    },
                    __response: function(t) {
                        t && (t = this._normalize(t)), this._trigger("response", null, {
                            content: t
                        }), !this.options.disabled && t && t.length && !this.cancelSearch ? (this._suggest(t), this._trigger("open")) : this._close()
                    },
                    close: function(t) {
                        this.cancelSearch = !0, this._close(t)
                    },
                    _close: function(t) {
                        this.menu.element.is(":visible") && (this.menu.element.hide(), this.menu.blur(), this.isNewMenu = !0, this._trigger("close", t))
                    },
                    _change: function(t) {
                        this.previous !== this._value() && this._trigger("change", t, {
                            item: this.selectedItem
                        })
                    },
                    _normalize: function(e) {
                        return e.length && e[0].label && e[0].value ? e : t.map(e, (function(e) {
                            return "string" == typeof e ? {
                                label: e,
                                value: e
                            } : t.extend({
                                label: e.label || e.value,
                                value: e.value || e.label
                            }, e)
                        }))
                    },
                    _suggest: function(e) {
                        var i = this.menu.element.empty();
                        this._renderMenu(i, e), this.isNewMenu = !0, this.menu.refresh(), i.show(), this._resizeMenu(), i.position(t.extend({
                            of: this.element
                        }, this.options.position)), this.options.autoFocus && this.menu.next()
                    },
                    _resizeMenu: function() {
                        var t = this.menu.element;
                        t.outerWidth(Math.max(t.width("").outerWidth() + 1, this.element.outerWidth()))
                    },
                    _renderMenu: function(e, i) {
                        var s = this;
                        t.each(i, (function(t, i) {
                            s._renderItemData(e, i)
                        }))
                    },
                    _renderItemData: function(t, e) {
                        return this._renderItem(t, e).data("ui-autocomplete-item", e)
                    },
                    _renderItem: function(e, i) {
                        return t("<li>").append(t("<a>").text(i.label)).appendTo(e)
                    },
                    _move: function(t, e) {
                        if (this.menu.element.is(":visible")) return this.menu.isFirstItem() && /^previous/.test(t) || this.menu.isLastItem() && /^next/.test(t) ? (this._value(this.term), void this.menu.blur()) : void this.menu[t](e);
                        this.search(null, e)
                    },
                    widget: function() {
                        return this.menu.element
                    },
                    _value: function() {
                        return this.valueMethod.apply(this.element, arguments)
                    },
                    _keyEvent: function(t, e) {
                        this.isMultiLine && !this.menu.element.is(":visible") || (this._move(t, e), e.preventDefault())
                    }
                }), t.extend(t.ui.autocomplete, {
                    escapeRegex: function(t) {
                        return t.replace(/[\-\[\]{}()*+?.,\\\^$|#\s]/g, "\\$&")
                    },
                    filter: function(e, i) {
                        var s = new RegExp(t.ui.autocomplete.escapeRegex(i), "i");
                        return t.grep(e, (function(t) {
                            return s.test(t.label || t.value || t)
                        }))
                    }
                }), t.widget("ui.autocomplete", t.ui.autocomplete, {
                    options: {
                        messages: {
                            noResults: "No search results.",
                            results: function(t) {
                                return t + (t > 1 ? " results are" : " result is") + " available, use up and down arrow keys to navigate."
                            }
                        }
                    },
                    __response: function(t) {
                        var e;
                        this._superApply(arguments), this.options.disabled || this.cancelSearch || (e = t && t.length ? this.options.messages.results(t.length) : this.options.messages.noResults, this.liveRegion.text(e))
                    }
                })
            }(jQuery);
            function(t, e) {
                var i, s, n, o, a = "ui-button ui-widget ui-state-default ui-corner-all",
                    r = "ui-button-icons-only ui-button-icon-only ui-button-text-icons ui-button-text-icon-primary ui-button-text-icon-secondary ui-button-text-only",
                    l = function() {
                        var e = t(this);
                        setTimeout((function() {
                            e.find(":ui-button").button("refresh")
                        }), 1)
                    },
                    h = function(e) {
                        var i = e.name,
                            s = e.form,
                            n = t([]);
                        return i && (i = i.replace(/'/g, "\\'"), n = s ? t(s).find("[name='" + i + "']") : t("[name='" + i + "']", e.ownerDocument).filter((function() {
                            return !this.form
                        }))), n
                    };
                t.widget("ui.button", {
                    version: "1.10.3",
                    defaultElement: "<button>",
                    options: {
                        disabled: null,
                        text: !0,
                        label: null,
                        icons: {
                            primary: null,
                            secondary: null
                        }
                    },
                    _create: function() {
                        this.element.closest("form").unbind("reset" + this.eventNamespace).bind("reset" + this.eventNamespace, l), "boolean" != typeof this.options.disabled ? this.options.disabled = !!this.element.prop("disabled") : this.element.prop("disabled", this.options.disabled), this._determineButtonType(), this.hasTitle = !!this.buttonElement.attr("title");
                        var e = this,
                            r = this.options,
                            c = "checkbox" === this.type || "radio" === this.type,
                            u = c ? "" : "ui-state-active";
                        null === r.label && (r.label = "input" === this.type ? this.buttonElement.val() : this.buttonElement.html()), this._hoverable(this.buttonElement), this.buttonElement.addClass(a).attr("role", "button").bind("mouseenter" + this.eventNamespace, (function() {
                            r.disabled || this === i && t(this).addClass("ui-state-active")
                        })).bind("mouseleave" + this.eventNamespace, (function() {
                            r.disabled || t(this).removeClass(u)
                        })).bind("click" + this.eventNamespace, (function(t) {
                            r.disabled && (t.preventDefault(), t.stopImmediatePropagation())
                        })), this.element.bind("focus" + this.eventNamespace, (function() {
                            e.buttonElement.addClass("ui-state-focus")
                        })).bind("blur" + this.eventNamespace, (function() {
                            e.buttonElement.removeClass("ui-state-focus")
                        })), c && (this.element.bind("change" + this.eventNamespace, (function() {
                            o || e.refresh()
                        })), this.buttonElement.bind("mousedown" + this.eventNamespace, (function(t) {
                            r.disabled || (o = !1, s = t.pageX, n = t.pageY)
                        })).bind("mouseup" + this.eventNamespace, (function(t) {
                            r.disabled || s === t.pageX && n === t.pageY || (o = !0)
                        }))), "checkbox" === this.type ? this.buttonElement.bind("click" + this.eventNamespace, (function() {
                            if (r.disabled || o) return !1
                        })) : "radio" === this.type ? this.buttonElement.bind("click" + this.eventNamespace, (function() {
                            if (r.disabled || o) return !1;
                            t(this).addClass("ui-state-active"), e.buttonElement.attr("aria-pressed", "true");
                            var i = e.element[0];
                            h(i).not(i).map((function() {
                                return t(this).button("widget")[0]
                            })).removeClass("ui-state-active").attr("aria-pressed", "false")
                        })) : (this.buttonElement.bind("mousedown" + this.eventNamespace, (function() {
                            if (r.disabled) return !1;
                            t(this).addClass("ui-state-active"), i = this, e.document.one("mouseup", (function() {
                                i = null
                            }))
                        })).bind("mouseup" + this.eventNamespace, (function() {
                            if (r.disabled) return !1;
                            t(this).removeClass("ui-state-active")
                        })).bind("keydown" + this.eventNamespace, (function(e) {
                            if (r.disabled) return !1;
                            e.keyCode !== t.ui.keyCode.SPACE && e.keyCode !== t.ui.keyCode.ENTER || t(this).addClass("ui-state-active")
                        })).bind("keyup" + this.eventNamespace + " blur" + this.eventNamespace, (function() {
                            t(this).removeClass("ui-state-active")
                        })), this.buttonElement.is("a") && this.buttonElement.keyup((function(e) {
                            e.keyCode === t.ui.keyCode.SPACE && t(this).click()
                        }))), this._setOption("disabled", r.disabled), this._resetButton()
                    },
                    _determineButtonType: function() {
                        var t, e, i;
                        this.element.is("[type=checkbox]") ? this.type = "checkbox" : this.element.is("[type=radio]") ? this.type = "radio" : this.element.is("input") ? this.type = "input" : this.type = "button", "checkbox" === this.type || "radio" === this.type ? (t = this.element.parents().last(), e = "label[for='" + this.element.attr("id") + "']", this.buttonElement = t.find(e), this.buttonElement.length || (t = t.length ? t.siblings() : this.element.siblings(), this.buttonElement = t.filter(e), this.buttonElement.length || (this.buttonElement = t.find(e))), this.element.addClass("ui-helper-hidden-accessible"), (i = this.element.is(":checked")) && this.buttonElement.addClass("ui-state-active"), this.buttonElement.prop("aria-pressed", i)) : this.buttonElement = this.element
                    },
                    widget: function() {
                        return this.buttonElement
                    },
                    _destroy: function() {
                        this.element.removeClass("ui-helper-hidden-accessible"), this.buttonElement.removeClass(a + " ui-state-hover ui-state-active  " + r).removeAttr("role").removeAttr("aria-pressed").html(this.buttonElement.find(".ui-button-text").html()), this.hasTitle || this.buttonElement.removeAttr("title")
                    },
                    _setOption: function(t, e) {
                        this._super(t, e), "disabled" !== t ? this._resetButton() : e ? this.element.prop("disabled", !0) : this.element.prop("disabled", !1)
                    },
                    refresh: function() {
                        var e = this.element.is("input, button") ? this.element.is(":disabled") : this.element.hasClass("ui-button-disabled");
                        e !== this.options.disabled && this._setOption("disabled", e), "radio" === this.type ? h(this.element[0]).each((function() {
                            t(this).is(":checked") ? t(this).button("widget").addClass("ui-state-active").attr("aria-pressed", "true") : t(this).button("widget").removeClass("ui-state-active").attr("aria-pressed", "false")
                        })) : "checkbox" === this.type && (this.element.is(":checked") ? this.buttonElement.addClass("ui-state-active").attr("aria-pressed", "true") : this.buttonElement.removeClass("ui-state-active").attr("aria-pressed", "false"))
                    },
                    _resetButton: function() {
                        if ("input" !== this.type) {
                            var e = this.buttonElement.removeClass(r),
                                i = t("<span></span>", this.document[0]).addClass("ui-button-text").html(this.options.label).appendTo(e.empty()).text(),
                                s = this.options.icons,
                                n = s.primary && s.secondary,
                                o = [];
                            s.primary || s.secondary ? (this.options.text && o.push("ui-button-text-icon" + (n ? "s" : s.primary ? "-primary" : "-secondary")), s.primary && e.prepend("<span class='ui-button-icon-primary ui-icon " + s.primary + "'></span>"), s.secondary && e.append("<span class='ui-button-icon-secondary ui-icon " + s.secondary + "'></span>"), this.options.text || (o.push(n ? "ui-button-icons-only" : "ui-button-icon-only"), this.hasTitle || e.attr("title", t.trim(i)))) : o.push("ui-button-text-only"), e.addClass(o.join(" "))
                        } else this.options.label && this.element.val(this.options.label)
                    }
                }), t.widget("ui.buttonset", {
                    version: "1.10.3",
                    options: {
                        items: "button, input[type=button], input[type=submit], input[type=reset], input[type=checkbox], input[type=radio], a, :data(ui-button)"
                    },
                    _create: function() {
                        this.element.addClass("ui-buttonset")
                    },
                    _init: function() {
                        this.refresh()
                    },
                    _setOption: function(t, e) {
                        "disabled" === t && this.buttons.button("option", t, e), this._super(t, e)
                    },
                    refresh: function() {
                        var e = "rtl" === this.element.css("direction");
                        this.buttons = this.element.find(this.options.items).filter(":ui-button").button("refresh").end().not(":ui-button").button().end().map((function() {
                            return t(this).button("widget")[0]
                        })).removeClass("ui-corner-all ui-corner-left ui-corner-right").filter(":first").addClass(e ? "ui-corner-right" : "ui-corner-left").end().filter(":last").addClass(e ? "ui-corner-left" : "ui-corner-right").end().end()
                    },
                    _destroy: function() {
                        this.element.removeClass("ui-buttonset"), this.buttons.map((function() {
                            return t(this).button("widget")[0]
                        })).removeClass("ui-corner-left ui-corner-right").end().button("destroy")
                    }
                })
            }(jQuery);
            function(t, e) {
                t.extend(t.ui, {
                    datepicker: {
                        version: "1.10.3"
                    }
                });
                var s, n = "datepicker";

                function o() {
                    this._curInst = null, this._keyEvent = !1, this._disabledInputs = [], this._datepickerShowing = !1, this._inDialog = !1, this._mainDivId = "ui-datepicker-div", this._inlineClass = "ui-datepicker-inline", this._appendClass = "ui-datepicker-append", this._triggerClass = "ui-datepicker-trigger", this._dialogClass = "ui-datepicker-dialog", this._disableClass = "ui-datepicker-disabled", this._unselectableClass = "ui-datepicker-unselectable", this._currentClass = "ui-datepicker-current-day", this._dayOverClass = "ui-datepicker-days-cell-over", this.regional = [], this.regional[""] = {
                        closeText: "Done",
                        prevText: "Prev",
                        nextText: "Next",
                        currentText: "Today",
                        monthNames: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
                        monthNamesShort: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                        dayNames: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
                        dayNamesShort: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
                        dayNamesMin: ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"],
                        weekHeader: "Wk",
                        dateFormat: "mm/dd/yy",
                        firstDay: 0,
                        isRTL: !1,
                        showMonthAfterYear: !1,
                        yearSuffix: ""
                    }, this._defaults = {
                        showOn: "focus",
                        showAnim: "fadeIn",
                        showOptions: {},
                        defaultDate: null,
                        appendText: "",
                        buttonText: "...",
                        buttonImage: "",
                        buttonImageOnly: !1,
                        hideIfNoPrevNext: !1,
                        navigationAsDateFormat: !1,
                        gotoCurrent: !1,
                        changeMonth: !1,
                        changeYear: !1,
                        yearRange: "c-10:c+10",
                        showOtherMonths: !1,
                        selectOtherMonths: !1,
                        showWeek: !1,
                        calculateWeek: this.iso8601Week,
                        shortYearCutoff: "+10",
                        minDate: null,
                        maxDate: null,
                        duration: "fast",
                        beforeShowDay: null,
                        beforeShow: null,
                        onSelect: null,
                        onChangeMonthYear: null,
                        onClose: null,
                        numberOfMonths: 1,
                        showCurrentAtPos: 0,
                        stepMonths: 1,
                        stepBigMonths: 12,
                        altField: "",
                        altFormat: "",
                        constrainInput: !0,
                        showButtonPanel: !1,
                        autoSize: !1,
                        disabled: !1
                    }, t.extend(this._defaults, this.regional[""]), this.dpDiv = a(t("<div id='" + this._mainDivId + "' class='ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all'></div>"))
                }

                function a(e) {
                    var i = "button, .ui-datepicker-prev, .ui-datepicker-next, .ui-datepicker-calendar td a";
                    return e.delegate(i, "mouseout", (function() {
                        t(this).removeClass("ui-state-hover"), -1 !== this.className.indexOf("ui-datepicker-prev") && t(this).removeClass("ui-datepicker-prev-hover"), -1 !== this.className.indexOf("ui-datepicker-next") && t(this).removeClass("ui-datepicker-next-hover")
                    })).delegate(i, "mouseover", (function() {
                        t.datepicker._isDisabledDatepicker(s.inline ? e.parent()[0] : s.input[0]) || (t(this).parents(".ui-datepicker-calendar").find("a").removeClass("ui-state-hover"), t(this).addClass("ui-state-hover"), -1 !== this.className.indexOf("ui-datepicker-prev") && t(this).addClass("ui-datepicker-prev-hover"), -1 !== this.className.indexOf("ui-datepicker-next") && t(this).addClass("ui-datepicker-next-hover"))
                    }))
                }

                function r(e, i) {
                    for (var s in t.extend(e, i), i) null == i[s] && (e[s] = i[s]);
                    return e
                }
                t.extend(o.prototype, {
                    markerClassName: "hasDatepicker",
                    maxRows: 4,
                    _widgetDatepicker: function() {
                        return this.dpDiv
                    },
                    setDefaults: function(t) {
                        return r(this._defaults, t || {}), this
                    },
                    _attachDatepicker: function(e, i) {
                        var s, n, o;
                        n = "div" === (s = e.nodeName.toLowerCase()) || "span" === s, e.id || (this.uuid += 1, e.id = "dp" + this.uuid), (o = this._newInst(t(e), n)).settings = t.extend({}, i || {}), "input" === s ? this._connectDatepicker(e, o) : n && this._inlineDatepicker(e, o)
                    },
                    _newInst: function(e, i) {
                        return {
                            id: e[0].id.replace(/([^A-Za-z0-9_\-])/g, "\\\\$1"),
                            input: e,
                            selectedDay: 0,
                            selectedMonth: 0,
                            selectedYear: 0,
                            drawMonth: 0,
                            drawYear: 0,
                            inline: i,
                            dpDiv: i ? a(t("<div class='" + this._inlineClass + " ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all'></div>")) : this.dpDiv
                        }
                    },
                    _connectDatepicker: function(e, i) {
                        var s = t(e);
                        i.append = t([]), i.trigger = t([]), s.hasClass(this.markerClassName) || (this._attachments(s, i), s.addClass(this.markerClassName).keydown(this._doKeyDown).keypress(this._doKeyPress).keyup(this._doKeyUp), this._autoSize(i), t.data(e, n, i), i.settings.disabled && this._disableDatepicker(e))
                    },
                    _attachments: function(e, i) {
                        var s, n, o, a = this._get(i, "appendText"),
                            r = this._get(i, "isRTL");
                        i.append && i.append.remove(), a && (i.append = t("<span class='" + this._appendClass + "'>" + a + "</span>"), e[r ? "before" : "after"](i.append)), e.unbind("focus", this._showDatepicker), i.trigger && i.trigger.remove(), "focus" !== (s = this._get(i, "showOn")) && "both" !== s || e.focus(this._showDatepicker), "button" !== s && "both" !== s || (n = this._get(i, "buttonText"), o = this._get(i, "buttonImage"), i.trigger = t(this._get(i, "buttonImageOnly") ? t("<img/>").addClass(this._triggerClass).attr({
                            src: o,
                            alt: n,
                            title: n
                        }) : t("<button type='button'></button>").addClass(this._triggerClass).html(o ? t("<img/>").attr({
                            src: o,
                            alt: n,
                            title: n
                        }) : n)), e[r ? "before" : "after"](i.trigger), i.trigger.click((function() {
                            return t.datepicker._datepickerShowing && t.datepicker._lastInput === e[0] ? t.datepicker._hideDatepicker() : t.datepicker._datepickerShowing && t.datepicker._lastInput !== e[0] ? (t.datepicker._hideDatepicker(), t.datepicker._showDatepicker(e[0])) : t.datepicker._showDatepicker(e[0]), !1
                        })))
                    },
                    _autoSize: function(t) {
                        if (this._get(t, "autoSize") && !t.inline) {
                            var e, i, s, n, o = new Date(2009, 11, 20),
                                a = this._get(t, "dateFormat");
                            a.match(/[DM]/) && (e = function(t) {
                                for (i = 0, s = 0, n = 0; n < t.length; n++) t[n].length > i && (i = t[n].length, s = n);
                                return s
                            }, o.setMonth(e(this._get(t, a.match(/MM/) ? "monthNames" : "monthNamesShort"))), o.setDate(e(this._get(t, a.match(/DD/) ? "dayNames" : "dayNamesShort")) + 20 - o.getDay())), t.input.attr("size", this._formatDate(t, o).length)
                        }
                    },
                    _inlineDatepicker: function(e, i) {
                        var s = t(e);
                        s.hasClass(this.markerClassName) || (s.addClass(this.markerClassName).append(i.dpDiv), t.data(e, n, i), this._setDate(i, this._getDefaultDate(i), !0), this._updateDatepicker(i), this._updateAlternate(i), i.settings.disabled && this._disableDatepicker(e), i.dpDiv.css("display", "block"))
                    },
                    _dialogDatepicker: function(e, i, s, o, a) {
                        var l, h, c, u, d, p = this._dialogInst;
                        return p || (this.uuid += 1, l = "dp" + this.uuid, this._dialogInput = t("<input type='text' id='" + l + "' style='position: absolute; top: -100px; width: 0px;'/>"), this._dialogInput.keydown(this._doKeyDown), t("body").append(this._dialogInput), (p = this._dialogInst = this._newInst(this._dialogInput, !1)).settings = {}, t.data(this._dialogInput[0], n, p)), r(p.settings, o || {}), i = i && i.constructor === Date ? this._formatDate(p, i) : i, this._dialogInput.val(i), this._pos = a ? a.length ? a : [a.pageX, a.pageY] : null, this._pos || (h = document.documentElement.clientWidth, c = document.documentElement.clientHeight, u = document.documentElement.scrollLeft || document.body.scrollLeft, d = document.documentElement.scrollTop || document.body.scrollTop, this._pos = [h / 2 - 100 + u, c / 2 - 150 + d]), this._dialogInput.css("left", this._pos[0] + 20 + "px").css("top", this._pos[1] + "px"), p.settings.onSelect = s, this._inDialog = !0, this.dpDiv.addClass(this._dialogClass), this._showDatepicker(this._dialogInput[0]), t.blockUI && t.blockUI(this.dpDiv), t.data(this._dialogInput[0], n, p), this
                    },
                    _destroyDatepicker: function(e) {
                        var i, s = t(e),
                            o = t.data(e, n);
                        s.hasClass(this.markerClassName) && (i = e.nodeName.toLowerCase(), t.removeData(e, n), "input" === i ? (o.append.remove(), o.trigger.remove(), s.removeClass(this.markerClassName).unbind("focus", this._showDatepicker).unbind("keydown", this._doKeyDown).unbind("keypress", this._doKeyPress).unbind("keyup", this._doKeyUp)) : "div" !== i && "span" !== i || s.removeClass(this.markerClassName).empty())
                    },
                    _enableDatepicker: function(e) {
                        var i, s, o = t(e),
                            a = t.data(e, n);
                        o.hasClass(this.markerClassName) && ("input" === (i = e.nodeName.toLowerCase()) ? (e.disabled = !1, a.trigger.filter("button").each((function() {
                            this.disabled = !1
                        })).end().filter("img").css({
                            opacity: "1.0",
                            cursor: ""
                        })) : "div" !== i && "span" !== i || ((s = o.children("." + this._inlineClass)).children().removeClass("ui-state-disabled"), s.find("select.ui-datepicker-month, select.ui-datepicker-year").prop("disabled", !1)), this._disabledInputs = t.map(this._disabledInputs, (function(t) {
                            return t === e ? null : t
                        })))
                    },
                    _disableDatepicker: function(e) {
                        var i, s, o = t(e),
                            a = t.data(e, n);
                        o.hasClass(this.markerClassName) && ("input" === (i = e.nodeName.toLowerCase()) ? (e.disabled = !0, a.trigger.filter("button").each((function() {
                            this.disabled = !0
                        })).end().filter("img").css({
                            opacity: "0.5",
                            cursor: "default"
                        })) : "div" !== i && "span" !== i || ((s = o.children("." + this._inlineClass)).children().addClass("ui-state-disabled"), s.find("select.ui-datepicker-month, select.ui-datepicker-year").prop("disabled", !0)), this._disabledInputs = t.map(this._disabledInputs, (function(t) {
                            return t === e ? null : t
                        })), this._disabledInputs[this._disabledInputs.length] = e)
                    },
                    _isDisabledDatepicker: function(t) {
                        if (!t) return !1;
                        for (var e = 0; e < this._disabledInputs.length; e++)
                            if (this._disabledInputs[e] === t) return !0;
                        return !1
                    },
                    _getInst: function(e) {
                        try {
                            return t.data(e, n)
                        } catch (t) {
                            throw "Missing instance data for this datepicker"
                        }
                    },
                    _optionDatepicker: function(e, i, s) {
                        var n, o, a, l, h = this._getInst(e);
                        if (2 === arguments.length && "string" == typeof i) return "defaults" === i ? t.extend({}, t.datepicker._defaults) : h ? "all" === i ? t.extend({}, h.settings) : this._get(h, i) : null;
                        n = i || {}, "string" == typeof i && ((n = {})[i] = s), h && (this._curInst === h && this._hideDatepicker(), o = this._getDateDatepicker(e, !0), a = this._getMinMaxDate(h, "min"), l = this._getMinMaxDate(h, "max"), r(h.settings, n), null !== a && void 0 !== n.dateFormat && void 0 === n.minDate && (h.settings.minDate = this._formatDate(h, a)), null !== l && void 0 !== n.dateFormat && void 0 === n.maxDate && (h.settings.maxDate = this._formatDate(h, l)), "disabled" in n && (n.disabled ? this._disableDatepicker(e) : this._enableDatepicker(e)), this._attachments(t(e), h), this._autoSize(h), this._setDate(h, o), this._updateAlternate(h), this._updateDatepicker(h))
                    },
                    _changeDatepicker: function(t, e, i) {
                        this._optionDatepicker(t, e, i)
                    },
                    _refreshDatepicker: function(t) {
                        var e = this._getInst(t);
                        e && this._updateDatepicker(e)
                    },
                    _setDateDatepicker: function(t, e) {
                        var i = this._getInst(t);
                        i && (this._setDate(i, e), this._updateDatepicker(i), this._updateAlternate(i))
                    },
                    _getDateDatepicker: function(t, e) {
                        var i = this._getInst(t);
                        return i && !i.inline && this._setDateFromField(i, e), i ? this._getDate(i) : null
                    },
                    _doKeyDown: function(e) {
                        var i, s, n, o = t.datepicker._getInst(e.target),
                            a = !0,
                            r = o.dpDiv.is(".ui-datepicker-rtl");
                        if (o._keyEvent = !0, t.datepicker._datepickerShowing) switch (e.keyCode) {
                            case 9:
                                t.datepicker._hideDatepicker(), a = !1;
                                break;
                            case 13:
                                return (n = t("td." + t.datepicker._dayOverClass + ":not(." + t.datepicker._currentClass + ")", o.dpDiv))[0] && t.datepicker._selectDay(e.target, o.selectedMonth, o.selectedYear, n[0]), (i = t.datepicker._get(o, "onSelect")) ? (s = t.datepicker._formatDate(o), i.apply(o.input ? o.input[0] : null, [s, o])) : t.datepicker._hideDatepicker(), !1;
                            case 27:
                                t.datepicker._hideDatepicker();
                                break;
                            case 33:
                                t.datepicker._adjustDate(e.target, e.ctrlKey ? -t.datepicker._get(o, "stepBigMonths") : -t.datepicker._get(o, "stepMonths"), "M");
                                break;
                            case 34:
                                t.datepicker._adjustDate(e.target, e.ctrlKey ? +t.datepicker._get(o, "stepBigMonths") : +t.datepicker._get(o, "stepMonths"), "M");
                                break;
                            case 35:
                                (e.ctrlKey || e.metaKey) && t.datepicker._clearDate(e.target), a = e.ctrlKey || e.metaKey;
                                break;
                            case 36:
                                (e.ctrlKey || e.metaKey) && t.datepicker._gotoToday(e.target), a = e.ctrlKey || e.metaKey;
                                break;
                            case 37:
                                (e.ctrlKey || e.metaKey) && t.datepicker._adjustDate(e.target, r ? 1 : -1, "D"), a = e.ctrlKey || e.metaKey, e.originalEvent.altKey && t.datepicker._adjustDate(e.target, e.ctrlKey ? -t.datepicker._get(o, "stepBigMonths") : -t.datepicker._get(o, "stepMonths"), "M");
                                break;
                            case 38:
                                (e.ctrlKey || e.metaKey) && t.datepicker._adjustDate(e.target, -7, "D"), a = e.ctrlKey || e.metaKey;
                                break;
                            case 39:
                                (e.ctrlKey || e.metaKey) && t.datepicker._adjustDate(e.target, r ? -1 : 1, "D"), a = e.ctrlKey || e.metaKey, e.originalEvent.altKey && t.datepicker._adjustDate(e.target, e.ctrlKey ? +t.datepicker._get(o, "stepBigMonths") : +t.datepicker._get(o, "stepMonths"), "M");
                                break;
                            case 40:
                                (e.ctrlKey || e.metaKey) && t.datepicker._adjustDate(e.target, 7, "D"), a = e.ctrlKey || e.metaKey;
                                break;
                            default:
                                a = !1
                        } else 36 === e.keyCode && e.ctrlKey ? t.datepicker._showDatepicker(this) : a = !1;
                        a && (e.preventDefault(), e.stopPropagation())
                    },
                    _doKeyPress: function(e) {
                        var i, s, n = t.datepicker._getInst(e.target);
                        if (t.datepicker._get(n, "constrainInput")) return i = t.datepicker._possibleChars(t.datepicker._get(n, "dateFormat")), s = String.fromCharCode(null == e.charCode ? e.keyCode : e.charCode), e.ctrlKey || e.metaKey || s < " " || !i || i.indexOf(s) > -1
                    },
                    _doKeyUp: function(e) {
                        var i = t.datepicker._getInst(e.target);
                        if (i.input.val() !== i.lastVal) try {
                            t.datepicker.parseDate(t.datepicker._get(i, "dateFormat"), i.input ? i.input.val() : null, t.datepicker._getFormatConfig(i)) && (t.datepicker._setDateFromField(i), t.datepicker._updateAlternate(i), t.datepicker._updateDatepicker(i))
                        } catch (t) {}
                        return !0
                    },
                    _showDatepicker: function(e) {
                        var i, s, n, o, a, l, h;
                        ("input" !== (e = e.target || e).nodeName.toLowerCase() && (e = t("input", e.parentNode)[0]), t.datepicker._isDisabledDatepicker(e) || t.datepicker._lastInput === e) || (i = t.datepicker._getInst(e), t.datepicker._curInst && t.datepicker._curInst !== i && (t.datepicker._curInst.dpDiv.stop(!0, !0), i && t.datepicker._datepickerShowing && t.datepicker._hideDatepicker(t.datepicker._curInst.input[0])), !1 !== (n = (s = t.datepicker._get(i, "beforeShow")) ? s.apply(e, [e, i]) : {}) && (r(i.settings, n), i.lastVal = null, t.datepicker._lastInput = e, t.datepicker._setDateFromField(i), t.datepicker._inDialog && (e.value = ""), t.datepicker._pos || (t.datepicker._pos = t.datepicker._findPos(e), t.datepicker._pos[1] += e.offsetHeight), o = !1, t(e).parents().each((function() {
                            return !(o |= "fixed" === t(this).css("position"))
                        })), a = {
                            left: t.datepicker._pos[0],
                            top: t.datepicker._pos[1]
                        }, t.datepicker._pos = null, i.dpDiv.empty(), i.dpDiv.css({
                            position: "absolute",
                            display: "block",
                            top: "-1000px"
                        }), t.datepicker._updateDatepicker(i), a = t.datepicker._checkOffset(i, a, o), i.dpDiv.css({
                            position: t.datepicker._inDialog && t.blockUI ? "static" : o ? "fixed" : "absolute",
                            display: "none",
                            left: a.left + "px",
                            top: a.top + "px"
                        }), i.inline || (l = t.datepicker._get(i, "showAnim"), h = t.datepicker._get(i, "duration"), i.dpDiv.zIndex(t(e).zIndex() + 1), t.datepicker._datepickerShowing = !0, t.effects && t.effects.effect[l] ? i.dpDiv.show(l, t.datepicker._get(i, "showOptions"), h) : i.dpDiv[l || "show"](l ? h : null), t.datepicker._shouldFocusInput(i) && i.input.focus(), t.datepicker._curInst = i)))
                    },
                    _updateDatepicker: function(e) {
                        this.maxRows = 4, s = e, e.dpDiv.empty().append(this._generateHTML(e)), this._attachHandlers(e), e.dpDiv.find("." + this._dayOverClass + " a").mouseover();
                        var i, n = this._getNumberOfMonths(e),
                            o = n[1];
                        e.dpDiv.removeClass("ui-datepicker-multi-2 ui-datepicker-multi-3 ui-datepicker-multi-4").width(""), o > 1 && e.dpDiv.addClass("ui-datepicker-multi-" + o).css("width", 17 * o + "em"), e.dpDiv[(1 !== n[0] || 1 !== n[1] ? "add" : "remove") + "Class"]("ui-datepicker-multi"), e.dpDiv[(this._get(e, "isRTL") ? "add" : "remove") + "Class"]("ui-datepicker-rtl"), e === t.datepicker._curInst && t.datepicker._datepickerShowing && t.datepicker._shouldFocusInput(e) && e.input.focus(), e.yearshtml && (i = e.yearshtml, setTimeout((function() {
                            i === e.yearshtml && e.yearshtml && e.dpDiv.find("select.ui-datepicker-year:first").replaceWith(e.yearshtml), i = e.yearshtml = null
                        }), 0))
                    },
                    _shouldFocusInput: function(t) {
                        return t.input && t.input.is(":visible") && !t.input.is(":disabled") && !t.input.is(":focus")
                    },
                    _checkOffset: function(e, i, s) {
                        var n = e.dpDiv.outerWidth(),
                            o = e.dpDiv.outerHeight(),
                            a = e.input ? e.input.outerWidth() : 0,
                            r = e.input ? e.input.outerHeight() : 0,
                            l = document.documentElement.clientWidth + (s ? 0 : t(document).scrollLeft()),
                            h = document.documentElement.clientHeight + (s ? 0 : t(document).scrollTop());
                        return i.left -= this._get(e, "isRTL") ? n - a : 0, i.left -= s && i.left === e.input.offset().left ? t(document).scrollLeft() : 0, i.top -= s && i.top === e.input.offset().top + r ? t(document).scrollTop() : 0, i.left -= Math.min(i.left, i.left + n > l && l > n ? Math.abs(i.left + n - l) : 0), i.top -= Math.min(i.top, i.top + o > h && h > o ? Math.abs(o + r) : 0), i
                    },
                    _findPos: function(e) {
                        for (var i, s = this._getInst(e), n = this._get(s, "isRTL"); e && ("hidden" === e.type || 1 !== e.nodeType || t.expr.filters.hidden(e));) e = e[n ? "previousSibling" : "nextSibling"];
                        return [(i = t(e).offset()).left, i.top]
                    },
                    _hideDatepicker: function(e) {
                        var i, s, o, a, r = this._curInst;
                        !r || e && r !== t.data(e, n) || this._datepickerShowing && (i = this._get(r, "showAnim"), s = this._get(r, "duration"), o = function() {
                            t.datepicker._tidyDialog(r)
                        }, t.effects && (t.effects.effect[i] || t.effects[i]) ? r.dpDiv.hide(i, t.datepicker._get(r, "showOptions"), s, o) : r.dpDiv["slideDown" === i ? "slideUp" : "fadeIn" === i ? "fadeOut" : "hide"](i ? s : null, o), i || o(), this._datepickerShowing = !1, (a = this._get(r, "onClose")) && a.apply(r.input ? r.input[0] : null, [r.input ? r.input.val() : "", r]), this._lastInput = null, this._inDialog && (this._dialogInput.css({
                            position: "absolute",
                            left: "0",
                            top: "-100px"
                        }), t.blockUI && (t.unblockUI(), t("body").append(this.dpDiv))), this._inDialog = !1)
                    },
                    _tidyDialog: function(t) {
                        t.dpDiv.removeClass(this._dialogClass).unbind(".ui-datepicker-calendar")
                    },
                    _checkExternalClick: function(e) {
                        if (t.datepicker._curInst) {
                            var i = t(e.target),
                                s = t.datepicker._getInst(i[0]);
                            (i[0].id === t.datepicker._mainDivId || 0 !== i.parents("#" + t.datepicker._mainDivId).length || i.hasClass(t.datepicker.markerClassName) || i.closest("." + t.datepicker._triggerClass).length || !t.datepicker._datepickerShowing || t.datepicker._inDialog && t.blockUI) && (!i.hasClass(t.datepicker.markerClassName) || t.datepicker._curInst === s) || t.datepicker._hideDatepicker()
                        }
                    },
                    _adjustDate: function(e, i, s) {
                        var n = t(e),
                            o = this._getInst(n[0]);
                        this._isDisabledDatepicker(n[0]) || (this._adjustInstDate(o, i + ("M" === s ? this._get(o, "showCurrentAtPos") : 0), s), this._updateDatepicker(o))
                    },
                    _gotoToday: function(e) {
                        var i, s = t(e),
                            n = this._getInst(s[0]);
                        this._get(n, "gotoCurrent") && n.currentDay ? (n.selectedDay = n.currentDay, n.drawMonth = n.selectedMonth = n.currentMonth, n.drawYear = n.selectedYear = n.currentYear) : (i = new Date, n.selectedDay = i.getDate(), n.drawMonth = n.selectedMonth = i.getMonth(), n.drawYear = n.selectedYear = i.getFullYear()), this._notifyChange(n), this._adjustDate(s)
                    },
                    _selectMonthYear: function(e, i, s) {
                        var n = t(e),
                            o = this._getInst(n[0]);
                        o["selected" + ("M" === s ? "Month" : "Year")] = o["draw" + ("M" === s ? "Month" : "Year")] = parseInt(i.options[i.selectedIndex].value, 10), this._notifyChange(o), this._adjustDate(n)
                    },
                    _selectDay: function(e, i, s, n) {
                        var o, a = t(e);
                        t(n).hasClass(this._unselectableClass) || this._isDisabledDatepicker(a[0]) || ((o = this._getInst(a[0])).selectedDay = o.currentDay = t("a", n).html(), o.selectedMonth = o.currentMonth = i, o.selectedYear = o.currentYear = s, this._selectDate(e, this._formatDate(o, o.currentDay, o.currentMonth, o.currentYear)))
                    },
                    _clearDate: function(e) {
                        var i = t(e);
                        this._selectDate(i, "")
                    },
                    _selectDate: function(e, s) {
                        var n, o = t(e),
                            a = this._getInst(o[0]);
                        s = null != s ? s : this._formatDate(a), a.input && a.input.val(s), this._updateAlternate(a), (n = this._get(a, "onSelect")) ? n.apply(a.input ? a.input[0] : null, [s, a]) : a.input && a.input.trigger("change"), a.inline ? this._updateDatepicker(a) : (this._hideDatepicker(), this._lastInput = a.input[0], "object" !== i(a.input[0]) && a.input.focus(), this._lastInput = null)
                    },
                    _updateAlternate: function(e) {
                        var i, s, n, o = this._get(e, "altField");
                        o && (i = this._get(e, "altFormat") || this._get(e, "dateFormat"), s = this._getDate(e), n = this.formatDate(i, s, this._getFormatConfig(e)), t(o).each((function() {
                            t(this).val(n)
                        })))
                    },
                    noWeekends: function(t) {
                        var e = t.getDay();
                        return [e > 0 && e < 6, ""]
                    },
                    iso8601Week: function(t) {
                        var e, i = new Date(t.getTime());
                        return i.setDate(i.getDate() + 4 - (i.getDay() || 7)), e = i.getTime(), i.setMonth(0), i.setDate(1), Math.floor(Math.round((e - i) / 864e5) / 7) + 1
                    },
                    parseDate: function(e, s, n) {
                        if (null == e || null == s) throw "Invalid arguments";
                        if ("" === (s = "object" === i(s) ? s.toString() : s + "")) return null;
                        var o, a, r, l, h = 0,
                            c = (n ? n.shortYearCutoff : null) || this._defaults.shortYearCutoff,
                            u = "string" != typeof c ? c : (new Date).getFullYear() % 100 + parseInt(c, 10),
                            d = (n ? n.dayNamesShort : null) || this._defaults.dayNamesShort,
                            p = (n ? n.dayNames : null) || this._defaults.dayNames,
                            f = (n ? n.monthNamesShort : null) || this._defaults.monthNamesShort,
                            m = (n ? n.monthNames : null) || this._defaults.monthNames,
                            g = -1,
                            v = -1,
                            b = -1,
                            y = -1,
                            _ = !1,
                            w = function(t) {
                                var i = o + 1 < e.length && e.charAt(o + 1) === t;
                                return i && o++, i
                            },
                            x = function(t) {
                                var e = w(t),
                                    i = new RegExp("^\\d{1," + ("@" === t ? 14 : "!" === t ? 20 : "y" === t && e ? 4 : "o" === t ? 3 : 2) + "}"),
                                    n = s.substring(h).match(i);
                                if (!n) throw "Missing number at position " + h;
                                return h += n[0].length, parseInt(n[0], 10)
                            },
                            k = function(e, i, n) {
                                var o = -1,
                                    a = t.map(w(e) ? n : i, (function(t, e) {
                                        return [
                                            [e, t]
                                        ]
                                    })).sort((function(t, e) {
                                        return -(t[1].length - e[1].length)
                                    }));
                                if (t.each(a, (function(t, e) {
                                        var i = e[1];
                                        if (s.substr(h, i.length).toLowerCase() === i.toLowerCase()) return o = e[0], h += i.length, !1
                                    })), -1 !== o) return o + 1;
                                throw "Unknown name at position " + h
                            },
                            C = function() {
                                if (s.charAt(h) !== e.charAt(o)) throw "Unexpected literal at position " + h;
                                h++
                            };
                        for (o = 0; o < e.length; o++)
                            if (_) "'" !== e.charAt(o) || w("'") ? C() : _ = !1;
                            else switch (e.charAt(o)) {
                                case "d":
                                    b = x("d");
                                    break;
                                case "D":
                                    k("D", d, p);
                                    break;
                                case "o":
                                    y = x("o");
                                    break;
                                case "m":
                                    v = x("m");
                                    break;
                                case "M":
                                    v = k("M", f, m);
                                    break;
                                case "y":
                                    g = x("y");
                                    break;
                                case "@":
                                    g = (l = new Date(x("@"))).getFullYear(), v = l.getMonth() + 1, b = l.getDate();
                                    break;
                                case "!":
                                    g = (l = new Date((x("!") - this._ticksTo1970) / 1e4)).getFullYear(), v = l.getMonth() + 1, b = l.getDate();
                                    break;
                                case "'":
                                    w("'") ? C() : _ = !0;
                                    break;
                                default:
                                    C()
                            }
                        if (h < s.length && (r = s.substr(h), !/^\s+/.test(r))) throw "Extra/unparsed characters found in date: " + r;
                        if (-1 === g ? g = (new Date).getFullYear() : g < 100 && (g += (new Date).getFullYear() - (new Date).getFullYear() % 100 + (g <= u ? 0 : -100)), y > -1)
                            for (v = 1, b = y;;) {
                                if (b <= (a = this._getDaysInMonth(g, v - 1))) break;
                                v++, b -= a
                            }
                        if ((l = this._daylightSavingAdjust(new Date(g, v - 1, b))).getFullYear() !== g || l.getMonth() + 1 !== v || l.getDate() !== b) throw "Invalid date";
                        return l
                    },
                    ATOM: "yy-mm-dd",
                    COOKIE: "D, dd M yy",
                    ISO_8601: "yy-mm-dd",
                    RFC_822: "D, d M y",
                    RFC_850: "DD, dd-M-y",
                    RFC_1036: "D, d M y",
                    RFC_1123: "D, d M yy",
                    RFC_2822: "D, d M yy",
                    RSS: "D, d M y",
                    TICKS: "!",
                    TIMESTAMP: "@",
                    W3C: "yy-mm-dd",
                    _ticksTo1970: 24 * (718685 + Math.floor(492.5) - Math.floor(19.7) + Math.floor(4.925)) * 60 * 60 * 1e7,
                    formatDate: function(t, e, i) {
                        if (!e) return "";
                        var s, n = (i ? i.dayNamesShort : null) || this._defaults.dayNamesShort,
                            o = (i ? i.dayNames : null) || this._defaults.dayNames,
                            a = (i ? i.monthNamesShort : null) || this._defaults.monthNamesShort,
                            r = (i ? i.monthNames : null) || this._defaults.monthNames,
                            l = function(e) {
                                var i = s + 1 < t.length && t.charAt(s + 1) === e;
                                return i && s++, i
                            },
                            h = function(t, e, i) {
                                var s = "" + e;
                                if (l(t))
                                    for (; s.length < i;) s = "0" + s;
                                return s
                            },
                            c = function(t, e, i, s) {
                                return l(t) ? s[e] : i[e]
                            },
                            u = "",
                            d = !1;
                        if (e)
                            for (s = 0; s < t.length; s++)
                                if (d) "'" !== t.charAt(s) || l("'") ? u += t.charAt(s) : d = !1;
                                else switch (t.charAt(s)) {
                                    case "d":
                                        u += h("d", e.getDate(), 2);
                                        break;
                                    case "D":
                                        u += c("D", e.getDay(), n, o);
                                        break;
                                    case "o":
                                        u += h("o", Math.round((new Date(e.getFullYear(), e.getMonth(), e.getDate()).getTime() - new Date(e.getFullYear(), 0, 0).getTime()) / 864e5), 3);
                                        break;
                                    case "m":
                                        u += h("m", e.getMonth() + 1, 2);
                                        break;
                                    case "M":
                                        u += c("M", e.getMonth(), a, r);
                                        break;
                                    case "y":
                                        u += l("y") ? e.getFullYear() : (e.getYear() % 100 < 10 ? "0" : "") + e.getYear() % 100;
                                        break;
                                    case "@":
                                        u += e.getTime();
                                        break;
                                    case "!":
                                        u += 1e4 * e.getTime() + this._ticksTo1970;
                                        break;
                                    case "'":
                                        l("'") ? u += "'" : d = !0;
                                        break;
                                    default:
                                        u += t.charAt(s)
                                }
                        return u
                    },
                    _possibleChars: function(t) {
                        var e, i = "",
                            s = !1,
                            n = function(i) {
                                var s = e + 1 < t.length && t.charAt(e + 1) === i;
                                return s && e++, s
                            };
                        for (e = 0; e < t.length; e++)
                            if (s) "'" !== t.charAt(e) || n("'") ? i += t.charAt(e) : s = !1;
                            else switch (t.charAt(e)) {
                                case "d":
                                case "m":
                                case "y":
                                case "@":
                                    i += "0123456789";
                                    break;
                                case "D":
                                case "M":
                                    return null;
                                case "'":
                                    n("'") ? i += "'" : s = !0;
                                    break;
                                default:
                                    i += t.charAt(e)
                            }
                        return i
                    },
                    _get: function(t, e) {
                        return void 0 !== t.settings[e] ? t.settings[e] : this._defaults[e]
                    },
                    _setDateFromField: function(t, e) {
                        if (t.input.val() !== t.lastVal) {
                            var i = this._get(t, "dateFormat"),
                                s = t.lastVal = t.input ? t.input.val() : null,
                                n = this._getDefaultDate(t),
                                o = n,
                                a = this._getFormatConfig(t);
                            try {
                                o = this.parseDate(i, s, a) || n
                            } catch (t) {
                                s = e ? "" : s
                            }
                            t.selectedDay = o.getDate(), t.drawMonth = t.selectedMonth = o.getMonth(), t.drawYear = t.selectedYear = o.getFullYear(), t.currentDay = s ? o.getDate() : 0, t.currentMonth = s ? o.getMonth() : 0, t.currentYear = s ? o.getFullYear() : 0, this._adjustInstDate(t)
                        }
                    },
                    _getDefaultDate: function(t) {
                        return this._restrictMinMax(t, this._determineDate(t, this._get(t, "defaultDate"), new Date))
                    },
                    _determineDate: function(e, i, s) {
                        var n = null == i || "" === i ? s : "string" == typeof i ? function(i) {
                            try {
                                return t.datepicker.parseDate(t.datepicker._get(e, "dateFormat"), i, t.datepicker._getFormatConfig(e))
                            } catch (t) {}
                            for (var s = (i.toLowerCase().match(/^c/) ? t.datepicker._getDate(e) : null) || new Date, n = s.getFullYear(), o = s.getMonth(), a = s.getDate(), r = /([+\-]?[0-9]+)\s*(d|D|w|W|m|M|y|Y)?/g, l = r.exec(i); l;) {
                                switch (l[2] || "d") {
                                    case "d":
                                    case "D":
                                        a += parseInt(l[1], 10);
                                        break;
                                    case "w":
                                    case "W":
                                        a += 7 * parseInt(l[1], 10);
                                        break;
                                    case "m":
                                    case "M":
                                        o += parseInt(l[1], 10), a = Math.min(a, t.datepicker._getDaysInMonth(n, o));
                                        break;
                                    case "y":
                                    case "Y":
                                        n += parseInt(l[1], 10), a = Math.min(a, t.datepicker._getDaysInMonth(n, o))
                                }
                                l = r.exec(i)
                            }
                            return new Date(n, o, a)
                        }(i) : "number" == typeof i ? isNaN(i) ? s : function(t) {
                            var e = new Date;
                            return e.setDate(e.getDate() + t), e
                        }(i) : new Date(i.getTime());
                        return (n = n && "Invalid Date" === n.toString() ? s : n) && (n.setHours(0), n.setMinutes(0), n.setSeconds(0), n.setMilliseconds(0)), this._daylightSavingAdjust(n)
                    },
                    _daylightSavingAdjust: function(t) {
                        return t ? (t.setHours(t.getHours() > 12 ? t.getHours() + 2 : 0), t) : null
                    },
                    _setDate: function(t, e, i) {
                        var s = !e,
                            n = t.selectedMonth,
                            o = t.selectedYear,
                            a = this._restrictMinMax(t, this._determineDate(t, e, new Date));
                        t.selectedDay = t.currentDay = a.getDate(), t.drawMonth = t.selectedMonth = t.currentMonth = a.getMonth(), t.drawYear = t.selectedYear = t.currentYear = a.getFullYear(), n === t.selectedMonth && o === t.selectedYear || i || this._notifyChange(t), this._adjustInstDate(t), t.input && t.input.val(s ? "" : this._formatDate(t))
                    },
                    _getDate: function(t) {
                        return !t.currentYear || t.input && "" === t.input.val() ? null : this._daylightSavingAdjust(new Date(t.currentYear, t.currentMonth, t.currentDay))
                    },
                    _attachHandlers: function(e) {
                        var i = this._get(e, "stepMonths"),
                            s = "#" + e.id.replace(/\\\\/g, "\\");
                        e.dpDiv.find("[data-handler]").map((function() {
                            var e = {
                                prev: function() {
                                    t.datepicker._adjustDate(s, -i, "M")
                                },
                                next: function() {
                                    t.datepicker._adjustDate(s, +i, "M")
                                },
                                hide: function() {
                                    t.datepicker._hideDatepicker()
                                },
                                today: function() {
                                    t.datepicker._gotoToday(s)
                                },
                                selectDay: function() {
                                    return t.datepicker._selectDay(s, +this.getAttribute("data-month"), +this.getAttribute("data-year"), this), !1
                                },
                                selectMonth: function() {
                                    return t.datepicker._selectMonthYear(s, this, "M"), !1
                                },
                                selectYear: function() {
                                    return t.datepicker._selectMonthYear(s, this, "Y"), !1
                                }
                            };
                            t(this).bind(this.getAttribute("data-event"), e[this.getAttribute("data-handler")])
                        }))
                    },
                    _generateHTML: function(t) {
                        var e, i, s, n, o, a, r, l, h, c, u, d, p, f, m, g, v, b, y, _, w, x, k, C, D, $, T, P, S, F, M, E, I, A, z, O, N, H, L, W = new Date,
                            R = this._daylightSavingAdjust(new Date(W.getFullYear(), W.getMonth(), W.getDate())),
                            q = this._get(t, "isRTL"),
                            j = this._get(t, "showButtonPanel"),
                            U = this._get(t, "hideIfNoPrevNext"),
                            Y = this._get(t, "navigationAsDateFormat"),
                            B = this._getNumberOfMonths(t),
                            V = this._get(t, "showCurrentAtPos"),
                            K = this._get(t, "stepMonths"),
                            Q = 1 !== B[0] || 1 !== B[1],
                            G = this._daylightSavingAdjust(t.currentDay ? new Date(t.currentYear, t.currentMonth, t.currentDay) : new Date(9999, 9, 9)),
                            X = this._getMinMaxDate(t, "min"),
                            Z = this._getMinMaxDate(t, "max"),
                            J = t.drawMonth - V,
                            tt = t.drawYear;
                        if (J < 0 && (J += 12, tt--), Z)
                            for (e = this._daylightSavingAdjust(new Date(Z.getFullYear(), Z.getMonth() - B[0] * B[1] + 1, Z.getDate())), e = X && e < X ? X : e; this._daylightSavingAdjust(new Date(tt, J, 1)) > e;) --J < 0 && (J = 11, tt--);
                        for (t.drawMonth = J, t.drawYear = tt, i = this._get(t, "prevText"), i = Y ? this.formatDate(i, this._daylightSavingAdjust(new Date(tt, J - K, 1)), this._getFormatConfig(t)) : i, s = this._canAdjustMonth(t, -1, tt, J) ? "<a class='ui-datepicker-prev ui-corner-all' data-handler='prev' data-event='click' title='" + i + "'><span class='ui-icon ui-icon-circle-triangle-" + (q ? "e" : "w") + "'>" + i + "</span></a>" : U ? "" : "<a class='ui-datepicker-prev ui-corner-all ui-state-disabled' title='" + i + "'><span class='ui-icon ui-icon-circle-triangle-" + (q ? "e" : "w") + "'>" + i + "</span></a>", n = this._get(t, "nextText"), n = Y ? this.formatDate(n, this._daylightSavingAdjust(new Date(tt, J + K, 1)), this._getFormatConfig(t)) : n, o = this._canAdjustMonth(t, 1, tt, J) ? "<a class='ui-datepicker-next ui-corner-all' data-handler='next' data-event='click' title='" + n + "'><span class='ui-icon ui-icon-circle-triangle-" + (q ? "w" : "e") + "'>" + n + "</span></a>" : U ? "" : "<a class='ui-datepicker-next ui-corner-all ui-state-disabled' title='" + n + "'><span class='ui-icon ui-icon-circle-triangle-" + (q ? "w" : "e") + "'>" + n + "</span></a>", a = this._get(t, "currentText"), r = this._get(t, "gotoCurrent") && t.currentDay ? G : R, a = Y ? this.formatDate(a, r, this._getFormatConfig(t)) : a, l = t.inline ? "" : "<button type='button' class='ui-datepicker-close ui-state-default ui-priority-primary ui-corner-all' data-handler='hide' data-event='click'>" + this._get(t, "closeText") + "</button>", h = j ? "<div class='ui-datepicker-buttonpane ui-widget-content'>" + (q ? l : "") + (this._isInRange(t, r) ? "<button type='button' class='ui-datepicker-current ui-state-default ui-priority-secondary ui-corner-all' data-handler='today' data-event='click'>" + a + "</button>" : "") + (q ? "" : l) + "</div>" : "", c = parseInt(this._get(t, "firstDay"), 10), c = isNaN(c) ? 0 : c, u = this._get(t, "showWeek"), d = this._get(t, "dayNames"), p = this._get(t, "dayNamesMin"), f = this._get(t, "monthNames"), m = this._get(t, "monthNamesShort"), g = this._get(t, "beforeShowDay"), v = this._get(t, "showOtherMonths"), b = this._get(t, "selectOtherMonths"), y = this._getDefaultDate(t), _ = "", x = 0; x < B[0]; x++) {
                            for (k = "", this.maxRows = 4, C = 0; C < B[1]; C++) {
                                if (D = this._daylightSavingAdjust(new Date(tt, J, t.selectedDay)), $ = " ui-corner-all", T = "", Q) {
                                    if (T += "<div class='ui-datepicker-group", B[1] > 1) switch (C) {
                                        case 0:
                                            T += " ui-datepicker-group-first", $ = " ui-corner-" + (q ? "right" : "left");
                                            break;
                                        case B[1] - 1:
                                            T += " ui-datepicker-group-last", $ = " ui-corner-" + (q ? "left" : "right");
                                            break;
                                        default:
                                            T += " ui-datepicker-group-middle", $ = ""
                                    }
                                    T += "'>"
                                }
                                for (T += "<div class='ui-datepicker-header ui-widget-header ui-helper-clearfix" + $ + "'>" + (/all|left/.test($) && 0 === x ? q ? o : s : "") + (/all|right/.test($) && 0 === x ? q ? s : o : "") + this._generateMonthYearHeader(t, J, tt, X, Z, x > 0 || C > 0, f, m) + "</div><table class='ui-datepicker-calendar'><thead><tr>", P = u ? "<th class='ui-datepicker-week-col'>" + this._get(t, "weekHeader") + "</th>" : "", w = 0; w < 7; w++) P += "<th" + ((w + c + 6) % 7 >= 5 ? " class='ui-datepicker-week-end'" : "") + "><span title='" + d[S = (w + c) % 7] + "'>" + p[S] + "</span></th>";
                                for (T += P + "</tr></thead><tbody>", F = this._getDaysInMonth(tt, J), tt === t.selectedYear && J === t.selectedMonth && (t.selectedDay = Math.min(t.selectedDay, F)), M = (this._getFirstDayOfMonth(tt, J) - c + 7) % 7, E = Math.ceil((M + F) / 7), I = Q && this.maxRows > E ? this.maxRows : E, this.maxRows = I, A = this._daylightSavingAdjust(new Date(tt, J, 1 - M)), z = 0; z < I; z++) {
                                    for (T += "<tr>", O = u ? "<td class='ui-datepicker-week-col'>" + this._get(t, "calculateWeek")(A) + "</td>" : "", w = 0; w < 7; w++) N = g ? g.apply(t.input ? t.input[0] : null, [A]) : [!0, ""], L = (H = A.getMonth() !== J) && !b || !N[0] || X && A < X || Z && A > Z, O += "<td class='" + ((w + c + 6) % 7 >= 5 ? " ui-datepicker-week-end" : "") + (H ? " ui-datepicker-other-month" : "") + (A.getTime() === D.getTime() && J === t.selectedMonth && t._keyEvent || y.getTime() === A.getTime() && y.getTime() === D.getTime() ? " " + this._dayOverClass : "") + (L ? " " + this._unselectableClass + " ui-state-disabled" : "") + (H && !v ? "" : " " + N[1] + (A.getTime() === G.getTime() ? " " + this._currentClass : "") + (A.getTime() === R.getTime() ? " ui-datepicker-today" : "")) + "'" + (H && !v || !N[2] ? "" : " title='" + N[2].replace(/'/g, "&#39;") + "'") + (L ? "" : " data-handler='selectDay' data-event='click' data-month='" + A.getMonth() + "' data-year='" + A.getFullYear() + "'") + ">" + (H && !v ? "&#xa0;" : L ? "<span class='ui-state-default'>" + A.getDate() + "</span>" : "<a class='ui-state-default" + (A.getTime() === R.getTime() ? " ui-state-highlight" : "") + (A.getTime() === G.getTime() ? " ui-state-active" : "") + (H ? " ui-priority-secondary" : "") + "' href='#'>" + A.getDate() + "</a>") + "</td>", A.setDate(A.getDate() + 1), A = this._daylightSavingAdjust(A);
                                    T += O + "</tr>"
                                }++J > 11 && (J = 0, tt++), k += T += "</tbody></table>" + (Q ? "</div>" + (B[0] > 0 && C === B[1] - 1 ? "<div class='ui-datepicker-row-break'></div>" : "") : "")
                            }
                            _ += k
                        }
                        return _ += h, t._keyEvent = !1, _
                    },
                    _generateMonthYearHeader: function(t, e, i, s, n, o, a, r) {
                        var l, h, c, u, d, p, f, m, g = this._get(t, "changeMonth"),
                            v = this._get(t, "changeYear"),
                            b = this._get(t, "showMonthAfterYear"),
                            y = "<div class='ui-datepicker-title'>",
                            _ = "";
                        if (o || !g) _ += "<span class='ui-datepicker-month'>" + a[e] + "</span>";
                        else {
                            for (l = s && s.getFullYear() === i, h = n && n.getFullYear() === i, _ += "<select class='ui-datepicker-month' data-handler='selectMonth' data-event='change'>", c = 0; c < 12; c++)(!l || c >= s.getMonth()) && (!h || c <= n.getMonth()) && (_ += "<option value='" + c + "'" + (c === e ? " selected='selected'" : "") + ">" + r[c] + "</option>");
                            _ += "</select>"
                        }
                        if (b || (y += _ + (!o && g && v ? "" : "&#xa0;")), !t.yearshtml)
                            if (t.yearshtml = "", o || !v) y += "<span class='ui-datepicker-year'>" + i + "</span>";
                            else {
                                for (u = this._get(t, "yearRange").split(":"), d = (new Date).getFullYear(), f = (p = function(t) {
                                        var e = t.match(/c[+\-].*/) ? i + parseInt(t.substring(1), 10) : t.match(/[+\-].*/) ? d + parseInt(t, 10) : parseInt(t, 10);
                                        return isNaN(e) ? d : e
                                    })(u[0]), m = Math.max(f, p(u[1] || "")), f = s ? Math.max(f, s.getFullYear()) : f, m = n ? Math.min(m, n.getFullYear()) : m, t.yearshtml += "<select class='ui-datepicker-year' data-handler='selectYear' data-event='change'>"; f <= m; f++) t.yearshtml += "<option value='" + f + "'" + (f === i ? " selected='selected'" : "") + ">" + f + "</option>";
                                t.yearshtml += "</select>", y += t.yearshtml, t.yearshtml = null
                            } return y += this._get(t, "yearSuffix"), b && (y += (!o && g && v ? "" : "&#xa0;") + _), y += "</div>"
                    },
                    _adjustInstDate: function(t, e, i) {
                        var s = t.drawYear + ("Y" === i ? e : 0),
                            n = t.drawMonth + ("M" === i ? e : 0),
                            o = Math.min(t.selectedDay, this._getDaysInMonth(s, n)) + ("D" === i ? e : 0),
                            a = this._restrictMinMax(t, this._daylightSavingAdjust(new Date(s, n, o)));
                        t.selectedDay = a.getDate(), t.drawMonth = t.selectedMonth = a.getMonth(), t.drawYear = t.selectedYear = a.getFullYear(), "M" !== i && "Y" !== i || this._notifyChange(t)
                    },
                    _restrictMinMax: function(t, e) {
                        var i = this._getMinMaxDate(t, "min"),
                            s = this._getMinMaxDate(t, "max"),
                            n = i && e < i ? i : e;
                        return s && n > s ? s : n
                    },
                    _notifyChange: function(t) {
                        var e = this._get(t, "onChangeMonthYear");
                        e && e.apply(t.input ? t.input[0] : null, [t.selectedYear, t.selectedMonth + 1, t])
                    },
                    _getNumberOfMonths: function(t) {
                        var e = this._get(t, "numberOfMonths");
                        return null == e ? [1, 1] : "number" == typeof e ? [1, e] : e
                    },
                    _getMinMaxDate: function(t, e) {
                        return this._determineDate(t, this._get(t, e + "Date"), null)
                    },
                    _getDaysInMonth: function(t, e) {
                        return 32 - this._daylightSavingAdjust(new Date(t, e, 32)).getDate()
                    },
                    _getFirstDayOfMonth: function(t, e) {
                        return new Date(t, e, 1).getDay()
                    },
                    _canAdjustMonth: function(t, e, i, s) {
                        var n = this._getNumberOfMonths(t),
                            o = this._daylightSavingAdjust(new Date(i, s + (e < 0 ? e : n[0] * n[1]), 1));
                        return e < 0 && o.setDate(this._getDaysInMonth(o.getFullYear(), o.getMonth())), this._isInRange(t, o)
                    },
                    _isInRange: function(t, e) {
                        var i, s, n = this._getMinMaxDate(t, "min"),
                            o = this._getMinMaxDate(t, "max"),
                            a = null,
                            r = null,
                            l = this._get(t, "yearRange");
                        return l && (i = l.split(":"), s = (new Date).getFullYear(), a = parseInt(i[0], 10), r = parseInt(i[1], 10), i[0].match(/[+\-].*/) && (a += s), i[1].match(/[+\-].*/) && (r += s)), (!n || e.getTime() >= n.getTime()) && (!o || e.getTime() <= o.getTime()) && (!a || e.getFullYear() >= a) && (!r || e.getFullYear() <= r)
                    },
                    _getFormatConfig: function(t) {
                        var e = this._get(t, "shortYearCutoff");
                        return {
                            shortYearCutoff: e = "string" != typeof e ? e : (new Date).getFullYear() % 100 + parseInt(e, 10),
                            dayNamesShort: this._get(t, "dayNamesShort"),
                            dayNames: this._get(t, "dayNames"),
                            monthNamesShort: this._get(t, "monthNamesShort"),
                            monthNames: this._get(t, "monthNames")
                        }
                    },
                    _formatDate: function(t, e, s, n) {
                        e || (t.currentDay = t.selectedDay, t.currentMonth = t.selectedMonth, t.currentYear = t.selectedYear);
                        var o = e ? "object" === i(e) ? e : this._daylightSavingAdjust(new Date(n, s, e)) : this._daylightSavingAdjust(new Date(t.currentYear, t.currentMonth, t.currentDay));
                        return this.formatDate(this._get(t, "dateFormat"), o, this._getFormatConfig(t))
                    }
                }), t.fn.datepicker = function(e) {
                    if (!this.length) return this;
                    t.datepicker.initialized || (t(document).mousedown(t.datepicker._checkExternalClick), t.datepicker.initialized = !0), 0 === t("#" + t.datepicker._mainDivId).length && t("body").append(t.datepicker.dpDiv);
                    var i = Array.prototype.slice.call(arguments, 1);
                    return "string" != typeof e || "isDisabled" !== e && "getDate" !== e && "widget" !== e ? "option" === e && 2 === arguments.length && "string" == typeof arguments[1] ? t.datepicker["_" + e + "Datepicker"].apply(t.datepicker, [this[0]].concat(i)) : this.each((function() {
                        "string" == typeof e ? t.datepicker["_" + e + "Datepicker"].apply(t.datepicker, [this].concat(i)) : t.datepicker._attachDatepicker(this, e)
                    })) : t.datepicker["_" + e + "Datepicker"].apply(t.datepicker, [this[0]].concat(i))
                }, t.datepicker = new o, t.datepicker.initialized = !1, t.datepicker.uuid = (new Date).getTime(), t.datepicker.version = "1.10.3"
            }(jQuery);
            function(t, e) {
                var s = {
                        buttons: !0,
                        height: !0,
                        maxHeight: !0,
                        maxWidth: !0,
                        minHeight: !0,
                        minWidth: !0,
                        width: !0
                    },
                    n = {
                        maxHeight: !0,
                        maxWidth: !0,
                        minHeight: !0,
                        minWidth: !0
                    };
                t.widget("ui.dialog", {
                    version: "1.10.3",
                    options: {
                        appendTo: "body",
                        autoOpen: !0,
                        buttons: [],
                        closeOnEscape: !0,
                        closeText: "close",
                        dialogClass: "",
                        draggable: !0,
                        hide: null,
                        height: "auto",
                        maxHeight: null,
                        maxWidth: null,
                        minHeight: 150,
                        minWidth: 150,
                        modal: !1,
                        position: {
                            my: "center",
                            at: "center",
                            of: window,
                            collision: "fit",
                            using: function(e) {
                                var i = t(this).css(e).offset().top;
                                i < 0 && t(this).css("top", e.top - i)
                            }
                        },
                        resizable: !0,
                        show: null,
                        title: null,
                        width: 300,
                        beforeClose: null,
                        close: null,
                        drag: null,
                        dragStart: null,
                        dragStop: null,
                        focus: null,
                        open: null,
                        resize: null,
                        resizeStart: null,
                        resizeStop: null
                    },
                    _create: function() {
                        this.originalCss = {
                            display: this.element[0].style.display,
                            width: this.element[0].style.width,
                            minHeight: this.element[0].style.minHeight,
                            maxHeight: this.element[0].style.maxHeight,
                            height: this.element[0].style.height
                        }, this.originalPosition = {
                            parent: this.element.parent(),
                            index: this.element.parent().children().index(this.element)
                        }, this.originalTitle = this.element.attr("title"), this.options.title = this.options.title || this.originalTitle, this._createWrapper(), this.element.show().removeAttr("title").addClass("ui-dialog-content ui-widget-content").appendTo(this.uiDialog), this._createTitlebar(), this._createButtonPane(), this.options.draggable && t.fn.draggable && this._makeDraggable(), this.options.resizable && t.fn.resizable && this._makeResizable(), this._isOpen = !1
                    },
                    _init: function() {
                        this.options.autoOpen && this.open()
                    },
                    _appendTo: function() {
                        var e = this.options.appendTo;
                        return e && (e.jquery || e.nodeType) ? t(e) : this.document.find(e || "body").eq(0)
                    },
                    _destroy: function() {
                        var t, e = this.originalPosition;
                        this._destroyOverlay(), this.element.removeUniqueId().removeClass("ui-dialog-content ui-widget-content").css(this.originalCss).detach(), this.uiDialog.stop(!0, !0).remove(), this.originalTitle && this.element.attr("title", this.originalTitle), (t = e.parent.children().eq(e.index)).length && t[0] !== this.element[0] ? t.before(this.element) : e.parent.append(this.element)
                    },
                    widget: function() {
                        return this.uiDialog
                    },
                    disable: t.noop,
                    enable: t.noop,
                    close: function(e) {
                        var i = this;
                        this._isOpen && !1 !== this._trigger("beforeClose", e) && (this._isOpen = !1, this._destroyOverlay(), this.opener.filter(":focusable").focus().length || t(this.document[0].activeElement).blur(), this._hide(this.uiDialog, this.options.hide, (function() {
                            i._trigger("close", e)
                        })))
                    },
                    isOpen: function() {
                        return this._isOpen
                    },
                    moveToTop: function() {
                        this._moveToTop()
                    },
                    _moveToTop: function(t, e) {
                        var i = !!this.uiDialog.nextAll(":visible").insertBefore(this.uiDialog).length;
                        return i && !e && this._trigger("focus", t), i
                    },
                    open: function() {
                        var e = this;
                        this._isOpen ? this._moveToTop() && this._focusTabbable() : (this._isOpen = !0, this.opener = t(this.document[0].activeElement), this._size(), this._position(), this._createOverlay(), this._moveToTop(null, !0), this._show(this.uiDialog, this.options.show, (function() {
                            e._focusTabbable(), e._trigger("focus")
                        })), this._trigger("open"))
                    },
                    _focusTabbable: function() {
                        var t = this.element.find("[autofocus]");
                        t.length || (t = this.element.find(":tabbable")), t.length || (t = this.uiDialogButtonPane.find(":tabbable")), t.length || (t = this.uiDialogTitlebarClose.filter(":tabbable")), t.length || (t = this.uiDialog), t.eq(0).focus()
                    },
                    _keepFocus: function(e) {
                        function i() {
                            var e = this.document[0].activeElement;
                            this.uiDialog[0] === e || t.contains(this.uiDialog[0], e) || this._focusTabbable()
                        }
                        e.preventDefault(), i.call(this), this._delay(i)
                    },
                    _createWrapper: function() {
                        this.uiDialog = t("<div>").addClass("ui-dialog ui-widget ui-widget-content ui-corner-all ui-front " + this.options.dialogClass).hide().attr({
                            tabIndex: -1,
                            role: "dialog"
                        }).appendTo(this._appendTo()), this._on(this.uiDialog, {
                            keydown: function(e) {
                                if (this.options.closeOnEscape && !e.isDefaultPrevented() && e.keyCode && e.keyCode === t.ui.keyCode.ESCAPE) return e.preventDefault(), void this.close(e);
                                if (e.keyCode === t.ui.keyCode.TAB) {
                                    var i = this.uiDialog.find(":tabbable"),
                                        s = i.filter(":first"),
                                        n = i.filter(":last");
                                    e.target !== n[0] && e.target !== this.uiDialog[0] || e.shiftKey ? e.target !== s[0] && e.target !== this.uiDialog[0] || !e.shiftKey || (n.focus(1), e.preventDefault()) : (s.focus(1), e.preventDefault())
                                }
                            },
                            mousedown: function(t) {
                                this._moveToTop(t) && this._focusTabbable()
                            }
                        }), this.element.find("[aria-describedby]").length || this.uiDialog.attr({
                            "aria-describedby": this.element.uniqueId().attr("id")
                        })
                    },
                    _createTitlebar: function() {
                        var e;
                        this.uiDialogTitlebar = t("<div>").addClass("ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix").prependTo(this.uiDialog), this._on(this.uiDialogTitlebar, {
                            mousedown: function(e) {
                                t(e.target).closest(".ui-dialog-titlebar-close") || this.uiDialog.focus()
                            }
                        }), this.uiDialogTitlebarClose = t("<button></button>").button({
                            label: this.options.closeText,
                            icons: {
                                primary: "ui-icon-closethick"
                            },
                            text: !1
                        }).addClass("ui-dialog-titlebar-close").appendTo(this.uiDialogTitlebar), this._on(this.uiDialogTitlebarClose, {
                            click: function(t) {
                                t.preventDefault(), this.close(t)
                            }
                        }), e = t("<span>").uniqueId().addClass("ui-dialog-title").prependTo(this.uiDialogTitlebar), this._title(e), this.uiDialog.attr({
                            "aria-labelledby": e.attr("id")
                        })
                    },
                    _title: function(t) {
                        this.options.title || t.html("&#160;"), t.text(this.options.title)
                    },
                    _createButtonPane: function() {
                        this.uiDialogButtonPane = t("<div>").addClass("ui-dialog-buttonpane ui-widget-content ui-helper-clearfix"), this.uiButtonSet = t("<div>").addClass("ui-dialog-buttonset").appendTo(this.uiDialogButtonPane), this._createButtons()
                    },
                    _createButtons: function() {
                        var e = this,
                            i = this.options.buttons;
                        this.uiDialogButtonPane.remove(), this.uiButtonSet.empty(), t.isEmptyObject(i) || t.isArray(i) && !i.length ? this.uiDialog.removeClass("ui-dialog-buttons") : (t.each(i, (function(i, s) {
                            var n, o;
                            s = t.isFunction(s) ? {
                                click: s,
                                text: i
                            } : s, s = t.extend({
                                type: "button"
                            }, s), n = s.click, s.click = function() {
                                n.apply(e.element[0], arguments)
                            }, o = {
                                icons: s.icons,
                                text: s.showText
                            }, delete s.icons, delete s.showText, t("<button></button>", s).button(o).appendTo(e.uiButtonSet)
                        })), this.uiDialog.addClass("ui-dialog-buttons"), this.uiDialogButtonPane.appendTo(this.uiDialog))
                    },
                    _makeDraggable: function() {
                        var e = this,
                            i = this.options;

                        function s(t) {
                            return {
                                position: t.position,
                                offset: t.offset
                            }
                        }
                        this.uiDialog.draggable({
                            cancel: ".ui-dialog-content, .ui-dialog-titlebar-close",
                            handle: ".ui-dialog-titlebar",
                            containment: "document",
                            start: function(i, n) {
                                t(this).addClass("ui-dialog-dragging"), e._blockFrames(), e._trigger("dragStart", i, s(n))
                            },
                            drag: function(t, i) {
                                e._trigger("drag", t, s(i))
                            },
                            stop: function(n, o) {
                                i.position = [o.position.left - e.document.scrollLeft(), o.position.top - e.document.scrollTop()], t(this).removeClass("ui-dialog-dragging"), e._unblockFrames(), e._trigger("dragStop", n, s(o))
                            }
                        })
                    },
                    _makeResizable: function() {
                        var e = this,
                            i = this.options,
                            s = i.resizable,
                            n = this.uiDialog.css("position"),
                            o = "string" == typeof s ? s : "n,e,s,w,se,sw,ne,nw";

                        function a(t) {
                            return {
                                originalPosition: t.originalPosition,
                                originalSize: t.originalSize,
                                position: t.position,
                                size: t.size
                            }
                        }
                        this.uiDialog.resizable({
                            cancel: ".ui-dialog-content",
                            containment: "document",
                            alsoResize: this.element,
                            maxWidth: i.maxWidth,
                            maxHeight: i.maxHeight,
                            minWidth: i.minWidth,
                            minHeight: this._minHeight(),
                            handles: o,
                            start: function(i, s) {
                                t(this).addClass("ui-dialog-resizing"), e._blockFrames(), e._trigger("resizeStart", i, a(s))
                            },
                            resize: function(t, i) {
                                e._trigger("resize", t, a(i))
                            },
                            stop: function(s, n) {
                                i.height = t(this).height(), i.width = t(this).width(), t(this).removeClass("ui-dialog-resizing"), e._unblockFrames(), e._trigger("resizeStop", s, a(n))
                            }
                        }).css("position", n)
                    },
                    _minHeight: function() {
                        var t = this.options;
                        return "auto" === t.height ? t.minHeight : Math.min(t.minHeight, t.height)
                    },
                    _position: function() {
                        var t = this.uiDialog.is(":visible");
                        t || this.uiDialog.show(), this.uiDialog.position(this.options.position), t || this.uiDialog.hide()
                    },
                    _setOptions: function(e) {
                        var i = this,
                            o = !1,
                            a = {};
                        t.each(e, (function(t, e) {
                            i._setOption(t, e), t in s && (o = !0), t in n && (a[t] = e)
                        })), o && (this._size(), this._position()), this.uiDialog.is(":data(ui-resizable)") && this.uiDialog.resizable("option", a)
                    },
                    _setOption: function(t, e) {
                        var i, s, n = this.uiDialog;
                        "dialogClass" === t && n.removeClass(this.options.dialogClass).addClass(e), "disabled" !== t && (this._super(t, e), "appendTo" === t && this.uiDialog.appendTo(this._appendTo()), "buttons" === t && this._createButtons(), "closeText" === t && this.uiDialogTitlebarClose.button({
                            label: "" + e
                        }), "draggable" === t && ((i = n.is(":data(ui-draggable)")) && !e && n.draggable("destroy"), !i && e && this._makeDraggable()), "position" === t && this._position(), "resizable" === t && ((s = n.is(":data(ui-resizable)")) && !e && n.resizable("destroy"), s && "string" == typeof e && n.resizable("option", "handles", e), s || !1 === e || this._makeResizable()), "title" === t && this._title(this.uiDialogTitlebar.find(".ui-dialog-title")))
                    },
                    _size: function() {
                        var t, e, i, s = this.options;
                        this.element.show().css({
                            width: "auto",
                            minHeight: 0,
                            maxHeight: "none",
                            height: 0
                        }), s.minWidth > s.width && (s.width = s.minWidth), t = this.uiDialog.css({
                            height: "auto",
                            width: s.width
                        }).outerHeight(), e = Math.max(0, s.minHeight - t), i = "number" == typeof s.maxHeight ? Math.max(0, s.maxHeight - t) : "none", "auto" === s.height ? this.element.css({
                            minHeight: e,
                            maxHeight: i,
                            height: "auto"
                        }) : this.element.height(Math.max(0, s.height - t)), this.uiDialog.is(":data(ui-resizable)") && this.uiDialog.resizable("option", "minHeight", this._minHeight())
                    },
                    _blockFrames: function() {
                        this.iframeBlocks = this.document.find("iframe").map((function() {
                            var e = t(this);
                            return t("<div>").css({
                                position: "absolute",
                                width: e.outerWidth(),
                                height: e.outerHeight()
                            }).appendTo(e.parent()).offset(e.offset())[0]
                        }))
                    },
                    _unblockFrames: function() {
                        this.iframeBlocks && (this.iframeBlocks.remove(), delete this.iframeBlocks)
                    },
                    _allowInteraction: function(e) {
                        return !!t(e.target).closest(".ui-dialog").length || !!t(e.target).closest(".ui-datepicker").length
                    },
                    _createOverlay: function() {
                        if (this.options.modal) {
                            var e = this,
                                i = this.widgetFullName;
                            t.ui.dialog.overlayInstances || this._delay((function() {
                                t.ui.dialog.overlayInstances && this.document.bind("focusin.dialog", (function(s) {
                                    e._allowInteraction(s) || (s.preventDefault(), t(".ui-dialog:visible:last .ui-dialog-content").data(i)._focusTabbable())
                                }))
                            })), this.overlay = t("<div>").addClass("ui-widget-overlay ui-front").appendTo(this._appendTo()), this._on(this.overlay, {
                                mousedown: "_keepFocus"
                            }), t.ui.dialog.overlayInstances++
                        }
                    },
                    _destroyOverlay: function() {
                        this.options.modal && this.overlay && (t.ui.dialog.overlayInstances--, t.ui.dialog.overlayInstances || this.document.unbind("focusin.dialog"), this.overlay.remove(), this.overlay = null)
                    }
                }), t.ui.dialog.overlayInstances = 0, !1 !== t.uiBackCompat && t.widget("ui.dialog", t.ui.dialog, {
                    _position: function() {
                        var e, s = this.options.position,
                            n = [],
                            o = [0, 0];
                        s ? (("string" == typeof s || "object" === i(s) && "0" in s) && (1 === (n = s.split ? s.split(" ") : [s[0], s[1]]).length && (n[1] = n[0]), t.each(["left", "top"], (function(t, e) {
                            +n[t] === n[t] && (o[t] = n[t], n[t] = e)
                        })), s = {
                            my: n[0] + (o[0] < 0 ? o[0] : "+" + o[0]) + " " + n[1] + (o[1] < 0 ? o[1] : "+" + o[1]),
                            at: n.join(" ")
                        }), s = t.extend({}, t.ui.dialog.prototype.options.position, s)) : s = t.ui.dialog.prototype.options.position, (e = this.uiDialog.is(":visible")) || this.uiDialog.show(), this.uiDialog.position(s), e || this.uiDialog.hide()
                    }
                })
            }(jQuery);
            function(t, e) {
                t.widget("ui.menu", {
                    version: "1.10.3",
                    defaultElement: "<ul>",
                    delay: 300,
                    options: {
                        icons: {
                            submenu: "ui-icon-carat-1-e"
                        },
                        menus: "ul",
                        position: {
                            my: "left top",
                            at: "right top"
                        },
                        role: "menu",
                        blur: null,
                        focus: null,
                        select: null
                    },
                    _create: function() {
                        this.activeMenu = this.element, this.mouseHandled = !1, this.element.uniqueId().addClass("ui-menu ui-widget ui-widget-content ui-corner-all").toggleClass("ui-menu-icons", !!this.element.find(".ui-icon").length).attr({
                            role: this.options.role,
                            tabIndex: 0
                        }).bind("click" + this.eventNamespace, t.proxy((function(t) {
                            this.options.disabled && t.preventDefault()
                        }), this)), this.options.disabled && this.element.addClass("ui-state-disabled").attr("aria-disabled", "true"), this._on({
                            "mousedown .ui-menu-item > a": function(t) {
                                t.preventDefault()
                            },
                            "click .ui-state-disabled > a": function(t) {
                                t.preventDefault()
                            },
                            "click .ui-menu-item:has(a)": function(e) {
                                var i = t(e.target).closest(".ui-menu-item");
                                !this.mouseHandled && i.not(".ui-state-disabled").length && (this.mouseHandled = !0, this.select(e), i.has(".ui-menu").length ? this.expand(e) : this.element.is(":focus") || (this.element.trigger("focus", [!0]), this.active && 1 === this.active.parents(".ui-menu").length && clearTimeout(this.timer)))
                            },
                            "mouseenter .ui-menu-item": function(e) {
                                var i = t(e.currentTarget);
                                i.siblings().children(".ui-state-active").removeClass("ui-state-active"), this.focus(e, i)
                            },
                            mouseleave: "collapseAll",
                            "mouseleave .ui-menu": "collapseAll",
                            focus: function(t, e) {
                                var i = this.active || this.element.children(".ui-menu-item").eq(0);
                                e || this.focus(t, i)
                            },
                            blur: function(e) {
                                this._delay((function() {
                                    t.contains(this.element[0], this.document[0].activeElement) || this.collapseAll(e)
                                }))
                            },
                            keydown: "_keydown"
                        }), this.refresh(), this._on(this.document, {
                            click: function(e) {
                                t(e.target).closest(".ui-menu").length || this.collapseAll(e), this.mouseHandled = !1
                            }
                        })
                    },
                    _destroy: function() {
                        this.element.removeAttr("aria-activedescendant").find(".ui-menu").addBack().removeClass("ui-menu ui-widget ui-widget-content ui-corner-all ui-menu-icons").removeAttr("role").removeAttr("tabIndex").removeAttr("aria-labelledby").removeAttr("aria-expanded").removeAttr("aria-hidden").removeAttr("aria-disabled").removeUniqueId().show(), this.element.find(".ui-menu-item").removeClass("ui-menu-item").removeAttr("role").removeAttr("aria-disabled").children("a").removeUniqueId().removeClass("ui-corner-all ui-state-hover").removeAttr("tabIndex").removeAttr("role").removeAttr("aria-haspopup").children().each((function() {
                            var e = t(this);
                            e.data("ui-menu-submenu-carat") && e.remove()
                        })), this.element.find(".ui-menu-divider").removeClass("ui-menu-divider ui-widget-content")
                    },
                    _keydown: function(e) {
                        var i, s, n, o, a, r = !0;

                        function l(t) {
                            return t.replace(/[\-\[\]{}()*+?.,\\\^$|#\s]/g, "\\$&")
                        }
                        switch (e.keyCode) {
                            case t.ui.keyCode.PAGE_UP:
                                this.previousPage(e);
                                break;
                            case t.ui.keyCode.PAGE_DOWN:
                                this.nextPage(e);
                                break;
                            case t.ui.keyCode.HOME:
                                this._move("first", "first", e);
                                break;
                            case t.ui.keyCode.END:
                                this._move("last", "last", e);
                                break;
                            case t.ui.keyCode.UP:
                                this.previous(e);
                                break;
                            case t.ui.keyCode.DOWN:
                                this.next(e);
                                break;
                            case t.ui.keyCode.LEFT:
                                this.collapse(e);
                                break;
                            case t.ui.keyCode.RIGHT:
                                this.active && !this.active.is(".ui-state-disabled") && this.expand(e);
                                break;
                            case t.ui.keyCode.ENTER:
                            case t.ui.keyCode.SPACE:
                                this._activate(e);
                                break;
                            case t.ui.keyCode.ESCAPE:
                                this.collapse(e);
                                break;
                            default:
                                r = !1, s = this.previousFilter || "", n = String.fromCharCode(e.keyCode), o = !1, clearTimeout(this.filterTimer), n === s ? o = !0 : n = s + n, a = new RegExp("^" + l(n), "i"), i = this.activeMenu.children(".ui-menu-item").filter((function() {
                                    return a.test(t(this).children("a").text())
                                })), (i = o && -1 !== i.index(this.active.next()) ? this.active.nextAll(".ui-menu-item") : i).length || (n = String.fromCharCode(e.keyCode), a = new RegExp("^" + l(n), "i"), i = this.activeMenu.children(".ui-menu-item").filter((function() {
                                    return a.test(t(this).children("a").text())
                                }))), i.length ? (this.focus(e, i), i.length > 1 ? (this.previousFilter = n, this.filterTimer = this._delay((function() {
                                    delete this.previousFilter
                                }), 1e3)) : delete this.previousFilter) : delete this.previousFilter
                        }
                        r && e.preventDefault()
                    },
                    _activate: function(t) {
                        this.active.is(".ui-state-disabled") || (this.active.children("a[aria-haspopup='true']").length ? this.expand(t) : this.select(t))
                    },
                    refresh: function() {
                        var e, i = this.options.icons.submenu,
                            s = this.element.find(this.options.menus);
                        s.filter(":not(.ui-menu)").addClass("ui-menu ui-widget ui-widget-content ui-corner-all").hide().attr({
                            role: this.options.role,
                            "aria-hidden": "true",
                            "aria-expanded": "false"
                        }).each((function() {
                            var e = t(this),
                                s = e.prev("a"),
                                n = t("<span>").addClass("ui-menu-icon ui-icon " + i).data("ui-menu-submenu-carat", !0);
                            s.attr("aria-haspopup", "true").prepend(n), e.attr("aria-labelledby", s.attr("id"))
                        })), (e = s.add(this.element)).children(":not(.ui-menu-item):has(a)").addClass("ui-menu-item").attr("role", "presentation").children("a").uniqueId().addClass("ui-corner-all").attr({
                            tabIndex: -1,
                            role: this._itemRole()
                        }), e.children(":not(.ui-menu-item)").each((function() {
                            var e = t(this);
                            /[^\-\u2014\u2013\s]/.test(e.text()) || e.addClass("ui-widget-content ui-menu-divider")
                        })), e.children(".ui-state-disabled").attr("aria-disabled", "true"), this.active && !t.contains(this.element[0], this.active[0]) && this.blur()
                    },
                    _itemRole: function() {
                        return {
                            menu: "menuitem",
                            listbox: "option"
                        } [this.options.role]
                    },
                    _setOption: function(t, e) {
                        "icons" === t && this.element.find(".ui-menu-icon").removeClass(this.options.icons.submenu).addClass(e.submenu), this._super(t, e)
                    },
                    focus: function(t, e) {
                        var i, s;
                        this.blur(t, t && "focus" === t.type), this._scrollIntoView(e), this.active = e.first(), s = this.active.children("a").addClass("ui-state-focus"), this.options.role && this.element.attr("aria-activedescendant", s.attr("id")), this.active.parent().closest(".ui-menu-item").children("a:first").addClass("ui-state-active"), t && "keydown" === t.type ? this._close() : this.timer = this._delay((function() {
                            this._close()
                        }), this.delay), (i = e.children(".ui-menu")).length && /^mouse/.test(t.type) && this._startOpening(i), this.activeMenu = e.parent(), this._trigger("focus", t, {
                            item: e
                        })
                    },
                    _scrollIntoView: function(e) {
                        var i, s, n, o, a, r;
                        this._hasScroll() && (i = parseFloat(t.css(this.activeMenu[0], "borderTopWidth")) || 0, s = parseFloat(t.css(this.activeMenu[0], "paddingTop")) || 0, n = e.offset().top - this.activeMenu.offset().top - i - s, o = this.activeMenu.scrollTop(), a = this.activeMenu.height(), r = e.height(), n < 0 ? this.activeMenu.scrollTop(o + n) : n + r > a && this.activeMenu.scrollTop(o + n - a + r))
                    },
                    blur: function(t, e) {
                        e || clearTimeout(this.timer), this.active && (this.active.children("a").removeClass("ui-state-focus"), this.active = null, this._trigger("blur", t, {
                            item: this.active
                        }))
                    },
                    _startOpening: function(t) {
                        clearTimeout(this.timer), "true" === t.attr("aria-hidden") && (this.timer = this._delay((function() {
                            this._close(), this._open(t)
                        }), this.delay))
                    },
                    _open: function(e) {
                        var i = t.extend({
                            of: this.active
                        }, this.options.position);
                        clearTimeout(this.timer), this.element.find(".ui-menu").not(e.parents(".ui-menu")).hide().attr("aria-hidden", "true"), e.show().removeAttr("aria-hidden").attr("aria-expanded", "true").position(i)
                    },
                    collapseAll: function(e, i) {
                        clearTimeout(this.timer), this.timer = this._delay((function() {
                            var s = i ? this.element : t(e && e.target).closest(this.element.find(".ui-menu"));
                            s.length || (s = this.element), this._close(s), this.blur(e), this.activeMenu = s
                        }), this.delay)
                    },
                    _close: function(t) {
                        t || (t = this.active ? this.active.parent() : this.element), t.find(".ui-menu").hide().attr("aria-hidden", "true").attr("aria-expanded", "false").end().find("a.ui-state-active").removeClass("ui-state-active")
                    },
                    collapse: function(t) {
                        var e = this.active && this.active.parent().closest(".ui-menu-item", this.element);
                        e && e.length && (this._close(), this.focus(t, e))
                    },
                    expand: function(t) {
                        var e = this.active && this.active.children(".ui-menu ").children(".ui-menu-item").first();
                        e && e.length && (this._open(e.parent()), this._delay((function() {
                            this.focus(t, e)
                        })))
                    },
                    next: function(t) {
                        this._move("next", "first", t)
                    },
                    previous: function(t) {
                        this._move("prev", "last", t)
                    },
                    isFirstItem: function() {
                        return this.active && !this.active.prevAll(".ui-menu-item").length
                    },
                    isLastItem: function() {
                        return this.active && !this.active.nextAll(".ui-menu-item").length
                    },
                    _move: function(t, e, i) {
                        var s;
                        this.active && (s = "first" === t || "last" === t ? this.active["first" === t ? "prevAll" : "nextAll"](".ui-menu-item").eq(-1) : this.active[t + "All"](".ui-menu-item").eq(0)), s && s.length && this.active || (s = this.activeMenu.children(".ui-menu-item")[e]()), this.focus(i, s)
                    },
                    nextPage: function(e) {
                        var i, s, n;
                        this.active ? this.isLastItem() || (this._hasScroll() ? (s = this.active.offset().top, n = this.element.height(), this.active.nextAll(".ui-menu-item").each((function() {
                            return (i = t(this)).offset().top - s - n < 0
                        })), this.focus(e, i)) : this.focus(e, this.activeMenu.children(".ui-menu-item")[this.active ? "last" : "first"]())) : this.next(e)
                    },
                    previousPage: function(e) {
                        var i, s, n;
                        this.active ? this.isFirstItem() || (this._hasScroll() ? (s = this.active.offset().top, n = this.element.height(), this.active.prevAll(".ui-menu-item").each((function() {
                            return (i = t(this)).offset().top - s + n > 0
                        })), this.focus(e, i)) : this.focus(e, this.activeMenu.children(".ui-menu-item").first())) : this.next(e)
                    },
                    _hasScroll: function() {
                        return this.element.outerHeight() < this.element.prop("scrollHeight")
                    },
                    select: function(e) {
                        this.active = this.active || t(e.target).closest(".ui-menu-item");
                        var i = {
                            item: this.active
                        };
                        this.active.has(".ui-menu").length || this.collapseAll(e, !0), this._trigger("select", e, i)
                    }
                })
            }(jQuery);
            function(t, e) {
                t.widget("ui.progressbar", {
                    version: "1.10.3",
                    options: {
                        max: 100,
                        value: 0,
                        change: null,
                        complete: null
                    },
                    min: 0,
                    _create: function() {
                        this.oldValue = this.options.value = this._constrainedValue(), this.element.addClass("ui-progressbar ui-widget ui-widget-content ui-corner-all").attr({
                            role: "progressbar",
                            "aria-valuemin": this.min
                        }), this.valueDiv = t("<div class='ui-progressbar-value ui-widget-header ui-corner-left'></div>").appendTo(this.element), this._refreshValue()
                    },
                    _destroy: function() {
                        this.element.removeClass("ui-progressbar ui-widget ui-widget-content ui-corner-all").removeAttr("role").removeAttr("aria-valuemin").removeAttr("aria-valuemax").removeAttr("aria-valuenow"), this.valueDiv.remove()
                    },
                    value: function(t) {
                        if (void 0 === t) return this.options.value;
                        this.options.value = this._constrainedValue(t), this._refreshValue()
                    },
                    _constrainedValue: function(t) {
                        return void 0 === t && (t = this.options.value), this.indeterminate = !1 === t, "number" != typeof t && (t = 0), !this.indeterminate && Math.min(this.options.max, Math.max(this.min, t))
                    },
                    _setOptions: function(t) {
                        var e = t.value;
                        delete t.value, this._super(t), this.options.value = this._constrainedValue(e), this._refreshValue()
                    },
                    _setOption: function(t, e) {
                        "max" === t && (e = Math.max(this.min, e)), this._super(t, e)
                    },
                    _percentage: function() {
                        return this.indeterminate ? 100 : 100 * (this.options.value - this.min) / (this.options.max - this.min)
                    },
                    _refreshValue: function() {
                        var e = this.options.value,
                            i = this._percentage();
                        this.valueDiv.toggle(this.indeterminate || e > this.min).toggleClass("ui-corner-right", e === this.options.max).width(i.toFixed(0) + "%"), this.element.toggleClass("ui-progressbar-indeterminate", this.indeterminate), this.indeterminate ? (this.element.removeAttr("aria-valuenow"), this.overlayDiv || (this.overlayDiv = t("<div class='ui-progressbar-overlay'></div>").appendTo(this.valueDiv))) : (this.element.attr({
                            "aria-valuemax": this.options.max,
                            "aria-valuenow": e
                        }), this.overlayDiv && (this.overlayDiv.remove(), this.overlayDiv = null)), this.oldValue !== e && (this.oldValue = e, this._trigger("change")), e === this.options.max && this._trigger("complete")
                    }
                })
            }(jQuery);
            function(t, e) {
                t.widget("ui.slider", t.ui.mouse, {
                    version: "1.10.3",
                    widgetEventPrefix: "slide",
                    options: {
                        animate: !1,
                        distance: 0,
                        max: 100,
                        min: 0,
                        orientation: "horizontal",
                        range: !1,
                        step: 1,
                        value: 0,
                        values: null,
                        change: null,
                        slide: null,
                        start: null,
                        stop: null
                    },
                    _create: function() {
                        this._keySliding = !1, this._mouseSliding = !1, this._animateOff = !0, this._handleIndex = null, this._detectOrientation(), this._mouseInit(), this.element.addClass("ui-slider ui-slider-" + this.orientation + " ui-widget ui-widget-content ui-corner-all"), this._refresh(), this._setOption("disabled", this.options.disabled), this._animateOff = !1
                    },
                    _refresh: function() {
                        this._createRange(), this._createHandles(), this._setupEvents(), this._refreshValue()
                    },
                    _createHandles: function() {
                        var e, i, s = this.options,
                            n = this.element.find(".ui-slider-handle").addClass("ui-state-default ui-corner-all"),
                            o = [];
                        for (i = s.values && s.values.length || 1, n.length > i && (n.slice(i).remove(), n = n.slice(0, i)), e = n.length; e < i; e++) o.push("<a class='ui-slider-handle ui-state-default ui-corner-all' href='#'></a>");
                        this.handles = n.add(t(o.join("")).appendTo(this.element)), this.handle = this.handles.eq(0), this.handles.each((function(e) {
                            t(this).data("ui-slider-handle-index", e)
                        }))
                    },
                    _createRange: function() {
                        var e = this.options,
                            i = "";
                        e.range ? (!0 === e.range && (e.values ? e.values.length && 2 !== e.values.length ? e.values = [e.values[0], e.values[0]] : t.isArray(e.values) && (e.values = e.values.slice(0)) : e.values = [this._valueMin(), this._valueMin()]), this.range && this.range.length ? this.range.removeClass("ui-slider-range-min ui-slider-range-max").css({
                            left: "",
                            bottom: ""
                        }) : (this.range = t("<div></div>").appendTo(this.element), i = "ui-slider-range ui-widget-header ui-corner-all"), this.range.addClass(i + ("min" === e.range || "max" === e.range ? " ui-slider-range-" + e.range : ""))) : this.range = t([])
                    },
                    _setupEvents: function() {
                        var t = this.handles.add(this.range).filter("a");
                        this._off(t), this._on(t, this._handleEvents), this._hoverable(t), this._focusable(t)
                    },
                    _destroy: function() {
                        this.handles.remove(), this.range.remove(), this.element.removeClass("ui-slider ui-slider-horizontal ui-slider-vertical ui-widget ui-widget-content ui-corner-all"), this._mouseDestroy()
                    },
                    _mouseCapture: function(e) {
                        var i, s, n, o, a, r, l, h = this,
                            c = this.options;
                        return !c.disabled && (this.elementSize = {
                            width: this.element.outerWidth(),
                            height: this.element.outerHeight()
                        }, this.elementOffset = this.element.offset(), i = {
                            x: e.pageX,
                            y: e.pageY
                        }, s = this._normValueFromMouse(i), n = this._valueMax() - this._valueMin() + 1, this.handles.each((function(e) {
                            var i = Math.abs(s - h.values(e));
                            (n > i || n === i && (e === h._lastChangedValue || h.values(e) === c.min)) && (n = i, o = t(this), a = e)
                        })), !1 !== this._start(e, a) && (this._mouseSliding = !0, this._handleIndex = a, o.addClass("ui-state-active").focus(), r = o.offset(), l = !t(e.target).parents().addBack().is(".ui-slider-handle"), this._clickOffset = l ? {
                            left: 0,
                            top: 0
                        } : {
                            left: e.pageX - r.left - o.width() / 2,
                            top: e.pageY - r.top - o.height() / 2 - (parseInt(o.css("borderTopWidth"), 10) || 0) - (parseInt(o.css("borderBottomWidth"), 10) || 0) + (parseInt(o.css("marginTop"), 10) || 0)
                        }, this.handles.hasClass("ui-state-hover") || this._slide(e, a, s), this._animateOff = !0, !0))
                    },
                    _mouseStart: function() {
                        return !0
                    },
                    _mouseDrag: function(t) {
                        var e = {
                                x: t.pageX,
                                y: t.pageY
                            },
                            i = this._normValueFromMouse(e);
                        return this._slide(t, this._handleIndex, i), !1
                    },
                    _mouseStop: function(t) {
                        return this.handles.removeClass("ui-state-active"), this._mouseSliding = !1, this._stop(t, this._handleIndex), this._change(t, this._handleIndex), this._handleIndex = null, this._clickOffset = null, this._animateOff = !1, !1
                    },
                    _detectOrientation: function() {
                        this.orientation = "vertical" === this.options.orientation ? "vertical" : "horizontal"
                    },
                    _normValueFromMouse: function(t) {
                        var e, i, s, n, o;
                        return "horizontal" === this.orientation ? (e = this.elementSize.width, i = t.x - this.elementOffset.left - (this._clickOffset ? this._clickOffset.left : 0)) : (e = this.elementSize.height, i = t.y - this.elementOffset.top - (this._clickOffset ? this._clickOffset.top : 0)), (s = i / e) > 1 && (s = 1), s < 0 && (s = 0), "vertical" === this.orientation && (s = 1 - s), n = this._valueMax() - this._valueMin(), o = this._valueMin() + s * n, this._trimAlignValue(o)
                    },
                    _start: function(t, e) {
                        var i = {
                            handle: this.handles[e],
                            value: this.value()
                        };
                        return this.options.values && this.options.values.length && (i.value = this.values(e), i.values = this.values()), this._trigger("start", t, i)
                    },
                    _slide: function(t, e, i) {
                        var s, n, o;
                        this.options.values && this.options.values.length ? (s = this.values(e ? 0 : 1), 2 === this.options.values.length && !0 === this.options.range && (0 === e && i > s || 1 === e && i < s) && (i = s), i !== this.values(e) && ((n = this.values())[e] = i, o = this._trigger("slide", t, {
                            handle: this.handles[e],
                            value: i,
                            values: n
                        }), s = this.values(e ? 0 : 1), !1 !== o && this.values(e, i, !0))) : i !== this.value() && !1 !== (o = this._trigger("slide", t, {
                            handle: this.handles[e],
                            value: i
                        })) && this.value(i)
                    },
                    _stop: function(t, e) {
                        var i = {
                            handle: this.handles[e],
                            value: this.value()
                        };
                        this.options.values && this.options.values.length && (i.value = this.values(e), i.values = this.values()), this._trigger("stop", t, i)
                    },
                    _change: function(t, e) {
                        if (!this._keySliding && !this._mouseSliding) {
                            var i = {
                                handle: this.handles[e],
                                value: this.value()
                            };
                            this.options.values && this.options.values.length && (i.value = this.values(e), i.values = this.values()), this._lastChangedValue = e, this._trigger("change", t, i)
                        }
                    },
                    value: function(t) {
                        return arguments.length ? (this.options.value = this._trimAlignValue(t), this._refreshValue(), void this._change(null, 0)) : this._value()
                    },
                    values: function(e, i) {
                        var s, n, o;
                        if (arguments.length > 1) return this.options.values[e] = this._trimAlignValue(i), this._refreshValue(), void this._change(null, e);
                        if (!arguments.length) return this._values();
                        if (!t.isArray(arguments[0])) return this.options.values && this.options.values.length ? this._values(e) : this.value();
                        for (s = this.options.values, n = arguments[0], o = 0; o < s.length; o += 1) s[o] = this._trimAlignValue(n[o]), this._change(null, o);
                        this._refreshValue()
                    },
                    _setOption: function(e, i) {
                        var s, n = 0;
                        switch ("range" === e && !0 === this.options.range && ("min" === i ? (this.options.value = this._values(0), this.options.values = null) : "max" === i && (this.options.value = this._values(this.options.values.length - 1), this.options.values = null)), t.isArray(this.options.values) && (n = this.options.values.length), t.Widget.prototype._setOption.apply(this, arguments), e) {
                            case "orientation":
                                this._detectOrientation(), this.element.removeClass("ui-slider-horizontal ui-slider-vertical").addClass("ui-slider-" + this.orientation), this._refreshValue();
                                break;
                            case "value":
                                this._animateOff = !0, this._refreshValue(), this._change(null, 0), this._animateOff = !1;
                                break;
                            case "values":
                                for (this._animateOff = !0, this._refreshValue(), s = 0; s < n; s += 1) this._change(null, s);
                                this._animateOff = !1;
                                break;
                            case "min":
                            case "max":
                                this._animateOff = !0, this._refreshValue(), this._animateOff = !1;
                                break;
                            case "range":
                                this._animateOff = !0, this._refresh(), this._animateOff = !1
                        }
                    },
                    _value: function() {
                        var t = this.options.value;
                        return t = this._trimAlignValue(t)
                    },
                    _values: function(t) {
                        var e, i, s;
                        if (arguments.length) return e = this.options.values[t], e = this._trimAlignValue(e);
                        if (this.options.values && this.options.values.length) {
                            for (i = this.options.values.slice(), s = 0; s < i.length; s += 1) i[s] = this._trimAlignValue(i[s]);
                            return i
                        }
                        return []
                    },
                    _trimAlignValue: function(t) {
                        if (t <= this._valueMin()) return this._valueMin();
                        if (t >= this._valueMax()) return this._valueMax();
                        var e = this.options.step > 0 ? this.options.step : 1,
                            i = (t - this._valueMin()) % e,
                            s = t - i;
                        return 2 * Math.abs(i) >= e && (s += i > 0 ? e : -e), parseFloat(s.toFixed(5))
                    },
                    _valueMin: function() {
                        return this.options.min
                    },
                    _valueMax: function() {
                        return this.options.max
                    },
                    _refreshValue: function() {
                        var e, i, s, n, o, a = this.options.range,
                            r = this.options,
                            l = this,
                            h = !this._animateOff && r.animate,
                            c = {};
                        this.options.values && this.options.values.length ? this.handles.each((function(s) {
                            i = (l.values(s) - l._valueMin()) / (l._valueMax() - l._valueMin()) * 100, c["horizontal" === l.orientation ? "left" : "bottom"] = i + "%", t(this).stop(1, 1)[h ? "animate" : "css"](c, r.animate), !0 === l.options.range && ("horizontal" === l.orientation ? (0 === s && l.range.stop(1, 1)[h ? "animate" : "css"]({
                                left: i + "%"
                            }, r.animate), 1 === s && l.range[h ? "animate" : "css"]({
                                width: i - e + "%"
                            }, {
                                queue: !1,
                                duration: r.animate
                            })) : (0 === s && l.range.stop(1, 1)[h ? "animate" : "css"]({
                                bottom: i + "%"
                            }, r.animate), 1 === s && l.range[h ? "animate" : "css"]({
                                height: i - e + "%"
                            }, {
                                queue: !1,
                                duration: r.animate
                            }))), e = i
                        })) : (s = this.value(), n = this._valueMin(), o = this._valueMax(), i = o !== n ? (s - n) / (o - n) * 100 : 0, c["horizontal" === this.orientation ? "left" : "bottom"] = i + "%", this.handle.stop(1, 1)[h ? "animate" : "css"](c, r.animate), "min" === a && "horizontal" === this.orientation && this.range.stop(1, 1)[h ? "animate" : "css"]({
                            width: i + "%"
                        }, r.animate), "max" === a && "horizontal" === this.orientation && this.range[h ? "animate" : "css"]({
                            width: 100 - i + "%"
                        }, {
                            queue: !1,
                            duration: r.animate
                        }), "min" === a && "vertical" === this.orientation && this.range.stop(1, 1)[h ? "animate" : "css"]({
                            height: i + "%"
                        }, r.animate), "max" === a && "vertical" === this.orientation && this.range[h ? "animate" : "css"]({
                            height: 100 - i + "%"
                        }, {
                            queue: !1,
                            duration: r.animate
                        }))
                    },
                    _handleEvents: {
                        keydown: function(e) {
                            var i, s, n, o = t(e.target).data("ui-slider-handle-index");
                            switch (e.keyCode) {
                                case t.ui.keyCode.HOME:
                                case t.ui.keyCode.END:
                                case t.ui.keyCode.PAGE_UP:
                                case t.ui.keyCode.PAGE_DOWN:
                                case t.ui.keyCode.UP:
                                case t.ui.keyCode.RIGHT:
                                case t.ui.keyCode.DOWN:
                                case t.ui.keyCode.LEFT:
                                    if (e.preventDefault(), !this._keySliding && (this._keySliding = !0, t(e.target).addClass("ui-state-active"), !1 === this._start(e, o))) return
                            }
                            switch (n = this.options.step, i = s = this.options.values && this.options.values.length ? this.values(o) : this.value(), e.keyCode) {
                                case t.ui.keyCode.HOME:
                                    s = this._valueMin();
                                    break;
                                case t.ui.keyCode.END:
                                    s = this._valueMax();
                                    break;
                                case t.ui.keyCode.PAGE_UP:
                                    s = this._trimAlignValue(i + (this._valueMax() - this._valueMin()) / 5);
                                    break;
                                case t.ui.keyCode.PAGE_DOWN:
                                    s = this._trimAlignValue(i - (this._valueMax() - this._valueMin()) / 5);
                                    break;
                                case t.ui.keyCode.UP:
                                case t.ui.keyCode.RIGHT:
                                    if (i === this._valueMax()) return;
                                    s = this._trimAlignValue(i + n);
                                    break;
                                case t.ui.keyCode.DOWN:
                                case t.ui.keyCode.LEFT:
                                    if (i === this._valueMin()) return;
                                    s = this._trimAlignValue(i - n)
                            }
                            this._slide(e, o, s)
                        },
                        click: function(t) {
                            t.preventDefault()
                        },
                        keyup: function(e) {
                            var i = t(e.target).data("ui-slider-handle-index");
                            this._keySliding && (this._keySliding = !1, this._stop(e, i), this._change(e, i), t(e.target).removeClass("ui-state-active"))
                        }
                    }
                })
            }(jQuery);