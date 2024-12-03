{include file="_head.tpl"}
{include file="_header.tpl"}


<div class="container">
	<div class="row container-center">
		<div class="col s12">
			{if $view=="list"}
				{include file="list_categories.tpl"}
			{else if $view == "new"}
				{include file="new_category.tpl"}
			{else if $view == "detail"}
				{include file="edit_category.tpl"}
			{/if}
		</div>
	</div>
</div>


{include file="_footer.tpl"}