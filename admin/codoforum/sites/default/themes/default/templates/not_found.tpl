{*
/*
* @CODOLICENSE
*/
*}
{* Smarty *}
{extends file='layout.tpl'}

{block name=body}
    
    <style type="text/css">
        
         .codo_not_found {

            margin-top: 20px;
            background: white;
            box-shadow: 1px 1px 5px #ccc;
            padding: 20px;
        }

    </style>
    
    <div class="container">
        
        <div class="codo_not_found">
            
            {_("The page you are looking for does not exists!")}
        </div>
        
    </div>
{/block}
