<?php 
$this->load->view('common/menu');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>
		IMAGE!
	</title>
</head>
<body>
<div class="container">
    <div class="row">
        <form id="updateimage" name="updateimage" onsubmit="return false;">
        <div class="col-sm-12 full_image_info_page">
            <div class="col-sm-5">
                <div class="row">
                    <a href="#" data-toggle="modal" data-target="#myModal"><img class="img-responsive"src="<?php echo $info[0]['imageurl'];?>"> </a>
                    <div class="strip"> 
                        <div class="col-sm-9">
                            <div class="list-group">
                                <div class="list-group-item">
                                    <div class="row-picture">
                                        <img class="circle" src=<?php echo $info[5]['profile']; ?>>
                                    </div>
                                    <div class="row-content">
                                        <h4 class="list-group-item-heading"><?php echo $info[0]['username']; ?></h4>
                                        <p class="list-group-item-text"><?php echo $info[0]['caption']; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="likes">
                                <i class="mdi-action-favorite"></i>
                                <span><?php echo $info[0]['likes']; ?> <span class="italic like_text"> likes</span></span>
                            </div>
                            <!-- <div class="likes">
                            <i class="mdi-communication-textsms"></i>
                            <span>35 <span class="italic like_text"> comments</span></span>
                            </div> -->
                            
                        </div>                        
                        </div>
                    </div>
                </div>
            <input type="hidden" id="imageid" name="imageid" value="<?php echo $info[0]['imageid']; ?>">
            <div class="col-sm-7">
                <h2>IMAGE FULL INFORMATION</h2>
                <table class="img_info_full">
                    <tr>
                        <td>Uploaded By</td>
                        <td>:</td>
                        <td class="italic"><?php echo $info[0]['username']; ?></td>
                    </tr>
                    <tr>
                        <td>Inserted At</td>
                        <td>:</td>
                        <td class="italic"><?php echo $info[0]['createdat']; ?></td>
                    </tr>
                    <tr>
                        <td>Source</td>
                        <td>:</td>
                        <td class="italic"><?php echo $info[0]['source']; ?></td>
                    </tr>
                    <tr>
                        <td>Image Id</td>
                        <td>:</td>
                        <td class="italic"><?php echo $info[0]['imageid']; ?></td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>:</td>
                        <td>
                           
                            <div class="radio radio-primary active_state">
                                <label>
                                    <?php 
                                        if($info[1]['status'] == 'active')
                                        {
                                    ?>
                                    <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked="">
                                    <span class="circle"></span><span class="check"></span>
                                    <?php
                                        }
                                        else
                                        {
                                    ?>
                                    <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1">
                                    <span class="circle"></span><span class="check"></span>
                                    <?php 
                                        }
                                    ?>
                                    Active
                                </label>
                            </div>
                            <div class="radio radio-primary inactive_state">
                                <label>
                                    <?php 
                                        if($info[1]['status'] == 'inactive')
                                        {
                                    ?>
                                    <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2" checked="">
                                    <span class="circle"></span><span class="check"></span>
                                    <?php
                                        }
                                        else
                                        {
                                    ?>
                                    <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                                    <span class="circle"></span><span class="check"></span>
                                    <?php 
                                        }
                                    ?>
                                    Inactive
                                </label>
                            </div>
                                       
                        </td>
                    </tr>
                    <tr>
                        <td>Categories Tags</td>
                        <td>:</td>
                        <td>
                            
                            <input type="hidden" id="json" name="json" value='<?php echo $json; ?>'>

                            <select id="categories" multiple="multiple" onchange="updatesubcat();">
                                <?php
                                    foreach($array["hum_menu_list"] as $category)
                                    {
                                        $value = strtolower($category['name']);
                                        $value = str_replace(' ','_',$value);
                                        echo '<option value="'.$value.'">'.$category['name'].'</option>';
                                    } 
                                ?>
                            </select>
                                       
                        </td>
                         </tr>
                    <tr>
                        <td>Subcategories Tags</td>
                        <td>:</td>
                        <td id='pickme'>
                           
                            <!-- <select id="subcategories" multiple="multiple">
    
                            </select> -->
                            <div id="subs"></div>           
                        </td>
                    </tr>
                    <tr>
                        <td>Consumer Types</td>
                        <td>:</td>
                        <td>
                           
                            <!-- Build your select: -->
                            <select id="consumertype" multiple="multiple">
                                <option value="home">Web(Home)</option>
                                <option value="product">Web(Product)</option>
                                <option value="app">Application</option>
                                
                            </select>
                                       
                        </td>
                    </tr>
                    <tr>
                        <td>Manual Tags</td>
                        <td>:</td>
                        <td>
                            <div class="form-control-wrapper">
                                <input class="form-control empty" id="manualtags" type="text">
                                <div class="floating-label">Write Tags with semicolon in between</div><span class="material-input"></span>
                            </div>
                        </td>
                    </tr>
                    
                </table>
                <?php
                echo '<input type="button" id="sub" class="btn btn-primary" value="Update Image" onclick="updatethisimage();">';
                ?> 
            </div>
        </div>
        </form>
    </div>
</div>
 


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">FULL PREVIEW</h4>
      </div>
      <div class="modal-body">
        <div class="col-sm-12">
            <img class="img-responsive"src="<?php echo $info[0]['imageurl'];?>"> 
        </div>
      </div>
      
  </div>
</div>

 
       <!--  <td><?php echo $info[1]['status']; ?></td> -->
        <!-- <td>
        <?php 
            foreach($info[4] as $tag)
                echo $tag.'<br />'
        ?>
        </td> -->
<!-- Initialize the plugin: -->
<script type="text/javascript">
    $(document).ready(function() 
    {
        $('#categories').multiselect();
        $('#subcategories').multiselect();
        $('#consumertype').multiselect();
        
    });
</script>
<!-- <script src = "public/js/default.js"></script> -->
</body>
</html> 