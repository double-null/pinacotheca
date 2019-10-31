{extends file="template.tpl"}

{block name="page"}
    <div class="row">
        <div class="col-md-6">
        <h2>Загрузка изображения</h2>
        {if !empty($success)}<div class="success">Изображение загружено!</div>{/if}
        <form method="post" enctype="multipart/form-data">
            <label>Название:</label>
            <input type="text" name="Picture[name]" value="{$past_data['name']}">
            {if !empty($errors.name)}<div class="error">{$errors.name}</div>{/if}
            <label>Описание:</label>
            <textarea name="Picture[description]">{$past_data['description']}</textarea>
            {if !empty($errors.description)}<div class="error">{$errors.description}</div>{/if}
            <label>Изображение:</label>
            <div class="file-load"><input type="file" name="picture"></div>
            {if !empty($errors.picture)}<div class="error">{$errors.picture}</div>{/if}
            <input type="submit" name="load" value="Загрузить">
        </form>
        </div>
    </div>
{/block}