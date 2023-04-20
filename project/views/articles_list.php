<h1>
    This is articles view rendered
</h1>

<p>
    asdasdas sdasdasd
</p>

<div>
    <p>In case if you want to write something</p>
    <form method="post" action="/articles_list">
        <textarea type="text" name="content" id="" cols="40" rows="10"></textarea>
        <input type="submit" value="send" class="button">
    </form>
    <?php if (!empty($errors['article'])) : ?>
    <div>
        <?php echo($errors['article']); ?>
    </div>
    <?php endif; ?>
</div>