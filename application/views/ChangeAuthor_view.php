<div class="container border border-3 border-light rounded-3 py-3 my-3">
    <form method="post" action="/changeAuthor/change">
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Автор: <?php echo $data['name'];?></label>
            <input type="text" class="form-control" name="name"?>
            <input hidden type="text" class="form-control" value="<?php echo $data['name'];?>" name="old_name"?>
        <button type="submit" class="btn btn-primary">Изменить</button>
        <button role="button" class="btn"><a href="/" class="page-link">Вернуться на главную</a></button>
    </form>
    <h3 class="bg-danger"><?php if(isset($data['Errors'])){echo $data['Errors']['authorNameError'];};?></h3>
    <h3 class="bg-success text-center"><?php if(isset($data['successMessage'])){echo $data['successMessage'];};?></h3>
</div>
