class AddExcerciseForm extends React.Component {
	constructor(props) {
		super(props);
		this.handleSubmit = this.handleSubmit.bind(this);
		
		this.state = {
			formSubmitted: false,
			elements: [
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
	}


	handleSubmit(event) {
    	const formData = new FormData(event.target)
		const formValues = new URLSearchParams();

		event.preventDefault()
		
		for (let entry of formData.entries()) {
			formValues.append(entry[0], entry[1]);
		}

		formValues.append('workoutId', this.props.workout_id);
		
		axios.post('/add-excercise', formValues)
		.then(
			(response) => {
				console.log('response', response);
				if (response.data.result == 'success') {
					this.props.excercise_list.fetchResult();
					this.state.formSubmitted = true;
					this.forceUpdate();
					this.state.formSubmitted = false;
					this.forceUpdate();
				} else if (response.data.result == 'invalid') {
					
					
				}
			},
			(error) => {
				console.log('error', error);
				
			}
		);
		
	}


	render() {
		if (this.state.formSubmitted === false) {
			return (
				<form className="row" onSubmit={this.handleSubmit}>
					{this.state.elements.map(item => (
						<Input type={item.type} outerClass={item.outerClass} id={item.id} name={item.name} attrs={item.attrs}/>
					))}
				</form>
			)
		} else {
			return (
				<div>TEST</div>
			)
		}
	}
}
