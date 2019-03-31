class Input extends React.Component {
	constructor(props) {
		super(props);
	
		this.state = {
			errors: this.props.errors
		}
	}

	render() {
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