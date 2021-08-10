
<div class="container border border-3 border-light rounded-3 py-3 my-3">
    <?php echo '
    <form method="post" action="/addAuthor/addRel">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Имя</label>
            <input name="authorName" type="text" class="form-control">
            <input hidden name="book_id" type="text" class="form-control" value='.$data.'>
                <button type="submit" class="btn btn-primary">Добавить автора</button>'.
            '<button type="submit" role="button" class="btn"><a href="/" class="page-link">Вернуться на главную</a></button>
    </form>';
    ?>
        <div style="width: 100%;" class="mx-auto">
            <h2 class="text-center text-white bg-success">
                <?php if(strlen($form->authorName)>0){echo 'Автор по имени ' . $form->authorName . ' успешно добавлен';}?>
            </h2>
        </div>
        <div style="width: 100%;" class="mx-auto">
            <h2 class="text-center bg-danger">
                <?php if(isset($error)){echo $error;}?>
            </h2>
        </div>
</div>

