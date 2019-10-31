{extends file="template.tpl"}

{block name="page"}
    <div class="row">
        <div class="col-md-6">
            <h2>Авторизация</h2>
            {if !empty($error)}<div class="error">Неверный логин и пароль!</div>{/if}
            <form method="post">
                <label>Имя:</label>
                <input type="text" name="User[nickname]">
                <label>Пароль:</label>
                <input type="password" name="User[password]">
                <input type="submit" value="Вход">
            </form>
        </div>
    </div>
{/block}