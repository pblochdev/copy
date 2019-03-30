class Form extends React.Component {
	constructor(props) {
		super(props);
		this.state = {
			error: null,
			isLoaded: false,
			elements: JSON.parse(this.props['elements'])
		};

	}


	render() {
		
		return (
			<div className="row">
				<Input type="text" id="excercise_name" name="excercise[name]" required="required" placeholder="Name" class="form-control"/>
				<div className="col-12 col-md-6">
					<input type="text" id="excercise_name" name="excercise[name]" required="required" placeholder="Name" class="form-control"/>
				</div>
				<div className="col-4 col-md-2">
					<input type="text" id="excercise_repetition" name="excercise[repetition]" required="required" placeholder="Repetition" className="form-control"/>
				</div>
				<div className="col-4 col-md-2">
					<input type="text" id="excercise_weight" name="excercise[weight]" required="required" placeholder="Weight" className="form-control"/>
				</div>  
				<div className="col-4 col-md-2">
					<button type="submit" id="excercise_submit" name="excercise[submit]" className="btn-secondary btn">Submit</button>
				</div>
			</div>
		)
	}
}