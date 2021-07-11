<div class="d-flex flex-column"></div>
<div class="d-flex align-items-center justify-content-center">
<table class="table">
    <thead class="table-dark">
    <tr>
        <th scope="col">Книга</th>
        <th scope="col">Авторство</th>
        <th scope="col">Кол-во страниц</th>
        <th scope="col">Дата Выпуска</th>
        <th scope="col">Жанр</th>
        <th class="text-center"scope="col">Редактирование</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($data['items'] as $key => $value){ ?>
    <tr>
        <td><?php echo $value["book_name"] ?></td>
        <td><?php echo $value["name"].' '.$value["surname"]. ' '.$value["patronymic"] ?></td>
        <td><?php echo $value["pages"]?></td>
        <td><?php echo $value["public_date"]?></td>
        <td><?php echo $value["genre"]?></td>
        <td>
            <div class="d-flex justify-content-center">
            <div class="me-2">
                <button style="width: 110px;" type="button" class="btn btn-primary px-2">
                    Изменить
                </button>
            </div>
            <div class="me-2">
                <button style="width: 110px;" type="button" class="btn btn-danger">
                    Удалить
                </button>
            </div>
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
