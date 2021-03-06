/*
 * Textify - Columnize, Paginate and Touch Your Long Text
 * Programmer: Fabio Ferrante
 * CodeCanyon: http://codecanyon.net/user/kernelstudio/portfolio
 *
 * If this script you like, please put a comment on codecanyon.
 *
 * Includes jQuery Easing v1.3
 * http://gsgd.co.uk/sandbox/jquery/easing/
 * Copyright (c) 2008 George McGinley Smith
 * jQuery Easing released under the BSD License.	
 *
 */
(function(e) {
	e.fn.textify = function(t) {
		defaults = {
			numberOfColumn: 2,
			margin: 20,
			padding: 15,
			width: "screen",
			height: "screen",
			showNavigation: true,
			textAlign: "justify",
			isZoom: false
		};
		var n;
		var t = e.extend(defaults, t);
		return this.each(function() {
			function g() {
				if (t.width === "auto") {
					l = d.width()
				} else if (t.width === "screen") {
					l = e(window).width()
				} else if (typeof t.width == "string") {
					l = parseInt(t.width);
					if (isNaN(t.width)) {
						l = defaults.width
					}
				} else {
					l = t.width
				}
				if (t.height === "auto") {
					c = d.height()
				} else if (t.height === "screen") {
					c = e(window).height()
				} else if (typeof t.height === "string") {
					c = parseInt(t.height);
					if (isNaN(t.height)) {
						c = defaults.height
					}
				} else {
					c = t.height
				}
				return [l, c]
			}

			function b(n) {
				v = n.clone(true);
				m = n.clone(true);
				g();
				t.startPage = 1;
				d.empty().append('<div class="textify"/>').children().css({
					height: c,
					width: l
				}).append('<div class="contentText"/>');
				s = Math.floor((l - t.padding * 2 - t.margin * (t.numberOfColumn - 1)) / t.numberOfColumn);
				o = c - t.padding * 2;
				r = d.children(":first");
				u = r.children(":first");
				L();
				if (v.find("img").length > 0) {
					v.find("img").each(function(t) {
						var n = e(this).attr("src");
						var r = e(this);
						var i = e("<img />").load(function() {
							w(this, r);
							if (t + 1 === v.find("img").length) {
								E()
							}
						}).error(function() {
							alert("There was a problem with the image file");
							return false
						}).attr("src", n)
					})
				} else {
					E()
				}
			}

			function w(e, t) {
				if (e.width > s) {
					t.css({
						display: "block",
						width: s,
						margin: 0,
						padding: 0
					});
					thisNewHeight = e.height * t.width() / e.width;
					if (thisNewHeight >= o) {
						t.css({
							display: "block",
							width: "auto",
							margin: 0,
							height: o,
							padding: 0
						})
					}
				} else {
					if (e.height >= o - 100) {
						t.css({
							display: "block",
							height: o - 100,
							margin: 0,
							padding: 0
						})
					} else {
						t.css({
							display: "block",
							"margin-right": "20px",
							"margin-top": "10px",
							"margin-bottom": "10px"
						})
					}
				}
			}

			function E() {
				r.children().css({
					height: c,
					width: l * t.startPage
				}).append('<div class="page' + t.startPage + '" />').children().css({
					height: c - t.padding * 2,
					width: l - t.padding * 2,
					padding: t.padding,
					"float": "left"
				});
				a = r.find(".page" + t.startPage);
				C()
			}

			function S(t, n) {
				theBox = n;
				if (t.contents().length > 0 && v.text().length > 0) {
					t.contents().each(function() {
						model = e(this).clone();
						model.appendTo(theBox);
						if (f.height() > o) {
							model.detach();
							x(e(this), theBox);
							return false
						} else {
							model.detach();
							e(this).appendTo(theBox)
						}
					})
				}
			}

			function x(t, n) {
				if (t.contents().length > 0 && v.text().length > 0) {
					if (t[0].nodeType === 1) {
						T(t);
						n.append(tag);
						theBox = n.find(nodeName).last()
					} else {
						theBox = n
					}
					t.contents().each(function(n) {
						model = e(this).clone();
						model.appendTo(theBox);
						if (f.height() > o) {
							model.detach();
							if (e(this).contents().length > 0) {
								x(e(this), theBox);
								return false
							} else if (e(this)[0].nodeName === "IMG") {
								C();
								return false
							} else {
								if (t[0].nodeName.toLowerCase() === "li") {
									p = true
								} else {
									p = false
								}
								N(e(this), theBox);
								return false
							}
						} else {
							model.detach();
							e(this).appendTo(theBox)
						}
					})
				} else {
					allPar = e(t).text().split(".");
					y = 0;
					if (f.height() <= o) {
						while (f.height() <= o) {
							n.append(allPar[y] + ".");
							$prefinish = v.html();
							var r = new RegExp("(?![^<>]*>)" + allPar[y] + ".");
							news = v.html();
							news = news.replace(/\&nbsp\;/g, " ");
							news = news.replace(r, "");
							v.html(news);
							y++
						}
						v.html($prefinish);
						n.html(e(n).html().slice(0, n.html().lastIndexOf(allPar[y - 1])));
						N(v, theBox)
					}
				}
			}

			function T(e) {
				nodeName = e[0].nodeName.toLowerCase();
				var t, n, r, i;
				i = {};
				tag = "<" + nodeName;
				attr = e[0].attributes;
				for (t = 0; t < attr.length; t++) {
					if (attr[t].specified) {
						tag = tag + " " + attr[t].name.toLowerCase() + "=" + attr[t].value
					}
				}
				tag = tag + "/>";
				return [nodeName, tag]
			}

			function N(t, n) {
				textString = e(t).text().replace(/\&nbsp\;/g, " ");
				allChars = textString.split(/\s+/);
				y = 0;
				if (f.height() >= o) {
					p = false
				}
				if (f.height() <= o) {
					while (f.height() <= o) {
						n.append(allChars[y] + " ");
						$prefinish = v.html();
						if (allChars[y].indexOf("[") > -1 || allChars[y].indexOf("]") > -1 || allChars[y].indexOf("(") > -1 ||
							allChars[y].indexOf(")") > -1 || allChars[y].indexOf("?") > -1 || allChars[y].indexOf(".") > -1) {
							thisChar = allChars[y].replace(/[[]/g, "[[]");
							thisChar = thisChar.replace(/[]]/g, "[]]");
							thisChar = thisChar.replace(/[(]/g, "[(]");
							thisChar = thisChar.replace(/[)]/g, "[)]");
							thisChar = thisChar.replace(/[?]/g, "[?]");
							thisChar = thisChar.replace(/[.]/g, "[.]")
						} else if (allChars[y].indexOf("&") > -1) {
							thisChar = "&"
						} else {
							thisChar = allChars[y]
						}
						var r = new RegExp("(?![^<>]*>)" + thisChar);
						news = v.html();
						news = news.replace(/\&nbsp\;/g, " ");
						news = news.replace(r, "");
						v.html(news);
						y++
					}
					v.html($prefinish);
					n.html(e(n).html().slice(0, n.html().lastIndexOf(allChars[y - 1])))
				}
				C()
			}

			function C() {
				f = a.children(":last");
				f.find("li").filter(function() {
					return e(this).text() == ""
				}).remove();
				if (p) {
					v.find("li:first-child").css("list-style", "none");
					p = false
				}
				if (t.showNavigation) {
					if (r.find(".textify_nav").length == 0) {
						r.append('<div class="textify_nav"/>').children().last().css({
							left: Math.floor((l - r.find(".textify_nav").width()) / 2)
						}).append("<ul/>").children().attr("class", "text_pagination").append(function() {
							var n = "";
							h = r.find(".text_pagination");
							for (i = 0; i < t.startPage; i++) {
								e("<li/>").appendTo(h).click(function() {
									k(e(this))
								});
								if (i === 0) {
									h.find("li").attr("class", "selected")
								}
							}
						})
					}
					o = c - t.padding * 2 - e(".textify_nav").outerHeight()
				}
				if (a.children().length < t.numberOfColumn) {
					a.append('<div class="column"/>');
					f = a.children(":last");
					if (a.children().length !== t.numberOfColumn) {
						f.css("margin-right", t.margin)
					}
					f.css({
						width: s,
						"float": "left",
						"text-align": t.textAlign
					});
					setTimeout(function() {
						S(v, f)
					}, 100)
				} else {
					t.startPage++;
					if (t.showNavigation) {
						if (r.find(".textify_nav").length > 0) {
							e("<li/>").appendTo(h).click(function() {
								k(e(this))
							});
							r.find(".textify_nav").css({
								left: Math.floor((l - r.find(".textify_nav").width()) / 2)
							})
						}
					}
					u.css("width", l * t.startPage);
					u.append('<div class="page' + t.startPage + '" />');
					a = r.find(".page" + t.startPage);
					a.css({
						height: c - t.padding * 2,
						width: l - t.padding * 2,
						padding: t.padding,
						"float": "left"
					});
					a.append('<div class="column"/>');
					f = a.children(":last");
					if (r.find(".column").length !== t.numberOfColumn) {
						f.css("margin-right", t.margin)
					}
					f.css({
						width: s,
						"float": "left",
						"text-align": t.textAlign
					});
					setTimeout(function() {
						S(v, f)
					}, 100)
				}
				return false
			}

			function k(e) {
				r.find(".text_pagination li").removeClass("selected");
				e.addClass("selected");
				marginLeft = l * e.index();
				console.log(marginLeft)
				u.animate({
					marginLeft: [-marginLeft, "easeOutExpo"]
				}, 600)
			}

			function L() {
				var n, i, s, o = u;
				o.live("gesturechange", function(e) {
					t.isZoom = true
				});
				o.live("gestureend", function(e) {
					t.isZoom = false
				});
				if (!t.isZoom) {
					o.bind("touchstart touchmove touchend", function(t) {
						if (t.originalEvent.touches.length > 1) return;
						if (t.type == "touchstart") {
							i = parseInt(o.css("margin-left"));
							s = i;
							n = t.originalEvent.touches[0].pageX || t.originalEvent.changedTouches[0].pageX;
							startY = t.originalEvent.touches[0].pageY || t.originalEvent.changedTouches[0].pageY
						} else if (t.type == "touchmove") {
							movX = t.originalEvent.changedTouches[0].pageX - n;
							movY = t.originalEvent.changedTouches[0].pageY - startY;
							s = i + movX;
							if (Math.abs(movY) < Math.abs(movX)) {
								o.css("margin-left", s + "px");
								t.preventDefault()
							}
						} else if (t.type == "touchend") {
							if (Math.abs(movY) < Math.abs(movX)) {
								r.find(".text_pagination").children().each(function() {
									if (e(this).hasClass("selected") && i !== s) {
										if (s < i && e(this).index() + 1 < r.find(".text_pagination").children().length) {
											obj = e(this).next()
										} else if (s > i && e(this).index() + 1 > 1) {
											obj = e(this).prev()
										} else {
											obj = e(this)
										}
										s = i;
										k(obj);
										return false
									}
								})
							}
						}
					})
				}
			}
			var r, s, o, u, a, f, l, c, h, p = false;
			var d = e(this);
			var v = e(this).clone(true);
			var m = e(this);
			b(v);
			e(window).resize(function() {
				g();
				if (l !== e(".textify").width() || c !== e(".textify").height()) {
					clearInterval(n);
					d.empty();
					d.next(".textify_nav").remove();
					n = setTimeout(function() {
						b(m)
					}, 200)
				}
			})
		})
	}
})(jQuery)
