require(["../common" ], function (common) {  
    require(["main-function","../app/app-galeri"], function (func,application) { 
    App = $.extend(application,func);
        App.init();  
    }); 
});