<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;

 ?>
 
<style>
td,th{
	word-wrap:break-word; width:200px;display:inline-block;
}
th{
	height:50px;
}

</style>


<body>
	<div class="container">
		<div class="row clearfix">
			<div class="col-md-12 column">
				<div style="color:red">注意：关于返回的参数，有可能为空</div>
				<table class="table">
					<thead>
						<tr>
							<th>
								请求路径
							</th>
							<th>
								请求参数
							</th>
							<th style="width:330px;">
								返回参数
							</th>
							<!--<th>
								详细报文信息
							</th>-->
							<th>
								上传时间
							</th>
							<th style="width:100px;">
								客户端
							</th>
						</tr>
					</thead>
					<tbody>

						<?php foreach($list as $k=>$v):?>
							<tr>
								<td  onclick="displayContent('<?php echo $v['url']?>',this)" date-type="1"><?php echo $v['request_url']?></td>
								<td onclick="displayContent('<?php echo $v['url']?>',this)" date-type="2"><?php echo $v['request_param'] ?></td>
								<td style="width:330px;" onclick="displayContent('<?php echo $v['url']?>',this)" date-type="3"><?php echo $v['response_param'] ?></td>
								
								<td><?php echo date('Y-m-d H:i:s',$v['createtime']);?></td>
								<td><?php echo $v['type'];?></td>
							</tr>
						<?php endforeach;?>
					</tbody>
				</table>
			</div>
			 <?php echo LinkPager::widget(['pagination' => $page]); ?>
		</div>
	</div>
</body>
<script>
	function displayContent(url,obj)
	{
		if(obj != null){
			url = url + '&type=' +$(obj).attr('date-type')
		}

		layer.open({
			type: 2, 
			content: url, //这里content是一个URL，如果你不想让iframe出现滚动条，你还可以content: ['http://sentsin.com', 'no']
			area:['700px','500px;'],
			scrollbar:true,
		}); 
		return false;
	}

    
</script>



