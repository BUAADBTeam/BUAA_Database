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

function wrap_shop_list(item)
{
	return '<div class="order-top">'+
				'<li class="im-g"><a href="'+BASEURL+'shop/s/'+item.id+'"><img src="'+BASEURL+item.photo+'" class="img-responsive" alt=""></a></li>'+
				'<li class="data"><h4>&nbsp;'+item.name+'</h4>'+
					'<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+item.address+'</p>'+
					'<P> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+item.intro+'</P>'+
				'</li>'+
				'<li class="bt-nn">'+
					'<a class="morebtn hvr-rectangle-in" href="'+BASEURL+'shop/s/'+item.id+'" style="padding-right:30px">进入</a>'+
				'</li>'+
				'<div class="clearfix"></div>'+
			'</div>';
}

function wrap_shop_welcome(item)
{
	return '<div class="col-md-4 latis-left">'+
				'<div align = "center"> <h3>'+item.name+'</h3> </div>'+
				'<div align = "center"> <img src="'+BASEURL+item.photo+'" class="img-responsive" alt=""> </div>'+
				'<div class="special-info grid_1">'+
				  '<div align = "center"> <p>'+item.addr+'</p> </div>'+
				'</div>'+
				'<div class="cur">'+
					'<div class="cur-left">'+
						'<a class="morebtn hvr-rectangle-in" href="shop/s/'+item.id+'">进店逛逛</a></span>'+
					'</div>'+
					'<div class="cur-right">'+
						'<div class="item_add"><span class="item_price"><h2><span style="color:orange"><span class="glyphicon glyphicon-star"></span>&nbsp;<span class="glyphicon glyphicon-star"></span>&nbsp;<span class="glyphicon glyphicon-star"></span>&nbsp;<span class="glyphicon glyphicon-star"></span>&nbsp;<span class="glyphicon glyphicon-star"></span></span></h2></span></div>'+
					'</div>'+
					'<div class="clearfix"> </div>'+
				'</div>'+
			'</div>';
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
function wrap_cuisine_welcome(item)
{
	return '<div class="col-md-4 latis-left">'+
      '<h3>'+item.name+'</h3>'+
      '<img src="'+BASEURL + item.pic+'" class="img-responsive" alt="">'+
      '<div class="special-info grid_1">'+
        '<p>'+item.info+'</p>'+
        '<div class="cur">'+
          '<div class="cur-left">'+
            '<div class="item_add"><span class="item_price"><a class="morebtn hvr-rectangle-in" href="'+BASEURL+'shop/s/'+item.sid+'">查看更多</a></span></div>'+
          '</div>'+
          '<div class="cur-right">'+
            '<div class="item_add"><span class="item_price"><h6>only ￥'+item.price+'</h6></span></div>'+
          '</div>'+
            '<div class="clearfix"> </div>'+
        '</div>'+
      '</div>'+
    '</div>';
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
				'<div class="col-lg-2">&times;'+item.amount+'</div>'+
				'<div class="col-lg-2">￥'+(item.amount*item.price).toFixed(2)+'</div>'+
			'</div>';
}

function wrap_order(order)
{
	order.count = parseInt(order.count);
	if (isUser() || isDelivery() && order.status <= 4) {
		order.user = order.shopInfo;
	}
	else {
		order.user = order.userInfo;
	}
	var type = 'info';
	var opo = '';
	var op = '';
	var info;
	var available = false;
	var btn;
	if (order.status == 1) {
		if (isUser()) {
			type = 'danger';
			op = 'qrcode('+order.orderid+', '+order.userid+', '+order.shopid+')';
			info = '确认付款';
			available = true;
		}
		else {
			info = '等待付款';
		}
	}
	else if (order.status == 2) {
		if (isShop()) {
			type = 'danger';
			opo = '$(this).attr(\'class\', \'btn btn-warning btn-lg\');shopAcceptOrder('+order.orderid+', '+order.userid+', '+order.shopid+')';
			op = 'deliveryAcceptOrder('+order.orderid+', '+order.userid+', '+order.shopid+')';
			info = '确认发货';
			available = true;
		}
		else {
			info = '等待派送';
		}
	}
	else if (order.status == 3) {
		if (isShop()) {
			type = 'warning';
			op = 'allocOrder('+order.orderid+', '+order.userid+', '+order.shopid+')';
			info = '确认发货';
			available = true;
		}
		else {
			info = '等待派送';
		}
	}
	else if (order.status == 4) {
		if (isDelivery()) {
			op = 'deliveryAcceptOrder('+order.orderid+', '+order.userid+', '+order.shopid+')';
			type = 'danger';
			info = '确认送达';
			available = true;
		}
		else if (isUser()) {
			info = '您的外卖已在路上';
		}
		else {
			info = '等待收货';
		}
	}
	else if (order.status == 5) {
		if (isUser()) {
			type = 'warning';
			op = 'userGetOrder('+order.orderid+', '+order.userid+', '+order.shopid+')';
			info = '确认收货';
			available = true;
		}
		else {
			info = '等待收货';
		}
	}
	else if (order.status == 6) {
		if (isUser()) {
			type = 'warning';
			op = 'userComment('+order.orderid+', '+order.userid+', '+order.shopid+')';
			info = '提交评价';
			available = true;
		}
		else {
			info = '等待评价';
		}
	}
	else {
		type = 'success';
		info = '订单已完成';
	}

	if (available) {
		btn = '<button type="button" onclick="'+op+'" class="btn btn-'+type+' btn-lg btn-block lead"><span class="glyphicon glyphicon-circle-arrow-up"></span>&nbsp;'+info+'</button>';
	}
	else {
		btn = '<button type="button" class="btn btn-'+type+' btn-lg btn-block lead disabled">&nbsp;'+info+'</button>';
	}
	res = '<div class="order-top" id="order"'+order.orderid+' orderid="'+order.orderid+'">'+
				'<li class="im-g"><img src="'+BASEURL+order.user.photo+'" class="img-responsive" alt=""></li>'+
				'<li class="data"><h3>&nbsp;&nbsp;'+order.user.username+'</h3><br />'+
				'<p>&nbsp;&nbsp;&nbsp;地址: '+order.user.address+'</p>'+
				// '<P>'+order.info+'</P>'+
				'<P>&nbsp;&nbsp;&nbsp;备注: '+'无备注'+'</P>'+
			'</li>'+
			'<li class="bt-nn">'+
				'<button type="button" class="btn btn-'+type+' btn-lg" onclick="{showOrder('+order.orderid+');'+opo+'}" data-toggle="modal" data-target="#mymodal-order">详情</button>'+
			'</li>'+
			'<div class="clearfix"></div>'+
			'<div id="orderDetail'+order.orderid+'" style="display:none">';
	for (var i = 0; i < order.count; i++) {
		res += wrap_cuisine_order(order.items[i]);
	}
	res += wrap_total_price(order.total);
	if (order.status == 6 && isUser()) {
		res += '<div class="row"><span style="font-size:30px"><div class="col-lg-3">商家</div>';
		for (i = 0; i < 5; i++) {
			res += '<div class="col-lg-1"><a href="" onmouseover="setShopComment('+(i+1)+')" onclick="return false;"><span class="starShop'+(i+1)+' glyphicon glyphicon-star" style="color:red"></span></a></div>';
		}
		res += '</span></div>';
		res += '<div class="row"><span style="font-size:30px"><div class="col-lg-3">快递员</div>';
		for (i = 0; i < 5; i++) {
			res += '<div class="col-lg-1"><a href="" onmouseover="setDevlComment('+(i+1)+')" onclick="return false;"><span class="starDevl'+(i+1)+' glyphicon glyphicon-star" style="color:red"></span></a></div>';
		}
		res += '</span></div>';
	}
	res += '</div><div id="orderBtn'+order.orderid+'" style="display:none">';
	res += btn;
	res += '</div></div>';
	return res;
}
