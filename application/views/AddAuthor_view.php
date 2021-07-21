
<div class="container border border-3 border-light rounded-3 py-3 my-3">
    <?php
    if(isset($data['action'])){
        echo '
    <form method="post" action="/addAuthor/addRel">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Имя</label>
            <input name="name" type="text" class="form-control">
            <input hidden name="book_id" type="text" class="form-control" value='.$data['book_id'].'>
                <button type="submit" class="btn btn-primary">Добавить автора</button>'.
            '<button type="submit" role="button" class="btn"><a href="/" class="page-link">Вернуться на главную</a></button>
    </form>';
    } else {
        echo '<form method="post" action="/addAuthor/add">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Имя</label>
            <input name="name" type="text" class="form-control">
         <button type="submit" class="btn btn-primary">Добавить</button>
        <button type="submit" role="button" class="btn"><a href="/" class="page-link">Вернуться на главную</a></button>
    </form>';
    }
    ?>
        <div style="width: 100%;" class="mx-auto">
            <h2 class="text-center text-white bg-success">
                <?php if(!empty($data['authorName'])){echo 'Автор по имени ' . $data['authorName'] . ' успешно добавлен';}?>
            </h2>
        </div>
        <div style="width: 100%;" class="mx-auto">
            <h2 class="text-center bg-danger">
                <?php if(isset($data['Errors']['authorNameError'])){echo $data['Errors']['authorNameError'];}?>
            </h2>
        </div>
</div>

