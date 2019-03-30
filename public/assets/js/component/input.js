class Input extends React.Component {
	constructor(props) {
		super(props);
	}

	render() {
		return (
			<div className={this.props.outerClass}>
				<input type={this.props.type} id={this.props.id} name={this.props.name}
					{...this.props.attrs} 
				/>
			</div>
		)
	}
}