<template lang="html">
	<div class="comment-log">
		<Comment v-for="comment in comments" :comment="comment"></Comment>
	</div>
</template>

<script type="text/javascript">
	export default {

    props:[comments]

	}
</script>