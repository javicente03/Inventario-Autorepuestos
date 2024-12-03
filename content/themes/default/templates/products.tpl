{include file="_head.tpl"}
{include file="_header.tpl"}


<div class="container">
	<div class="row container-center">
		<div class="col s12">
			{if $view=="list"}
				{include file="list_products.tpl"}
			{else if $view == "edit"}
				{include file="edit_product.tpl"}
			{else if $view == "detail"}
				{include file="detail_product.tpl"}
			{/if}
		</div>
	</div>
</div>


{include file="_footer.tpl"}