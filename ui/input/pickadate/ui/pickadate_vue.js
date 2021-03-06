
/**
 * pickadate datepicker
 */
Vue.component('pickadate', {
	template:
		'<input ref="input" class="uk-input uk-form-width-medium pickadate" :name="input_name" :data-value="input_value" :placeholder="input_placeholder">'
	,
	props: ['name','value','format','placeholder','min','max','selectMonths','selectYears'],
	data: function() {
		return {
			input_name: this.name,
			input_value: this.value,
			input_placeholder: this.placeholder !== undefined ? this.placeholder : 'TT.MM.JJJJ',
			input: false,
			format: typeof this.format !== undefined ? this.format : 'dd.mm.yyyy',
			min: typeof this.min !== undefined ? this.min : false,
			max: typeof this.max !== undefined ? this.max : false,
			selectMonths: typeof this.selectMonths !== undefined ? this.selectMonths : false,
			selectYears: typeof this.selectYears !== undefined ? this.selectYears : false,
		}
	},
	mounted: function () {
		let opt= {
			editable: false,
			format: 'dd.mm.yyyy',
			formatSubmit: 'yyyy-mm-dd',
			hiddenName: true,
			onSet: this.update,
			selectMonths: this.selectMonths,
			selectYears: this.selectYears,
		};
		if (this.min) {
			opt.min= new Date(this.min);
		}
		if (this.max) {
			opt.max= new Date(this.max);
		}
		$(this.$el).pickadate(opt);
	}
});