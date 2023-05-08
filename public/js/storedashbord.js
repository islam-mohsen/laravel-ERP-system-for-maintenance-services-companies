$(document).ready(function () {
    init();
    function disabelall(){
        $("#store").hide();
        $("#dashbord").hide();
        $("#sealse").hide();
        $("#Purchases").hide();
    }
    function init(){
        disabelall();
        $("#dashbord").show();
    }
   
    
    $("#storebu").click(function (e) { 
        e.preventDefault();
        disabelall();
        $("#store").show();
        
    });
    $("#salesbu").click(function (e) { 
        e.preventDefault();
        disabelall();
        $("#sealse").show();
    });
    $("#purchbut").click(function (e) { 
        e.preventDefault();
        disabelall();
        $("#Purchases").show();
    });
});