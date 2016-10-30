function ajax_send(postURL,objJSON,sFunc,eFunc) {
	if (objJSON==0) {
		$.ajax({
				url: postURL,
				type: 'post',
				dataType: 'JSON',
				contentType: 'application/json; charset=utf8',
				success: sFunc,
				error: eFunc
			});
	}
	else
	$.ajax({
			url: postURL,
			data: objJSON,
			type: 'post',
			dataType: 'JSON',
			contentType: 'application/json; charset=utf8',
			success: sFunc,
			error: eFunc
		});
}
function wrap_shop(item) {
	return '<div class="col-xs-6 col-md-3"><div class="shop"><div class="thumbnail"><a href="'+BASEURL+'/shop/s/'+item.id+'"><img src="'+BASEURL+'/static/src/'+item.id+'.jpg" alt="Loading..."></a><p class="lead"><span class="label label-default">商家</span>'+item.name+'<br/><span class="label label-default">地址</span>'+item.addr+'</p></div></div></div>';
}