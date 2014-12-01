{*
/*
* @CODOLICENSE
*/
*}
{* Smarty *}
{extends file='layout.tpl'}

{block name=body}
    <div class="codo_container">

        <ol class="codo_breadcrumb">
            <li><a href="{$smarty.const.RURI}{$site_url}">{$home_title}</a></li>
            <li>{_("Search")}</li>
        </ol>


        <div class="row">

            <div class="codo_widget">
                <div class="codo_widget-header">
                    {_("Search result")}
                </div>

                <div class="codo_widget-content">
                </div>
            </div>
        </div>

        {include file='forum/editor.tpl'}
    </div>
{/block}