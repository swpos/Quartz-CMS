<?php
	if(strpos($_SERVER['REQUEST_URI'], 'Administrator/') !== false) {
?>
<?php 
	if(!function_exists('full_url')){
		function full_url() {
			$https = !empty($_SERVER['HTTPS']) && strcasecmp($_SERVER['HTTPS'], 'on') === 0;
			return
					($https ? 'https://' : 'http://') .
					(!empty($_SERVER['REMOTE_USER']) ? $_SERVER['REMOTE_USER'] . '@' : '') .
					(isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : ($_SERVER['SERVER_NAME'] .
							($https && $_SERVER['SERVER_PORT'] === 443 ||
							$_SERVER['SERVER_PORT'] === 80 ? '' : ':' . $_SERVER['SERVER_PORT'])));
		}
	}
?>
</td>
</tr>
</table>
<input type="submit" name="post" value="Submit" class="btn btn-primary">
</div>
</div>
</form>
</div>
<div class="container-fluid">
    <nav class="slide-menu">
        <header>
            <span class="title">Options</span> <a class="pull-right" href="#">Close</a>
        </header>
        <section>
            <h3>Reload</h3>
            <ul>
                <li><a href="#" class="reload-css">Reload CSS</a></li>
                <li><a href="#" class="reload-js">Reload JS</a></li>
            </ul>
            <h3>Clear</h3>
            <ul>
                <li><a href="#" class="clear-css">Clear CSS</a></li>
            </ul>
        </section>
    </nav>
    <div class="slide-panel">
        <ul id="settingIframe" class="rightclickmenu" style="display:none;">
            <li class="copy"><a href="#copy">Copy</a></li>
            <li class="cut"><a href="#cut">Cut</a></li>
            <li class="paste"><a href="#paste">Paste</a></li>
            <li class="edit"><a href="#setting">Setting</a></li>
            <li class="delete"><a href="#clearstyle">Clear Style</a></li>
            <li class="edit"><a href="#movedown">Move down</a></li>
            <li class="edit"><a href="#moveup">Move up</a></li>
            <li class="paste"><a href="#addrow1">+ Row - 1</a></li>
            <li class="paste"><a href="#addrow2">+ Row - 2</a></li>
            <li class="paste"><a href="#addrow3">+ Row - 3</a></li>
            <li class="paste"><a href="#addrow4">+ Row - 4</a></li>
            <li class="paste"><a href="#addrow6">+ Row - 6</a></li>
            <li class="paste"><a href="#addrow12">+ Row - 12</a></li>
            <li class="paste"><a href="#addcontainer">+ Container</a></li>
            <li class="paste"><a href="#addsection">+ Section</a></li>
            <li class="edit"><a href="#normalfluid">Fluid</a></li>
            <li class="delete"><a href="#delete">Delete</a></li>
        </ul>
        <ul id="settingMain" class="rightclickmenu2" style="display:none;">
            <li class="copy"><a href="#copy">Copy</a></li>
        </ul>
        <div class="overlay"></div>
        <div class="row understand">
            <div class="col-md-12">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title"><span class="glyphicon glyphicon-exclamation-sign"></span>To build a template, follow these instructions :</h3>
                    </div>
                    <div class="panel-body">
                        <div class="widgets">
                            <div class="alert alert-success">
                                <div class="row">
                                    <div class="col-md-6">
                                        <ul style="text-align:left;">
                                            <li>Right-click in the dotted area to add sections</li>
                                            <li>Right-click in the dotted area to add containers</li>
                                            <li>Right-click in the dotted area to add rows</li>
                                            <li>Right-click on any widgets or elements in the dotted area to copy</li>
                                            <li>Right-click in the dotted area to paste</li>
                                            <li>Right-click to copy, left-click to select destination and CTRL + V to paste</li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <ul style="text-align:left;">
                                            <li>Click on the Grid Toggle button to show/hide the template grid</li>
                                            <li>Right-click on any elements in the dotted area to customize the settings</li>
                                            <li>Right-click on any elements in the dotted area to clear the element style</li>
                                            <li>Right-click on any elements in the dotted area to move the element up or down</li>
                                            <li>Click on the top delete link to delete a widget, row, container or section</li>
                                            <li>Click on the 'Getting the files' button to download the template files</li>
                                        </ul>
                                    </div> 
                                    <div class="col-md-12">
                                        <button class="delete-understand btn btn-success">Close</button>
                                    </div>     	
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
        <div class="row">
            <div class="col-md-12">        
                <div class="pull-right">
                    <form action="<?php echo full_url(); ?>/Administrator/index.php" method="get">
                        <p>
                            <?php 
								$query = $_SERVER['QUERY_STRING'];
								parse_str($query, $output);
								foreach($output as $key => $value){
									echo '<input type="hidden" name="'.$key.'" value="'.$value.'" />';
								}
							?>
                            <select style="display:inline-block; width:auto;" name="template" class="form-control">                            
                                <?php 
                                    $css_folder = "../Plugins/builder/files/cache/"; 
                                    $files = scandir($css_folder);
                                    foreach($files as $file) {
                                        if(strpos($file, '.zip') !== false || $file == '.' || $file == '..'){
                                        
                                        } else {
                                            echo "<option value='" . $file . "'";
                                            if($template == $file) { echo " selected=\"selected\" "; }
                                            echo ">" . $file . "</option>";	
                                        }
                                    }
                                ?>
                            </select>
                            <button class="btn btn-danger getFiles" type="button">Download</button> 
                            <input style="display:inline-block;" type="submit" class="btn btn-danger switch-template" value="Change template" />
                            </p>
                    </form>
                </div>
                <div class="pull-left">
                    <p><button class="btn btn-danger menu-toggle">Options</button> <button class="btn btn-danger grid-disabled">Grid Toggle</button> <button class="btn btn-success saveFiles">Save</button> <button class="btn btn-info use-as-content">Use as content</button></p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">        
                <div class="panel panel-danger">
                    <div class="panel-heading">
                        <h3 class="panel-title"><span class="glyphicon glyphicon-th"></span>Bootstrap widgets</h3>
                    </div>
                    <div class="panel-body">
                        <div class="widgets">
                            <div class="custom">
                                <h3>List Group</h3>
                                <div id='content-item'>
                                    <div class="widget-block list-group-block">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">Abcdef</div>
                                            <div class="panel-body">
                                                <p>Abcdef abcde abcd abc abcd abcdef abcdef abcdefgh abcdefgh abcde. Abcdefg ab abcd abcdefgh abcdefghi abcde abcdef abcdefgh abcde. Abc abc abcde ab ab abcdefg abcdef abc ab abcde. Abcde abc abcde abcd abcde abcdef abcdefghijk.</p>
                                            </div>
                                            <ul class="list-group">
                                                <li class="list-group-item">Abcdefg ab abcd</li>
                                                <li class="list-group-item">Abcdefg ab abcd</li>
                                                <li class="list-group-item">Abcdefg ab abcd</li>
                                                <li class="list-group-item">Abcdefg ab abcd</li>
                                                <li class="list-group-item">Abcdefg ab abcd</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="custom">
                                <h3>Panel Table</h3>
                                <div id='content-item'>
                                    <div class="widget-block panel-table-block">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">Abcdef</div>
                                            <div class="panel-body">
                                                <p>Abcde abcde abcde abc abcde abcdefghijk abcdefghij abcd. Abcdef abcde abcd abc abcd abcdef abcdef abcdefgh abcdefgh abcde. Abcdefg ab abcd abcdefgh abcdefghi abcde abcdef abcdefgh abcde.</p>
                                            </div>
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Abc</th>
                                                        <th>Ab</th>
                                                        <th>Abcd</th>
                                                        <th>Abcdef</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>50</td>
                                                        <td>3</td>
                                                        <td>1</td>
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td>40</td>
                                                        <td>3</td>
                                                        <td>2</td>
                                                    </tr>
                                                    <tr>
                                                        <td>3</td>
                                                        <td>30</td>
                                                        <td>1</td>
                                                        <td>1</td>
                                                    </tr>
                                                    <tr>
                                                        <td>4</td>
                                                        <td>20</td>
                                                        <td>1</td>
                                                        <td>0</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="custom">
                                <h3>List Box</h3>
                                <div id='content-item'>
                                    <div class="widget-block list-heading-block">
                                        <div class="list-group">
                                            <a href="#" class="list-group-item active">
                                                <h4 class="list-group-item-heading">Abcdefg ab</h4>
                                                <p class="list-group-item-text">Abcdefg ab abcd abcdefgh abcdefghi abcde abcdef abcdefgh abcde. Abc abc abcde ab ab abcdefg abcdef abc ab abcde. Abcde abc abcde abcd abcde abcdef abcdefghijk.</p>
                                            </a>
                                        </div>
                                        <div class="list-group">
                                            <a href="#" class="list-group-item">
                                                <h4 class="list-group-item-heading">Abcdefg ab</h4>
                                                <p class="list-group-item-text">Abcdefg ab abcd abcdefgh abcdefghi abcde abcdef abcdefgh abcde. Abc abc abcde ab ab abcdefg abcdef abc ab abcde. Abcde abc abcde abcd abcde abcdef abcdefghijk.</p>
                                            </a>
                                        </div>
                                        <div class="list-group">
                                            <a href="#" class="list-group-item">
                                                <h4 class="list-group-item-heading">Abcdefg ab</h4>
                                                <p class="list-group-item-text">Abcdefg ab abcd abcdefgh abcdefghi abcde abcdef abcdefgh abcde. Abc abc abcde ab ab abcdefg abcdef abc ab abcde. Abcde abc abcde abcd abcde abcdef abcdefghijk.</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="custom">
                                <h3>Breadcrumb</h3>
                                <div id='content-item'>
                                    <div class="widget-block breadcrumb-block">
                                        <ol class="breadcrumb">
                                            <li><a href="#">Abcdefg abc</a></li>
                                            <li><a href="#">Abcdefghijkl</a></li>
                                            <li><a href="#">Abcdefghi</a></li>
                                            <li><a href="#">Abcde</a></li>
                                            <li class="active">Abcdefghijk</li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                            <div class="custom">
                                <h3>Pagination</h3>
                                <div id='content-item'>
                                    <div class="widget-block pagination-block">
                                        <nav aria-label="Page navigation">
                                            <ul class="pagination">
                                                <li>
                                                    <a href="#" aria-label="Previous">
                                                    <span aria-hidden="true">&laquo;</span>
                                                    </a>
                                                </li>
                                                <li><a href="#">1</a></li>
                                                <li><a href="#">2</a></li>
                                                <li><a href="#">3</a></li>
                                                <li><a href="#">4</a></li>
                                                <li><a href="#">5</a></li>
                                                <li>
                                                    <a href="#" aria-label="Next">
                                                    <span aria-hidden="true">&raquo;</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                            <div class="custom">
                                <h3>Nav Fixed</h3>
                                <div id='content-item'>
                                    <div class="widget-block nav-fix-top-block">
                                        <nav class="navbar navbar-default navbar-fixed-top">
                                            <div class="container-fluid">
                                                <!-- Brand and toggle get grouped for better mobile display -->
                                                <div class="navbar-header">
                                                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                                    <span class="sr-only">Toggle navigation</span>
                                                    <span class="icon-bar"></span>
                                                    <span class="icon-bar"></span>
                                                    <span class="icon-bar"></span>
                                                    </button>
                                                    <a class="navbar-brand" href="#">Brand</a>
                                                </div>
                                                <!-- Collect the nav links, forms, and other content for toggling -->
                                                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                                    <ul class="nav navbar-nav">
                                                        <li class="active"><a href="#">Abcdefg abc <span class="sr-only">(current)</span></a></li>
                                                        <li><a href="#">Abcdefg abc</a></li>
                                                        <li class="dropdown">
                                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Abcdefg abc <span class="caret"></span></a>
                                                            <ul class="dropdown-menu">
                                                                <li><a href="#">Abcdefghijkl</a></li>
                                                                <li><a href="#">Abcdefghijkl</a></li>
                                                                <li><a href="#">Abcdefghijkl</a></li>
                                                                <li role="separator" class="divider"></li>
                                                                <li><a href="#">Abcdefghijkl</a></li>
                                                                <li role="separator" class="divider"></li>
                                                                <li><a href="#">Abcdefghijkl</a></li>
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                    <form class="navbar-form navbar-left">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" placeholder="Search">
                                                        </div>
                                                        <button type="submit" class="btn btn-default">Submit</button>
                                                    </form>
                                                    <ul class="nav navbar-nav navbar-right">
                                                        <li><a href="#">Abcdefg abc</a></li>
                                                        <li class="dropdown">
                                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Abcdefg abc <span class="caret"></span></a>
                                                            <ul class="dropdown-menu">
                                                                <li><a href="#">Abcdefghijkl</a></li>
                                                                <li><a href="#">Abcdefghijkl</a></li>
                                                                <li><a href="#">Abcdefghijkl</a></li>
                                                                <li role="separator" class="divider"></li>
                                                                <li><a href="#">Abcdefghijkl</a></li>
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <!-- /.navbar-collapse -->
                                            </div>
                                            <!-- /.container-fluid -->
                                        </nav>
                                    </div>
                                </div>
                            </div>
                            <div class="custom">
                                <h3>Tabs</h3>
                                <div id='content-item'>
                                    <div class="widget-block tabs-dropdown-block">
                                        <ul class="nav nav-tabs">
                                            <li><a href="#">Abcdefgh</a></li>
                                            <li><a href="#">Abcdefgh</a></li>
                                            <li role="presentation" class="dropdown">
                                                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                                Abcdefgh <span class="caret"></span>
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <li><a href="#">Abcdefghijkl</a></li>
                                                    <li><a href="#">Abcdefghijkl</a></li>
                                                    <li><a href="#">Abcdefghijkl</a></li>
                                                    <li><a href="#">Abcdefghijkl</a></li>
                                                    <li><a href="#">Abcdefghijkl</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="#">Abcdefgh</a></li>
                                            <li><a href="#">Abcdefgh</a></li>
                                            <li role="presentation" class="dropdown">
                                                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                                Abcdefgh <span class="caret"></span>
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <li><a href="#">Abcdefghijkl</a></li>
                                                    <li><a href="#">Abcdefghijkl</a></li>
                                                    <li><a href="#">Abcdefghijkl</a></li>
                                                    <li><a href="#">Abcdefghijkl</a></li>
                                                    <li><a href="#">Abcdefghijkl</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="custom">
                                <h3>Nav</h3>
                                <div id='content-item'>
                                    <div class="widget-block nav-pills-block">
                                        <ul class="nav nav-pills nav-stacked">
                                            <li><a href="#">Abcdefghijkl</a></li>
                                            <li><a href="#">Abcdefghijkl</a></li>
                                            <li><a href="#">Abcdefghijkl</a></li>
                                            <li><a href="#">Abcdefghijkl</a></li>
                                            <li><a href="#">Abcdefghijkl</a></li>
                                            <li><a href="#">Abcdefghijkl</a></li>
                                            <li><a href="#">Abcdefghijkl</a></li>
                                            <li><a href="#">Abcdefghijkl</a></li>
                                            <li><a href="#">Abcdefghijkl</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="custom">
                                <h3>Stats</h3>
                                <div id='content-item'>
                                    <div class="widget-block progress-bar-block">
                                        <div class="progress progress-striped">
                                            <div class="progress-bar progress-bar-info" style="width:90%;">HTML (90%)</div>
                                        </div>
                                        <div class="progress progress-striped">
                                            <div class="progress-bar progress-bar-sucsess" style="width:80%;">CSS (90%)</div>
                                        </div>
                                        <div class="progress progress-striped">
                                            <div class="progress-bar progress-bar-warning" style="width:75%;">PHP (85%)</div>
                                        </div>
                                        <div class="progress progress-striped">
                                            <div class="progress-bar progress-bar-danger" style="width:65%;">MySQL (85%)</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="custom">
                                <h3>Timeline</h3>
                                <div id='content-item'>
                                    <div class="widget-block timeline-block">
                                        <div class="row">
                                            <div class="col-md-6 offset-md-3">
                                                <h4>Latest News</h4>
                                                <ul class="timeline">
                                                    <li>
                                                        <a target="_blank" href="#">New Web Design</a>
                                                        <a href="#" class="float-right">21 March, 2014</a>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque scelerisque diam non nisi semper, et elementum lorem ornare. Maecenas placerat facilisis mollis. Duis sagittis ligula in sodales vehicula....</p>
                                                    </li>
                                                    <li>
                                                        <a href="#">21 000 Job Seekers</a>
                                                        <a href="#" class="float-right">4 March, 2014</a>
                                                        <p>Curabitur purus sem, malesuada eu luctus eget, suscipit sed turpis. Nam pellentesque felis vitae justo accumsan, sed semper nisi sollicitudin...</p>
                                                    </li>
                                                    <li>
                                                        <a href="#">Awesome Employers</a>
                                                        <a href="#" class="float-right">1 April, 2014</a>
                                                        <p>Fusce ullamcorper ligula sit amet quam accumsan aliquet. Sed nulla odio, tincidunt vitae nunc vitae, mollis pharetra velit. Sed nec tempor nibh...</p>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="custom">
                                <h3>Zig-zag timeline</h3>
                                <div id='content-item'>
                                    <div class="widget-block zig-zag-timeline-block">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <h3 class="text-center">Zigzag timeline Layout (and Cats)</h3>
                                                <p>
                                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                                </p>
                                                <ul class="timeline-zig-zag">
                                                    <li>
                                                        <div class="timeline-zig-zag-image">
                                                            <img class="img-circle img-responsive" src="http://lorempixel.com/250/250/cats/1" alt="">
                                                        </div>
                                                        <div class="timeline-zig-zag-panel">
                                                            <div class="timeline-zig-zag-heading">
                                                                <h4>Step One</h4>
                                                                <h4 class="subheading">Subtitle</h4>
                                                            </div>
                                                            <div class="timeline-zig-zag-body">
                                                                <p class="text-muted">
                                                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="line"></div>
                                                    </li>
                                                    <li class="timeline-zig-zag-inverted">
                                                        <div class="timeline-zig-zag-image">
                                                            <img class="img-circle img-responsive" src="http://lorempixel.com/250/250/cats/2" alt="">
                                                        </div>
                                                        <div class="timeline-zig-zag-panel">
                                                            <div class="timeline-zig-zag-heading">
                                                                <h4>Step Two</h4>
                                                                <h4 class="subheading">Subtitle</h4>
                                                            </div>
                                                            <div class="timeline-zig-zag-body">
                                                                <p class="text-muted">
                                                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="line"></div>
                                                    </li>
                                                    <li>
                                                        <div class="timeline-zig-zag-image">
                                                            <img class="img-circle img-responsive" src="http://lorempixel.com/250/250/cats/3" alt="">
                                                        </div>
                                                        <div class="timeline-zig-zag-panel">
                                                            <div class="timeline-zig-zag-heading">
                                                                <h4>Step Three</h4>
                                                                <h4 class="subheading">Subtitle</h4>
                                                            </div>
                                                            <div class="timeline-zig-zag-body">
                                                                <p class="text-muted">
                                                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="line"></div>
                                                    </li>
                                                    <li class="timeline-zig-zag-inverted">
                                                        <div class="timeline-zig-zag-image">
                                                            <img class="img-circle img-responsive" src="http://lorempixel.com/250/250/cats/4" alt="">
                                                        </div>
                                                        <div class="timeline-zig-zag-panel">
                                                            <div class="timeline-zig-zag-heading">
                                                                <h4>Step Three</h4>
                                                                <h4 class="subheading">Subtitle</h4>
                                                            </div>
                                                            <div class="timeline-zig-zag-body">
                                                                <p class="text-muted">
                                                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="line"></div>
                                                    </li>
                                                    <li>
                                                        <div class="timeline-zig-zag-image">
                                                            <img class="img-circle img-responsive" src="http://lorempixel.com/250/250/cats/5" alt="">
                                                        </div>
                                                        <div class="timeline-zig-zag-panel">
                                                            <div class="timeline-zig-zag-heading">
                                                                <h4>Bonus Step</h4>
                                                                <h4 class="subheading">Subtitle</h4>
                                                            </div>
                                                            <div class="timeline-zig-zag-body">
                                                                <p class="text-muted">
                                                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="custom">
                                <h3>Table Filter</h3>
                                <div id='content-item'>
                                    <div class="widget-block table-filter-block">
                                        <div class="row easy-table-filter">
                                            <section class="content">
                                                <h1>Table Filter</h1>
                                                <div class="col-md-12">
                                                    <div class="panel panel-default">
                                                        <div class="panel-body">
                                                            <div class="pull-right">
                                                                <div class="btn-group">
                                                                    <button type="button" class="btn btn-success btn-filter" data-target="pagado">Pagado</button>
                                                                    <button type="button" class="btn btn-warning btn-filter" data-target="pendiente">Pendiente</button>
                                                                    <button type="button" class="btn btn-danger btn-filter" data-target="cancelado">Cancelado</button>
                                                                    <button type="button" class="btn btn-default btn-filter" data-target="all">Todos</button>
                                                                </div>
                                                            </div>
                                                            <div class="table-container">
                                                                <table class="table table-filter">
                                                                    <tbody>
                                                                        <tr data-status="pagado">
                                                                            <td>
                                                                                <div class="ckbox">
                                                                                    <input type="checkbox" id="checkbox1">
                                                                                    <label for="checkbox1"></label>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <a href="javascript:;" class="star">
                                                                                <i class="glyphicon glyphicon-star"></i>
                                                                                </a>
                                                                            </td>
                                                                            <td>
                                                                                <div class="media">
                                                                                    <a href="#" class="pull-left">
                                                                                    <img src="https://s3.amazonaws.com/uifaces/faces/twitter/fffabs/128.jpg" class="media-photo">
                                                                                    </a>
                                                                                    <div class="media-body">
                                                                                        <span class="media-meta pull-right">Febrero 13, 2016</span>
                                                                                        <h4 class="title">
                                                                                            Lorem Impsum
                                                                                            <span class="pull-right pagado">(Pagado)</span>
                                                                                        </h4>
                                                                                        <p class="summary">Ut enim ad minim veniam, quis nostrud exercitation...</p>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        <tr data-status="pendiente">
                                                                            <td>
                                                                                <div class="ckbox">
                                                                                    <input type="checkbox" id="checkbox3">
                                                                                    <label for="checkbox3"></label>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <a href="javascript:;" class="star">
                                                                                <i class="glyphicon glyphicon-star"></i>
                                                                                </a>
                                                                            </td>
                                                                            <td>
                                                                                <div class="media">
                                                                                    <a href="#" class="pull-left">
                                                                                    <img src="https://s3.amazonaws.com/uifaces/faces/twitter/fffabs/128.jpg" class="media-photo">
                                                                                    </a>
                                                                                    <div class="media-body">
                                                                                        <span class="media-meta pull-right">Febrero 13, 2016</span>
                                                                                        <h4 class="title">
                                                                                            Lorem Impsum
                                                                                            <span class="pull-right pendiente">(Pendiente)</span>
                                                                                        </h4>
                                                                                        <p class="summary">Ut enim ad minim veniam, quis nostrud exercitation...</p>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        <tr data-status="cancelado">
                                                                            <td>
                                                                                <div class="ckbox">
                                                                                    <input type="checkbox" id="checkbox2">
                                                                                    <label for="checkbox2"></label>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <a href="javascript:;" class="star">
                                                                                <i class="glyphicon glyphicon-star"></i>
                                                                                </a>
                                                                            </td>
                                                                            <td>
                                                                                <div class="media">
                                                                                    <a href="#" class="pull-left">
                                                                                    <img src="https://s3.amazonaws.com/uifaces/faces/twitter/fffabs/128.jpg" class="media-photo">
                                                                                    </a>
                                                                                    <div class="media-body">
                                                                                        <span class="media-meta pull-right">Febrero 13, 2016</span>
                                                                                        <h4 class="title">
                                                                                            Lorem Impsum
                                                                                            <span class="pull-right cancelado">(Cancelado)</span>
                                                                                        </h4>
                                                                                        <p class="summary">Ut enim ad minim veniam, quis nostrud exercitation...</p>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        <tr data-status="pagado" class="selected">
                                                                            <td>
                                                                                <div class="ckbox">
                                                                                    <input type="checkbox" id="checkbox4" checked>
                                                                                    <label for="checkbox4"></label>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <a href="javascript:;" class="star star-checked">
                                                                                <i class="glyphicon glyphicon-star"></i>
                                                                                </a>
                                                                            </td>
                                                                            <td>
                                                                                <div class="media">
                                                                                    <a href="#" class="pull-left">
                                                                                    <img src="https://s3.amazonaws.com/uifaces/faces/twitter/fffabs/128.jpg" class="media-photo">
                                                                                    </a>
                                                                                    <div class="media-body">
                                                                                        <span class="media-meta pull-right">Febrero 13, 2016</span>
                                                                                        <h4 class="title">
                                                                                            Lorem Impsum
                                                                                            <span class="pull-right pagado">(Pagado)</span>
                                                                                        </h4>
                                                                                        <p class="summary">Ut enim ad minim veniam, quis nostrud exercitation...</p>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        <tr data-status="pendiente">
                                                                            <td>
                                                                                <div class="ckbox">
                                                                                    <input type="checkbox" id="checkbox5">
                                                                                    <label for="checkbox5"></label>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <a href="javascript:;" class="star">
                                                                                <i class="glyphicon glyphicon-star"></i>
                                                                                </a>
                                                                            </td>
                                                                            <td>
                                                                                <div class="media">
                                                                                    <a href="#" class="pull-left">
                                                                                    <img src="https://s3.amazonaws.com/uifaces/faces/twitter/fffabs/128.jpg" class="media-photo">
                                                                                    </a>
                                                                                    <div class="media-body">
                                                                                        <span class="media-meta pull-right">Febrero 13, 2016</span>
                                                                                        <h4 class="title">
                                                                                            Lorem Impsum
                                                                                            <span class="pull-right pendiente">(Pendiente)</span>
                                                                                        </h4>
                                                                                        <p class="summary">Ut enim ad minim veniam, quis nostrud exercitation...</p>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="custom">
                                <h3>Login Form</h3>
                                <div id='content-item'>
                                    <div class="widget-block login-form">
                                        <div class="panel panel-default">
                                            <div class="panel-heading clearfix">
                                                <h3 class="panel-title">Login Form</h3>
                                            </div>
                                            <div class="panel-body">
                                                <form role="form">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Email address</label>
                                                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="email">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1">Password</label>
                                                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="password">
                                                    </div>
                                                    <div class="checkbox">
                                                        <label>
                                                        <input type="checkbox"> Remember me
                                                        </label>
                                                    </div>
                                                    <button type="submit" class="btn btn-success">Submit</button>
                                                </form>
                                            </div>
                                            <!--/panel-body-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="custom">
                                <h3>Panel</h3>
                                <div id='content-item'>
                                    <div class="widget-block panel-block">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h3 class="panel-title">Abcde abcde abcde</h3>
                                            </div>
                                            <div class="panel-body">
                                                Abcde abcde abcde abc abcde abcdefghijk abcdefghij abcd. Abcdef abcde abcd abc abcd abcdef abcdef abcdefgh abcdefgh abcde. 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="custom">
                                <h3>Menu</h3>
                                <div id='content-item'>
                                    <div class="widget-block nav-block">
                                        <nav class="navbar navbar-default">
                                            <div class="container-fluid">
                                                <!-- Brand and toggle get grouped for better mobile display -->
                                                <div class="navbar-header">
                                                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                                    <span class="sr-only">Toggle navigation</span>
                                                    <span class="icon-bar"></span>
                                                    <span class="icon-bar"></span>
                                                    <span class="icon-bar"></span>
                                                    </button>
                                                    <a class="navbar-brand" href="#">Brand</a>
                                                </div>
                                                <!-- Collect the nav links, forms, and other content for toggling -->
                                                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                                    <ul class="nav navbar-nav">
                                                        <li class="active"><a href="#">Abcde abc abcde <span class="sr-only">(current)</span></a></li>
                                                        <li><a href="#">Link</a></li>
                                                        <li class="dropdown">
                                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Abcde abc abcde <span class="caret"></span></a>
                                                            <ul class="dropdown-menu">
                                                                <li><a href="#">Abcdefghijkl</a></li>
                                                                <li><a href="#">Abcdefghijkl</a></li>
                                                                <li><a href="#">Abcdefghijkl</a></li>
                                                                <li role="separator" class="divider"></li>
                                                                <li><a href="#">Abcdefghijkl</a></li>
                                                                <li role="separator" class="divider"></li>
                                                                <li><a href="#">Abcdefghijkl</a></li>
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                    <form class="navbar-form navbar-left">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" placeholder="Search">
                                                        </div>
                                                        <button type="submit" class="btn btn-default">Submit</button>
                                                    </form>
                                                    <ul class="nav navbar-nav navbar-right">
                                                        <li><a href="#">Abcde abc abcde</a></li>
                                                        <li class="dropdown">
                                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Abcde abc abcde <span class="caret"></span></a>
                                                            <ul class="dropdown-menu">
                                                                <li><a href="#">Abcdefghijkl</a></li>
                                                                <li><a href="#">Abcdefghijkl</a></li>
                                                                <li><a href="#">Abcdefghijkl</a></li>
                                                                <li role="separator" class="divider"></li>
                                                                <li><a href="#">Abcdefghijkl</a></li>
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <!-- /.navbar-collapse -->
                                            </div>
                                            <!-- /.container-fluid -->
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>            	
            </div>
        </div>
        <iframe src="../Plugins/builder/files/project/index.php" frameborder="0" width="100%" id="content" class="content"></iframe>
    </div>
</div>
<div id="popup" class="modal fade" title="Upload a file" style="display:none; z-index: 9999 !important;">
    <div class="modal-dialog" role="document" style="z-index: 9999 !important;">
        <div class="modal-content">
            <div class="modal-body">
                <iframe src="<?php echo full_url(); ?>/Plugins/builder/files/mediamanager.php" frameborder="0" width="100%" height="550"></iframe>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="../Plugins/builder/files/js/custom.js"></script>
<div class="container-fluid" style="display:none;">
<form>
<div class="row">
<div class="col-md-6">
<table>
<tr>
<td>
<?php } ?>