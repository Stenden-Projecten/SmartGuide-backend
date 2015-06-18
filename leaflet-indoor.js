L.Indoor = L.Class.extend(
        {
            options:
                    {
                        getLevel: function (e) {
                            return e.properties.level
                        }},
            initialize: function (e, t) {
                L.setOptions(this, t), t = this.options;
                var n = this._layers = {};
                if (this._map = null, this._level = "level"in this.options ? this.options.level : null, "onEachFeature"in this.options)
                    var i = this.options.onEachFeature;
                this.options.onEachFeature = function (e, l) {
                    function o(e) {
                        n[e].addLayer(s)
                    }
                    if (i && i(e, l), "markerForFeature"in t) {
                        var s = t.markerForFeature(e);
                        if ("undefined" != typeof s) {
                            s.on("click", function (e) {
                                l.fire("click", e)
                            });
                            var r = t.getLevel(e);
                            "undefined" == typeof r ? (console.warn("level undefined for"), console.log(e)) : L.Util.isArray(r) ? r.forEach(o) : o(r)
                        }
                    }
                }, this.addData(e)
            }, addTo: function (e) {
                return e.addLayer(this), this
            }, onAdd: function (e) {
                if (this._map = e, null === this._level) {
                    var t = this.getLevels();
                    0 !== t.length && (this._level = t[0])
                }
                null !== this._level && this._level in this._layers && this._map.addLayer(this._layers[this._level])
            }, onRemove: function () {
                this._level in this._layers && this._map.removeLayer(this._layers[this._level]), this._map = null
            }, addData: function (e) {
                var t = this._layers, n = this.options, i = L.Util.isArray(e) ? e : e.features;
                i.forEach(function (e) {
                    var i, l = n.getLevel(e);
                    "undefined" != typeof l && null !== l && "geometry"in e && (L.Util.isArray(l) ? l.forEach(function (l) {
                        i = l in t ? t[l] : t[l] = L.geoJson({type: "FeatureCollection", features: []}, n), i.addData(e)
                    }) : (i = l in t ? t[l] : t[l] = L.geoJson({type: "FeatureCollection", features: []}, n), i.addData(e)))
                })
            }, getLevels: function () {
                return Object.keys(this._layers)
            }, getLevel: function () {
                return this._level
            }, setLevel: function (e) {
                if ("object" == typeof e && (e = e.newLevel), this._level !== e) {
                    var t = this._layers[this._level], n = this._layers[e];
                    null !== this._map && (this._map.hasLayer(t) && this._map.removeLayer(t), n && this._map.addLayer(n)), this._level = e
                }
            }, resetStyle: function (e) {
                return e.options = e.defaultOptions, this._setLayerStyle(e, this.options.style), this
            }, _setLayerStyle: function (e, t) {
                "function" == typeof t && (t = t(e.feature)), e.setStyle && e.setStyle(t)
            }}), L.indoor = function (e, t) {
    return new L.Indoor(e, t)
}, L.Control.Level = L.Control.extend({includes: L.Mixin.Events, options: {position: "bottomright", parseLevel: function (e) {
            return parseInt(e, 10)
        }}, initialize: function (e) {
        L.setOptions(this, e), this._map = null, this._buttons = {}, this._listeners = [], this._level = e.level, this.addEventListener("levelchange", this._levelChange, this)
    }, onAdd: function () {
        var e = L.DomUtil.create("div", "leaflet-bar leaflet-control");
        e.style.font = "18px 'Lucida Console',Monaco,monospace";
        for (var t = this._buttons, n = this._level, i = this, l = [], o = 0; o < this.options.levels.length; o++) {
            var s = this.options.levels[o], r = i.options.parseLevel(s);
            l.push({num: r, label: s})
        }
        for (l.sort(function (e, t) {
            return e.num - t.num
        }), o = l.length - 1; o >= 0; o--) {
            var s = l[o].num, a = l[o].label, h = L.DomUtil.create("a", "leaflet-button-part", e);
            (s === n || a === n) && (h.style.backgroundColor = "#b0b0b0"), h.appendChild(h.ownerDocument.createTextNode(a)), function (e) {
                h.onclick = function () {
                    i.setLevel(e)
                }
            }(s), t[s] = h
        }
        return e
    }, _levelChange: function (e) {
        null !== this._map && ("undefined" != typeof e.oldLevel && (this._buttons[e.oldLevel].style.backgroundColor = "#FFFFFF"), this._buttons[e.newLevel].style.backgroundColor = "#b0b0b0")
    }, setLevel: function (e) {
        if (e !== this._level) {
            var t = this._level;
            this._level = e, this.fireEvent("levelchange", {oldLevel: t, newLevel: e})
        }
    }, getLevel: function () {
        return this._level
    }}), L.Control.level = function (e) {
    return new L.Control.Level(e)
};