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
	res = '<div class="col-md-4 latis-left" id="cuisine'+item.id+'" num="0" price="'+item.price+'">' + 
			'<h3>'+item.name+'</h3>'+
			'<img src="'+BASEURL+item.pic+'" class="img-responsive" alt="">'+
			'<div class="special-info grid_1 simpleCart_shelfItem">'+
				'<p>'+item.info+'</p>'+
				'<div class="cur">'+
					'<div class="cur-left">'+
						'<button type="button" class="offbtn btn btn-success disabled" id="subbtn'+item.id+'" onclick="sub('+item.id+')">-</button>'+
						' <kbd class="" style="font-size:18px" id="cuisineNum'+item.id+'">0</kbd> '+
						'<button type="button" class="offbtn btn btn-success" onclick="add('+item.id+')">+</button>'+
					'</div>'+
					'<div class="cur-right">'+
						'<span class="item_price"><h6>only ￥'+item.price+'</h6></span>'+
					'</div>'+
					'<div class="clearfix"> </div>'+
				'</div>'+
			'</div>'+
		'</div>';
	return res;
}
function wrap_cuisine_manage(item) {
	res = '<div class="col-md-4 latis-left" id="cuisine' + item.id + '">' + 
			'<h3>'+item.name+'</h3>'+
			'<img src="'+BASEURL+item.pic+'" class="img-responsive" alt="">'+
			'<div class="special-info grid_1 simpleCart_shelfItem">'+
				'<p>'+item.info+'</p>'+
				'<div class="cur">'+
					'<div class="cur-left">'+
						'<button type="button" ' + (item.st == 0 ? 'style="display: none;"' : '') +  ' class="putbtn btn btn-default" onclick="put('+item.id+')">上架</button><button type="button" ' + (item.st == 1 ? 'style="display: none;"' : '') +  ' class="offbtn btn btn-success" onclick="off('+item.id+')">下架</button>'+
					'</div>'+
					'<div class="cur-right">'+
						'<button type="button" class="delbtn btn btn-danger" onclick="del('+item.id+')">删除</button>'+
					'</div>'+
					'<div class="clearfix"> </div>'+
				'</div>'+
			'</div>'+
		'</div>';
	return res;
}
