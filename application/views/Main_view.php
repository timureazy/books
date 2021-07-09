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
    <tr>
        <td><?php echo $data["book_name"] ?></td>
        <td><?php echo $data["name"].' '.$data["surname"]. ' '.$data["patronymic"] ?></td>
        <td><?php echo $data["pages"]?></td>
        <td><?php echo $data["public_date"]?></td>
        <td><?php echo $data["genre"]?></td>
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
    </tbody>
</table>

</div>
