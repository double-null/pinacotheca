{extends file="template.tpl"}

{block name="page"}
    <div class="row">
    {foreach $pictures as $picture}
        <div class="pict-block col-md-4">
            <a href="/images/uploaded/{$picture.physical_name}" data-lightbox="image-1" data-title="{$picture.name}">
                <img src="/images/minimal/{$picture.physical_name}" />
            </a>
            <div class="pict-links">
                <a class="pict-name" href="#">{$picture.name}</a>
                <a class="drop" href="/drop_picture/{$picture.id}/">удалить</a>
            </div>
        </div>
    {/foreach}
    </div>
    {if $pagination.total > 1}
    <div class="row">
        <div id="pagination" class="col-md-12">
            Страницы:
            {for $pg=1 to $pagination.total}
                {if $pg == $pagination.current}
                    <b>{$pg}</b>
                {else}<a href="/pictures/{$pg}/">{$pg}</a>
                {/if}
            {/for}
        </div>
    </div>
    {/if}
{/block}