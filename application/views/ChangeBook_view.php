<div class="container border border-3 border-light rounded-3 py-3 my-3">
    <form method="post" action="/changeBook/change?book=<?php echo $data['id'];?>">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Название</label>
            <input required type="text" class="form-control" name="bookName" value="<?php echo $data['book_name'];?>">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Жанр</label>
            <input required type="text" class="form-control" name="genre" value="<?php echo $data['genre'];?>">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Дата выпуска</label>
            <input required type="text" id="date_mask" placeholder="гггг-мм-дд" class="form-control  date_mask" name="public_date" value="<?php echo $data['public_date'];?>">
        </div>
        <div class="mb-3">
            <input type="text" style="display: none;" class="form-control" name="rel_id" value="<?php echo $data['rel_id'];?>">
        </div>
        <?php $data['names'] = explode(',', $data['name']); foreach ($data['names'] as $key => $value) {?>
            <? echo '<div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Автор</label>
            <input type="text" class="form-control" name="authorName[]"
                   value="'. $value.'"></div>' ?>
        <?php };?>
        <button type="submit" class="btn btn-primary">Добавить</button>
        <button role="button" class="btn"><a href="/" class="page-link">Вернуться на главную</a></button>
    </form>
    <h3 class="bg-danger"><?php if(isset($data['Error'])){echo $data['Error'];};?></h3>
</div>
<script>
    $(".date_mask").mask("9999-99-99");
</script>