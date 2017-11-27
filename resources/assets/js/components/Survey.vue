<template>
	
	<div class="sticky" v-if="!submitStatus">
		<div class="survey">
		  <div class="survey-toggler">
		    <a @click.prevent="contentToggle"><i class="fa fa-commenting"></i></a>
		  </div>
		  <div :class="{'survey-content': true, 'show': showContent, 'show-comment': satisfaction, 'show-email': (satisfaction == 'bad') }">
		  	<h6 class="text-center mt-3" v-if="!satisfaction">คุณชอบเว็บไซต์นี้ไหม?</h6>
		    <div class="survey-satisfaction text-white" style="font-size:2.5rem;" v-if="!satisfaction">
		    	<a href="#" @click.prevent="feel('good')">
		    		<i class="fa fa-smile-o"></i>
		    	</a>
		    	<a href="#" @click.prevent="feel('none')">
		      	<i class="fa fa-meh-o"></i>
		    	</a>
		    	<a href="#" @click.prevent="feel('bad')">
		      	<i class="fa fa-frown-o"></i>
		    	</a>
		    </div>

		    <div class="survey-comment" v-if="satisfaction">
		    	<div class="comment my-0">
		    		<textarea rows="3" :placeholder="placeholder" v-model="comment"></textarea>
		    	</div>
		    	<div class="email mt-0" v-if="satisfaction == 'bad'">
		    		<small class="text-white">คุณพบปัญหาอะไร? โปรดบอกเรา</small>
						<input type="email" placeholder="email..." v-model="email">
		    		<small class="text-white">อย่ากังวล เราไม่ส่งเมล์สแปมคุณแน่นอน	</small>
		    	</div>
		    	<div class="buttons">
			    	<a href="#" class="text-white underline" @click.prevent="submitWithoutComment">No, thanks</a>
			    	<a href="#" class="btn btn-sm btn-secondary text-wu-o" @click.prevent="onSubmit">Submit</a>
		    	</div>
		    </div>
		  </div>
		</div>
	</div>

</template>

<script>
	export default {
		data() {
			return {
				showContent: false,
				satisfaction: '', // good, none, bad
				comment: '',
				placeholder: '',
				email: '',
				submitStatus: false // true after submit
			};
		},
		methods: {
			contentToggle: function () {
				this.showContent = !this.showContent;
			},
			feel: function (feeling) {
				this.satisfaction = feeling;
				if (feeling == 'good') {
					this.placeholder = 'ดีใจที่คุณชอบ! ต้องการให้เราปรับปรุงอะไรอีกไหม?';
				} else if (feeling == 'none') {
					this.placeholder = 'ทำไมหรอ? อยากให้เราปรับปรุงอะไรไหม?';
				} else if (feeling == 'bad') {
					this.placeholder = 'คุณพบปัญหาหรือไม่ชอบอะไร?';
				}
			},
			submitWithoutComment: function () {
				this.submitStatus = 'true';
			},
			onSubmit: function () {
				this.submitStatus = 'true';
			}
		}
	}
</script>
