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
	  console.log('fetchItemss');
	  
	  fetch("/workout-list-json")
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
				  <div class="workout row">
					<div class="col-10">
					  <a href={item.details_url}>{item.created_at}</a>
					</div>
					<div class="col-2">
					  <a class="btn btn-danger" href={item.remove_url}>Remove</a>
					</div>
				  </div>
				))}
			</div>
		);
	  }
	}
  
	componentDidMount() {
	  this.fetchResult()
	  setInterval(this.fetchResult, 10000);
	}
  }
  
