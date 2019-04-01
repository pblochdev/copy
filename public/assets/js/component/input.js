class Input extends React.Component {
	constructor(props) {
		super(props);
	
		this.state = {
			errors: this.props.errors
		}
	}

	render() {
		if (this.props.type == 'textarea') {
			return (
				<div className={this.props.outerClass}>
					<textarea type={this.props.type} id={this.props.id} name={this.props.name}
						{...this.props.attrs} >

					</textarea>
					<InputError  errors={this.props.errors} />
				</div>
			)
		} else {
			return (
				<div className={this.props.outerClass}>
					<input type={this.props.type} id={this.props.id} name={this.props.name}
						{...this.props.attrs}
					/>
					<InputError  errors={this.props.errors} />
				</div>
			)
		}
	}
}