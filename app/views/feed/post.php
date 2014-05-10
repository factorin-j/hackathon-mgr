<div class="row">
    <div class="span11">
        <a href="<?php eh(url('main/home', array('rank' => '1'))) ?>" title="Show High Rate Feeds" class="btn btn-primary">View High Rank Feeds</a>
        <a href="<?php eh(url('main/home')) ?>" title="Post a message!" class="btn btn-primary">Home</a>
    </div>
    <div class="span1">
        <a href="<?php eh(url('main/logout')) ?>" title="Wanna Quit?" class="btn btn-primary">Logout</a>
    </div>
</div>

<hr />

<div class="row">
<div class="span12">
<?php if (isset($feed)) : ?>
Message has been posted
<?php endif ?>

<form method="post" action="<?php eh(url('feed/post')) ?>" enctype="multipart/form-data" class="form-horizontal">
    <div class="control-group">
        <label class="control-label" for="input-message">Message</label>
        <div class="controls">
            <textarea id="input-message" name="message" rows="5"></textarea>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="input-picture">Picture</label>
        <div class="controls">
            <input type="file" id="input-picture" name="picture" />
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="input-location">Location</label>
        <div class="controls">
            <input type="text" id="input-location" name="location" value="" />
        </div>
    </div>
    <div class="control-group">
        <div class="controls">
            <input type="submit" name="post" value="Post" class="btn btn-primary" />
        </div>
    </div>
    <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
</form>
</div>
</div>

<hr />

<div class="row">
    <div class="span12">
        <a href="<?php eh(url('main/home', array('rank' => '1'))) ?>" title="Show High Rate Feeds" class="btn btn-primary">View High Rank Feeds</a>
        <a href="<?php eh(url('main/home')) ?>" title="Post a message!" class="btn btn-primary">Home</a>
    </div>
</div>

<div class="clearfix">&nbsp;</div>