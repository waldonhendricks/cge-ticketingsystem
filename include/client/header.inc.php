<?php
$title=($cfg && is_object($cfg) && $cfg->getTitle())
    ? $cfg->getTitle() : 'osTicket :: '.__('Support Ticket System');
$signin_url = ROOT_PATH . "login.php"
    . ($thisclient ? "?e=".urlencode($thisclient->getEmail()) : "");
$signout_url = ROOT_PATH . "logout.php?auth=".$ost->getLinkToken();

header("Content-Type: text/html; charset=UTF-8");
header("X-Frame-Options: SAMEORIGIN");
if (($lang = Internationalization::getCurrentLanguage())) {
    $langs = array_unique(array($lang, $cfg->getPrimaryLanguage()));
    $langs = Internationalization::rfc1766($langs);
    header("Content-Language: ".implode(', ', $langs));
}
?>
<!DOCTYPE html>
<html<?php
if ($lang
        && ($info = Internationalization::getLanguageInfo($lang))
        && (@$info['direction'] == 'rtl'))
    echo ' dir="rtl" class="rtl"';
if ($lang) {
    echo ' lang="' . $lang . '"';
}
?>>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?php echo Format::htmlchars($title); ?></title>
    <meta name="description" content="customer support platform">
    <meta name="keywords" content="osTicket, Customer support system, support ticket system">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="<?php echo ROOT_PATH; ?>css/osticket.css?7b1eee8" media="screen"/>

    <link href="//fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo ASSETS_PATH; ?>css/bootstrap.css" media="screen">

    <link rel="stylesheet" href="<?php echo ASSETS_PATH; ?>css/theme.css?7b1eee8" media="screen"/>
    <link rel="stylesheet" href="<?php echo ASSETS_PATH; ?>css/print.css?7b1eee8" media="print"/>
    <link rel="stylesheet" href="<?php echo ROOT_PATH; ?>scp/css/typeahead.css?7b1eee8"
         media="screen" />
    <link type="text/css" href="<?php echo ROOT_PATH; ?>css/ui-lightness/jquery-ui-1.10.3.custom.min.css?7b1eee8"
        rel="stylesheet" media="screen" />
    <link rel="stylesheet" href="<?php echo ROOT_PATH; ?>css/thread.css?7b1eee8" media="screen"/>
    <link rel="stylesheet" href="<?php echo ROOT_PATH; ?>css/redactor.css?7b1eee8" media="screen"/>
    <link type="text/css" rel="stylesheet" href="<?php echo ROOT_PATH; ?>css/font-awesome.min.css?7b1eee8"/>
    <link type="text/css" rel="stylesheet" href="<?php echo ROOT_PATH; ?>css/flags.css?7b1eee8"/>
    <link type="text/css" rel="stylesheet" href="<?php echo ROOT_PATH; ?>css/rtl.css?7b1eee8"/>
    <link type="text/css" rel="stylesheet" href="<?php echo ROOT_PATH; ?>css/select2.min.css?7b1eee8"/>
    <!-- Favicons -->
    <link rel="icon" type="image/png" href="<?php echo ROOT_PATH ?>images/oscar-favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="<?php echo ROOT_PATH ?>images/oscar-favicon-16x16.png" sizes="16x16" />
    <script type="text/javascript" src="<?php echo ROOT_PATH; ?>js/jquery-3.3.1.min.js?7b1eee8"></script>
    <script type="text/javascript" src="<?php echo ROOT_PATH; ?>js/jquery-ui-1.12.1.custom.min.js?7b1eee8"></script>
    <script src="<?php echo ROOT_PATH; ?>js/osticket.js?7b1eee8"></script>
    <script type="text/javascript" src="<?php echo ROOT_PATH; ?>js/filedrop.field.js?7b1eee8"></script>
    <script src="<?php echo ROOT_PATH; ?>scp/js/bootstrap-typeahead.js?7b1eee8"></script>
    <script type="text/javascript" src="<?php echo ROOT_PATH; ?>js/redactor.min.js?7b1eee8"></script>
    <script type="text/javascript" src="<?php echo ROOT_PATH; ?>js/redactor-plugins.js?7b1eee8"></script>
    <script type="text/javascript" src="<?php echo ROOT_PATH; ?>js/redactor-osticket.js?7b1eee8"></script>
    <script type="text/javascript" src="<?php echo ROOT_PATH; ?>js/select2.min.js?7b1eee8"></script>
    <script type="text/javascript" src="<?php echo ROOT_PATH; ?>js/fabric.min.js?7b1eee8"></script>

    <script type="text/javascript" src="<?php echo ASSETS_PATH; ?>js/tinynav.js?19292ad"></script>
    <script type="text/javascript" src="<?php echo ASSETS_PATH; ?>js/bootstrap.js?19292ad"></script>

    <?php
    if($ost && ($headers=$ost->getExtraHeaders())) {
        echo "\n\t".implode("\n\t", $headers)."\n";
    }

    // Offer alternate links for search engines
    // @see https://support.google.com/webmasters/answer/189077?hl=en
    if (($all_langs = Internationalization::getConfiguredSystemLanguages())
        && (count($all_langs) > 1)
    ) {
        $langs = Internationalization::rfc1766(array_keys($all_langs));
        $qs = array();
        parse_str($_SERVER['QUERY_STRING'], $qs);
        foreach ($langs as $L) {
            $qs['lang'] = $L; ?>
        <link rel="alternate" href="//<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>?<?php
            echo http_build_query($qs); ?>" hreflang="<?php echo $L; ?>" />
<?php
        } ?>
        <link rel="alternate" href="//<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>"
            hreflang="x-default" />
<?php
    }
    ?>
</head>
<body>
    <div id="container" class="paris">
        <div class="topbar">
            <div class="container"> <div class="row">
                <div class="col-md-6">
                    <div class="lang-pack">
                        <?php
                        if (($all_langs = Internationalization::getConfiguredSystemLanguages())
                            && (count($all_langs) > 1)
                        ) {
                            $qs = array();
                            parse_str($_SERVER['QUERY_STRING'], $qs);
                            foreach ($all_langs as $code=>$info) {
                                list($lang, $locale) = explode('_', $code);
                                $qs['lang'] = $code;
                        ?>
                        <a class="flag flag-<?php echo strtolower($info['flag'] ?: $locale ?: $lang); ?>"
            href="?<?php echo http_build_query($qs);
            ?>" title="<?php echo Internationalization::getLanguageDescription($code); ?>">&nbsp;</a>
                        <?php }
                        } ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="user-data">
                        <?php
                           if ($thisclient && is_object($thisclient) && $thisclient->isValid()
                               && !$thisclient->isGuest()) {
                            echo Format::htmlchars($thisclient->getName()).'&nbsp;|';
                            ?>
                           <a href="<?php echo ROOT_PATH; ?>profile.php"><?php echo __('Profile'); ?></a> |
                           <a href="<?php echo ROOT_PATH; ?>tickets.php"><?php echo sprintf(__('Tickets <b>(%d)</b>'), $thisclient->getNumTickets()); ?></a> -
                           <a href="<?php echo $signout_url; ?>"><?php echo __('Sign Out'); ?></a>
                       <?php
                       } elseif($nav) {
                           if ($cfg->getClientRegistrationMode() == 'public') { ?>
                               <?php echo __('Guest User'); ?> | <?php
                           }
                           if ($thisclient && $thisclient->isValid() && $thisclient->isGuest()) { ?>
                               <a href="<?php echo $signout_url; ?>"><?php echo __('Sign Out'); ?></a><?php
                           }
                           elseif ($cfg->getClientRegistrationMode() != 'disabled') { ?>
                               <a href="<?php echo $signin_url; ?>"><?php echo __('Sign In'); ?></a>
           <?php
                           }
                       } ?>
                    </div>
                </div>
            </div></div>
        </div>

        <div id="header">
            <div class="container"> <div class="row">
                <div class="col-md-4">
                    <a id="logo" href="<?php echo ROOT_PATH; ?>index.php"
                    title="<?php echo __('Support Center'); ?>">
                    <span class="valign-helper"></span>
                    <img src="<?php echo ROOT_PATH; ?>logo.php" border=0 alt="<?php
                    echo $ost->getConfig()->getTitle(); ?>">
                    </a>
                </div>

                <div class="col-md-8">
                    <?php
                    if($nav){ ?>
                    <ul id="nav" class="flush-left">
                        <?php
                        if($nav && ($navs=$nav->getNavLinks()) && is_array($navs)){
                            foreach($navs as $name =>$nav) {
                                echo sprintf('<li><a class="%s %s" href="%s">%s</a></li>%s',$nav['active']?'active':'',$name,(ROOT_PATH.$nav['href']),$nav['desc'],"\n");
                            }
                        } ?>
                    </ul>
                    <?php
                    }else{ ?>
                    
                    <?php
                    } ?>
                </div>
                <script>
                  $(function () {
                    $("#nav").tinyNav({
                        header: 'Navigation'
                    });
                  });
                </script>
            </div></div>

        </div>

        <div class="clear"></div>
        <div id="content">

         <?php if($errors['err']) { ?>
            <div id="msg_error"><?php echo $errors['err']; ?></div>
         <?php }elseif($msg) { ?>
            <div id="msg_notice"><?php echo $msg; ?></div>
         <?php }elseif($warn) { ?>
            <div id="msg_warning"><?php echo $warn; ?></div>
         <?php } ?>
