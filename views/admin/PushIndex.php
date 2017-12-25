<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;

 ?>
 
<style>
td,th{
	word-wrap:break-word; width:160px;display:inline-block;
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
								推送内容
							</th>
							<!--<th>
								请求service
							</th>-->
							<th>
								创建时间
							</th>
                            <th>
								推送用户id
							</th>
							<th>
								推送用户名字
							</th>
							<th>
								返回消息
							</th>
							<th style="width:100px;">
								推送服务商
							</th>
                        
						</tr>
					</thead>
					<tbody>

						<?php foreach($list as $k=>$v):?>
							<tr>
								<td> <?php echo $v['sender']?></td>
								<!--<td> <?php echo $v['text'] ?></td>-->
                                <td><?php echo $v['createtime']?></td>
								<td> <?php echo $v['user_id'] ?></td>
								
								<td><?php echo $v['display_array']?></td>
								<td><?php echo $v['return_info']?></td>
								<td><?php echo $v['type']?></td>
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



