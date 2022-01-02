<template lang="html">
	<div class="comment-composer">
		<input type="text" class="write-something" placeholder="Leave a comment" v-model="messageText" @keyup:enter="sendComment">
		<div class="box-typical-footer">
			<div class="tbl">
				<div class="tbl-row">
					<div class="tbl-cell">
						<button type="button" class="btn-icon">
							<i class="font-icon font-icon-earth"></i>
						</button>
						<button type="button" class="btn-icon">
							<i class="font-icon font-icon-picture"></i>
						</button>
						<button type="button" class="btn-icon">
							<i class="font-icon font-icon-calend"></i>
						</button>
						<button type="button" class="btn-icon">
							<i class="font-icon font-icon-video-fill"></i>
						</button>
						<button type="button" class="btn-icon">
							<input type="checkbox" v-model="anomyme" checked="" value="1">
						</button>
					</div>
					<input type="hidden" value="1" v-model="sujet_id">
					<div class="tbl-cell tbl-cell-action">
						<button type="submit" class="btn btn-rounded" @click="sendComment">Send</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
    export default {
    	data(){
    		return {
    			messageText : ""
    		}
    	},
        methods:{
        	sendComment(){
        		console.log('function sendComment is work'+this.messageText);
        		this.$emit({
        			'message':this.messageText,
        			'sujet_id':this.sujet_id
        		});
        		this.messageText = "",
        		this.sujet_id='';
        	}
        }
    }
</script>