
<div class="container border border-3 border-light rounded-3 py-3 my-3">
    <form method="post" action="/addBook/add">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Название</label>
            <input type="text" class="form-control" name="bookName">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Автор</label>
            <input type="text" class="form-control" name="authorName">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Жанр</label>
            <input type="text" class="form-control" name="genre">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Дата выпуска</label>
            <input type="text"  class="form-control  date_mask" name="public_date">
        </div>
        <button type="submit" class="btn btn-primary">Добавить</button>
        <button role="button" class="btn"><a href="/" class="page-link">Вернуться на главную</a></button>
    </form>
</div>
<script>
    $(".date_mask").mask("9999-99-99");
</script>
<div class="bg-danger"><?php print_r($data['authorError']);?></div>
<div class="bg-danger"><?php print_r($data['bookError']);?></div>
