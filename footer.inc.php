        </div>
    </div>

    <div id="footer-columns">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="footer-column"> <!-- footer column One -->
                            <h3> About  </h3>
                            <p> Welcome to the FID Customer Relationship Information Management System</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="footer-column"> <!-- footer column Two -->
                            <h3> Important Links </h3>
                            <ul>
                                <li><a href="https://www.cput.ac.za/academic/faculties/informaticsdesign/departments">CPUT Faculty of Informatics and Design</a></li>
                                <li><a href="https://www.cput.ac.za/academic/faculties/informaticsdesign/prospectus">Course Information and Fees</a></li>
				<li><a href="https://www.cput.ac.za/academic/faculties/informaticsdesign/postgraduate">Postgraduate qualifications in Informatics & Design</a></li>
				<li><a href="https://www.cput.ac.za/academic/faculties/informaticsdesign/research">Research</a></li>



                            </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="footer-column"> <!-- footer column Three -->
                            <h3> Contact us </h3>
                            <p> Cape Peninsula University of Technology<br>
                                Faculty of Informatics and Design<br>
                                Second floor
                                <br />
                              Admin Building
                              <br />
                              Cape Town Campus
                              <br />
                              Keizergracht Street
                              <br />
                              Cape Town
                              </p>
                            <p>  <i class="icon-phone-sign"></i>   +27 21 460 9010
 <br>
                                 <i class="icon-envelope"></i> vukuzane@cput.ac.za </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p>Copyright &copy; <?php echo date('Y'); ?> <?php echo (string) $ost->company ?: 'osTicket.com'; ?> - All rights reserved.</p>
                    <a id="poweredBy" href="https://waldonhendricks.github.io/devportfolio/" target="_blank"><?php echo __('CRIMS - Developed by Waldon Hendricks'); ?></a>
                </div>
            </div>
        </div>

    </div>
<div id="overlay"></div>
<div id="loading">
    <h4><?php echo __('Please Wait!');?></h4>
    <p><?php echo __('Please wait... it will take a second!');?></p>
</div>
<?php
if (($lang = Internationalization::getCurrentLanguage()) && $lang != 'en_US') { ?>
    <script type="text/javascript" src="ajax.php/i18n/<?php
        echo $lang; ?>/js"></script>
<?php } ?>
<script type="text/javascript">
    getConfig().resolve(<?php
        include INCLUDE_DIR . 'ajax.config.php';
        $api = new ConfigAjaxAPI();
        print $api->client(false);
    ?>);
</script>

<script>var LHC_API = LHC_API||{};
LHC_API.args = {mode:'widget',lhc_base_url:'//chat.kamikazeinnovations.co.za/lhc_web/index.php/',wheight:450,wwidth:350,pheight:520,pwidth:500,leaveamessage:true,check_messages:false};
(function() {
var po = document.createElement('script'); po.type = 'text/javascript'; po.setAttribute('crossorigin','anonymous'); po.async = true;
var date = new Date();po.src = '//chat.kamikazeinnovations.co.za/lhc_web/design/defaulttheme/js/widgetv2/index.js?'+(""+date.getFullYear() + date.getMonth() + date.getDate());
var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
})();
</script>


</body>
</html>
