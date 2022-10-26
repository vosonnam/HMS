
//Xuất thông báo khi thao tác thất bại
function alert_error(mes){
    bootbox.alert({
        size: "small",
        title: "<h4 style='color: red'>Thất bại</h4>",
        message: mes,
        callback: function(){ /* your callback code */}
        });
}
//Xuất thông báo khi thao tác thành công
function alert_success(mes,callback){
    bootbox.alert({
        size: "small",
        title: "<h4 style='color:green'>Thành công</h4>",
        message: mes,
        callback: callback
        });
}
//Xuất thông báo khi thao tác hiển thị thông tin
function alert_info(mes){
    bootbox.alert({
        size: "small",
        title: "<h4 style='color:yellow'>Thông báo</h4>",
        message: mes,
        callback: function(){ /* your callback code */}
        });
}
function queryDataGet(url, dataSend, callback)
{
    $.ajax
    (
        {
            type: 'GET',
            url: url,
            data: dataSend,
            async: true,
            dataType: 'text',
            success: callback
        }
    );
}

function queryDataPost(url, dataSend, callback)
{
    $.ajax
    (
        {
            type: 'POST',
            url: url,
            data: dataSend,
            async: true,
            dataType: 'text',
            success: callback
        }
    );
}
function queryDataPostJSon(url,dataSend,callback){
    
    $.ajax({
        type: 'POST',
        url: url,
        data: dataSend,
        async: true,
        dataType: 'JSON',
        success: callback
    });
}
function queryDataGetJSon(url,dataSend,callback){
    //t mơi tao cai hgm quryget do, doi ten lai khac cua ong thay th
    $.ajax({
        type: 'GET',
        url: url,
        data: dataSend,
        async: true,
        dataType: 'JSON',
        success: callback
    });
}
function logout() {
    var iduser=localStorage.getItem("id");
    queryDataPostJSon("../API/user/accout.php",{event:'logout',id:iduser},function (res) {
        if(res['logout']==1){
            localStorage.clear();
            sessionStorage.clear();
            window.location.href = "../index.html";
        }
    })
}
$('.dangxuat').click(function () {
    logout();
})
function checklogin() {
    var uemail=localStorage.getItem("email");
    var uname=localStorage.getItem("username");
    var id=localStorage.getItem("id");
    if(uname=="" || uname==undefined||uname==null){
        window.location.href = "../index.html";
    }
    if(id=="" || id==undefined||id==null){
        window.location.href = "../index.html";
    }
    $('.username').html(uname+'<i class="ti-angle-down"></i>');
}
checklogin();
//Hàm hiển thị phân trang
function buildSlidePage(obj,codan,pageActive,totalPage) {
    var html="";
    pageActive=parseInt(pageActive);
    for(i = 1 ; i <=codan; i++) {
        if(pageActive-i<0) break;
        html='<button type="button" class="btn btn-outline btn-default" value="'+(pageActive-i)+'">'+(pageActive-i+1)+'</button>'+html;
    }
    if(pageActive>codan){
        html='<button type="button" class="btn btn-outline btn-default" value="'+(pageActive-i)+'">...</button>'+html;
    }
    html+='<button type="button" class="btn btn-outline btn-default" style="background-color: #5cb85c" value="'+pageActive+'">'+(pageActive+1)+'</button>';
    for(i = 1 ; i <=codan; i++){
        if(pageActive+i>=totalPage) break;
        html=html+'<button  type="button" class="btn btn-outline btn-default" value="'+(pageActive+i)+'">'+(pageActive+i+1)+'</button>';
    }
    if(totalPage-pageActive>codan+1){
        html=html+'<button type="button" value="'+(pageActive+i)+'" class="btn btn-outline btn-default">...</button>';
    }
    obj.html(html);
}
function buildSelect(obj,dataList){
    var html=obj.html();
    for (key in dataList){
        html+='<option value="{val}">{val}</option>'.replace(/{val}/g,dataList[key]);
    }
    obj.html(html);
}
function queryData(url,dataSend,callback){
    
    $.ajax({
        type: 'POST',
        url: url,
        data: dataSend,
        async: true,
        dataType: 'JSON',
        success: callback
    });
}
function printSTT(record,pageCurr){
    if ((pageCurr+1)==1) {
        return 1;
    }else{
        return record*(pageCurr+1)-(record-1);
    }
}


function initUploadImage(idInput,idpreview,nameFuncion){
	'use strict';
	// Initialise resize library
	var resize = new window.resize();
	resize.init();
	// console.log("no");
	// Upload photo
	document.querySelector('#'+idInput).addEventListener('change', function (event) {
		event.preventDefault();

		// var input=$("#"+idInput);
		$("#"+idInput).change(function ()
		{
			// $("#"+idpreview).show();
			if (typeof(FileReader)!="undefined"){
			
				var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.ico|.jpg|.jpeg|.gif|.png)$/;
			
				$($(this)[0].files).each(function () {
					var getfile = $(this);
					if (regex.test(getfile[0].name.toLowerCase())) {
						var reader = new FileReader();
						reader.onload = function (e) {
							$("#imgPreviewStatus").attr("src",e.target.result);
						}
						reader.readAsDataURL(getfile[0]);
						//document.getElementById("savepath").value=getfile[0].name;
						//console.log(getfile[0]);
					}
					else {
						alert(getfile[0].name + " Không phải là file .");
						return false;
					}
				});
			}
			else {
				alert("Browser does not supportFileReader.");
			}
		});
		var files = event.target.files;
		var countFile=files.length;
		for (var i in files) {
			if (typeof files[i] !== 'object') return false;

			(function () {

				var initialSize = files[i].size;

				resize.photo(files[i], 1200, 'file', function (resizedFile) {

					var resizedSize = resizedFile.size;

					upload(resizedFile, function(res){
						console.log(res);
						var s=nameFuncion+"("+res+")";
						eval(s);
					});

					// This is not used in the demo, but an example which returns a data URL so yan can show the user a thumbnail before uploading th image.
					resize.photo(resizedFile, 600, 'dataURL', function (thumbnail) {
						//console.log('Display the thumbnail to the user: ', thumbnail);
					});

				});

			}());

		}

	});
};

var upload = function (photo, callback) {
	var formData = new FormData();
    formData.append('photo', photo);
    
    $.ajax({
        url: 'php/uploadfile.php',
        type : 'POST',
        data : formData,
        async: true,
        xhrFields: {
            withCredentials: true
        },
        processData: false,  // tell jQuery not to process the data
        contentType: false,  // tell jQuery not to set contentType
        success : callback
    });
};

