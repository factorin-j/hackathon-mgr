<div class="row-fluid">
    <div class="container-fluid">
        <div class="span4 well">
            <?php if (!$list): ?>
                <span>No inquiry has been sent for now</span>
            <?php else: ?>
                <?php foreach ($list as $inq): ?>
                    <a href="/inquiry/index?id=<?php echo $inq['id'] ?>">
                        InquiryID #<?php echo $inq['id'] ?> :
                        <?php echo (strlen($inq['message']) > 13) ? substr($inq['message'], 0, 10) . '...' : $inq['message']; ?>
                    </a><br/>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <div class="span8">
            <?php if (!$inquiry): ?>
                <div class="alert alert-info">Please select an inquiry to view.</div>
            <?php else: ?>
                <pre><?php echo $inquiry['message'] ?></pre>
                <form action="/inquiry/reply" method="post">
                    <input type="hidden" value="<?php echo $inquiry['id'] ?>" name="id">
                    <textarea name="reply" rows="10"></textarea><br>
                    <button class="btn btn-primary" type="submit">Reply</button>
                </form>
            <?php endif; ?>
        </div>

    </div>
</div>
