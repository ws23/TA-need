	<!-- Fixed navbar -->
            <nav class="navbar navbar-inverse navbar-fixed-top">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="index.php">國立東華大學 通識教育中心 104-1學期教學助理申請表(教師用)</a>
                    </div>
                    <div id="navbar" class="navbar-collapse collapse">
                        <ul class="nav navbar-nav navbar-right">
							<?php if(isset($_SESSION['stuID'])){ 	?>
							<li><a href="<?php echo $URLPv; ?>logout.php">離開</a></li>
							<?php } ?>
                        </ul>
                    </div><!--/.nav-collapse -->
                </div>
            </nav>

    <!-- Fixed navbar -->

