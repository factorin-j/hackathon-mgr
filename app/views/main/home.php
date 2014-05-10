<div class="row">
    <div class="span11">
    <?php if ($is_rank) : ?>
        <a href="<?php eh(url('main/home', array('rank' => '0'))) ?>" title="Show New Feeds" class="btn btn-primary">View New Feeds</a>
    <?php else : ?>
        <a href="<?php eh(url('main/home', array('rank' => '1'))) ?>" title="Show High Rate Feeds" class="btn btn-primary">View High Rank Feeds</a>
    <?php endif ?>

        <a href="<?php eh(url('feed/post')) ?>" title="Post a message!" class="btn btn-primary">Post</a>
    </div>
    <div class="span1">
        <a href="<?php eh(url('main/logout')) ?>" title="Wanna Quit?" class="btn btn-primary">Logout</a>
    </div>
</div>

<div class="clearfix">&nbsp;</div>

<div class="row">
    <?php if ($is_rank) : ?>
        <div class="span12"><strong>Viewing Message By Rating</strong></div>
    <?php else : ?>
        <div class="span12"><strong>Viewing Message By Latest Date</strong></div>
    <?php endif ?>
</div>

<table class="table table-striped table-bordered">
<thead>
<tr>
    <td>Message</td>
    <td>Image</td>
    <td>Location</td>
    <td>Score</td>
    <td>Date</td>
    <td></td>
    <td></td>
    <td></td>
</tr>
</thead>
<tbody>
<?php foreach ($feeds as $feed) : ?>
<tr>
    <td><?php eh($feed->message) ?></td>
    <td><img src="<?php eh($feed->picture) ?>" alt="user-image" /></td>
    <td><?php eh($feed->location) ?></td>
    <td><?php eh($feed->score) ?></td>
    <td><?php eh($feed->created) ?></td>
    <td><button type="button" data-id="<?php eh($feed->id) ?>" class="btn btn-small feed-up"><i class="icon-arrow-up"></i></button></td>
    <td><button type="button" data-id="<?php eh($feed->id) ?>" class="btn btn-small feed-down"><i class="icon-arrow-down"></i></button></td>
    <td><button type="button" data-id="<?php eh($feed->id) ?>" class="btn btn-small feed-block"><i class="icon-remove-circle"></i></button></td>
</tr>
<?php endforeach ?>
</tbody>
</table>

<div class="row">
    <div class="span12">
        <?php if ($is_rank) : ?>
            <a href="<?php eh(url('main/home', array('rank' => '0'))) ?>" title="Show New Feeds" class="btn btn-primary">View New Feeds</a>
        <?php else : ?>
            <a href="<?php eh(url('main/home', array('rank' => '1'))) ?>" title="Show High Rank Feeds" class="btn btn-primary">View High Rank Feeds</a>
        <?php endif ?>

        <a href="<?php eh(url('feed/post')) ?>" title="Post a message!" class="btn btn-primary">Post</a>
    </div>
</div>

<div class="clearfix">&nbsp;</div>

<script type="text/javascript" language="javascript" src="/js/jquery.home.js"></script>
