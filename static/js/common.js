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

function wrap_cuisine(item) {
	res = '<div class="col-md-4 latis-left">' + 
			'<h3>'+item.name+'</h3>'+
			'<img src="'+BASEURL+item.pic+'" class="img-responsive" alt="">'+
			'<div class="special-info grid_1 simpleCart_shelfItem">'+
				'<p>'+item.desc+'</p>'+
				'<div class="cur">'+
					'<div class="cur-left">'+
						'<div class="item_add"><span class="item_price"><a class="morebtn hvr-rectangle-in" href="#">加入购物车</a></span></div>'+
					'</div>'+
					'<div class="cur-right">'+
						'<div class="item_add"><span class="item_price"><h6>only ￥'+item.price+'</h6></span></div>'+
					'</div>'+
					'<div class="clearfix"> </div>'+
				'</div>'+
			'</div>'+
		'</div>';
	return res;
}
