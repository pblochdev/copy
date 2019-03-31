class InputError extends React.Component {


	render() {
		if (this.props.errors) {
			return (
				<span className="invalid-feedback d-block">
					{this.props.errors.map((item, index) => 
						<span className="mb-0 d-block shake" key={index}>
							<span className="form-error-message">{item}</span>
						</span>
					)}
				</span>
			)
		} else {
			return (<div></div>)
		}
	}
}