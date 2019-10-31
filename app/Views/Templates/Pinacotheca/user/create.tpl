{extends file="template.tpl"}

{block name="page"}
    <div class="row">
        <div class="col-md-6">
            <h2>Регистрация пользователя</h2>
            {if !empty($success)}<div class="success">Пользователь зарегистрирован</div>{/if}
            {if !empty($db_error)}<div class="error">Ошибка при сохранении. Попробуйте позже!</div>{/if}
            <form method="post">
                <label>Имя:</label>
                <input type="text" name="User[nickname]">
                {if !empty($errors.nickname)}<div class="error">{$errors.nickname}</div>{/if}
                <label>Эл. Почта:</label>
                <input type="text" name="User[email]">
                {if !empty($errors.email)}<div class="error">{$errors.email}</div>{/if}
                <label>Пароль:</label>
                <input type="password" name="User[password]">
                {if !empty($errors.password)}<div class="error">{$errors.password}</div>{/if}
                <label>Повтор пароля:</label>
                <input type="password" name="User[repass]">
                {if !empty($errors.repass)}<div class="error">{$errors.repass}</div>{/if}
                <input type="submit" value="Регистрация">
            </form>
        </div>
    </div>
{/block}