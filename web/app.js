(function() {
    'use strict';
    
    var module = angular.module('Controllers', []);
    var app = angular.module('App', [
        'Controllers'
    ]);

    module.controller('MainController', [
        '$http', 
        MainController
    ]);

    function MainController(
        $http
    ){
        this.$http = $http;
        
        this.searchKeyword = 'プログラミング';
        this.sortSelectMenu = [
            { num:1, label:'関連度', tag:'relevance' }, 
            { num:2, label:'閲覧数', tag:'mostviewed' },
            { num:3, label:'ダウンロード数', tag:'mostdownloaded' },
            { num:4, label:'最新', tag:'latest' },
        ];
        this.selectedSort = this.sortSelectMenu[1];
        this.isString = angular.isString;
        this.slideShareData = null;
    }
    MainController.prototype = {
        init: function() {
            this.getSlideShareData();
        },
        getSlideShareData: function() {
            var q = encodeURI(this.searchKeyword);
            var that = this;
            this.$http.get('php/search.php?keyword='+ q + '&sort=' + this.selectedSort.tag).
            success(function(response){
                that.slideShareData = response;
                console.log(that.slideShareData);
            }).
            error(function(data, status, headers, config) {
                alert('Error: getSlideShareData');
            });
        }
    };
    
    app.filter('truncate', function () {
        return function (text, length, suffix) {
            if (typeof text === 'undefined') {
                text = '';
            }        
            if (isNaN(length)) {
                length = 10;
            }
            if (typeof suffix === 'undefined') {
                suffix = '...';
            }
            if (text.length > length) {
                return String(text).substring(0, length) + suffix;
            }
            return text;
        };
    });
})();
