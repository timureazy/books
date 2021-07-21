<div class="d-flex ">
    <input id="input-genre" type="text" class="form-control" placeholder="Фильтр по жанру" onkeyup="genreFilter()">
    <input id="input-author" type="text" class="form-control" placeholder="Фильтр по автору" onkeyup="authorFilter()">
    <input id="input-date" type="text" class="form-control" placeholder="Фильтр по дате" onkeyup="dateFilter()">
</div>
<div class="d-flex align-items-center justify-content-center">
<table class="table table-info table-striped" id="table">
    <thead class="table-dark">
    <tr>
        <th class="text-center"scope="col">Редактирование</th>
        <th scope="col" class="sort" style="cursor: pointer;">Книга</th>
        <th scope="col" class="sort" style="cursor: pointer;">Дата Выпуска</th>
        <th scope="col">Жанр</th>
        <th scope="col">Авторство</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($data['items'] as $value){ ?>
    <tr>
        <td>
            <div class="d-flex justify-content-center">
                <div class="me-2">
                    <?php echo '<a role="button" class="btn btn-success" href='.'/changeBook?book='. $value["rel_id"].'>Изменить</a>' ?>
                </div>
                <div class="me-2">
                    <?php echo '<a role="button" class="btn btn-success" href='.'/addAuthor/addAnother?book='. $value["rel_id"].'>Добавить Автора</a>' ?>
                </div>
            </div>
        </td>
        <td><?php echo $value["book_name"] ?></td>
        <td><?php echo $value["public_date"]?></td>
        <td><?php echo $value["genre"]?></td>
        <td>
            <div class="d-flex flex-column justify-content-between">
            <?php $tmp['author'] = $value['name']; $tmp['author'] = explode(',', $tmp['author']); foreach($tmp['author'] as $value){
                echo
                    '<div class="mb-1 d-flex flex-row justify-content-between w-100">
                    <div class="me-2 text-start">'
                    .$value.
                    '</div> 
                     <div class="me-2">
                        <a role="button" class="btn btn-success" href='.'/changeAuthor?name='.urlencode($value).'>Изменить автора</a>
                    </div>
                    </div>'
                ;}?>
            </div>
        </td>
    </tr>
    <?php }?>
    </tbody>
</table>
</div>
<div class='d-flex flex-row justify-content-center'>
<?php
echo $data['pagination'];
?>
</div>
<div class='d-flex flex-row justify-content-center my-2'>
    <a role="button"class="btn btn-success" href="/addBook">Добавить книгу</a>
</div>
<div class='d-flex flex-row justify-content-center'>
    <a role="button"class="btn btn-success" href="/addAuthor">Добавить автора</a>
</div>