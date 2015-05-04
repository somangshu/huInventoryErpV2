<?php 
	$this->load->view('common/menu');
	if(isset($url))
	{
?>
<html lang="en">
<head>
	<title>
		IMAGES
	</title>
</head>
<body>
	<input type="hidden" name="url" id="url" value="<?php echo $url; ?>">
	<?php } ?>
	<input type="hidden" id="json" name="json" value='<?php echo $json; ?>'>
	<?php
	if($search && $flag)
	{
?>

	<div class="formstyle container">
	  <div class="col-sm-8 col-sm-offset-2">
	    <div class="well bs-component">
		<form name="searchform" id="searchform" onsubmit="return false" method="post">
			<fieldset>
			<i class="mdi-content-create"></i>Search
			<hr>
			<div class="form-group">
				Category Tags:<br /> 
				<select id="categories" name="categories[]" multiple="multiple" onchange="updatesubcat();">
                    <?php
                        foreach($array["hum_menu_list"] as $category)
                            {
                                $value = strtolower($category['name']);
                                $value = str_replace(' ','_',$value);
                                
                                if(in_array($value, $post['categories']))
                                	echo '<option value="'.$value.'" selected="selected">'.$category['name'].'</option>';
                                else
                                	echo '<option value="'.$value.'">'.$category['name'].'</option>';
                             } 
                    ?>
                </select>
                <br />Sub-Category Tags:<br /> 
                <div id="subs">
                	<select id="subcategories" name="subcategories[]" multiple="multiple">
                    <?php
                        	foreach($array["hum_menu_list"] as $category)
                            {
                                $value = strtolower($category['name']);
                                $value = str_replace(' ','_',$value);
                                
                                if(in_array($value, $post['categories']) && isset($category['subcategories']))
                                {
                                	foreach($category['subcategories'] as $subcategory)
                                	{
                                		$subvalue = strtolower($subcategory['name']);
                                		$subvalue = str_replace(' ','_',$subvalue);
                                		
                                		if(in_array($subvalue, $post['subcategories']))
                                			echo '<option value="'.$subvalue.'" selected="selected">'.$subcategory['name'].'</option>';
                                		else
                                			echo '<option value="'.$subvalue.'">'.$subcategory['name'].'</option>';
                             		}
                             	}
                            }
                            
                    ?>
                </select>
                </div>
	              <div class="form-control-wrapper">
	              	<b>#</b><input class="form-control empty" type="text" name="tag" id="tag" value="<?php echo $post['tag']; ?>">
	            </div>
	    </div>
	    <label>Source</label>
	    <br />
	    <select class="form-control" name="source" id="source">
	    <?php	
	    	if($post['source'] == 'None') 
            	echo '<option value="None" selected="selected">Either</option>"';
            else
            	echo '<option value="None">Either</option>"';
            
            if($post['source'] == 'Web')
            	echo '<option value="Web" selected="selected">Web</option>"';	
            else
            	echo '<option value="Web">Web</option>"';
            if($post['source'] == 'inhouse')
            	echo '<option value="inhouse" selected="selected">In-house</option>"';
            else
            	echo '<option value="inhouse">In-house</option>"';
        ?>
        </select>
	  	<div>

	<label>Date</label>
	<div class="input-append">
	    <input class="date-picker" id="date" name="date" value="<?php echo $post['date']; ?>" htype="text" />
	    <label for="date" class="add-on"><i class="mdi-content-create"></i> </label>
	</div>
	  		<div><hr style="margin-top: 0px;"></div>
	  		<div class="text-center">
	  		<input type="button" id="sub" class="btn btn-primary" onclick="return search()" value="Submit">
			</div>
			</fieldset>

		</form>
	</div>
	</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src = "public/js/default.js"></script>
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<script>
	  $(function() {
	    $( "#date" ).datepicker({ dateFormat: 'yy-mm-dd' });
	  });
	  </script>
<?php 
}
?>
<?php 
	if($search && !$flag)
	{
?>

	<div class="formstyle container">
	  <div class="col-sm-8 col-sm-offset-2">
	    <div class="well bs-component">
		<form name="searchform" id="searchform" onsubmit="return false" method="post">
			<fieldset>
			<i class="mdi-content-create"></i>Search
			<hr>
			<!-- <div class="form-group"> -->
               	Category Tags:<br /> 
				<select id="categories" name="categories[]" multiple="multiple" onchange="updatesubcat();">
                    <?php
                        foreach($array["hum_menu_list"] as $category)
                            {
                                $value = strtolower($category['name']);
                                $value = str_replace(' ','_',$value);
                                echo '<option value="'.$value.'">'.$category['name'].'</option>';
                             } 
                    ?>
                </select>
               	<br />Sub-Category Tags:<br /> 
                <div id="subs"></div>
	              <div class="form-control-wrapper">
	              	<b>#</b><input class="form-control empty" type="text" name="tag" id="tag">
	              </div>
	    <!-- </div> -->
	    <label>Source</label>
	    <br />
	    <select class="form-control" name="source" id="source"> 
            <option value="None" selected="selected">Either</option>"
            <option value="Web">Web</option>"
            <option value="inhouse">In-house</option>"
        </select>
	  	<div>

	<label>Date</label>
	<div class="input-append">
	    <input class="date-picker" id="date" name="date" htype="text" />
	    <label for="date" class="add-on"><i class="mdi-content-create"></i> </label>
	</div>
	  		<div><hr style="margin-top: 0px;"></div>
	  		<div class="text-center">
	  		<input type="button" id="sub" class="btn btn-primary" onclick="return search()" value="Submit">
			</div>
			</fieldset>

		</form>
	</div>
	</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src = "public/js/default.js"></script>
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<script>
	  $(function() {
	    $( "#date" ).datepicker({ dateFormat: 'yy-mm-dd' });
	  });
	  </script>
<?php 
}
?>

<?
if($flag)
{
?>	
<form class="form-horizontal" name="deleteimageform" id="deleteimageform" onsubmit="return false" method="post">
<div id="container">	
	<div class="col-sm-12">
<?php 
	for($i=0;$i<count($imagedata['url']);$i++)
	{
?>

		<div class="col-sm-3">
		<div class="checkbox">
            <label>
                <input type="checkbox" id="checkbox<?php echo $i; ?>" name="checkbox<?php echo $i; ?>" value='<?php echo $imagedata["imageid"][$i]; ?>'> Delete
            </label>
        </div>
		<?php
		echo $imagedata['url'][$i];
		?>
	</div>
	<?php
	}
	echo '</form>';
	echo '<input type="button" id="sub" class="btn btn-primary" onclick="return deleteimages()" value="Delete Images" style="width:100%">';
	echo '<form class="form-horizontal" name="infoform" id="infoform" onsubmit="return getinfo()" method="post">';
	if($url == 'getimages')
	{
		$cat = 0;
		$subcat = 0;
		if(isset($post['categories']))
		{
			$categories = implode(', ', $post['categories']);
			$cat = 1;
		}
		if(isset($post['subcategories']))
		{
			$subcategories = implode(', ', $post['subcategories']);
			$subcat = 1;
		}
?>		
		<input type='hidden' name='tag' id='tag' value="<?php echo $post['tag'];?>">
		<input type='hidden' name='source' id='source' value="<?php echo $post['source'];?>">
		<input type='hidden' name='date' id='date' value="<?php echo $post['date'];?>">
		<?php 
		if($cat)
			echo '<input type="hidden" name="categories" id="categories" value="<?php echo $categories;?>">';
		if($subcat)
			echo '<input type="hidden" name="subcategories" id="subcategories" value="<?php echo $subcategories;?>">';
		if($url)
			echo '<input type="hidden" name="url" id="url" value="'.$url.'">';

	}
}
?>
</div>
<div class="col-sm-12">
<?php
	echo '<h3><pre><a href="javascript: getinfo(\''.$url.'\', 1);">          First Page          </a>';
	echo '<a href="javascript: getinfo(\''.$url.'\', '.$imagedata['totalpages'].');">          Last Page          </a>';
	echo '<br />';
	echo '<br />';
	if($imagedata['page'] != 1)
	{
		$back = $imagedata['page'] - 1;
		echo '<a href="javascript: getinfo(\''.$url.'\', '.$back.');">               Back          </a>';
	}
	if($imagedata['page'] != $imagedata['totalpages'])
	{
		$next = $imagedata['page'] + 1;
		echo '<a href="javascript: getinfo(\''.$url.'\', '.$next.');">          Next          </a>('.$imagedata['page'].' of '.$imagedata['totalpages'].' pages)</pre></h3>';
	}
?>
</div>
</div>
</form>
</body>
</html>