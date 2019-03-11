class WorkoutDetails extends React.Component {
	constructor(props) {
	  super(props);
	  this.state = {
		error: null,
		isLoaded: false,
		items: []
	  };
	}
  
	fetchResult = () => {
	  
	  fetch("/workout-details/" +  this.props.workout_id)
		.then(res => res.json())
		.then(
		  (result) => {
				console.log('result', result);
				
				this.setState({
					isLoaded: true,
					items: result
				});
		  },
		  // Note: it's important to handle errors here
		  // instead of a catch() block so that we don't swallow
		  // exceptions from actual bugs in components.
		  (error) => {
			this.setState({
			  isLoaded: true,
			  error
			});
		  }
		)
	}


	delete = (url) => {
		axios.get(url)
			.then(res => {
				console.log(res.data);
				this.fetchResult();
			})
			.catch(err => console.log(err))
	}
  
	render() {
		const { error, isLoaded, items } = this.state;
	  if (error) {
		return <div>Error: {error.message}</div>;
	  } else if (!isLoaded) {
		return <div>Loading...</div>;
	  } else {
			return (
			<div>
				{items.map(item => (
					<div className="excercise row">
						<div className="col-12 col-md-6 font-weight-bold">
							{item.name}
						</div>
						<div className="col-4 col-md-2">
							{item.repetition}
						</div>
						<div className="col-4 col-md-2">
							{item.weight}
						</div>
						<div className="col-4 col-md-2">
							<button onClick={() => this.delete(item.remove_url)} className="btn btn-danger">Remove</button>
						</div>
						</div>
					))}
			</div>)
		}
	}
  
	componentDidMount() {
		console.log(this.props.workout_id);
		
	  this.fetchResult()
	  // setInterval(this.fetchResult, 60000);
	}
}
  
