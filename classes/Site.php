<?php 
class Site {
    public $title;
    public $meta;
    public $css;
    public $cssIe6;
    public $js;
    public $jsIe6;
    public $content;
    public $module;
    public $mainNav;
    public $activePage;
    public $breadCrumb;
    public $conn;
    public $uniquePageId;
    public $models_min;
    public $blog;

    function __construct($conn,$task,$view,$action,$option,$modelId,$subView='',$models_min='',$blog='') {
        $this->models_min = $models_min;
        $this->blog = $blog;
        $breadCrumb = '<a href="/">Home</a>';
        $this->uniquePageId = $view;
        switch ($task) {
            case 'browse':
                switch ($view) {
                    case 'model':
                        $model = new Model();
                        $model->getModel($conn,$modelId);
                        $this->uniquePageId .= $model->titleClean;
                        $breadCrumb .= ' &raquo; <a href="digital-audio-workstation-computer-comparison">Computer Models</a>';
                        $breadCrumb .= ' &raquo; <a href="' . $modelId . '-' . $model->titleClean . '-' . $model->shortDescClean . '">' . $model->title . '</a>';
                        break;
                    case 'models':
                        $breadCrumb .= ' &raquo; <a href="/daw/digital-audio-workstation-computer-comparison">Computer Models</a>';
                        break;
                    case 'about':
                    case 'support':
                        $this->uniquePageId .= '-' . $subView;
                        $breadCrumb .= ' &raquo; <a href="/'.$view.'/' . $subView . '">'. $view  .'</a>';
                        $breadCrumb .= ' &raquo; <a href="/'.$view.'/' . $subView . '">' . str_replace('-', ' ',$subView) . '</a>';
                        break;

                    case 'login':
                        break;
                }
                $this->breadCrumb = $breadCrumb;
        }
    }

    function addCss($css) {

        $this->css[] = '<link rel="stylesheet" type="text/css" href="' . $css . '" />';
    }
    function addCssIe6($css) {
        $this->cssIe6 = $css;
    }
    function addJs($js) {
        $this->js[] = '<script type="text/javascript" src="' . $js . '"></script>';
    }
    function addJsIe6($jsIe6) {
        $this->jsIe6[] = '<!--[if IE 6]><script type="text/javascript" src=" ' . $jsIe6 . '"></script><![endif]-->';
//<!--[if IE 6]><script type="text/javascript" src="js/stickyfloatie6.js"></script><![endif]-->	
    }
    function setContent($content) {
        $this->content = $content;
    }

    function setTitle($title) {
        $this->title = $title;
    }
    
    function addBreadCrumb($breadCrumb) {        
        $this->breadCrumb .= $breadCrumb;
    }

    function addToTitle($title) {
        $this->title .= '' . $title;
    }

    function addToMeta($meta) {
        $this->meta = $meta;
    }

    function output() {
        ob_start();
        $blog = $this->blog;
        $models_min = $this->models_min;
        require_once('html/nav.html.php');
        require_once('html/subnav.html.php');
        $this->mainNav = ob_get_contents();
        ob_end_clean();
        require_once('html/site-structure.html.php');
    }

    function setActivePage($activePage) {
        $this->activePage = $activePage;
    }
    
}
?>