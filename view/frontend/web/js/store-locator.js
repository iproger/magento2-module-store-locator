define([
    'jquery'
], function ($) {
    'use strict';

    $.widget('iproger.storeLocator', {
        map: null,
        options: {
            storeAddresses: []
        },
        _create: function () {
            this._initMap();
            this._initLocations();
            this._initEventHandlers();
        },
        _initMap: function () {
            var mapCanvas = this.element.find('#store-map-canvas')[0];
            var options = {
                zoom: 14
            };

            this.map = new google.maps.Map(mapCanvas, options);
        },
        _initLocations: function () {
            var listContainer = $(this.element).find('ul');

            if (this.options.storeAddresses.length) {
                for (var key in this.options.storeAddresses) {
                    var address = this.options.storeAddresses[key];
                    var street = address.street1 + ' ' + address.street2;
                    var el = '<li><a href="#" data-index="' + key + '">' + address.name + ' | ' + street + '</a></li>';
                    listContainer.append(el);

                    var marker = new google.maps.Marker({
                        position: {
                            lat: address.lat,
                            lng: address.lng
                        },
                        title: address.name
                    });

                    marker.setMap(this.map);
                }

                // set first store as default
                this.selectLocation(0);
            }
        },
        _initEventHandlers: function () {
            var self = this;
            $(this.element).find('.store-list a').on('click', function () {
                var locId = $(this).attr('data-index');
                self.selectLocation(locId);

                return false;
            });
        },
        selectLocation: function (locIndex) {
            var address = this.options.storeAddresses[locIndex];

            var locLatLng = new google.maps.LatLng(
                address.lat, address.lng
            );

            this.map.setCenter(locLatLng);
        }
    });

    return $.iproger.storeLocator;
});
