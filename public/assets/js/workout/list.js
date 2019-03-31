class WorkoutList extends React.Component {
	constructor(props) {
	  super(props);
	  this.state = {
		error: null,
		isLoaded: false,
		items: []
	  };
	}
  
	fetchResult = () => {
	  
	  fetch("/workout-list-json")
		.then(res => res.json())
		.then(
		  (result) => {
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
				{items.map((item, index) => 
				  <div className="workout row" key={index} >
						<div className="col-7 col-md-9">
							<a href={item.details_url}>{item.date}</a>
						</div>
						<div className="col-5 col-md-3">
							<button onClick={() => this.delete(item.remove_url)} className="btn btn-danger">Remove</button>
						</div>
				  </div>
				)}
			</div>
		);
	  }
	}
  
	componentDidMount() {
	  this.fetchResult()
	  setInterval(this.fetchResult, 60000);
	}
  }
  
