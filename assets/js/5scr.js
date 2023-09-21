!function (i) {
    "use strict";
    "function" == typeof define && define.amd ? define(["jquery"], i) : "undefined" != typeof exports ? module.exports = i(require("jquery")) : i(jQuery)
}(function (i) {
    "use strict";
    var e = window.Slick || {};
    (e = function () {
        var e = 0;
        return function (t, o) {
            var s, n = this;
            n.defaults = {
                accessibility: !0,
                adaptiveHeight: !1,
                appendArrows: i(t),
                appendDots: i(t),
                arrows: !0,
                asNavFor: null,
                prevArrow: '<button class="slick-prev" aria-label="Previous" type="button">Previous</button>',
                nextArrow: '<button class="slick-next" aria-label="Next" type="button">Next</button>',
                autoplay: !1,
                autoplaySpeed: 333,
                centerMode: !1,
                centerPadding: "50px",
                cssEase: "ease",
                customPaging: function (e, t) {
                    return i('<button type="button" />').text(t + 1)
                },
                dots: !1,
                dotsClass: "slick-dots",
                draggable: !0,
                easing: "linear",
                edgeFriction: .35,
                fade: !1,
                focusOnSelect: !1,
                focusOnChange: !1,
                infinite: !0,
                initialSlide: 0,
                lazyLoad: "ondemand",
                mobileFirst: !1,
                pauseOnHover: !0,
                pauseOnFocus: !0,
                pauseOnDotsHover: !1,
                respondTo: "window",
                responsive: null,
                rows: 1,
                rtl: !1,
                slide: "",
                slidesPerRow: 1,
                slidesToShow: 1,
                slidesToScroll: 1,
                speed: 500,
                swipe: !0,
                swipeToSlide: !1,
                touchMove: !0,
                touchThreshold: 5,
                useCSS: !0,
                useTransform: !0,
                variableWidth: !1,
                vertical: !1,
                verticalSwiping: !1,
                waitForAnimate: !0,
                zIndex: 1e3
            }, n.initials = {
                animating: !1,
                dragging: !1,
                autoPlayTimer: null,
                currentDirection: 0,
                currentLeft: null,
                currentSlide: 0,
                direction: 1,
                $dots: null,
                listWidth: null,
                listHeight: null,
                loadIndex: 0,
                $nextArrow: null,
                $prevArrow: null,
                scrolling: !1,
                slideCount: null,
                slideWidth: null,
                $slideTrack: null,
                $slides: null,
                sliding: !1,
                slideOffset: 0,
                swipeLeft: null,
                swiping: !1,
                $list: null,
                touchObject: {},
                transformsEnabled: !1,
                unslicked: !1
            }, i.extend(n, n.initials), n.activeBreakpoint = null, n.animType = null, n.animProp = null, n.breakpoints = [], n.breakpointSettings = [], n.cssTransitions = !1, n.focussed = !1, n.interrupted = !1, n.hidden = "hidden", n.paused = !0, n.positionProp = null, n.respondTo = null, n.rowCount = 1, n.shouldClick = !0, n.$slider = i(t), n.$slidesCache = null, n.transformType = null, n.transitionType = null, n.visibilityChange = "visibilitychange", n.windowWidth = 0, n.windowTimer = null, s = i(t).data("slick") || {}, n.options = i.extend({}, n.defaults, o, s), n.currentSlide = n.options.initialSlide, n.originalSettings = n.options, void 0 !== document.mozHidden ? (n.hidden = "mozHidden", n.visibilityChange = "mozvisibilitychange") : void 0 !== document.webkitHidden && (n.hidden = "webkitHidden", n.visibilityChange = "webkitvisibilitychange"), n.autoPlay = i.proxy(n.autoPlay, n), n.autoPlayClear = i.proxy(n.autoPlayClear, n), n.autoPlayIterator = i.proxy(n.autoPlayIterator, n), n.changeSlide = i.proxy(n.changeSlide, n), n.clickHandler = i.proxy(n.clickHandler, n), n.selectHandler = i.proxy(n.selectHandler, n), n.setPosition = i.proxy(n.setPosition, n), n.swipeHandler = i.proxy(n.swipeHandler, n), n.dragHandler = i.proxy(n.dragHandler, n), n.keyHandler = i.proxy(n.keyHandler, n), n.instanceUid = e++, n.htmlExpr = /^(?:\s*(<[\w\W]+>)[^>]*)$/, n.registerBreakpoints(), n.init(!0)
        }
    }()).prototype.activateADA = function () {
        this.$slideTrack.find(".slick-active").attr({"aria-hidden": "false"}).find("a, input, button, select").attr({tabindex: "0"})
    }, e.prototype.addSlide = e.prototype.slickAdd = function (e, t, o) {
        var s = this;
        if ("boolean" == typeof t) o = t, t = null; else if (t < 0 || t >= s.slideCount) return !1;
        s.unload(), "number" == typeof t ? 0 === t && 0 === s.$slides.length ? i(e).appendTo(s.$slideTrack) : o ? i(e).insertBefore(s.$slides.eq(t)) : i(e).insertAfter(s.$slides.eq(t)) : !0 === o ? i(e).prependTo(s.$slideTrack) : i(e).appendTo(s.$slideTrack), s.$slides = s.$slideTrack.children(this.options.slide), s.$slideTrack.children(this.options.slide).detach(), s.$slideTrack.append(s.$slides), s.$slides.each(function (e, t) {
            i(t).attr("data-slick-index", e)
        }), s.$slidesCache = s.$slides, s.reinit()
    }, e.prototype.animateHeight = function () {
        var i = this;
        if (1 === i.options.slidesToShow && !0 === i.options.adaptiveHeight && !1 === i.options.vertical) {
            var e = i.$slides.eq(i.currentSlide).outerHeight(!0);
            i.$list.animate({height: e}, i.options.speed)
        }
    }, e.prototype.animateSlide = function (e, t) {
        var o = {}, s = this;
        s.animateHeight(), !0 === s.options.rtl && !1 === s.options.vertical && (e = -e), !1 === s.transformsEnabled ? !1 === s.options.vertical ? s.$slideTrack.animate({left: e}, s.options.speed, s.options.easing, t) : s.$slideTrack.animate({top: e}, s.options.speed, s.options.easing, t) : !1 === s.cssTransitions ? (!0 === s.options.rtl && (s.currentLeft = -s.currentLeft), i({animStart: s.currentLeft}).animate({animStart: e}, {
            duration: s.options.speed,
            easing: s.options.easing,
            step: function (i) {
                i = Math.ceil(i), !1 === s.options.vertical ? (o[s.animType] = "translate(" + i + "px, 0px)", s.$slideTrack.css(o)) : (o[s.animType] = "translate(0px," + i + "px)", s.$slideTrack.css(o))
            },
            complete: function () {
                t && t.call()
            }
        })) : (s.applyTransition(), e = Math.ceil(e), !1 === s.options.vertical ? o[s.animType] = "translate3d(" + e + "px, 0px, 0px)" : o[s.animType] = "translate3d(0px," + e + "px, 0px)", s.$slideTrack.css(o), t && setTimeout(function () {
            s.disableTransition(), t.call()
        }, s.options.speed))
    }, e.prototype.getNavTarget = function () {
        var e = this, t = e.options.asNavFor;
        return t && null !== t && (t = i(t).not(e.$slider)), t
    }, e.prototype.asNavFor = function (e) {
        var t = this.getNavTarget();
        null !== t && "object" == typeof t && t.each(function () {
            var t = i(this).slick("getSlick");
            t.unslicked || t.slideHandler(e, !0)
        })
    }, e.prototype.applyTransition = function (i) {
        var e = this, t = {};
        !1 === e.options.fade ? t[e.transitionType] = e.transformType + " " + e.options.speed + "ms " + e.options.cssEase : t[e.transitionType] = "opacity " + e.options.speed + "ms " + e.options.cssEase, !1 === e.options.fade ? e.$slideTrack.css(t) : e.$slides.eq(i).css(t)
    }, e.prototype.autoPlay = function () {
        var i = this;
        i.autoPlayClear(), i.slideCount > i.options.slidesToShow && (i.autoPlayTimer = setInterval(i.autoPlayIterator, i.options.autoplaySpeed))
    }, e.prototype.autoPlayClear = function () {
        var i = this;
        i.autoPlayTimer && clearInterval(i.autoPlayTimer)
    }, e.prototype.autoPlayIterator = function () {
        var i = this, e = i.currentSlide + i.options.slidesToScroll;
        i.paused || i.interrupted || i.focussed || (!1 === i.options.infinite && (1 === i.direction && i.currentSlide + 1 === i.slideCount - 1 ? i.direction = 0 : 0 === i.direction && (e = i.currentSlide - i.options.slidesToScroll, i.currentSlide - 1 == 0 && (i.direction = 1))), i.slideHandler(e))
    }, e.prototype.buildArrows = function () {
        var e = this;
        !0 === e.options.arrows && (e.$prevArrow = i(e.options.prevArrow).addClass("slick-arrow"), e.$nextArrow = i(e.options.nextArrow).addClass("slick-arrow"), e.slideCount > e.options.slidesToShow ? (e.$prevArrow.removeClass("slick-hidden").removeAttr("aria-hidden tabindex"), e.$nextArrow.removeClass("slick-hidden").removeAttr("aria-hidden tabindex"), e.htmlExpr.test(e.options.prevArrow) && e.$prevArrow.prependTo(e.options.appendArrows), e.htmlExpr.test(e.options.nextArrow) && e.$nextArrow.appendTo(e.options.appendArrows), !0 !== e.options.infinite && e.$prevArrow.addClass("slick-disabled").attr("aria-disabled", "true")) : e.$prevArrow.add(e.$nextArrow).addClass("slick-hidden").attr({
            "aria-disabled": "true",
            tabindex: "-1"
        }))
    }, e.prototype.buildDots = function () {
        var e, t, o = this;
        if (!0 === o.options.dots) {
            for (o.$slider.addClass("slick-dotted"), t = i("<ul />").addClass(o.options.dotsClass), e = 0; e <= o.getDotCount(); e += 1) t.append(i("<li />").append(o.options.customPaging.call(this, o, e)));
            o.$dots = t.appendTo(o.options.appendDots), o.$dots.find("li").first().addClass("slick-active")
        }
    }, e.prototype.buildOut = function () {
        var e = this;
        e.$slides = e.$slider.children(e.options.slide + ":not(.slick-cloned)").addClass("slick-slide"), e.slideCount = e.$slides.length, e.$slides.each(function (e, t) {
            i(t).attr("data-slick-index", e).data("originalStyling", i(t).attr("style") || "")
        }), e.$slider.addClass("slick-slider"), e.$slideTrack = 0 === e.slideCount ? i('<div class="slick-track"/>').appendTo(e.$slider) : e.$slides.wrapAll('<div class="slick-track"/>').parent(), e.$list = e.$slideTrack.wrap('<div class="slick-list"/>').parent(), e.$slideTrack.css("opacity", 0), !0 !== e.options.centerMode && !0 !== e.options.swipeToSlide || (e.options.slidesToScroll = 1), i("img[data-lazy]", e.$slider).not("[src]").addClass("slick-loading"), e.setupInfinite(), e.buildArrows(), e.buildDots(), e.updateDots(), e.setSlideClasses("number" == typeof e.currentSlide ? e.currentSlide : 0), !0 === e.options.draggable && e.$list.addClass("draggable")
    }, e.prototype.buildRows = function () {
        var i, e, t, o, s, n, r, l = this;
        if (o = document.createDocumentFragment(), n = l.$slider.children(), l.options.rows > 1) {
            for (r = l.options.slidesPerRow * l.options.rows, s = Math.ceil(n.length / r), i = 0; i < s; i++) {
                var d = document.createElement("div");
                for (e = 0; e < l.options.rows; e++) {
                    var a = document.createElement("div");
                    for (t = 0; t < l.options.slidesPerRow; t++) {
                        var c = i * r + (e * l.options.slidesPerRow + t);
                        n.get(c) && a.appendChild(n.get(c))
                    }
                    d.appendChild(a)
                }
                o.appendChild(d)
            }
            l.$slider.empty().append(o), l.$slider.children().children().children().css({
                width: 100 / l.options.slidesPerRow + "%",
                display: "inline-block"
            })
        }
    }, e.prototype.checkResponsive = function (e, t) {
        var o, s, n, r = this, l = !1, d = r.$slider.width(), a = window.innerWidth || i(window).width();
        if ("window" === r.respondTo ? n = a : "slider" === r.respondTo ? n = d : "min" === r.respondTo && (n = Math.min(a, d)), r.options.responsive && r.options.responsive.length && null !== r.options.responsive) {
            s = null;
            for (o in r.breakpoints) r.breakpoints.hasOwnProperty(o) && (!1 === r.originalSettings.mobileFirst ? n < r.breakpoints[o] && (s = r.breakpoints[o]) : n > r.breakpoints[o] && (s = r.breakpoints[o]));
            null !== s ? null !== r.activeBreakpoint ? (s !== r.activeBreakpoint || t) && (r.activeBreakpoint = s, "unslick" === r.breakpointSettings[s] ? r.unslick(s) : (r.options = i.extend({}, r.originalSettings, r.breakpointSettings[s]), !0 === e && (r.currentSlide = r.options.initialSlide), r.refresh(e)), l = s) : (r.activeBreakpoint = s, "unslick" === r.breakpointSettings[s] ? r.unslick(s) : (r.options = i.extend({}, r.originalSettings, r.breakpointSettings[s]), !0 === e && (r.currentSlide = r.options.initialSlide), r.refresh(e)), l = s) : null !== r.activeBreakpoint && (r.activeBreakpoint = null, r.options = r.originalSettings, !0 === e && (r.currentSlide = r.options.initialSlide), r.refresh(e), l = s), e || !1 === l || r.$slider.trigger("breakpoint", [r, l])
        }
    }, e.prototype.changeSlide = function (e, t) {
        var o, s, n, r = this, l = i(e.currentTarget);
        switch (l.is("a") && e.preventDefault(), l.is("li") || (l = l.closest("li")), n = r.slideCount % r.options.slidesToScroll != 0, o = n ? 0 : (r.slideCount - r.currentSlide) % r.options.slidesToScroll, e.data.message) {
            case"previous":
                s = 0 === o ? r.options.slidesToScroll : r.options.slidesToShow - o, r.slideCount > r.options.slidesToShow && r.slideHandler(r.currentSlide - s, !1, t);
                break;
            case"next":
                s = 0 === o ? r.options.slidesToScroll : o, r.slideCount > r.options.slidesToShow && r.slideHandler(r.currentSlide + s, !1, t);
                break;
            case"index":
                var d = 0 === e.data.index ? 0 : e.data.index || l.index() * r.options.slidesToScroll;
                r.slideHandler(r.checkNavigable(d), !1, t), l.children().trigger("focus");
                break;
            default:
                return
        }
    }, e.prototype.checkNavigable = function (i) {
        var e, t;
        if (e = this.getNavigableIndexes(), t = 0, i > e[e.length - 1]) i = e[e.length - 1]; else for (var o in e) {
            if (i < e[o]) {
                i = t;
                break
            }
            t = e[o]
        }
        return i
    }, e.prototype.cleanUpEvents = function () {
        var e = this;
        e.options.dots && null !== e.$dots && (i("li", e.$dots).off("click.slick", e.changeSlide).off("mouseenter.slick", i.proxy(e.interrupt, e, !0)).off("mouseleave.slick", i.proxy(e.interrupt, e, !1)), !0 === e.options.accessibility && e.$dots.off("keydown.slick", e.keyHandler)), e.$slider.off("focus.slick blur.slick"), !0 === e.options.arrows && e.slideCount > e.options.slidesToShow && (e.$prevArrow && e.$prevArrow.off("click.slick", e.changeSlide), e.$nextArrow && e.$nextArrow.off("click.slick", e.changeSlide), !0 === e.options.accessibility && (e.$prevArrow && e.$prevArrow.off("keydown.slick", e.keyHandler), e.$nextArrow && e.$nextArrow.off("keydown.slick", e.keyHandler))), e.$list.off("touchstart.slick mousedown.slick", e.swipeHandler), e.$list.off("touchmove.slick mousemove.slick", e.swipeHandler), e.$list.off("touchend.slick mouseup.slick", e.swipeHandler), e.$list.off("touchcancel.slick mouseleave.slick", e.swipeHandler), e.$list.off("click.slick", e.clickHandler), i(document).off(e.visibilityChange, e.visibility), e.cleanUpSlideEvents(), !0 === e.options.accessibility && e.$list.off("keydown.slick", e.keyHandler), !0 === e.options.focusOnSelect && i(e.$slideTrack).children().off("click.slick", e.selectHandler), i(window).off("orientationchange.slick.slick-" + e.instanceUid, e.orientationChange), i(window).off("resize.slick.slick-" + e.instanceUid, e.resize), i("[draggable!=true]", e.$slideTrack).off("dragstart", e.preventDefault), i(window).off("load.slick.slick-" + e.instanceUid, e.setPosition)
    }, e.prototype.cleanUpSlideEvents = function () {
        var e = this;
        e.$list.off("mouseenter.slick", i.proxy(e.interrupt, e, !0)), e.$list.off("mouseleave.slick", i.proxy(e.interrupt, e, !1))
    }, e.prototype.cleanUpRows = function () {
        var i, e = this;
        e.options.rows > 1 && ((i = e.$slides.children().children()).removeAttr("style"), e.$slider.empty().append(i))
    }, e.prototype.clickHandler = function (i) {
        !1 === this.shouldClick && (i.stopImmediatePropagation(), i.stopPropagation(), i.preventDefault())
    }, e.prototype.destroy = function (e) {
        var t = this;
        t.autoPlayClear(), t.touchObject = {}, t.cleanUpEvents(), i(".slick-cloned", t.$slider).detach(), t.$dots && t.$dots.remove(), t.$prevArrow && t.$prevArrow.length && (t.$prevArrow.removeClass("slick-disabled slick-arrow slick-hidden").removeAttr("aria-hidden aria-disabled tabindex").css("display", ""), t.htmlExpr.test(t.options.prevArrow) && t.$prevArrow.remove()), t.$nextArrow && t.$nextArrow.length && (t.$nextArrow.removeClass("slick-disabled slick-arrow slick-hidden").removeAttr("aria-hidden aria-disabled tabindex").css("display", ""), t.htmlExpr.test(t.options.nextArrow) && t.$nextArrow.remove()), t.$slides && (t.$slides.removeClass("slick-slide slick-active slick-center slick-visible slick-current").removeAttr("aria-hidden").removeAttr("data-slick-index").each(function () {
            i(this).attr("style", i(this).data("originalStyling"))
        }), t.$slideTrack.children(this.options.slide).detach(), t.$slideTrack.detach(), t.$list.detach(), t.$slider.append(t.$slides)), t.cleanUpRows(), t.$slider.removeClass("slick-slider"), t.$slider.removeClass("slick-initialized"), t.$slider.removeClass("slick-dotted"), t.unslicked = !0, e || t.$slider.trigger("destroy", [t])
    }, e.prototype.disableTransition = function (i) {
        var e = this, t = {};
        t[e.transitionType] = "", !1 === e.options.fade ? e.$slideTrack.css(t) : e.$slides.eq(i).css(t)
    }, e.prototype.fadeSlide = function (i, e) {
        var t = this;
        !1 === t.cssTransitions ? (t.$slides.eq(i).css({zIndex: t.options.zIndex}), t.$slides.eq(i).animate({opacity: 1}, t.options.speed, t.options.easing, e)) : (t.applyTransition(i), t.$slides.eq(i).css({
            opacity: 1,
            zIndex: t.options.zIndex
        }), e && setTimeout(function () {
            t.disableTransition(i), e.call()
        }, t.options.speed))
    }, e.prototype.fadeSlideOut = function (i) {
        var e = this;
        !1 === e.cssTransitions ? e.$slides.eq(i).animate({
            opacity: 0,
            zIndex: e.options.zIndex - 2
        }, e.options.speed, e.options.easing) : (e.applyTransition(i), e.$slides.eq(i).css({
            opacity: 0,
            zIndex: e.options.zIndex - 2
        }))
    }, e.prototype.filterSlides = e.prototype.slickFilter = function (i) {
        var e = this;
        null !== i && (e.$slidesCache = e.$slides, e.unload(), e.$slideTrack.children(this.options.slide).detach(), e.$slidesCache.filter(i).appendTo(e.$slideTrack), e.reinit())
    }, e.prototype.focusHandler = function () {
        var e = this;
        e.$slider.off("focus.slick blur.slick").on("focus.slick blur.slick", "*", function (t) {
            t.stopImmediatePropagation();
            var o = i(this);
            setTimeout(function () {
                e.options.pauseOnFocus && (e.focussed = o.is(":focus"), e.autoPlay())
            }, 0)
        })
    }, e.prototype.getCurrent = e.prototype.slickCurrentSlide = function () {
        return this.currentSlide
    }, e.prototype.getDotCount = function () {
        var i = this, e = 0, t = 0, o = 0;
        if (!0 === i.options.infinite) if (i.slideCount <= i.options.slidesToShow) ++o; else for (; e < i.slideCount;) ++o, e = t + i.options.slidesToScroll, t += i.options.slidesToScroll <= i.options.slidesToShow ? i.options.slidesToScroll : i.options.slidesToShow; else if (!0 === i.options.centerMode) o = i.slideCount; else if (i.options.asNavFor) for (; e < i.slideCount;) ++o, e = t + i.options.slidesToScroll, t += i.options.slidesToScroll <= i.options.slidesToShow ? i.options.slidesToScroll : i.options.slidesToShow; else o = 1 + Math.ceil((i.slideCount - i.options.slidesToShow) / i.options.slidesToScroll);
        return o - 1
    }, e.prototype.getLeft = function (i) {
        var e, t, o, s, n = this, r = 0;
        return n.slideOffset = 0, t = n.$slides.first().outerHeight(!0), !0 === n.options.infinite ? (n.slideCount > n.options.slidesToShow && (n.slideOffset = n.slideWidth * n.options.slidesToShow * -1, s = -1, !0 === n.options.vertical && !0 === n.options.centerMode && (2 === n.options.slidesToShow ? s = -1.5 : 1 === n.options.slidesToShow && (s = -2)), r = t * n.options.slidesToShow * s), n.slideCount % n.options.slidesToScroll != 0 && i + n.options.slidesToScroll > n.slideCount && n.slideCount > n.options.slidesToShow && (i > n.slideCount ? (n.slideOffset = (n.options.slidesToShow - (i - n.slideCount)) * n.slideWidth * -1, r = (n.options.slidesToShow - (i - n.slideCount)) * t * -1) : (n.slideOffset = n.slideCount % n.options.slidesToScroll * n.slideWidth * -1, r = n.slideCount % n.options.slidesToScroll * t * -1))) : i + n.options.slidesToShow > n.slideCount && (n.slideOffset = (i + n.options.slidesToShow - n.slideCount) * n.slideWidth, r = (i + n.options.slidesToShow - n.slideCount) * t), n.slideCount <= n.options.slidesToShow && (n.slideOffset = 0, r = 0), !0 === n.options.centerMode && n.slideCount <= n.options.slidesToShow ? n.slideOffset = n.slideWidth * Math.floor(n.options.slidesToShow) / 2 - n.slideWidth * n.slideCount / 2 : !0 === n.options.centerMode && !0 === n.options.infinite ? n.slideOffset += n.slideWidth * Math.floor(n.options.slidesToShow / 2) - n.slideWidth : !0 === n.options.centerMode && (n.slideOffset = 0, n.slideOffset += n.slideWidth * Math.floor(n.options.slidesToShow / 2)), e = !1 === n.options.vertical ? i * n.slideWidth * -1 + n.slideOffset : i * t * -1 + r, !0 === n.options.variableWidth && (o = n.slideCount <= n.options.slidesToShow || !1 === n.options.infinite ? n.$slideTrack.children(".slick-slide").eq(i) : n.$slideTrack.children(".slick-slide").eq(i + n.options.slidesToShow), e = !0 === n.options.rtl ? o[0] ? -1 * (n.$slideTrack.width() - o[0].offsetLeft - o.width()) : 0 : o[0] ? -1 * o[0].offsetLeft : 0, !0 === n.options.centerMode && (o = n.slideCount <= n.options.slidesToShow || !1 === n.options.infinite ? n.$slideTrack.children(".slick-slide").eq(i) : n.$slideTrack.children(".slick-slide").eq(i + n.options.slidesToShow + 1), e = !0 === n.options.rtl ? o[0] ? -1 * (n.$slideTrack.width() - o[0].offsetLeft - o.width()) : 0 : o[0] ? -1 * o[0].offsetLeft : 0, e += (n.$list.width() - o.outerWidth()) / 2)), e
    }, e.prototype.getOption = e.prototype.slickGetOption = function (i) {
        return this.options[i]
    }, e.prototype.getNavigableIndexes = function () {
        var i, e = this, t = 0, o = 0, s = [];
        for (!1 === e.options.infinite ? i = e.slideCount : (t = -1 * e.options.slidesToScroll, o = -1 * e.options.slidesToScroll, i = 2 * e.slideCount); t < i;) s.push(t), t = o + e.options.slidesToScroll, o += e.options.slidesToScroll <= e.options.slidesToShow ? e.options.slidesToScroll : e.options.slidesToShow;
        return s
    }, e.prototype.getSlick = function () {
        return this
    }, e.prototype.getSlideCount = function () {
        var e, t, o = this;
        return t = !0 === o.options.centerMode ? o.slideWidth * Math.floor(o.options.slidesToShow / 2) : 0, !0 === o.options.swipeToSlide ? (o.$slideTrack.find(".slick-slide").each(function (s, n) {
            if (n.offsetLeft - t + i(n).outerWidth() / 2 > -1 * o.swipeLeft) return e = n, !1
        }), Math.abs(i(e).attr("data-slick-index") - o.currentSlide) || 1) : o.options.slidesToScroll
    }, e.prototype.goTo = e.prototype.slickGoTo = function (i, e) {
        this.changeSlide({data: {message: "index", index: parseInt(i)}}, e)
    }, e.prototype.init = function (e) {
        var t = this;
        i(t.$slider).hasClass("slick-initialized") || (i(t.$slider).addClass("slick-initialized"), t.buildRows(), t.buildOut(), t.setProps(), t.startLoad(), t.loadSlider(), t.initializeEvents(), t.updateArrows(), t.updateDots(), t.checkResponsive(!0), t.focusHandler()), e && t.$slider.trigger("init", [t]), !0 === t.options.accessibility && t.initADA(), t.options.autoplay && (t.paused = !1, t.autoPlay())
    }, e.prototype.initADA = function () {
        var e = this, t = Math.ceil(e.slideCount / e.options.slidesToShow),
            o = e.getNavigableIndexes().filter(function (i) {
                return i >= 0 && i < e.slideCount
            });
        e.$slides.add(e.$slideTrack.find(".slick-cloned")).attr({
            "aria-hidden": "true",
            tabindex: "-1"
        }).find("a, input, button, select").attr({tabindex: "-1"}), null !== e.$dots && (e.$slides.not(e.$slideTrack.find(".slick-cloned")).each(function (t) {
            var s = o.indexOf(t);
            i(this).attr({
                role: "tabpanel",
                id: "slick-slide" + e.instanceUid + t,
                tabindex: -1
            }), -1 !== s && i(this).attr({"aria-describedby": "slick-slide-control" + e.instanceUid + s})
        }), e.$dots.attr("role", "tablist").find("li").each(function (s) {
            var n = o[s];
            i(this).attr({role: "presentation"}), i(this).find("button").first().attr({
                role: "tab",
                id: "slick-slide-control" + e.instanceUid + s,
                "aria-controls": "slick-slide" + e.instanceUid + n,
                "aria-label": s + 1 + " of " + t,
                "aria-selected": null,
                tabindex: "-1"
            })
        }).eq(e.currentSlide).find("button").attr({"aria-selected": "true", tabindex: "0"}).end());
        for (var s = e.currentSlide, n = s + e.options.slidesToShow; s < n; s++) e.$slides.eq(s).attr("tabindex", 0);
        e.activateADA()
    }, e.prototype.initArrowEvents = function () {
        var i = this;
        !0 === i.options.arrows && i.slideCount > i.options.slidesToShow && (i.$prevArrow.off("click.slick").on("click.slick", {message: "previous"}, i.changeSlide), i.$nextArrow.off("click.slick").on("click.slick", {message: "next"}, i.changeSlide), !0 === i.options.accessibility && (i.$prevArrow.on("keydown.slick", i.keyHandler), i.$nextArrow.on("keydown.slick", i.keyHandler)))
    }, e.prototype.initDotEvents = function () {
        var e = this;
        !0 === e.options.dots && (i("li", e.$dots).on("click.slick", {message: "index"}, e.changeSlide), !0 === e.options.accessibility && e.$dots.on("keydown.slick", e.keyHandler)), !0 === e.options.dots && !0 === e.options.pauseOnDotsHover && i("li", e.$dots).on("mouseenter.slick", i.proxy(e.interrupt, e, !0)).on("mouseleave.slick", i.proxy(e.interrupt, e, !1))
    }, e.prototype.initSlideEvents = function () {
        var e = this;
        e.options.pauseOnHover && (e.$list.on("mouseenter.slick", i.proxy(e.interrupt, e, !0)), e.$list.on("mouseleave.slick", i.proxy(e.interrupt, e, !1)))
    }, e.prototype.initializeEvents = function () {
        var e = this;
        e.initArrowEvents(), e.initDotEvents(), e.initSlideEvents(), e.$list.on("touchstart.slick mousedown.slick", {action: "start"}, e.swipeHandler), e.$list.on("touchmove.slick mousemove.slick", {action: "move"}, e.swipeHandler), e.$list.on("touchend.slick mouseup.slick", {action: "end"}, e.swipeHandler), e.$list.on("touchcancel.slick mouseleave.slick", {action: "end"}, e.swipeHandler), e.$list.on("click.slick", e.clickHandler), i(document).on(e.visibilityChange, i.proxy(e.visibility, e)), !0 === e.options.accessibility && e.$list.on("keydown.slick", e.keyHandler), !0 === e.options.focusOnSelect && i(e.$slideTrack).children().on("click.slick", e.selectHandler), i(window).on("orientationchange.slick.slick-" + e.instanceUid, i.proxy(e.orientationChange, e)), i(window).on("resize.slick.slick-" + e.instanceUid, i.proxy(e.resize, e)), i("[draggable!=true]", e.$slideTrack).on("dragstart", e.preventDefault), i(window).on("load.slick.slick-" + e.instanceUid, e.setPosition), i(e.setPosition)
    }, e.prototype.initUI = function () {
        var i = this;
        !0 === i.options.arrows && i.slideCount > i.options.slidesToShow && (i.$prevArrow.show(), i.$nextArrow.show()), !0 === i.options.dots && i.slideCount > i.options.slidesToShow && i.$dots.show()
    }, e.prototype.keyHandler = function (i) {
        var e = this;
        i.target.tagName.match("TEXTAREA|INPUT|SELECT") || (37 === i.keyCode && !0 === e.options.accessibility ? e.changeSlide({data: {message: !0 === e.options.rtl ? "next" : "previous"}}) : 39 === i.keyCode && !0 === e.options.accessibility && e.changeSlide({data: {message: !0 === e.options.rtl ? "previous" : "next"}}))
    }, e.prototype.lazyLoad = function () {
        function e(e) {
            i("img[data-lazy]", e).each(function () {
                var e = i(this), t = i(this).attr("data-lazy"), o = i(this).attr("data-srcset"),
                    s = i(this).attr("data-sizes") || n.$slider.attr("data-sizes"), r = document.createElement("img");
                r.onload = function () {
                    e.animate({opacity: 0}, 100, function () {
                        o && (e.attr("srcset", o), s && e.attr("sizes", s)), e.attr("src", t).animate({opacity: 1}, 200, function () {
                            e.removeAttr("data-lazy data-srcset data-sizes").removeClass("slick-loading")
                        }), n.$slider.trigger("lazyLoaded", [n, e, t])
                    })
                }, r.onerror = function () {
                    e.removeAttr("data-lazy").removeClass("slick-loading").addClass("slick-lazyload-error"), n.$slider.trigger("lazyLoadError", [n, e, t])
                }, r.src = t
            })
        }

        var t, o, s, n = this;
        if (!0 === n.options.centerMode ? !0 === n.options.infinite ? s = (o = n.currentSlide + (n.options.slidesToShow / 2 + 1)) + n.options.slidesToShow + 2 : (o = Math.max(0, n.currentSlide - (n.options.slidesToShow / 2 + 1)), s = n.options.slidesToShow / 2 + 1 + 2 + n.currentSlide) : (o = n.options.infinite ? n.options.slidesToShow + n.currentSlide : n.currentSlide, s = Math.ceil(o + n.options.slidesToShow), !0 === n.options.fade && (o > 0 && o--, s <= n.slideCount && s++)), t = n.$slider.find(".slick-slide").slice(o, s), "anticipated" === n.options.lazyLoad) for (var r = o - 1, l = s, d = n.$slider.find(".slick-slide"), a = 0; a < n.options.slidesToScroll; a++) r < 0 && (r = n.slideCount - 1), t = (t = t.add(d.eq(r))).add(d.eq(l)), r--, l++;
        e(t), n.slideCount <= n.options.slidesToShow ? e(n.$slider.find(".slick-slide")) : n.currentSlide >= n.slideCount - n.options.slidesToShow ? e(n.$slider.find(".slick-cloned").slice(0, n.options.slidesToShow)) : 0 === n.currentSlide && e(n.$slider.find(".slick-cloned").slice(-1 * n.options.slidesToShow))
    }, e.prototype.loadSlider = function () {
        var i = this;
        i.setPosition(), i.$slideTrack.css({opacity: 1}), i.$slider.removeClass("slick-loading"), i.initUI(), "progressive" === i.options.lazyLoad && i.progressiveLazyLoad()
    }, e.prototype.next = e.prototype.slickNext = function () {
        this.changeSlide({data: {message: "next"}})
    }, e.prototype.orientationChange = function () {
        var i = this;
        i.checkResponsive(), i.setPosition()
    }, e.prototype.pause = e.prototype.slickPause = function () {
        var i = this;
        i.autoPlayClear(), i.paused = !0
    }, e.prototype.play = e.prototype.slickPlay = function () {
        var i = this;
        i.autoPlay(), i.options.autoplay = !0, i.paused = !1, i.focussed = !1, i.interrupted = !1
    }, e.prototype.postSlide = function (e) {
        var t = this;
        t.unslicked || (t.$slider.trigger("afterChange", [t, e]), t.animating = !1, t.slideCount > t.options.slidesToShow && t.setPosition(), t.swipeLeft = null, t.options.autoplay && t.autoPlay(), !0 === t.options.accessibility && (t.initADA(), t.options.focusOnChange && i(t.$slides.get(t.currentSlide)).attr("tabindex", 0).focus()))
    }, e.prototype.prev = e.prototype.slickPrev = function () {
        this.changeSlide({data: {message: "previous"}})
    }, e.prototype.preventDefault = function (i) {
        i.preventDefault()
    }, e.prototype.progressiveLazyLoad = function (e) {
        e = e || 1;
        var t, o, s, n, r, l = this, d = i("img[data-lazy]", l.$slider);
        d.length ? (t = d.first(), o = t.attr("data-lazy"), s = t.attr("data-srcset"), n = t.attr("data-sizes") || l.$slider.attr("data-sizes"), (r = document.createElement("img")).onload = function () {
            s && (t.attr("srcset", s), n && t.attr("sizes", n)), t.attr("src", o).removeAttr("data-lazy data-srcset data-sizes").removeClass("slick-loading"), !0 === l.options.adaptiveHeight && l.setPosition(), l.$slider.trigger("lazyLoaded", [l, t, o]), l.progressiveLazyLoad()
        }, r.onerror = function () {
            e < 3 ? setTimeout(function () {
                l.progressiveLazyLoad(e + 1)
            }, 500) : (t.removeAttr("data-lazy").removeClass("slick-loading").addClass("slick-lazyload-error"), l.$slider.trigger("lazyLoadError", [l, t, o]), l.progressiveLazyLoad())
        }, r.src = o) : l.$slider.trigger("allImagesLoaded", [l])
    }, e.prototype.refresh = function (e) {
        var t, o, s = this;
        o = s.slideCount - s.options.slidesToShow, !s.options.infinite && s.currentSlide > o && (s.currentSlide = o), s.slideCount <= s.options.slidesToShow && (s.currentSlide = 0), t = s.currentSlide, s.destroy(!0), i.extend(s, s.initials, {currentSlide: t}), s.init(), e || s.changeSlide({
            data: {
                message: "index",
                index: t
            }
        }, !1)
    }, e.prototype.registerBreakpoints = function () {
        var e, t, o, s = this, n = s.options.responsive || null;
        if ("array" === i.type(n) && n.length) {
            s.respondTo = s.options.respondTo || "window";
            for (e in n) if (o = s.breakpoints.length - 1, n.hasOwnProperty(e)) {
                for (t = n[e].breakpoint; o >= 0;) s.breakpoints[o] && s.breakpoints[o] === t && s.breakpoints.splice(o, 1), o--;
                s.breakpoints.push(t), s.breakpointSettings[t] = n[e].settings
            }
            s.breakpoints.sort(function (i, e) {
                return s.options.mobileFirst ? i - e : e - i
            })
        }
    }, e.prototype.reinit = function () {
        var e = this;
        e.$slides = e.$slideTrack.children(e.options.slide).addClass("slick-slide"), e.slideCount = e.$slides.length, e.currentSlide >= e.slideCount && 0 !== e.currentSlide && (e.currentSlide = e.currentSlide - e.options.slidesToScroll), e.slideCount <= e.options.slidesToShow && (e.currentSlide = 0), e.registerBreakpoints(), e.setProps(), e.setupInfinite(), e.buildArrows(), e.updateArrows(), e.initArrowEvents(), e.buildDots(), e.updateDots(), e.initDotEvents(), e.cleanUpSlideEvents(), e.initSlideEvents(), e.checkResponsive(!1, !0), !0 === e.options.focusOnSelect && i(e.$slideTrack).children().on("click.slick", e.selectHandler), e.setSlideClasses("number" == typeof e.currentSlide ? e.currentSlide : 0), e.setPosition(), e.focusHandler(), e.paused = !e.options.autoplay, e.autoPlay(), e.$slider.trigger("reInit", [e])
    }, e.prototype.resize = function () {
        var e = this;
        i(window).width() !== e.windowWidth && (clearTimeout(e.windowDelay), e.windowDelay = window.setTimeout(function () {
            e.windowWidth = i(window).width(), e.checkResponsive(), e.unslicked || e.setPosition()
        }, 50))
    }, e.prototype.removeSlide = e.prototype.slickRemove = function (i, e, t) {
        var o = this;
        if (i = "boolean" == typeof i ? !0 === (e = i) ? 0 : o.slideCount - 1 : !0 === e ? --i : i, o.slideCount < 1 || i < 0 || i > o.slideCount - 1) return !1;
        o.unload(), !0 === t ? o.$slideTrack.children().remove() : o.$slideTrack.children(this.options.slide).eq(i).remove(), o.$slides = o.$slideTrack.children(this.options.slide), o.$slideTrack.children(this.options.slide).detach(), o.$slideTrack.append(o.$slides), o.$slidesCache = o.$slides, o.reinit()
    }, e.prototype.setCSS = function (i) {
        var e, t, o = this, s = {};
        !0 === o.options.rtl && (i = -i), e = "left" == o.positionProp ? Math.ceil(i) + "px" : "0px", t = "top" == o.positionProp ? Math.ceil(i) + "px" : "0px", s[o.positionProp] = i, !1 === o.transformsEnabled ? o.$slideTrack.css(s) : (s = {}, !1 === o.cssTransitions ? (s[o.animType] = "translate(" + e + ", " + t + ")", o.$slideTrack.css(s)) : (s[o.animType] = "translate3d(" + e + ", " + t + ", 0px)", o.$slideTrack.css(s)))
    }, e.prototype.setDimensions = function () {
        var i = this;
        !1 === i.options.vertical ? !0 === i.options.centerMode && i.$list.css({padding: "0px " + i.options.centerPadding}) : (i.$list.height(i.$slides.first().outerHeight(!0) * i.options.slidesToShow), !0 === i.options.centerMode && i.$list.css({padding: i.options.centerPadding + " 0px"})), i.listWidth = i.$list.width(), i.listHeight = i.$list.height(), !1 === i.options.vertical && !1 === i.options.variableWidth ? (i.slideWidth = Math.ceil(i.listWidth / i.options.slidesToShow), i.$slideTrack.width(Math.ceil(i.slideWidth * i.$slideTrack.children(".slick-slide").length))) : !0 === i.options.variableWidth ? i.$slideTrack.width(5e3 * i.slideCount) : (i.slideWidth = Math.ceil(i.listWidth), i.$slideTrack.height(Math.ceil(i.$slides.first().outerHeight(!0) * i.$slideTrack.children(".slick-slide").length)));
        var e = i.$slides.first().outerWidth(!0) - i.$slides.first().width();
        !1 === i.options.variableWidth && i.$slideTrack.children(".slick-slide").width(i.slideWidth - e)
    }, e.prototype.setFade = function () {
        var e, t = this;
        t.$slides.each(function (o, s) {
            e = t.slideWidth * o * -1, !0 === t.options.rtl ? i(s).css({
                position: "relative",
                right: e,
                top: 0,
                zIndex: t.options.zIndex - 2,
                opacity: 0
            }) : i(s).css({position: "relative", left: e, top: 0, zIndex: t.options.zIndex - 2, opacity: 0})
        }), t.$slides.eq(t.currentSlide).css({zIndex: t.options.zIndex - 1, opacity: 1})
    }, e.prototype.setHeight = function () {
        var i = this;
        if (1 === i.options.slidesToShow && !0 === i.options.adaptiveHeight && !1 === i.options.vertical) {
            var e = i.$slides.eq(i.currentSlide).outerHeight(!0);
            i.$list.css("height", e)
        }
    }, e.prototype.setOption = e.prototype.slickSetOption = function () {
        var e, t, o, s, n, r = this, l = !1;
        if ("object" === i.type(arguments[0]) ? (o = arguments[0], l = arguments[1], n = "multiple") : "string" === i.type(arguments[0]) && (o = arguments[0], s = arguments[1], l = arguments[2], "responsive" === arguments[0] && "array" === i.type(arguments[1]) ? n = "responsive" : void 0 !== arguments[1] && (n = "single")), "single" === n) r.options[o] = s; else if ("multiple" === n) i.each(o, function (i, e) {
            r.options[i] = e
        }); else if ("responsive" === n) for (t in s) if ("array" !== i.type(r.options.responsive)) r.options.responsive = [s[t]]; else {
            for (e = r.options.responsive.length - 1; e >= 0;) r.options.responsive[e].breakpoint === s[t].breakpoint && r.options.responsive.splice(e, 1), e--;
            r.options.responsive.push(s[t])
        }
        l && (r.unload(), r.reinit())
    }, e.prototype.setPosition = function () {
        var i = this;
        i.setDimensions(), i.setHeight(), !1 === i.options.fade ? i.setCSS(i.getLeft(i.currentSlide)) : i.setFade(), i.$slider.trigger("setPosition", [i])
    }, e.prototype.setProps = function () {
        var i = this, e = document.body.style;
        i.positionProp = !0 === i.options.vertical ? "top" : "left", "top" === i.positionProp ? i.$slider.addClass("slick-vertical") : i.$slider.removeClass("slick-vertical"), void 0 === e.WebkitTransition && void 0 === e.MozTransition && void 0 === e.msTransition || !0 === i.options.useCSS && (i.cssTransitions = !0), i.options.fade && ("number" == typeof i.options.zIndex ? i.options.zIndex < 3 && (i.options.zIndex = 3) : i.options.zIndex = i.defaults.zIndex), void 0 !== e.OTransform && (i.animType = "OTransform", i.transformType = "-o-transform", i.transitionType = "OTransition", void 0 === e.perspectiveProperty && void 0 === e.webkitPerspective && (i.animType = !1)), void 0 !== e.MozTransform && (i.animType = "MozTransform", i.transformType = "-moz-transform", i.transitionType = "MozTransition", void 0 === e.perspectiveProperty && void 0 === e.MozPerspective && (i.animType = !1)), void 0 !== e.webkitTransform && (i.animType = "webkitTransform", i.transformType = "-webkit-transform", i.transitionType = "webkitTransition", void 0 === e.perspectiveProperty && void 0 === e.webkitPerspective && (i.animType = !1)), void 0 !== e.msTransform && (i.animType = "msTransform", i.transformType = "-ms-transform", i.transitionType = "msTransition", void 0 === e.msTransform && (i.animType = !1)), void 0 !== e.transform && !1 !== i.animType && (i.animType = "transform", i.transformType = "transform", i.transitionType = "transition"), i.transformsEnabled = i.options.useTransform && null !== i.animType && !1 !== i.animType
    }, e.prototype.setSlideClasses = function (i) {
        var e, t, o, s, n = this;
        if (t = n.$slider.find(".slick-slide").removeClass("slick-active slick-center slick-current").attr("aria-hidden", "true"), n.$slides.eq(i).addClass("slick-current"), !0 === n.options.centerMode) {
            var r = n.options.slidesToShow % 2 == 0 ? 1 : 0;
            e = Math.floor(n.options.slidesToShow / 2), !0 === n.options.infinite && (i >= e && i <= n.slideCount - 1 - e ? n.$slides.slice(i - e + r, i + e + 1).addClass("slick-active").attr("aria-hidden", "false") : (o = n.options.slidesToShow + i, t.slice(o - e + 1 + r, o + e + 2).addClass("slick-active").attr("aria-hidden", "false")), 0 === i ? t.eq(t.length - 1 - n.options.slidesToShow).addClass("slick-center") : i === n.slideCount - 1 && t.eq(n.options.slidesToShow).addClass("slick-center")), n.$slides.eq(i).addClass("slick-center")
        } else i >= 0 && i <= n.slideCount - n.options.slidesToShow ? n.$slides.slice(i, i + n.options.slidesToShow).addClass("slick-active").attr("aria-hidden", "false") : t.length <= n.options.slidesToShow ? t.addClass("slick-active").attr("aria-hidden", "false") : (s = n.slideCount % n.options.slidesToShow, o = !0 === n.options.infinite ? n.options.slidesToShow + i : i, n.options.slidesToShow == n.options.slidesToScroll && n.slideCount - i < n.options.slidesToShow ? t.slice(o - (n.options.slidesToShow - s), o + s).addClass("slick-active").attr("aria-hidden", "false") : t.slice(o, o + n.options.slidesToShow).addClass("slick-active").attr("aria-hidden", "false"));
        "ondemand" !== n.options.lazyLoad && "anticipated" !== n.options.lazyLoad || n.lazyLoad()
    }, e.prototype.setupInfinite = function () {
        var e, t, o, s = this;
        if (!0 === s.options.fade && (s.options.centerMode = !1), !0 === s.options.infinite && !1 === s.options.fade && (t = null, s.slideCount > s.options.slidesToShow)) {
            for (o = !0 === s.options.centerMode ? s.options.slidesToShow + 1 : s.options.slidesToShow, e = s.slideCount; e > s.slideCount - o; e -= 1) t = e - 1, i(s.$slides[t]).clone(!0).attr("id", "").attr("data-slick-index", t - s.slideCount).prependTo(s.$slideTrack).addClass("slick-cloned");
            for (e = 0; e < o + s.slideCount; e += 1) t = e, i(s.$slides[t]).clone(!0).attr("id", "").attr("data-slick-index", t + s.slideCount).appendTo(s.$slideTrack).addClass("slick-cloned");
            s.$slideTrack.find(".slick-cloned").find("[id]").each(function () {
                i(this).attr("id", "")
            })
        }
    }, e.prototype.interrupt = function (i) {
        var e = this;
        i || e.autoPlay(), e.interrupted = i
    }, e.prototype.selectHandler = function (e) {
        var t = this, o = i(e.target).is(".slick-slide") ? i(e.target) : i(e.target).parents(".slick-slide"),
            s = parseInt(o.attr("data-slick-index"));
        s || (s = 0), t.slideCount <= t.options.slidesToShow ? t.slideHandler(s, !1, !0) : t.slideHandler(s)
    }, e.prototype.slideHandler = function (i, e, t) {
        var o, s, n, r, l, d = null, a = this;
        if (e = e || !1, !(!0 === a.animating && !0 === a.options.waitForAnimate || !0 === a.options.fade && a.currentSlide === i)) if (!1 === e && a.asNavFor(i), o = i, d = a.getLeft(o), r = a.getLeft(a.currentSlide), a.currentLeft = null === a.swipeLeft ? r : a.swipeLeft, !1 === a.options.infinite && !1 === a.options.centerMode && (i < 0 || i > a.getDotCount() * a.options.slidesToScroll)) !1 === a.options.fade && (o = a.currentSlide, !0 !== t ? a.animateSlide(r, function () {
            a.postSlide(o)
        }) : a.postSlide(o)); else if (!1 === a.options.infinite && !0 === a.options.centerMode && (i < 0 || i > a.slideCount - a.options.slidesToScroll)) !1 === a.options.fade && (o = a.currentSlide, !0 !== t ? a.animateSlide(r, function () {
            a.postSlide(o)
        }) : a.postSlide(o)); else {
            if (a.options.autoplay && clearInterval(a.autoPlayTimer), s = o < 0 ? a.slideCount % a.options.slidesToScroll != 0 ? a.slideCount - a.slideCount % a.options.slidesToScroll : a.slideCount + o : o >= a.slideCount ? a.slideCount % a.options.slidesToScroll != 0 ? 0 : o - a.slideCount : o, a.animating = !0, a.$slider.trigger("beforeChange", [a, a.currentSlide, s]), n = a.currentSlide, a.currentSlide = s, a.setSlideClasses(a.currentSlide), a.options.asNavFor && (l = (l = a.getNavTarget()).slick("getSlick")).slideCount <= l.options.slidesToShow && l.setSlideClasses(a.currentSlide), a.updateDots(), a.updateArrows(), !0 === a.options.fade) return !0 !== t ? (a.fadeSlideOut(n), a.fadeSlide(s, function () {
                a.postSlide(s)
            })) : a.postSlide(s), void a.animateHeight();
            !0 !== t ? a.animateSlide(d, function () {
                a.postSlide(s)
            }) : a.postSlide(s)
        }
    }, e.prototype.startLoad = function () {
        var i = this;
        !0 === i.options.arrows && i.slideCount > i.options.slidesToShow && (i.$prevArrow.hide(), i.$nextArrow.hide()), !0 === i.options.dots && i.slideCount > i.options.slidesToShow && i.$dots.hide(), i.$slider.addClass("slick-loading")
    }, e.prototype.swipeDirection = function () {
        var i, e, t, o, s = this;
        return i = s.touchObject.startX - s.touchObject.curX, e = s.touchObject.startY - s.touchObject.curY, t = Math.atan2(e, i), (o = Math.round(180 * t / Math.PI)) < 0 && (o = 360 - Math.abs(o)), o <= 45 && o >= 0 ? !1 === s.options.rtl ? "left" : "right" : o <= 360 && o >= 315 ? !1 === s.options.rtl ? "left" : "right" : o >= 135 && o <= 225 ? !1 === s.options.rtl ? "right" : "left" : !0 === s.options.verticalSwiping ? o >= 35 && o <= 135 ? "down" : "up" : "vertical"
    }, e.prototype.swipeEnd = function (i) {
        var e, t, o = this;
        if (o.dragging = !1, o.swiping = !1, o.scrolling) return o.scrolling = !1, !1;
        if (o.interrupted = !1, o.shouldClick = !(o.touchObject.swipeLength > 10), void 0 === o.touchObject.curX) return !1;
        if (!0 === o.touchObject.edgeHit && o.$slider.trigger("edge", [o, o.swipeDirection()]), o.touchObject.swipeLength >= o.touchObject.minSwipe) {
            switch (t = o.swipeDirection()) {
                case"left":
                case"down":
                    e = o.options.swipeToSlide ? o.checkNavigable(o.currentSlide + o.getSlideCount()) : o.currentSlide + o.getSlideCount(), o.currentDirection = 0;
                    break;
                case"right":
                case"up":
                    e = o.options.swipeToSlide ? o.checkNavigable(o.currentSlide - o.getSlideCount()) : o.currentSlide - o.getSlideCount(), o.currentDirection = 1
            }
            "vertical" != t && (o.slideHandler(e), o.touchObject = {}, o.$slider.trigger("swipe", [o, t]))
        } else o.touchObject.startX !== o.touchObject.curX && (o.slideHandler(o.currentSlide), o.touchObject = {})
    }, e.prototype.swipeHandler = function (i) {
        var e = this;
        if (!(!1 === e.options.swipe || "ontouchend" in document && !1 === e.options.swipe || !1 === e.options.draggable && -1 !== i.type.indexOf("mouse"))) switch (e.touchObject.fingerCount = i.originalEvent && void 0 !== i.originalEvent.touches ? i.originalEvent.touches.length : 1, e.touchObject.minSwipe = e.listWidth / e.options.touchThreshold, !0 === e.options.verticalSwiping && (e.touchObject.minSwipe = e.listHeight / e.options.touchThreshold), i.data.action) {
            case"start":
                e.swipeStart(i);
                break;
            case"move":
                e.swipeMove(i);
                break;
            case"end":
                e.swipeEnd(i)
        }
    }, e.prototype.swipeMove = function (i) {
        var e, t, o, s, n, r, l = this;
        return n = void 0 !== i.originalEvent ? i.originalEvent.touches : null, !(!l.dragging || l.scrolling || n && 1 !== n.length) && (e = l.getLeft(l.currentSlide), l.touchObject.curX = void 0 !== n ? n[0].pageX : i.clientX, l.touchObject.curY = void 0 !== n ? n[0].pageY : i.clientY, l.touchObject.swipeLength = Math.round(Math.sqrt(Math.pow(l.touchObject.curX - l.touchObject.startX, 2))), r = Math.round(Math.sqrt(Math.pow(l.touchObject.curY - l.touchObject.startY, 2))), !l.options.verticalSwiping && !l.swiping && r > 4 ? (l.scrolling = !0, !1) : (!0 === l.options.verticalSwiping && (l.touchObject.swipeLength = r), t = l.swipeDirection(), void 0 !== i.originalEvent && l.touchObject.swipeLength > 4 && (l.swiping = !0, i.preventDefault()), s = (!1 === l.options.rtl ? 1 : -1) * (l.touchObject.curX > l.touchObject.startX ? 1 : -1), !0 === l.options.verticalSwiping && (s = l.touchObject.curY > l.touchObject.startY ? 1 : -1), o = l.touchObject.swipeLength, l.touchObject.edgeHit = !1, !1 === l.options.infinite && (0 === l.currentSlide && "right" === t || l.currentSlide >= l.getDotCount() && "left" === t) && (o = l.touchObject.swipeLength * l.options.edgeFriction, l.touchObject.edgeHit = !0), !1 === l.options.vertical ? l.swipeLeft = e + o * s : l.swipeLeft = e + o * (l.$list.height() / l.listWidth) * s, !0 === l.options.verticalSwiping && (l.swipeLeft = e + o * s), !0 !== l.options.fade && !1 !== l.options.touchMove && (!0 === l.animating ? (l.swipeLeft = null, !1) : void l.setCSS(l.swipeLeft))))
    }, e.prototype.swipeStart = function (i) {
        var e, t = this;
        if (t.interrupted = !0, 1 !== t.touchObject.fingerCount || t.slideCount <= t.options.slidesToShow) return t.touchObject = {}, !1;
        void 0 !== i.originalEvent && void 0 !== i.originalEvent.touches && (e = i.originalEvent.touches[0]), t.touchObject.startX = t.touchObject.curX = void 0 !== e ? e.pageX : i.clientX, t.touchObject.startY = t.touchObject.curY = void 0 !== e ? e.pageY : i.clientY, t.dragging = !0
    }, e.prototype.unfilterSlides = e.prototype.slickUnfilter = function () {
        var i = this;
        null !== i.$slidesCache && (i.unload(), i.$slideTrack.children(this.options.slide).detach(), i.$slidesCache.appendTo(i.$slideTrack), i.reinit())
    }, e.prototype.unload = function () {
        var e = this;
        i(".slick-cloned", e.$slider).remove(), e.$dots && e.$dots.remove(), e.$prevArrow && e.htmlExpr.test(e.options.prevArrow) && e.$prevArrow.remove(), e.$nextArrow && e.htmlExpr.test(e.options.nextArrow) && e.$nextArrow.remove(), e.$slides.removeClass("slick-slide slick-active slick-visible slick-current").attr("aria-hidden", "true").css("width", "")
    }, e.prototype.unslick = function (i) {
        var e = this;
        e.$slider.trigger("unslick", [e, i]), e.destroy()
    }, e.prototype.updateArrows = function () {
        var i = this;
        Math.floor(i.options.slidesToShow / 2), !0 === i.options.arrows && i.slideCount > i.options.slidesToShow && !i.options.infinite && (i.$prevArrow.removeClass("slick-disabled").attr("aria-disabled", "false"), i.$nextArrow.removeClass("slick-disabled").attr("aria-disabled", "false"), 0 === i.currentSlide ? (i.$prevArrow.addClass("slick-disabled").attr("aria-disabled", "true"), i.$nextArrow.removeClass("slick-disabled").attr("aria-disabled", "false")) : i.currentSlide >= i.slideCount - i.options.slidesToShow && !1 === i.options.centerMode ? (i.$nextArrow.addClass("slick-disabled").attr("aria-disabled", "true"), i.$prevArrow.removeClass("slick-disabled").attr("aria-disabled", "false")) : i.currentSlide >= i.slideCount - 1 && !0 === i.options.centerMode && (i.$nextArrow.addClass("slick-disabled").attr("aria-disabled", "true"), i.$prevArrow.removeClass("slick-disabled").attr("aria-disabled", "false")))
    }, e.prototype.updateDots = function () {
        var i = this;
        null !== i.$dots && (i.$dots.find("li").removeClass("slick-active").end(), i.$dots.find("li").eq(Math.floor(i.currentSlide / i.options.slidesToScroll)).addClass("slick-active"))
    }, e.prototype.visibility = function () {
        var i = this;
        i.options.autoplay && (document[i.hidden] ? i.interrupted = !0 : i.interrupted = !1)
    }, i.fn.slick = function () {
        var i, t, o = this, s = arguments[0], n = Array.prototype.slice.call(arguments, 1), r = o.length;
        for (i = 0; i < r; i++) if ("object" == typeof s || void 0 === s ? o[i].slick = new e(o[i], s) : t = o[i].slick[s].apply(o[i].slick, n), void 0 !== t) return t;
        return o
    }
});
// captcha
// 'use strict';
// var _createClass = function () {
//     function defineProperties(target, props) {
//         for (var i = 0; i < props.length; i++) {
//             var descriptor = props[i];
//             descriptor.enumerable = descriptor.enumerable || false;
//             descriptor.configurable = true;
//             if ("value" in descriptor) descriptor.writable = true;
//             Object.defineProperty(target, descriptor.key, descriptor);
//         }
//     }
//
//     return function (Constructor, protoProps, staticProps) {
//         if (protoProps) defineProperties(Constructor.prototype, protoProps);
//         if (staticProps) defineProperties(Constructor, staticProps);
//         return Constructor;
//     };
// }();
//
// function _classCallCheck(instance, Constructor) {
//     if (!(instance instanceof Constructor)) {
//         throw new TypeError("Cannot call a class as a function");
//     }
// }
//
// var Captcha = function () {
//     function Captcha(_ref) {
//         var element = _ref.element;
//         _classCallCheck(this, Captcha);
//         this.element = element;
//         this.form;
//         this.isValid = false;
//         this.initCaptcha();
//     }
//
//     _createClass(Captcha, [{
//         key: 'initCaptcha', value: function initCaptcha() {
//             this.initForm();
//             this.stylizeElement();
//             this.element.innerHTML = '';
//         }
//     }, {
//         key: 'initForm', value: function initForm() {
//             if (this.element.parentElement.tagName === 'FORM') {
//                 this.form = this.element.parentElement;
//                 this.form.addEventListener('submit', this.handleSubmittingForm.bind(this));
//             } else {
//                 throw new Error('The parent of the captcha element must be a form element.');
//             }
//         }
//     }, {
//         key: 'stylizeElement', value: function stylizeElement() {
//             this.element.style.border = '1px solid #cccccc';
//             this.element.style.width = '100px';
//         }
//     }, {
//         key: 'handleSubmittingForm', value: function handleSubmittingForm(event) {
//             event.preventDefault();
//             this.checkValidity();
//             if (this.isValid === true) {
//                 return true;
//             } else {
//                 event.stopImmediatePropagation();
//                 return false;
//             }
//         }
//     }, {
//         key: 'checkValidity', value: function checkValidity() {
//             if (this.isValid === true) {
//                 this.enteredValidValue();
//             } else if (this.isValid === false) {
//                 this.enteredInvalidValue();
//             }
//         }
//     }, {
//         key: 'enteredValidValue', value: function enteredValidValue() {
//             this.element.style.border = '1px solid #00ff00';
//             if (this.element.classList.contains('captcha_invalid')) {
//                 this.element.classList.remove('captcha_invalid');
//             }
//             if (!this.element.classList.contains('captcha_valid')) {
//                 this.element.classList.add('captcha_valid');
//             }
//         }
//     }, {
//         key: 'enteredInvalidValue', value: function enteredInvalidValue() {
//             this.element.style.border = '1px solid #ff0000';
//             if (this.element.classList.contains('captcha_valid')) {
//                 this.element.classList.remove('captcha_valid');
//             }
//             if (!this.element.classList.contains('captcha_invalid')) {
//                 this.element.classList.add('captcha_invalid');
//             }
//         }
//     }, {
//         key: 'resetClassNames', value: function resetClassNames() {
//             if (this.element.classList.contains('captcha_valid')) {
//                 this.element.classList.remove('captcha_valid');
//             }
//             if (this.element.classList.contains('captcha_invalid')) {
//                 this.element.classList.remove('captcha_invalid');
//             }
//         }
//     }, {
//         key: 'resetStyling', value: function resetStyling() {
//             this.element.style.border = '1px solid #000000';
//         }
//     }]);
//     return Captcha;
// }();
// 'use strict';
// var _createClass = function () {
//     function defineProperties(target, props) {
//         for (var i = 0; i < props.length; i++) {
//             var descriptor = props[i];
//             descriptor.enumerable = descriptor.enumerable || false;
//             descriptor.configurable = true;
//             if ("value" in descriptor) descriptor.writable = true;
//             Object.defineProperty(target, descriptor.key, descriptor);
//         }
//     }
//
//     return function (Constructor, protoProps, staticProps) {
//         if (protoProps) defineProperties(Constructor.prototype, protoProps);
//         if (staticProps) defineProperties(Constructor, staticProps);
//         return Constructor;
//     };
// }();
// var _get = function get(object, property, receiver) {
//     if (object === null) object = Function.prototype;
//     var desc = Object.getOwnPropertyDescriptor(object, property);
//     if (desc === undefined) {
//         var parent = Object.getPrototypeOf(object);
//         if (parent === null) {
//             return undefined;
//         } else {
//             return get(parent, property, receiver);
//         }
//     } else if ("value" in desc) {
//         return desc.value;
//     } else {
//         var getter = desc.get;
//         if (getter === undefined) {
//             return undefined;
//         }
//         return getter.call(receiver);
//     }
// };
//
// function _classCallCheck(instance, Constructor) {
//     if (!(instance instanceof Constructor)) {
//         throw new TypeError("Cannot call a class as a function");
//     }
// }
//
// function _possibleConstructorReturn(self, call) {
//     if (!self) {
//         throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
//     }
//     return call && (typeof call === "object" || typeof call === "function") ? call : self;
// }
//
// function _inherits(subClass, superClass) {
//     if (typeof superClass !== "function" && superClass !== null) {
//         throw new TypeError("Super expression must either be null or a function, not " + typeof superClass);
//     }
//     subClass.prototype = Object.create(superClass && superClass.prototype, {
//         constructor: {
//             value: subClass,
//             enumerable: false,
//             writable: true,
//             configurable: true
//         }
//     });
//     if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass;
// }
//
// var BaseCaptcha = function (_Captcha) {
//     _inherits(BaseCaptcha, _Captcha);
//
//     function BaseCaptcha(_ref) {
//         var element = _ref.element;
//         _classCallCheck(this, BaseCaptcha);
//         var _this = _possibleConstructorReturn(this, (BaseCaptcha.__proto__ || Object.getPrototypeOf(BaseCaptcha)).call(this, {element: element}));
//         _this.canvas;
//         _this.context;
//         _this.code;
//         _this.input;
//         _this.enteredValue;
//         _this.initBaseCaptcha();
//         return _this;
//     }
//
//     _createClass(BaseCaptcha, [{
//         key: 'initBaseCaptcha', value: function initBaseCaptcha() {
//             this.generateCode();
//             this.generateCanvas();
//             this.writeCode();
//             this.appendCanvas();
//             this.generateInputElement();
//             this.appendInputElement();
//             this.addResetButton();
//             this.resetButton.addEventListener('click', this.handleClickResetButton.bind(this));
//         }
//     }, {
//         key: 'generateCanvas', value: function generateCanvas() {
//             this.canvas = document.createElement('canvas');
//             this.canvas.style.width = '100px';
//             this.canvas.style.height = '50px';
//         }
//     }, {
//         key: 'appendCanvas', value: function appendCanvas() {
//             this.element.appendChild(this.canvas);
//         }
//     }, {
//         key: 'getContext', value: function getContext() {
//             this.context = this.canvas.getContext('2d');
//         }
//     }, {
//         key: 'generateInputElement', value: function generateInputElement() {
//             var input = document.createElement('input');
//             input.setAttribute('type', 'text');
//             input.setAttribute('placeholder', 'enter,  please, the captcha');
//             input.setAttribute('class', 'captcha-base__input');
//             input.style.display = 'block';
//             this.input = input;
//         }
//     }, {
//         key: 'appendInputElement', value: function appendInputElement() {
//             if (this.element.nextSibling !== null) {
//                 this.form.insertBefore(this.input, this.element.nextSibling);
//             } else {
//                 this.form.appendChild(this.input);
//             }
//         }
//     }, {
//         key: 'addResetButton', value: function addResetButton() {
//             var resetButton = document.createElement('button');
//             resetButton.innerHTML = '&#8635;';
//             resetButton.setAttribute('class', 'captcha-base__reset');
//             resetButton.setAttribute('type', 'reset');
//             this.form.insertBefore(resetButton, this.input);
//             this.resetButton = resetButton;
//         }
//     }, {
//         key: 'handleClickResetButton', value: function handleClickResetButton(event) {
//             event.preventDefault();
//             this.clearCanvas();
//             this.generateCode();
//             this.writeCode();
//             this.input.value = '';
//             this.resetStyling();
//             this.resetClassNames();
//             console.log('resseted');
//         }
//     }, {
//         key: 'generateCode', value: function generateCode() {
//             this.code = this.generateRandomNum(100000, 999999);
//         }
//     }, {
//         key: 'writeCode', value: function writeCode() {
//             this.getContext();
//             this.context.font = '80px Arial';
//             var codeString = this.code.toString();
//             var textColor = void 0;
//             for (var i = 0; i < 6; i++) {
//                 this.context.fillStyle = this.getRandomColor();
//                 this.transformContext(i);
//                 this.context.fillText(codeString[i], i * 52, 110);
//                 this.resetTransformation();
//             }
//         }
//     }, {
//         key: 'clearCanvas', value: function clearCanvas() {
//             this.context.clearRect(0, 0, this.canvas.width, this.canvas.height);
//         }
//     }, {
//         key: 'checkValidity', value: function checkValidity() {
//             var inputValue = parseInt(this.input.value);
//             this.enteredValue = inputValue;
//             if (this.enteredValue === this.code) {
//                 this.isValid = true;
//             } else {
//                 this.isValid = false;
//             }
//             _get(BaseCaptcha.prototype.__proto__ || Object.getPrototypeOf(BaseCaptcha.prototype), 'checkValidity', this).call(this);
//         }
//     }, {
//         key: 'enteredValidValue', value: function enteredValidValue() {
//             _get(BaseCaptcha.prototype.__proto__ || Object.getPrototypeOf(BaseCaptcha.prototype), 'enteredValidValue', this).call(this);
//             if (this.input.classList.contains('captcha-base__input_invalid')) {
//                 this.input.classList.remove('captcha-base__input_invalid');
//             }
//             if (!this.input.classList.contains('captcha-base__input_valid')) {
//                 this.input.classList.add('captcha-base__input_valid');
//             }
//         }
//     }, {
//         key: 'enteredInvalidValue', value: function enteredInvalidValue() {
//             _get(BaseCaptcha.prototype.__proto__ || Object.getPrototypeOf(BaseCaptcha.prototype), 'enteredInvalidValue', this).call(this);
//             if (this.input.classList.contains('captcha-base__input_valid')) {
//                 this.input.classList.remove('captcha-base__input_valid');
//             }
//             if (!this.input.classList.contains('captcha-base__input_invalid')) {
//                 this.input.classList.add('captcha-base__input_invalid');
//             }
//         }
//     }, {
//         key: 'resetClassNames', value: function resetClassNames() {
//             _get(BaseCaptcha.prototype.__proto__ || Object.getPrototypeOf(BaseCaptcha.prototype), 'resetClassNames', this).call(this);
//             if (this.input.classList.contains('captcha-base__input_valid')) {
//                 this.input.classList.remove('captcha-base__input_valid');
//             }
//             if (this.input.classList.contains('captcha-base__input_invalid')) {
//                 this.input.classList.remove('captcha-base__input_invalid');
//             }
//         }
//     }, {
//         key: 'generateRandomNum', value: function generateRandomNum(min, max) {
//             var result = min - 0.5 + Math.random() * (max - min + 1);
//             return Math.round(result);
//         }
//     }, {
//         key: 'getRandomColor', value: function getRandomColor() {
//             var color = null;
//             var randomNum = void 0;
//             for (var i = 0; i < 3; i++) {
//                 randomNum = this.generateRandomNum(50, 230);
//                 color ? color = '#' + parseInt(randomNum, 16) : color += parseInt(randomNum, 16);
//             }
//             return color;
//         }
//     }, {
//         key: 'getRadiansFromDegrees', value: function getRadiansFromDegrees(degrees) {
//             return Math.PI / 180 * degrees;
//         }
//     }, {
//         key: 'transformContext', value: function transformContext(index) {
//             var degrees = this.generateRandomNum(0, 13);
//             if (index % 2 === 0) {
//                 degrees = -degrees;
//             }
//             var radians = this.getRadiansFromDegrees(degrees);
//             this.context.rotate(radians);
//         }
//     }, {
//         key: 'resetTransformation', value: function resetTransformation() {
//             this.context.setTransform(1, 0, 0, 1, 0, 0);
//         }
//     }]);
//     return BaseCaptcha;
// }(Captcha);
// 'use strict';
// var _createClass = function () {
//     function defineProperties(target, props) {
//         for (var i = 0; i < props.length; i++) {
//             var descriptor = props[i];
//             descriptor.enumerable = descriptor.enumerable || false;
//             descriptor.configurable = true;
//             if ("value" in descriptor) descriptor.writable = true;
//             Object.defineProperty(target, descriptor.key, descriptor);
//         }
//     }
//
//     return function (Constructor, protoProps, staticProps) {
//         if (protoProps) defineProperties(Constructor.prototype, protoProps);
//         if (staticProps) defineProperties(Constructor, staticProps);
//         return Constructor;
//     };
// }();
//
// function _classCallCheck(instance, Constructor) {
//     if (!(instance instanceof Constructor)) {
//         throw new TypeError("Cannot call a class as a function");
//     }
// }
//
// (function () {
//     var captchaApp = function () {
//         function captchaApp() {
//             _classCallCheck(this, captchaApp);
//             this.baseElements = document.getElementsByClassName('captcha-base');
//             this.init();
//         }
//
//         _createClass(captchaApp, [{
//             key: 'init', value: function init() {
//                 Array.prototype.forEach.call(this.baseElements, this.handleBaseElements.bind(this));
//             }
//         }, {
//             key: 'handleBaseElements', value: function handleBaseElements(element) {
//                 new BaseCaptcha({element: element});
//             }
//         }]);
//         return captchaApp;
//     }();
//     new captchaApp();
// })();
// end captcha

document.addEventListener('DOMContentLoaded', () => {
    const scrollItems = document.querySelectorAll('.load_anim');

    const scrollAnimation = () => {
        scrollItems.forEach(el => {
            el.classList.add('animation-class');
        });
    };

    window.addEventListener('load', () => {
        scrollAnimation();
    });
});
jQuery(document).ready(function ($) {

    $('#addMore').click(function() {
        var roleOptions = $('#role_select').html();
        var newInputs = `
        <div class="user-inputs">
        <input type="email" name="email[]" placeholder="Email" required>
        <input type="text" name="first_name[]" placeholder="Ім'я" required>
        <input type="text" name="last_name[]" placeholder="Прізвище" required>
        <select name="user_role[]">
            ${roleOptions}
        </select>     
        <input type="text" name="custom_role_name[]" placeholder="Назва ролі" disabled>
        </div>
    `;

        $('.user-inputs-wrapper').append(newInputs);
    });

    $('.edit-capabilities').click(function() {
        var userId = $(this).data('user-id');
        var $popup = $('#capabilities-popup-' + userId);
        var $form = $popup.find('#capabilities-form');  // Предполагаем, что форма находится внутри каждого попапа

        $form.find('[name="user_id"]').val(userId);

        // Загрузить текущие возможности пользователя и установить чекбоксы
        // Здесь вы можете добавить AJAX-запрос для загрузки текущих возможностей пользователя и установки чекбоксов

        $popup.dialog({
            title: "Редагувати можливості",
            modal: true,
            width: 768,
            buttons: {
                "Зберегти": function() {
                    // Здесь вы можете добавить AJAX-запрос для сохранения возможностей пользователя
                    $form.submit();
                },
                "Відміна": function() {
                    $(this).dialog("close");
                }
            }
        });
    });

    $(document).on('submit', '#capabilities-form', function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        $.post(ajaxurl, formData + '&action=update_user_capabilities', function(response) {
            if(response.success) {
                console.log(response);
                alert('Можливоств оновлені');
                $(e.target).closest(".ui-dialog-content").dialog("close");
            } else {
                console.log('Error: ' + response.data);
                alert('Виникла помилка');
            }
        });
    });


// Активация текстового поля для создания собственной роли при выборе "Создать свою роль"
    $(document).on('change', 'select[name="user_role[]"]', function() {
        var customRoleInput = $(this).next('input[name="custom_role_name[]"]');
        if ($(this).val() === 'custom') {
            customRoleInput.prop('disabled', false);
            customRoleInput.css('display', 'block');
        } else {
            customRoleInput.prop('disabled', true).val('');
            customRoleInput.css('display', 'none');
        }
    });



    function tran() {
        $(".cand_empl_btn").addClass('tran');
    }

    setTimeout(tran, 1000);
    $('*[data-menu="open"]').on('click', function () {
        $('body').toggleClass("show-menu");
    });
    $('*[data-menu="close"]').on('click', function () {
        $('body').removeClass("show-menu");
    });

    $widget = $("#widget-container");
    $(".tab-1-btn").on('click', function () {
        $widget.removeClass();
        $widget.addClass('active-tab-2');
    });

    $(".tab-2-btn").on('click', function () {
        $widget.removeClass();
        $widget.addClass('active-tab-3');
    });

    $(".tab-3-btn").on('click', function () {
        $widget.removeClass();
        $widget.addClass('active-tab-4');
    });

    // show/hide Candidates/Vacancies
    $("#candidate_btn").click(function () {
        $('.vacancy_slider').slick({
            autoplay: false,
            // autoplay: true,
            autoplaySpeed: 4000,
            dots: true,
            speed: 1000,
            cssEase: 'ease-out',
            arrows: false,
            slidesToShow: 3,

            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 2
                    }
                },
                {
                    breakpoint: 500,
                    settings: {
                        slidesToShow: 1
                    }
                }
            ]
        });
        // Testemonials Candidates
        $('.testimon_candidates_slider').slick({
            autoplay: true,
            // autoplay: true,
            autoplaySpeed: 9000,
            dots: false,
            speed: 1000,
            cssEase: 'ease-out',
            arrows: false,
            slidesToShow: 3,

            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 2
                    }
                },
                {
                    breakpoint: 500,
                    settings: {
                        slidesToShow: 1,
                        adaptiveHeight: true
                    }
                }
            ]
        });
        $(".home_wrapper").slideUp("slow");
        $("#vacancy").slideDown("slow");
    });

    // Vacansy
    $("#employer_btn").click(function () {
        $('.slick_slider').slick({
            autoplay: false,
            // autoplay: true,
            autoplaySpeed: 4000,
            dots: true,
            speed: 1000,
            cssEase: 'ease-out',
            arrows: false,
            slidesToShow: 4,

            responsive: [
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 3
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 2
                    }
                },
                {
                    breakpoint: 500,
                    settings: {
                        slidesToShow: 1
                    }
                }
            ]
        });

        $('.testimon_clients_slider').slick({
            autoplay: true,
            // autoplay: true,
            autoplaySpeed: 9000,
            dots: false,
            speed: 1000,
            cssEase: 'ease-out',
            arrows: false,
            slidesToShow: 3,

            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 2
                    }
                },
                {
                    breakpoint: 500,
                    settings: {
                        slidesToShow: 1,
                        adaptiveHeight: true
                    }
                }
            ]
        });
        $(".home_wrapper").slideUp("slow");
        $("#candidates").slideDown("slow");
    });
    $('.brand_slider').slick({
        autoplay: false,
        autoplaySpeed: 4000,
        dots: false,
        speed: 1000,
        cssEase: 'ease-out',
        arrows: false,
        slidesToShow: 6,
        adaptiveHeight: true,
        // centerMode: true,
        variableWidth: true,

        responsive: [
            {
                breakpoint: 992,
                settings: {
                    autoplay: true,
                    slidesToShow: 4,
                    adaptiveHeight: true
                }
            },
            {
                breakpoint: 768,
                settings: {
                    autoplay: true,
                    slidesToShow: 3,
                    adaptiveHeight: true
                }
            },
            {
                breakpoint: 500,
                settings: {
                    autoplay: true,
                    slidesToShow: 2,
                    adaptiveHeight: true
                }
            },
            {
                breakpoint: 350,
                settings: {
                    autoplay: true,
                    slidesToShow: 1,
                    adaptiveHeight: true
                }
            }
        ]
    });
// =============== home page ==============================
$(`<span class="dashicons dashicons-saved i1"></span>`).prependTo(".main_info p");
    $("#show_vac").click(function () {
        $("#serv_pg").slideUp("slow");
        $("#open_vacanc").slideDown("slow").css("display", "grid");
        $(".single_item").slideUp("slow");
    });

//show - hide format
    $('.qa_wrapper').each(function () {
        $('.qa_wrapper .togleShow').addClass('active');
        $('.qa_wrapper .togleShow .answ').css("display", "block");
        $(this).children('.q_a').children('.accordion-title').click(function () {
            var current_tab = $(this).parent();
            let format1 = '';
            let format2 = '';
            let format3 = '';
            let format4 = '';

            if ($('#i1').is(':checked')) {
                format1 = $('#i1').val();
                $(".boxForChosenFormat").prepend(`
                <p class="chosenVal1">${format1}</p>`);
            }
            if ($('#i2').is(':checked')) {
                format2 = $('#i2').val();
                $(".boxForChosenFormat").prepend(`
                <p class="chosenVal1">${format2}</p>`);
            }
            if ($('#i3').is(':checked')) {
                format3 = $('#i3').val();
                $(".boxForChosenFormat").prepend(`
                <p class="chosenVal1">${format3}</p>`);
            }
            if ($('#i4').is(':checked')) {
                format4 = $('#i4').val();
                $(".boxForChosenFormat").prepend(`
                <p class="chosenVal1">${format4}</p>`);
            }
            if (current_tab.hasClass('active')) {
                $(this).siblings('.answ').slideUp(function () {
                    current_tab.removeClass('active');
                });
            } else {
                $('.fh .chosenVal1').remove();
                $(this).siblings('.answ').slideDown(function () {
                    current_tab.addClass('active');
                });

            }
            current_tab.siblings().children('.answ').slideUp(function () {
                $(this).parent().removeClass('active');
            });
        });
    });
    $('.fr_wrapp').each(function () {
        $('.fr_wrapp .togleShow').addClass('active');
        $('.fr_wrapp .togleShow .answ').css("display", "block");
        $('.popup_form .fr_wrapp .togleShow').removeClass('active');
        $('.popup_form .fr_wrapp .togleShow .answ').css("display", "none");
        $(this).children('.q_a').children('.accordion-title, .tran').click(function () {
            var current_tab = $(this).parent();
            let format1 = '';
            let format2 = '';
            let format3 = '';
            let format4 = '';

            if ($('#ir1').is(':checked')) {
                format1 = $('#ir1').val();
                $(".rr").prepend(`
                <p class="cVal">${format1}</p>`);
            }
            if ($('#ir2').is(':checked')) {
                format2 = $('#ir2').val();
                $(".rr").prepend(`
                <p class="cVal">${format2}</p>`);
            }
            if ($('#ir3').is(':checked')) {
                format3 = $('#ir3').val();
                $(".rr").prepend(`
                <p class="cVal">${format3}</p>`);
            }
            if ($('#ir4').is(':checked')) {
                format4 = $('#ir4').val();
                $(".rr").prepend(`
                <p class="cVal">${format4}</p>`);
            }
            if (current_tab.hasClass('active')) {
                $(this).siblings('.answ').slideUp(function () {
                    current_tab.removeClass('active');
                });
            } else {
                $('.fh .cVal').remove();
                $(this).siblings('.answ').slideDown(function () {
                    current_tab.addClass('active');
                });

            }
            current_tab.siblings().children('.answ').slideUp(function () {
                $(this).parent().removeClass('active');
            });
        });
    });
    // ============================================================================
    $('.reg_wrap').each(function () {
        $('.reg_wrap .togleShow').addClass('active');
        $('.reg_wrap .togleShow .answ').css("display", "block");
        $(this).children('.q_a').children('.accordion-title').click(function () {
            var current_tab = $(this).parent();
            if (current_tab.hasClass('active')) {
                let notechVal = $('#regSelect').val();
                if (!notechVal) {
                    $(".boxRegion").prepend(`
                <p class="chosenVal3">Все регионы</p>`);
                } else {
                    $(".boxRegion").prepend(`
                <p class="chosenVal3">${notechVal}</p>`);
                }

                $(this).siblings('.answ').slideUp(function () {
                    current_tab.removeClass('active');
                });
            } else {
                $('.fh .chosenVal3').remove();
                $(this).siblings('.answ').slideDown(function () {
                    current_tab.addClass('active');
                });

            }
            current_tab.siblings().children('.answ').slideUp(function () {
                $(this).parent().removeClass('active');
            });
        });
    });
    $('.city_wrapper').each(function () {
        $('.city_wrapper .togleShow').addClass('active');
        $('.city_wrapper .togleShow .answ').css("display", "block");
        $(this).children('.q_a').children('.accordion-title').click(function () {
            var current_tab = $(this).parent();
            if (current_tab.hasClass('active')) {
                let cityVal = $('#citySelect').val();
                if (!cityVal) {
                    $(".boxForChosenCity").prepend(`
                <p class="chosenVal2"></p>`);
                } else {
                    $(".boxForChosenCity").prepend(`
                <p class="chosenVal2">${cityVal}</p>`);
                }

                $(this).siblings('.answ').slideUp(function () {
                    current_tab.removeClass('active');
                });
            } else {
                $('.fh .chosenVal2').remove();
                $(this).siblings('.answ').slideDown(function () {
                    current_tab.addClass('active');
                });

            }
            current_tab.siblings().children('.answ').slideUp(function () {
                $(this).parent().removeClass('active');
            });
        });
    });
    $('.notech_wrapper').each(function () {
        $('.notech_wrapper .togleShow').addClass('active');
        $('.notech_wrapper .togleShow .answ').css("display", "block");
        $(this).children('.q_a').children('.accordion-title').click(function () {
            var current_tab = $(this).parent();
            if (current_tab.hasClass('active')) {
                let notechVal = $('#vac_notech').val();
                if (!notechVal) {
                    $(".boxForChosenNoTech").prepend(`
                <p class="chosenVal3">Все Нетехнические</p>`);
                } else {
                   $(".boxForChosenNoTech").prepend(`<p class="chosenVal5">${notechVal}</p>`);
                }

                $(this).siblings('.answ').slideUp(function () {
                    current_tab.removeClass('active');
                });
            } else {
                $('.fh .chosenVal3').remove();
                $(this).siblings('.answ').slideDown(function () {
                    current_tab.addClass('active');
                });

            }
            current_tab.siblings().children('.answ').slideUp(function () {
                $(this).parent().removeClass('active');
            });
        });
    });
    $('.tech_wrapper').each(function () {
        $('.tech_wrapper .togleShow').addClass('active');
        $('.tech_wrapper .togleShow .answ').css("display", "block");
        $(this).children('.q_a').children('.accordion-title').click(function () {
            var current_tab = $(this).parent();
            if (current_tab.hasClass('active')) {
                let notechVal = $('#vac_framework').val();
                if (!notechVal) {
                    $(".boxForChosenTech").prepend(`
                <p class="chosenVal4">Все Tехнические</p>`);
                } else {
                    // if (notechVal=='zzДругие') {
                    //     $(".boxForChosenTech").prepend(`<p class="chosenVal5">${notechVal.slice(2)}</p>`);
                    // } else {
                    //     $(".boxForChosenTech").prepend(`<p class="chosenVal5">${notechVal}</p>`);
                    // }
                    $(".boxForChosenTech").prepend(`<p class="chosenVal5">${notechVal}</p>`);
                }

                $(this).siblings('.answ').slideUp(function () {
                    current_tab.removeClass('active');
                });
            } else {
                $('.fh .chosenVal4').remove();
                $(this).siblings('.answ').slideDown(function () {
                    current_tab.addClass('active');
                });

            }
            current_tab.siblings().children('.answ').slideUp(function () {
                $(this).parent().removeClass('active');
            });
        });
    });
    $('.spec_wrapper').each(function () {
        $('.spec_wrapper .togleShow').addClass('active');
        $('.spec_wrapper .togleShow .answ').css("display", "block");
        $(this).children('.q_a').children('.accordion-title').click(function () {
            var current_tab = $(this).parent();
            if (current_tab.hasClass('active')) {
                let notechVal = $('#vac_speciality').val();
                if (!notechVal) {
                    $(".boxForChosenSpec").prepend(`
                <p class="chosenVal5">Усі Спеціалізація</p>`);
                } else {
                    $(".boxForChosenSpec").prepend(`<p class="chosenVal5">${notechVal}</p>`);
                }

                $(this).siblings('.answ').slideUp(function () {
                    current_tab.removeClass('active');
                });
            } else {
                $('.fh .chosenVal5').remove();
                $(this).siblings('.answ').slideDown(function () {
                    current_tab.addClass('active');
                });

            }
            current_tab.siblings().children('.answ').slideUp(function () {
                $(this).parent().removeClass('active');
            });
        });
    });
    $('.addspec_wrapper').each(function () {
        $('.addspec_wrapper .togleShow').addClass('active');
        $('.addspec_wrapper .togleShow .answ').css("display", "block");
        $(this).children('.q_a').children('.accordion-title').click(function () {
            var current_tab = $(this).parent();
            if (current_tab.hasClass('active')) {
                let notechVal = $('#vac_addspeciality').val();
                console.log(notechVal);
                if (!notechVal) {
                    $(".boxForChosenAddSpec").prepend(`
                <p class="chosenVal3">Ще спеціалізації</p>`);
                } else {
                    $(".boxForChosenAddSpec").prepend(`<p class="chosenVal5">${notechVal}</p>`);
                }

                $(this).siblings('.answ').slideUp(function () {
                    current_tab.removeClass('active');
                });
            } else {
                $('.fh .chosenVal55').remove();
                $(this).siblings('.answ').slideDown(function () {
                    current_tab.addClass('active');
                });

            }
            current_tab.siblings().children('.answ').slideUp(function () {
                $(this).parent().removeClass('active');
            });
        });
    });
    $('.all_tech_wrapper').each(function () {
        $('.all_tech_wrapper .togleShow').addClass('active');
        $('.all_tech_wrapper .togleShow .answ').css("display", "block");
        $(this).children('.q_a').children('.accordion-title').click(function () {
            var current_tab = $(this).parent();
            if (current_tab.hasClass('active')) {
                let notechVal = $('#vac_techspeciality').val();
                console.log(notechVal);
                if (!notechVal) {
                    $(".boxForChosenTechSpec").prepend(`
                <p class="chosenVal3">Технології</p>`);
                } else {
                    $(".boxForChosenTechSpec").prepend(`<p class="chosenVal5">${notechVal}</p>`);
                }

                $(this).siblings('.answ').slideUp(function () {
                    current_tab.removeClass('active');
                });
            } else {
                $('.fh .chosenVal555').remove();
                $(this).siblings('.answ').slideDown(function () {
                    current_tab.addClass('active');
                });

            }
            current_tab.siblings().children('.answ').slideUp(function () {
                $(this).parent().removeClass('active');
            });
        });
    });
    $('.company_wrap').each(function () {
        $('.company_wrap .togleShow').addClass('active');
        $('.company_wrap .togleShow .answ').css("display", "block");
        $(this).children('.q_a').children('.accordion-title').click(function () {
            var current_tab = $(this).parent();
            if (current_tab.hasClass('active')) {
                let notechVal = $('#vac_comp').val();
                if (!notechVal) {
                    $(".boxForChosenComp").prepend(`
                <p class="chosenVal8">Все компании</p>`);
                } else {
                    $(".boxForChosenComp").prepend(`<p class="chosenVal8">${notechVal}</p>`);
                }

                $(this).siblings('.answ').slideUp(function () {
                    current_tab.removeClass('active');
                });
            } else {
                $('.fh .chosenVal8').remove();
                $(this).siblings('.answ').slideDown(function () {
                    current_tab.addClass('active');
                });

            }
            current_tab.siblings().children('.answ').slideUp(function () {
                $(this).parent().removeClass('active');
            });
        });
    });
    function d1() {
        // let cf =$('#vac_comp option:nth-last-child(2)').html().slice(2);
        // $('#vac_comp option:nth-last-child(2)').html(cf);
        // let cl =$('#vac_speciality option:nth-last-child(2)').html().slice(2);
        // $('#vac_speciality option:nth-last-child(2)').html(cl);
        // let ff =$('#vac_framework option:nth-last-child(2)').html().slice(2);
        // $('#vac_framework option:nth-last-child(2)').html(ff);
        // let nf =$('#vac_notech option:nth-last-child(2)').html().slice(2);
        // $('#vac_notech option:nth-last-child(2)').html(nf);
    }
    setTimeout(d1, 100);
    // $('.so option:last-child').css('color', 'red');
    $(".about_map").click(function () {
        $(".about_map").toggleClass('fullSize');
        $(".about2").toggleClass('about_click');
        $(".about2 .about1_descr").css('display', 'none');
        if (!$(".about_map").hasClass("fullSize")) {
            function explode() {
                $(".about2 .about1_descr").css('display', 'block');
            }

            setTimeout(explode, 600);
        }
    });

    $(".about1 p").prepend('<span class="dashicons dashicons-saved"></span>');
    $(".about2 p").prepend('<span class="dashicons dashicons-arrow-right-alt"></span>');
    $(".month_goals p").prepend('<span class="dashicons dashicons-arrow-right-alt ar"> </span>');

    // Prize slider
    $('.prize_slider').slick({
        autoplay: false,
        // autoplay: true,
        autoplaySpeed: 4000,
        dots: true,
        speed: 1000,
        cssEase: 'ease-out',
        arrows: false,
        slidesToShow: 3,

        responsive: [
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 2,
                    autoplay: true
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1
                }
            }
        ]
    });
});
jQuery(document).ready(function ($) {

    function copyToClipboard(element) {
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val($(element).text()).select();
        document.execCommand("copy");
        $temp.remove();
    }
    $('.cp_btn').on('click', function () {
        let cpbk = $(this).attr('id');
        copyToClipboard('#'+cpbk);
        $(this).parent().append('<div class="coppytext">Скопійовано</div>');
        setTimeout(function () {
            $('.coppytext').remove();
        }, 1500);
    });

        // $('.acf-basic-uploader').append('<div id="file">Завантажити файл</div>');
        // var wrapper = $('<div class="fwr"/>').css({height: 0, width: 0, 'overflow': 'hidden'});
        // var fileInput = $(':file').wrap(wrapper);
        //
        // fileInput.change(function () {
        //     $this = $(this);
        //     $('#file').text($this.val());
        //     $('.fwr').css({height: 'auto', width: 'auto', 'overflow': 'visible'});
        // })
        //
        // $('#file').click(function () {
        //     fileInput.click();
        // }).show();

    // jQuery(document).ready(function($) {
    //     $('.acf-basic-uploader').append('<div id="file">Завантажити файл</div>');
    //     var wrapper = $('<div class="fwr"/>').css({height: 0, width: 0, 'overflow': 'hidden'});
    //     var fileInput = $(':file').wrap(wrapper);
    //
    //     fileInput.on('change', async function(e) {
    //         console.log('File input change event triggered');
    //             $this = $(this);
    //             $('#file').text($this.val());
    //             $('.fwr').css({height: 'auto', width: 'auto', 'overflow': 'visible'});
    //     });
    //
    //     $('#file').click(function () {
    //         fileInput.click();
    //     }).show();
    // });
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // jQuery(document).ready(function($) {
    //     const fileInput = $('#acf-field_60d4627f9684e')[0];
    //     console.log(fileInput);
    //
    //     // Якщо fileInput не знайдено, завершити виконання скрипта
    //     if (!fileInput) {
    //         console.error('File input not found');
    //         return;
    //     }
    //
    //     const form = fileInput.closest('form');
    //     const pdfParsedField = $('input[name="pdf_parsed"]');
    //
    //     $(fileInput).on('change', async function (e) {
    //         console.log('File input change event triggered');
    //         if (fileInput.files.length > 0) {
    //             const file = fileInput.files[0];
    //             const fileExt = file.name.split('.').pop().toLowerCase();
    //             console.log('File extension:', fileExt);
    //
    //             if (fileExt === 'pdf') {
    //                 const pdfData = await readFileAsArrayBuffer(file);
    //                 const pdfParsedData = await parsePdfData(pdfData);
    //                 console.log('PDF parsed data:', pdfParsedData);
    //                 pdfParsedField.val(pdfParsedData);
    //             } else if (fileExt === 'docx') {
    //                 const wordData = await readFileAsArrayBuffer(file);
    //                 const wordParsedText = await parseWordData(wordData);
    //                 console.log('Word parsed data:', wordParsedText);
    //                 pdfParsedField.val(wordParsedText);
    //             } else {
    //                 console.error('Unsupported file format');
    //             }
    //
    //             // Додайте наступний рядок для відправки форми після завантаження файлу
    //             form.submit();
    //         }
    //     });
    //
    //     async function readFileAsArrayBuffer(file) {
    //         return new Promise((resolve, reject) => {
    //             const reader = new FileReader();
    //             reader.onload = e => resolve(e.target.result);
    //             reader.onerror = e => reject(e.target.error);
    //             reader.readAsArrayBuffer(file);
    //         });
    //     }
    //
    //     async function parsePdfData(data) {
    //         const loadingTask = pdfjsLib.getDocument({ data: data });
    //         const pdf = await loadingTask.promise;
    //         const numPages = pdf.numPages;
    //         let fullText = '';
    //
    //         for (let i = 1; i <= numPages; i++) {
    //             const page = await pdf.getPage(i);
    //             const content = await page.getTextContent();
    //             const strings = content.items.map(item => item.str);
    //             fullText += strings.join(' ');
    //         }
    //
    //         return fullText;
    //     }
    //
    //     async function parseWordData(data) {
    //         try {
    //             const arrayBuffer = new Uint8Array(data);
    //             const result = await mammoth.extractRawText({ arrayBuffer });
    //             const text = result.value;
    //             return text;
    //         } catch (error) {
    //             console.error('Error parsing Word data:', error);
    //             return '';
    //         }
    //     }
    // });
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // jQuery(document).ready(function($) {
    //     const fileInput = $('#acf-field_60d4627f9684e')[0];
    //     console.log(fileInput);
    //
    //     // Якщо fileInput не знайдено, завершити виконання скрипта
    //     if (!fileInput) {
    //         console.error('File input not found');
    //         return;
    //     }
    //
    //     const form = fileInput.closest('form');
    //     const pdfParsedField = $('input[name="pdf_parsed"]');
    //
    //     $(fileInput).on('change', async function (e) {
    //         console.log('File input change event triggered');
    //         if (fileInput.files.length > 0) {
    //             const file = fileInput.files[0];
    //             const fileExt = file.name.split('.').pop().toLowerCase();
    //             console.log('File extension:', fileExt);
    //
    //             if (fileExt === 'pdf') {
    //                 const pdfData = await readFileAsArrayBuffer(file);
    //                 const pdfParsedData = await parsePdfData(pdfData);
    //                 console.log('PDF parsed data:', pdfParsedData);
    //                 pdfParsedField.val(pdfParsedData);
    //             } else if (fileExt === 'docx') {
    //                 const wordData = await readFileAsArrayBuffer(file);
    //                 const wordParsedText = await parseWordData(wordData);
    //                 console.log('Word parsed data:', wordParsedText);
    //                 pdfParsedField.val(wordParsedText);
    //             } else {
    //                 console.error('Unsupported file format');
    //             }
    //         }
    //     });
    //
    //     async function readFileAsArrayBuffer(file) {
    //         return new Promise((resolve, reject) => {
    //             const reader = new FileReader();
    //             reader.onload = e => resolve(e.target.result);
    //             reader.onerror = e => reject(e.target.error);
    //             reader.readAsArrayBuffer(file);
    //         });
    //     }
    //
    //     async function parsePdfData(data) {
    //         const loadingTask = pdfjsLib.getDocument({ data: data });
    //         const pdf = await loadingTask.promise;
    //         const numPages = pdf.numPages;
    //         let fullText = '';
    //
    //         for (let i = 1; i <= numPages; i++) {
    //             const page = await pdf.getPage(i);
    //             const content = await page.getTextContent();
    //             const strings = content.items.map(item => item.str);
    //             fullText += strings.join(' ');
    //         }
    //
    //         return fullText;
    //     }
    //
    //     async function parseWordData(data) {
    //         try {
    //             const arrayBuffer = new Uint8Array(data);
    //             const result = await mammoth.extractRawText({ arrayBuffer });
    //             const text = result.value;
    //             return text;
    //         } catch (error) {
    //             console.error('Error parsing Word data:', error);
    //             return '';
    //         }
    //     }
    // });

    $('.popup-faq').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: true,
        arrows: true,
        infinite: false,
        prevArrow: "<button type='button' class='slick-prev'>Назад</button>",
        nextArrow: "<button type='button' class='slick-next'>Вперед</button>"
    });

// После инициализации слайдера:
    $('.slick-dots button').each(function() {
        $(this).html('<div class="dotline" style="width:30px; height:3px; background-color:#119f83;"></div>');
    });



    $('#openReg').on('click', function () {
        $('.reg-overlay').css('display','block');
        $('#multi-step-form').css('display','flex');
    });
    $('.css-l4r274').on('click', function () {
        $('.reg-overlay').css('display','none');
        $('#multi-step-form').css('display','none');
    });
    $('.closefaq').on('click', function () {
        $('.mainfaq').css('display','none');
    });

        $('.next-step').on('click', function() {
            if(!$('.agr .css-1m9pwf3').prop('checked')) {
                $('#errorRe').remove();
                $('.css-zgf1f3').append('<p id="errorRe" style="color:red">Ви повинні погодитись з правилами! *</p>');
            } else if($('#step-1 input#email').val() === "") {
                $('#errorRemove').remove();
                $('#step-1 .css-uri4pn').append('<p id="errorRemove" style="color:red">Не заповнено поле email адреси</p>');
            } else {
                var currentStep = $(this).parent().parent().parent();
                var nextStep = currentStep.next('.step');
                currentStep.hide();
                nextStep.show()
            }
        });
        $('.css-1qegsh7').on('click', function() {
            var currentStep = $('#step-2');
            var nextStep = currentStep.prev('.step');
            currentStep.hide();
            nextStep.show();
        });

        // Добавьте валидацию и отправку формы здесь
        $('.submit').on('click', function() {
            // Validate form
            // If valid, submit form
        });
    jQuery(document).ready(function($) {
        // Обработчик для второго шага
        // $('#formsubm').click(function(e) {
        //     e.preventDefault();
        //     var data = {
        //         action: 'submit_step',
        //         email: $('#email').val(),
        //         checkboxRules: $('input[name=checkboxRules]').is(':checked'),
        //         checkboxSubscribe: $('input[name=checkboxSubscribe]').is(':checked'),
        //         lastName: $('input[name=lastName]').val(),
        //         name: $('input[name=name]').val(),
        //         password: $('input[name=password]').val(),
        //         confirmPassword: $('input[name=confirmPassword]').val(),
        //         security: MyAjax2.security
        //     };
        //     $.post(MyAjax2.ajaxurl, data, function(response) {
        //
        //         $('.mainfaq').css('display','block');
        //     });
        // });
    });
    $('.css-vwfnud.agr').on('click',function (e) {
        e.preventDefault();
        if($(this).hasClass('che')) {
            $('.agr .css-vubbuv').css('display','inline-block');
            $('.agr .css-vubbuv.svgcheck').css('display','none');
            $('.agr .css-1m9pwf3').prop('checked', false);
            $('.css-vwfnud.agr').removeClass('che');
            console.log('re');
        } else {
            $('.agr .css-vubbuv').css('display', 'none');
            $('.agr .css-vubbuv.svgcheck').css('display', 'inline-block');
            $('.agr .css-1m9pwf3').prop('checked', true);
            $('.css-vwfnud.agr').toggleClass('che');
            console.log('do');
        }
    });
    $('.css-vwfnud.news').on('click',function (e) {
        e.preventDefault();
        if($(this).hasClass('chen')) {
            $('.news .vobbbb').css('display','inline-block');
            $('.news .vobbbb.svgcheckn').css('display','none');
            $('.news .css-1m9pwf3').prop('checked', false);
            $('.css-vwfnud.news').removeClass('chen');
            console.log('re');
        } else {
            $('.news .vobbbb').css('display', 'none');
            $('.news .vobbbb.svgcheckn').css('display', 'inline-block');
            $('.news .css-1m9pwf3').prop('checked', true);
            $('.css-vwfnud.news').toggleClass('chen');
            console.log('do');
        }
    });
    $('.col-right').on('click', 'input[type="text"]', function () {
        $('label.css-1dwrxu1').css('display','none');
        $('.css-yjsfm1').css('max-width','100%');
        $('.css-yjsfm1 > span').css('opacity','1');
    });

    $('.col-right input[type="text"]').on('mouseleave', function () {
        console.log(typeof this.value);
        if(!this.value){
            $('label.css-1dwrxu1').css('display','block');
            $('.css-yjsfm1').css('max-width','0.01px');
            $('.css-yjsfm1 > span').css('opacity','0');
        } else {
            $('label.css-1dwrxu1').css('display','none');
            $('.css-yjsfm1').css('max-width','100%');
            $('.css-yjsfm1 > span').css('opacity','1');
        }
    });

    $(function(){
        $('.modalCv').on('click', this, function () {
            let cvmodal = $(this).parent();
            cvmodal.addClass('active');
            $('.pipeCont .myCandW.baza').css('transform','none !important');
        });
        $("#modal-background, #modal-close").click(function () {
            $(".modalCv").parent().removeClass("active");
            $('.pipeCont .myCandW.baza').css('transform','scale(1.02) !important');
        });
    });

    $('#rbl').on('click', this, function () {
        let blmodal = $('.blacklistModal');
        blmodal.addClass('active');
    });
    $("#modal-background-bl, #modal-close-bl").click(function () {
        $(".blacklistModal").removeClass("active");
    });

    const search_input = $('.search-form__input');
    const search_results = $('.ajax-search');

    search_input.keyup(function () {
        let search_value = $(this).val();

        if (search_value.length > 2) { // кол-во символов
            $.ajax({
                url: '/wp-admin/admin-ajax.php',
                type: 'POST',
                data: {
                    'action': 'ajax_search', // functions.php
                    'term': search_value
                },
                success: function (results) {
                    search_results.fadeIn(200).html(results);
                }
            });
        } else {
            search_results.fadeOut(200);
        }
    });

    // Закрытие поиска при клике вне его
    $(document).mouseup(function (e) {
        if (
            (search_input.has(e.target).length === 0) &&
            (search_results.has(e.target).length === 0)
        ) {
            search_results.fadeOut(200);
        }
        ;
    });

    //popup
    let countCand = $('.sv_chose_cand .starWr[data-exist =yes]').length;
    $('.acf-field[data-name="c_num"] input').val(countCand);
    // console.log(countCand);
    $('*[data-popup="open"]').on('click', function () {
        $('body').addClass("show_popup");
        // let countCand = $('.sv_chose_cand .starWr[data-exist =yes]').length;
        // $('.acf-field[data-name="c_num"] input').val(countCand);
        // console.log(countCand);
    });
    $('*[data-popup="close"]').on('click', function () {
        $('body').removeClass("show_popup");
    });
    $('*[data-popupcl="open"]').on('click', function () {
        $('body').addClass("show_popupcl");
        // let countCand = $('.sv_chose_cand .starWr[data-exist =yes]').length;
        // $('.acf-field[data-name="c_num"] input').val(countCand);
        // console.log(countCand);
    });
    $('*[data-popupcl="close"]').on('click', function () {
        $('body').removeClass("show_popupcl");
    });
    $('*[data-popup3="open3"]').on('click', function () {
        $('body').addClass("show_popup");
        // let countCand = $('.sv_chose_cand .starWr[data-exist =yes]').length;
        // $('.acf-field[data-name="c_num"] input').val(countCand);
        // console.log(countCand);
    });
    $('*[data-popup3="close3"]').on('click', function () {
        $('body').removeClass("show_popup");
    });
    $(".rek_from_db").on("click", ".rd", delRekWrap);

    function delRekWrap(e) {

        var thisR = $(e.target).parents("section");
        let postId = thisR.data('id');
        let delDataRek = {
            'postId': thisR.data('id')
        }
        function delRek(postId) {
            $.ajax({
                // beforeSend: (xhr) => {
                //     xhr.setRequestHeader('X-WP-Nonce', devportData.cb);
                // },
                // url: devportData.root_url + '/wp-json/wp/v2/rekomend/140',
                // url: devportData.root_url + '/wp-json/wp/v2/rekomend/' + thisR.data('id'),
                url: devportData.root_url + '/wp-json/dp/v1/rekom/',
                type: 'DELETE',
                data: delDataRek,
                success: (response) => {
                    thisR.slideUp();
                    // console.log("Congrat!!");
                    // console.log(response);
                },
                error: (response) => {
                     console.log("Sory((");
                     console.log(response);
                }
            });
        }
        delRek(postId);
    }

    $(".rek_from_db").on("click", ".re", edRek.bind(this));

    function edRek(e) {
        var thisR = $(e.target).parents("section");
        if (thisR.data("state") == "editable") {
            makeRekomReadOnly(thisR);
        } else {
            makeRekomEditible(thisR);
        }
    }

    function makeRekomEditible(thisR) {
        thisR.find(".re").html('<span class="dashicons dashicons-no"></span> Cancel');
        thisR.find(".rt, .r1, .r2, .r3, .r4, .r5, .r6").removeAttr("readonly").addClass("rek_active_field");
        thisR.find(".rSave").slideDown("fast");
        thisR.data("state", "editable");
    }

    function makeRekomReadOnly(thisR) {
        thisR.find(".re").html('<span class="dashicons dashicons-edit"></span> Edit');
        thisR.find(".rt, .r1, .r2, .r3, .r4, .r5, .r6").attr("readonly", "readonly").removeClass("rek_active_field");
        thisR.find(".rSave").slideUp("fast");
        thisR.data("state", "cancel");
    }

    $(".rek_from_db").on("click", ".rSave", updRekWrapper.bind(this));
function updRekWrapper(e) {
    let thisR = $(e.target).parents("section");
    let postId = thisR.data('id');
    let updatedRek = {
        'postId': thisR.data('id'),
        'title': thisR.find(".rt").val(),
        // 'content': thisR.find(".r1").val(),
        'email_r': thisR.find(".r2").val(),
        'tel_r': thisR.find(".r5").val(),
        'resume_r': thisR.find(".r3").val(),
        'spec1': thisR.find(".r4").val(),
        // 'addspec1': thisR.find(".r4").val(),
        'zarplata': thisR.find(".r6").val()
    }
    function updRek(postId) {
        $.ajax({
            // beforeSend: (xhr) => {
            //     xhr.setRequestHeader('X-WP-Nonce', devportData.cb);
            // },
            // url: devportData.root_url + '/wp-json/wp/v2/rekomend/' + thisR.data('id'),
            url: devportData.root_url + '/wp-json/dp/v1/rekom/',
            type: 'PUT',
            data: updatedRek,
            success: (response) => {
                makeRekomReadOnly(thisR);
                // thisR.slideUp();
                // console.log("Congrat!!");
                console.log(response);
            },
            error: (response) => {
                makeRekomReadOnly(thisR);
                 // console.log("Sory((");
                // console.log(response);
            }
        });
        console.log(updatedRek);
    }
    updRek(postId);
}
    var files; // переменная. будет содержать данные файлов

// заполняем переменную данными, при изменении значения поля file
//     $('input[type=file]').on('change', function(){
    $('.t1a').on('change', function(){
        files = this.files;
    });
    // обработка и отправка AJAX запроса при клике на кнопку upload_files
    $('.upload_files').on( 'click', function( event ){

        event.stopPropagation(); // остановка всех текущих JS событий
        event.preventDefault();  // остановка дефолтного события для текущего элемента - клик для <a> тега

        // ничего не делаем если files пустой
        if( typeof files == 'undefined' ) return;

        // создадим данные файлов в подходящем для отправки формате
        var data = new FormData();
        $.each( files, function( key, value ){
            data.append( key, value );
        });

        // добавим переменную идентификатор запроса
        data.append( 'my_file_upload', 1 );

        // AJAX запрос
        $.ajax({
            url         : './submit.php',
            type        : 'POST',
            data        : data,
            cache       : false,
            dataType    : 'json',
            // отключаем обработку передаваемых данных, пусть передаются как есть
            processData : false,
            // отключаем установку заголовка типа запроса. Так jQuery скажет серверу что это строковой запрос
            contentType : false,
            // функция успешного ответа сервера
            success     : function( respond, status, jqXHR ){

                // ОК
                if( typeof respond.error === 'undefined' ){
                    // файлы загружены, делаем что-нибудь

                    // покажем пути к загруженным файлам в блок '.ajax-reply'

                    var files_path = respond.files;
                    var html = '';
                    $.each( files_path, function( key, val ){
                        html += val +'<br>';
                    } )

                    $('.ajax-reply').html( html );
                }
                // error
                else {
                    console.log('ОШИБКА: ' + respond.error );
                }
            },
            // функция ошибки ответа сервера
            error: function( jqXHR, status, errorThrown ){
                console.log( 'ОШИБКА AJAX запроса: ' + status, jqXHR );
            }

        });

    });
// let files;
//     $('.nr3').on('change', function(){
//         files = this.files;
//         console.log(files);
//     });

    // $('.submitNewRek').prop('disabled', true);
    // $('input.nrt').keyup(function() {
    //     if($(this).val() != '') {
    //         $('.submitNewRek').removeClass('nvalid1');
    //         // $('.submitNewRek').prop('disabled', false);
    //     } else {
    //         // $('.submitNewRek').prop('disabled', true);
    //         $('.submitNewRek').addClass('nvalid1');
    //     }
    // });
    // $('input.nr2').keyup(function() {
    //     if($(this).val() != '') {
    //         $('.submitNewRek').removeClass('nvalid2');
    //         // $('.submitNewRek').prop('disabled', false);
    //     } else {
    //         // $('.submitNewRek').prop('disabled', true);
    //         $('.submitNewRek').addClass('nvalid2');
    //     }
    // });


    $(".submitNewRek").on("click", createRek);

    function createRek(e) {
        var formData = new FormData();
        let fileData = $(".nr3")[0];

        let tval = $(".nrt").val().length;
        let ev = $(".nr2").val().length;
        let cu = $(".cuID").val();

        console.log(cu);
        if (tval > 1 && ev > 5) {
            let newRek = {
                'title': $(".nrt").val(),
                'email_r': $(".nr2").val(),
                'tel_r': $(".nr5").val(),
                // 'resume_r': $(".nr3").val(),
                'resume_r': $(".t2a").val(),
                'spec1': $(".nr4").val(),
                // 'addspec1': $(".nr4").val(),
                'zarplata': $(".nr6").val(),
                'user_r': $(".cuID").val(),
                // 'resume_r': files,"
                'status': 'publish'
            }
            $.ajax({
                beforeSend: (xhr) => {
                    xhr.setRequestHeader('X-WP-Nonce', devportData.cb);
                },
                // url: devportData.root_url + '/wp-json/wp/v2/rekomend/',
                url: devportData.root_url + '/wp-json/dp/v1/rekom/',
                type: 'POST',
                processData : false,
                // cache: false,
                // processData: false, // important
                // contentType: false, // important
                // dataType : 'json',
                data: newRek,
                success: (response) => {
                    $('body').removeClass("show_popup");
                    $(`
                     <div class="myCandW mcd" data-id="${response.id}">
                        <div class="mcName">
                            <input readonly type="text" value="${newRek.title}">
                            <input readonly type="text" value="${newRek.email_r}">
                        </div>
                        <div class="mcd1">            
                             <input readonly type="text" value="${newRek.spec1}">
                             // <input readonly type="text" value="${newRek.addspec1}">
                             <input readonly type="text" class="vdatewr" value="${newRek.zarplata}$">
                        </div>
                        <div class="mcd">
                            <p class="stNew">Особистий</p>
                        </div> 
                    </div>
                       `).prependTo(".allmr").hide().slideDown();
                    $(".nrt, .nr2, .nr3, .nr4, .anr4, .nr5, .nr6, .addC, .exp_r, .engl_r").val('');
                    $('.cVal').remove();
                    // console.log(newRek);
                    // $(".nrt, .nr2, .nr3, .nr4, .nr5, .nr6").val('');


                    //     $(`
                    //     <section class="rekom_item" data-id="${response.id}">
                    //     <input readonly class="rt" value="${newRek.title}">
                    //     <span class="re"><span class="dashicons dashicons-edit"></span> Edit</span>
                    //     <span class="rd"><span class="dashicons dashicons-trash"></span> Delete</span>
                    //     <p>Статус: Новый</p>
                    //     <input readonly class="r2" value="${newRek.email_r}">
                    //     <input readonly class="r2" value="${newRek.tel_r}">
                    //     <input type="file" readonly class="r3" value="${newRek.resume_r}">
                    //     <input readonly class="r4" value="${newRek.spec1}">
                    //     <input readonly class="r4" value="${newRek.zarplata}">
                    //     <div class="rSave">Save <span class="dashicons dashicons-database-view"></span></div>
                    // </section>
                    //    `).prependTo(".rek_from_db").hide().slideDown();


                    // thisR.slideUp();
                    // console.log("Congrat!!");
                    console.log(response);
                },
                error: (response) => {
                    // console.log("Sory((");
                    console.log(response);
                }
            });
        } else {e.preventDefault(); e.stopPropagation();}
    }
    // ======================================================================
    // $('.addNewCand input[value="Создать кандидата"]').on('click', function () {
    //     alert('ffg55');
    // });
    // ======================================================================
    $('.left_vac').each(function () {
        // $('.qa_wrapper .q_a:first').addClass('active');
        // $('.qa_wrapper .q_a:first .answ').css("display", "block");
        $(this).children('.q_a').children('.accordion-title').click(function () {
            var current_tab = $(this).parent();
            if (current_tab.hasClass('active')) {
                $(this).siblings('.answ').slideUp(function () {
                    current_tab.removeClass('active');
                });
            } else {
                $(this).siblings('.answ').slideDown(function () {
                    current_tab.addClass('active');
                });

            }
            current_tab.siblings().children('.answ').slideUp(function () {
                $(this).parent().removeClass('active');
            });
        });
    });

    $('.let_candidat').click(function () {
        $('.vcform').slideDown('fast');

    });
    $('.vcf_submit').click(function () {
        $('.vcform').slideUp('fast');

    });
// open select
    var $window = $(window);
    var $pane = $('#pane1');

    function checkWidth() {
        var windowsize = $window.width();
        if (windowsize > 600) {
            //if the window is greater than 440px wide then turn on jScrollPane..
            let countCities = $('.countCities').val();
            $('#citySelect').attr('size', countCities );
            let countFramew = $('.countFamework').val();
            $('#vac_framework').attr('size', countFramew );
            let countComp = $('.countComp').val();
            $('#vac_comp').attr('size', countComp );
            let countLang = $('.countLang').val();
            $('#vac_speciality').attr('size', countLang );
            let countAddLang = $('.countAddLang').val();
            $('#vac_addspeciality').attr('size', countAddLang );
            let countTechLang = $('.countTechLang').val();
            $('#vac_techspeciality').attr('size', countTechLang );
            let countNotech = $('.countNoTech').val();
            $('#vac_notech').attr('size', countNotech );
        } else {
            $('#citySelect').attr('size', 1 );
            $('#vac_framework').attr('size', 1 );
            $('#vac_speciality').attr('size', 1 );
            $('#vac_addspeciality').attr('size', 1 );
            $('#vac_techspeciality').attr('size', 1 );
            $('#vac_comp').attr('size', 1 );
            $('#vac_notech').attr('size', 1 );
        }
    }
    // Execute on load
    checkWidth();
    // Bind event listener
    $(window).resize(checkWidth);
    function showLoader() {
        $('#loader').show();
        $('.vac_descr.clientVacancy').css('visibility','hidden');
    }
    function hideLoader() {
        setTimeout(function () {
            $('#loader').hide();
            $('.vac_descr.clientVacancy').css('visibility','visible');
        },1000 );
    }
    function filtersApplied() {
        let vfilters = JSON.parse(localStorage.getItem('vfilters'));

        // Проверка, если хоть одно значение фильтра определено и не пустое
        for (let key in filters) {
            if (filters[key] !== undefined && filters[key] !== '') {
                return true;
            }
        }
        return false;
    }

//     let vspec1 = [];
//     let vregExName = '';
//     let vregExAddName = '';
//     let vnoTech = '';
//     let vregCountry = '';
//     let voput = '';
//     let vzarpl = '';
//     let vzarpl_to = '';
//     let vworkFormats = [];
//     let venglishLevels = [];
//     let vdatacontact = [];
//
// // Проверка наличия сохраненных фильтров при загрузке страницы
//     $(document).ready(function() {
//         setTimeout(function() {
//             let vsavedFilters = localStorage.getItem('vfilters');
//
//             if (vsavedFilters) {
//                 let vfilters = JSON.parse(vsavedFilters);
//                 vspec1 = vfilters.vspec1;
//                 vregExName = vfilters.vregExName;
//                 vregExAddName = vfilters.vregExAddName;
//                 vnoTech = vfilters.vnoTech;
//                 vregCountry = vfilters.vregCountry;
//                 voput = vfilters.voput;
//                 vzarpl = vfilters.vzarpl;
//                 vzarpl_to = vfilters.vzarpl_to;
//                 vworkFormats = vfilters.vworkFormats;
//                 venglishLevels = vfilters.venglishLevels;
//                 vdatacontact = vfilters.vdatacontact;
//
//                 // Установите значения фильтров в соответствии с сохраненными
//                 $('#vac_speciality').val(vregExName);
//                 $('#vac_addspeciality').val(vregExAddName);
//                 $('#vac_notech').val(vnoTech);
//                 $('#vac_country').val(vregCountry);
//                 $('#opyt_vacans_input').val(voput);
//                 $('#opyt_vacans').text(voput);
//                 $('#zarpl').val(vzarpl);
//                 $('#zarpl_to').val(vzarpl_to);
//
//                 // Обновите состояние чекбоксов в соответствии с сохраненными фильтрами
//                 $('.spec1-checkbox').each(function() {
//                     if (vspec1.includes($(this).val().trim().replace(/[\-\[\]{}()*+?.,\\\^$|#\s]/g, "\\$&"))) {
//                         $(this).prop('checked', true);
//                     }
//                 });
//                 if (Array.isArray(venglishLevels)) {
//                     venglishLevels.forEach(function(level) {
//                         $(`input[data-level='${level}']`).prop('checked', true);
//                     });
//                 } else {
//                     // Convert to array before using forEach
//                     Array.from(venglishLevels).forEach(function(level) {
//                         $(`input[data-level='${level}']`).prop('checked', true);
//                     });
//                 }
//                 if (Array.isArray(vworkFormats)) {
//                     vworkFormats.forEach(function(format) {
//                         $(`input[data-level='${format}']`).prop('checked', true);
//                     });
//                 } else {
//                     // Convert to array before using forEach
//                     Array.from(vworkFormats).forEach(function(format) {
//                         $(`input[data-level='${format}']`).prop('checked', true);
//                     });
//                 }
//                 if (Array.isArray(vdatacontact)) {
//                     vdatacontact.forEach(function(comm) {
//                         $(`input[data-level='${comm}']`).prop('checked', true);
//                     });
//                 } else {
//                     // Convert to array before using forEach
//                     Array.from(vdatacontact).forEach(function(comm) {
//                         $(`input[data-level='${comm}']`).prop('checked', true);
//                     });
//                 }
//
//                 isFiltering = true;
//                 currentPage = 1; // Сбрасываем страницу на 1
//                 filterVacansies();
//             }
//         }, 0);
//     });
//
//     let currentPage = 1;
//     let isFiltering = false;
//     let maxPages = 1;
//     let ajaxInProgress = false;
//
//     function filterVacansies() {
//         function filterVacTimeout() {
//             if (ajaxInProgress) return;
//
//             let venglishLevels = [];
//             $('.english-level-checkbox:checked').each(function() {
//                 venglishLevels.push($(this).val());
//             });
//
//             let vworkFormats = [];
//             $('.work-format-checkbox:checked').each(function() {
//                 vworkFormats.push($(this).val());
//             });
//
//             let vdatacontact = [];
//             $('.contact-checkbox:checked').each(function() {
//                 vdatacontact.push($(this).val());
//             });
//
//             let vzarpl = $('#zarpl').val();
//             let vzarpl_to = $('#zarpl_to').val();
//             if (vzarpl_to === '') {
//                 vzarpl_to = 510000;
//             }
//
//             let voput = $('#opyt_vacans_input').val();
//             if (voput === '7.5') {
//                 voput = 0;
//             }
//
//             vspec1 = [];
//             $('.spec1-checkbox:checked').each(function() {
//                 vspec1.push($(this).val().trim().replace(/[\-\[\]{}()*+?.,\\\^$|#\s]/g, "\\$&"));
//             });
//
//             $(".vac_item").filter(function() {
//                 let vrtnData = "";
//                 let vmatchCount = 0;
//                 let vregExName = $('#vac_speciality').val().trim().replace(/[\-\[\]{}()*+?.,\\\^$|#\s]/g, "\\$&");
//                 let vregExAddName = $('#vac_addspeciality').val().trim().replace(/[\-\[\]{}()*+?.,\\\^$|#\s]/g, "\\$&");
//                 let vnoTech = new RegExp($('#vac_notech').val().trim(), "ig");
//                 let vregCountry = $('#vac_country').val();
//                 let voputattr = $(this).data("opyt");
//                 if (voputattr === '') {
//                     voputattr = 0;
//                 }
//
//                 for (let vvalue of vspec1) {
//                     let vregEx = new RegExp(vvalue, "ig");
//                     if ($(this).attr("data-spec").match(vregEx)) {
//                         vmatchCount++;
//                     }
//                 }
//
//                 vrtnData = (
//                     vmatchCount === vspec1.length &&
//                     $(this).attr("data-spec").match(vregExName) &&
//                     $(this).attr("data-spec").match(vregExAddName) &&
//                     $(this).attr("data-spec").match(vnoTech) &&
//                     $(this).data("zarplata") >= vzarpl &&
//                     $(this).data("zarplata") <= vzarpl_to &&
//                     (vworkFormats.length === 0 || vworkFormats.some(format => $(this).attr("data-work_format").includes(format))) &&
//                     ($('#vac_country').val() === '' || $('#vac_country').val().split('|').some(vcountry => vcountry === $(this).attr("data-country"))) &&
//                     voputattr >= voput &&
//                     (venglishLevels.length === 0 || venglishLevels.some(level => $(this).attr("data-angl").includes(level))) &&
//                     (vdatacontact.length === 0 || vdatacontact.some(comm => $(this).attr("data-datacontact").includes(comm)))
//                 );
//
//                 return vrtnData;
//             });
//         }
//
//         setTimeout(filterVacTimeout, 300);
//
//         let postCount = $('.right_vac .vac_item:visible').length;
//         $('.dp_post_count').html(`
//         Найдено вакансий: ${postCount}
//     `);
//
//         let vfilters = {
//             vspec1: vspec1,
//             vregExName: vregExName,
//             vregExAddName: vregExAddName,
//             vnoTech: vnoTech,
//             vregCountry: vregCountry,
//             voput: voput,
//             vzarpl: vzarpl,
//             vzarpl_to: vzarpl_to,
//             vworkFormats: vworkFormats,
//             venglishLevels: venglishLevels,
//             vdatacontact: vdatacontact
//         };
//
//         let vselectedCountries = JSON.parse(localStorage.getItem('vselectedCountries')) || [];
//         let vselectedValues = JSON.parse(localStorage.getItem('vselectedValues')) || [];
//
//         localStorage.setItem('vfilters', JSON.stringify(vfilters));
//
//         // Отправка AJAX-запроса для фильтрации элементов
//         ajaxInProgress = true;
//         // $('.left_vac').css('pointer-events', 'none');
//         // $('#reset-filters').css('pointer-events', 'none');
//
//         $.ajax({
//             url: '/wp-admin/admin-ajax.php',
//             data: {
//                 action: 'filter_vac',
//                 page: currentPage,
//                 vfilters: vfilters ? vfilters : [],
//                 filterscountry: vselectedCountries ? vselectedCountries : [],
//                 searchfilters: vselectedValues ? vselectedValues : [],
//             },
//             type: 'POST',
//             dataType: 'json',
//             beforeSend: function() {
//                 // $('.left_vac').css('pointer-events', 'none');
//             },
//             success: function(response) {
//                 console.log(response);
//                 currentPage = response.currentPage;
//                 maxPages = response.maxPages;
//
//                 if (currentPage < maxPages) {
//                     $('#load-more').show();
//                 } else {
//                     $('#load-more').hide();
//                 }
//
//                 // Замена текущего списка элементов отфильтрованным списком
//                 if (isFiltering) {
//                     $('.allmr.pipeCont.list').empty();
//                     isFiltering = false; // Сбрасываем флаг фильтрации
//                 }
//
//                 $('.vac_descr.clientVacancy').append(response.posts);
//                 currentPage++;
//                 hideLoader();
//             },
//             error: function(error) {
//                 console.log('Failed to filter posts:', error);
//             },
//             complete: function() {
//                 // Независимо от того, удался AJAX-запрос или нет, устанавливаем состояние обратно в false, поскольку AJAX-запрос закончился
//                 ajaxInProgress = false;
//                 // $('.left_vac.pipe').css('pointer-events', 'all');
//                 // $('#reset-filters').css('pointer-events', 'all');
//             },
//         });
//     }
//
// // end open select
//     $('#vac_filtrs').on("change keyup", function () {
//         isFiltering = true;
//         currentPage = 1; // Сбрасываем страницу на 1
//         filterVacansies();
//     });
//     $('#load-more').on('click', function() {
//         // applyFilter(currentPage + 1)
//         filterVacansies(currentPage + 1); // загружаем следующую страницу
//         // isFiltering = true;
//     });
//
//     ////////////////////////////////       Reset filters           /////////////////////////////////////////////////////
//     $('#reset-vacfilters').on('click', function () {
//         selectedValues = [];
//         $('.tag').remove();
//         $('.kandItem1').show();
//         localStorage.setItem('vselectedValues', JSON.stringify(vselectedValues));
//         localStorage.setItem('vfilters', JSON.stringify([]));
//         localStorage.setItem('vselectedCountries', JSON.stringify([]));
//         $('input[type=checkbox]').prop('checked', false);
//         $('#vac_speciality').val('');
//         $('#vac_addspeciality').val('');
//         $('#vac_notech').val('');
//         $('#vac_country').val('');
//         // $('#opyt_vacans_input').val(0);
//         // $('#opyt_vacans').val('');
//         $('#zarpl').val('');
//         $('#zarpl_to').val('');
//
//         // Обновите состояние чекбоксов в соответствии с сохраненными фильтрами
//         $('.spec1-checkbox').each(function () {
//             if (vspec1.includes($(this).val().trim().replace(/[\-\[\]{}()*+?.,\\\^$|#\s]/g, "\\$&"))) {
//                 $(this).prop('checked', false);
//             }
//         });
//
//         if (Array.isArray(venglishLevels)) {
//             venglishLevels.forEach(function(level) {
//                 $(`input[data-level='${level}']`).prop('checked', false);
//             });
//         } else {
//             // Convert to array before using forEach
//             Array.from(venglishLevels).forEach(function(level) {
//                 $(`input[data-level='${level}']`).prop('checked', false);
//             });
//         }
//         if (Array.isArray(vworkFormats)) {
//             vworkFormats.forEach(function(format) {
//                 $(`input[data-level='${format}']`).prop('checked', false);
//             });
//         } else {
//             // Convert to array before using forEach
//             Array.from(vworkFormats).forEach(function(format) {
//                 $(`input[data-level='${format}']`).prop('checked', false);
//             });
//         }
//         if (Array.isArray(vdatacontact)) {
//             vdatacontact.forEach(function(comm) {
//                 $(`input[data-level='${comm}']`).prop('checked', false);
//             });
//         } else {
//             // Convert to array before using forEach
//             Array.from(vdatacontact).forEach(function(comm) {
//                 $(`input[data-level='${comm}']`).prop('checked', false);
//             });
//         }
//         $('.multiselect .countrySing').removeClass('selected');
//         isFiltering = true;
//         currentPage = 1; // Сбрасываем страницу на 1
//         filterVacansies();
//     });
//     // ==============================================================
//     // ============ Candidate search/input/filter START =============
//     // ==============================================================
//     var vselectedValues = JSON.parse(localStorage.getItem('vselectedValues')) || [];
// // Восстановить пользовательский интерфейс
//     for (var i = 0; i < vselectedValues.length; i++) {
//         $('<div>').addClass('tag').text(vselectedValues[i]).appendTo('.vselectedElements');
//     }
//
//     $('.pipef').on("keyup", function (event) {
//         let divs = $('.tech_sc');
//         var availableAttributes = [];
//         for (var i = 0; i < divs.length; i++) {
//             availableAttributes.push(divs[i].textContent);
//         }
//         $("#pipe0").autocomplete({
//             source: availableAttributes
//         });
//     });
//     // Wait for keypress events on the input field
//     $('#pipe0').on('keypress', function (event) {
//         // Check if the key pressed was enter or space
//         // if (event.which === 13 || event.which === 32) {
//         if (vselectedValues.length > 0) {
//             $('#reset-filters').show();
//         }
//         if (event.which === 13) {
//             // Get the entered value
//             var capitalized = $(this).val().trim();
//             const value = capitalized.charAt(0).toUpperCase() + capitalized.slice(1);
//
//             // Clear the input field
//             $(this).val('');
//             // Check if the entered value is not empty
//             if (value !== '') {
//                 // Add the entered value to the selected values array
//                 selectedValues.push(value);
//                 // Filter the elements with the "kandItem1" class based on the selected values
//                 showLoader();
//                 // Add the entered value as a tag to the "selectedElements" element
//                 $('<div>').addClass('tag').text(value).appendTo('.vselectedElements');
//             }
//             localStorage.setItem('vselectedValues', JSON.stringify(vselectedValues));
//             isFiltering = true;
//             currentPage = 1; // Сбрасываем страницу на 1
//             filterVacansies();
//         }
//         // applyFilter();
//     });
//
//     // Remove tag functionality
//     $('.selectedElements').on('click', '.tag', function () {
//         var value = $(this).text();
//         // Remove the value from the selected values array
//         vselectedValues = $.grep(vselectedValues, function (val) {
//             return val !== value;
//         });
//         $(this).remove();
//         showLoader();
//         localStorage.setItem('vselectedValues', JSON.stringify(vselectedValues));
//         isFiltering = true;
//         currentPage = 1; // Сбрасываем страницу на 1
//         filterVacansies();
//     });
//
//     // Reset filter functionality
//     $('.selectedElements').on('click', '.reset', function () {
//         vselectedValues = [];
//         $('.tag').remove();
//         localStorage.setItem('vselectedValues', JSON.stringify(vselectedValues));
//         filterVacansies();
//     });
//
    let phpCount = $('#phpCount').val();
    // console.log(phpCount);
    $('.dp_post_count').html(`
    Вакансій на сайті: ${phpCount}
    `);

    $('.sti').on("change keyup", function () {
        function filterDelay() {
        $(".vac_item").hide().filter(function () {
            let rtnData = "";
            let regExWord = new RegExp($('.i0').val().trim(), "ig");
            if ($(this).find('.starWrapp[data-exist="no"]').length > 0) {
                return false;
            }
            rtnData = (
                $(this).attr("data-title").match(regExWord) ||
                $(this).attr("data-city").match(regExWord) ||
                $(this).attr("data-angl").match(regExWord) ||
                $(this).attr("data-zarplata").match(regExWord) ||
                // $(this).attr("data-work_format").match(regExWord) ||
                $(this).attr("data-status").match(regExWord) ||
                // $(this).attr("data-company").match(regExWord) ||
                $(this).attr("data-data").match(regExWord)
                // $(this).attr("data-country").match(regExWord)
            );

        return rtnData;
        }).fadeIn(1);
        // if(!($(e.target).closest(".starWrapp[data-exist='yes']"))) {
        //     $(".rekv_form").hide();
        // }
        // $('.saveVac:not(.activ_star)').parents('.vac_item').hide();
        // $('.saveVac:not(.activ_star)').parents('.vac_item').fadeOut(1);
        let postCount = $('.right_vac .vac_item:visible').size();
        $('.dp_post_count').html('Найдено вакансий: ' + postCount);
         }
        setTimeout(filterDelay, 300);
    });

    $('.stisingle').on("change keyup", function () {
        function filterDelay() {
            $(".vac_item").hide().filter(function () {
                let rtnData = "";
                let regExWord = new RegExp($('.i0').val().trim(), "ig");
                rtnData = (
                    $(this).attr("data-title").match(regExWord) ||
                    $(this).attr("data-city").match(regExWord) ||
                    $(this).attr("data-angl").match(regExWord) ||
                    $(this).attr("data-zarplata").match(regExWord) ||
                    // $(this).attr("data-work_format").match(regExWord) ||
                    $(this).attr("data-status").match(regExWord) ||
                    // $(this).attr("data-company").match(regExWord) ||
                    $(this).attr("data-data").match(regExWord)
                    // $(this).attr("data-country").match(regExWord)
                );

                return rtnData;
            }).fadeIn(1);
            let postCount = $('.right_vac .vac_item:visible').size();
            $('.dp_post_count').html('Найдено вакансий: ' + postCount);
        }
        setTimeout(filterDelay, 300);
    });

    $('.sticl').on("change keyup", function () {
        function filterDelayCl() {
            $(".cli_item").hide().filter(function () {
                let rtnDataCl = "";
                let regExWordCl = new RegExp($('.sticl.i0').val().trim(), "ig");

                rtnDataCl = (
                    $(this).attr("data-title").match(regExWordCl) ||
                    $(this).attr("data-site").match(regExWordCl) ||
                    $(this).attr("data-country").match(regExWordCl)
                );

                return rtnDataCl;
            }).fadeIn(1);
        }
        setTimeout(filterDelayCl, 300);
    });

// My Cabinet left menu   .myProfile
// $('.mcr, .myVac, .mmr, .myOffers, .myAnalit, .tasksData, .faqData, .pipel2').hide();
//     $('.myProfile h4').addClass('left_menu_act');
//$('.mcr, .myVac, .myOffers, .tasksData, .faqData, .pipel2, .mpr, .myAnalit').hide();
function rekrTabs(){
    $('.myProfile').on('click', function () {
        $(".myVac, .mcr, .mmr, .myOffers, .myAnalit, .pipel2, .tasksData, .faqData, .myCli, .myTeam").slideUp("slow");
        $(".mpr").slideDown("slow");
        $('.myProfile h4').addClass('left_menu_act');
        $('.myV h4, .myO h4, .myC h4, .myM h4, .myA h4, .pipeline h4, .myTasks h4, .myFAQ h4, .myClients h4, .myTeamenu h4').removeClass('left_menu_act');
        $('.fimg input[type=submit], .fimg [data-name=frfile], .fimg .acf-icon.dark').slideDown("slow");
        $('.fimg a[data-name=edit]').slideUp();
    })

    $('.myV').on('click', function () {
        $(".mpr, .mcr, .mmr, .myOffers, .myAnalit, .pipel2, .tasksData, .faqData, .myCli, .myTeam").slideUp("slow");
        $(".myVac").slideDown("slow");
        $('.myV h4').addClass('left_menu_act');
        $('.myProfile h4, .myC h4, .myO h4, .myM h4, .myA h4, .pipeline h4, .myTasks h4, .myFAQ h4, .myClients h4, .myTeamenu h4').removeClass('left_menu_act');
        $('.fimg input[type=submit], .fimg [data-name=frfile], .fimg .acf-icon.dark').slideUp("slow");
    })
    $('.myClients').on('click', function () {
        $(".mpr, .mcr, .mmr, .myOffers, .myAnalit, .pipel2, .tasksData, .faqData, .myVac, .myTeam").slideUp("slow");
        $(".myCli").slideDown("slow");
        $('.myClients h4').addClass('left_menu_act');
        $('.myV h4, .myProfile h4, .myC h4, .myM h4, .myA h4, .pipeline h4, .myTasks h4, .myFAQ h4, .myTeamenu h4').removeClass('left_menu_act');
        $('.fimg input[type=submit], .fimg [data-name=frfile], .fimg .acf-icon.dark').slideUp("slow");
    })
    $('.myTeamenu').on('click', function () {
        $(".mpr, .mcr, .mmr, .myOffers, .myAnalit, .pipel2, .tasksData, .faqData, .myVac, .myCli").slideUp("slow");
        $(".myTeam").slideDown("slow");
        $('.myTeamenu h4').addClass('left_menu_act');
        $('.myV h4, .myProfile h4, .myC h4, .myM h4, .myA h4, .pipeline h4, .myTasks h4, .myFAQ h4, .myClients h4').removeClass('left_menu_act');
        $('.fimg input[type=submit], .fimg [data-name=frfile], .fimg .acf-icon.dark').slideUp("slow");
    })
    $('.myO').on('click', function () {
        $(".mpr, .mcr, .mmr, .myVac, .myAnalit, .pipel2, .tasksData, .faqData, .myCli, .myTeam").slideUp("slow");
        $(".myOffers").slideDown("slow");
        $('.myO h4').addClass('left_menu_act');
        $('.myV h4, .myProfile h4, .myC h4, .myM h4, .myA h4, .pipeline h4, .myTasks h4, .myFAQ h4, .myClients h4, .myTeamenu h4').removeClass('left_menu_act');
        $('.fimg input[type=submit], .fimg [data-name=frfile], .fimg .acf-icon.dark').slideUp("slow");
    })
    $('.myA').on('click', function () {
        $(".mpr, .mcr, .mmr, .myVac, .myOffers, .pipel2, .tasksData, .faqData, .myCli, .myTeam").slideUp("slow");
        $(".myAnalit").slideDown("slow");
        $('.myA h4').addClass('left_menu_act');
        $('.myV h4, .myProfile h4, .myC h4, .myO h4, .myM h4, .pipeline h4, .myTasks h4, .myFAQ h4, .myClients h4, .myTeamenu h4').removeClass('left_menu_act');
        $('.fimg input[type=submit], .fimg [data-name=frfile], .fimg .acf-icon.dark').slideUp("slow");
    })
    $('.myC').on('click', function () {
        $(".myVac, .mpr, .mmr, .myOffers, .myAnalit, .pipel2, .tasksData, .faqData, .myCli, .allmr.pipe2, .myTeam").slideUp("slow");
        $(".mcr").slideDown("slow");
        $('.myC h4').addClass('left_menu_act');
        $('.myV h4, .myO h4, .myProfile h4, .myM h4, .myA h4, .pipeline h4, .myTasks h4, .myFAQ h4, .myClients h4, .myTeamenu h4').removeClass('left_menu_act');
        $('.fimg input[type=submit], .fimg [data-name=frfile], .fimg .acf-icon.dark').slideUp("slow");
    })
    // $('.pipeline').on('click', function () {
    //     $(".mcr, .myVac, .mpr, .mmr, .myOffers, .myAnalit, .tasksData").slideUp("slow");
    //     $(".pipel2").slideDown("slow");
    //     $('.pipeline h4').addClass('left_menu_act');
    //     $('.myC h4, .myV h4, .myO h4, .myProfile h4, .myM h4, .myA h4, .myTasks h4').removeClass('left_menu_act');
    //     $('.fimg input[type=submit], .fimg [data-name=frfile], .fimg .acf-icon.dark').slideUp("slow");
    // });
    $('.myTasks').on('click', function () {
        $(".mcr, .myVac, .mpr, .mmr, .myOffers, .myAnalit, .pipel2, .faqData, .myCli, .myTeam").slideUp("slow");
        $(".tasksData").slideDown("slow");
        $('.myTasks h4').addClass('left_menu_act');
        $('.myC h4, .myV h4, .myO h4, .myProfile h4, .myM h4, .myA h4, .pipeline h4, .myFAQ h4, .myClients h4, .myTeamenu h4').removeClass('left_menu_act');
        $('.fimg input[type=submit], .fimg [data-name=frfile], .fimg .acf-icon.dark').slideUp("slow");
    });
    $('.myFAQ').on('click', function () {
        $(".mcr, .myVac, .mpr, .mmr, .myOffers, .myAnalit, .pipel2, .tasksData, .myCli, .myTeam").slideUp("slow");
        $(".faqData").slideDown("slow");
        $('.myFAQ h4').addClass('left_menu_act');
        $('.myC h4, .myV h4, .myO h4, .myProfile h4, .myM h4, .myA h4, .pipeline h4, .myTasks h4, .myClients h4, .myTeamenu h4').removeClass('left_menu_act');
        $('.fimg input[type=submit], .fimg [data-name=frfile], .fimg .acf-icon.dark').slideUp("slow");
    });
    $('.myM').on('click',  addKanban.bind(this));
    function addKanban() {
        // $(".myVac, .mpr, .mcr, .myOffers, .myAnalit, .pipel2, .tasksData, .faqData").slideUp("slow");
        // $(".mmr").slideDown("slow");
        // $('.myM h4').addClass('left_menu_act');
        // $('.myV h4, .myO h4, .myC h4, .myProfile h4, .myA h4, .pipeline h4, .myTasks h4, .myFAQ h4').removeClass('left_menu_act');
        // $('.fimg input[type=submit], .fimg [data-name=frfile], .fimg .acf-icon.dark').slideUp("slow");
        let lastDate = $('#loadRes .lastDate1').html();
       // console.log(lastDate);
        $('.myM').attr('data-ld', lastDate);
        let currLD = $(".myM");
        if (currLD.attr("data-exist") == 'yes') {
            dellLD(currLD);
            //console.log('cre9');
        }
        else {
            creLD(currLD);
            //console.log('cre8');
        }
        if (currLD.attr("data-exist2") == 'yes') {
            //console.log('hifi');
            updHot();
            $.ajax({
                beforeSend: (xhr) => {
                    xhr.setRequestHeader('X-WP-Nonce', devportData.cb);
                },
                url: devportData.root_url + '/wp-json/ht/v2/manageHot2',
                data: {
                    'postId': $('.myM').data('hot'),
                    //'hd': currTime,
                    'uid': $(".myM").data('uid')
                },
                type: 'PUT',
                success: (response) => {
                    let currLD = $(".myM");
                    console.log(response);
                },
                error: (response) => {
                    console.log(response);
                }
            });
        }
        else {
            creHot(currLD);
           //console.log('cre1');
        }
        function reloadDelay() {
            window.location.reload();
            }
            setTimeout(reloadDelay, 200);
    }
}
let openNt = $('.openNotif0').text();
    openNt=parseInt(openNt, 10);
    //console.log('op '+openNt);
if(openNt===0){
$('.mmr, .mcr, .myVac, .myOffers, .tasksData, .faqData, .pipel2, .myAnalit, .myCli, .myTeam').hide();
    // $('.myM h4').addClass('left_menu_act');
     $('.myProfile h4').addClass('left_menu_act');
     rekrTabs();
    }
    if(openNt===1){
        $(".myVac, .mpr, .mcr, .myOffers, .myAnalit, .pipel2, .tasksData, .faqData, .myCli, .myTeam").hide();
        $('.myV h4, .myO h4, .myC h4, .myProfile h4, .myA h4, .pipeline h4, .myTasks h4, .myFAQ h4, .myClients h4, .myTeamenu h4').removeClass('left_menu_act');
        $('.myM h4').addClass('left_menu_act');
        rekrTabs();
        // $(".mmr").slideDown("fast");
    }
    function notifDelay() {
        $.ajax({
            beforeSend: (xhr) => {
                xhr.setRequestHeader('X-WP-Nonce', devportData.cb);
            },
            url: devportData.root_url + '/wp-json/ht/v3/manageHot3',
            data: {
                'postId': $('.myM').data('hot'),
                //'hd': currTime,
                'uid': $(".myM").data('uid')
            },
            type: 'PUT',
            success: (response) => {
                let currLD = $(".myM");
                console.log(response);
            },
            error: (response) => {
                // console.log(response);
            }
        });
        $('.openNotif0').text(0);
        // $('#numbHot').css('visibility', 'visible');
         }
        setTimeout(notifDelay, 1000);
    // ------------------------------------------------
    // function testr(a) {
    //     alert(a);
    // }
    // $('.myCandW .vPauza').css('display', 'none');
    function creHot(currLD) {
        let currTime = Math.floor(new Date().getTime() / 1000);
       // console.log(currTime);
        $.ajax({
            beforeSend: (xhr) => {
                xhr.setRequestHeader('X-WP-Nonce', devportData.cb);
            },
            url: devportData.root_url + '/wp-json/ht/v1/manageHot',
            type: 'POST',
            data: {
                'hd': currTime,
                'uid': currLD.data('uid')
            },
            success: (response) => {
                // currStar.find(".saveVac").css('color', '#18A0FB');
                currLD.attr('data-exist2', 'yes');
                currLD.attr('data-hot', response);
                console.log(response);
            },
            error: (response) => {
                console.log(response);
            }
        });
    }
    let hot1 = $('.myM').data('hot');
    //console.log(hot1);
    function updHot(hot1) {
        let currTime = 554;
        let bigTimer = $('.hotC .hotOnly:first-of-type').data('timer');
        bigTimer = parseInt(bigTimer, 10);
        //console.log('ttt'+bigTimer);
       // let currTime = Math.floor(new Date().getTime() / 1000);
          console.log('hello2');
        //  let dd1 = $('.myM').data('hot');
        //  let dd2 = currTime;
        //  let dd3 = $(".myM").data('uid');
        //  console.log('1 '+dd1);
        //  console.log('2 '+dd2);
        //  console.log('3 '+dd3);
        $.ajax({
            beforeSend: (xhr) => {
                xhr.setRequestHeader('X-WP-Nonce', devportData.cb);
            },
            url: devportData.root_url + '/wp-json/ht/v1/manageHot',
            data: {
                'postId': $('.myM').data('hot'),
                'hd': bigTimer,
                'uid': $(".myM").data('uid')
            },
            type: 'PUT',
            success: (response) => {
                let currLD = $(".myM");
                // currStar.find(".saveVac").css('color', '#9E9E9E');

                 currLD.attr('data-exist2', 'no');
                console.log(response);
            },
            error: (response) => {
                console.log(response);
            }
        });
    }
    // ---------------------------------------------------
    function creLD(currLD) {
        let ld2 = $('#loadRes p:first-child .lastDate1').val();
        // console.log(ld2);
        $.ajax({
            beforeSend: (xhr) => {
                xhr.setRequestHeader('X-WP-Nonce', devportData.cb);
            },
            url: devportData.root_url + '/wp-json/ld/v1/manageLD',
            type: 'POST',
            data: {
                'ld': ld2,
                'uid': currLD.data('uid')
            },
            success: (response) => {
                // currStar.find(".saveVac").css('color', '#18A0FB');
                currLD.attr('data-exist', 'yes');
                // let starCount = parseInt(currStar.find(".starCount").html(), 10);
                // starCount++;
                // currStar.find(".starCount").html(starCount);
                // currStar.attr('data-star', 'response');
                currLD.attr('data-ld', response);
                console.log(response);
            },
            error: (response) => {
                console.log(response);
            }
        });
    }
    let updKanb = {
        'postId': $('.myM').data('ld')
    }
    let ldID = $('.myM').data('ld');
    function dellLD(ldID) {
        let ld2 = $('#loadRes p:first-child .lastDate1').val();
        console.log(ld2);
         // console.log('hello2');
        $.ajax({
            beforeSend: (xhr) => {
                xhr.setRequestHeader('X-WP-Nonce', devportData.cb);
            },
            url: devportData.root_url + '/wp-json/ld/v1/manageLD',
            data: {
                'postId': $('.myM').data('ld'),
                'md': ld2,
                'uid': $(".myM").data('uid')
            },
            type: 'PUT',
            success: (response) => {
                let currLD = $(".myM");
                // currStar.find(".saveVac").css('color', '#9E9E9E');
                 currLD.attr('data-exist', 'no');
                // let starCount = parseInt(currStar.find(".starCount").html(), 10);
                // starCount--;
                // currStar.find(".starCount").html(starCount);
                // currLD.attr('data-ld', '');
                // $(".rekomend .starWrapp[data-exist=no] .saveVac").parents('.vac_item').hide('fast');
                console.log(response);
            },
            error: (response) => {
                console.log(response);
            }
        });
    }
    let kels = $('.mcs p');
    let currTime = Math.floor(new Date().getTime() / 1000);
    for (let i = 0; i < kels.length; i++) {
        let cell = kels[i];
        let parent1 = cell.closest(".kandItem1");
       // parent1.style.backgroundColor = "red";
        if (cell.textContent  == 'Офер') {
            cell.classList.add('stRelised');
        }
        if (cell.textContent  == 'Особистий') {
            cell.classList.add('stPersonal');
        }
        if (cell.textContent  == 'Новий') {
            cell.classList.add('stNew');
        //    let tdbval = cell.closest(".kandItem1").dataset.timer;
        //    let candId = cell.closest(".kandItem1").dataset.id;
        //     // console.log('id'+candId);
        //     // console.log('curr'+currTime);
        //     // console.log('db '+tdbval);
        //     if(currTime-tdbval>0) {
        //         cell.textContent = 'Горящий';
        //         $.ajax({
        //             beforeSend: (xhr) => {
        //                 xhr.setRequestHeader('X-WP-Nonce', devportData.cb);
        //             },
        //             url: devportData.root_url + '/wp-json/ht/v7/statusHot',
        //             data: {
        //                 'postId': candId,
        //                 //'hd': currTime,
        //                 'timer': $(".myM").data('uid')
        //             },
        //             type: 'PUT',
        //             success: (response) => {
        //                 let currLD = $(".myM");
        //                 console.log(response);
        //             },
        //             error: (response) => {
        //                 console.log(response);
        //                // console.log('hooottt');
        //             }
        //         });
        //     }

        }
        if (cell.textContent  == 'Занятий') {
            //cell.disabled = true;
            cell.classList.add('stBusy');
           if(parent1) {
            parent1.querySelector('.getToVac').disabled = true;
           }
        //    let tdbval = cell.closest(".kandItem1").dataset.timer;
        //     let candId = cell.closest(".kandItem1").dataset.id;
            // console.log('id'+candId);
            // console.log('curr'+currTime);
            // console.log('db '+tdbval);
            // $.ajax({
            //     beforeSend: (xhr) => {
            //         xhr.setRequestHeader('X-WP-Nonce', devportData.cb);
            //     },
            //     url: devportData.root_url + '/wp-json/ht/v7/statusHot',
            //     data: {
            //         'postId': candId,
            //         //'hd': currTime,
            //         'timer': $(".myM").data('uid')
            //     },
            //     type: 'PUT',
            //     success: (response) => {
            //         let currLD = $(".myM");
            //         console.log(response);
            //     },
            //     error: (response) => {
            //         //console.log(response);
            //         console.log('hooottt-икик');
            //     }
            // });
        }
        if (cell.textContent  == 'В роботі') {
            $('.mcd2 p:first-child').addClass('vRaboteDetails');
            cell.classList.add('stProc');
        }
        if (cell.textContent  == 'На паузі') {
            cell.classList.add('vPauza');
        }
        if (cell.textContent  == 'Горящий') {
            cell.classList.add('stHot');
            //  let tdbval = cell.closest(".kandItem1").dataset.timer;
            //  tdbval=parseInt(tdbval, 10)
            //  let edgeVal = tdbval+1209600;
            //  let candId = cell.closest(".kandItem1").dataset.id;
            //  if(currTime-edgeVal>0){
            //     console.log('go fly');
            //      $.ajax({
            //     beforeSend: (xhr) => {
            //         xhr.setRequestHeader('X-WP-Nonce', devportData.cb);
            //     },
            //     url: devportData.root_url + '/wp-json/ht/v8/statusVbaze',
            //     data: {
            //         'postId': candId,
            //         //'hd': currTime,
            //         //'timer': $(".myM").data('uid')
            //     },
            //     type: 'PUT',
            //     success: (response) => {
            //         let currLD = $(".myM");
            //         console.log(response);
            //     },
            //     error: (response) => {
            //         //console.log(response);
            //     }
            // });
            // }
        }
        if (cell.textContent  == 'В Базі канд') {
            cell.classList.add('stVBaze');
        }
        if (cell.textContent  == '') {
            // cell.html('Новый');
            cell.classList.add('stMt');
            // cell.textContent('stMt');
        }
    }
    $('.stMt').html('Новий').addClass('stNew');
    // let vupl = $('.vypl1');
    // $('.vypl1').html() == '' ? '' : this.append('$');
    // if (vupl.html()) {
    //     $('.vypl1').append('$');
    // }
    $('.addVacClick').on('click', function () {
        let cDT = Math.round(new Date().getTime()/1000);
        // let curID = $('.cusID').val();
        let curID = parseInt($('.cusID').html(), 10);
        // console.log(cDT);
        $('.dateTime input').val(cDT);
        $('.curUsrId input').val(curID);
    })

// $('.saveVac')
    // !!!!!!!!!!!!!!!!! Star save vac !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    // let starV = $('.starWrapp').attr('data-exist');
    // if (starV == 'yes') {
    //     // console.log('44444');
    //     $(".saveVac").css('color', 'green');
    // }


    // $(".starWrapp .saveVac").css('color', 'yellow').parents('.vac_item').hide();
    // $(".starWrapp[data-exist=yes] .saveVac").css('color', 'yellow').parents('.vac_item').show();timlid
    $(".rekomend .starWrapp .saveVac, .timlid .starWrapp .saveVac").parents('.vac_item').hide();
    $(".rekomend .starWrapp[data-exist=yes] .saveVac, .timlid .starWrapp[data-exist=yes] .saveVac").parents('.vac_item').show();
    $(".starWrapp[data-exist=yes] .saveVac").css('color', '#18A0FB').addClass("activ_star");



    $('.starWrapp').on("click", addRemove.bind(this));
    function addRemove(e) {
        let currStar = $(e.target).closest(".starWrapp");
       if (currStar.attr("data-exist") == 'yes') {
           dellStar(currStar);
       } else {
           creStar(currStar);
       }
    }
    function creStar(currStar) {
        $.ajax({
            beforeSend: (xhr) => {
                xhr.setRequestHeader('X-WP-Nonce', devportData.cb);
            },
            url: devportData.root_url + '/wp-json/vc/v1/manageVac',
            type: 'POST',
            data: { 'starId': currStar.data('vac')},
            success: (response) => {
                currStar.find(".saveVac").css('color', '#18A0FB');
                currStar.attr('data-exist', 'yes');
                let starCount = parseInt(currStar.find(".starCount").html(), 10);
                // starCount++;
                // currStar.find(".starCount").html(starCount);
                // currStar.attr('data-star', 'response');
                console.log(response);
            },
            error: (response) => {
                console.log(response);
            }
        });
    }
    function dellStar(currStar) {
        $.ajax({
            beforeSend: (xhr) => {
                xhr.setRequestHeader('X-WP-Nonce', devportData.cb);
            },
            // url: devportData.root_url + '/wp-json/dp/v1/rekom/',
            url: devportData.root_url + '/wp-json/vc/v1/manageVac',
            data: {'star': currStar.attr('data-star')},
            type: 'DELETE',
            success: (response) => {
                // $(".rekomend .starWrapp .saveVac").parents('.vac_item').hide();
                currStar.find(".saveVac").css('color', '#9E9E9E');
                currStar.attr('data-exist', 'no');
                let starCount = parseInt(currStar.find(".starCount").html(), 10);
                starCount--;
                currStar.find(".starCount").html(starCount);
                currStar.attr('data-star', '');
                currStar.css('display', 'none');
                $(".myVac .starWrapp[data-exist=no] .saveVac").parents('.vac_item').hide('fast');
                console.log(response);
            },
            error: (response) => {
                console.log(response);
            }
        });
    }
    // save new rekomend, candidat
    // $('.addNewCand .acf-field[data-name=_post_title] .acf-label label').html('Фамилия').append('<span class="acf-required acc_fam">*</span>');
    $('.addNewCand .acf-accordion-title').append('<span class="acf-required acc_title">*</span>');
    $('.addNewCand input.acf-button').prop('disabled', true);
    $('.addNewCand .acf-field.acf-accordion').on("change keyup", function () {
        let telegr = $('.acf-field[data-name=telegram] input').val().length;
        let viberr = $('.acf-field[data-name=viber_r] input').val().length;
        let skyper = $('.acf-field[data-name=skype_r] input').val().length;
        let telr = $('.acf-field[data-name=tel_r] input').val().length;
        let emailr = $('.acf-field[data-name=email_r] input').val().length;
        let drugoe = $('.acf-field[data-name=drugoe] input').val().length;
        if (telegr || viberr || skyper || telr || emailr || drugoe) {
            $('.addNewCand input.acf-button').prop('disabled', false);
        } else {
            $('.addNewCand input.acf-button').prop('disabled', true);
        }

    });
    $('.addNewCand .acf-field[data-name=familiya]').on("change keyup", function () {
        let famVal = $('.addNewCand .acf-field[data-name=familiya] .acf-input input').val();
        $('.addNewCand .acf-field[data-name=_post_title] .acf-input input').val(famVal);
    });
    $('.oh button').click(function () {
        $('.rekv_form').css('display', 'block');
       // $('.rekv_sotr').css('display', 'block');
    });
    $(document).on('click',function(e){
        if(!(($(e.target).closest(".rekv_form").length > 0 ) || ($(e.target).closest(".oh button").length > 0))){
            $(".rekv_form").hide();
        }
        // if(!(($(e.target).closest(".rekomFormEdit").length > 0 ) || ($(e.target).closest(".openEdit").length > 0 || ($(e.target).closest(".rekomFormEdit .acf-field-relationship").length > 0)))){
        //     $(".rekomFormEdit").slideUp('slow');
        //     $(".scwrap").slideDown('slow');
        // }
     });

    //  let ghr = $('.gethref').attr("href");
    //  $('.gethref').attr("href", "https://docs.google.com/viewer?url=" + ghr);
    //  let ghr2 = $('.gethref').attr("href");
    //  console.log(ghr2);
     let chr = $('.sc_data a').attr("href");
     const g_viewer = "https://docs.google.com/viewer?url=";
     $('.sc_data a').attr("href", g_viewer + chr);

    //  let chr2 = $('.k_btn a').attr("href");
    //  $('.k_btn a').attr("href", g_viewer + chr2);/?key=Alex
     // console.log(chr);
    //  $('.test1').on("click", function () {
    //      let vlink = window.location.href;
    //     // vlink += '?d23';
    //     //alert(vlink);
    //    // const rid = '?f62';
    //     const userid = '?r'+$('#userId').text();
    //     navigator.clipboard.writeText(vlink+userid)
    //  });
     $('.mcfind').on("change keyup", function () {
        function filterD() {
        $(".kandItem").hide().filter(function () {
            let rtnData = "";
            let regMK = $('.mcfind input').val().toLowerCase().trim().replace(/[\-\[\]{}()*+?.,\\\^$|#\s]/g, "\\$&");
            // let regMK = new RegExp($('.mcfind input').val().trim(), "ig");
           // console.log(regMK);

            rtnData = (
                $(this).attr("data-name1").toLowerCase().match(regMK) ||
                $(this).attr("data-fam1").toLowerCase().match(regMK) ||
                $(this).attr("data-spec1").toLowerCase().match(regMK) ||
                // $(this).attr("data-addspec1").toLowerCase().match(regMK) ||
                $(this).attr("data-spec4").toLowerCase().match(regMK) ||
                $(this).attr("data-spec3").toLowerCase().match(regMK) ||
                $(this).attr("data-tip").toLowerCase().match(regMK) ||
                $(this).attr("data-engl1").toLowerCase().match(regMK) ||
                $(this).attr("data-reg1").toLowerCase().match(regMK) ||
                $(this).attr("data-cit1").toLowerCase().match(regMK) ||
                $(this).attr("data-stat1").toLowerCase().match(regMK)
            );

        return rtnData;
        }).fadeIn('fast');
        // let postCount = $('.right_vac .vac_item:visible').size();
        // $('.dp_post_count').html('Найдено вакансий: ' + postCount);
         }
        setTimeout(filterD, 300);
    });
    $('.faqfind').on("change keyup", function () {
        function filterFaq() {
        $(".itemW").hide().filter(function () {
            let rtnData = "";
            let regFAQ = $('.faqfind input').val().toLowerCase().trim().replace(/[\-\[\]{}()*+?.,\\\^$|#\s]/g, "\\$&");
            // let regMK = new RegExp($('.mcfind input').val().trim(), "ig");
            //console.log(regMK);

            rtnData = (
                $(this).attr("data-faq1").toLowerCase().match(regFAQ)
            );

        return rtnData;
        }).fadeIn('fast');
        // let postCount = $('.right_vac .vac_item:visible').size();
        // $('.dp_post_count').html('Найдено вакансий: ' + postCount);
         }
        setTimeout(filterFaq, 300);
    });
    $('.mcfind2').on("change keyup", function () {
        $(".kandItem").hide().filter(function () {
            let rtnData = "";
            let ayear = $('#ayear').val();
            let amonth = $('#amonth').val();
            //console.log(regMK);

            rtnData = (

                $(this).attr("data-stat1").match(regMK) &&
                $(this).attr("data-spec1").match(regSpec)
                // $(this).attr("data-addspec1").match(regSpec)
            );

        return rtnData;
        }).fadeIn('fast');
    });
    $('.mcfind3').on("change keyup", function () {
        $(".kandItem").hide().filter(function () {
            let rtnData = "";
            let findcstat = $('#findcstat').val();
            let findcspec = $('#findcspec').val().trim().replace(/[\-\[\]{}()*+?.,\\\^$|#\s]/g, "\\$&");
            //console.log(regMK);

            rtnData = (

                $(this).attr("data-stat1").match(findcstat) &&
                $(this).attr("data-spec1").match(findcspec)
                // $(this).attr("data-addspec1").match(findcspec)
            );

        return rtnData;
        }).fadeIn('fast');
    });
   $('.openEdit').click(function () {
        $('.rekomFormEdit').show();
        $('.scwrap').hide();
   });
   $('#ce1').click(function () {
    $('.scwrap').show();
    $('.rekomFormEdit').hide();
});

    // ==================================================
    let vlink = window.location.href;
$('.link_vac').click(function () {

    const userid = '?r'+$('#userId').text();
    navigator.clipboard.writeText(vlink+userid)
    $(".link_vac").append('<div class="pop_mess">Ссылка скопирована</div>');
    $('.pop_mess').hide().slideDown('fast')
    let hideMess = function(){
        $('.pop_mess').slideUp('fast');
    };
    setTimeout(hideMess, 3000);
});

// ===========================Save recomend ===========================
$('#currHref').text(vlink);

const d1 = new Date();

const month = d1.getMonth()+1;
const day = d1.getDate();
const hours = d1.getHours();
const min = d1.getMinutes();
const sec = d1.getSeconds();

let curdt = d1.getFullYear() +"-"+ (month<10 ? '0' : '')+ month+"-" + (day<10 ? '0' : '') + day + " " + hours+":"+min+":"+sec;
// let curdt0 = d1.getFullYear() + (month<10 ? '0' : '')+ month + (day<10 ? '0' : '') + day + hours+min+sec;
// console.log(curdt0);

//console.log(curdt);
    // var hideRefreshMess = function(){
    //     $('.sv_chose_cand_header #message').css('display', 'none');
    // };
    // setTimeout(hideRefreshMess, 5000);

    $(".starWr[data-exist=yes] .saveRec").css('color', '#18A0FB');
    $('.starWr').on("click", addRemove1.bind(this));
    function addRemove1(e) {
        let currStar = $(e.target).closest(".starWr");
        if (currStar.attr("data-exist") == 'yes') {
            dellStar1(currStar);
        } else {
            creStar1(currStar);
        }
        var finalNum = function(){
            let countCand = $('.sv_chose_cand .starWr[data-exist =yes]').length;
            $('.acf-field[data-name="c_num"] input').val(countCand);
            console.log(countCand);
        };
        setTimeout(finalNum, 800);
    }
    function creStar1(currStar) {
        $.ajax({
            beforeSend: (xhr) => {
                xhr.setRequestHeader('X-WP-Nonce', devportData.cb);
            },
            url: devportData.root_url + '/wp-json/rk/v1/manageRec',
            type: 'POST',
            data: {
                'starId': currStar.data('rec'),
                'vac_id': parseInt($('.vacId1').html(), 10),
                'rek_id': parseInt($('.recId1').html(), 10)
            },
            success: (response) => {
                currStar.find(".saveRec").css('color', '#18A0FB');
                currStar.attr('data-exist', 'yes');
                // let starCount = parseInt(currStar.find(".starCount").html(), 10);
                // starCount++;
                // currStar.find(".starCount").html(starCount);
                currStar.attr('data-star', 'response');
                console.log(response);
            },
            error: (response) => {
                console.log(response);
            }
        });
    }
    function dellStar1(currStar) {
        $.ajax({
            beforeSend: (xhr) => {
                xhr.setRequestHeader('X-WP-Nonce', devportData.cb);
            },
            // url: devportData.root_url + '/wp-json/dp/v1/rekom/',
            url: devportData.root_url + '/wp-json/rk/v1/manageRec',
            data: {'star': currStar.attr('data-star')},
            type: 'DELETE',
            success: (response) => {
                // $(".rekomend .starWrapp .saveVac").parents('.vac_item').hide();
                currStar.find(".saveRec").css('color', '#9E9E9E');
                currStar.attr('data-exist', 'no');
                // let starCount = parseInt(currStar.find(".starCount").html(), 10);
                // starCount--;
                // currStar.find(".starCount").html(starCount);
                currStar.attr('data-star', '');
                // $(".mcd .starWr[data-exist=no] .saveRec").parents('.vac_item').hide('fast');
                console.log(response);
            },
            error: (response) => {
                console.log(response);
            }
        });
    }
    $('.obranyCand .mcd').hide();
    $(".obranyCand .starWr[data-exist=yes] .saveRec").parents('.mcd').show();

    $('.offer1').hide();
    $('.offer1[data-ofers="Офер"]').show();
    // $(".rekomend .starWrapp[data-exist=yes] .saveVac").parents('.vac_item').show();
    // let countCand = $('.starWr[data-exist =yes]').length;
    // $('.countCandid input').val(countCand);
    // console.log(countCand);

    let numCandidatesForVac = $('.candForVac');
    for (let i = 0; i < numCandidatesForVac.length; i++) {
        let curNunber = numCandidatesForVac[i];
        if (curNunber.textContent  == '') {
            curNunber.innerHTML += '0';
            curNunber.classList.add('numZero');
        }
        if (curNunber.textContent  == '0') {
            curNunber.classList.add('numZero');
        } else {
            curNunber.classList.remove('numZero');
        }
    }

    $('.chVac').on("click", vacAdd.bind(this));
    function vacAdd(e) {
        // let currV = $(e.target).closest(".chVac .values li");
        // currV.css('color', 'yellow');
        // $('.chVac .values li').prepend('<span class="">44</span>');
        $('.chVac .values input:hidden').attr( "type", "text" ).prop('disabled', true);
        // let vacItems = $('.chVac .values li');
        // for (let i = 0; i < vacItems.length; i++) {
        //     let vi = vacItems[i];
        //     vi.classList.add('stlow');
        // }
    }
    vacAdd();
    $('.cv5').on("click", vacAdd5.bind(this));
    function vacAdd5(e) {
        // let iv5 = $(e.target).closest(".cv5 input").val();
        // console.log(iv5);
        // $('.chVac textarea').html(iv5);

        // let aString="";
        // aString.concat(value1, value2, ... value_n);
        let sumV = $('.cv5 input');
        let vacItms = '';
        for(let i=0;i<sumV.length;i++){
            let svi = sumV[i];
            // console.log(svi);
            if (svi.checked)
            vacItms += svi.value+'; ';
            }
         console.log(vacItms);
         $('.chVac textarea').html(vacItms);
    }
$('.addVacToCand').click(function () {
    if($('.cv5w').css('display') == 'none')
    {
        $('.cv5w').slideDown('slow');
    } else {
        $('.cv5w').slideUp('slow');
    }
})
    let crRecomFrId = $('.addNewCand .cuID1').html();
   // console.log(crRecomFrId);

   $('.addc1').on( 'click', function() {

   // let dd = cdt1.getTime() / 1000;
    let sec1 = new Date().getTime() / 1000;
    sec1 = sec1 + 86400;
    sec1 = Math.floor(sec1);
    console.log('vv22 ' + Math.floor(sec1));
    $('.addNewCand .acf-field[data-name=dataStart2] input').val(sec1);
    $('.addNewCand .acf-field[data-name=dataStart0] input').val(sec1);
    //$('.addNewCand .acf-field[data-name=dataStart2] label').html(sec1);
   });

    $('.addNewCand .acf-field[data-name="user_r"] input').val(parseInt($(".addNewCand .cuID1").html(), 10));

    // $('.addNewCand .acf-field[data-name="dataStart2"] input').val($(".addNewCand #cutime").val());
    // $('.addNewCand .acf-field[data-name="_post_content"] label').text('Додатково');
    $('.addNewCand .idNew input').val(1);
    let rekrID = vlink.split('?r')[1];
    if(rekrID!== undefined){
        rekrID = parseInt(rekrID, 10);
        $('.addNewCand .idRek input').val(rekrID);
    }
    let frelID = $('#frelId').text();
    if(frelID!==''){
        frelID = parseInt(frelID, 10);
        $('.addNewCand .idFreeln input').val(frelID);
    }
    let vacId = $('#vacId').text();
    if(vacId!==''){
        vacId = parseInt(vacId, 10);
        $('.addNewCand .idVac input').val(vacId);
    }
    $('.addNewCand .idDateTime input').val(curdt);
    $('.addVac .acf-field[data-name="_post_content"] label').html('Описание проекта');
    // $(".chVac .acf-rel-item").prepend('<span class="dashicons dashicons-arrow-right-alt">44</span>');
     // $(`
     // <span>555</span>
     // `).prependTo('.chVac .acf-rel-item');
    $('.avalible_c').css('color', 'red')
    $('.all_c5').click(function () {
        $('.all_c5').css('color', 'red')
        $('.avalible_c').css('color', '#2C2C2C')
        $('.sv_chose_cand').slideUp('slow');
        $('.sv_all_c').slideDown('slow');
    })
    $('.avalible_c').click(function () {
        $('.avalible_c').css('color', 'red')
        $('.all_c5').css('color', '#2C2C2C')
        $('.sv_all_c').slideUp('slow');
        $('.sv_chose_cand').slideDown('slow');
    })
// ========================== создание ивента ===========================
let marker1 = $('.marker1');
// let runOnce = 1;
// if(runOnce===1){
// }
if(marker1.length){
    //console.log(marker1.length);
    const surl7 = $('#surl7').html();
    let evc = parseInt($(".eventc").text(), 10);
    let evr = parseInt($(".eventr").text(), 10);
    let evf = parseInt($(".eventf").text(), 10);
    let evv = parseInt($(".eventv").text(), 10);
    let evd2 = parseInt($(".evd2").text(), 10);
    let evd = $(".eventd").text();
    // console.log('cand '+evc);
    // console.log('rekr '+evr);
    // console.log('freeln '+evf);
    // console.log('vac '+evv);
    // console.log('date3 '+evd);
    // $('#eventBox').load(surl7 + "/wp-content/themes/devport/functions/create1_kevent.php", {
    //    er: evr, ef: evf, ev: evv, ec: evc, edt: evd, ed2: evd2
    // });

    // $('#evReset').load(surl7 + "/wp-content/themes/devport/functions/create1reset.php", {
    //     ec: evc
    //  });
    $(".markWrap .marker1:last-of-type .eventc").css('color', 'red');
    $("#evExist p:last-of-type").css('color', 'blue');
     $('#evExist').load(surl7 + "/wp-content/themes/devport/functions/cre1Exist.php", {
       er: evr, ef: evf, ev: evv, ec: evc, edt: evd, ed2: evd2
    });
    let edelay = function(){
        let newCand = parseInt($(".markWrap .marker1:last-of-type .eventc").text(), 10);
        let exist1 = parseInt($("#evExist p:last-of-type").text(), 10);
        console.log(newCand);
        console.log(exist1);
        if(newCand!==exist1) {
            console.log('yessss::');
            $('#eventBox').load(surl7 + "/wp-content/themes/devport/functions/create1_kevent.php", {
                er: evr, ef: evf, ev: evv, ec: evc, edt: evd, ed2: evd2
            });
        }
    };
    setTimeout(edelay, 300);
}
// ==========================frncr personal data =======================
    $('.fpsubmit').on("click", addFPD.bind(this));
    function addFPD(e) {
        let currFP = $(e.target).closest(".fpsubmit");
        // let currFP = $(e.target).closest(".fpsubmit");
       // let currFP = (".fpsubmit");
        if (currFP.attr("data-exist") == 'yes') {
            updFD(currFP);
        } else {
            creFP(currFP);
        }
    }
    function creFP(currFP) {
        let newFD = {
           'f_id': parseInt($(".cuID").html(), 10),
            'title': $(".fn").val(),
            'f_email': $(".fe").val(),
            'f_telef': $(".ftelef").val(),
            'f_rekviz': $(".fr").val(),
            'status': 'publish'
        }
        $.ajax({
            beforeSend: (xhr) => {
                xhr.setRequestHeader('X-WP-Nonce', devportData.cb);
            },
            url: devportData.root_url + '/wp-json/fd/v1/persData',
            type: 'POST',
            data: newFD,
            success: (response) => {
                // currStar.find(".saveVac").css('color', '#18A0FB');
                currFP.attr('data-exist', 'yes');
                // let starCount = parseInt(currStar.find(".starCount").html(), 10);
                // starCount++;
                // currStar.find(".starCount").html(starCount);
                currFP.attr('data-star', 'response');
                console.log(response);
            },
            error: (response) => {
                console.log(response);
            }
        });
    }
    if ($('.pd1').val() !== '') {
        $('.mpd .fn').val($('.pd1').val());
        $('.mpd .fe').val($('.pd2').val());
        $('.mpd .ftelef').val($('.pd3').val());
        $('.mpd .fr').val($('.pd4').val());
        $('.fpsubmit').html('Обновить');
    } else {
        $('.fpsubmit').html('Создать');
    }
    let postID = $('.pd5').val();
    // console.log(postID);
    function updFD(postID) {
        let updFD = {
            'postId': $('.pd5').val(),
            'f_id': parseInt($(".cuID").html(), 10),
            'title': $(".fn").val(),
            'f_email': $(".fe").val(),
            'f_telef': $(".ftelef").val(),
            'f_rekviz': $(".fr").val(),
            'status': 'publish'
        }
        $.ajax({
            beforeSend: (xhr) => {
                xhr.setRequestHeader('X-WP-Nonce', devportData.cb);
            },
            url: devportData.root_url + '/wp-json/fd/v1/persData',
            type: 'PUT',
            data: updFD,
            success: (response) => {
                // currStar.find(".saveVac").css('color', '#18A0FB');
                // currFP.attr('data-exist', 'yes');
                // let starCount = parseInt(currStar.find(".starCount").html(), 10);
                // starCount++;
                // currStar.find(".starCount").html(starCount);
                // currFP.attr('data-star', 'response');
                console.log(response);
            },
            error: (response) => {
                console.log(response);
            }
        });
    }
    let cu5 = $('#cf').val();
    // console.log(cu5);
    const currUsr = $('#cf').val();
    // console.log(currUsr);
    $(".mailUsr").hide().filter(function () {
        let rtnMU = "";
        rtnMU = (
            $(this).data("usr").match(currUsr)
        )
        return rtnMU;
    }).fadeIn('fast');
    // ====================Client============================================
    $('.addVac [data-name=_post_title] label, .addVac [data-name=vcompany] label').remove();
    $('.addVac [data-name=_post_title] input').attr("placeholder", "Название вакансии");
    $('.addVac [data-name=vcompany] input').attr("placeholder", "Название Вашей компании");

    $('.clientPD .myTitle span').click(function () {
        if($('.clientPD #acf-form').css('display') == 'none')
        {
            $('.clientPD #acf-form').slideDown('slow');
            $('.rpdc').slideUp('slow');
        } else {
            $('.clientPD #acf-form').slideUp('slow');
            $('.rpdc').slideDown('slow');
        }
        $('.clientPD .myTitle span').toggleClass('active');
    })

    // ==================== sotrudniki=====================

    // const sotDataAttr = $('.sotr1').attr('data-post-id');
    $('.sotr1:contains("Client")').addClass('clt');
    $('.sotr1:contains("Клиент")').addClass('clt');
    $('.sotr1:contains("Редактор")').addClass('edtr');
    $('.sotr1:contains("Подписчик")').addClass('subscr');
    $('.sotr1:contains("Фрилансер")').addClass('subscr');
    $('.sotr1:contains("Администратор")').addClass('adm');


    let els = $('.vstatus');
    for (let i = 0; i < els.length; i++) {
        let cell = els[i];
        if (cell.textContent  == 'Низький') {
            cell.classList.add('stlow');
        }
        if (cell.textContent  == 'Звичайний') {
            cell.classList.add('stnorm');
        }
        if (cell.textContent  == 'Високий') {
            cell.classList.add('shight');
        }
        if (cell.textContent  == 'Гарячий') {
            cell.classList.add('sthot');
        }
    }
    const surl6 = $('#surl6').html();
    $('#loadRes').load(surl6 + "/wp-content/themes/devport/assets/js/km2.php",  {
        cu6: parseInt($('#cu6').html(), 10) });
        // function explode() {
        //     let lNum = $('#loadRes p').length;
        //     // console.log(lNum);
        //
        //         $('#numbMail').html(lNum);
        //
        // }
        // setTimeout(explode, 10);


    let timerId = setTimeout(function tick() {

        // $('#loadRes').load(surl6 + "/wp-content/themes/devport/assets/js/km2.php",  {
        //     cu6: parseInt($('#cu6').html(), 10) });
        //
        // $('#loadRes2').load(surl6 + "/wp-content/themes/devport/assets/js/km3.php",  {
        //     cu6: parseInt($('#cu6').html(), 10) });


        let lastDate = $('#loadRes .lastDate1').val();
        // console.log(lastDate);
        let savedDate = $('#savedDate').val();
        // console.log('vv' + savedDate);
        if (savedDate == undefined) {
            savedDate = '2021-08-06 14:52:56';
        }
        // console.log(savedDate);
        let numMess = $('#loadRes .lastDate1').filter(function () {
            return $(this).val() > savedDate;
        });
        let numMess1 = numMess.length;
        //  console.log(numMess1);

        // let tItems = $('#loadRes p').length;
        if (numMess1 > 0) {
            $('#numbMail, .numbMail').addClass('nmActive');
            $('.nmActive').html(numMess1);
        } else {
            $('#numbMail, .numbMail').removeClass('nmActive');
            $('.nmActive').html(0);
        }
        timerId = setTimeout(tick, 2000); // (*)
    }, 10);
    $('#numbMail, .numbMail').css('visibility', 'hidden');
    function showNotif() {
        $('#numbMail, .numbMail').css('visibility', 'visible');

    }
    setTimeout(showNotif, 2100);

    // ============== Analitika ========================
  $('.anFilterWr').on("change keyup", function () {
    $(".analCandItem").hide().filter(function () {
        let rtnData1 = "";
        let regRekruter = new RegExp($('.anRekruter').val().trim(), "ig");
        let regCandStatus = new RegExp($('.anStatus').val().trim(), "ig");

        rtnData1 = (
            $(this).attr("data-rekruter").match(regRekruter) &&
            $(this).attr("data-status").match(regCandStatus)
        );
        return rtnData1;
    }).fadeIn('fast');
  });
// ================= baza Kandidatov ====================bkfw
    $(".bkfOpen").click(function () {
        $(".bkfContent").toggleClass('showF');
        $('.bkfOpen .dashicons').toggleClass('rotateFarrow');
        // $(".about2").toggleClass('about_click');
        // $(".about2 .about1_descr").css('display', 'none');
        // if (!$(".about_map").hasClass("fullSize")) {
        //     function explode() {
        //         $(".about2 .about1_descr").css('display', 'block');
        //     }
        //
        //     setTimeout(explode, 600);
        // }
    });
    $('#bk_filtrs').on("change keyup", function () {
        $(".bkItem").hide().filter(function () {
        //     let rtnData = "";
        //     let regExName = $('#vac_speciality').val().trim().replace(/[\-\[\]{}()*+?.,\\\^$|#\s]/g, "\\$&");
        //     // let regExName = new RegExp($('#vac_speciality').val().trim(), "ig");
        //     let regComp = new RegExp($('#vac_comp').val().trim(), "ig");
        //     let regFramework = new RegExp($('#vac_framework').val().trim(), "ig");
        //     let regNoTech = new RegExp($('#vac_notech').val().trim(), "ig");
        //     let regCity = new RegExp($('.vac_city').val().trim(), "ig");
        //     //let regRegion = new RegExp($('#regSelect').val().trim(), "ig");
        //     let regRegion = $('#regSelect').val();
        //     let opyt_vacans_Val = $('#opyt_vacans_input').val();
        //     let zarpl_from_vac = $('#vac_zarplata_from').val();
        //     let zarpl_to_v1 = $('#vac_zarpl_to').val();
        //    let vacTitle = $('.vac_title').val();
        //     if(regRegion==null) {
        //         regRegion = '';
        //     }


            let rtnBK = "";
            let regSpecBK=regComp =regFramework=regNoTech=regCity= '';
            if($('#vac_speciality').val() !==null){
                regSpecBK = $('#vac_speciality').val().trim().replace(/[\-\[\]{}()*+?.,\\\^$|#\s]/g, "\\$&");
            }
            // if($('#vac_addspeciality').val() !==null){
            //     regSpecBK = $('#vac_addspeciality').val().trim().replace(/[\-\[\]{}()*+?.,\\\^$|#\s]/g, "\\$&");
            // }
            if($('#vac_techspeciality').val() !==null){
                regSpecBK = $('#vac_techspeciality').val().trim().replace(/[\-\[\]{}()*+?.,\\\^$|#\s]/g, "\\$&");
            }
           if($('#vac_comp').val() !==null){
                regComp = new RegExp($('#vac_comp').val().trim(), "ig");
            }
            if($('#vac_framework').val() !==null){
                regFramework = new RegExp($('#vac_framework').val().trim(), "ig");
            }
            if($('#vac_notech').val() !==null){
                regNoTech = new RegExp($('#vac_notech').val().trim(), "ig");
            }
            if($('.vac_city').val() !==null){
                regCity = new RegExp($('.vac_city').val().trim(), "ig");
            }
            let regRegion = $('#regSelect').val();
            if(regRegion==null) {
                regRegion = '';
            }
            let format1 = '';
            let format2 = '';
            let format3 = '';
            let format4 = '';
            let format5 = '';

            let opyt_bk = $('#opyt_vacans_input').val();
            //console.log(opyt_bk);

            if ($('#bk1').is(':checked')) {
                format1 = $('#bk1').val();
            }
            if ($('#bk2').is(':checked')) {
                format2 = $('#bk2').val();
            }
            if ($('#bk3').is(':checked')) {
                format3 = $('#bk3').val();
            }
            if ($('#bk4').is(':checked')) {
                format4 = $('#bk4').val();
            }
            if ($('#bk5').is(':checked')) {
                format5 = $('#bk5').val();
            }

            let eng1 = '';
            let eng2 = '';
            let eng3 = '';
            let eng4 = '';
            let eng5 = '';
            let eng6 = '';
            if ($('#bke1').is(':checked')) {
                eng1 = $('#bke1').val();
                console.log(eng1);
            }
            if ($('#bke2').is(':checked')) {
                eng2 = $('#bke2').val();
                console.log(eng2);
            }
            if ($('#bke3').is(':checked')) {
                eng3 = $('#bke3').val();
            }
            if ($('#bke4').is(':checked')) {
                eng4 = $('#bke4').val();
            }
            if ($('#bke5').is(':checked')) {
                eng5 = $('#bke5').val();
            }
            if ($('#bke6').is(':checked')) {
                eng6 = $('#bke6').val();
            }
            //let zarplbk = $('#zarpl').val();
            let zFrom = 0;
            let zTo = 100000;
            if($('#bk_zarplata_from').val()>0){
                zFrom = $('#bk_zarplata_from').val();
            }
            if($('#bkc_zarpl_to').val()>0){
                zTo = $('#bkc_zarpl_to').val();
            }
            console.log(zFrom);
            //let zarpl_to = $('#zarpl_to').val();
            rtnBK = (
                $(this).data("opytbk") >= opyt_bk &&
                $(this).data("work_format").match(format1) &&
                $(this).data("work_format").match(format2) &&
                $(this).data("work_format").match(format3) &&
                $(this).data("work_format").match(format4) &&
                $(this).data("work_format").match(format5) &&
                $(this).attr("data-dolzhn").match(regSpecBK) &&
                $(this).attr("data-companies").match(regComp) &&
                $(this).attr("data-framework").match(regFramework) &&
                $(this).attr("data-notech").match(regNoTech) &&
                $(this).attr("data-citybk").match(regCity) &&
                $(this).attr("data-region").match(regRegion) &&
                $(this).data("zar") >= zFrom &&
                $(this).data("zar") <= zTo &&
                $(this).data("angl").match(eng1) &&
                $(this).data("angl").match(eng2) &&
                $(this).data("angl").match(eng3) &&
                $(this).data("angl").match(eng4) &&
                $(this).data("angl").match(eng5) &&
                $(this).data("angl").match(eng6)
            );
            return rtnBK;
        }).fadeIn('fast');
    });
     // =====================================================================================
     $('.bazaFind').on("change keyup", function () {
        //  alert('mm88');
        function bazaDelay() {
        $(".bkItem").hide().filter(function () {
            let rtnData = "";
            let regExWord = new RegExp($('#bk0').val().trim().toLowerCase(), "ig");

            rtnData = (
                // $(this).attr("data-fam1").toLowerCase().match(regExWord) ||
                $(this).attr("data-citybk").toLowerCase().match(regExWord) ||
                $(this).attr("data-dolzhn").toLowerCase().match(regExWord) ||
                $(this).attr("data-framework").toLowerCase().match(regExWord) ||
                $(this).attr("data-notech").toLowerCase().match(regExWord) ||
                $(this).attr("data-companies").toLowerCase().match(regExWord) ||
                $(this).attr("data-angl").toLowerCase().match(regExWord) ||
                $(this).attr("data-opytbk").toLowerCase().match(regExWord) ||
                $(this).attr("data-zar").toLowerCase().match(regExWord) ||
                $(this).attr("data-work_format").toLowerCase().match(regExWord)
                // $(this).attr("data-reg1").toLowerCase().match(regExWord) ||
                // $(this).attr("data-spec1").toLowerCase().match(regExWord) ||
                // $(this).attr("data-spec4").toLowerCase().match(regExWord) ||
                // $(this).attr("data-spec3").toLowerCase().match(regExWord) ||
                // $(this).attr("data-angl").toLowerCase().match(regExWord) ||
                // $(this).attr("data-work_format").toLowerCase().match(regExWord) ||
                // $(this).attr("data-stat1").toLowerCase().match(regExWord) ||
                // $(this).attr("data-compn").toLowerCase().match(regExWord)
            );

        return rtnData;
        }).fadeIn(1);
        // if(!($(e.target).closest(".starWrapp[data-exist='yes']"))) {
        //     $(".rekv_form").hide();
        // }
        $('.saveVac:not(.activ_star)').parents('.vac_item').hide();
        $('.saveVac:not(.activ_star)').parents('.vac_item').fadeOut(1);
        let postCount = $('.right_vac .kandItem1:visible').size();
        $('.dp_post_count').html('Найдено вакансий: ' + postCount);
         }
        setTimeout(bazaDelay, 300);
    });

    // ================================================================================================
    // ======================================================
   $('.cdet [data-name="_post_title"] .acf-label label').html('Название Вашей Компании <span class="acf-required">*</span>');
   //$('.cdet [data-name="_post_title"] .acf-input input').prependTo('<span class="dashicons dashicons-admin-home"></span> ');
  // $(".chVac .acf-rel-item").prepend('<span class="dashicons dashicons-arrow-right-alt">44</span>');
     $('<span class="dashicons dashicons-admin-home"></span>').appendTo('.cdet [data-name="_post_title"] .acf-input-wrap');
     $('<span class="dashicons dashicons-flag"></span>').appendTo('.cdet [data-name="osnovana"] .acf-input-wrap');
     $('<span class="dashicons dashicons-businessperson"></span>').appendTo('.cdet [data-name="com_comp"] .acf-input-wrap');
     $('<span class="dashicons dashicons-plugins-checked"></span>').appendTo('.cdet [data-name="min_size"] .acf-input-wrap');
     $('<span class="dashicons dashicons-clock"></span>').appendTo('.cdet [data-name="avg_rate"] .acf-input-wrap');
     $('<span class="dashicons dashicons-admin-site-alt3"></span>').appendTo('.cdet [data-name="site_comp"] .acf-input-wrap');
     // ---------------------------------------------------------------------------------------
     $( '.cdet [data-name="_post_title"] .acf-input-wrap' ).hover(function(){
        $('.cdet [data-name="_post_title"] .acf-label label').fadeIn();
	    }, function(){
        $('.cdet [data-name="_post_title"] .acf-label label').fadeOut();
	  });
      $( '.cdet [data-name="osnovana"] .acf-input-wrap' ).hover(function(){
        $('.cdet [data-name="osnovana"] .acf-label label').fadeIn();
	    }, function(){
        $('.cdet [data-name="osnovana"] .acf-label label').fadeOut();
	  });
      $( '.cdet [data-name="tip_comp"] .acf-input' ).hover(function(){
        $('.cdet [data-name="tip_comp"] .acf-label label').fadeIn();
	    }, function(){
        $('.cdet [data-name="tip_comp"] .acf-label label').fadeOut();
	  });
      $( '.cdet [data-name="com_comp"] .acf-input-wrap' ).hover(function(){
        $('.cdet [data-name="com_comp"] .acf-label label').fadeIn();
	    }, function(){
        $('.cdet [data-name="com_comp"] .acf-label label').fadeOut();
	  });
      $( '.cdet [data-name="min_size"] .acf-input-wrap' ).hover(function(){
        $('.cdet [data-name="min_size"] .acf-label label').fadeIn();
	    }, function(){
        $('.cdet [data-name="min_size"] .acf-label label').fadeOut();
	  });
      $( '.cdet [data-name="avg_rate"] .acf-input-wrap' ).hover(function(){
        $('.cdet [data-name="avg_rate"] .acf-label label').fadeIn();
	    }, function(){
        $('.cdet [data-name="avg_rate"] .acf-label label').fadeOut();
	  });
      $( '.cdet [data-name="site_comp"] .acf-input-wrap' ).hover(function(){
        $('.cdet [data-name="site_comp"] .acf-label label').fadeIn();
	    }, function(){
        $('.cdet [data-name="site_comp"] .acf-label label').fadeOut();
	  });
// ======================= single candidate =================================
let rat = $('.kRating').data('rating');
if(rat!=undefined){
    // console.log(rat);
let arr2 = rat.split(',');
//let rat1 = '['+rat+']';

//let rat1 = arr2[1];
//let dd1 = dd.match('Прекрасно');
//let rat2 = JSON.parse(rat1);
//console.log(arr2);
if (arr2[0].match('Прекрасно')) {
    $('#rt1').addClass('rInnActive');
}
if (arr2[0].match('Хорошо')) {
    $('#rt2').addClass('rInnActive');
}
if (arr2[0].match('Плохо')) {
    $('#rt3').addClass('rInnActive');
}
// ..................................................
if (arr2[1].match('Прекрасно')) {
    $('#rt4').addClass('rInnActive');
}
if (arr2[1].match('Хорошо')) {
    $('#rt5').addClass('rInnActive');
}
if (arr2[1].match('Плохо')) {
    $('#rt6').addClass('rInnActive');
}
// ..................................................
if (arr2[2].match('Прекрасно')) {
    $('#rt7').addClass('rInnActive');
}
if (arr2[2].match('Хорошо')) {
    $('#rt8').addClass('rInnActive');
}
if (arr2[2].match('Плохо')) {
    $('#rt9').addClass('rInnActive');
}
// .................................................
if (arr2[3].match('Прекрасно')) {
    $('#rt10').addClass('rInnActive');
}
if (arr2[3].match('Хорошо')) {
    $('#rt11').addClass('rInnActive');
}
if (arr2[3].match('Плохо')) {
    $('#rt12').addClass('rInnActive');
}
}
// ................................................
//let vname = $('#loadHist2').load(surl6 + "/wp-json/wp/v2/vacancy/1177");
// console.log(vname);
// $.ajax({
//     beforeSend: (xhr) => {
//         xhr.setRequestHeader('X-WP-Nonce', devportData.cb);
//     },
//     url: 'http://localhost:8080/devport/wp-json/wp/v2/vacancy/1177',
//     type: 'GET',
//     success: (response) => {
//         //let currLD = $(".myM");
//         console.log(response);
//         console.log(response.title.rendered);
//         console.log(response.link);
//     },
//     error: (response) => {
//         console.log(response);
//     }
// });
//$('#loadHist2').load("http://localhost:8080/devport/wp-json/wp/v2/users");
//$('#loadHist2').load("http://localhost:8080/devport/wp-json/wp/v2/vacancy");
//$('#loadHist3').load(surl6 + "/wp-content/themes/devport/functions/candidate/get_vac_name.php");
//console.log(surl6);
$('#rhistory').on( 'click', function() {
    $('.historyW').fadeIn();
    $('#loadHist').load(surl6 + "/wp-content/themes/devport/functions/candidate/load_history.php",  {
        cu8: parseInt($('.currCand').html(), 10) });
    function hDelay2() {
       let name1 = '';
       let link1 = '';
       $( "#loadHist .vac1" ).each(function(  ) {
           let vacId = parseInt($( this ).text(), 10);
           $.ajax({
            beforeSend: (xhr) => {
                xhr.setRequestHeader('X-WP-Nonce', devportData.cb);
            },
            url: surl6 + '/wp-json/wp/v2/vacancy/'+vacId,
            type: 'GET',
            success: (response) => {
                name1=response.title.rendered;
                link1=response.link;
                // console.log(name1);
                // console.log(link1);
                $(this).append(`<span class="vac2">Hа вакансию: </span><a class="vac3" href="${link1}" class="vacName">${name1}</a>`);
            },
            error: (response) => {
                console.log(response);
            }
        });
      });
      $( "#loadHist .rekr1" ).each(function(  ) {
        let rekrId = parseInt($( this ).text(), 10);
        $(this).load(surl6 + "/wp-content/themes/devport/functions/candidate/get_vac_name.php",  {
            re: rekrId});
     });
     $( "#loadHist .frelns" ).each(function(  ) {
        let frId = parseInt($( this ).text(), 10);
        $(this).load(surl6 + "/wp-content/themes/devport/functions/candidate/get_freeln_name.php",  {
            fr: frId});
     });
    }setTimeout(hDelay2, 200);
});
$(document).on('click',function(e){
    if(!(($(e.target).closest("#rhistory").length > 0 ) || ($(e.target).closest(".historyW").length > 0))){
        $(".historyW").fadeOut();
    }
 });
 $('#ce2').on( 'click', function() {
    $('.historyW').fadeOut();
    //console.log('rabotaet');
    // alert('hello:)')
});
$('#button.myBtn').on( 'click', function() {
    // alert('hello:)');
});


// =========================================================
// $('#vac_comp p:contains("Playtika")').append("<div class='nbr1'><div class='nbr2'>4</div></div>");
// $('#vac_comp p:contains("Ciklum")').append("<div class='nbr1'><div class='nbr2'>7</div></div>");

//===============================================================================================
// $('#link5').on( 'click', function() {
//     alert('ggnn');
// });
//$('#vac_comp [value="Playtika"]').append("<span class='nbr1'>==</span>").css('background-color', 'blue');
//$('.nbr1').css('background-color', 'blue');
// alert ('ff77');
    // let timerId3 = setTimeout(function tick3() {

    //     console.log('kk');
    //     timerId3 = setTimeout(tick3, 2000); // (*)
    // }, 10);

    // let timerId = setTimeout(function tick() {

    //     timerId = setTimeout(tick, 2000); // (*)
    // }, 10);

    // $(".d2 .rlcomma").not(":last-child").append(",");
    // ======================================================
    // $('td[data-date="2020-02-02"] a').css('color', 'green');

   // let cval = $('td[data-date="2020-02-02"] a').html();
   // console.log(cval);
   //  $(".click_calendar").click(function () {
   //      let cval = $('td[data-date="2020-02-02"] a').html();
   //      console.log(cval);
   //  });
   //  console.log(cval);
   //  $("td a").click(function () {
   //      // alert('hi5');
   //      // console.log('hi6');
   //      let cval = $(this).html();
   //      console.log(cval);
   //  });

//      $(".fc-dayGridMonth-button").click(function () {
//          $('td.fc-day-top').prepend('<p class="sendNot1">click</p>');
//      });
// $('td.fc-day-top').prepend('<p class="sendNot1">click</p>');
//     $("#calendar").on("click", '.fc-day-top', gcClick.bind(this));
//    function gcClick(e)
//     {
//         // alert("create 33");
//         // var currentLikeBox = $(e.target).closest("#hlike");
//         // let curreA = $(e.target).closest(".fc-day-top").html();
//         let curreA = $(e.target).closest(".fc-day-top").children('a').html();
//         console.log(curreA);
//     }
//
//     $('#add-event').css('color', '#fff')
    // ======================================================
    var totalVotes = 0;
    $(".votes-design .votes_number").click(function () {
        $(".votes-design .votes_number").removeClass("votes_active");
        $(this).toggleClass("votes_active");
        var votevalue = parseInt($(this).data('votevalue'));
        // console.log(votevalue);
        var oldVal = $("#design_total").html();
        var oldVal2 = parseInt(oldVal, 10);
        //console.log(oldVal2);
        if (oldVal2 > 0) {
            totalVotes -= oldVal2;
        }
        $("#design_total").text(votevalue);
        totalVotes += votevalue;
        $("#totalVotes").text(totalVotes);
    });
    $(".votes-usability .votes_number").click(function () {
        $(".votes-usability .votes_number").removeClass("votes_active");
        $(this).toggleClass("votes_active");
        var votevalue = parseInt($(this).data('votevalue'));
        var oldVal = $("#usability_total").html();
        var oldVal2 = parseInt(oldVal, 10);
        if (oldVal2 > 0) {
            totalVotes -= oldVal2;
        }
        $("#usability_total").text(votevalue);
        totalVotes += votevalue;
        $("#totalVotes").text(totalVotes);
    });
    $(".votes-creativity .votes_number").click(function () {
        $(".votes-creativity .votes_number").removeClass("votes_active");
        $(this).toggleClass("votes_active");
        var votevalue = parseInt($(this).data('votevalue'));
        var oldVal = $("#creativity_total").html();
        var oldVal2 = parseInt(oldVal, 10);
        if (oldVal2 > 0) {
            totalVotes -= oldVal2;
        }
        $("#creativity_total").text(votevalue);
        totalVotes += votevalue;
        $("#totalVotes").text(totalVotes);
    });
    class Like {
        constructor() {
            this.events();
        }

        events() {
            // $("#hlike").on("click", this.ourClickDispatcher.bind(this));
            $(".likes_container").on("click", ".votes_number", this.ourClickDispatcher.bind(this));
            //$(".likes_container").on("click", ".votes_number", this.ourClickDispatcher.bind(this));
        }

        // methods
        ourClickDispatcher(e) {
             // alert("create 33");
            // var currentLikeBox = $(e.target).closest("#hlike");
            var currentLikeBox1 = $(e.target).closest(".votes_number");
            // var currentLikeBox2 = $(e.target).closest(".votes-usability .votes_number");
            // var currentLikeBox3 = $(e.target).closest(".votes-creativity .votes_number");
            // var currentLikeBox1 = $(e.target).closest(".votes-design .votes_number");
            //if (currentLikeBox.data('exists') == 'yes') {
            // if ($("#hlike").data('exists') == 'yes') {
            //      this.deliteLike(currentLikeBox);
            //  } else {
            //      this.createLike(currentLikeBox);
            //  }
            //

            // old --
             const postId = $("#totalVotes").attr('data-post-id');
            // if (postId) {
            //     this.editLike1(postId);
            // } else {
            //     this.createLike1();
            // }

            // new --
            const curUsrId = parseInt($("#currUserId").html(), 10);

            if (postId) {
                this.editLike1(postId);
            } else {
                this.createLike1();
            }


            // if ($(".votes-usability .votes_number").attr('data-exists') == 'yes') {
            //     this.deliteLike2(currentLikeBox2);
            // } else {
            //     this.createLike2(currentLikeBox2);
            // }
            // if ($(".votes-creativity .votes_number").attr('data-exists') == 'yes') {
            //     this.deliteLike3(currentLikeBox3);
            // } else {
            //     this.createLike1(currentLikeBox3);
            // }

        }

        createLike(currentLikeBox) {
            // alert("create vv");
            $.ajax({
                // beforeSend: function ( xhr ) {
                //     xhr.setRequestHeader( 'X-WP-Nonce', '<nonce>' );
                // },
                // beforeSend: (xhr) => {
                //     xhr.setRequestHeader('X-WP-Nonce', '<nonce>' );
                // },
                url: 'http://localhost:8080/ts/wp-json/ts/v1/managelike',
                type: 'POST',
                data: {'templateId': currentLikeBox.data('ts')},
                success: (response) => {
                    console.log(response);
                },
                error: (response) => {
                    console.log(response);
                }
            })
        }

        createLike1(currentLikeBox1) {
            // alert("create vv");
            // $("#totalVotes").attr('data-exists', 'yes');
            var idVal = $("#totalVotes").data('ts');
            var designVal = parseInt($("#design_total").html(), 10);
            var usabilVal = parseInt($("#usability_total").html(), 10);
            var creatVal = parseInt($("#creativity_total").html(), 10);
            var userVal = parseInt($("#currUserId").html(), 10);

            var votesData = {
                'templateId': idVal,
                'designVote': designVal,
                'usabilityVote': usabilVal,
                'creativityVote': creatVal,
                'userVal': userVal
            }
            $.ajax({
                url: 'http://localhost:8080/devport/wp-json/dp/v1/managelike',
                type: 'POST',
                // data: {'templateId': currentLikeBox.data('ts')},
                data: votesData,
                success: (response) => {
                    console.log(response);
                    $("#totalVotes").attr('data-post-id', response);
                },
                error: (response) => {
                    console.log(response);
                }
            })
            // $("#totalVotes").attr('data-exists', 'yes');
        }

        editLike1(postId) {
            console.log(postId);
            //var thisLike = $(currentLikeBox1.target).parents("span");
            // var thisLike = currentLikeBox1;
            alert('edit in ajax');
            var idVal = $("#totalVotes").data('ts');
            var designVal = parseInt($("#design_total").html(), 10);
            var usabilVal = parseInt($("#usability_total").html(), 10);
            var creatVal = parseInt($("#creativity_total").html(), 10);
            var userVal = parseInt($("#currUserId").html(), 10);

            var votesData = {
                'templateId': idVal,
                'designVote': designVal,
                'usabilityVote': usabilVal,
                'creativityVote': creatVal,
                'postId': postId,
                'userVal': userVal
            }
            $.ajax({
                url: 'http://localhost:8080/devport/wp-json/dp/v1/managelike',
                type: 'PUT',
                // data: {'templateId': currentLikeBox.data('ts')},
                data: votesData,
                success: (response) => {
                    console.log(response);
                },
                error: (response) => {
                    console.log(response);
                }
            })
            $("#totalVotes").attr('data-exists', 'yes');
        }
    }

    new Like();

    // ----------------------------------- cantries filter load values --------------------------
// $('#loadRes7').load(surl6 + "/wp-content/themes/devport/functions/load_countries_filter.php",  {
//     cu6: parseInt($('#cu6').html(), 10) });
    $('#loadRegions').load(surl6 + "/wp-content/themes/devport/functions/load_countries_regions_filter.php",  {
        cu6: parseInt($('#cu6').html(), 10) });
    $('#loadRes8').load(surl6 + "/wp-content/themes/devport/functions/load_countries_filter.php",  {
        cu6: parseInt($('#cu6').html(), 10) });
    $('#loadRes9').load(surl6 + "/wp-content/themes/devport/functions/loadCountriesFilter.php",  {
        cu6: parseInt($('#cu6').html(), 10) });
    $('#search_country_item').load(surl6 + "/wp-content/themes/devport/functions/load_countries_filter_2.php",  {
        cu6: parseInt($('#cu6').html(), 10) });

    // $('#loadRegions').on( 'click', function() {
    //     alert('works');
    //     });
    $('#loadRegions').on("change keyup", function () {
         $('#loadRes8  option').prop('selected', function() {
            return this.defaultSelected;
        });
        $('.vac_city  option').prop('selected', function() {
            return this.defaultSelected;
        });
        const region = $('#loadRegions').val();
        if (region === 'Україна') {
            $('.countries_wrapper').slideUp();
            $('.city_wrapper').slideDown();
        } else {
            $('.city_wrapper').slideUp();
            $('.countries_wrapper').slideDown();

            const region_options = $('#loadRes8  option');
            region_options.css('display', 'none');
            $("#loadRes8  option[data-region='" + region + "']").css('display', 'block');
        }
    });

    // ------------------- typing search ----------------------------
    $('#search_country').on( 'click', function() {
        myFunction();
    });
    function myFunction() {
        document.getElementById("search_country_div").classList.toggle("show");
      }
      $('#search_country_input').on("change keyup", function () {
         let input, filter, ul, li, a, i;
         filter = $('#search_country_input').val().toUpperCase();
        // filter = input.value.toUpperCase();
        //div = $('#search_country_div');
        a = $('#search_country_div p');
        for (i = 0; i < a.length; i++) {
          txtValue = a[i].textContent || a[i].innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            a[i].style.display = "";
          } else {
            a[i].style.display = "none";
          }
        }
       // console.log(input);
      });

    $('#search_country_div').on("click", getCountry.bind(this));
    function getCountry(e) {
        let currCountry = $(e.target).closest(".country2").text();
        $('#search_country_input').val(currCountry);
        $('#selected_country').val(currCountry);
        $('#search_country_div').slideUp();
        console.log(currCountry);
        filterVacansies();
    };
    $('#search_country_input').on("click", function () {
        if($('#search_country_div').css('display') == 'none')
            {
                $('#search_country_div').slideDown();
            }
    });

    $('#citySelect').on('keyup', function () {
        let divs = $('.countr_sc');
        var allcountr = [];
        for (var i = 0; i < divs.length; i++) {
            allcountr.push(divs[i].textContent);
        }
        $("#citySelect").autocomplete({
            source: allcountr
        });
    });

    // var $src = $('#acf-field_60d41cf93677b'),
    //     $dst = $('#acf-field_64199a44ba4b7');
    //
    // $src.on('change', function () {
    //     $dst.val($src.val());
    // });

    // $('#search_country_input').focus(function() {
    //     $('#search_country_div').slideDown();
    //   });
    //  $('#citySelect').attr('size', countCities );
    //   function filterFunction() {
    //     let input, filter, ul, li, a, i;
    //     input = document.getElementById("myInput");
    //     filter = input.value.toUpperCase();
    //     div = document.getElementById("myDropdown");
    //     a = div.getElementsByTagName("a");
    //     for (i = 0; i < a.length; i++) {
    //       txtValue = a[i].textContent || a[i].innerText;
    //       if (txtValue.toUpperCase().indexOf(filter) > -1) {
    //         a[i].style.display = "";
    //       } else {
    //         a[i].style.display = "none";
    //       }
    //     }
    //  }

    // $('.deleteCandidate').on('click', function () {
    //     window.location.href='/baza-kandidatov';
    // });

    // =========================================== Etapu spivbesid ======================================================
    if(document.querySelector('.stages')) {
        document.getElementById('add_custom_stage').addEventListener('click', function () {
            var stage = document.getElementById('custom_stage').value;
            var vacancy_id = document.querySelector('.stages').dataset.vacid; // здесь нужно указать правильный селектор для вакансии
            if (stage) {
                var newStage = document.createElement('div');
                newStage.classList.add('stage');
                newStage.dataset.stage = stage;
                newStage.innerHTML = '<span class="er-h">' + stage + '</span><button class="delete-stage" data-stage="' + stage + '">X</button>';
                document.querySelector('.stages').appendChild(newStage);

                // добавить новую стадию в custom_stages
                var customStagesValue = document.querySelector('[name="custom_stages"]').value;
                var customStages = customStagesValue ? customStagesValue.split(',') : [];
                customStages.push(stage);
                document.querySelector('[name="custom_stages"]').value = customStages.join(',');

                // обновить поле ACF с пользовательскими этапами
                updateACF(vacancy_id, 'custom_stages', customStages.join(','));

                // добавить обработчики перетаскивания для новой стадии
                addDragDropHandlers(newStage);
            }
        });

// Функция для добавления обработчиков перетаскивания к стадии
        function addDragDropHandlers(stage) {
            stage.addEventListener('dragover', function (e) {
                e.preventDefault();
            });
            stage.addEventListener('drop', function (e) {
                e.preventDefault();
                var candidateId = e.dataTransfer.getData('text/plain');
                var candidate = document.querySelector('.candidate[data-id="' + candidateId + '"]');
                if (candidate) {
                    this.appendChild(candidate);

                    // обновить поле ACF
                    document.querySelector('[name="candidate_stage"]').value = this.dataset.stage;
                    updateACF(candidateId, 'candidate_stage', this.dataset.stage);
                } else {
                    console.log('Кандидат не найден: ', candidateId);
                }
            });
        }

// Обработчик для перетаскивания кандидата
        var candidates = document.querySelectorAll('.candidate');
        candidates.forEach(function (candidate) {
            candidate.addEventListener('dragstart', function (e) {
                e.dataTransfer.setData('text/plain', candidate.dataset.id);
            });
        });

// Добавить обработчики перетаскивания для существующих стадий
        document.querySelectorAll('.stage').forEach(function (stage) {
            addDragDropHandlers(stage);
        });

        function updateACF(postId, fieldName, value) {
            var action;
            var data = {
                'action': '',
                'field_name': fieldName,
                'value': value
            };

            if (fieldName == 'custom_stages') {
                action = 'update_vacancy_custom_stages';
                data.vacancy_id = postId;
            } else {
                action = 'update_acf_field';
                data.candidate_id = postId;
            }

            data.action = action;

            jQuery.post(ajaxurl, data, function (response) {
                console.log('ACF field updated.');

                // Если обновляется поле custom_stages в вакансии
                if (fieldName == 'custom_stages') {
                    // Обновляем поле custom_stages для вакансии
                    jQuery.post(ajaxurl, {
                        'action': 'update_vacancy_custom_stages',
                        'vacancy_id': postId,
                        'custom_stages': value
                    }, function (response) {
                        console.log('Custom stages field in vacancy updated.');
                    });
                }
            });
        }

        document.addEventListener('click', function (event) {
            if (event.target.classList.contains('delete-stage')) {
                event.preventDefault();
                var stage = event.target.dataset.stage;
                var vacancy_id = document.querySelector('.stages').dataset.vacid;
                deleteCustomStage(vacancy_id, stage);
            }
        });

        function deleteCustomStage(vacancy_id, stage) {
            // Отправить AJAX-запрос для удаления кастомной стадии
            var data = {
                'action': 'delete_vacancy_custom_stage',
                'vacancy_id': vacancy_id,
                'stage': stage
            };

            jQuery.post(ajaxurl, data, function (response) {
                console.log('Custom stage deleted.');
                // Обновить интерфейс после удаления стадии
                var stageElement = document.querySelector('.stage[data-stage="' + stage + '"]');
                if (stageElement) {
                    stageElement.remove();
                }
            });
        }
    }


//         document.getElementById('add_custom_stage').addEventListener('click', function () {
//             var stage = document.getElementById('custom_stage').value;
//             var candidate = document.querySelector('.candidate');
//             var candidate_id = candidate.dataset.id;
//             if (stage) {
//                 var newStage = document.createElement('div');
//                 newStage.classList.add('stage');
//                 newStage.dataset.stage = stage;
//                 newStage.innerHTML = '<span class="er-h">' + stage + '</span>';
//                 document.querySelector('.stages').appendChild(newStage);
//                 // добавить новую стадию в custom_stages
//                 // добавить новую стадию в custom_stages
//                 var customStagesValue = document.querySelector('[name="custom_stages"]').value;
//                 var customStages = customStagesValue ? JSON.parse(customStagesValue) : [];
//                 customStages.push({kastomnij_stejdzh: stage});
//                 document.querySelector('[name="custom_stages"]').value = JSON.stringify(customStages);
// // обновить поле ACF с пользовательскими этапами
//                 updateACF(candidate_id, 'custom_stages', 'kastomnij_stejdzh', JSON.stringify(customStages));
//                 // добавить обработчики перетаскивания для новой стадии
//                 addDragDropHandlers(newStage);
//             }
//         });
//
// // Функция для добавления обработчиков перетаскивания к стадии
//         function addDragDropHandlers(stage) {
//             var candidate = document.querySelector('.candidate');
//             var candidate_id = candidate.dataset.id;
//             stage.addEventListener('dragover', function (e) {
//                 e.preventDefault();
//             });
//             stage.addEventListener('drop', function (e) {
//                 e.preventDefault();
//                 this.appendChild(candidate);
//                 // обновить поле ACF
//                 document.querySelector('[name="candidate_stage"]').value = this.dataset.stage;
//                 updateACF(candidate_id, 'candidate_stage', this.dataset.stage);
//             });
//         }
//
// // Обработчик для перетаскивания кандидата
//         var candidate = document.querySelector('.candidate');
//         candidate.addEventListener('dragstart', function (e) {
//             e.dataTransfer.setData('text/plain', 'candidate');
//         });
//
// // Добавить обработчики перетаскивания для существующих стадий
//         document.querySelectorAll('.stage').forEach(function (stage) {
//             addDragDropHandlers(stage);
//         });
//
//         function updateACF(candidateId, fieldName, subFieldName, value) {
//             var data = {
//                 'action': 'update_acf_field',
//                 'candidate_id': candidateId,
//                 'field_name': fieldName,
//                 'sub_field_name': subFieldName, // дополнительное поле для имени подполя
//                 'value': value
//             };
//
//             jQuery.post(ajaxurl, data, function (response) {
//                 console.log('ACF field updated.');
//             });
//         }
});

function fun1() {
    var rng = document.getElementById('opyt_vacans_input'); //rng - это Input
    var p = document.getElementById('opyt_vacans'); // p - абзац
    p.innerHTML = rng.value;
}
function fun2() {
    var rng = document.getElementById('opyt_bk'); //rng - это Input
    var p = document.getElementById('opyt_reult'); // p - абзац
    p.innerHTML = rng.value;
}

// var elem = document.querySelector('.js-range');
// var init = new Powerange(elem, { decimal: true });



// 'use strict';
// let range = {
//     el: document.querySelector('#range'),
//     output: document.querySelector('#range-value'),
//     data: ['Раз', 'Два', 'Три'],
//     update: function (id) {
//         this.output.value = range.data[id];
//     },
//     init: function () {
//         this.el.setAttribute("max", range.data.length - 1);
//         this.el.addEventListener('input', function () {
//             range.update(this.value);
//         });
//         range.update(0); //default value
//     }
// };
//
// range.init();
console.log('24 hours '+Math.floor(new Date().getTime() / 1000 + 84500));
    //console.log(Math.floor(new Date().getTime() / 1000));
     console.log('60 sec '+Math.floor(new Date().getTime() / 1000+60));

const expandableText = document.querySelector('.expandable-text');

if (expandableText) {
    expandableText.addEventListener('click', () => {
        expandableText.classList.toggle('expanded');
    });
}

document.addEventListener("DOMContentLoaded", function() {
    var settingsIcons = document.querySelectorAll('.settings-icon');

    settingsIcons.forEach(function(settingsIcon) {
        var userSettings = settingsIcon.closest('#user-settings');
        var settingsModal = userSettings.querySelector('.settings-modal');

        // Показать модальное окно, когда нажимают на иконку настроек
        settingsIcon.addEventListener('click', function(event) {
            // Сначала скрываем все модальные окна
            document.querySelectorAll('.settings-modal').forEach(function(modal) {
                modal.style.display = 'none';
            });

            // Показываем только текущее модальное окно
            settingsModal.style.display = 'block';

            // Предотвращаем всплытие события
            event.stopPropagation();
        });
    });

    // Скрыть модальное окно, когда клик происходит вне блока user-settings
    document.addEventListener('click', function() {
        document.querySelectorAll('.settings-modal').forEach(function(modal) {
            modal.style.display = 'none';
        });
    });

    var transferLinks = document.querySelectorAll('.transfer-admin');

    transferLinks.forEach(function(link) {
        link.addEventListener('click', function(e) {
            e.preventDefault();

            var userId = this.getAttribute('data-user-id');
            var confirmTransfer = confirm("Ви дійсно хочете передати права адміністратора?");

            if (confirmTransfer) {
                fetch(ajaxurl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded; charset=utf-8'
                    },
                    body: 'action=transfer_admin_rights&user_id=' + userId,
                    credentials: 'same-origin' // Важно для того, чтобы cookies были переданы
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert(data.message);
                        } else {
                            alert('Ошибка: ' + data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Ошибка AJAX:', error);
                    });

            }
        });
    });
});

