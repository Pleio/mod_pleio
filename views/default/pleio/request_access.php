<?php
elgg_load_css('elgg.walled_garden');
elgg_load_js('elgg.walled_garden');

/**
 * Walled garden login
 */

$title = elgg_get_site_entity()->name;
$welcome = elgg_echo('walled_garden:welcome');
$welcome .= ': <br/>' . $title;

$menu = elgg_view_menu('walled_garden', array(
    'sort_by' => 'priority',
    'class' => 'elgg-menu-general elgg-menu-hz',
));
?>
<div class="elgg-col elgg-col-1of2">
    <div class="elgg-inner">
        <h1 class="elgg-heading-walledgarden">
            <?php echo $welcome; ?>
        </h1>
        <?php echo $menu; ?>
    </div>
</div>
<div class="elgg-col elgg-col-1of2">
    <div class="elgg-inner">
        <h2><?php echo elgg_echo("pleio:request_access"); ?></h2>
        <p><?php echo elgg_echo("pleio:request_access:description"); ?></p>
        <?php echo elgg_view_form("pleio/request_access"); ?>
    </div>
</div>
