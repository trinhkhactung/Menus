<?php

	$menu = array(

		1	=>	array(
			'id'		=>		1,
			'title'		=>		'Thể thao',
			'parent_id'	=>		0,
		),

		2	=>	array(
			'id'		=>		2,
			'title'		=>		'Xã hội',
			'parent_id'	=>		0
		),

		3	=>	array(
			'id'		=>		3,
			'title'		=>		'Giải trí',
			'parent_id'	=>		0
		),

		4	=>	array(
			'id'		=>		4,
			'title'		=>		'Bóng đá',
			'parent_id'	=>		1
		),

		5	=>	array(
			'id'		=>		5,
			'title'		=>		'Tennis',
			'parent_id'	=>		1
		),

		6	=>	array(
			'id'		=>		6,
			'title'		=>		'Doanh nghiệp',
			'parent_id'	=>		2
		),

		7	=>	array(
			'id'		=>		7,
			'title'		=>		'Video',
			'parent_id'	=>		3
		),

		8	=>	array(
			'id'		=>		8,
			'title'		=>		'Phim',
			'parent_id'	=>		3
		),

		9	=>	array(
			'id'		=>		9,
			'title'		=>		'Nhạc',
			'parent_id'	=>		3
		),

		10	=>	array(
			'id'		=>		10,
			'title'		=>		'Nhạc Việt',
			'parent_id'	=>		9
		),

		11	=>	array(
			'id'		=>		11,
			'title'		=>		'Nhạc Hàn',
			'parent_id'	=>		9
		)

	);

	function getMenus($data, $parent_id = 0, $level = 0){
		$result = array();

		foreach ($data as $item) {
			if ($item['parent_id'] == $parent_id) {
				$item['level'] = $level; 
				$result[] = $item;// Thêm phần tử vào mảng result

				// Ở lần đệ quy, lặp tiếp theo không duyệt phần tử trước đó nữa
				unset($data[$item['id']]);
				$child = getMenus($data, $item['id'], $level + 1);
				$result = array_merge($result, $child);
			}
		}

		return $result;

	}

	$rs = getMenus($menu);
	echo "<pre>";
	print_r($rs);
	echo "</pre>";

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Menu</title>
	<style type="text/css">
		.sub_menu{
			display: none;
			
			transition: scale() 2s ease;
			transition-duration: .8s;
		}

		ul li:hover .sub_menu{
			display: block;
			
		}

		#check{
			width: 150px;
			height: 150px;
			background: red;
			transition: scale() 2s ease;
			transition-duration: .8s;
		}

		#check:hover{
			transform: scale(1.1);
		}

	</style>
</head>
<body>
	<h1>CÁCH 1</h1>
	<ul>
		<?php 
			foreach ($rs as $value) {
		?>
			<a href="#">
				<li>
					<?php echo str_repeat('-', $value['level'])." ".$value['title']; ?>
				</li>
			</a>
		<?php 
			} 
		?>
	</ul>

	<hr>

	<h1>CÁCH 2</h1>
	<ul type="I">
		<?php 
			foreach ($rs as $value) {
		?>
		<a href="#">
			<li>
				<?php if($value['level'] == 0){ echo $value['title']; } ?>
				<ol type="1">
					<a href="#"><?php if($value['level'] == 1){ echo '- '.$value['title']; } ?></a>
					<ul type="a">
						<a href=""><?php if($value['level'] == 2){ echo '--'.$value['title']; } ?></a>
					</ul>
				</ol>
			</li>
		</a>
		<?php 
			} 
		?>
	</ul>
</body>
</html>