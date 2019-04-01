class Form extends React.Component {
	constructor(props) {
		super(props);
		this.handleSubmit = this.handleSubmit.bind(this);
		
		this.state = {
			formSubmitted: false,
			errors: {},
			elements: this.getElements()
		}
	}

	getFormValues(form) {
		const formData = new FormData(form)
		const formValues = new URLSearchParams();

		event.preventDefault()
		
		for (let entry of formData.entries()) {
			formValues.append(entry[0], entry[1]);
		}

		return formValues
	}

	render() {
		if (this.state.formSubmitted === false) {
			return (
				<form className="row" onSubmit={this.handleSubmit}>
					{this.state.elements.map(item => (
						<Input type={item.type} outerClass={item.outerClass} key={item.id} id={item.id} name={item.name} attrs={item.attrs} errors={this.state.errors[item.name]}/>
					))}
				</form>
			)
		} else {
			return (
				<div></div>
			)
		}
	}
}
