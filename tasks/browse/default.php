<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/Model.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/PartType.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/SubType.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/Part.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/Blog.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/lists.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/misc.php';

$models = getModelList($conn);

foreach ($models as $model) {
    $models_min[$model->id]['discount'] = $model->discount;
    $models_min[$model->id]['base_price_html'] = $model->getBasePriceHtml($conn);
    $models_min[$model->id]['id'] = $model->id;
    $models_min[$model->id]['title'] = $model->title;
    $models_min[$model->id]['short_desc'] = $model->shortDesc;
    $models_min[$model->id]['long_desc'] = $model->longDesc;
}

$model = new Model();
$partType = new PartType();
$subType = new SubType();
$part = new Part();

$blog = new Blog();
$blog->getLatestBlogPosts();

if ($sub_site != 'blog') {

    // SET UP MAIN SITE OBJECT //
    require_once 'classes/Site.php';
    $site = new Site($conn, $task, $view, $action, $option, $modelId, $subView, $models_min, $blog);

    switch ($view) {
        case 'about':
            include 'tasks/browse/views/about.php';
            break;
        case 'support':
            include 'tasks/browse/views/support.php';
            break;
        case 'models':
            include 'tasks/browse/views/models.php';
            break;
        case 'model':
            include 'tasks/browse/views/model.php';
            break;
        case 'computer':
            include 'tasks/browse/views/computer.php';
            break;
        case 'studio-gear':
            include 'tasks/browse/views/studio_gear.php';
            break;
        case 'part':
            include 'tasks/browse/views/part.php';
            break;
        default:
            include 'tasks/browse/views/default.php';
    }

    $site->output();
}