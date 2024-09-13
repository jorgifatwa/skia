require(["../common" ], function (common) {  
    require(["main-function","../app/app-kebijakan-airlines"], function (func,application) { 
    App = $.extend(application,func);
        App.init();  
    }); 
});