{include file="_head.tpl"}
{include file="_header.tpl"}


<div class="container">
	<div class="row container-center">
		<div class="col s12">
			{if $view=="list"}
				{include file="list_purchases.tpl"}
			{else if $view == "edit"}
				{include file="new_purchase.tpl"}
			{else if $view == "detail"}
				{include file="view_purchase.tpl"}
			{/if}
		</div>
	</div>
</div>


{include file="_footer.tpl"}