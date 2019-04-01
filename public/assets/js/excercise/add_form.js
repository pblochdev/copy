class AddExcerciseForm extends Form {
	getElements() {
		return [
			{
				'type': 'text',
				'id': 'excercise_name',
				'name': 'excercise[name]',
				'outerClass': 'col-12 col-md-6 form-element',
				'attrs': {
					'className': 'form-control',
					'placeholder': 'Name'
				}
			},
			{
				'type': 'text',
				'id': 'excercise_repetition',
				'name': 'excercise[repetition]',
				'outerClass': 'col-4 col-md-2 form-element',
				'attrs': {
					'className': 'form-control',
					'placeholder': 'Repetition'
				}
			},
			{
				'type': 'text',
				'id': 'excercise_weight',
				'name': 'excercise[weight]',
				'outerClass': 'col-4 col-md-2 form-element',
				'attrs': {
					'className': 'form-control',
					'placeholder': 'Weight'
				}
			},
			{
				'type': 'submit',
				'id': 'excercise_submit',
				'name': 'excercise[submit]',
				'outerClass': 'col-4 col-md-2 form-element',
				'attrs': {
					'className': 'btn-default btn'
				}
			},
		]
	}

	handleSubmit(event) {
		let formValues = this.getFormValues(event.target)
		formValues.append('workoutId', this.props.workout_id)
		
		event.preventDefault();
		
		this.setState(state => ({
			errors: []
		}))

		axios.post('/add-excercise', formValues)
		.then(
			(response) => {
				if (response.data.result == 'success') {
					this.props.excercise_list.fetchResult()
					this.state.formSubmitted = true
					this.forceUpdate()
					this.state.formSubmitted = false
					this.forceUpdate()
				} else if (response.data.result == 'invalid') {
					this.setState(state => ({
						errors: response.data.errors
					}))
				}
			},
			(error) => {
				
			}
		);
	}
}
