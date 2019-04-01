class List extends React.Component {
	fetchUrl = null

	constructor(props) {
		super(props);
		this.state = {
			error: null,
			isLoaded: false,
			items: [],
		};
	}
  
	fetchResult = () => {
	  fetch(this.fetchUrl)
		.then(res => res.json())
		.then(
		  (result) => {
				this.setState({
					isLoaded: true,
					items: result
				});
		  },
		  (error) => {
			this.setState({
				isLoaded: true,
				error
			});
		  }
		)
	}

	rowAction = (url) => {
		console.log('url', url);
		
		axios.get(url)
			.then(res => {
				this.fetchResult();
			})
			.catch(err => console.log(err))
	}

	componentDidMount() {
		this.fetchResult()
	}
}
  
