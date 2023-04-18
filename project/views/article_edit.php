<h1>
    <!-- Пример использования переменной шаблона $slug -->
    Edit article <?php echo !empty($slug) ? $slug : ''; ?>
</h1>

<div>
    <form method="post">
        <label>
            <p>Header:</p>
            <input type="text" name="articleHeader">
        </label>
        <label>
            <p>Content:</p>
            <textarea name="articleContent"></textarea>
        </label>
    </form>
</div>
