<div class="container border border-3 border-light rounded-3 py-3 my-3">
<form method="post" action="/addAuthor/add">
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Имя</label>
        <input name="authorName" type="text" class="form-control">
        <button type="submit" class="btn btn-primary">Добавить</button>
        <button type="submit" role="button" class="btn"><a href="/" class="page-link">Вернуться на главную</a></button>
</form>
    <div style="width: 100%;" class="mx-auto">
        <h2 class="text-center text-white bg-success">
            <?php echo $form->authorName; ?>
            <?php if(strlen($form->authorName) > 0){echo 'Автор по имени ' . $form->authorName . ' успешно добавлен';}?>
        </h2>
    </div>
    <div style="width: 100%;" class="mx-auto">
        <h2 class="text-center bg-danger">
            <?php if(isset($error)){echo $error;}?>
        </h2>
    </div>
</div>