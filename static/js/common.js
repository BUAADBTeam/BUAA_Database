function ajax_send(postURL,objJSON,sFunc,eFunc)
{
	if (objJSON==0) {
		$.ajax({
				url: postURL,
				type: 'post',
				dataType: 'JSON',
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
			success: sFunc,
			error: eFunc
		});
}

function isUser()
{
	return ROLE == 1;
}

function isShop()
{
	return ROLE == 2;
}

function isDelivery()
{
	return ROLE == 3;
}

function load_error(data)
{
	alert("加载失败，请重试");
}

function op_error(data)
{
	alert("操作失败，请重试");
}

function wrap_shop(item)
{
	return '<div class="col-xs-6 col-md-3"><div class="shop"><div class="thumbnail"><a href="'+BASEURL+'/shop/s/'+item.id+'"><img src="'+BASEURL+'/static/src/'+item.id+'.jpg" alt="Loading..."></a><p class="lead"><span class="label label-default">商家</span>'+item.name+'<br/><span class="label label-default">地址</span>'+item.addr+'</p></div></div></div>';
}

function wrap_cuisine(item)
{
	res = '<div class="col-md-4 latis-left">'+
			'<div class="cuisine" id="cuisine'+item.id+'" cuisineid="'+item.id+'" name="'+item.name+'" picsrc="'+item.pic+'" num="0" price="'+item.price+'"></div>'+
				'<h3>'+item.name+'</h3>'+
				'<img src="'+BASEURL+item.pic+'" class="img-responsive" alt="">'+
				'<div class="special-info grid_1">'+
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
			'</div>'+
		'</div>';
	return res;
}

function wrap_cuisine_manage(item)
{
	res = '<div class="col-md-4 latis-left" id="cuisine' + item.id + '">' + 
			'<h3>'+item.name+'</h3>'+
			'<img src="'+BASEURL+item.pic+'" class="img-responsive" alt="">'+
			'<div class="special-info grid_1">'+
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

function wrap_total_price(total)
{
	return '<div class="row"><div class="col-lg-4 col-md-offset-2"><h3>总计</h3></div><div class="col-lg-3 col-md-offset-3"><h3>￥'+parseFloat(total).toFixed(2)+'</h3></div></div>'
}

function wrap_cuisine_order(item)
{
	return '<div class="row">'+
              '<div class="col-lg-3 thumbnail">'+
              '<img src="'+BASEURL+item.pic+'" alt="...">'+
              '</div>'+
              '<div class="col-lg-9">&nbsp;</div>'+
              '<div class="col-lg-9">&nbsp;</div>'+
              '<div class="col-lg-5"><span style="font-size: 20px">'+item.name+'</span></div>'+
              '<div class="col-lg-2">&times;'+item.num+'</div>'+
              '<div class="col-lg-2">￥'+(item.num*item.price).toFixed(2)+'</div>'+
            '</div>';
}

function wrap_order(order)
{
	order.count = parseInt(order.count);
	res = '<div class="order-top" id="order"'+order.id+' orderid="'+order.id+'">'+
				'<li class="im-g"><img src="'+BASEURL+order.user.pic+'" class="img-responsive" alt=""></li>'+
				'<li class="data"><h3>'+order.user.name+'</h3>'+
				'<p>'+order.user.addr+'</p>'+
				'<P>'+order.user.info+'</P>'+
			'</li>'+
			'<li class="bt-nn">'+
				'<button type="button" class="btn btn-success btn-lg" onclick="showOrder('+order.id+')" data-toggle="modal" data-target="#mymodal-order">详情</button>'+
			'</li>'+
			'<div class="clearfix"></div>'+
			'<div id="orderDetail'+order.id+'" style="display:none">';
	for (var i = 0; i < order.count; i++) {
		res += wrap_cuisine_order(order.items[i]);
	}
	res += wrap_total_price(order.All);
	res += '</div></div>';
	return res;
}
