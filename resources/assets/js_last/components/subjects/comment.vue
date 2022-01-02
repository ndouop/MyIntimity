<template lang='html'>
	<div class="comment">
		<div class="comment-row-item">
			<div class="avatar-preview avatar-preview-32">
				<a href="#">
					<img src="/startUI/img/photo-64-2.jpg" alt="">
				</a>
			</div>
			<div class="tbl comment-row-item-header">
				<div class="tbl-row">
					<div class="tbl-cell tbl-cell-name"> <span>{{ user }}</span> </div>
					<div class="tbl-cell tbl-cell-date">04.07.15, 20:02 PM</div>
				</div>
			</div>
			<div class="comment-row-item-content">
				<p>{{ message }}</p>
				<button type="button" class="comment-row-item-action edit">
					<i class="font-icon font-icon-pencil"></i>
				</button>
				<button type="button" class="comment-row-item-action del">
					<i class="font-icon font-icon-trash"></i>
				</button>
			</div>
		</div>
	</div>
</template>

<script>
   export default {
        data:function(){
        	return {
	        	message: 'Lorem',
	        	user: 'KevinKEMTA'
        	}
        }
    };
</script>
<script>
	
</script>