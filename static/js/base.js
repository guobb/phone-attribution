

var PHONE = PHONE || {};
PHONE.GLOBAL = {};
PHONE.APPS = {};

PHONE.APPS.QUERYPHONE = {};
PHONE.APPS.QUERYPHONE.showInfo = function(){
    $('#phoneInfo').show();
};
PHONE.APPS.QUERYPHONE.hideInfo = function(){
    $('#phoneInfo').hide();
};
PHONE.APPS.QUERYPHONE.dataCallback = function(data) {
    if (data.code == 200) {
        PHONE.APPS.QUERYPHONE.showInfo();
        $('#phoneNumber').text(data.phone);
        $('#phoneProvince').text(data.province);
        $('#phoneCatName').text(data.catName);
        $('#phoneMsg').text(data.msg);
    } else {
        PHONE.APPS.QUERYPHONE.hideInfo();
        alert(data.msg);
    }
};

PHONE.GLOBAL.ajax = function(url, method, params, dataType, callback){
    $.ajax({
        url: url,
        type: method,
        data: params,
        dataType: dataType,
        success: callback,
        error:function(){
            alert('请求异常');
        }
    });
};