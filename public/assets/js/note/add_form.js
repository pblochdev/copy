class NoteAddForm extends Form {
	getElements() {
		return [
			{
				'type': 'textarea',
				'id': 'note_text',
				'name': 'note[text]',
				'outerClass': 'col-12 form-group',
				'attrs': {
					'className': 'form-control',
					'placeholder': 'New note'
				}
			},
			{
				'type': 'submit',
				'id': 'note_submit',
				'name': 'note[submit]',
				'outerClass': 'col-12 form-group',
				'attrs': {
					'className': 'btn btn-default'
				}
			},
		]
	}

	handleSubmit(event) {
		let formValues = this.getFormValues(event.target);
		event.preventDefault();
		
		this.setState(state => ({
			errors: []
		}))

		axios.post('/add-note', formValues)
		.then(
			(response) => {
				if (response.data.result == 'success') {
					this.props.note_list.fetchResult();

					this.state.formSubmitted = true;
					this.forceUpdate();
					this.state.formSubmitted = false;
					this.forceUpdate();
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