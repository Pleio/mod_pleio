<?php
$site = elgg_get_site_entity();

$welcome = elgg_echo("pleio:walled_garden", [$site->name]);

$menu = elgg_view_menu('walled_garden', array(
    'sort_by' => 'priority',
    'class' => 'elgg-menu-general elgg-menu-hz',
));

$login_box = elgg_view('core/account/login_box', array(
    "module" => "walledgarden-login",
    "description" => elgg_echo("pleio:walled_garden_description")
));

echo <<<HTML
<div class="elgg-col elgg-col-1of2">
    <div class="elgg-inner">
        <h1 class="elgg-heading-walledgarden">
            $welcome
        </h1>
        $menu
    </div>
</div>
<div class="elgg-col elgg-col-1of2">
    <div class="elgg-inner">
        $login_box
    </div>
</div>
HTML;
