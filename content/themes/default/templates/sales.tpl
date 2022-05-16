{include file="_head.tpl"}
{include file="_header.tpl"}


<div class="container">
	<div class="row container-center">
		<div class="col s12">
			{if $view=="list"}
				{include file="list_sales.tpl"}
			{else if $view == "edit"}
				{include file="new_sale.tpl"}
			{else if $view == "detail"}
				{include file="view_sale.tpl"}
			{/if}
		</div>
	</div>
</div>


{include file="_footer.tpl"}